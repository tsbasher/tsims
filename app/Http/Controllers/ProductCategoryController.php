<?php

namespace App\Http\Controllers;

use App\Models\ProductCategory;
use App\Models\ProductGroup;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use stdClass;

class ProductCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $categories = ProductCategory::with('group');
        if ($request->has('search_text') && !empty($request->input('search_text'))) {
            $search = $request->input('search_text');
            $categories = $categories->where(function ($query) use ($search) {
                $query->where('name', 'like', '%' . $search . '%')
                    ->orWhere('code', 'like', '%' . $search . '%')
                    ->orWhere('internal_code', 'like', '%' . $search . '%');
            });
        }
        if ($request->has('group_id') && !empty($request->input('group_id'))) {
            $group_id = $request->input('group_id');
            $categories = $categories->where('group_id', $group_id);
        }
        $categories = $categories->orderBy('id', 'DESC')->paginate(20);
        $groups = ProductGroup::get();
        // dd($categories);
        return view('backend.admin.product_category.index', compact('categories', 'groups'));
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $groups = ProductGroup::get();
        return view('backend.admin.product_category.create', compact('groups'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'group_id' => 'required|exists:product_groups,id',
            'name' => 'required|string|max:255',
            'code' => 'nullable|string|max:100',
            'internal_code' => 'nullable|string|max:100',
            'description' => 'nullable|string',
            'featured_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $data = $request->only([
            'group_id',
            'name',
            'code',
            'internal_code',
            'description'
        ]);

        $data['is_active'] = $request->has('is_active') ? $request->is_active : 0;
        $data['show_as_featured'] = $request->has('show_as_featured') ? $request->show_as_featured : 0;
        $data['slug'] = Str::slug($request->name);
        if ($request->hasFile('featured_image')) {
            $image = $request->file('featured_image');
            $imageName = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('uploads/product_categories'), $imageName);
            $data['featured_image'] = 'uploads/product_categories/' . $imageName;
        }

        $data['created_by'] = Auth::guard('admin')->user()->id;
        ProductCategory::create($data);

        return redirect()->route('admin.product_category.index')->with('success', 'Product category created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(ProductCategory $productCategory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        // dd($id);
        $category = ProductCategory::findOrFail($id);
        $groups = ProductGroup::get();
        return view('backend.admin.product_category.edit', compact('category', 'groups'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $category = ProductCategory::findOrFail($id);

        $request->validate([
            'group_id' => 'required|exists:product_groups,id',
            'name' => 'required|string|max:255',
            'code' => 'nullable|string|max:100',
            'internal_code' => 'nullable|string|max:100',
            'description' => 'nullable|string',
            'featured_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $data = $request->only([
            'group_id',
            'name',
            'code',
            'internal_code',
            'description'
        ]);

        $data['is_active'] = $request->has('is_active') ? $request->is_active : 0;
        $data['show_as_featured'] = $request->has('show_as_featured') ? $request->show_as_featured : 0;
        $data['slug'] = Str::slug($request->name);

        if ($request->hasFile('featured_image')) {
            // Delete old image if exists
            if ($category->featured_image && file_exists(public_path($category->featured_image))) {
                File::delete(public_path($category->featured_image));
            }

            $image = $request->file('featured_image');
            $imageName = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('uploads/product_categories'), $imageName);
            $data['featured_image'] = 'uploads/product_categories/' . $imageName;
        }

        $data['updated_by'] = Auth::guard('admin')->user()->id;
        $category->update($data);

        return redirect()->route('admin.product_category.index')->with('success', 'Product category updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            $group = ProductCategory::findOrFail($id);
            $file_path = $group->featured_image;

            // Check if the package is associated with any other records
            if ($group->delete()) {
                // Delete the associated file if it exists
                if ($file_path && file_exists(public_path($file_path))) {
                    File::delete(public_path($file_path));
                }

                $data = new stdClass();
                $data->status = 1;
                $data->message = 'Product Category deleted successfully.';
                return response()->json($data);
            } else {
                $data = new stdClass();
                $data->status = 0;
                $data->message = 'Failed to delete Product Category.';
                return response()->json($data);
            }
        } catch (\Exception $e) {
            Log::error('Error deleting Product Category: ' . $e->getMessage());
            $data = new stdClass();
            $data->status = 0;
            $data->message = 'An error occurred while deleting Product Category.';
            return response()->json($data);
        }
    }

    public function get_category_by_group($group_id)
    {
        $categories = ProductCategory::where('group_id', $group_id)->get();
        return response()->json($categories);
    }
}
