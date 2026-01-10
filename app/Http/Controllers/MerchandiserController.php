<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Merchandiser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use stdClass;

class MerchandiserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $merchandisers = Merchandiser::with('customer');
        if($request->has('customer_id') && !empty($request->customer_id)){
            $merchandisers->where('customer_id', $request->customer_id);
        }
        if($request->has('search_text') && !empty($request->search_text)){
            $merchandisers->where(function($query) use ($request){

            $query->where('name', 'like', '%'.$request->search_text.'%')->orWhere('email', 'like', '%'.$request->search_text.'%')->orWhere('phone', 'like', '%'.$request->search_text.'%');
            });
        }

        $merchandisers = $merchandisers->paginate(15);
        $customers = Customer::where('is_active', 1)->get();
        return view('backend.admin.merchandiser.index', compact('merchandisers','customers'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        
        $customers = Customer::where('is_active', 1)->get();
        return view('backend.admin.merchandiser.create', compact('customers'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'customer_id' => 'required|exists:customers,id',
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:20',
            'is_active' => 'nullable|boolean',
        ]);

        Merchandiser::create([
            'customer_id' => $request->customer_id,
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'is_active' => $request->has('is_active') ? 1 : 0,
        ]);

        return redirect()->route('admin.merchandiser.index')->with('success', 'Merchandiser created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Merchandiser $merchandiser)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $merchandiser = Merchandiser::findOrFail($id);
        $customers = Customer::where('is_active', 1)->get();
        return view('backend.admin.merchandiser.edit', compact('merchandiser','customers'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'customer_id' => 'required|exists:customers,id',
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:20',
            'is_active' => 'nullable|boolean',
        ]);

        $merchandiser = Merchandiser::findOrFail($id);
        $merchandiser->update([
            'customer_id' => $request->customer_id,
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'is_active' => $request->has('is_active') ? 1 : 0,
        ]);

        return redirect()->route('admin.merchandiser.index')->with('success', 'Merchandiser updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            $merchandiser = Merchandiser::findOrFail($id);

            // Check if the package is associated with any other records
            if ($merchandiser->delete()) {
                
                $data = new stdClass();
                $data->status = 1;
                $data->message = 'Merchandiser deleted successfully.';
                return response()->json($data);
            } else {
                $data = new stdClass();
                $data->status = 0;
                $data->message = 'Merchandiser could not be deleted. It may be associated with other records.';
                return response()->json($data);
            }
        } catch (\Exception $e) {
            Log::error('Error deleting Merchandiser : ' . $e->getMessage());
            $data = new stdClass();
            $data->status = 0;
            $data->message = 'An error occurred while deleting Merchandiser.';
            return response()->json($data);
        }
    }
}
