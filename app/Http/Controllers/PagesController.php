<?php

namespace App\Http\Controllers;

use App\Models\Pages;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;
use stdClass;

class PagesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
         $pages = Pages::query();
        if ($request->has('search_text') && !empty($request->search_text)) {
            $search = $request->input('search_text');
            // Get projects based on search criteria
            $pages->where('title', 'like', "%{$search}%")->orWhere('code', 'like', "%{$search}%")->orWhere('internal_code', 'like', "%{$search}%");
        }
        // Get all projects
        $pages = $pages->paginate(10);
        return view('backend.admin.pages.index', compact('pages'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {        
        return view('backend.admin.pages.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'nullable|string',
            'code' => 'required|string|max:100',
            'internal_code' => 'nullable|string|max:100',
            'featured_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',

        ]);

        $data = $request->only([
            'title',
            'content',
            'code',
            'internal_code'
        ]);
        $data['slug'] = Str::slug($request->title);
        // Handle file upload for featured_image
        if ($request->hasFile('featured_image')) {
            $image = $request->file('featured_image');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $image->move(public_path('uploads/pages'), $imageName);
            $data['featured_image'] = 'uploads/pages/' . $imageName;
        }

        // Set default values for checkboxes if not present in the request
        $data['is_active'] = $request->has('is_active') ? $request->has('is_active') : 0;

        // Assuming you have authentication and want to set created_by

        $data['created_by'] = Auth::guard('admin')->user()->id;


        Pages::create($data);

        return redirect()->route('admin.pages.index')->with('success', 'Page created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Pages $pages)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $page = Pages::findOrFail($id);
        return view('backend.admin.pages.edit', compact('page'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {        
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'nullable|string',
            'code' => 'required|string|max:100',
            'internal_code' => 'nullable|string|max:100',
            'featured_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $page = Pages::findOrFail($id);

        $data = $request->only([
            'title',
            'content',
            'code',
            'internal_code'
        ]);
        // Handle file upload for featured_image
        if ($request->hasFile('featured_image')) {
            if ($page->featured_image && file_exists(public_path($page->featured_image))) {
                File::delete(public_path($page->featured_image));
            }
            $image = $request->file('featured_image');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $image->move(public_path('uploads/pages'), $imageName);
            $data['featured_image'] = 'uploads/pages/' . $imageName;
        }

        // Set default values for checkboxes if not present in the request
        $data['is_active'] = $request->has('is_active') ? $request->has('is_active') : 0;

        // Assuming you have authentication and want to set updated_by
        $data['updated_by'] = Auth::guard('admin')->user()->id;

        $page->update($data);

        return redirect()->route('admin.pages.index')->with('success', 'Page updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            $page = Pages::findOrFail($id);
            $file_path = $page->featured_image;

            // Check if the package is associated with any other records
            if ($page->delete()) {
                // Delete the associated file if it exists
                if ($file_path && file_exists(public_path($file_path))) {
                    File::delete(public_path($file_path));
                }
                $data = new stdClass();
                $data->status = 1;
                $data->message = 'Page deleted successfully.';
                return response()->json($data);
            } else {
                $data = new stdClass();
                $data->status = 0;
                $data->message = 'Page could not be deleted. It may be associated with other records.';
                return response()->json($data);
            }
        } catch (\Exception $e) {
            Log::error('Error deleting Page: ' . $e->getMessage());
            $data = new stdClass();
            $data->status = 0;
            $data->message = 'An error occurred while deleting Page.';
            return response()->json($data);
        }
    }
}
