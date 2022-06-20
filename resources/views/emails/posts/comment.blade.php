<p>
    
    <a href="{{route('posts.show',$comment->post->id)}}">le post {{$comment->post->title}} is commented</a>
</p>

<p>
    {{$comment->user->name}} said: {{$comment->content}}
</p>