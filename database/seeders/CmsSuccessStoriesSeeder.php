<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\CmsPage;

class CmsSuccessStoriesSeeder extends Seeder
{
    public function run()
    {
        CmsPage::where('slug', 'success-stories')->delete();

        $content = [
            'name' => 'Success Stories',
            'slug' => 'success-stories',
            'meta_title' => 'Success Stories',
            'meta_description' => 'Manage Success Stories Section',
            'content' => json_encode([
                'title' => "Our Members' Success Stories",
                'items' => [
                    [
                        'value' => '10K+',
                        'line1' => 'Active Members',
                        'line2' => 'Subscribers worldwide',
                    ],
                    [
                        'value' => '85%',
                        'line1' => 'Average Success Rate',
                        'line2' => 'Winning predictions',
                    ],
                    [
                        'value' => '92%',
                        'line1' => 'Renewal Rate',
                        'line2' => 'Member satisfaction',
                    ],
                    [
                        'value' => '3.1x',
                        'line1' => 'Average ROI',
                        'line2' => 'Return on investment',
                    ],
                ],
            ]),
        ];

        CmsPage::create($content);
    }
}
