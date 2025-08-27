<?php

namespace Database\Seeders;

use App\Models\CmsPage;
use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{
    public function run()
    {
        CmsPage::where('name', 'Settings')->delete();

        $content = [
            'name' => 'Settings',
            'slug' => 'settings',
            'meta_title' => 'FutWin',
            'meta_description' => 'FutWin',

            'header_logo' => 'front/images/image.webp',
            'fav_icon' => 'front/images/image.webp',

            'content' => json_encode([
                'navbar_logo_alt' => 'FutWin',
                'section_heading' => 'Start Winning With Expert Soccer Predictions',
                'section_paragraph' => 'Join thousands of members who have transformed their betting results with FutWin’s premium analysis',
                'section_btn_1_text' => 'Join FutWin Today',
                'section_btn_1_link' => '#',
                'section_btn_2_text' => 'Join FutWin Today',
                'section_btn_2_link' => '#',

                'footer_logo_text' => 'FutWin',
                'footer_paragraph' => 'Expert soccer betting predictions from the Top 5 European leagues.',
                'facebook_link' => '#',
                'twitter_link' => '#',
                'instagram_link' => '#',
                'youtube_link' => '#',

                'footer_disclaimer' => 'FutWin is an informational service. We do not provide gambling services or accept bets. Please bet responsibly.',
                'footer_copyright' => 'All Right Reserved',
            ]),
        ];

        $data = collect($content)->except(['header_logo','fav_icon'])->all();

        $settings = CmsPage::create($data);

        $settings->clearMediaCollection('header_logo');
        $settings->clearMediaCollection('fav_icon');

        if (file_exists(public_path($content['header_logo']))) {
            $settings->copyMedia(public_path($content['header_logo']))->toMediaCollection('header_logo');
        }

        if (file_exists(public_path($content['fav_icon']))) {
            $settings->copyMedia(public_path($content['fav_icon']))->toMediaCollection('fav_icon');
        }
    }
}
