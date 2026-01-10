<?php

namespace App\Http\Controllers;

use App\Models\TermsCondition;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use stdClass;

class TermsConditionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $conditions=TermsCondition::paginate(15);
        return view('backend.admin.terms_condition.index',compact('conditions'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.admin.terms_condition.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'description' => 'required|string',
            'serial' => 'nullable|integer',
        ]);

        TermsCondition::create([
            'description' => $request->description,
            'serial' => $request->serial,
        ]);

        return redirect()->route('admin.terms_condition.index')->with('success', 'Terms & Condition created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(TermsCondition $termsCondition)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $condition=TermsCondition::findOrFail($id);
        return view('backend.admin.terms_condition.edit',compact('condition'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'description' => 'required|string',
        ]);

        $condition = TermsCondition::findOrFail($id);
        $condition->update([
            'description' => $request->description,
        ]);

        return redirect()->route('admin.terms_condition.index')->with('success', 'Terms & Condition updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            $type = TermsCondition::findOrFail($id);

            // Check if the package is associated with any other records
            if ($type->delete()) {
                
                $data = new stdClass();
                $data->status = 1;
                $data->message = 'Terms & Condition deleted successfully.';
                return response()->json($data);
            } else {
                $data = new stdClass();
                $data->status = 0;
                $data->message = 'Terms & Condition could not be deleted. It may be associated with other records.';
                return response()->json($data);
            }
        } catch (\Exception $e) {
            Log::error('Error deleting Terms & Condition : ' . $e->getMessage());
            $data = new stdClass();
            $data->status = 0;
            $data->message = 'An error occurred while deleting Terms & Condition.';
            return response()->json($data);
        }
    }
}
