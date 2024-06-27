<?php

namespace App\Http\Controllers\Frontend\Blog;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Blog;

class BlogController extends Controller
{
    public function blog()
    {
        $blogs     =  Blog::with('blog_category')->active()->orderBy('id', 'desc')->get();
        $blog_seo  = $blogs->first(); /* for blog listing page seo */
        
        return view('frontend.blog.blog.index', compact('blogs', 'blog_seo'));
    }

    public function blogDetail($slug)
    {
        $blog_detail  = Blog::with('blog_category')->where('slug', $slug)->first();

        return view('frontend.blog.blog_detail.index', compact('blog_detail'));
    }
}
