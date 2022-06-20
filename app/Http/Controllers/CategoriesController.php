<?php

namespace App\Http\Controllers;

use App\Http\Requests\RequestCategory;
use App\Models\Category;
use App\Models\User;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;

class CategoriesController extends Controller
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
        //utilisation du cache
        // $categories=Cache::remember('categories',now()->addSeconds(100),function(){
        //     return Category::take(10)->withCount('post')->get();
        // });
        $categories=Category::withCount('posts')->get();
        

        return view('categories.index',[
            'categories'=>$categories,
            'tab'=>'list',
        ]);
    }
    //categories archived
    public function archive(){
        $categories=Category::onlyTrashed()->get();
                
        return view('categories.index',[
            'categories'=>$categories,
            'tab'=>'archive',
            // 'interactiveUsers'=>$users
            ]);   
    }

    //all categories  
    public function all(){
        
        $categories=Category::withTrashed()->get();
        
        return view('categories.index',[
            'categories'=>$categories,
            'tab'=>'all',
        ]);    
    }
    //restore categorie
    public function restore($id){
       $category=Category::onlyTrashed()->where('id',$id)->first();
       $this->authorize("update",$category);
       $category->restore();
       $category->save();
       return redirect()->route('categories.index');
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('categories.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RequestCategory $request)
    {
        $data=$request->validated();
        $data['user_id']=$request->user()->id;
        Category::create($data);
        $request->session()->flash('success','category was created successfully!');

        return redirect()->route('categories.index');
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
        $category=Category::find($id);
        $this->authorize("update",$category);

        return view('categories.edit',['category'=>$category]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(RequestCategory $request, $id)
    {
        $category=Category::find($id);
        // if(Gate::denies('category.update',$category)){
        //     return abort(403,"you can't edit this category");
        // }
        $this->authorize("update",$category);
        $category->name=$request->name;
        $category->save();
        $request->session()->flash('success','category was updated successfully!');
        return redirect()->route('categories.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category=Category::find($id);
        Category::destroy($id);
        $this->authorize("delete",$category);
        return redirect()->route('categories.index');
    }
    //physical delete
    public function delete($id){
        $category=Category::onlyTrashed()->where('id',$id)->first();
        $this->authorize("forceDelete",$category);
        $category->forceDelete();
        return redirect()->route('categories.index');

    }    
}
