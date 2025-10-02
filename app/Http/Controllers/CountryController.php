<?php

namespace App\Http\Controllers;

use App\Models\Country;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;
use stdClass;

class CountryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $countries = Country::query();
        if ($request->has('search_text') && !empty($request->search_text)) {
            $search = $request->input('search_text');
            // Get projects based on search criteria
            $countries->where('name', 'like', "%{$search}%")->orWhere('code', 'like', "%{$search}%")->orWhere('internal_code', 'like', "%{$search}%");
        }
        // Get all projects
        $countries = $countries->paginate(10);
        return view('backend.admin.country.index', compact('countries'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.admin.country.create');
        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
         $request->validate([
            'name' => 'required|string|max:255',
            'code' => 'required|string|max:100',
            'internal_code' => 'nullable|string|max:100',

        ]);

        $data = $request->only([
            'name',
            'code',
            'internal_code'
        ]);
        $data['slug'] = Str::slug($request->name);
        $data['is_active'] = $request->has('is_active') ? $request->has('is_active') : 0;

        // Assuming you have authentication and want to set created_by

        $data['created_by'] = Auth::guard('admin')->user()->id;


        Country::create($data);

        return redirect()->route('admin.country.index')->with('success', 'Country created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Country $country)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $country = Country::findorFail($id);
        if (!$country) {
            return redirect()->route('admin.country.index')->with('error', 'Country not found.');
        }
        return view('backend.admin.country.edit', compact('country'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
         $request->validate([   
            'name' => 'required|string|max:255',
            'code' => 'required|string|max:100',
            'internal_code' => 'nullable|string|max:100',

        ]);
        $country = Country::findorFail($id);
        if (!$country) {
            return redirect()->route('admin.country.index')->with('error', 'Country not found.');
        }
        $data = $request->only([
            'name',
            'code',
            'internal_code'
        ]);
        $data['slug'] = Str::slug($request->name);
        $data['is_active'] = $request->has('is_active') ? $request->has('is_active') : 0;

        // Assuming you have authentication and want to set created_by

        $data['updated_by'] = Auth::guard('admin')->user()->id;

        $country->update($data);

        return redirect()->route('admin.country.index')->with('success', 'Country updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
         try {
            $country = Country::findOrFail($id);

            // Check if the package is associated with any other records
            if ($country->delete()) {
                $data = new stdClass();
                $data->status = 1;
                $data->message = 'Country deleted successfully.';
                return response()->json($data);
            } else {
                $data = new stdClass();
                $data->status = 0;
                $data->message = 'Country could not be deleted. It may be associated with other records.';
                return response()->json($data);
            }
        } catch (\Exception $e) {
            Log::error('Error deleting Product Group: ' . $e->getMessage());
            $data = new stdClass();
            $data->status = 0;
            $data->message = 'An error occurred while deleting Country.';
            return response()->json($data);
        }
    }
}
