<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Image;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StorePostRequest;

class PostController extends Controller
{public function index()
    {
        $posts = Post::get();

        return view('post', compact('posts'));
    }

    public function create()
    {
        return view('post-create');
    }

    public function edit($id)
    {
        return view('post-edit');
    }

    public function show($id)
    {
        return view('post-show');
    }
}
