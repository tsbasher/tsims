<?php

namespace App\Http\Controllers;

use App\Models\TransportAgent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use stdClass;

class TransportAgentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $transportAgents = TransportAgent::query();

        if ($request->has('search_text') && !empty($request->get('search_text'))) {
            $transportAgents->where(function ($query) use ($request) {
                $query->where('driver_name', 'like', '%' . $request->get('search_text') . '%')
                    ->orWhere('driver_mobile', 'like', '%' . $request->get('search_text') . '%')
                    ->orWhere('vehicle_type', 'like', '%' . $request->get('search_text') . '%')
                    ->orWhere('vehicle_number', 'like', '%' . $request->get('search_text') . '%')
                    ->orWhere('company_name', 'like', '%' . $request->get('search_text') . '%');
            });
        }

        $transportAgents = $transportAgents->orderByDesc('id')->paginate(10);

        return view('backend.admin.transport_agent.index', compact('transportAgents'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.admin.transport_agent.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'driver_name' => 'required|string|max:255',
            'driver_mobile' => 'required|string|max:50',
            'vehicle_type' => 'nullable|string|max:255',
            'vehicle_number' => 'nullable|string|max:100',
            'company_name' => 'nullable|string|max:100',
            'company_address' => 'nullable|string|max:500',
            'company_mobile' => 'nullable|string|max:50',
        ]);
        $data=$request->only([
            'driver_name',
            'driver_mobile',
            'vehicle_type',
            'vehicle_number',
            'company_name',
            'company_address',
            'company_mobile',
        ]);
        TransportAgent::create($data);
        return redirect()->route('admin.transport_agent.index')->with('success', 'Transport Agent created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(TransportAgent $transportAgent)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $transportAgent = TransportAgent::findOrFail($id);
        return view('backend.admin.transport_agent.edit', compact('transportAgent'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $transportAgent = TransportAgent::findOrFail($id);

        $request->validate([
            'driver_name' => 'required|string|max:255',
            'driver_mobile' => 'required|string|max:50',
            'vehicle_type' => 'nullable|string|max:255',
            'vehicle_number' => 'nullable|string|max:100',
            'company_name' => 'nullable|string|max:100',
            'company_address' => 'nullable|string|max:500',
            'company_mobile' => 'nullable|string|max:50',
        ]);

        $data=$request->only([
            'driver_name',
            'driver_mobile',
            'vehicle_type',
            'vehicle_number',
            'company_name',
            'company_address',
            'company_mobile',
        ]);
        $transportAgent->update($data);
        return redirect()->route('admin.transport_agent.index')->with('success', 'Transport Agent updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        //
        try {
            $transportAgent = TransportAgent::findOrFail($id);
            // $file_path = $customer->featured_image;

            // Check if the package is associated with any other records
            if ($transportAgent->delete()) {
                // Delete the associated file if it exists
                // if ($file_path && file_exists(public_path($file_path))) {
                //     File::delete(public_path($file_path));
                // }
                $data = new stdClass();
                $data->status = 1;
                $data->message = 'Transport Agent deleted successfully.';
                return response()->json($data);
            } else {
                $data = new stdClass();
                $data->status = 0;
                $data->message = 'Transport Agent could not be deleted. It may be associated with other records.';
                return response()->json($data);
            }
        } catch (\Exception $e) {
            Log::error('Error deleting Transport Agent : ' . $e->getMessage());
            $data = new stdClass();
            $data->status = 0;
            $data->message = 'An error occurred while deleting Transport Agent.';
            return response()->json($data);
        }
    }
}
