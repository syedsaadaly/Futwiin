<?php

namespace Database\Seeders;

use App\Models\CmsPage;
use Illuminate\Database\Seeder;

class CmsHowItWorksSeeder extends Seeder
{
    public function run()
    {
        // Pehle existing record delete kar do (slug = how-it-works)
        CmsPage::where('slug', 'how-it-works')->delete();

        $content = [
            'name' => 'How It Works',
            'slug' => 'how-it-works',
            'meta_title' => 'How It Works Section',
            'meta_description' => 'Manage How It Works Section',
            'content' => json_encode([
                'title' => "How It Works",
                'subtitle' => "Our systematic approach to soccer betting analysis delivers consistent results for our members.",
            ]),
        ];

        CmsPage::create($content);
    }
}
