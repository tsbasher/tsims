<?php

namespace App\Http\Controllers;

use App\Models\ShippingType;
use Illuminate\Http\Request;

class ShippingTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
     {
        $shippingTypes = ShippingType::query();

        if ($request->has('search_text') && !empty($request->get('search_text'))) {
            $shippingTypes->where('name', 'like', '%' . $request->get('search_text') . '%');
        }

        $shippingTypes = $shippingTypes->orderByDesc('id')->paginate(10);

        return view('backend.admin.shipping_type.index', compact('shippingTypes'));
     }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.admin.shipping_type.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'name' => 'required|string|max:255',
        ]);
        $data=$request->only([
            'name',
        ]);
        ShippingType::create($data);
        return redirect()->route('admin.shipping_type.index')->with('success', 'Shipping Type created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(ShippingType $shippingType)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        //
        $shippingTypes = ShippingType::findOrFail($id);
        return view('backend.admin.shipping_type.edit', compact('shippingTypes'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        
        $request->validate([
            'name' => 'required|string|max:255',
        ]);
        $data=$request->only([
            'name',
        ]);
        $shippingTypes = ShippingType::findOrFail($id);
        $shippingTypes->update($data);
        return redirect()->route('admin.shipping_type.index')->with('success', 'Shipping Type updated successfully.');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ShippingType $shippingType)
    {
        //
    }
}
