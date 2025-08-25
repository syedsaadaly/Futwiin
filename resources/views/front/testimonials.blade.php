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

<section class="testimonials">
     <div class="testimonial-heading">
        <h3>{{ $content['heading'] ?? 'What Our Clients Say' }}</h3>
        <p>{{ $content['subheading'] ?? 'Real stories from our satisfied customers.' }}</p>
    </div>

    <div class="testimonial-container">
        @foreach($testimonials as $testimonial)
         {{-- @dd($testimonial->getFirstMediaUrl('image')) --}}
            <div class="testimonial-box">
                <img src="{{ $testimonial->getFirstMediaUrl('image') }}" alt="{{ $testimonial->name }}" class="rounded-circle">

                <p class="testimonial-text">"{{ $testimonial->message }}"</p>
                <h4>- {{ $testimonial->name }}</h4>
            </div>
        @endforeach
    </div>
</section>
@endsection
