<?php

namespace App\Http\Controllers;

use App\Models\Cretification;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;
use stdClass;

class CretificationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {        
         $certifications = Cretification::query();
        if ($request->has('search_text') && !empty($request->search_text)) {
            $search = $request->input('search_text');
            // Get projects based on search criteria
            $certifications->where('name', 'like', "%{$search}%")->orWhere('company_name', 'like', "%{$search}%")->orWhere('id_number', 'like', "%{$search}%");
        }
        // Get all projects
        $certifications = $certifications->paginate(10);
        return view('backend.admin.certification.index', compact('certifications'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.admin.certification.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'company_name' => 'required|string|max:100',
            'id_number' => 'required|string|max:100',
            'comments' => 'required|string|max:500',
            'featured_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',

        ]);

        $data = $request->only([
            'name',
            'company_name',
            'id_number',
            'comments'
        ]);
        $data['slug'] = Str::slug($request->title);
        // Handle file upload for featured_image
        if ($request->hasFile('featured_image')) {
            $image = $request->file('featured_image');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $image->move(public_path('uploads/certifications'), $imageName);
            $data['featured_image'] = 'uploads/certifications/' . $imageName;
        }

        // Set default values for checkboxes if not present in the request
        $data['is_active'] = $request->has('is_active') ? $request->has('is_active') : 0;

        // Assuming you have authentication and want to set created_by

        $data['created_by'] = Auth::guard('admin')->user()->id;


        Cretification::create($data);

        return redirect()->route('admin.certification.index')->with('success', 'Certification created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Cretification $cretification)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $certification = Cretification::findOrFail($id);
        return view('backend.admin.certification.edit', compact('certification'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'company_name' => 'required|string|max:100',
            'id_number' => 'required|string|max:100',
            'comments' => 'required|string|max:500',
            'featured_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $certification = Cretification::findOrFail($id);

        $data = $request->only([
            'name',
            'company_name',
            'id_number',
            'comments'
        ]);
        $data['slug'] = Str::slug($request->name);
        // Handle file upload for featured_image
        if ($request->hasFile('featured_image')) {
            if ($certification->featured_image && file_exists(public_path($certification->featured_image))) {
                File::delete(public_path($certification->featured_image));
            }
            $image = $request->file('featured_image');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $image->move(public_path('uploads/certifications'), $imageName);
            $data['featured_image'] = 'uploads/certifications/' . $imageName;
        }

        // Set default values for checkboxes if not present in the request
        $data['is_active'] = $request->has('is_active') ? $request->has('is_active') : 0;

        // Assuming you have authentication and want to set updated_by
        $data['updated_by'] = Auth::guard('admin')->user()->id;

        $certification->update($data);

        return redirect()->route('admin.certification.index')->with('success', 'Certificate updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {        
        try {
            $certification = Cretification::findOrFail($id);
            $file_path = $certification->featured_image;

            // Check if the package is associated with any other records
            if ($certification->delete()) {
                // Delete the associated file if it exists
                if ($file_path && file_exists(public_path($file_path))) {
                    File::delete(public_path($file_path));
                }
                $data = new stdClass();
                $data->status = 1;
                $data->message = 'Certificate deleted successfully.';
                return response()->json($data);
            } else {
                $data = new stdClass();
                $data->status = 0;
                $data->message = 'Certificate could not be deleted. It may be associated with other records.';
                return response()->json($data);
            }
        } catch (\Exception $e) {
            Log::error('Error deleting Certificate: ' . $e->getMessage());
            $data = new stdClass();
            $data->status = 0;
            $data->message = 'An error occurred while deleting Certificate.';
            return response()->json($data);
        }
    }
}
