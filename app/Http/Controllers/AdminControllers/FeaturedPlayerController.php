<?php

namespace App\Http\Controllers\AdminControllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\FeaturedPlayer;
use Illuminate\Support\Facades\Storage;

class FeaturedPlayerController extends Controller
{
    public function index()
    {
        $players = FeaturedPlayer::all();
        return view('admin.featured-players.index', compact('players'));
    }

    public function create()
    {
        return view('admin.featured-players.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string',
            'club' => 'nullable|string',
            'age' => 'nullable|integer',
            'position' => 'nullable|string',
            'nationality' => 'nullable|string',
            'stats' => 'nullable|string',
            'description' => 'nullable|string',
            'image' => 'nullable|image|max:2048',
        ]);

        $player = FeaturedPlayer::create($data);

        if($request->hasFile('image')){
            $player->addMediaFromRequest('image')
                ->toMediaCollection('featured-players');
        }

        return redirect()->route('admin.featured-players.index')->with('success','Player added successfully');
    }

    public function edit(FeaturedPlayer $player)
    {
        return view('admin.featured-players.edit', compact('player'));
    }

    public function update(Request $request, FeaturedPlayer $player)
    {
        $data = $request->validate([
            'name' => 'required|string',
            'club' => 'nullable|string',
            'age' => 'nullable|integer',
            'position' => 'nullable|string',
            'nationality' => 'nullable|string',
            'stats' => 'nullable|string',
            'description' => 'nullable|string',
            'image' => 'nullable|image|max:2048',
        ]);
        $player->update($data);

        if($request->hasFile('image')){
            $player->clearMediaCollection('featured-players');
            
            $player->addMediaFromRequest('image')
                ->toMediaCollection('featured-players');
        }

        return redirect()->route('admin.featured-players.index')->with('success','Player updated successfully');
    }
public function destroy(FeaturedPlayer $player)
{
    if ($player->image) {
        Storage::disk('public')->delete($player->image);
    }
    $player->delete();

    return redirect()->route('admin.featured-players.index')->with('success', 'Player deleted successfully');
}
    
}
