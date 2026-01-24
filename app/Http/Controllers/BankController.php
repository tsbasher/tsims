<?php

namespace App\Http\Controllers;

use App\Models\Bank;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use stdClass;

class BankController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $banks=Bank::query();
        if($request->has('search_text')&&!empty($request->search_text)){
            $search=$request->input('search_text');
            // Get banks based on search criteria
            $banks->where('name','like',"%{$search}%");
        }
        $banks=$banks->paginate(10);            
        return view('backend.admin.bank.index',compact('banks'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.admin.bank.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'=>'required|string|max:255',
            'code'=>'nullable|string|max:100',
            'description'=>'nullable|string',
        ]);
        
        $data=$request->only([
            'name',
            'code',
            'bin',
            'tin',
            'description',
        ]);
        $data['is_active']=$request->input('is_active',1);
        Bank::create($data);
        return redirect()->route('admin.bank.index')->with('success','Bank created successfully.');
        
    }

    /**
     * Display the specified resource.
     */
    public function show(Bank $bank)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        //
        $bank=Bank::findOrFail($id);
        return view('backend.admin.bank.edit',compact('bank'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $bank=Bank::findOrFail($id);
        $request->validate([
            'name'=>'required|string|max:255',
            'code'=>'nullable|string|max:100',
            'description'=>'nullable|string',
        ]);

        $data=$request->only([
            'name',
            'code',
            'bin',
            'tin',
            'description',
        ]);
        $data['is_active']=$request->input('is_active',1);
        $bank->update($data);
        return redirect()->route('admin.bank.index')->with('success','Bank updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            $bank = Bank::findOrFail($id);

            // Check if the package is associated with any other records
            if ($bank->delete()) {
                $data = new stdClass();
                $data->status = 1;
                $data->message = 'Bank deleted successfully.';
                return response()->json($data);
            } else {
                $data = new stdClass();
                $data->status = 0;
                $data->message = 'Bank could not be deleted. It may be associated with other records.';
                return response()->json($data);
            }
        } catch (\Exception $e) {
            Log::error('Error deleting Bank : ' . $e->getMessage());
            $data = new stdClass();
            $data->status = 0;
            $data->message = 'An error occurred while deleting Bank.';
            return response()->json($data);
        }
    }
}
