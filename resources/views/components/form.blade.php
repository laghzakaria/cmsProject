<form action="{{$action}}" method="POST" enctype="multipart/form-data">
    @csrf
    {{$slot}}
    <div class="form-group">
        <button class="btn btn-success" type="submit">{{$btnValue}}</button>
    </div>
</form>