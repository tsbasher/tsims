<?php

namespace App\Http\Controllers;

use App\Models\ProductGroup;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use stdClass;

class ProductGroupController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $groups = ProductGroup::query();
        if ($request->has('search_text') && !empty($request->search_text)) {
            $search = $request->input('search_text');
            // Get projects based on search criteria
            $groups->where('name', 'like', "%{$search}%")->orWhere('code', 'like', "%{$search}%")->orWhere('internal_code', 'like', "%{$search}%");
        }
        // Get all projects
        $groups = $groups->paginate(10);
        return view('backend.admin.product_group.index', compact('groups'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.admin.product_group.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'code' => 'required|string|max:100',
            'internal_code' => 'nullable|string|max:100',
            'featured_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',

        ]);

        $data = $request->only([
            'name',
            'description',
            'code',
            'internal_code'
        ]);
        $data['slug'] = Str::slug($request->name);
        // Handle file upload for featured_image
        if ($request->hasFile('featured_image')) {
            $image = $request->file('featured_image');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $image->move(public_path('uploads/product_groups'), $imageName);
            $data['featured_image'] = 'uploads/product_groups/' . $imageName;
        }

        // Set default values for checkboxes if not present in the request
        $data['show_as_featured'] = $request->has('show_as_featured') ? $request->has('show_as_featured') : 0;
        $data['is_active'] = $request->has('is_active') ? $request->has('is_active') : 0;

        // Assuming you have authentication and want to set created_by

        $data['created_by'] = Auth::guard('admin')->user()->id;


        ProductGroup::create($data);

        return redirect()->route('admin.product_group.index')->with('success', 'Product Group created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(ProductGroup $productGroup)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $group = ProductGroup::findOrFail($id);
        return view('backend.admin.product_group.edit', compact('group'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'code' => 'required|string|max:100',
            'internal_code' => 'nullable|string|max:100',
            'featured_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $group = ProductGroup::findOrFail($id);

        $data = $request->only([
            'name',
            'description',
            'code',
            'internal_code'
        ]);
        $data['slug'] = Str::slug($request->name);
        // Handle file upload for featured_image
        if ($request->hasFile('featured_image')) {
            if ($group->featured_image && file_exists(public_path($group->featured_image))) {
                File::delete(public_path($group->featured_image));
            }
            $image = $request->file('featured_image');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $image->move(public_path('uploads/product_groups'), $imageName);
            $data['featured_image'] = 'uploads/product_groups/' . $imageName;
        }

        // Set default values for checkboxes if not present in the request
        $data['show_as_featured'] = $request->has('show_as_featured') ? $request->has('show_as_featured') : 0;
        $data['is_active'] = $request->has('is_active') ? $request->has('is_active') : 0;

        // Assuming you have authentication and want to set updated_by
        $data['updated_by'] = Auth::guard('admin')->user()->id;

        $group->update($data);

        return redirect()->route('admin.product_group.index')->with('success', 'Product Group updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            $group = ProductGroup::findOrFail($id);
            $file_path = $group->featured_image;

            // Check if the package is associated with any other records
            if ($group->delete()) {
                // Delete the associated file if it exists
                if ($file_path && file_exists(public_path($file_path))) {
                    File::delete(public_path($file_path));
                }

                $data = new stdClass();
                $data->status = 1;
                $data->message = 'Product Group deleted successfully.';
                return response()->json($data);
            } else {
                $data = new stdClass();
                $data->status = 0;
                $data->message = 'Product Group could not be deleted. It may be associated with other records.';
                return response()->json($data);
            }
        } catch (\Exception $e) {
            Log::error('Error deleting Product Group: ' . $e->getMessage());
            $data = new stdClass();
            $data->status = 0;
            $data->message = 'An error occurred while deleting Product Group.';
            return response()->json($data);
        }
    }

    
    public function getProductByGroup($slug)
    {
        $data = ProductGroup::where('slug', $slug)->with('products')->firstOrFail();
        return view('frontend.category_details', compact('data'));
    }
}
