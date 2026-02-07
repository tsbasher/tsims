<?php

namespace App\Http\Controllers;

use App\Models\Bank;
use App\Models\BankAccount;
use App\Models\Customer;
use App\Models\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use stdClass;

class BankAccountController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $bankAccounts = BankAccount::with('bank', 'supplier', 'customer');
        // Add filtering logic if needed based on request parameters
        
        if($request->has('search_text')&&!empty($request->search_text)){
            $search=$request->input('search_text');
            // Get banks based on search criteria
            $bankAccounts->where('account_name','like',"%{$search}%");
        }
        if ($request->has('bank_id') && !empty($request->bank_id)) {
            $bankAccounts->where('bank_id', $request->bank_id);
            $banks=Bank::where('id',$request->bank_id)->get();
        }else
        $banks=Bank::get();

        if ($request->has('supplier_id') && !empty($request->supplier_id)) {
            $bankAccounts->where('supplier_id', $request->supplier_id);
            $suppliers=Supplier::where('id',$request->supplier_id)->get();
        }else
        $suppliers=Supplier::get();
        if($request->has('customer_id') && !empty($request->customer_id)) {
            $bankAccounts->where('customer_id', $request->customer_id);
            $customers=Customer::where('id',$request->customer_id)->get();
        }else
        $customers=Customer::get();

        $bankAccounts = $bankAccounts->paginate(10);
        return view('backend.admin.bank_account.index', compact('bankAccounts', 'banks', 'suppliers', 'customers'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $banks = Bank::get();
        $suppliers = Supplier::get();        
        $customers = Customer::get();

        return view('backend.admin.bank_account.create', compact('banks', 'suppliers', 'customers'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {        
        $request->validate([
            'bank_id' => 'required|exists:banks,id',
            'customer_id' => 'nullable|exists:customers,id',
            'supplier_id' => 'nullable|exists:suppliers,id',
            'account_name' => 'required|string|max:255',
            'account_number' => 'required|string|max:255',
            'branch' => 'nullable|string|max:100',
            'branch_address' => 'nullable|string',
            'bin' => 'nullable|string|max:100',
            'tin' => 'nullable|string|max:100',
            'routing_number' => 'nullable|string|max:100',
            'swiftcode' => 'nullable|string|max:100',
            'account_for' => 'required|in:own,customer,supplier',

        ]);
dd($request->all());
        $data = $request->only([
            '_id',
            'bank_id',
            'customer_id',
            'supplier_id',
            'account_name',
            'account_number',
            'branch',
            'branch_address',
            'bin',
            'tin',
            'routing_number',
            'swiftcode',
            'account_for',
        ]);

        // $data['slug'] = Str::slug($request->account_name);

        $data['created_by'] = Auth::guard('admin')->user()->id;//
        BankAccount::create($data);
        return redirect()->route('admin.bank_account.index')->with('success', 'Bank Account created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(BankAccount $bankAccount)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
     {
        $bankAccount = BankAccount::findOrFail($id);
        $banks = Bank::get();
        $suppliers = Supplier::get();        
        $customers = Customer::get();

        return view('backend.admin.bank_account.edit', compact('bankAccount', 'banks', 'suppliers', 'customers'));
       
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, BankAccount $bankAccount)
    {
        $request->validate([
            'bank_id' => 'required|exists:banks,id',
            'customer_id' => 'nullable|exists:customers,id',
            'supplier_id' => 'nullable|exists:suppliers,id',
            'account_name' => 'required|string|max:255',
            'account_number' => 'required|string|max:255',
            'branch' => 'nullable|string|max:100',
            'branch_address' => 'nullable|string',
            'bin' => 'nullable|string|max:100',
            'tin' => 'nullable|string|max:100',
            'routing_number' => 'nullable|string|max:100',
            'swiftcode' => 'nullable|string|max:100',
            'account_for' => 'required|in:own,customer,supplier',
        ]);

// dd($request->all());
        $data = $request->only([
            'bank_id',
            'customer_id',
            'supplier_id',
            'account_name',
            'account_number',
            'branch',
            'branch_address',
            'bin',
            'tin',
            'routing_number',
            'swiftcode',
            'account_for',
        ]);

        if($request->account_for=='own'){
            $data['customer_id']=null;
            $data['supplier_id']=null;
        }elseif($request->account_for=='customer'){
            $data['supplier_id']=null;
        }elseif($request->account_for=='supplier'){
            $data['customer_id']=null;
        }

        $data['updated_by'] = Auth::guard('admin')->user()->id;

        $bankAccount->update($data);

        return redirect()->route('admin.bank_account.index')->with('success', 'Bank Account updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
         try {
            $bankAccount = BankAccount::findOrFail($id);

            // Check if the package is associated with any other records
            if ($bankAccount->delete()) {
                $data = new stdClass();
                $data->status = 1;
                $data->message = 'Bank Account deleted successfully.';
                return response()->json($data);
            } else {
                $data = new stdClass();
                $data->status = 0;
                $data->message = 'Bank Account could not be deleted. It may be associated with other records.';
                return response()->json($data);
            }
        } catch (\Exception $e) {
            Log::error('Error deleting Bank Account : ' . $e->getMessage());
            $data = new stdClass();
            $data->status = 0;
            $data->message = 'An error occurred while deleting Bank Account.';
            return response()->json($data);
        }
    }
}
