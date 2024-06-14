<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BlogPost;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Auth;

class BlogPostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public static function middleware(): array
    {
        return [
            new Middleware('permission:blog-post-list|blog-post-create|blog-post-edit|blog-post-delete', only: ['index', 'store']),
            new Middleware('permission:blog-post-create', only: ['create', 'store']),
            new Middleware('permission:blog-post-edit', only: ['edit', 'update']),
            new Middleware('permission:blog-post-delete', only: ['destroy']),
        ];
    }

     /**
     * Display a listing of the resource.
     */
      public function index() {
        Gate::authorize('blog-post-list');

        $blogPosts = BlogPost::orderBy('created_at', 'desc')->paginate(10);

        return view('blog-posts.index', compact('blogPosts'));
      }

    /**
     * Show the form for creating a new resource.
     */
      public function create(){
        Gate::authorize('blog-post-create');
        
        return view('blog-posts.create');
      }

    /**
     * Store a newly created resource in storage.
     */
      public function store(Request $request){
        Gate::authorize('blog-post-create');

        $request->validate([
              'title' => 'required|string|max:255',
              'content' => 'required|string',
        ]);

        BlogPost::create([
              'title' => $request->title,
              'content' => $request->content,
              'user_id' => Auth::id(),
        ]);

        return redirect()->route('blog-posts.index');
      }

       /**
       * Display the specified resource.
       */
      public function show($id)
      {
          Gate::authorize('blog-post-list');

          $blogPost = BlogPost::findOrFail($id);
          $blogPost->title = e($blogPost->title);
          $blogPost->content = e($blogPost->content);

          return view('posts.detail', compact('blogPost'));
      }

      /**
       * Show the form for editing the specified resource.
       */
      public function edit(BlogPost $blogPost)
      {
          Gate::authorize('blog-post-edit');

          $blogPost->title = e($blogPost->title);
          $blogPost->content = e($blogPost->content);

          return view('blog-posts.edit', compact('blogPost'));
      }

      /**
       * Update the specified resource in storage.
       */
      public function update(Request $request, BlogPost $blogPost)
      {
          Gate::authorize('blog-post-edit');

          $request->validate([
              'title' => 'required|string|max:255',
              'content' => 'required|string',
          ]);

          $blogPost->title = e($request->title);
          $blogPost->content = e($request->content);


          $blogPost->save();

          return redirect()
              ->route('blog-posts.index')
              ->with('message', 'Blog updated successfully');
      }

      /**
       * Remove the specified resource from storage.
       */
      public function destroy(BlogPost $blogPost)
      {
          Gate::authorize('blog-post-delete');

          $blogPost->delete();
          return redirect()
              ->route('blog-posts.index')
              ->with('message', 'Blog deleted successfully');
      }
}