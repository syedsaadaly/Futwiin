<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Testimonial;

class TestimonialPageSeeder extends Seeder
{
    public function run()
    {
        // Purana data delete
        Testimonial::truncate();

        $testimonials = [
          
            [
                'name' => 'John Doe',
                'designation' => 'CEO, Example Inc.',
                'message' => 'This studio has changed the way we work. Amazing facilities and great staff!',
                'image' => 'front/images/testimonial1.webp',
            ],
            [
                'name' => 'Jane Smith',
                'designation' => 'Photographer',
                'message' => 'Unlimited booking options are a game changer for my business.',
                'image' => 'front/images/testimonial2.webp',
            ],
        ];

        foreach ($testimonials as $data) {
            $imagePath = $data['image'];
            unset($data['image']);

            $testimonial = Testimonial::create($data);

            $testimonial->clearMediaCollection('image');

            if (file_exists(public_path($imagePath))) {
                $testimonial->copyMedia(public_path($imagePath))->toMediaCollection('image');
            }
        }
    }
}
