{{-- card  with image in top--}}
@if($content)
<div class="card">
    <div class="container">
        <div class="row">
            <img class="card-img-top img-fluid rounded p-0 m-0 col-md-5" style="height: auto;width:100%" src="{{$src}}" alt="Card image cap">
            <div class="card-body mx-auto col-md-6">
            <h4 class="card-title text-center">{{$title}}</h4>
            <ul class="list-group list-group-flush">
                @if($description)
                <li class="list-group-item text-center">{{$description}}</li>
                @endif
                @if($content)
                <li class="list-group-item text-center">{{$content}}</li>
                @endif
                <li class="list-group-item text-center">{{$slot}}</li>
            </ul>
            </div>
    </div>
        </div>
    </div>
    
@else
{{-- card  with image in the left--}}
<div class="card col-3 m-3 p-0">
        <img class="card-img-top img-fluid rounded m-0" style="height: 10rem;width:100%" src="{{$src}}" alt="Card image cap">
    <div class="card-body mx-auto">
        <h4 class="card-title">{{$title}}</h4>
    </div>
    <ul class="list-group list-group-flush">
        @if($description)
            <li class="list-group-item text-center">{{$description}}</li>
        @endif
        @if($content)
            <li class="list-group-item text-center">{{$content}}</li>
        @endif
        <li class="list-group-item text-center">{{$slot}}</li>
    </ul>
</div>
@endif
