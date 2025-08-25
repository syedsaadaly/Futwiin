<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\CmsPage;

class CmsHomeBannerSeeder extends Seeder
{
    public function run()
    {
        \App\Models\CmsPage::where('slug', 'home-banner')->delete();

        $content = [
            'name' => 'Home Banner',
            'slug' => 'home-banner',
            'meta_title' => 'Home Banner',
            'meta_description' => 'Manage Home Banner Section',
            'content' => json_encode([
                'title' => 'Expert Soccer Predictions That',
                'highlight' => 'Win',
                'subtitle' => 'Get exclusive betting picks from Top 5 European leagues by experts with a proven track record of success',
                'btn1_text' => 'Start Winning Today',
                'btn1_link' => '/expert',
                'btn2_text' => 'How It Works',
                'btn2_link' => '/expert',
                'success_rate' => 92,
                'leagues' => 5,
                'members' => 10,
            ]),
        ];

        CmsPage::create([
    'name' => 'Home Banner',
    'slug' => 'home-banner',
    'meta_title' => 'Home Banner',
    'meta_description' => 'Manage Home Banner Section',
    'content' => json_encode([
                'title' => 'Expert Soccer Predictions That',
                'highlight' => 'Win',
                'subtitle' => 'Get exclusive betting picks from Top 5 European leagues by experts with a proven track record of success',
                'btn1_text' => 'Start Winning Today',
                'btn1_link' => '/expert',
                'btn2_text' => 'How It Works',
                'btn2_link' => '/expert',
                'success_rate' => 92,
                'leagues' => 5,
                'members' => 10,
            ]),
]);

    }
}
