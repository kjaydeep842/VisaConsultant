<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\News;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class NewsAdminController extends Controller
{
    public function index()
    {
        $news = News::orderBy('created_at', 'desc')->paginate(15);
        return view('admin.news.index', compact('news'));
    }

    public function create()
    {
        return view('admin.news.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title'   => 'required|string|max:255',
            'content' => 'required|string',
        ]);

        News::create([
            'title'        => $request->title,
            'slug'         => Str::slug($request->title) . '-' . time(),
            'content'      => $request->input('content'),
            'excerpt'      => $request->excerpt ?? Str::limit(strip_tags($request->input('content')), 150),
            'status'       => $request->status ?? 'published',
            'published_at' => now(),
        ]);

        return redirect()->route('admin.news.index')->with('success', 'News article published!');
    }

    public function edit(string $id)
    {
        $item = News::findOrFail($id);
        return view('admin.news.edit', compact('item'));
    }

    public function update(Request $request, string $id)
    {
        $item = News::findOrFail($id);
        $request->validate([
            'title'   => 'required|string|max:255',
            'content' => 'required|string',
        ]);

        $item->update([
            'title'   => $request->title,
            'excerpt' => $request->excerpt ?? Str::limit(strip_tags($request->input('content')), 150),
            'content' => $request->input('content'),
            'status'  => $request->status ?? $item->status,
        ]);

        return redirect()->route('admin.news.index')->with('success', 'News updated!');
    }

    public function destroy(string $id)
    {
        News::findOrFail($id)->delete();
        return redirect()->route('admin.news.index')->with('success', 'News deleted!');
    }
}
