<?php

namespace App\Http\Controllers;

use App\Models\LcType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use stdClass;

class LcTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $lctype=LcType::query();
        if ($request->has('search_text') && $request->get('search_text') != '') {
            $lctype->where('name', 'like', '%' . $request->get('search_text') . '%');
        }
        $lctypes = $lctype->paginate(10);
        return view('backend.admin.lc_type.index', compact('lctypes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.admin.lc_type.create');
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
            'description',
        ]);
        LcType::create($data);
        return redirect()->route('admin.lc_type.index')->with('success', 'LC Type created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(LcType $lcType)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $lctype = LcType::findOrFail($id);
        return view('backend.admin.lc_type.edit', compact('lctype'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        //
        $lctype = LcType::findOrFail($id);
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $data = $request->only([
            'name',
            'description',
        ]);
        $lctype->update($data);
        return redirect()->route('admin.lc_type.index')->with('success', 'LC Type updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
         try {
            $lctype = LcType::findOrFail($id);

            // Check if the package is associated with any other records
            if ($lctype->delete()) {
                $data = new stdClass();
                $data->status = 1;
                $data->message = 'LC Type deleted successfully.';
                return response()->json($data);
            } else {
                $data = new stdClass();
                $data->status = 0;
                $data->message = 'LC Type could not be deleted. It may be associated with other records.';
                return response()->json($data);
            }
        } catch (\Exception $e) {
            Log::error('Error deleting LC Type : ' . $e->getMessage());
            $data = new stdClass();
            $data->status = 0;
            $data->message = 'An error occurred while deleting LC Type.';
            return response()->json($data);
        }
    }
}
