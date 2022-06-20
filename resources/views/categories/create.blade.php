@extends('layouts.app')
@section('content')
    <div class="card card-default">
        <div class="card-header">{{__('Create')}} category</div>
        <div class="card-body">
            <x-form action="{{route('categories.store')}}" btnValue="{{__('Add')}} Category">
                @include('categories.form')
            </x-form>
        </div>
    </div>
@endsection