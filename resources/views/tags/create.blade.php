@extends('layouts.app')
@section('content')
<div class="card card-default">
    <div class="card-header">{{__('Create')}} tag</div>
    <div class="card-body">
    <x-form action="{{route('tags.store')}}" btnValue="{{__('Create')}} tag">
        @include('tags.form')
    </x-form>
    </div>
</div>
@endsection