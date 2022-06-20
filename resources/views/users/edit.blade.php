@extends('layouts.app')
@section('content')
<div class="col-8 mx-auto">
    <x-form action="{{route('users.update',$user->id)}}" btnValue="Save Picture">
        @method('PUT')
        <div class="form-group">
             <h1>{{$user->name}}</h1>
        </div>
        @if($user->image)
            <img src="{{$user->image->path}}" class="card-img-top img-thumbnail img-fluid" style="width: 300px;" alt="user picture">
        @endif
        <div class="form-group">
            <label for="image">Add Picture</label>
            <input type="file" name="image" id="image" class="form-control" >
        </div>
    </x-form>
</div>
@endsection