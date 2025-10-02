<?php

namespace App\Http\Controllers;

use App\Models\Designation;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use stdClass;

class DesignationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $designations = Designation::query();
        if ($request->has('search_text') && !empty($request->search_text)) {
            $search = $request->input('search_text');
            // Get projects based on search criteria
            $designations->where('name', 'like', "%{$search}%")->orWhere('code', 'like', "%{$search}%")->orWhere('internal_code', 'like', "%{$search}%");
        }
        // Get all projects
        $designations = $designations->paginate(10);
        return view('backend.admin.designation.index', compact('designations'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.admin.designation.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
       
            $request->validate([
                'name' => 'required|string|max:255',
                'code' => 'required|string|max:100',
                'internal_code' => 'nullable|string|max:100',
    
            ]);
    
            $data = $request->only([
                'name',
                'code',
                'internal_code'
            ]);
            $data['slug'] = Str::slug($request->name);
            $data['is_active'] = $request->has('is_active') ? $request->has('is_active') : 0;
    
            // Assuming you have authentication and want to set created_by
            if (Auth::check()) {
                $data['created_by'] = Auth::id();
            }
    
            try {
                Designation::create($data);
                return redirect()->route('admin.designation.index')->with('success', 'Designation created successfully.');
            } catch (\Exception $e) {
                Log::error('Error creating designation: ' . $e->getMessage());
                return back()->withInput()->with('error', 'An error occurred while creating the designation. Please try again.');
            }
    }

    /**
     * Display the specified resource.
     */
    public function show(Designation $designation)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        
        $designation = Designation::findorFail($id);
        if (!$designation) {
            return redirect()->route('admin.designation.index')->with('error', 'Designation not found.');
        }
        return view('backend.admin.designation.edit', compact('designation'));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
         $request->validate([   
            'name' => 'required|string|max:255',
            'code' => 'required|string|max:100',
            'internal_code' => 'nullable|string|max:100',

        ]);
        $designation = Designation::findorFail($id);
        if (!$designation) {
            return redirect()->route('admin.designation.index')->with('error', 'Designation not found.');
        }
        $data = $request->only([
            'name',
            'code',
            'internal_code'
        ]);
        $data['slug'] = Str::slug($request->name);
        $data['is_active'] = $request->has('is_active') ? $request->has('is_active') : 0;

        // Assuming you have authentication and want to set created_by

        $data['updated_by'] = Auth::guard('admin')->user()->id;

        $designation->update($data);

        return redirect()->route('admin.designation.index')->with('success', 'Designation updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            $designation = Designation::findOrFail($id);

            // Check if the package is associated with any other records
            if ($designation->delete()) {
                $data = new stdClass();
                $data->status = 1;
                $data->message = 'Desigmation deleted successfully.';
                return response()->json($data);
            } else {
                $data = new stdClass();
                $data->status = 0;
                $data->message = 'Desigmation could not be deleted. It may be associated with other records.';
                return response()->json($data);
            }
        } catch (\Exception $e) {
            Log::error('Error deleting Desigmation: ' . $e->getMessage());
            $data = new stdClass();
            $data->status = 0;
            $data->message = 'An error occurred while deleting Desigmation.';
            return response()->json($data);
        }
    }
}
