<?php

namespace App\Http\Controllers\AdminControllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Testimonial;
// use Illuminate\Http\Client\Request;

class AdminTestimonialController extends Controller
{
    // Show all testimonials
    public function index()
    {
        $pageData = (object)[
            'pageTabTitle' => 'CMS',
            'pageName'     => 'All Testimonials',
            'showTableInfo'=> true,
        ];

        $testimonials = Testimonial::latest()->paginate(10);

        return view('admin.CMS.testimonials.index', compact('testimonials', 'pageData'));
    }

    // Show create form
    public function create()
    {
        $pageData = (object)[
            'pageTabTitle' => 'CMS',
            'pageName'     => 'Create Testimonial',
            'showTableInfo'=> false,
        ];

        return view('admin.CMS.testimonials.create', compact('pageData'));
    }

    // Store new testimonial
    public function store(Request $request)
    {
        $request->validate([
            'name'        => 'required|string|max:255',
            'designation' => 'nullable|string|max:255',
            'message'     => 'required|string',
            'image'       => 'nullable|image|max:2048',
        ]);

        $testimonial = Testimonial::create($request->only('name', 'designation', 'message'));

        if ($request->hasFile('image')) {
    $testimonial->clearMediaCollection('image');
    $testimonial->addMediaFromRequest('image')->toMediaCollection('image');
}


        return redirect()->route('admin.cms.testimonials.index')
            ->with('success', 'Testimonial added successfully.');
    }

    // Show edit form
    // Show edit form
public function edit($id)
{
    $testimonial = Testimonial::findOrFail($id);

    $pageData = (object)[
        'pageTabTitle' => 'CMS',
        'pageName'     => 'Edit Testimonial',
        'showTableInfo'=> false,
    ];

    return view('admin.CMS.testimonials.edit', compact('testimonial', 'pageData'));
}


    // Update testimonial
    public function update(Request $request, $id)
{
    $request->validate([
        'name'        => 'required|string|max:255',
        'designation' => 'nullable|string|max:255',
        'message'     => 'required|string',
        'image'       => 'nullable|image|max:2048',
    ]);

    $testimonial = Testimonial::findOrFail($id);

    $testimonial->update($request->only('name', 'designation', 'message'));

   if ($request->hasFile('image')) {
    $testimonial->clearMediaCollection('image');
    $testimonial->addMediaFromRequest('image')->toMediaCollection('image');
}


    return redirect()->route('admin.cms.testimonials.index')
        ->with('success', 'Testimonial updated successfully.');
}


    public function destroy(Testimonial $testimonial)
{
    $testimonial->clearMediaCollection('image'); // image bhi delete kare
    $testimonial->delete();

    return redirect()->route('admin.cms.testimonials.index')
        ->with('success', 'Testimonial deleted successfully.');
}


}
