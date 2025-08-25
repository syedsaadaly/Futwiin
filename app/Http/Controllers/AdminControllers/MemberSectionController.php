<?php

namespace App\Http\Controllers\AdminControllers;

use App\Http\Controllers\Controller;
use App\Models\CmsPage;
use App\Models\MemberPoint;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MemberSectionController extends Controller
{
    public function edit()
    {
        $cms = CmsPage::where('slug', 'members-section')->first();
        $members = (object) ($cms ? json_decode($cms->content, true) : []);

        $points = MemberPoint::all();

        return view('admin.cms.members-section', compact('members', 'points'));
    }

   public function update(Request $request)
{
    $cms = CmsPage::where('slug', 'members-section')->firstOrFail();

    $data = $request->validate([
        'title' => 'required|string',
    ]);

    // purani content me jo image hai usko preserve karna hoga
    $old = json_decode($cms->content, true);
    $data['image'] = $old['image'] ?? null;

    $cms->update([
        'content' => json_encode($data),
    ]);

    return back()->with('success', 'Members Section updated successfully.');
}


    public function storePoint(Request $request)
    {
        $request->validate(['text' => 'required|string']);
        MemberPoint::create($request->only('text'));

        return back()->with('success', 'Point added.');
    }

    public function destroyPoint($id)
    {
        $point = MemberPoint::findOrFail($id);
        $point->delete();

        return back()->with('success', 'Point deleted.');
    }
}
