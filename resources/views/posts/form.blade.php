<x-error></x-error>
<div class="form-group">
    <label for="title">{{__('Title')}}</label>
    <input type="text" name="title" id="title" class="form-control" value="{{old('title',isset($post->title) ? $post->title:'') ?? NULL}}">
</div>
<div class="form-group">
    <label for="description">Description</label>
    <textarea name="description" id="description" cols="5" rows="5" class="form-control" >{{old('description',isset($post->description) ? $post->description:'') ?? NULL}}</textarea>
</div>
<div class="form-group">
    <label for="content">{{__('Content')}}</label>
    <textarea name="content" id="content" cols="5" rows="5" class="form-control" >{{old('content',isset($post->content) ? $post->content:'') ?? NULL}}</textarea>
</div>
<div class="form-group">
    <label for="image">image</label>
    <input type="file" name="image" id="image" class="form-control" >
</div>
<div class="form-group">
    <label for="category">Category</label>
    <select name="category" id="category" class="form-control">
        @foreach ($categories as $category) 
           <option value="{{$category->id}}" 
            @if(isset($post))
                @if($post->category_id==$category->id)
                    selected
                @endif
            @endif>{{$category->name}}</option>
        @endforeach
    </select>
</div>
<div class="form-group">
    <label for="tags">Tags</label>
    <select name="tags[]" id="tags" class="form-control basic-multiple" multiple="multiple">
        @foreach ($tags as $tag)
           <option value="{{$tag->id}}">{{$tag->name}}</option>
        @endforeach        
    </select>
</div>