<?php

namespace App\Http\Controllers;

use App\Models\Buyers;
use App\Models\Country;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use stdClass;

class BuyersController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
         $buyers = Buyers::query();
        if ($request->has('search_text') && !empty($request->search_text)) {
            $search = $request->input('search_text');
            // Get projects based on search criteria
            $buyers->where('name', 'like', "%{$search}%")->orWhere('code', 'like', "%{$search}%")->orWhere('internal_code', 'like', "%{$search}%");
        }
        // Get all Buyers
        $buyers = $buyers->paginate(10);
        return view('backend.admin.buyer.index', compact('buyers'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $countries = Country::get();
        return view('backend.admin.buyer.create',compact('countries'));
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
            'description' => 'nullable|string',
            'featured_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $data = $request->only([
            'country_id',
            'name',
            'code',
            'internal_code',
            'description'
        ]);

        $data['is_active'] = $request->has('is_active') ? $request->is_active : 0;
        if ($request->hasFile('featured_image')) {
            $image = $request->file('featured_image');
            $imageName = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('uploads/buyers'), $imageName);
            $data['featured_image'] = 'uploads/buyers/' . $imageName;
        }

        $data['created_by'] = Auth::guard('admin')->user()->id;
        Buyers::create($data);
        //dd($data);
        return redirect()->route('admin.buyer.index')->with('success', 'Buyer created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Buyers $buyers)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {        
        $countries = Country::get();
        
        $buyer = Buyers::findOrFail($id);
        return view('backend.admin.buyer.edit', compact('buyer','countries'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $buyer = Buyers::findOrFail($id);

        $request->validate([
            'country_id' => 'required|exists:countries,id',
            'name' => 'required|string|max:255',
            'code' => 'nullable|string|max:100',
            'internal_code' => 'nullable|string|max:100',
            'description' => 'nullable|string',
            'featured_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $data = $request->only([
            'country_id',
            'name',
            'code',
            'internal_code',
            'description'
        ]);

        $data['is_active'] = $request->has('is_active') ? $request->is_active : 0;

        if ($request->hasFile('featured_image')) {
            // Delete old image if exists
            if ($buyer->featured_image && file_exists(public_path($buyer->featured_image))) {
                File::delete(public_path($buyer->featured_image));
            }

            $image = $request->file('featured_image');
            $imageName = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('uploads/buyers'), $imageName);
            $data['featured_image'] = 'uploads/buyers/' . $imageName;
        }

        $data['updated_by'] = Auth::guard('admin')->user()->id;
        $buyer->update($data);

        return redirect()->route('admin.buyer.index')->with('success', 'buyer updated successfully.');
    
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            $buyer = Buyers::findOrFail($id);
            $file_path = $buyer->featured_image;

            // Check if the package is associated with any other records
            if ($buyer->delete()) {
                // Delete the associated file if it exists
                if ($file_path && file_exists(public_path($file_path))) {
                    File::delete(public_path($file_path));
                }
                $data = new stdClass();
                $data->status = 1;
                $data->message = 'Buyer deleted successfully.';
                return response()->json($data);
            } else {
                $data = new stdClass();
                $data->status = 0;
                $data->message = 'Buyer could not be deleted. It may be associated with other records.';
                return response()->json($data);
            }
        } catch (\Exception $e) {
            Log::error('Error deleting Buyer : ' . $e->getMessage());
            $data = new stdClass();
            $data->status = 0;
            $data->message = 'An error occurred while deleting Buyer.';
            return response()->json($data);
        }
    }
}
