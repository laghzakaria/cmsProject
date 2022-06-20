@extends('layouts.app')
@section('content')
<div class="containet">
    <div class="row">
        <div class="col-12">
            <div class="d-flex justify-content-end mb-2">
                <a href="{{route('posts.create')}}" class="btn btn-success">{{__('Add')}} Post</a>
            </div>
            <div class="card card-default">
                <div class="card-header d-flex bd-highlight mb-3">
                    <div class="col-6" style="display: flex">
                        <p class="p-2 bd-highlight">Posts</p> 
                        <div class="flex-end ms-auto p-2 bd-highlight">{{$posts->appends(['search'=>request()->query('search')])->links()}}</div>
                    </div>
                   <div class="col-6">
                       <form action="{{route('posts.index')}}" method="GET" class="input-group">
                       <input type="text" value="{{request()->query('search')}}" class="form-control" name="search" placeholder="search">
                        <button class="search-button">
                    </form>                
                   </div>
                </div>
                <div class="card-body">
                    <ul class="list-group d-flex flex-wrap justify-content-center flex-row">
                        @foreach ($posts as $post)
                            <x-card src="{{isset($post->image) ? $post->image->path : ''}}" title="{{$post->title}}" description="" content="">
                                <p>category: {{$post->category->name}}</p>
                                    <a href="{{route('posts.show',$post->id
                                        )}}" class="btn btn-success">{{__('Show')}}</a>
                            </x-card>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
        
    </div>
</div>
    
@endsection