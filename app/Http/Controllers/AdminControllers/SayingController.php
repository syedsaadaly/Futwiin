<?php

namespace App\Http\Controllers\AdminControllers;

use App\Http\Controllers\Controller;
use App\Models\Saying;
use Illuminate\Http\Request;

class SayingController extends Controller
{
    public function index()
    {
        $sayings = Saying::all();
        return view('admin.saying.index', compact('sayings'));
    }

    public function create()
    {
        return view('admin.saying.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'designation' => 'nullable|string|max:255',
            'rating' => 'required|integer|min:1|max:5',
            'message' => 'required',
        ]);

        Saying::create($request->only('name', 'designation', 'rating', 'message'));

        return redirect()->route('admin.saying.index')->with('success', 'Saying created successfully!');
    }

    public function edit($id)
    {
        $saying = Saying::findOrFail($id);
        return view('admin.saying.edit', compact('saying'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'designation' => 'nullable|string|max:255',
            'rating' => 'required|integer|min:1|max:5',
            'message' => 'required',
        ]);

        $saying = Saying::findOrFail($id);
        $saying->update($request->only('name', 'designation', 'rating', 'message'));

        return redirect()->route('admin.saying.index')->with('success', 'Saying updated successfully!');
    }

    public function destroy($id)
    {
        $saying = Saying::findOrFail($id);
        $saying->delete();

        return redirect()->route('admin.saying.index')->with('success', 'Saying deleted successfully!');
    }
}
