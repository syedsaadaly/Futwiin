<?php

namespace App\Http\Controllers\AdminControllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CmsPage;
use App\Models\MemberPoint;
use App\Models\MemberSection;

class MemberSectionController extends Controller
{
    public function edit()
    {
        $memberSection = CmsPage::firstOrCreate(
            ['slug' => 'members-section'],
            [
                'name' => 'Members Section',
                'meta_title' => 'Futwin Members',
                'meta_description' => 'Why Our Members Win More',
                'content' => [
                    'page_title' => 'Why Our Members Win More',
                    'points' => [],
                ]
            ]
        );

        $decodedContent = json_decode($memberSection->content, true);

        $points = MemberPoint::all();

        // dd($decodedContent);

        return view('admin.cms.members-section', compact('memberSection', 'decodedContent', 'points'));
    }

    public function update(Request $request, $slug)
    {
        // dd($request->all());
        $memberSection = CmsPage::where('slug', $slug)->firstOrFail();

        $memberSection->update([
            'content' => [
                'page_title' => $request->title ?? $memberSection->content['page_title'] ?? '',
                'points' => $request->points ?? $memberSection->content['points'] ?? [],
            ],
            'meta_title' => $request->meta_title ?? $memberSection->meta_title ?? '',
            'meta_description' => $request->meta_description ?? $memberSection->meta_description ?? '',
        ]);

        if ($request->hasFile('image')) {
            $memberSection->clearMediaCollection('image');
            $memberSection->addMediaFromRequest('image')->toMediaCollection('image');
        }

        return back()->with('success', 'Members Section updated successfully.');
    }


    public function storePoint(Request $request)
    {
        $point = MemberPoint::create([
            'heading' => $request->text,
        ]);

        return redirect()->back()->with('success', 'Point added successfully!');
    }


    //     public function update(Request $request)
    // {
    //     $memberSection = CmsPage::where('slug', 'members-section')->firstOrFail();

    //     $memberSection->update([
    //         'content' => [
    //             'page_title' => $request->page_title,
    //             'points' => $request->points ?? []
    //         ],
    //         'meta_title' => $request->meta_title,
    //         'meta_description' => $request->meta_description
    //     ]);

    //     if ($request->hasFile('image')) {
    //         $memberSection->clearMediaCollection('image');
    //         $memberSection->addMedia($request->file('image'))->toMediaCollection('image');
    //     }

    //     return back()->with('success', 'Members Section updated successfully.');
    // }


    //     public function update(Request $request, $id)
    //     {
    //         $memberSection = CmsPage::findOrFail($id);

    //         $memberSection->update([
    //             'content' => [
    //                 'page_title' => $request->page_title,
    //                 'points' => $request->points ?? []
    //             ],
    //             'meta_title' => $request->meta_title,
    //             'meta_description' => $request->meta_description
    //         ]);

    //         // Handle image upload via Spatie Media Library
    //         if ($request->hasFile('image')) {
    //             $memberSection->clearMediaCollection('image');
    //             $memberSection->addMediaFromRequest('image')->toMediaCollection('image');
    //         }

    //         return redirect()->back()->with('success', 'Members Section updated successfully.');
    //     }

    public function destroyPoint($id)
    {
        $point = MemberPoint::whereId($id);

        $point->delete();

        return redirect()->back()->with('success', 'Point Delete successfully!');
    }
}
