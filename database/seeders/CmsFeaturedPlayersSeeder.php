<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\CmsPage;

class CmsFeaturedPlayersSeeder extends Seeder
{
    public function run()
    {
        CmsPage::where('slug', 'featured-players')->delete();

        $content = [
            'name' => 'Featured Players',
            'slug' => 'featured-players',
            'meta_title' => 'Featured Players',
            'meta_description' => 'Manage Featured Players Section',
            'content' => json_encode([
                'title' => 'Featured Players',
                'subtitle' => "Get expert betting insights on matches featuring today's biggest football superstars",
            ]),
        ];

        CmsPage::create($content);
    }
}
