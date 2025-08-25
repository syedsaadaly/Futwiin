<?php
namespace App\Http\Controllers\AdminControllers;

use App\Http\Controllers\Controller;
use App\Models\PageContent;
use Illuminate\Http\Request;

class PageContentController extends Controller
{
    public function index()
    {
        $contents = PageContent::where('page', 'home')->get()->groupBy('section');
        return view('admin.page_content.index', compact('contents'));
    }

    public function update(Request $request)
    {
        foreach ($request->except('_token') as $key => $value) {
            PageContent::updateOrCreate(
                ['page' => 'home', 'key' => $key],
                ['value' => $value, 'section' => explode('_', $key)[0]]
            );
        }
        return back()->with('success', 'Home Page Content Updated');
    }
}
