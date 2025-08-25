<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
class CmsFeaturedPickSeeder extends Seeder
{
    public function run()
    {
        \App\Models\CmsPage::where('slug', 'featured-picks')->delete();

        $content = [
            'name' => 'Featured Picks',
            'slug' => 'featured-picks',
            'meta_title' => 'Featured Picks',
            'meta_description' => 'Manage Featured Picks Section',
            'content' => json_encode([
                'title' => "Today's Featured Picks",
                'subtitle' => "Preview our expert predictions for today's matches. Full analysis and detailed picks are available for premium members.",
            ]),
        ];

        \App\Models\CmsPage::create($content);
    }
}
