<?php

namespace App\Http\Controllers;

use App\Http\Requests\RequestStoreComment;
use App\Mail\CommentPost;
use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class CommentsController extends Controller
{
    public function store(RequestStoreComment $request,$id){
        $post=Post::find($id);
        $comment=$post->comments()->create([
            'content'=>$request->content,
            'user_id'=>$request->user()->id
        ]);
        Mail::to($post->user->email)->send(new CommentPost($comment));
        return redirect()->back();

    }
}
