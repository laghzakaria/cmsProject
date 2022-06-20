<?php

namespace App\Http\Controllers;

use App\Http\Requests\tags\createRequest;
use App\Http\Requests\tags\updateRequest;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;

class TagsController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tags=Tag::all();
        return view('tags.index',[
            'tags'=>$tags,
            'tab'=>'list'
        ]);
    }
    

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('tags.create');
    }
//tags archived
    public function archive(){
        $tags=Tag::onlyTrashed()->get();
        
        
        $users=Cache::remember('interactiveUsers',now()->addHour(),function(){
            return User::interactiveUsers()->take(5)->get();
        });
        return view('tags.index',[
            'tags'=>$tags,
            'tab'=>'archive',
            'interactiveUsers'=>$users
            ]);   
    }

    //all tags  
    public function all(){
        
        $tags=Tag::withTrashed()->get();
        
        
        $users=Cache::remember('interactiveUsers',now()->addHour(),function(){
            return User::interactiveUsers()->take(5)->get();
        });        
        return view('tags.index',[
            'tags'=>$tags,
            'tab'=>'all',
            'interactiveUsers'=>$users
            ]);    
    }
    //restore tag
    public function restore($id){
       $tag=Tag::onlyTrashed()->where('id',$id)->first();
       $this->authorize("update",$tag);
       $tag->restore();
       $tag->save();
       return redirect()->route('tags.index');
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(createRequest $request)
    {
        $data=[
            'name'=>$request->name,
            'user_id'=>Auth::id()
        ];
        Tag::create($data);
        return redirect()->route('tags.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $tag=Tag::find($id);
        return view('tags.edit',[
            'tag'=>$tag
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(createRequest $request, $id)
    {
        $tag=Tag::find($id);
        $this->authorize("update",$tag);
        $data=[
            'name'=>$request->name,
            'user_id'=>Auth::id()
        ];
        $tag->update($data);
        return redirect()->route('tags.index');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $tag=Tag::find($id);
        if($tag->posts->count()>0){
            session()->flash('error','you can\'t archive this tag');
            return redirect()->back();
        }
        $tag->destroy($id);
        return redirect()->route('tags.index');
    }
    //physical delete
    public function delete($id){
        $tag=Tag::onlyTrashed()->where('id',$id)->first();
        $this->authorize("forceDelete",$tag);
        $tag->forceDelete();
        return redirect()->route('tags.index');

    }  
}
