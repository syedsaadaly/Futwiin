<?php

namespace App\Http\Controllers\AdminControllers;

use App\Http\Controllers\Controller;
use App\Models\TwitterPost;
use Illuminate\Http\Request;

class TwitterPostController extends Controller
{
    public function index()
    {
        $posts = TwitterPost::all();
        return view('admin.twitter_posts.index', compact('posts'));
    }

    public function create()
    {
        return view('admin.twitter_posts.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string',
            'handle' => 'required|string',
            'content' => 'required|string',
        ]);

        TwitterPost::create($data);
        return redirect()->route('admin.twitter-posts.index')->with('success', 'Tweet Added');
    }

    public function edit(TwitterPost $twitterPost)
    {
        return view('admin.twitter_posts.edit', compact('twitterPost'));
    }

    public function update(Request $request, TwitterPost $twitterPost)
    {
        $data = $request->validate([
            'title' => 'required|string',
            'handle' => 'required|string',
            'content' => 'required|string',
        ]);

        $twitterPost->update($data);
        return redirect()->route('admin.twitter-posts.index')->with('success', 'Tweet Updated');
    }

    public function destroy(TwitterPost $twitterPost)
    {
        $twitterPost->delete();
        return redirect()->route('admin.twitter-posts.index')->with('success', 'Tweet Deleted');
    }
}
