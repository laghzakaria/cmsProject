@extends('layouts.app')
@section('content')
<div class="row">
  <div class="col-8"><div class="d-flex justify-content-end mb-2">
        <a href="{{route('categories.create')}}" class="btn btn-success">{{__('Add')}} Category</a>
    </div>
    <div class="card card-default">
        <div class="card-header">Categories
            <nav class="nav nav-tabs nav-stacked my-5">
                <x-nav-link route="categories.index" tab={{$tab}} active="list">Categories</x-nav-link>
                <x-nav-link route="categories.archive" tab={{$tab}} active="archive">archive</x-nav-link>
                <x-nav-link route="categories.all" tab={{$tab}} active="all">all</x-nav-link>
            </nav>
        </div>
        <div class="card-body">
            <ul class="list-group">
                @foreach ($categories as $category) 
                   <li class="list-group-item">
                           {{$category->name}}
                           <p class="fs-5 fst-italic text-muted">{{__('Created By')}} : {{$category->user->name}}</p> 
                           <p class="fs-5 fst-italic text-muted">{{__('Number Of Posts')}} : {{$category->posts_count}}</p> 
                           @if(!$category->deleted_at)
                                @can("update",$category)
                                  <a href="{{route('categories.edit',$category->id
                                  )}}" class="btn btn-success">{{__('Edit')}}</a>
                                @endcan
                                @can("delete",$category)
                                  @if($category->posts_count==0)
                                  <form class="d-inline" action="{{route('categories.destroy',$category->id
                                  )}}" method="POST" >
                                     @csrf
                                     @method('DELETE')
                                     <button class="btn btn-primary">{{__('Archive')}}</button>
                                 </form>
                                 @endif
                               @endcan
                            @else
                               @can("restore",$category)
                                 <form class="d-inline" action="{{route('categories.restore',$category->id
                                  )}}" method="POST" >
                                     @csrf
                                     @method('PATCH')
                                     <input type="submit" value="{{__('Restore')}}" class="btn btn-success" />
                                 </form>
                               @endcan
                               @can("forceDelete",$category)
                                 <form class="d-inline" action="{{route('categories.delete',$category->id
                                  )}}" method="POST" >
                                      @csrf
                                      @method('DELETE')
                                      <button class="btn btn-danger">{{__('Delete')}}</button>
                                  </form>
                                @endcan
                               {{-- <button type="button" class="btn btn-danger" id="handleDeleteModal">
                                delete
                              </button> --}}
                              {{-- <!-- Modal -->
                                <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                      <div class="modal-content">
                                        <div class="modal-header">
                                          <h5 class="modal-title" id="deleteModalLabel">delete category</h5>
                                        </div>
                                        <div class="modal-body">
                                          do you realy want to drop this category
                                        </div>
                                        <div class="modal-footer">
                                          <a type="button" class="btn btn-secondary" data-bs-dismiss="modal" href="{{route('categories.archive')}}">cancel</a>
                                          <form class="d-inline" action="{{route('categories.delete',$category->id
                                            )}}" method="POST" >
                                                @csrf
                                                @method('DELETE')
                                                <button class="btn btn-danger">delete</button>
                                            </form>
                                        </div>
                                      </div>
                                    </div>
                                  </div> --}}
                            @endif

                       
                   </li>
                   
                @endforeach
            </ul>
        </div>
        <!-- Button trigger modal -->

  
  
    </div>
</div>
  <div class="col-4">
    <div class="card">
      <div class="card-body">
        <h4 class="card-title">{{__('Most Interactive Users')}}</h4>
      </div>
      <ul class="list-group list-group-flush">
        @foreach($interactiveUsers as $user)
          <li class="list-group-item">{{$user->name}}
          <p class="text-muted">{{__('Number Of Posts')}} :
            <x-badge type="success">{{$user->categories_count}}</x-badge>
          </p>
          </li>
        @endforeach
      </ul>
    </div>
  </div>
</div>
    
@endsection

@section('script')
    {{-- <script>
        let btn=document.getElementById("handleDeleteModal");
        btn.addEventListener('click',function(){
            $('#deleteModal').modal('show');
        });
    </script> --}}
@endsection