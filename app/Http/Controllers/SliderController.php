<?php

namespace App\Http\Controllers;

use App\Models\Slider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use stdClass;

class SliderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
         $sliders = Slider::query();
        if ($request->has('search_text') && !empty($request->search_text)) {
            $search = $request->input('search_text');
            // Get projects based on search criteria
            $sliders->where('title', 'like', "%{$search}%")->orWhere('sub_title', 'like', "%{$search}%");
        }
        // Get all projects
        $sliders = $sliders->paginate(10);
        return view('backend.admin.sliders.index', compact('sliders'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.admin.sliders.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        
        $request->validate([
            'title' => 'required|string|max:255',
            'sub_title' => 'required|string|max:255',
            'action_button_url' => 'nullable|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',

        ]);

        $data = $request->only([
            'title',
            'sub_title',
            'action_button_url'
        ]);
        $data['slug'] = Str::slug($request->title);
        // Handle file upload for featured_image
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('uploads/sliders'), $imageName);
            $data['image'] = 'uploads/sliders/' . $imageName;
        }

        // Set created_by and updated_by fields
        $data['created_by'] = Auth::guard('admin')->user()->id;

        // Create the ProductGroup
        Slider::create($data);

        return redirect()->route('admin.sliders.index')->with('success', 'Slider created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Slider $slider)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $slider = Slider::findOrFail($id);
        //dd($slider);
        return view('backend.admin.sliders.edit', compact('slider'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {        
        $request->validate([
            'title' => 'required|string|max:255',
            'sub_title' => 'required|string|max:255',
            'action_button_url' => 'nullable|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $slider = Slider::findOrFail($id);

        $data = $request->only([
            'title',
            'sub_title',
            'action_button_url'
        ]);
        $data['slug'] = Str::slug($request->title);
        // Handle file upload for featured_image
        if ($request->hasFile('image')) {
            if ($slider->image && file_exists(public_path($slider->image))) {
                File::delete(public_path($slider->image));
            }
            $image = $request->file('image');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $image->move(public_path('uploads/sliders'), $imageName);
            $data['image'] = 'uploads/sliders/' . $imageName;
        }

        // Set default values for checkboxes if not present in the request
        $data['is_active'] = $request->has('is_active') ? $request->has('is_active') : 0;

        // Assuming you have authentication and want to set updated_by
        $data['updated_by'] = Auth::guard('admin')->user()->id;

        $slider->update($data);
        //dd($data);

        return redirect()->route('admin.sliders.index')->with('success', 'Slider updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            $group = Slider::findOrFail($id);
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
}
