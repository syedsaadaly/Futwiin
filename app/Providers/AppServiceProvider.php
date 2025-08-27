<?php

namespace App\Providers;

use App\Models\CmsPage;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        View::composer('*', function ($view) {
    $settingsPage = CmsPage::where('name', 'Settings')->first();

    if ($settingsPage) {
        $settings = json_decode($settingsPage->content, true);

        $headerLogo = $settingsPage->getFirstMediaUrl('header_logo');
        $favIcon = $settingsPage->getFirstMediaUrl('fav_icon');

        $settings['header_logo'] = $headerLogo;
        $settings['fav_icon'] = $favIcon;

        $view->with('global_settings', $settings);
    }
});

    }
}
