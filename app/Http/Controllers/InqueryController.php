<?php

namespace App\Http\Controllers;

use App\Mail\SendInqueryMail;
use App\Models\Inquery;
use App\Models\Product;
use App\Models\WebsiteSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use stdClass;

class InqueryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $inqueries = Inquery::with('details')->orderBy('is_read', 'asc')->orderby('is_reply', 'asc')->orderby('created_at', 'desc');
        if ($request->has('search_text')) {
            $search = $request->input('search_text');
            $inqueries = $inqueries->where(function ($query) use ($search) {
                $query->where('name', 'like', '%' . $search . '%')
                    ->orWhere('email', 'like', '%' . $search . '%')
                    ->orWhere('phone', 'like', '%' . $search . '%')
                    ->orWhere('company', 'like', '%' . $search . '%')
                    ->orWhere('message', 'like', '%' . $search . '%');
            });
        }
        $inqueries = $inqueries->paginate(15);
        return view('backend.admin.inquery.index', compact('inqueries'));
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
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'nullable|string|max:20',
            'message' => 'nullable|string',
            'h-captcha-response' => 'required|string',
        ]);
        $response = Http::asForm()->post('https://api.hcaptcha.com/siteverify', [
            "response" => $request->input('h-captcha-response'),
            "secret" => "ES_0eed7837abe84588bce94f014779b2c4",

        ])->json();
        if ($response["success"]) {
            // Process the inquiry here (e.g., save to database, send email, etc.)
            // Clear the cart after successful inquiry submission
            DB::Transaction(function () use ($request) {

                $inquery = Inquery::create([
                    'name' => $request->input('name'),
                    'email' => $request->input('email'),
                    'phone' => $request->input('phone'),
                    'message' => $request->input('message'),
                    'company' => $request->input('company'),
                ]);
                $inquery_products = \Cart::getContent();
                foreach ($inquery_products as $item) {
                    $inquery->details()->create([
                        'product_id' => $item->id,
                    ]);
                }

                \Cart::clear();
                $settings=WebsiteSetting::first();
                Mail::to($settings->contact_notification_email)->send(new SendInqueryMail($inquery));
            });

            return redirect()->route('frontend.product_inquery_checkout')->with('success', 'Your inquiry has been submitted successfully.');
        } else {
            return redirect()->route('frontend.product_inquery_checkout')->with('error', 'Captcha verification failed. Please try again.');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $inquery = Inquery::with('details')->findOrFail($id);
        // Mark as read
        if ($inquery->is_read == 0) {
            $inquery->is_read = 1;
            $inquery->save();
        }
        return view('backend.admin.inquery.show', compact('inquery'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Inquery $inquery)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Inquery $inquery)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Inquery $inquery)
    {
        //
    }


    public function productInquiryAdd(Request $request, $id)
    {
        $guestSessionId = session()->get('guestSessionId', function () {
            return session()->put('guestSessionId', uniqid('guest_', true));
        });
        // dd($guestSessionId);
        // session()->put('product_inquiries', null);
        $product = Product::with('group', 'category', 'subCategory')->find($id);

        $cart = \Cart::add(array(
            'id' => $product->id,
            'name' => $product->name,
            'price' => 1,
            'quantity' => 1,
            'attributes' => array(),
            'associatedModel' => $product
        ));

        $cart_data = new stdClass();
        $cart_data->cart_item_count = \Cart::getContent()->count();
        $cart_data->message = 'Your inquiry for the product "' . $product->name . '" has been added.';

        return $cart_data;
    }

    public function productInquiryRemove(Request $request, $id)
    {
        // dd($guestSessionId);
        // session()->put('product_inquiries', null);
        $product = Product::with('group', 'category', 'subCategory')->find($id);
        $cart = \Cart::remove($id);

        $cart_data = new stdClass();
        $cart_data->cart_item_count = \Cart::getContent()->count();
        $cart_data->message = 'Your inquiry for the product "' . $product->name . '" has been Removed.';

        return $cart_data;
    }
    public function checkout()
    {
        $inquery_products = \Cart::getContent();

        return view('frontend.inquery_checkout', compact('inquery_products'));
    }

    public function markasreplyed($id)
    {
        try {
            $inquery = Inquery::findOrFail($id);
            $inquery->is_read = 1;
            $inquery->is_reply = 1;
            $inquery->save();

            // Check if the package is associated with any other records

            $data = new stdClass();
            $data->status = 1;
            $data->message = 'Inquery Marked as Replyed.';
            return response()->json($data);
        } catch (\Exception $e) {
            Log::error('Error Marking as Replyed : ' . $e->getMessage());
            $data = new stdClass();
            $data->status = 0;
            $data->message = 'An error occurred while Marking as Replyed.';
            return response()->json($data);
        }







        return redirect()->back()->with('success', 'Inquery marked as read.');
    }
}
