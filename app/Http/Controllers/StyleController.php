<?php

namespace App\Http\Controllers;

use App\Models\Buyers;
use App\Models\Customer;
use App\Models\Style;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;
use stdClass;

class StyleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $styles = Style::query();
        if ($request->has('search_text') && !empty($request->search_text)) {
            $search = $request->input('search_text');
            // Get projects based on search criteria
            $styles->where('name', 'like', "%{$search}%")->orWhere('code', 'like', "%{$search}%")->orWhere('internal_code', 'like', "%{$search}%");
        }
        
        $buyers = Buyers::get();
        $customers = Customer::get();
        // Get all Buyers
        $styles = $styles->paginate(10);
        return view('backend.admin.style.index', compact('styles','buyers','customers'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $buyers = Buyers::get();
        $customers = Customer::get();
        return view('backend.admin.style.create',compact('buyers','customers'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {        
         $request->validate([
            'buyer_id' => 'required|exists:buyers,id',
            'customer_id' => 'required|exists:customers,id',
            'name' => 'required|string|max:255',
            'code' => 'nullable|string|max:100',
            'internal_code' => 'nullable|string|max:100',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $data = $request->only([
            'buyer_id',
            'customer_id',
            'name',
            'code',
            'internal_code',
            'description'
        ]);

        $data['is_active'] = $request->has('is_active') ? $request->is_active : 0;
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('uploads/styles'), $imageName);
            $data['image'] = 'uploads/styles/' . $imageName;
        }

        $data['created_by'] = Auth::guard('admin')->user()->id;
        Style::create($data);
        //dd($data);
        return redirect()->route('admin.style.index')->with('success', 'Style created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Style $style)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {               
        $buyers = Buyers::get();   
        $customers = Customer::get();        
        $style = Style::findOrFail($id);
        return view('backend.admin.style.edit', compact('style','buyers','customers'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $style = Style::findOrFail($id);

        $request->validate([
            'buyer_id' => 'required|exists:buyers,id',
            'customer_id' => 'required|exists:customers,id',
            'name' => 'required|string|max:255',
            'code' => 'nullable|string|max:100',
            'internal_code' => 'nullable|string|max:100',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $data = $request->only([
            'buyer_id',
            'customer_id',
            'name',
            'code',
            'internal_code',
            'description'
        ]);

        $data['is_active'] = $request->has('is_active') ? $request->is_active : 0;

        if ($request->hasFile('image')) {
            // Delete old image if exists
            if ($style->image && file_exists(public_path($style->image))) {
                File::delete(public_path($style->image));
            }

            $image = $request->file('image');
            $imageName = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('uploads/styles'), $imageName);
            $data['image'] = 'uploads/styles/' . $imageName;
        }

        $data['updated_by'] = Auth::guard('admin')->user()->id;
        $style->update($data);

        return redirect()->route('admin.style.index')->with('success', 'Style updated successfully.');
    
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            $style = Style::findOrFail($id);
            $file_path = $style->image;

            // Check if the package is associated with any other records
            if ($style->delete()) {
                // Delete the associated file if it exists
                if ($file_path && file_exists(public_path($file_path))) {
                    File::delete(public_path($file_path));
                }
                $data = new stdClass();
                $data->status = 1;
                $data->message = 'Style deleted successfully.';
                return response()->json($data);
            } else {
                $data = new stdClass();
                $data->status = 0;
                $data->message = 'Style could not be deleted. It may be associated with other records.';
                return response()->json($data);
            }
        } catch (\Exception $e) {
            Log::error('Error deleting Style : ' . $e->getMessage());
            $data = new stdClass();
            $data->status = 0;
            $data->message = 'An error occurred while deleting Style.';
            return response()->json($data);
        }
    }
}
