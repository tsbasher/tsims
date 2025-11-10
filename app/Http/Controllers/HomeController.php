<?php

namespace App\Http\Controllers;

use App\Models\Buyers;
use App\Models\Cretification;
use App\Models\Pages;
use App\Models\Product;
use App\Models\ProductGroup;
use App\Models\Slider;
use App\Models\Speciality;
use App\Models\Team;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $slider=Slider::where('is_active',1)->first();
        $about=Pages::where('is_active',1)->where('slug','about')->first();
        $speciality=Speciality::get();
        $certification=Cretification::where('is_active',1)->get();
        $products=Product::where('show_as_featured',1)->where('is_active',1)->inRandomOrder()->take(40)->get();
        $buyer=Buyers::where('is_active',1)->get();
        $teams=Team::where('is_active',1)->with('designation')->get();
        return view('frontend.home',compact('slider','about','speciality','certification','products','buyer','teams'));

    }
    public function about()
    {
        $about=Pages::where('is_active',1)->where('slug','about')->first();
        $mission=Pages::where('is_active',1)->where('slug','mission')->first();
        $vision=Pages::where('is_active',1)->where('slug','vision')->first();
        $teams=Team::where('is_active',1)->with('designation')->get();
        return view('frontend.about',compact('about','mission','vision','teams'));
    }
    public function contact()
    {
        return view('frontend.contact');
    }
}
