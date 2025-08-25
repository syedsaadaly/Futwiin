<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\CmsPage;

class CmsTestimonialPageSeeder extends Seeder
{
    public function run()
    {
        CmsPage::where('slug', 'testimonials')->delete();

        $content = [
            'name' => 'Testimonials',
            'slug' => 'testimonials',
            'meta_title' => 'Futwin',
            'meta_description' => 'Futwin',
            'content' => json_encode([
                'page_title' => 'Testimonials',
                'heading'    => 'What Our Clients Say',
                'subheading' => 'Real stories from our satisfied customers.'
            ]),
        ];

        CmsPage::create($content);
    }
}
