<?php

// use App\Http\Controllers\Admin\FeaturedPlayerController as AdminFeaturedPlayerController;

use App\Http\Controllers\AdminControllers\FeaturedPlayerController;
use App\Http\Controllers\AdminControllers\CmsPageController as AdminCmsPageController;
use App\Http\Controllers\AdminControllers\AdminController;
use App\Http\Controllers\AdminControllers\LeagueController;
use App\Http\Controllers\AdminControllers\PlanController;
use App\Http\Controllers\AdminControllers\PridectionController;
use App\Http\Controllers\AdminControllers\ProfileController;
use App\Http\Controllers\AdminControllers\TeamController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\FrontControllers\FrontController;
use App\Http\Controllers\FrontendControllers\FrontendController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\UserControllers\UserController;
use Illuminate\Support\Facades\Route;
// use App\Http\Controllers\Front\TestimonialController;
use App\Http\Controllers\AdminControllers\AdminTestimonialController;
// use App\Http\Controllers\AdminControllers\CmsPageController;
use App\Http\Controllers\AdminControllers\CmsPageController;
use App\Http\Controllers\Frontend\CmsPageController as FrontendCmsPageController;

use App\Http\Controllers\AdminControllers\HowItWorkController;
use App\Http\Controllers\AdminControllers\TwitterPostController;
use App\Http\Controllers\AdminControllers\HomeTestimonialController;
use App\Http\Controllers\AdminControllers\HowItWorksController;
use App\Http\Controllers\AdminControllers\MemberSectionController;
use App\Http\Controllers\AdminControllers\PageContentController;
use App\Http\Controllers\AdminControllers\SayingController;
use App\Http\Controllers\AdminControllers\TwitterController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::name('front.')->group(function () {
    Route::get('/', [FrontController::class, 'index'])->name('index');
    Route::get('/expert/{id?}', [FrontController::class, 'expert'])->name('expert');
    Route::get('/leagues', [FrontController::class, 'league'])->name('leagues');
    Route::get('/pricing', [FrontController::class, 'pricing'])->name('pricing');
    Route::get('/testimonials', [FrontController::class, 'testimonials'])->name('testimonials');
    // Route::get('/testimonials', [TestimonialController::class, 'index'])->name('front.testimonials');
});
Route::get('/predictions/{prediction}', [PridectionController::class, 'checkAccess'])
    ->name('prediction.view')
    ->middleware('auth');
