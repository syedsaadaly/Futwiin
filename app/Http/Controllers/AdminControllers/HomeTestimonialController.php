<?php

namespace App\Http\Controllers\AdminControllers;

use App\Http\Controllers\Controller;
use App\Models\HomeTestimonial;
use Illuminate\Http\Request;

class HomeTestimonialController extends Controller
{
    public function index()
    {
        $testimonials = HomeTestimonial::orderBy('sort_order')->get();
        return view('admin.testimonials.index', compact('testimonials'));
    }

    public function create()
    {
        return view('admin.testimonials.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'since_label' => 'nullable|string|max:255',
            'review' => 'required|string',
            'rating' => 'nullable|integer|min:1|max:5',
            'avatar' => 'nullable|image',
            'sort_order' => 'nullable|integer|min:0',
            'status' => 'nullable|boolean',
        ]);

        if ($request->hasFile('avatar')) {
            $data['avatar'] = $request->file('avatar')->store('testimonials', 'public');
        }

        $data['status'] = $request->boolean('status');

        HomeTestimonial::create($data);

        return redirect()->route('admin.hometestimonials.index')->with('success', 'Testimonial Added');
    }

    public function edit(HomeTestimonial $hometestimonial)
    {
        return view('admin.testimonials.edit', compact('hometestimonial'));
    }

    public function update(Request $request, HomeTestimonial $hometestimonial)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'since_label' => 'nullable|string|max:255',
            'review' => 'required|string',
            'rating' => 'nullable|integer|min:1|max:5',
            'avatar' => 'nullable|image',
            'sort_order' => 'nullable|integer|min:0',
            'status' => 'nullable|boolean',
        ]);

        if ($request->hasFile('avatar')) {
            $data['avatar'] = $request->file('avatar')->store('testimonials', 'public');
        }

        $data['status'] = $request->boolean('status');

        $hometestimonial->update($data);

        return redirect()->route('admin.hometestimonials.index')->with('success', 'Testimonial Updated');
    }

    public function destroy(HomeTestimonial $hometestimonial)
    {
        $hometestimonial->delete();

        return response()->json([
            'message' => 'Testimonial Deleted Successfully!'
        ]);
    }
}
