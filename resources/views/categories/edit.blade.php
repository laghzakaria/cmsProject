@extends('layouts.app')
@section('content')
    <div class="card card-default">
        <div class="card-header">{{__('Edit')}} category</div>
        <div class="card-body">
            
            <x-form action="{{route('categories.update',$category->id)}}" btnValue="{{__('Edit')}} Category">
                @method('PUT')
                @include('categories.form')
            </x-form>
        </div>
    </div>
@endsection