<?php

namespace App\Http\Controllers;

use App\Models\TermsConditionType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use stdClass;

class TermsConditionTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $types=TermsConditionType::paginate(15);
        return view('backend.admin.terms_condition_type.index',compact('types'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.admin.terms_condition_type.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        TermsConditionType::create([
            'name' => $request->name,
        ]);

        return redirect()->route('admin.terms_condition_type.index')->with('success', 'Terms & Condition Type created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(TermsConditionType $termsConditionType)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $type=TermsConditionType::findOrFail($id);
        return view('backend.admin.terms_condition_type.edit',compact('type'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $type = TermsConditionType::findOrFail($id);
        $type->update([
            'name' => $request->name,
        ]);

        return redirect()->route('admin.terms_condition_type.index')->with('success', 'Terms & Condition Type updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            $type = TermsConditionType::findOrFail($id);

            // Check if the package is associated with any other records
            if ($type->delete()) {
                
                $data = new stdClass();
                $data->status = 1;
                $data->message = 'Terms & Condition Type deleted successfully.';
                return response()->json($data);
            } else {
                $data = new stdClass();
                $data->status = 0;
                $data->message = 'Terms & Condition Type could not be deleted. It may be associated with other records.';
                return response()->json($data);
            }
        } catch (\Exception $e) {
            Log::error('Error deleting Terms & Condition Type : ' . $e->getMessage());
            $data = new stdClass();
            $data->status = 0;
            $data->message = 'An error occurred while deleting Terms & Condition Type.';
            return response()->json($data);
        }
    }
}
