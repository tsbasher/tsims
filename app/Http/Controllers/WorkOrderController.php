<?php

namespace App\Http\Controllers;

use App\Models\Buyers;
use App\Models\Color;
use App\Models\Customer;
use App\Models\Product;
use App\Models\Style;
use App\Models\Unit;
use App\Models\WorkOrder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class WorkOrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $workOrders = WorkOrder::with(['customer', 'buyer', 'merchant', 'details']);
        if($request->has('customer_id')){
            $workOrders->where('customer_id', $request->customer_id);
        }
        if($request->has('order_date_from') && $request->has('order_date_to')){
            $workOrders->whereBetween('order_date', [$request->order_date_from, $request->order_date_to]);
        }
        if($request->has('buyer_id')){
            $workOrders->where('buyer_id', $request->buyer_id);
        }
        if($request->has('merchandiser_id')){
            $workOrders->where('merchandiser_id', $request->merchandiser_id);
        }
        if($request->has('order_number')){
            $workOrders->where('order_number', 'like', '%'.$request->order_number.'%');
        }

        $workOrders = $workOrders->orderBy('order_date', 'desc')->orderby('order_number','asc')->paginate(10);
        $buyers=Buyers::get();
        $customers=Customer::get();
        return view('backend.admin.workorder.index', compact('workOrders','buyers','customers'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        
        $max_order=WorkOrder::max('id');
        $order_number='ITWO-'.date('Y').'-'.str_pad($max_order+1, 4, '0', STR_PAD_LEFT);
        
        $buyers=Buyers::get();
        $customers=Customer::get();
        
        
        $products=Product::where('is_active',1)->get();
        $styles=Style::get();
        $colors=Color::get();
        $units=Unit::get();
        return view('backend.admin.workorder.create', compact('order_number','buyers','customers','products','styles','colors','units'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
         $request->validate([
            'order_number' => 'required|string|unique:work_orders,order_number',
            'customer_id' => 'required|exists:customers,id',
            'buyer_id' => 'nullable|exists:buyers,id',
            'merchandiser_id' => 'nullable|exists:merchandisers,id',
            'refference_number' => 'nullable|string|max:100',
            'order_date' => 'required|date',
            'delivery_date' => 'nullable|date',
        ]);
        $max_order=WorkOrder::max('id');
        $order_number='ITWO-'.date('Y').'-'.str_pad($max_order+1, 4, '0', STR_PAD_LEFT);
        $data = $request->only([
            'customer_id',
            'buyer_id',
            'merchandiser_id',
            'refference_number',
            'description',
            'order_date',
            'delivery_date',
        ]);
        $data['order_number'] = $order_number;
        DB::transaction(function () use ($data, $request) {
            $workOrder = WorkOrder::create($data);
            // Store work order details
            if ($request->has('product_ids')) {
                for ($index = 0; $index < count($request->product_ids); $index++) {
                    $workOrder->details()->create([
                        'work_order_id'=>$workOrder->id,
                        'product_id' => $request->product_ids[$index],
                        'color_id' => $request->color_ids[$index],
                        'style_id' => $request->style_ids[$index],
                        'measurement' => $request->measurements[$index],
                        'quantity' => $request->quantities[$index],
                        'quantity_unit_id' => $request->unit_ids[$index],
                        'unit_price' => $request->rates[$index],
                        'total_price' => $request->totals[$index],
                    ]);
                }
            }
        });
        return redirect()->route('admin.workorder.index')->with('success', 'Work Order created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(WorkOrder $workOrder)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(WorkOrder $workOrder)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, WorkOrder $workOrder)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(WorkOrder $workOrder)
    {
        //
    }
}
