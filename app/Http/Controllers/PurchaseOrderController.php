<?php

namespace App\Http\Controllers;

use App\Models\Currency;
use App\Models\Customer;
use App\Models\Payment_terms;
use App\Models\PurchaseOrder;
use App\Models\PurchaseOrderDetails;
use App\Models\PurchaseOrderTerms;
use App\Models\Supplier;
use App\Models\TermsCondition;
use App\Models\WebsiteSetting;
use App\Models\WorkOrder;
use App\Models\WorkOrderDetails;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use stdClass;

class PurchaseOrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $pos = PurchaseOrder::query();
        if ($request->has('customer_id') && isset($request->customer_id)) {
            $pos->where('customer_id', $request->customer_id);
        }

        if ($request->has('po_date_to') && isset($request->po_date_to)) {
            $pos->where('po_date', '<=', $request->po_date_to);
        }
        if ($request->has('po_date_from') && isset($request->po_date_from)) {
            $pos->where('po_date', '>=', $request->po_date_from);
        }

        if ($request->has('supplier_id') && isset($request->supplier_id)) {
            $pos->where('supplier_id', $request->supplier_id);
        }
        if ($request->has('order_number') && isset($request->order_number)) {
            $pos->where(function ($query) use ($request) {

                $query->where('po_number', 'like', '%' . $request->order_number . '%')
                    ->orwherehas('work_order', function ($q) use ($request) {
                        $q->where('order_number', 'like', '%' . $request->order_number . '%');
                    });
            });
        }
        // dd($pos->toSql(), $pos->getBindings());
        $pos = $pos->orderBy('po_date', 'desc')->orderby('po_number', 'asc')->paginate(10);

        $suppliers = Supplier::get();
        $customers = Customer::get();
        return view('backend.admin.purchase_order.index', compact('pos', 'suppliers', 'customers'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $max_order = PurchaseOrder::whereYear('created_at', date('Y'))->max('id');
        $order_number = 'ITPO-' . date('Y') . '-' . str_pad($max_order + 1, 4, '0', STR_PAD_LEFT);

        $suppliers = Supplier::get();
        $customers = Customer::get();



        $terms = TermsCondition::get();
        $payments_terms = Payment_terms::get();
        $currencies = Currency::get();
        return view('backend.admin.purchase_order.create', compact('order_number', 'suppliers', 'customers', 'terms', 'payments_terms', 'currencies'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'supplier_id' => 'required|exists:suppliers,id',
            'customer_id' => 'required|exists:customers,id',
            'payments_terms_id' => 'nullable|exists:payment_terms,id',
            'currency_id' => 'required|exists:currencies,id',
            'po_date' => 'required|date',
            'currency_id' => 'required|exists:currencies,id',
            'workorder_ids' => 'required|exists:work_orders,id',
            'workorder_details' => 'required|array',
            'workorder_details.*' => 'exists:work_order_details,id',
            'rates' => 'required|array',
            'rates.*' => 'required|numeric|min:1',
            // Add validation rules for other fields as needed
        ]);

        $max_order = PurchaseOrder::whereYear('created_at', date('Y'))->max('id');
        $order_number = 'ITPO-' . date('Y') . '-' . str_pad($max_order + 1, 4, '0', STR_PAD_LEFT);
        $data = $request->only([
            'supplier_id',
            'customer_id',
            'payments_terms_id',
            'currency_id',
            'po_date',
            'refference_number',
            'description',
            // Add other fields as needed
        ]);
        $data['po_number'] = $order_number;
        $data['work_order_id'] = $request->workorder_ids; // Assuming you want to link the first work order

        DB::transaction(function () use ($data, $request) {
            $purchaseOrder = PurchaseOrder::create($data);
            // Handle purchase order items if needed
            if ($request->has('workorder_details')) {
                for ($index = 0; $index < count($request->workorder_details); $index++) {
                    PurchaseOrderDetails::create([
                        'purchase_order_id' => $purchaseOrder->id,
                        'work_order_details_id' => $request->workorder_details[$index],
                        // 'product_id' => $request->product_ids[$index],
                        // 'color_id' => $request->color_ids[$index],
                        // 'style_id' => $request->style_ids[$index],
                        // 'measurement' => $request->measurements[$index],
                        // 'weight' => $request->weights[$index],
                        // 'weight_unit_id' => $request->weight_unit_ids[$index],
                        'quantity' => $request->quantities[$index],
                        // 'quantity_unit_id' => $request->unit_ids[$index],
                        // 'description' => $request->details_description[$index],
                        'unit_price' => $request->rates[$index],
                        'total_price' => $request->totals[$index],
                    ]);
                }
                WorkOrderDetails::wherein('id', $request->workorder_details)->update(['has_po' => 1]);
                if ($request->has('terms')) {
                    for ($tindex = 0; $tindex < count($request->terms); $tindex++) {
                        PurchaseOrderTerms::create([
                            'purchase_order_id' => $purchaseOrder->id,
                            'serial_no' => $request->terms_serial[$tindex],
                            'term_description' => $request->terms[$tindex],
                        ]);
                    }
                }
            }
        });
        return redirect()->route('admin.purchase_order.index')->with('success', 'Purchase Order created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $po = PurchaseOrder::with(['supplier', 'customer', 'work_order', 'payment_terms', 'details', 'terms', 'currency'])->findOrFail($id);
        $settings = WebsiteSetting::first();
        // dd($settings);
        // dd($po);
        return view('backend.admin.purchase_order.show', compact('po', 'settings'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $po = PurchaseOrder::with('details', 'work_order', 'currency', 'terms')->findorfail($id);

        $suppliers = Supplier::get();
        $customers = Customer::get();



        $terms = TermsCondition::get();
        $payments_terms = Payment_terms::get();
        $currencies = Currency::get();
        $work_orders = WorkOrder::where('customer_id', $po->customer_id)->wherehas('details', function ($query) use ($po) {
            $query->where('has_po', 0)->orwhere('work_order_id', $po->work_order_id);
        })->get();
        return view('backend.admin.purchase_order.edit', compact('po', 'suppliers', 'customers', 'terms', 'payments_terms', 'currencies', 'work_orders'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'supplier_id' => 'required|exists:suppliers,id',
            'customer_id' => 'required|exists:customers,id',
            'payments_terms_id' => 'nullable|exists:payment_terms,id',
            'currency_id' => 'required|exists:currencies,id',
            'po_date' => 'required|date',
            'currency_id' => 'required|exists:currencies,id',
            'workorder_ids' => 'required|exists:work_orders,id',
            'workorder_details' => 'required|array',
            'workorder_details.*' => 'exists:work_order_details,id',
            'rates' => 'required|array',
            'rates.*' => 'required|numeric|min:1',
            // Add validation rules for other fields as needed
        ]);

        $data = $request->only([
            'supplier_id',
            'customer_id',
            'payments_terms_id',
            'currency_id',
            'po_date',
            'refference_number',
            'description',
            // Add other fields as needed
        ]);

        $data['work_order_id'] = $request->workorder_ids;

        DB::transaction(function () use ($data, $request, $id) {
            $purchaseOrder = PurchaseOrder::with('details')->findOrFail($id);
            WorkOrderDetails::wherein('id', $purchaseOrder->details->pluck('work_order_details_id'))->update(['has_po' => 0]);

            $purchaseOrder->update($data);
            PurchaseOrderDetails::where('purchase_order_id', $purchaseOrder->id)->delete();
            PurchaseOrderTerms::where('purchase_order_id', $purchaseOrder->id)->delete();
            if ($request->has('workorder_details')) {
                for ($index = 0; $index < count($request->workorder_details); $index++) {
                    PurchaseOrderDetails::create([
                        'purchase_order_id' => $purchaseOrder->id,
                        'work_order_details_id' => $request->workorder_details[$index],
                        // 'product_id' => $request->product_ids[$index],
                        // 'color_id' => $request->color_ids[$index],
                        // 'style_id' => $request->style_ids[$index],
                        // 'measurement' => $request->measurements[$index],
                        // 'weight' => $request->weights[$index],
                        // 'weight_unit_id' => $request->weight_unit_ids[$index],
                        'quantity' => $request->quantities[$index],
                        // 'quantity_unit_id' => $request->unit_ids[$index],
                        // 'description' => $request->details_description[$index],
                        'unit_price' => $request->rates[$index],
                        'total_price' => $request->totals[$index],
                    ]);
                }
                WorkOrderDetails::wherein('id', $request->workorder_details)->update(['has_po' => 1]);
            }
            if ($request->has('terms')) {
                for ($tindex = 0; $tindex < count($request->terms); $tindex++) {
                    PurchaseOrderTerms::create([
                        'purchase_order_id' => $purchaseOrder->id,
                        'serial_no' => $request->terms_serial[$tindex],
                        'term_description' => $request->terms[$tindex],
                    ]);
                }
            }
        });
        // Handle purchase order items if needed
        // Similar to the store method, but you may want to handle updates and deletions of existing items

        return redirect()->route('admin.purchase_order.index')->with('success', 'Purchase Order updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {

        try {
            $pi = PurchaseOrder::findOrFail($id);
            $work_orders = $pi->details()->pluck('work_order_details_id')->unique();
            DB::transaction(function () use ($pi, $work_orders) {
                PurchaseOrderDetails::where('purchase_order_id', $pi->id)->delete();
                WorkOrderDetails::wherein('id', $work_orders)->update(['has_po' => 0]);
                PurchaseOrderTerms::where('purchase_order_id', $pi->id)->delete();
                $pi->delete();
            });


            $data = new stdClass();
            $data->status = 1;
            $data->message = 'Proforma Invoice deleted successfully.';
            return response()->json($data);
        } catch (\Exception $e) {
            Log::error('Error deleting Proforma Invoice : ' . $e->getMessage());
            $data = new stdClass();
            $data->status = 0;
            $data->message = 'An error occurred while deleting Proforma Invoice.';
            return response()->json($data);
        }
    }

    public function get_purchase_order_by_supplier($supplier_id)
    {
        $purchase_orders = PurchaseOrder::where('supplier_id', $supplier_id)->select('id', 'po_number')->get();
        $pos = [];
        // $purchase_orders->load()
        foreach ($purchase_orders as $po) {
            $po->load('details.receive_details');
            $full_received = true;
            foreach ($po->details as $detail) {

                $order_qnty = $detail->quantity;
                $received_qunty = $detail->receive_details->sum('quantity_received');
                if ($order_qnty > $received_qunty) {
                    $full_received = false;
                    break;
                }
            }
            if (!$full_received) {
                array_push($pos, $po);
            }
        }
        return response()->json($pos);
    }

    public function get_purchase_order($id)
    {
        $purchase_order = PurchaseOrder::with('currency', 'work_order', 'details.receive_details', 'details.work_order_details', 'details.work_order_details.product', 'details.work_order_details.color', 'details.work_order_details.style', 'details.work_order_details.quantity_unit')->findOrFail($id);

        return response()->json($purchase_order);
    }

    public function get_all_purchase_order_by_supplier($supplier_id)
    {
        $purchase_orders = PurchaseOrder::where('supplier_id', $supplier_id)->select('id', 'po_number')->get();
        return response()->json($purchase_orders);
    }
}
