<?php

namespace App\Http\Controllers\FrontControllers;

use App\Http\Controllers\Controller;
use App\Models\CmsPage;
use App\Models\League;
use App\Models\Plan;
use App\Models\Pridection;
use App\Repositories\LeagueRepository;
use App\Repositories\PlanRepository;
use App\Repositories\PridectionRepository;
use Illuminate\Http\Request;
use App\Models\Testimonial;
use App\Models\FeaturedPlayer;
use App\Models\HowItWork;
use App\Models\MemberPoint;
use App\Models\TwitterSection;
use App\Models\TwitterItem;

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
        // Home Banner
        $homeBanner = CmsPage::where('slug', 'home-banner')->first();
        $banner = (object) ($homeBanner ? json_decode($homeBanner->content, true) : []);

        // Featured Picks
        $featuredPicks = CmsPage::where('slug', 'featured-picks')->first();
        $picks = (object) ($featuredPicks ? json_decode($featuredPicks->content, true) : []);

        // Featured Players CMS Section
        $players = CmsPage::where('slug', 'featured-players')->first();
        $players = (object) ($players ? json_decode($players->content, true) : []);

        // Featured Players List from DB
        $playersList = FeaturedPlayer::all();
        $howItWork = HowItWork::all();

        $howItWorks = CmsPage::where('slug', 'how-it-works')->first();
        $howItWorks = (object) ($howItWorks ? json_decode($howItWorks->content, true) : []);
        $howItWorksItems = \App\Models\HowItWork::all(); // DB se items fetch

        // Twitter Section CMS
        $twitterSection = TwitterSection::first();
        $twitterItems = $twitterSection ? $twitterSection->items : collect();

        // Members Section
        $members = CmsPage::where('slug', 'members-section')->first();
        $decodedData = json_decode($members->content, true);
        
        
        $membersContent = (object) ($members ? json_decode($members->content, true) : []);
        $memberPoints = MemberPoint::all();
       

        $sayingCms = CmsPage::where('slug', 'saying')->first();
        $sayingCms = (object) ($sayingCms ? json_decode($sayingCms->content, true) : []);

        // Saying cards from DB
        $sayingList = \App\Models\Saying::all();

        $successStories = CmsPage::where('slug', 'success-stories')->first();
        $successStories = (object) ($successStories ? json_decode($successStories->content, true) : []);

        return view('front.index', [
            'domesticLeagues' => $this->leagueRepo->getDomesticLeagues(),
            'internationalLeagues' => $this->leagueRepo->getInternationalLeagues(),
            'predictions' => $this->predictionRepo->getUpcomingPredictions(!auth()->check()),
            'plans' => $this->planRepo->getAllOrderedByPrice(),
            'banner' => $banner,
            'picks' => $picks,
            'players' => $players,
            'playersList' => $playersList,
            // 'howItWorksItems' => $howItWork,
            'howItWorks' => $howItWorks,
            'howItWorksItems' => $howItWorksItems,
            'members' => $members,
            'memberPoints' => $memberPoints,
            'twitterSection' => $twitterSection,
            'twitterItems' => $twitterItems,
            'sayingCms' => $sayingCms,
            'sayingList' => $sayingList,
            'successStories' => $successStories,
            'membersContent' => $membersContent,
            'decodedData' => $decodedData
        ]);
    }


    // public function expert($id = null)
    // {
    //     $cmsPage = CmsPage::where('name', 'expertPicks')->first();



    //     if($id) {
    //         $predictions = $this->predictionRepo->getUpcomingPredictionsByLeague($id, !auth()->check());
    //         $showRegisterButton = false;
    //         return view('front.expert', compact('predictions','showRegisterButton'));
    //     } else {
    //         return view('front.expert', [
    //             'predictions' => $this->predictionRepo->getUpcomingPredictions(!auth()->check()),
    //             'showRegisterButton' => !auth()->check() && $this->predictionRepo->hasTeaserPredictions()
    //         ]);
    //     }
    // }
    public function expert($id = null)
    {
        $cmsPage = CmsPage::where('name', 'expertPicks')->first();

        $viewData = [
            'cmsContent' => $cmsPage ? json_decode($cmsPage->content) : (object)[
                'banner_title' => 'Expert Picks',
                'main_heading' => "Today's Featured Picks",
                'main_paragraph' => 'Preview our expert predictions for today\'s matches...'
            ],
            'metaTitle' => $cmsPage->meta_title ?? "Today's Featured Picks",
            'metaDescription' => $cmsPage->meta_description ?? 'Preview our expert predictions for today\'s matches'
        ];

        if ($id) {
            $viewData['predictions'] = $this->predictionRepo->getUpcomingPredictionsByLeague($id, !auth()->check());
            $viewData['showRegisterButton'] = false;
        } else {
            $viewData['predictions'] = $this->predictionRepo->getUpcomingPredictions(!auth()->check());
            $viewData['showRegisterButton'] = !auth()->check() && $this->predictionRepo->hasTeaserPredictions();
        }

        return view('front.expert', $viewData);
    }

    public function league()
    {
        $cmsPage = CmsPage::where('name', 'Leagues')->first();

        return view('front.leagues', [
            'cmsContent' => $cmsPage ? json_decode($cmsPage->content) : (object)[
                'banner_title' => 'Leagues',
                'meta_title' => 'Football Leagues Coverage',
                'meta_description' => 'View all football leagues we cover for predictions'
            ],
            'domesticLeagues' => $this->leagueRepo->getDomesticLeagues(),
            'internationalLeagues' => $this->leagueRepo->getInternationalLeagues(),
            'meta_title' => $cmsPage->meta_title ?? 'Football Leagues Coverage',
            'meta_description' => $cmsPage->meta_description ?? 'View all football leagues we cover for predictions'
        ]);
    }
    public function pricing()
    {
        $cmsPage = CmsPage::where('name', 'Price')->first();

        return view('front.pricing', [
            'plans' => $this->planRepo->getAllOrderedByPrice(),
            'cmsContent' => $cmsPage ? json_decode($cmsPage->content) : null,
            'metaTitle' => $cmsPage->meta_title ?? 'Pricing',
            'metaDescription' => $cmsPage->meta_description ?? 'View our membership plans'
        ]);
    }


    public function testimonials()
    {
        $cmsPage = CmsPage::where('slug', 'testimonials')->firstOrFail();
        $testimonials = Testimonial::latest()->get();

        $content = json_decode($cmsPage->content, true);

        return view('front.testimonials', compact('cmsPage', 'content', 'testimonials'));
    }
}
