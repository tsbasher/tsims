<?php

namespace App\Http\Controllers;

use App\Models\PurchaseOrder;
use App\Models\PurchaseOrderReceive;
use App\Models\PurchaseOrderReceiveDetails;
use App\Models\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PurchaseOrderReceiveController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $pors=PurchaseOrderReceive::with('purchase_order', 'supplier', 'work_order', 'purchase_order.currency');
        if ($request->supplier_id && isset($request->supplier_id)) {
            $pors = $pors->where('supplier_id', $request->supplier_id);
            $pos=PurchaseOrder::where('supplier_id', $request->supplier_id)->get();
        }
        else
            {
                $pos=[];
            }
        if ($request->purchase_order_id && isset($request->purchase_order_id)) {
            $pors = $pors->where('purchase_order_id', $request->purchase_order_id);
        }
        if ($request->order_date_from && isset($request->order_date_from)) {
            $pors = $pors->whereDate('received_date', '>=', $request->order_date_from);
        }
        if ($request->order_date_to && isset($request->order_date_to)) {
            $pors = $pors->whereDate('received_date', '<=', $request->order_date_to);
        }
        if ($request->order_number && isset($request->order_number)) {
            $pors = $pors->where('receive_number', 'like', '%' . $request->order_number . '%')
            ->orWhereHas('purchase_order', function ($query) use ($request) {
                $query->where('po_number', 'like', '%' . $request->order_number . '%');
            })->orWhereHas('work_order', function ($query) use ($request) {
                $query->where('order_number', 'like', '%' . $request->order_number . '%');
            });
        }
        $suppliers = Supplier::all();
        $pors = $pors->orderBy('id', 'desc')->paginate();
        return view('backend.admin.purchase_order_receive.index', compact('pors', 'suppliers','pos'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $order_number = 'ITPR-' . date('Y') . '-' . str_pad(PurchaseOrderReceive::count() + 1, 4, '0', STR_PAD_LEFT);
        $suppliers = Supplier::all();
        return view('backend.admin.purchase_order_receive.create', compact('suppliers', 'order_number'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'purchase_order_id' => 'required|exists:purchase_orders,id',
            'receive_number' => 'required|unique:purchase_order_receives,receive_number',
            'supplier_id' => 'required|exists:suppliers,id',
            'received_date' => 'required|date',
            'received_quantities' => 'required|array',
            'received_quantities.*' => 'required|numeric|min:0',
            // Add other validation rules as needed
        ]);

        DB::transaction(function () use ($request) {
            // Create the PurchaseOrderReceive record
            $purchaseOrderReceive = PurchaseOrderReceive::create([
                'purchase_order_id' => $request->purchase_order_id,
                'receive_number' => $request->receive_number,
                'supplier_id' => $request->supplier_id,
                'work_order_id' => $request->work_order_id,
                'received_date' => $request->received_date,
                'description' => $request->description,
            ]);
            // Create the PurchaseOrderReceiveDetails records
            foreach ($request->received_quantities as $index => $quantity) {
                if($request->received_quantities[$index]>0){
                PurchaseOrderReceiveDetails::create([
                    'purchase_order_receive_id' => $purchaseOrderReceive->id,
                    'purchase_order_detail_id' => $request->purchase_order_details[$index],
                    'quantity_received' => $request->received_quantities[$index],
                    'work_order_detail_id' => $request->work_order_detail_ids[$index],
                ]);
                }
            }
        });
        return redirect()->route('admin.purchase_order_receive.index')->with('success', 'Purchase Order Receive created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(PurchaseOrderReceive $purchaseOrderReceive)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(PurchaseOrderReceive $purchaseOrderReceive)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, PurchaseOrderReceive $purchaseOrderReceive)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PurchaseOrderReceive $purchaseOrderReceive)
    {
        //
    }
}
