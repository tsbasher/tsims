<?php

namespace App\Http\Controllers;

use App\Models\Currency;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use stdClass;

class CurrencyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $currency=Currency::query();
        if($request->has('search_text')&&!empty($request->search_text)){
            $search=$request->input('search_text');
            // Get currencies based on search criteria
            $currency->where('name','like',"%{$search}%");
        }
        $currencies = $currency->paginate(10);
        return view('backend.admin.currency.index', compact('currencies'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.admin.currency.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'symbol' => 'required|string|max:10',
            'rate' => 'required|numeric',
        ]);
        $data=$request->only([
            'name',
            'symbol',
            'rate',
        ]);
        Currency::create($data);

        return redirect()->route('admin.currency.index')->with('success', 'Currency created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Currency $currency)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $currency = Currency::findOrFail($id);
        return view('backend.admin.currency.edit', compact('currency'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'symbol' => 'required|string|max:10',
            'rate' => 'required|numeric',
        ]);
        $currency = Currency::findOrFail($id);
        $data = $request->only([
            'name',
            'symbol',
            'rate',
        ]);
        $currency->update($data);
        return redirect()->route('admin.currency.index')->with('success', 'Currency updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
         try {
            $currency = Currency::findOrFail($id);

            // Check if the package is associated with any other records
            if ($currency->delete()) {
                $data = new stdClass();
                $data->status = 1;
                $data->message = 'Currency deleted successfully.';
                return response()->json($data);
            } else {
                $data = new stdClass();
                $data->status = 0;
                $data->message = 'Currency could not be deleted. It may be associated with other records.';
                return response()->json($data);
            }
        } catch (\Exception $e) {
            Log::error('Error deleting Currency : ' . $e->getMessage());
            $data = new stdClass();
            $data->status = 0;
            $data->message = 'An error occurred while deleting Currency.';
            return response()->json($data);
        }
    }
}
