<?php

namespace App\Http\Controllers;

use App\Models\Color;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use stdClass;

class ColorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $colors = Color::query();
        if ($request->has('search_text') && !empty($request->search_text)) {
            $search = $request->input('search_text');
            // Get projects based on search criteria
            $colors->where('name', 'like', "%{$search}%")
                ->orWhere('code', 'like', "%{$search}%");
        }
        // Get all COlors
        $colors = $colors->paginate(10);
        return view('backend.admin.color.index', compact('colors'));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {        
        return view('backend.admin.color.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {        
         $request->validate([
            'name' => 'required|string|max:255',
            'code' => 'nullable|string|max:100',
            'description' => 'nullable|string',
        ]);

        $data = $request->only([
            'name',
            'code',
            'description'
        ]);
        $data['is_active'] = $request->has('is_active') ? $request->is_active : 0;       
        $data['created_by'] = Auth::guard('admin')->user()->id;
        Color::create($data);
        //dd($data);
        return redirect()->route('admin.color.index')->with('success', 'Color created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Color $color)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {        
        $color = Color::findOrFail($id);
        return view('backend.admin.color.edit', compact('color'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
            $request->validate([
                'name' => 'required|string|max:255',
                'code' => 'nullable|string|max:100',
                'description' => 'nullable|string',
            ]);
    
            $data = $request->only([
                'name',
                'code',
                'description'
            ]);
            $data['is_active'] = $request->has('is_active') ? $request->is_active : 0;       
            $data['updated_by'] = Auth::guard('admin')->user()->id;
    
            $color = Color::findOrFail($id);
            $color->update($data);
            return redirect()->route('admin.color.index')->with('success', 'Color updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
       try {
            $color = Color::findOrFail($id);

            // Check if the package is associated with any other records
            if ($color->delete()) {
                // Delete the associated file if it exists
                $data = new stdClass();
                $data->status = 1;
                $data->message = 'Color deleted successfully.';
                return response()->json($data);
            } else {
                $data = new stdClass();
                $data->status = 0;
                $data->message = 'Color could not be deleted. It may be associated with other records.';
                return response()->json($data);
            }
        } catch (\Exception $e) {
            Log::error('Error deleting Color : ' . $e->getMessage());
            $data = new stdClass();
            $data->status = 0;
            $data->message = 'An error occurred while deleting Buyer.';
            return response()->json($data);
        }
     }
}
