<?php

namespace App\Http\Controllers;

use App\Models\Department;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use stdClass;

class DepartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $departments = Department::query();
        if ($request->has('search_text') && !empty($request->search_text)) {
            $search = $request->input('search_text');
            // Get projects based on search criteria
            $departments->where('name', 'like', "%{$search}%")->orWhere('code', 'like', "%{$search}%")->orWhere('internal_code', 'like', "%{$search}%");
        }
        // Get all projects
        $departments = $departments->paginate(10);
        return view('backend.admin.department.index', compact('departments'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.admin.department.create');
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
                Department::create($data);
                return redirect()->route('admin.department.index')->with('success', 'Department created successfully.');
            } catch (\Exception $e) {
                Log::error('Error creating department: ' . $e->getMessage());
                return back()->withInput()->with('error', 'An error occurred while creating the department. Please try again.');
            }
    }

    /**
     * Display the specified resource.
     */
    public function show(Department $department)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit( $id)
    {
       
        $department = Department::findorFail($id);
        if (!$department) {
            return redirect()->route('admin.department.index')->with('error', 'Department not found.');
        }
        return view('backend.admin.department.edit', compact('department'));
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
        $department = Department::findorFail($id);
        if (!$department) {
            return redirect()->route('admin.department.index')->with('error', 'Department not found.');
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

        $department->update($data);

        return redirect()->route('admin.department.index')->with('success', 'Department updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
       try {
            $department = Department::findOrFail($id);

            // Check if the package is associated with any other records
            if ($department->delete()) {
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
