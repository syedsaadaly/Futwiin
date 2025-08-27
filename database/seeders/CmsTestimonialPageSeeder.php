<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\CmsPage;

class CmsMemberSectionSeeder extends Seeder
{
    public function run()
    {
        // Delete existing CMS entry if exists
        CmsPage::where('slug', 'members-section')->delete();

        $content = [
            'name' => 'Members Section',
            'slug' => 'members-section',
            'meta_title' => 'Futwin Members',
            'meta_description' => 'Why Our Members Win More',
            'content' => json_encode([
                'page_title' => 'Why Our Members Win More',
                'points' => [
                    [
                        'text' => 'In-depth analysis of team dynamics and tactical matchups',
                        'heading' => null,
                    ],
                    [
                        'text' => 'Focus on value bets with positive expected returns',
                        'heading' => null,
                    ],
                    [
                        'text' => 'Exclusive insights from industry insiders and former players',
                        'heading' => null,
                    ],
                    [
                        'text' => 'Disciplined staking strategy to maximize bankroll growth',
                        'heading' => null,
                    ],
                    [
                        'text' => 'Coverage across multiple leagues to find the best opportunities',
                        'heading' => null,
                    ],
                ],
                'image' => 'front/images/memberimg.webp', // default image
            ]),
        ];

        CmsPage::create($content);
    }
}
