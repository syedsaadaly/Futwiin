<?php

namespace App\Http\Controllers\AdminControllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CmsPage;

class CmsPageController extends Controller
{
    public function edit($slug)
    {
        $page = CmsPage::where('slug', $slug)->firstOrFail();
        return view('admin.cms.edit', compact('page'));
    }

    public function update(Request $request, $slug)
    {
        $page = CmsPage::where('slug', $slug)->firstOrFail();

        $page->update([
            'name' => $request->name,
            'meta_title' => $request->meta_title,
            'meta_description' => $request->meta_description,
            'content' => [
                'page_title' => $request->page_title,
                'heading' => $request->heading,
                'subheading' => $request->subheading,
            ],
        ]);

        return redirect()->back()->with('success', 'Page updated successfully!');
    }
    // app/Http/Controllers/Admin/CmsPageController.php
    public function editTestimonialsPage()
    {
        $page = CmsPage::where('slug', 'testimonials')->firstOrFail();
        return view('admin.cms.testimonials-page-edit', compact('page'));
    }

    public function updateTestimonialsPage(Request $request)
    {
        $page = CmsPage::where('slug', 'testimonials')->firstOrFail();

        $page->update([
            'content' => [
                'page_title' => $request->page_title,
                'heading'    => $request->heading,
                'subheading' => $request->subheading,
            ]
        ]);

        return redirect()->back()->with('success', 'Testimonials page updated successfully!');
    }

    public function editPricingPage()
    {
        $pageData = (object) [
            'pageTabTitle'    => 'Predictions',
            'pageName'        => 'All Predictions',
            'showTableInfo'   => true,
        ];

        $page = CmsPage::where('name', 'Price')->first();

        if (!$page) {
            // Create default pricing page if it doesn't exist
            $page = CmsPage::create([
                '   name' => 'Price',
                'slug' => 'pricing',
                'meta_title' => 'Pricing - Futwin',
                'meta_description' => 'View our membership plans and pricing',
                'content' => json_encode([
                    'banner_title' => 'Pricing',
                    'main_heading' => 'Membership Plans',
                    'main_paragraph' => 'Choose the plan that fits your needs and start winning with our expert soccer predictions.',
                ])
            ]);
        }

        return view('admin.cms.pricing-edit', compact('page', 'pageData'));
    }

    public function updatePricingPage(Request $request)
    {
        $request->validate([
            'banner_title' => 'required|string|max:255',
            'main_heading' => 'required|string|max:255',
            'main_paragraph' => 'required|string',
            'meta_title' => 'required|string|max:255',
            'meta_description' => 'required|string|max:255',
        ]);

        $page = CmsPage::where('name', 'Price')->firstOrFail();

        $content = json_encode([
            'banner_title' => $request->banner_title,
            'main_heading' => $request->main_heading,
            'main_paragraph' => $request->main_paragraph,
        ]);

        $page->update([
            'meta_title' => $request->meta_title,
            'meta_description' => $request->meta_description,
            'content' => $content
        ]);

        return redirect()->back()->with('success', 'Pricing page updated successfully');
    }
     
    public function editLeagues()
    {

        $pageData = (object) [
            'pageTabTitle'    => 'Predictions',
            'pageName'        => 'All Predictions',
            'showTableInfo'   => true,
        ];
         $page = CmsPage::where('name', 'leagues')->first();

        if (!$page) {
            $page = CmsPage::create([
                'name' => 'leagues',
                'slug' => 'leagues',
                'meta_title' => 'Leagues Coverage',
                'meta_description' => 'View all soccer leagues we cover for predictions',

                'content' => json_encode([
                    'banner_title' => 'Leagues',
                    // 'main_heading' => 'Top Soccer Leagues',
                    // 'main_paragraph' => 'We cover all major soccer leagues worldwide',
                    // 'bottom_heading' => 'Start Winning With Expert Soccer Predictions',
                    // 'bottom_paragraph' => 'Join thousands of members who have transformed their betting results with FutWin\'s premium analysis',

                ])
            ]);
        }

        return view('admin.cms.leagues-edit', compact('page', 'pageData'));
    }

    public function updateLeagues(Request $request)
    {
        $request->validate([
            'banner_title' => 'required|string|max:255',
            // 'main_heading' => 'required|string|max:255',
            // 'main_paragraph' => 'required|string',
            // 'bottom_heading' => 'required|string|max:255',
            // 'bottom_paragraph' => 'required|string',
            'meta_title' => 'required|string|max:255',
            'meta_description' => 'required|string|max:500',
        ]);

        $page = CmsPage::where('name', 'leagues')->firstOrFail();

        $content = json_encode([
            'banner_title' => $request->banner_title,
            // 'main_heading' => $request->main_heading,
            // 'main_paragraph' => $request->main_paragraph,
            // 'bottom_heading' => $request->bottom_heading,
            // 'bottom_paragraph' => $request->bottom_paragraph,
        ]);

        $page->update([
            'content' => $content,
            'meta_title' => $request->meta_title,
            'meta_description' => $request->meta_description,
        ]);

        return redirect()->back()->with('success', 'Leagues page updated successfully');
    }

