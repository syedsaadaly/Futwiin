<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\CmsPage;

class ExpertPicksPageSeeder extends Seeder
{
    public function run()
    {
        
        CmsPage::where('name', 'expertPicks')->delete();

        $content = [
            'name' => 'expertPicks',
            'slug' => 'expertPicks',
            'meta_title' => 'Futwin',
            'meta_description' => 'Futwin',
            
          'content' => json_encode([
                'banner_title' => 'Expert Picks',
                'main_heading' => "Today's Featured Picks",
                'main_paragraph' => 'Preview our expert predictions for today\'s matches...',
            ]),
        ];
$expertPicks = CmsPage::create($content);
    }
}
