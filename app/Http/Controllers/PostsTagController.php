<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Tag;
use Illuminate\Http\Request;

class PostsTagController extends Controller
{
    public function index($id){
        $posts=Tag::find($id)->posts;
        return view('posts.index',[
            'posts'=>$posts
        ]);
    }
}
