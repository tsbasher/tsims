<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\ProductGroup;
use App\Models\ProductSubCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use stdClass;

class ProductSubCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $sub_categories = ProductSubCategory::with('group', 'category');
        if ($request->has('search_text') && !empty($request->search_text)) {
            $search = $request->search_text;
            $sub_categories = $sub_categories->where(function ($query) use ($search) {
                $query->where('name', 'like', '%' . $search . '%')
                    ->orWhere('code', 'like', '%' . $search . '%')
                    ->orWhere('internal_code', 'like', '%' . $search . '%');
            });
        }
        if ($request->has('group_id') && !empty($request->group_id)) {
            $sub_categories = $sub_categories->where('group_id', $request->group_id);
            $categories = ProductCategory::where('group_id', $request->group_id)->get();
        } else
            $categories = [];

        if ($request->has('category_id') && !empty($request->category_id)) {
            $sub_categories = $sub_categories->where('category_id', $request->category_id);
        }
        $sub_categories = $sub_categories->orderBy('id', 'desc')->paginate(10);
        $groups = ProductGroup::get();

        return view('backend.admin.product_sub_category.index', compact('sub_categories', 'groups', 'categories'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $groups = ProductGroup::get();
        $categories = [];
        return view('backend.admin.product_sub_category.create', compact('groups', 'categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'group_id' => 'required|exists:product_groups,id',
            'category_id' => 'required|exists:product_categories,id',
            'name' => 'required|string|max:255',
            'code' => 'nullable|string|max:100',
            'internal_code' => 'nullable|string|max:100',
            'description' => 'nullable|string',
            'featured_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',

        ]);

        $data = $request->only([
            'group_id',
            'category_id',
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
            $image->move(public_path('uploads/product_sub_categories/'), $imageName);
            $data['featured_image'] = 'uploads/product_sub_categories/' . $imageName;
        }
        $data['created_by'] = Auth::guard('admin')->user()->id;
        ProductSubCategory::create($data);

        return redirect()->route('admin.product_sub_category.index')->with('success', 'Product Sub Category created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(ProductSubCategory $productSubCategory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $sub_category = ProductSubCategory::findOrFail($id);
        $groups = ProductGroup::get();
        $categories = ProductCategory::where('group_id', $sub_category->group_id)->get();
        return view('backend.admin.product_sub_category.edit', compact('sub_category', 'groups', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $sub_category = ProductSubCategory::findOrFail($id);
        $request->validate([
            'group_id' => 'required|exists:product_groups,id',
            'category_id' => 'required|exists:product_categories,id',
            'name' => 'required|string|max:255',
            'code' => 'nullable|string|max:100',
            'internal_code' => 'nullable|string|max:100',
            'description' => 'nullable|string',
            'featured_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',

        ]);

        $data = $request->only([
            'group_id',
            'category_id',
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
            $image->move(public_path('uploads/product_sub_categories/'), $imageName);
            $data['featured_image'] = 'uploads/product_sub_categories/' . $imageName;
        }
        $data['updated_by'] = Auth::guard('admin')->user()->id;
        $sub_category->update($data);
        return redirect()->route('admin.product_sub_category.index')->with('success', 'Product Sub Category updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            $sub_category = ProductSubCategory::findOrFail($id);
            $file_path = $sub_category->featured_image;

            // Check if the package is associated with any other records
            if ($sub_category->delete()) {
                // Delete the associated file if it exists
                if ($file_path && file_exists(public_path($file_path))) {
                    File::delete(public_path($file_path));
                }
                $data = new stdClass();
                $data->status = 1;
                $data->message = 'Product Sub Category deleted successfully.';
                return response()->json($data);
            } else {
                $data = new stdClass();
                $data->status = 0;
                $data->message = 'Product Sub Category could not be deleted. It may be associated with other records.';
                return response()->json($data);
            }
        } catch (\Exception $e) {
            Log::error('Error deleting Product Sub Category: ' . $e->getMessage());
            $data = new stdClass();
            $data->status = 0;
            $data->message = 'An error occurred while deleting Product Sub Category.';
            return response()->json($data);
        }
    }

    public function get_sub_category_by_category($category_id)
    {
        $sub_categories = ProductSubCategory::where('category_id', $category_id)->where('is_active', 1)->get();
        return response()->json($sub_categories);
    }

    public function getProductBySubCategory($slug)
    {
        $data = ProductSubCategory::where('slug', $slug)->with('products')->firstOrFail();
        return view('frontend.category_details', compact('data'));
    }
}
