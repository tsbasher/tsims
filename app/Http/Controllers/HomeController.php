<?php

namespace App\Http\Controllers;

use App\Models\Pages;
use App\Models\Slider;
use Illuminate\Http\Request;

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
        $about=Pages::where('is_active',1)->where('id',1)->first();
        return view('frontend.home',compact('slider','about'));

    }
}
