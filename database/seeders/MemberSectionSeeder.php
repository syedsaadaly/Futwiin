<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\MemberSection;

class MemberSectionSeeder extends Seeder
{
    public function run()
    {
        $section = MemberSection::create([
            'title' => 'Why Our Members Win More',
        ]);

        $section->addMedia(storage_path('app/public/front/images/memberimg.webp'))
                ->toMediaCollection('banner');
    }
}
