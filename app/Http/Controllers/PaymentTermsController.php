<?php

namespace App\Http\Controllers;

use App\Models\Payment_terms;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use stdClass;

class PaymentTermsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $payment_terms = Payment_terms::query();
        if ($request->has('search_text') && !empty($request->search_text)) {
            $search = $request->input('search_text');
            // Get projects based on search criteria
            $payment_terms->where('name', 'like', "%{$search}%");
        }
        // Get all Payment Terms
        $payment_terms = $payment_terms->paginate(10);
        return view('backend.admin.payment_terms.index', compact('payment_terms'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.admin.payment_terms.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
         $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $data = $request->only([
            'name',
            'description'
        ]);   
        $data['created_by'] = Auth::guard('admin')->user()->id;
        Payment_terms::create($data);
        //dd($data);
        return redirect()->route('admin.payment_terms.index')->with('success', 'Payment Terms created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Payment_terms $payment_terms)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {              
        $payment_terms = Payment_terms::findOrFail($id);
        return view('backend.admin.payment_terms.edit', compact('payment_terms'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
                'name' => 'required|string|max:255',
                'description' => 'nullable|string',
            ]);
    
            $data = $request->only([
                'name',
                'description'
            ]);
            $data['is_active'] = $request->has('is_active') ? $request->is_active : 0;       
            $data['updated_by'] = Auth::guard('admin')->user()->id;
    
            $payment_terms = Payment_terms::findOrFail($id);
            $payment_terms->update($data);
            return redirect()->route('admin.payment_terms.index')->with('success', 'Payment Terms updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            $payment_terms = Payment_terms::findOrFail($id);

            // Check if the package is associated with any other records
            if ($payment_terms->delete()) {
                // Delete the associated file if it exists
                $data = new stdClass();
                $data->status = 1;
                $data->message = 'Payment Terms deleted successfully.';
                return response()->json($data);
            } else {
                $data = new stdClass();
                $data->status = 0;
                $data->message = 'Payment Term could not be deleted. It may be associated with other records.';
                return response()->json($data);
            }
        } catch (\Exception $e) {
            Log::error('Error deleting Payment Terms : ' . $e->getMessage());
            $data = new stdClass();
            $data->status = 0;
            $data->message = 'An error occurred while deleting Buyer.';
            return response()->json($data);
        }
    }
}
