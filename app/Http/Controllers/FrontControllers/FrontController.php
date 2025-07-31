<?php

namespace App\Http\Controllers\FrontControllers;

use App\Http\Controllers\Controller;
use App\Models\Plan;
use Illuminate\Http\Request;

class FrontController extends Controller
{
    public function index()
    {
       return view('front.index');
    }
    public function expert()
    {
       return view('front.expert');
    }
    public function league()
    {
       return view('front.leagues');
    }
    public function pricing()
    {
       $plans = Plan::orderBy('price')->get();
       return view('front.pricing',compact('plans'));
    }
    public function testimonials()
    {
       return view('front.testimonials');
    }
}
