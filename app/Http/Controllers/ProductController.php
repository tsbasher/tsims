<?php

namespace App\Http\Controllers;
use App\Models\ProductCategory;
use App\Models\ProductGroup;
use App\Models\ProductSubCategory;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use stdClass;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
       $products = Product::with('group', 'category','subCategory');
        if ($request->has('search_text') && !empty($request->search_text)) {
            $search = $request->search_text;
            $products = $products->where(function ($query) use ($search) {
                $query->where('name', 'like', '%' . $search . '%')
                    ->orWhere('code', 'like', '%' . $search . '%')
                    ->orWhere('internal_code', 'like', '%' . $search . '%');
            });
        }
        
        if ($request->has('group_id') && !empty($request->group_id)) {
            $products = $products->where('group_id', $request->group_id);
            $categories = ProductCategory::where('group_id', $request->group_id)->get();
        } else
            $categories = [];

        if ($request->has('category_id') && !empty($request->category_id)) {
            $products = $products->where('category_id', $request->category_id);
            $subcategories = ProductSubCategory::where('group_id', $request->group_id)->get();
        }else
            $subcategories = [];

        if ($request->has('sub_category_id') && !empty($request->sub_category_id)) {
            $products = $products->where('sub_category_id', $request->category_id);
        }
        $products = $products->orderBy('id', 'desc')->paginate(10);
        $groups = ProductGroup::get();

        return view('backend.admin.product.index', compact('products','subcategories', 'groups', 'categories'));
        //return view('backend.admin.product.index', compact('products', 'groups'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $groups = ProductGroup::get();
        $categories = [];
        $subcategories = [];
        return view('backend.admin.product.create', compact('groups', 'categories','subcategories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        
        $request->validate([
            'group_id' => 'required|exists:product_groups,id',
            'category_id' => 'required|exists:product_categories,id',
            'sub_category_id' => 'nullable|exists:product_sub_categories,id',
            'name' => 'required|string|max:255',
            'code' => 'nullable|string|max:100',
            'internal_code' => 'nullable|string|max:100',
            'description' => 'nullable|string',
            'featured_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',

        ]);

        $data = $request->only([
            'group_id',
            'category_id',
            'sub_category_id',
            'name',
            'code',
            'internal_code',
            'description'
        ]);

        $data['slug'] = Str::slug($request->name);
        $data['is_active'] = $request->has('is_active') ? $request->is_active : 0;
        $data['show_as_featured'] = $request->has('show_as_featured') ? $request->show_as_featured : 0;


        if ($request->hasFile('featured_image')) {
            $image = $request->file('featured_image');
            $imageName = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('uploads/product/'), $imageName);
            $data['featured_image'] = 'uploads/product/' . $imageName;
        }
        $data['created_by'] = Auth::guard('admin')->user()->id;
        Product::create($data);

        return redirect()->route('admin.product.index')->with('success', 'Product created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        $groups = ProductGroup::get();
        $categories = ProductCategory::where('group_id', $product->group_id)->get();
        $subcategories = ProductSubCategory::where('category_id', $product->category_id)->get();
        return view('backend.admin.product.edit', compact('product', 'groups', 'categories','subcategories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {        
        $product = Product::findOrFail($id);
        $request->validate([
            'group_id' => 'required|exists:product_groups,id',
            'category_id' => 'required|exists:product_categories,id',
            'sub_category_id' => 'nullable|exists:product_sub_categories,id',
            'name' => 'required|string|max:255',
            'code' => 'nullable|string|max:100',
            'internal_code' => 'nullable|string|max:100',
            'description' => 'nullable|string',
            'featured_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',

        ]);

        $data = $request->only([
            'group_id',
            'category_id',
            'sub_category_id',
            'name',
            'code',
            'internal_code',
            'description'
        ]);

        $data['is_active'] = $request->has('is_active') ? $request->is_active : 0;
        $data['show_as_featured'] = $request->has('show_as_featured') ? $request->show_as_featured : 0;
        if ($request->hasFile('featured_image')) {
            $image = $request->file('featured_image');
            $imageName = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('uploads/product_sub_categories/'), $imageName);
            $data['featured_image'] = 'uploads/product_sub_categories/' . $imageName;
        }
        $data['updated_by'] = Auth::guard('admin')->user()->id;
        $product->update($data);
        return redirect()->route('admin.product.index')->with('success', 'Product updated successfully.');
    
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            $product = Product::findOrFail($id);
            $file_path = $product->featured_image;

            // Check if the package is associated with any other records
            if ($product->delete()) {
                // Delete the associated file if it exists
                if ($file_path && file_exists(public_path($file_path))) {
                    File::delete(public_path($file_path));
                }
                $data = new stdClass();
                $data->status = 1;
                $data->message = 'Product deleted successfully.';
                return response()->json($data);
            } else {
                $data = new stdClass();
                $data->status = 0;
                $data->message = 'Product could not be deleted. It may be associated with other records.';
                return response()->json($data);
            }
        } catch (\Exception $e) {
            Log::error('Error deleting Product : ' . $e->getMessage());
            $data = new stdClass();
            $data->status = 0;
            $data->message = 'An error occurred while deleting Product.';
            return response()->json($data);
        }

    }
    
    public function get_product_by_sub_category($sub_category_id)
    {
        $products = Product::where('sub_category_id', $sub_category_id)->where('is_active', 1)->get();
        return response()->json($products);
    }

    public function getProductBySlug($slug)
    {
        $product = Product::where('slug', $slug)->where('is_active', 1)->first();
        
    }
}
