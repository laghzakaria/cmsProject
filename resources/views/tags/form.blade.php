<x-error></x-error>
<div class="form-group">
    <label for="name">{{__('Name')}}</label>
    <input type="text" name="name" id="name" value="{{ old('name',isset($tag) ? $tag->name : '') ?? NULL  }}">
</div>