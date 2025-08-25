<?php
namespace App\Http\Controllers\AdminControllers;

use App\Http\Controllers\Controller;
use App\Models\TwitterSection;
use App\Models\TwitterItem;
use Illuminate\Http\Request;

class TwitterController extends Controller
{
    // Show the section and its items
    public function edit()
    {
        $section = TwitterSection::first();
        if(!$section){
            $section = TwitterSection::create([
                'title' => 'Follow Us On Twitter',
                'description' => 'We share teasers of our premium picks on Twitter. Follow us to stay updated and get a taste of our expert analysis.'
            ]);
        }
        $items = $section->items()->get();

        return view('admin.cms.twitter-section', compact('section','items'));
    }

    // Update section title and description
   public function updateSection(Request $request)
{
    $section = TwitterSection::first();
    $data = $request->validate([
        'title'          => 'required|string',
        'description'    => 'required|string',
        'button_text'    => 'nullable|string',
        'button_link'    => 'nullable|url',
        'twitter_handle' => 'nullable|string',
    ]);

    $section->update($data);

    return back()->with('success','Twitter section updated successfully.');
}


    // Add new tweet item
    public function storeItem(Request $request)
    {
        $section = TwitterSection::first();
        $data = $request->validate([
            'username' => 'required|string',
            'handle' => 'required|string',
            'content' => 'required|string',
        ]);
        $section->items()->create($data);

        return back()->with('success','Tweet added successfully.');
    }

    // Update existing tweet item
    public function updateItem(Request $request, $id)
    {
        $item = TwitterItem::findOrFail($id);
        $data = $request->validate([
            'username' => 'required|string',
            'handle' => 'required|string',
            'content' => 'required|string',
        ]);
        $item->update($data);

        return back()->with('success','Tweet updated successfully.');
    }

    // Delete a tweet item
    public function destroyItem($id)
    {
        $item = TwitterItem::findOrFail($id);
        $item->delete();

        return back()->with('success','Tweet deleted successfully.');
    }
    // Items list
public function indexItems()
{
    $items = TwitterItem::latest()->paginate(10);
    return view('admin.twitter-items.index', compact('items'));
}

// Show create form
public function createItem()
{
    return view('admin.twitter-items.create');
}

// Show edit form
public function editItem($id)
{
    $item = TwitterItem::findOrFail($id);
    return view('admin.twitter-items.edit', compact('item'));
}

}
