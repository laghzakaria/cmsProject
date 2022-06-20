<?php

namespace App\Http\Controllers;

use App\Http\Requests\RequestUpdatePost;
use App\Models\Category;
use App\Models\Comment;
use App\Models\Image;
use App\Models\Post;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;

class PostsController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
        $this->middleware('verifyCategoriesCount')->only(['create','edit']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $search=$request->search;
        if($search){
            $posts=Post::with('image')->where('title','LIKE',"%{$search}%")->simplePaginate(6);
        }else{
            $posts=Post::with('image')->simplePaginate(6);
        }
        return view('posts.index',['posts'=>$posts]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories=Category::all();
        $tags=Tag::all();
        return view('posts.create',[
            "categories"=>$categories,
            "tags"=>$tags
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RequestUpdatePost $request)
    {

        $data=$request->only(['title','description','content']);
        $data['user_id']=$request->user()->id;
        $data['category_id']=$request->category;
        $post=Post::create($data);

        //stocké l'image dans le dossier posts dans storage
        if($request->hasFile('image')){

            $path=$request->file('image')->store('posts');
            $url=Storage::url($path);
            $post->image()->save(Image::make(['path'=>$url]));
        }
        //relier le post à des tags
         $tags=$request->tags;
         $post->tags()->attach($tags);
        $request->session()->flash('success','post was created successefuly!');
        return redirect()->route('posts.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post=Post::find($id);
        $posts=Post::where('user_id',$post->user_id)->with('image')->get();
        $comments=Comment::take(5)->orderBy('updated_at','desc')->get();
        //utilisation du cache
        // $post=Cache::remember("post-show-{$id}",60,function() use ($id){
        //     return Post::find($id); 
        // });
        // //posts published by the same user
        // $posts=Cache::remember("posts-show-{$id}",60,function()use($post){
        //     return Post::where('user_id',$post->user_id)->get(); 
        // });
        return view('posts.show',[
            'post'=>$post,
            'postsOfUser'=>$posts,
            'comments'=>$comments,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post=Post::find($id);
        $categories=Category::all();
        $tags=Tag::all();
        return view('posts.edit',[
            "post"=>$post,
            "categories"=>$categories,
            "tags"=>$tags

        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(RequestUpdatePost $request, $id)
    {
        $data=$request->only(['title','description','content']);
        $post=Post::find($id);
        $this->authorize("update",$post);
        $data['user_id']=$request->user()->id;
        $data['category_id']=$request->category;
        $post->update($data);
        if($request->hasFile('image')){
            Storage::delete($post->image);
            $path=$request->file('image')->store('posts');
            $url=Storage::url($path);
        }
        $post->image()->save(Image::make(['path'=>$url]));
        //relier le post à des tags
        $tags=$request->tags;
        $post->tags()->sync($tags);
         
        $request->session()->flash('success','post was updated successufuly !');
        return redirect()->route('posts.show',$post->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        $this->authorize("delete",Post::find($id));
        Post::destroy($id);
        session()->flash('error','post was deleted successufuly !');
        return redirect()->route('posts.index');
    }
}
