<?php

namespace App\Http\Controllers;

use App\Models\Speciality;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;

class SpecialityController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
         $specialities = Speciality::query();
        if ($request->has('search_text') && !empty($request->search_text)) {
            $search = $request->input('search_text');
            // Get projects based on search criteria
            $specialities->where('name', 'like', "%{$search}%");
        }
        // Get all projects
        $specialities = $specialities->paginate(10);
        return view('backend.admin.speciality.index', compact('specialities'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.admin.speciality.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',

        ]);

        $data = $request->only([
            'name',
            'description',
        ]);
        // Handle file upload for featured_image
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $image->move(public_path('uploads/specialities'), $imageName);
            $data['image'] = 'uploads/specialities/' . $imageName;
        }

        // Set default values for checkboxes if not present in the request
        $data['is_active'] = $request->has('is_active') ? $request->has('is_active') : 0;

        // Assuming you have authentication and want to set created_by

        $data['created_by'] = Auth::guard('admin')->user()->id;


        Speciality::create($data);

        return redirect()->route('admin.speciality.index')->with('success', 'Speciality created successfully.');
   
    }

    /**
     * Display the specified resource.
     */
    public function show(Speciality $speciality)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {        
        $speciality = Speciality::findOrFail($id);
        return view('backend.admin.speciality.edit', compact('speciality'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $speciality = Speciality::findOrFail($id);

        $data = $request->only([
            'name',
            'description',
        ]);
        // Handle file upload for featured_image
        if ($request->hasFile('image')) {
            if ($speciality->image && file_exists(public_path($speciality->image))) {
                File::delete(public_path($speciality->image));
            }
            $image = $request->file('image');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $image->move(public_path('uploads/specialities'), $imageName);
            $data['image'] = 'uploads/specialities/' . $imageName;
        }

        // Set default values for checkboxes if not present in the request
        $data['is_active'] = $request->has('is_active') ? $request->has('is_active') : 0;

        // Assuming you have authentication and want to set updated_by
        $data['updated_by'] = Auth::guard('admin')->user()->id;

        $speciality->update($data);

        return redirect()->route('admin.speciality.index')->with('success', 'Speciality updated successfully.');
   
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            $speciality = Speciality::findOrFail($id);
            $file_path = $speciality->featured_image;

            // Check if the package is associated with any other records
            if ($speciality->delete()) {
                // Delete the associated file if it exists
                if ($file_path && file_exists(public_path($file_path))) {
                    File::delete(public_path($file_path));
                }

                $data = new \stdClass();
                $data->status = 1;
                $data->message = 'Speciality deleted successfully.';
                return response()->json($data);
            } else {
                $data = new \stdClass();
                $data->status = 0;
                $data->message = 'Speciality could not be deleted. It may be associated with other records.';
                return response()->json($data);
            }
        } catch (\Exception $e) {
            Log::error('Error deleting Speciality: ' . $e->getMessage());
            $data = new \stdClass();
            $data->status = 0;
            $data->message = 'An error occurred while deleting Speciality.';
            return response()->json($data);
        }
    }
}
