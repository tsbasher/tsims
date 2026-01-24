<?php

namespace App\Http\Controllers;

use App\Models\Buyers;
use App\Models\Color;
use App\Models\Currency;
use App\Models\Customer;
use App\Models\Payment_terms;
use App\Models\Product;
use App\Models\ProformaInvoice;
use App\Models\ProformaInvoiceDetails;
use App\Models\ProformaInvoiceTerms;
use App\Models\Style;
use App\Models\TermsCondition;
use App\Models\Unit;
use App\Models\WebsiteSetting;
use App\Models\WorkOrder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use NumberFormatter;
use NumberToWords\NumberToWords;
use stdClass;

class ProformaInvoiceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $pis = ProformaInvoice::with(['customer', 'buyer', 'details','currency']);
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
        
        $max_order = ProformaInvoice::whereYear('created_at', date('Y'))->max('id');
        $order_number = 'ITPI-' . date('Y') . '-' . str_pad($max_order + 1, 4, '0', STR_PAD_LEFT);

        $buyers = Buyers::get();
        $customers = Customer::get();


        $products = Product::where('is_active', 1)->get();
        $styles = Style::get();
        $colors = Color::get();
        $units = Unit::get();
        $terms=TermsCondition::get();
        $payments_terms=Payment_terms::get();
        $currencies = Currency::get();
        return view('backend.admin.proforma_invoice.create', compact('order_number', 'buyers', 'customers', 'products', 'styles', 'colors', 'units','terms','payments_terms','currencies'));
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
        $max_order = ProformaInvoice::whereYear('created_at', date('Y'))->max('id');
        $order_number = 'ITPI-' . date('Y') . '-' . str_pad($max_order + 1, 4, '0', STR_PAD_LEFT);
        $data = $request->only([
            'customer_id',
            'buyer_id',
            'refference_number',
            'description',
            'pi_date',
            'pi_expire_date',
            'payments_terms_id',
            'currency_id',
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
                        'weight' => $request->weights[$index],
                        'weight_unit_id' => $request->weight_unit_ids[$index],
                        'description' => $request->details_description[$index],
                        'unit_price' => $request->rates[$index],
                        'total_price' => $request->totals[$index],
                    ]);
                }

                if($request->has('terms')){
                    for($tindex=0; $tindex < count($request->terms); $tindex++){
                        ProformaInvoiceTerms::create([
                            'proforma_invoice_id' => $proformaInvoice->id,
                            'serial_no' => $request->terms_serial[$tindex],
                            'term_description' => $request->terms[$tindex],
                        ]);
                    }
                }
            }
        });
        return redirect()->route('admin.proforma_invoice.index')->with('success', 'Proforma Invoice created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $pi=ProformaInvoice::with(['details', 'termsConditions','currency'])->findOrFail($id);
        $settings=WebsiteSetting::first();
        // dd($settings);
            
        return view('backend.admin.proforma_invoice.show', compact('pi','settings'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $pi=ProformaInvoice::with(['customer','buyer','details', 'termsConditions','currency'])->findOrFail($id);
        
        $buyers = Buyers::get();
        $customers = Customer::get();

        $workorders = WorkOrder::where('customer_id', $pi->customer_id)->get();

        $products = Product::where('is_active', 1)->get();
        $styles = Style::get();
        $colors = Color::get();
        $units = Unit::get();
        $terms=TermsCondition::get();
        
        $payments_terms=Payment_terms::get();
        $currencies = Currency::get();
        return view('backend.admin.proforma_invoice.edit', compact('pi', 'buyers', 'customers', 'products', 'styles', 'colors', 'units','terms','payments_terms','workorders','currencies'));
    
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'pi_number' => 'required|string|unique:proforma_invoices,pi_number,'.$id,
            'customer_id' => 'required|exists:customers,id',
            'buyer_id' => 'nullable|exists:buyers,id',
            'refference_number' => 'nullable|string|max:100',
            'pi_date' => 'required|date',
            'pi_expire_date' => 'nullable|date',
        ]);
        $data = $request->only([
            'pi_number',
            'customer_id',
            'buyer_id',
            'refference_number',
            'description',
            'pi_date',
            'pi_expire_date',
            'payments_terms_id',
            'currency_id',
        ]);
        DB::transaction(function () use ($data, $request, $id) {
            $proformaInvoice = ProformaInvoice::findOrFail($id);
            $proformaInvoice->update($data);

            ProformaInvoiceDetails::where('proforma_invoice_id', $proformaInvoice->id)->delete();
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
                        'weight' => $request->weights[$index],
                        'weight_unit_id' => $request->weight_unit_ids[$index],
                        'description' => $request->details_description[$index],
                        'unit_price' => $request->rates[$index],
                        'total_price' => $request->totals[$index],
                    ]);
                }
            }

            ProformaInvoiceTerms::where('proforma_invoice_id', $proformaInvoice->id)->delete();
            if($request->has('terms')){
                for($tindex=0; $tindex < count($request->terms); $tindex++){
                    ProformaInvoiceTerms::create([
                        'proforma_invoice_id' => $proformaInvoice->id,
                        'serial_no' => $request->terms_serial[$tindex],
                        'term_description' => $request->terms[$tindex],
                    ]);
                }
            }
        });
        return redirect()->route('admin.proforma_invoice.index')->with('success', 'Proforma Invoice updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        
        try {
            $pi = ProformaInvoice::with('details','termsConditions',)->findOrFail($id);
            DB::transaction(function () use ($pi) {
                ProformaInvoiceDetails::where('proforma_invoice_id', $pi->id)->delete();
                ProformaInvoiceTerms::where('proforma_invoice_id', $pi->id)->delete();
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
    public function get_pi_details_by_pi_workorder($pi_id, $workorder_id)
    {
        $pi_details = ProformaInvoiceDetails::with(['product', 'style', 'color', 'quantity_unit', 'workorder','weight_unit'])
            ->where('work_order_id', $workorder_id)->where('proforma_invoice_id',$pi_id)
            ->get();
        return response()->json(['pi_details' => $pi_details]);
    }
}
