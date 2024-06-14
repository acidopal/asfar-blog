<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\BlogPost;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Auth;

class BlogPostController extends Controller
{
     /**
     * Display a listing of the Blog Post.
     */
      public function index() {
        $blogPosts = BlogPost::paginate(10);

        return response()->json([
            'message' => 'List Blog Post',
            'data' => $blogPosts
        ]);
      }

    /**
     * Display a detail of the Blog Post.
     */
      public function show($id) 
      {
          $blogPost = BlogPost::findOrFail($id);
  
          return response()->json([
                'message' => 'Detail Blog Post',
              'data' => $blogPost
          ]);
      }
}