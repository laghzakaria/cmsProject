@extends('layouts.app')
@section('content')
    <div class="card card-default">
        <div class="card-header">{{__('Edit')}} Post</div>
        <div class="card-body">
            
            <x-form action="{{route('posts.update',$post->id)}}" btnValue="{{__('Edit')}} Post">
                @method('PUT')
                @include('posts.form')
                
            </x-form>
        </div>
    </div>
@endsection
{{-- @section('myScript')
    <script>
        $(function () {
        $('#tags').multipleSelect()
      })
    </script>
@endsection --}}