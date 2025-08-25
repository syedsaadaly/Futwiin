<?php

namespace Database\Seeders;

use App\Models\CmsPage;
use Illuminate\Database\Seeder;

class CmsSayingSeeder extends Seeder
{
   
    public function run()
    {
        CmsPage::where('slug', 'saying')->delete();

$content = [
    'name' => 'Saying',
    'slug' => 'saying',
    'meta_title' => 'Saying Section',
    'meta_description' => 'Manage Saying Section',
    'content' => json_encode([
        'title' => "What Our Members Say",
        'subtitle' => "Join thousands of satisfied members who are winning more with our expert soccer predictions.",
    ]),
];

CmsPage::create($content);

    }
}
