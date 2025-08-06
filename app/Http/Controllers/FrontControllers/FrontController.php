<?php

namespace App\Http\Controllers\FrontControllers;

use App\Http\Controllers\Controller;
use App\Models\League;
use App\Models\Plan;
use App\Models\Pridection;
use App\Repositories\LeagueRepository;
use App\Repositories\PlanRepository;
use App\Repositories\PridectionRepository;
use Illuminate\Http\Request;

class FrontController extends Controller
{
    protected $leagueRepo;
    protected $predictionRepo;
    protected $planRepo;

    public function __construct(
        LeagueRepository $leagueRepo,
        PridectionRepository $predictionRepo,
        PlanRepository $planRepo
    ) {
        $this->leagueRepo = $leagueRepo;
        $this->predictionRepo = $predictionRepo;
        $this->planRepo = $planRepo;
    }

    public function index()
    {
        return view('front.index', [
            'domesticLeagues' => $this->leagueRepo->getDomesticLeagues(),
            'internationalLeagues' => $this->leagueRepo->getInternationalLeagues(),
            'predictions' => $this->predictionRepo->getUpcomingPredictions(!auth()->check()),
            'plans' => $this->planRepo->getAllOrderedByPrice()
        ]);
    }

    public function expert()
    {
        return view('front.expert', [
            'predictions' => $this->predictionRepo->getUpcomingPredictions(!auth()->check()),
            'showRegisterButton' => !auth()->check() && $this->predictionRepo->hasTeaserPredictions()
        ]);
    }

    public function league()
    {
        return view('front.leagues', [
            'domesticLeagues' => $this->leagueRepo->getDomesticLeagues(),
            'internationalLeagues' => $this->leagueRepo->getInternationalLeagues()
        ]);
    }

    public function pricing()
    {
        return view('front.pricing', [
            'plans' => $this->planRepo->getAllOrderedByPrice()
        ]);
    }

    public function testimonials()
    {
        return view('front.testimonials');
    }
}
