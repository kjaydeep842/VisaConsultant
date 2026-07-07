<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\BlogCategory;
use App\Models\BlogComment;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function index(Request $request)
    {
        $query = Blog::published()->with('author', 'category');

        if ($request->category) {
            $query->whereHas('category', fn($q) => $q->where('slug', $request->category));
        }

        if ($request->search) {
            $query->where(function ($q) use ($request) {
                $q->where('title', 'like', '%'.$request->search.'%')
                  ->orWhere('excerpt', 'like', '%'.$request->search.'%');
            });
        }

        if ($request->tag) {
            $query->whereJsonContains('tags', $request->tag);
        }

        $blogs = $query->orderBy('published_at', 'desc')->paginate(9);
        $categories = BlogCategory::where('is_active', true)->withCount('blogs')->get();
        $latestBlogs = Blog::published()->orderBy('published_at', 'desc')->take(5)->get(['id', 'title', 'slug', 'published_at', 'featured_image']);
        $trendingBlogs = Blog::published()->orderBy('views', 'desc')->take(5)->get(['id', 'title', 'slug', 'views', 'featured_image']);

        return view('web.blog', compact('blogs', 'categories', 'latestBlogs', 'trendingBlogs'));
    }

    public function show($slug)
    {
        $blog = Blog::published()->with('author', 'category', 'comments.replies')->where('slug', $slug)->firstOrFail();
        $blog->incrementViews();

        $relatedBlogs = Blog::published()
            ->where('id', '!=', $blog->id)
            ->where('category_id', $blog->category_id)
            ->take(3)->get();

        $categories = BlogCategory::where('is_active', true)->withCount('blogs')->get();

        return view('web.blog-show', compact('blog', 'relatedBlogs', 'categories'));
    }

    public function storeComment(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'comment' => 'required|string|max:1000',
        ]);

        $blog = Blog::findOrFail($id);

        BlogComment::create([
            'blog_id' => $blog->id,
            'user_id' => auth()->id(),
            'name' => $request->name,
            'email' => $request->email,
            'comment' => $request->comment,
            'parent_id' => $request->parent_id,
            'status' => 'pending',
        ]);

        return back()->with('success', 'Comment submitted for review.');
    }
}
