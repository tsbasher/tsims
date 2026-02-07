<?php

namespace App\Http\Controllers;

use App\Models\Buyers;
use App\Models\Color;
use App\Models\Customer;
use App\Models\Merchandiser;
use App\Models\Product;
use App\Models\ProformaInvoice;
use App\Models\ProformaInvoiceDetails;
use App\Models\Style;
use App\Models\Unit;
use App\Models\WorkOrder;
use App\Models\WorkOrderDetails;
use Illuminate\Http\Request;
use Illuminate\Queue\Worker;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use stdClass;

class WorkOrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $workOrders = WorkOrder::with(['customer', 'buyer', 'merchant', 'details']);
        if ($request->has('customer_id')&& isset($request->customer_id)) {
            $workOrders->where('customer_id', $request->customer_id);
        }
        if ($request->has('order_date_from') && isset($request->order_date_from)) {
            
            $workOrders->where('order_date', '>=',$request->order_date_from);
        }

        
        if ($request->has('order_date_to') && isset($request->order_date_to)) {
            $workOrders->where('order_date', '<=',$request->order_date_to);
        }
        if ($request->has('buyer_id')&& isset($request->buyer_id)) {
            $workOrders->where('buyer_id', $request->buyer_id);
        }
        if ($request->has('merchandiser_id')&& isset($request->merchandiser_id)) {
            $workOrders->where('merchandiser_id', $request->merchandiser_id);
        }
        if ($request->has('order_number')&& isset($request->order_number)) {
            $workOrders->where('order_number', 'like', '%' . $request->order_number . '%');
        }

        $workOrders = $workOrders->orderBy('order_date', 'desc')->orderby('order_number', 'asc')->paginate(10);
        $buyers = Buyers::get();
        $customers = Customer::get();
        return view('backend.admin.workorder.index', compact('workOrders', 'buyers', 'customers'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        $max_order = WorkOrder::whereYear('created_at', date('Y'))->max('id');
        $order_number = 'ITWO-' . date('Y') . '-' . str_pad($max_order + 1, 4, '0', STR_PAD_LEFT);

        $buyers = Buyers::get();
        $customers = Customer::get();


        $products = Product::where('is_active', 1)->get();
        $styles = Style::get();
        $colors = Color::get();
        $units = Unit::get();
        return view('backend.admin.workorder.create', compact('order_number', 'buyers', 'customers', 'products', 'styles', 'colors', 'units'));
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
        $max_order = WorkOrder::whereYear('created_at', date('Y'))->max('id');
        $order_number = 'ITWO-' . date('Y') . '-' . str_pad($max_order + 1, 4, '0', STR_PAD_LEFT);
        $data = $request->only([
            'customer_id',
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
                    WorkOrderDetails::create([
                        'work_order_id' => $workOrder->id,
                        'product_id' => $request->product_ids[$index],
                        'color_id' => $request->color_ids[$index],
                        'style_id' => $request->style_ids[$index],
                        'measurement' => $request->measurements[$index],
                        'quantity' => $request->quantities[$index],
                        'quantity_unit_id' => $request->unit_ids[$index],
                        'weight' => $request->weights[$index],
                        'weight_unit_id' => $request->weight_unit_ids[$index],
                        'description' => $request->details_description[$index],
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
    public function edit($id)
    {

        ///Need to check if work order already added to PI ha lc, if already added then disallow edit.

        $workorder = WorkOrder::with('details')->findOrFail($id);
        $buyers = Buyers::get();
        $customers = Customer::get();


        $products = Product::where('is_active', 1)->get();
        $styles = Style::where('customer_id', $workorder->customer_id)->get();
        $colors = Color::get();
        $units = Unit::get();
        $merchandisers = Merchandiser::where('customer_id', $workorder->customer_id)->get();
        return view('backend.admin.workorder.edit', compact('buyers', 'customers', 'products', 'styles', 'colors', 'units', 'workorder', 'merchandisers'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {

        $request->validate([
            'customer_id' => 'required|exists:customers,id',
            'buyer_id' => 'nullable|exists:buyers,id',
            'merchandiser_id' => 'nullable|exists:merchandisers,id',
            'refference_number' => 'nullable|string|max:100',
            'order_date' => 'required|date',
            'delivery_date' => 'nullable|date',
        ]);

        $data = $request->only([
            'customer_id',
            'merchandiser_id',
            'refference_number',
            'description',
            'order_date',
            'delivery_date',
        ]);
        DB::transaction(function () use ($data, $request, $id) {
            $workOrder = WorkOrder::where('id', $id)->update([
                'customer_id' => $data['customer_id'],
                'merchandiser_id' => $data['merchandiser_id'],
                'refference_number' => $data['refference_number'],
                'description' => $data['description'],
                'order_date' => $data['order_date'],
                'delivery_date' => $data['delivery_date'],
            ]);
            // Store work order details
            if ($request->has('product_ids')) {
                WorkOrderDetails::where('work_order_id', $id)->delete();
                for ($index = 0; $index < count($request->product_ids); $index++) {
                    WorkOrderDetails::create([
                        'work_order_id' => $id,
                        'product_id' => $request->product_ids[$index],
                        'color_id' => $request->color_ids[$index],
                        'style_id' => $request->style_ids[$index],
                        'measurement' => $request->measurements[$index],
                        'quantity' => $request->quantities[$index],
                        'quantity_unit_id' => $request->unit_ids[$index],
                        'weight' => $request->weights[$index],
                        'weight_unit_id' => $request->weight_unit_ids[$index],
                        'description' => $request->details_description[$index],
                        'unit_price' => $request->rates[$index],
                        'total_price' => $request->totals[$index],
                    ]);
                }
            }
        });
        return redirect()->route('admin.workorder.index')->with('success', 'Work Order Updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            $workorder = WorkOrder::with('details')->findOrFail($id);
            DB::transaction(function () use ($workorder) {
                WorkOrderDetails::where('work_order_id', $workorder->id)->delete();
                $workorder->delete();
            });


            $data = new stdClass();
            $data->status = 1;
            $data->message = 'WorkOrder deleted successfully.';
            return response()->json($data);
        } catch (\Exception $e) {
            Log::error('Error deleting WorkOrder : ' . $e->getMessage());
            $data = new stdClass();
            $data->status = 0;
            $data->message = 'An error occurred while deleting Workorder.';
            return response()->json($data);
        }
    }
    public function get_workorder_by_customer($customer_id)
    {
        $pi_wo=ProformaInvoiceDetails::with(['proformaInvoice'=>function($query) use ($customer_id){
            $query->where('customer_id',$customer_id);
        }])->get()->pluck('work_order_id')->unique()->toArray();
        //Check if pi has LC against workorder, if yes then do not show workorder in list
        $workorders = WorkOrder::where('customer_id', $customer_id)->wherenotin('id',$pi_wo)->get();
        return response()->json($workorders);
    }

    public function get_workorder_details($id)
    {
        $workorder = WorkOrder::with('details')->where('id',$id)->get();
        // dd($workorder);
        return $workorder;
    }

    public function get_workorder_details_by_id($id)
    {
        $ids=explode(',',$id);
        $workorder = WorkOrderDetails::with('work_order','product','color','style','weight_unit','quantity_unit')->wherein('id',$ids)
        ->where('has_po',0)->get();
        // dd($workorder);
        return $workorder;
    }
    public function get_workorder_details_for_po($id)
    {
        $workorder = WorkOrder::with(['details'=>function($query){
            $query->where('has_po',0);
        }])->where('id',$id)->first();
        // dd($workorder);
        return $workorder;
    }
    public function get_workorder_by_customer_for_po($customer_id)
    {
        //Check if pi has LC against workorder, if yes then do not show workorder in list
        $workorders = WorkOrder::where('customer_id', $customer_id)->wherehas('details',function($query){
            $query->where('has_po',0);
        })->get();
        return response()->json($workorders);
    }

}
