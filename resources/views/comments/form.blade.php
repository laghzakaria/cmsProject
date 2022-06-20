<x-form action="{{route('comments.store',$postId)}}" btnValue="add comments">
      <label for="content"></label>
      <textarea name="content" id="content" class="form-control my-3" rows="5"></textarea>
      <x-error></x-error>
</x-form>