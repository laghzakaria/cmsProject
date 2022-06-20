<x-error></x-error>
<div class="form-group">
    <label for="name">{{__('Name')}}</label>
    <input type="text" name="name" id="name" class="form-control" value="{{old('name',isset($category) ? $category->name : '') ?? NULL}}">
</div>