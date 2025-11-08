<?php

namespace App\Http\Controllers;

use App\Models\Country;
use App\Models\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use stdClass;

class SupplierController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $suppliers = Supplier::query();
        if ($request->has('search_text') && !empty($request->search_text)) {
            $search = $request->input('search_text');
            // Get Suppliers on search criteria
            $suppliers->where('name', 'like', "%{$search}%")->orWhere('code', 'like', "%{$search}%")->orWhere('internal_code', 'like', "%{$search}%");
        }
        // Get all Suppliers
        $suppliers = $suppliers->paginate(10);
        return view('backend.admin.supplier.index', compact('suppliers'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $countries = Country::get();
        return view('backend.admin.supplier.create',compact('countries'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {        
        $request->validate([
            'country_id' => 'required|exists:countries,id',
            'name' => 'required|string|max:255',
            'code' => 'nullable|string|max:100',
            'internal_code' => 'nullable|string|max:100',
            'address' => 'nullable|string',
            'mobile' => 'nullable|string',
            'email' => 'nullable|string',
            'prev_balance' => 'nullable|numeric',
        ]);

        $data = $request->only([
            'country_id',
            'name',
            'code',
            'internal_code',
            'address',
            'mobile',
            'email',
            'prev_balance'
        ]);
        $data['slug'] = Str::slug($request->name);
        $data['is_active'] = $request->has('is_active') ? $request->is_active : 0;
       

        $data['created_by'] = Auth::guard('admin')->user()->id;
        Supplier::create($data);
        //dd($data);
        return redirect()->route('admin.supplier.index')->with('success', 'Supplier created successfully.');       
    }

    /**
     * Display the specified resource.
     */
    public function show(Supplier $supplier)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $countries = Country::get();
        $supplier = Supplier::findOrFail($id);
        return view('backend.admin.supplier.edit', compact('supplier','countries'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'country_id' => 'required|exists:countries,id',
            'name' => 'required|string|max:255',
            'code' => 'nullable|string|max:100',
            'internal_code' => 'nullable|string|max:100',
            'address' => 'nullable|string',
            'mobile' => 'nullable|string',
            'email' => 'nullable|string',
            'prev_balance' => 'nullable|numeric',
        ]);

        $data = $request->only([
            'country_id',
            'name',
            'code',
            'internal_code',
            'address',
            'mobile',
            'email',
            'prev_balance'
        ]);
        $data['slug'] = Str::slug($request->name);
        $data['is_active'] = $request->has('is_active') ? $request->is_active : 0;
       

        $data['updated_by'] = Auth::guard('admin')->user()->id;
        $supplier = Supplier::findOrFail($id);
        $supplier->update($data);
        return redirect()->route('admin.supplier.index')->with('success', 'Supplier updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            $supplier = Supplier::findOrFail($id);
            // $file_path = $customer->featured_image;

            // Check if the package is associated with any other records
            if ($supplier->delete()) {
                // Delete the associated file if it exists
                // if ($file_path && file_exists(public_path($file_path))) {
                //     File::delete(public_path($file_path));
                // }
                $data = new stdClass();
                $data->status = 1;
                $data->message = 'Customer deleted successfully.';
                return response()->json($data);
            } else {
                $data = new stdClass();
                $data->status = 0;
                $data->message = 'Customer could not be deleted. It may be associated with other records.';
                return response()->json($data);
            }
        } catch (\Exception $e) {
            Log::error('Error deleting Customer : ' . $e->getMessage());
            $data = new stdClass();
            $data->status = 0;
            $data->message = 'An error occurred while deleting Customer.';
            return response()->json($data);
        }
    }
}