    public function editExpertPicks()
{
    $pageData = (object) [
        'pageTabTitle' => 'Expert Picks',
        'pageName' => 'Expert Picks Page',
        'showTableInfo' => false,
    ];

    $page = CmsPage::where('name', 'expertPicks')->first();

    if (!$page) {
        $page = CmsPage::create([
            'name' => 'expertPicks',
            'slug' => 'expertPicks',
            'meta_title' => 'Futwin',
            'meta_description' => 'Futwin',
            'content' => json_encode([
                'banner_title' => 'Expert Picks',
                'main_heading' => "Today's Featured Picks",
                'main_paragraph' => 'Preview our expert predictions for today\'s matches...',
            ])
        ]);
    }

    return view('admin.cms.expert-picks-edits', compact('page', 'pageData'));
}

public function updateExpertPicks(Request $request)
{
    $request->validate([
        'banner_title' => 'required|string|max:255',
        'main_heading' => 'required|string|max:255',
        'main_paragraph' => 'required|string',
        'meta_title' => 'required|string|max:255',
        'meta_description' => 'required|string|max:500',
    ]);

    $page = CmsPage::where('name', 'expertPicks')->firstOrFail();
    
    $content = json_encode([
        'banner_title' => $request->banner_title,
        'main_heading' => $request->main_heading,
        'main_paragraph' => $request->main_paragraph,
    ]);

    $page->update([
        'content' => $content,
        'meta_title' => $request->meta_title,
        'meta_description' => $request->meta_description,
    ]);

    return redirect()->back()->with('success', 'Expert Picks page updated successfully');
}
// Home Banner CMS Edit
    public function homeBannerEdit()
{
    $cmsPage = CmsPage::where('slug', 'home-banner')->firstOrFail();
    $content = json_decode($cmsPage->content, true);

    return view('admin.cms.home_banner', compact('cmsPage', 'content'));
}

public function homeBannerUpdate(Request $request)
{
    $cmsPage = CmsPage::where('slug', 'home-banner')->firstOrFail();

    $data = $request->validate([
        'title' => 'required|string',
        'highlight' => 'nullable|string',
        'subtitle' => 'nullable|string',
        'btn1_text' => 'nullable|string',
        'btn1_link' => 'nullable|string',
        'btn2_text' => 'nullable|string',
        'btn2_link' => 'nullable|string',
        'success_rate' => 'nullable|integer',
        'leagues' => 'nullable|integer',
        'members' => 'nullable|integer',
    ]);

   $cmsPage->update([
    'content' => $data, 
]);


    return redirect()->back()->with('success', 'Home Banner updated successfully!');
}
 public function featuredPicksEdit()
    {
        // Existing content fetch kar rahe hain
        $picks = (object) json_decode(CmsPage::where('slug', 'featured-picks')->first()->content, true);

        // Admin blade view me pass kar rahe hain
        return view('admin.cms.featured-picks', compact('picks'));
    }

    // Featured Picks update
    public function featuredPicksUpdate(Request $request)
    {
        $cmsPage = CmsPage::where('slug', 'featured-picks')->firstOrFail();

        $data = $request->validate([
            'title' => 'required|string',
            'subtitle' => 'nullable|string',
        ]);

        $cmsPage->update([
            'content' => json_encode($data),
        ]);

        return redirect()->back()->with('success', 'Featured Picks updated successfully!');
    }
    // Edit page
// Edit Featured Players CMS
public function featuredPlayersEdit($id)
{
    $cmsPage = CmsPage::where('slug', 'featured-players')->firstOrFail();

    // Decode content to object
    $players = json_decode($cmsPage->content);

    return view('admin.cms.featured-players', compact('players'));
}

// Update Featured Players CMS
public function featuredPlayersUpdate(Request $request)
{
    $cmsPage = CmsPage::where('slug', 'featured-players')->firstOrFail();

    $data = $request->validate([
        'title' => 'required|string',
        'subtitle' => 'nullable|string',
        'footer_text' => 'nullable|string', // Add this for footer
    ]);

    // Update CMS content
    $cmsPage->update([
        'content' => json_encode($data),
    ]);

    return redirect()->back()->with('success', 'Featured Players updated successfully!');
}
public function successStoriesEdit()
{
    $page = \App\Models\CmsPage::where('slug', 'success-stories')->first();
    $successStories = (object) ($page ? json_decode($page->content, true) : []);

    return view('admin.cms.success-stories', compact('successStories'));
}

public function successStoriesUpdate(Request $request)
{
    $page = \App\Models\CmsPage::where('slug', 'success-stories')->first();

    $content = [
        'title' => $request->input('title'),
        'items' => $request->input('items', []),
    ];

    if ($page) {
        $page->update([
            'content' => json_encode($content),
        ]);
    }

    return redirect()->route('cms.success-stories.edit')->with('success', 'Success Stories updated successfully!');
}

// AdminControllers/CmsPageController.php

public function sayingEdit()
{
    $page = \App\Models\CmsPage::where('slug', 'saying')->first();
    $saying = (object) ($page ? json_decode($page->content, true) : []);

    return view('admin.cms.saying', compact('saying'));
}

public function sayingUpdate(Request $request)
{
    $page = \App\Models\CmsPage::firstOrNew(['slug' => 'saying']);
    $page->name = 'Saying Section';
    $page->slug = 'saying';
    $page->meta_title = 'Saying Section';
    $page->meta_description = 'Manage Saying Section';

    $page->content = json_encode([
        'title' => $request->input('title'),
        'subtitle' => $request->input('subtitle'),
    ]);

    $page->save();

    return redirect()->back()->with('success', 'Saying section updated successfully.');
}
public function storePoint(Request $request)
{
    $request->validate([
        'heading' => 'nullable|string|max:255',
        'text' => 'required|string|max:255',
        'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
    ]);

    $data = $request->only(['heading', 'text']);

    if ($request->hasFile('image')) {
        $path = $request->file('image')->store('member_points', 'public');
        $data['image'] = $path;
    }

    \App\Models\MemberPoint::create($data);

    return redirect()->back()->with('success', 'Member point added successfully.');
}


}

