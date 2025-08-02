<?php

namespace App\Http\Controllers\FrontControllers;

use App\Http\Controllers\Controller;
use App\Models\League;
use App\Models\Plan;
use App\Models\Pridection;
use Illuminate\Http\Request;

class FrontController extends Controller
{
    public function index()
    {
        $domesticLeagues = League::where('type', 2)
                        ->orderBy('title')
                        ->get();

        $internationalLeagues = League::where('type', 1)
                                    ->orderBy('title')
                                    ->get();
        $predictionsQuery = Pridection::with(['team1', 'team2', 'league'])
            ->where('match_date', '>=', now()->toDateString())
            ->orderBy('match_date')
            ->orderBy('match_time');

        if (!auth()->check()) {
            $predictionsQuery->where('is_teaser', true);
        }

        $predictions = $predictionsQuery->get();
        $plans = Plan::orderBy('price')->get();

       return view('front.index',compact('domesticLeagues', 'internationalLeagues','predictions','plans'));
    }
    public function expert()
    {
        $predictionsQuery = Pridection::with(['team1', 'team2', 'league'])
            ->where('match_date', '>=', now()->toDateString())
            ->orderBy('match_date')
            ->orderBy('match_time');

        if (!auth()->check()) {
            $predictionsQuery->where('is_teaser', true);
        }

        $predictions = $predictionsQuery->get();
        $showRegisterButton = !auth()->check() && Pridection::where('is_teaser', true)->exists();

        return view('front.expert', compact('predictions', 'showRegisterButton'));
    }
    public function league()
    {
        $domesticLeagues = League::where('type', 2)
                                ->orderBy('title')
                                ->get();

        $internationalLeagues = League::where('type', 1)
                                    ->orderBy('title')
                                    ->get();

        return view('front.leagues', compact('domesticLeagues', 'internationalLeagues'));
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