Route::get('/payment/success', [PaymentController::class, 'paymentSuccess'])->name('payment.success');
Route::get('/payment/{plan}', [PaymentController::class, 'showPaymentForm'])->name('payment.show');
Route::post('/payment/process/{plan}', [PaymentController::class, 'processPayment'])->name('payment.process');
Route::get('/login', [AuthController::class, 'showLoginForm'])->middleware('guest')->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
Route::get('/register', [AuthController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::middleware(['auth', 'role:admin'])->prefix('admin')->namespace('admin')->group(function () {

    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');

    Route::get('/users', [AdminController::class, 'users'])->name('admin.users');
    Route::get('/users/get-user/{id}', [AdminController::class, 'getUser'])->name('admin.getUser');
    Route::post('/users/create-user', [AdminController::class, 'createUser'])->name('admin.createUser');
    Route::post('/users/update-user/{id}', [AdminController::class, 'updateUser'])->name('admin.updateUser');
    Route::delete('/users/delete-user/{id}', [AdminController::class, 'deleteUser'])->name('admin.deleteUser');

    Route::group(['prefix' => 'leagues'], function () {
        Route::get('/', [LeagueController::class, 'index'])->name('admin.leagues.index');
        Route::get('/create', [LeagueController::class, 'create'])->name('admin.leagues.create');
        Route::post('/store', [LeagueController::class, 'store'])->name('admin.leagues.store');
        Route::get('/edit/{id}', [LeagueController::class, 'edit'])->name('admin.leagues.edit');
        Route::put('/update/{id}', [LeagueController::class, 'update'])->name('admin.leagues.update');
        Route::delete('/delete/{id}', [LeagueController::class, 'delete'])->name('admin.leagues.delete');
    });
    Route::prefix('plans')->name('admin.plans.')->group(function () {
        Route::get('/', [PlanController::class, 'index'])->name('index');
        Route::get('/create', [PlanController::class, 'create'])->name('create');
        Route::post('/store', [PlanController::class, 'store'])->name('store');
        Route::get('/edit/{id}', [PlanController::class, 'edit'])->name('edit');
        Route::put('/update/{id}', [PlanController::class, 'update'])->name('update');
        Route::delete('/delete/{id}', [PlanController::class, 'delete'])->name('delete');
    });
    Route::prefix('teams')->name('admin.teams.')->group(function () {
        Route::get('/', [TeamController::class, 'index'])->name('index');
        Route::get('/create', [TeamController::class, 'create'])->name('create');
        Route::post('/store', [TeamController::class, 'store'])->name('store');
        Route::get('/edit/{id}', [TeamController::class, 'edit'])->name('edit');
        Route::put('/update/{id}', [TeamController::class, 'update'])->name('update');
        Route::delete('/delete/{id}', [TeamController::class, 'delete'])->name('delete');
    });
    Route::prefix('predictions')->name('admin.predictions.')->group(function () {
        Route::get('/', [PridectionController::class, 'index'])->name('index');
        Route::get('/create', [PridectionController::class, 'create'])->name('create');
        Route::post('/store', [PridectionController::class, 'store'])->name('store');
        Route::get('/edit/{id}', [PridectionController::class, 'edit'])->name('edit');
        Route::put('/update/{id}', [PridectionController::class, 'update'])->name('update');
        Route::delete('/delete/{id}', [PridectionController::class, 'delete'])->name('delete');
    });
    Route::prefix('profile')->name('admin.profile.')->group(function () {
        Route::get('/', [ProfileController::class, 'index'])->name('index');
        Route::post('/update', [ProfileController::class, 'update'])->name('update');
    });

    Route::prefix('cms')->group(function() {
    Route::get('/testimonials', [AdminTestimonialController::class, 'index'])->name('admin.cms.testimonials.index');
    Route::get('/testimonials/create', [AdminTestimonialController::class, 'create'])->name('admin.cms.testimonials.create');
    Route::post('/testimonials/store', [AdminTestimonialController::class, 'store'])->name('admin.cms.testimonials.store');
    Route::get('/testimonials/edit/{id}', [AdminTestimonialController::class, 'edit'])->name('admin.cms.testimonials.edit');
    Route::put('/testimonials/update/{id}', [AdminTestimonialController::class, 'update'])->name('admin.cms.testimonials.update');
   Route::delete('/testimonials/delete/{testimonial}', [AdminTestimonialController::class, 'destroy'])
    ->name('admin.cms.testimonials.destroy');

});

});
Route::middleware(['auth'])->prefix('user')->namespace('user')->group(function () {

    Route::get('/dashboard', [UserController::class, 'dashboard'])->name('user.dashboard');
    Route::prefix('profile')->name('user.profile.')->group(function () {
        Route::get('/', [UserController::class, 'profileEditPage'])->name('index');
        Route::post('/update', [UserController::class, 'profileUpdate'])->name('update');
    });
});

// rCMS ROUTES
Route::prefix('admin')->name('admin.')->group(function() {
    Route::get('cms/testimonials/edit', [AdminCmsPageController::class,  'editTestimonialsPage'])->name('cms.testimonials.editPage');
    Route::put('cms/testimonials/update', [AdminCmsPageController::class, 'updateTestimonialsPage'])->name('cms.testimonials.updatePage');

    Route::get('/pricing', [AdminCmsPageController::class, 'editPricingPage'])->name('cms.pricing.edit');
    Route::put('/pricing/update', [AdminCmsPageController::class, 'updatePricingPage'])->name('cms.pricing.update');

    Route::get('/leagues/edit', [AdminCmsPageController::class, 'editLeagues'])->name('cms.leagues.edit');
    Route::put('/leagues/update', [AdminCmsPageController::class, 'updateLeagues'])->name('cms.leagues.update');

       Route::get('/expert-picks/edit', [CmsPageController::class, 'editExpertPicks'])->name('cms.expert-picks.edit');
    Route::put('/expert-picks/update', [CmsPageController::class, 'updateExpertPicks'])->name('cms.expert-picks.update');

});
// Admin Featured Players CRUD
Route::prefix('admin')->name('admin.')->middleware(['auth'])->group(function () {
    // Featured Players
// Featured Players CRUD
    Route::get('featured-players', [FeaturedPlayerController::class, 'index'])->name('featured-players.index');
    Route::get('featured-players/create', [FeaturedPlayerController::class, 'create'])->name('featured-players.create');
    Route::post('featured-players', [FeaturedPlayerController::class, 'store'])->name('featured-players.store');
    Route::get('featured-players/{player}/edit', [FeaturedPlayerController::class, 'edit'])->name('featured-players.edit');
Route::put('featured-players/{player}', [FeaturedPlayerController::class, 'update'])->name('featured-players.update');
Route::delete('featured-players/{player}', [FeaturedPlayerController::class, 'destroy'])->name('featured-players.destroy');

    // Route::get('featured-players/{id}/edit', [FeaturedPlayerController::class, 'edit'])->name('featured-players.edit');
    // Route::put('featured-players/{player}', [FeaturedPlayerController::class, 'update'])->name('featured-players.update');
    // Route::delete('featured-players/{id}', [FeaturedPlayerController::class, 'destroy'])->name('featured-players.destroy');


    // How It Works
    Route::resource('how-it-works', HowItWorksController::class)->names([
        'index'   => 'how-it-works.index',
        'create'  => 'how-it-works.create',
        'store'   => 'how-it-works.store',
        'show'    => 'how-it-works.show',
        'edit'    => 'how-it-works.edit',
        'update'  => 'how-it-works.update',
        'destroy' => 'how-it-works.destroy',
    ]);

    // Twitter Posts
    Route::resource('twitter-posts', TwitterPostController::class);

    // Testimonials
    Route::resource('hometestimonials', HomeTestimonialController::class);

    // Page Content (Home CMS)
    Route::get('page-content', [PageContentController::class, 'index'])->name('page-content.index');
    Route::post('page-content/update', [PageContentController::class, 'update'])->name('page-content.update');
});

Route::get('cms/home-banner', [CmsPageController::class, 'homeBannerEdit'])->name('cms.home-banner.edit');
Route::put('cms/home-banner', [CmsPageController::class, 'homeBannerUpdate'])->name('cms.home-banner.update');

Route::put('cms-page/featured-picks', [CmsPageController::class, 'featuredPicksUpdate'])->name('cms.featured-picks.update');
Route::get('cms-page/featured-picks/edit', [CmsPageController::class, 'featuredPicksEdit'])->name('cms.featured-picks.edit');

Route::get('cms-page/featured-players/edit/{id}', [CmsPageController::class, 'featuredPlayersEdit'])->name('cms.featured-players.edit');
Route::put('cms-page/featured-players/{id}', [CmsPageController::class, 'featuredPlayersUpdate'])->name('cms.featured-players.update');

Route::put('cms-page/success-stories', [CmsPageController::class, 'successStoriesUpdate'])->name('cms.success-stories.update');
Route::get('cms-page/success-stories/edit', [CmsPageController::class, 'successStoriesEdit'])->name('cms.success-stories.edit');


Route::prefix('admin')->middleware('auth')->group(function () {
    Route::get('cms/members-section', [MemberSectionController::class, 'edit'])->name('cms.members-section.edit');
    Route::put('cms/members-section', [MemberSectionController::class, 'update'])->name('cms.members-section.update');

    Route::post('cms/members-section/point', [MemberSectionController::class, 'storePoint'])->name('cms.members-section.storePoint');
    Route::delete('cms/members-section/point/{id}', [MemberSectionController::class, 'destroyPoint'])->name('cms.members-section.destroyPoint');
});
Route::prefix('admin')->middleware('auth')->group(function () {
    // Twitter Section
    Route::get('cms/twitter-section', [TwitterController::class, 'edit'])->name('admin.twitter-section.edit');
    Route::put('cms/twitter-section', [TwitterController::class, 'updateSection'])->name('admin.twitter-section.update');

    // Twitter Items CRUD
    Route::get('twitter-items', [TwitterController::class, 'indexItems'])->name('admin.twitter-items.index');
    Route::get('twitter-items/create', [TwitterController::class, 'createItem'])->name('admin.twitter-items.create');
    Route::post('twitter-items', [TwitterController::class, 'storeItem'])->name('admin.twitter-items.store');
    Route::get('twitter-items/{id}/edit', [TwitterController::class, 'editItem'])->name('admin.twitter-items.edit');
    Route::put('twitter-items/{id}', [TwitterController::class, 'updateItem'])->name('admin.twitter-items.update');
    Route::delete('twitter-items/{id}', [TwitterController::class, 'destroyItem'])->name('admin.twitter-items.destroy');
});
// CMS title/subtitle
Route::get('cms/saying/edit', [CmsPageController::class, 'sayingEdit'])->name('cms.saying.edit');
Route::put('cms/saying', [CmsPageController::class, 'sayingUpdate'])->name('cms.saying.update');

// CRUD (cards)
Route::resource('admin/saying', SayingController::class, ['as' => 'admin']);
