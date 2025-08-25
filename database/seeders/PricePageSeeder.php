<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\CmsPage;


class PricePageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        CmsPage::where('name', 'Price')->delete();

        $content = [
            'name' => 'Price',
            'slug' => 'Price',

            'meta_title' => 'Futwin',
            'meta_description' => 'Futwin',
            
            'content' => json_encode([
                'banner_title'   => 'Pricing',
                'main_heading'   => 'Membership Plans',
                'main_paragraph' => 'Choose the plan that fits your needs and start winning with our expert soccer predictions.',
            ]),
        ];

        $price = CmsPage::create($content);
    }
}