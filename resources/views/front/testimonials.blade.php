@extends('front.include.app')
@section('content')
    <div class="inner-banner">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h2>{{ $content['page_title'] ?? 'Testimonials' }}</h2>
                </div>
            </div>
        </div>
    </div>

    <section class="testimonials py-5">
        <div class="container">
            <div class="testimonial-heading text-center mb-5">
                <h3>{{ $content['heading'] ?? 'What Our Clients Say' }}</h3>
                <p>{{ $content['subheading'] ?? 'Real stories from our satisfied customers.' }}</p>
            </div>

            <div class="testimonial-container d-flex flex-wrap justify-content-center gap-4">
                @foreach ($testimonials as $testimonial)
                    <div class="testimonial-box bg-white p-4 rounded shadow text-center" style="max-width: 300px;">
                        <img src="{{ $testimonial->getFirstMediaUrl('image') }}" alt="{{ $testimonial->name }}"
                            class="rounded-circle mb-3" style="width:100px; height:100px; object-fit:cover;">

                        <p class="testimonial-text">"{{ $testimonial->message }}"</p>
                        <h4 class="mt-2">- {{ $testimonial->name }}</h4>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
@endsection
