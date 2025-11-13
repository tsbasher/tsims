<?php

namespace App\Http\Controllers;

use App\Models\Measurement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use stdClass;

class MeasurementController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
         $measurements = Measurement::query();
        if ($request->has('search_text') && !empty($request->search_text)) {
            $search = $request->input('search_text');
            // Get projects based on search criteria
            $measurements->where('name', 'like', "%{$search}%")
                ->orWhere('code', 'like', "%{$search}%");
        }
        // Get all COlors
        $measurements = $measurements->paginate(10);
        return view('backend.admin.measurement.index', compact('measurements'));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.admin.measurement.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
             
         $request->validate([
            'name' => 'required|string|max:255',
            'code' => 'nullable|string|max:100',
            'description' => 'nullable|string',
        ]);

        $data = $request->only([
            'name',
            'code',
            'description'
        ]);
        $data['is_active'] = $request->has('is_active') ? $request->is_active : 0;       
        $data['created_by'] = Auth::guard('admin')->user()->id;
        Measurement::create($data);
        //dd($data);
        return redirect()->route('admin.measurement.index')->with('success', 'Measurement created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Measurement $measurement)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $measurement = Measurement::findOrFail($id);
        return view('backend.admin.measurement.edit', compact('measurement'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
                'name' => 'required|string|max:255',
                'code' => 'nullable|string|max:100',
                'description' => 'nullable|string',
            ]);
    
            $data = $request->only([
                'name',
                'code',
                'description'
            ]);
            $data['is_active'] = $request->has('is_active') ? $request->is_active : 0;       
            $data['updated_by'] = Auth::guard('admin')->user()->id;
    
            $measurement = Measurement::findOrFail($id);
            $measurement->update($data);
            return redirect()->route('admin.measurement.index')->with('success', 'Measurement updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            $measurement = Measurement::findOrFail($id);

            // Check if the package is associated with any other records
            if ($measurement->delete()) {
                // Delete the associated file if it exists
                $data = new stdClass();
                $data->status = 1;
                $data->message = 'Measurement deleted successfully.';
                return response()->json($data);
            } else {
                $data = new stdClass();
                $data->status = 0;
                $data->message = 'Measurement could not be deleted. It may be associated with other records.';
                return response()->json($data);
            }
        } catch (\Exception $e) {
            Log::error('Error deleting Measurement : ' . $e->getMessage());
            $data = new stdClass();
            $data->status = 0;
            $data->message = 'An error occurred while deleting Buyer.';
            return response()->json($data);
        }
    }
}
