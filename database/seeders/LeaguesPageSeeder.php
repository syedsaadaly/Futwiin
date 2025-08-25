<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\CmsPage;

class LeaguesPageSeeder extends Seeder
{
    public function run()
    {

        CmsPage::where('name', 'Leagues')->delete();

        $content = [
            'name' => 'Leagues',
            'slug' => 'Leagues',
            'meta_title' => 'Futwin',
            'meta_description' => 'FutWin.',
            
            'content' => json_encode([
                'banner_title' => 'Leagues',
            ]),
        ];

       $leagues = CmsPage::create($content);
    }
}
