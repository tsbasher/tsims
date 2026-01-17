<?php

namespace App\Http\Controllers;

use App\Models\Buyers;
use App\Models\Color;
use App\Models\Customer;
use App\Models\Product;
use App\Models\ProformaInvoice;
use App\Models\ProformaInvoiceDetails;
use App\Models\Style;
use App\Models\TermsCondition;
use App\Models\Unit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProformaInvoiceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $pis = ProformaInvoice::with(['customer', 'buyer', 'details']);
        if ($request->has('customer_id')) {
            $pis->where('customer_id', $request->customer_id);
        }
        if ($request->has('pi_date_from') && $request->has('pi_date_to')) {
            $pis->whereBetween('pi_date', [$request->order_date_from, $request->order_date_to]);
        }
        if ($request->has('buyer_id')) {
            $pis->where('buyer_id', $request->buyer_id);
        }
        if ($request->has('pi_number')) {
            $pis->where('pi_number', 'like', '%' . $request->pi_number . '%');
        }

        $pis = $pis->orderBy('pi_date', 'desc')->orderby('pi_number', 'asc')->paginate(10);
        $buyers = Buyers::get();
        $customers = Customer::get();
        return view('backend.admin.proforma_invoice.index', compact('pis', 'buyers', 'customers'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        
        $max_order = ProformaInvoice::max('id');
        $order_number = 'ITPI-' . date('Y') . '-' . str_pad($max_order + 1, 4, '0', STR_PAD_LEFT);

        $buyers = Buyers::get();
        $customers = Customer::get();


        $products = Product::where('is_active', 1)->get();
        $styles = Style::get();
        $colors = Color::get();
        $units = Unit::get();
        $terms=TermsCondition::get();
        return view('backend.admin.proforma_invoice.create', compact('order_number', 'buyers', 'customers', 'products', 'styles', 'colors', 'units','terms'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
         $request->validate([
            'pi_number' => 'required|string|unique:proforma_invoices,pi_number',
            'customer_id' => 'required|exists:customers,id',
            'buyer_id' => 'nullable|exists:buyers,id',
            'refference_number' => 'nullable|string|max:100',
            'pi_date' => 'required|date',
            'pi_expire_date' => 'nullable|date',
        ]);
        $max_order = ProformaInvoice::max('id');
        $order_number = 'ITPI-' . date('Y') . '-' . str_pad($max_order + 1, 4, '0', STR_PAD_LEFT);
        $data = $request->only([
            'customer_id',
            'buyer_id',
            'refference_number',
            'description',
            'pi_date',
            'pi_expire_date',
        ]);
        $data['pi_number'] = $order_number;

        DB::transaction(function () use ($data, $request) {
            $proformaInvoice = ProformaInvoice::create($data);
            if ($request->has('product_ids')) {
                for ($index = 0; $index < count($request->product_ids); $index++) {
                    ProformaInvoiceDetails::create([
                        
                        'proforma_invoice_id' => $proformaInvoice->id,
                        'work_order_id' => $request->workorders[$index],
                        'product_id' => $request->product_ids[$index],
                        'color_id' => $request->color_ids[$index],
                        'style_id' => $request->style_ids[$index],
                        'measurement' => $request->measurements[$index],
                        'quantity' => $request->quantities[$index],
                        'quantity_unit_id' => $request->unit_ids[$index],
                        'description' => $request->details_description[$index],
                        'unit_price' => $request->rates[$index],
                        'total_price' => $request->totals[$index],
                    ]);
                }
            }
        });
        return redirect()->route('admin.proforma_invoice.index')->with('success', 'Proforma Invoice created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(ProformaInvoice $proformaInvoice)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ProformaInvoice $proformaInvoice)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ProformaInvoice $proformaInvoice)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ProformaInvoice $proformaInvoice)
    {
        //
    }
}
