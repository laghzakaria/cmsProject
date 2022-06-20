@extends('layouts.app')
@section('content')
    <div class="card card-default">
        <div class="card-header">{{__('Create')}} post</div>
        <div class="card-body">
            
            <x-form action="{{route('posts.store')}}" btnValue="{{__('Add')}} Post">
                @include('posts.form')
            </x-form>
        </div>
    </div>
@endsection

