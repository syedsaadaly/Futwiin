<?php
namespace App\Http\Controllers\AdminControllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\HowItWork;

class HowItWorksController extends Controller
{
    public function index()
    {
        $items = HowItWork::all();
        return view('admin.how_it_works.index', compact('items'));
    }

    public function create()
    {
        return view('admin.how_it_works.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string',
            'description' => 'required|string',
            'icon' => 'nullable|string',
        ]);

        HowItWork::create($data);

        return redirect()->route('admin.how-it-works.index')->with('success', 'Item added successfully');
    }

    public function edit($id)
    {
        $item = HowItWork::findOrFail($id);
        return view('admin.how_it_works.edit', compact('item'));
    }

    public function update(Request $request, $id)
    {
        $item = HowItWork::findOrFail($id);

        $data = $request->validate([
            'title' => 'required|string',
            'description' => 'required|string',
            'icon' => 'nullable|string',
        ]);

        $item->update($data);

        return redirect()->route('admin.how-it-works.index')->with('success', 'Item updated successfully');
    }

    public function destroy($id)
    {
        $item = HowItWork::findOrFail($id);
        $item->delete();

        return redirect()->route('admin.how-it-works.index')->with('success', 'Item deleted successfully');
    }
}
