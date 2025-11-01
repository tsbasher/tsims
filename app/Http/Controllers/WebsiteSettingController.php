<?php

namespace App\Http\Controllers;

use App\Models\WebsiteSetting;
use Illuminate\Http\Request;

class WebsiteSettingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        
        $setting=WebsiteSetting::first();
        return view('backend.admin.website_settings.edit',compact('setting'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(WebsiteSetting $websiteSetting)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(WebsiteSetting $websiteSetting)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'company_name' => 'required|string|max:255',
            'head_address' => 'required|string|max:500',
            'china_address' => 'required|string|max:500',
            'factory_address' => 'required|string|max:500',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:50',
            'facebook' => 'nullable|url|max:255',
            'twitter' => 'nullable|url|max:255',
            'instagram' => 'nullable|url|max:255',
            'linkedin' => 'nullable|url|max:255',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $data = $request->only([
            'company_name',
            'head_address',
            'china_address',
            'factory_address',
            'email',
            'phone',
            'facebook',
            'twitter',
            'instagram',
            'linkedin',
        ]);
        if( $request->hasFile('logo')) {
            $logo = $request->file('logo');
            $logoName = time() . '_' . uniqid() . '.' . $logo->getClientOriginalExtension();
            $logo->move(public_path('uploads/website_settings'), $logoName);
            $data['logo'] = 'uploads/website_settings/' . $logoName;
        }
        $setting = WebsiteSetting::findOrFail($id);
        $setting->update($data);

        return redirect()->back()->with('success', 'Website settings updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(WebsiteSetting $websiteSetting)
    {
        //
    }
}
