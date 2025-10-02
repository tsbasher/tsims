<?php

namespace App\Http\Controllers;

use App\Models\Designation;
use App\Models\Team;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use stdClass;

class TeamController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {        
         $teams = Team::query();
        if ($request->has('search_text') && !empty($request->search_text)) {
            $search = $request->input('search_text');
            // Get projects based on search criteria
            $teams->where('name', 'like', "%{$search}%");
        }
        // Get all Buyers
        $teams = $teams->paginate(10);
        return view('backend.admin.team.index', compact('teams'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        
        $designations = Designation::get();
        return view('backend.admin.team.create',compact('designations'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {        
         $request->validate([
            'designation_id' => 'required|exists:designations,id',
            'name' => 'required|string|max:255',
            'facebook_url' => 'nullable|string|max:100',
            'instagram_url' => 'nullable|string|max:100',
            'x_url' => 'nullable|string|max:100',
            'linkedin_url' => 'nullable|string|max:100',
            'description' => 'nullable|string',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $data = $request->only([
            'designation_id',
            'name',
            'facebook_url',
            'instagram_url',
            'x_url',
            'linkedin_url',
            'description'
        ]);

        $data['is_active'] = $request->has('is_active') ? $request->is_active : 0;
        $data['slug'] = Str::slug($request->name);
        if ($request->hasFile('photo')) {
            $image = $request->file('photo');
            $imageName = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('uploads/teams'), $imageName);
            $data['photo'] = 'uploads/teams/' . $imageName;
        }

        $data['created_by'] = Auth::guard('admin')->user()->id;
        Team::create($data);
        //dd($data);
        return redirect()->route('admin.team.index')->with('success', 'Team created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Team $team)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $team = Team::findOrFail($id);
        $designations = Designation::get();
        return view('backend.admin.team.edit', compact('team','designations'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $team = Team::findOrFail($id);
         $request->validate([
            'designation_id' => 'required|exists:designations,id',
            'name' => 'required|string|max:255',
            'facebook_url' => 'nullable|string|max:100',
            'instagram_url' => 'nullable|string|max:100',
            'x_url' => 'nullable|string|max:100',
            'linkedin_url' => 'nullable|string|max:100',
            'description' => 'nullable|string',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $data = $request->only([
            'designation_id',
            'name',
            'facebook_url',
            'instagram_url',
            'x_url',
            'linkedin_url',
            'description'
        ]);

        $data['is_active'] = $request->has('is_active') ? $request->is_active : 0;
        $data['slug'] = Str::slug($request->name);
        if ($request->hasFile('photo')) {
            // Delete old image if exists
            if ($team->photo && File::exists(public_path($team->photo))) {
                File::delete(public_path($team->photo));
            }
            $image = $request->file('photo');
            $imageName = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('uploads/teams'), $imageName);
            $data['photo'] = 'uploads/teams/' . $imageName;
        }

        $data['updated_by'] = Auth::guard('admin')->user()->id;
        $team->update($data);
        return redirect()->route('admin.team.index')->with('success', 'Team updated successfully.');
    }    

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Team $team)
    {
        //
    }
}
