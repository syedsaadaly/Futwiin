<?php

namespace App\Http\Controllers\AdminControllers;

use App\Http\Controllers\Controller;
use App\Models\CmsPage;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function show()
    {
        $settingsPage = CmsPage::where('name', 'Settings')->first();
        $settings = $settingsPage ? json_decode($settingsPage->content, true) : [];
        return view('admin.cms.setting', compact('settingsPage', 'settings'));
    }

    public function update(Request $request)
    {
        $settingsPage = CmsPage::where('name', 'Settings')->firstOrFail();

        $data = $request->except(['header_logo','fav_icon']);
        $settingsPage->update([
            'content' => json_encode($data)
        ]);

        if ($request->hasFile('header_logo')) {
            $settingsPage->clearMediaCollection('header_logo');
            $settingsPage->addMedia($request->file('header_logo'))->toMediaCollection('header_logo');
        }

        if ($request->hasFile('fav_icon')) {
            $settingsPage->clearMediaCollection('fav_icon');
            $settingsPage->addMedia($request->file('fav_icon'))->toMediaCollection('fav_icon');
        }

        return redirect()->back()->with('success','Settings updated successfully');
    }
}
