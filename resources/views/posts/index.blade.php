@extends('layouts.app')

@section('content')


    @if (count($post) > 0)
        <div class="container">
            <div class="row">
                <div class="col">
                    <div class="jumbotron">
                        <h1 class="display-4">Posts</h1>
                        <a class="btn btn-success" href="{{ route('Post.create') }}">Create</a>
                        <a class="btn btn-danger" href="{{ route('posts.trash') }}">Recycle Bin <i
                                class="fas  fa-trash-alt"></i></a>
                    </div>
                </div>
            </div>
            <div class="col">
                {{-- <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Title</th>
                            <th scope="col">Photo</th>
                            <th scope="col">Actions</th>
                        </tr>
                    </thead>
                    <tbody> --}}
                        @php
                            $i = 0;
                        @endphp
                        @foreach ($post as $item)

                            <div class="col">
                                <div class="card" style="margin-left:250px;padding-top;100px;width: 45rem;text-align:center">
                                    <img src="{{ URL::asset($item->photo) }}" class="card-img-top"
                                        alt="{{ $item->photo }}">
                                    <div class="card-body">
                                        <h5 class="card-text">{{ $item->title }}</h5>
                                        <p class="card-text">{{ $item->subject }}</p>
                                        <p>{{ $item->created_at->diffForhumans() }}</p>
                                        <p>{{ $item->user->name }}</p>
                                        @if ($item->user_id == Auth::id() || auth()->user()->is_admin == 1)
                                        &nbsp;&nbsp;
                                        <div class="btn-group" role="group" aria-label="Basic example">
                                            <a  class="btn btn-success"href="{{route('Post.edit',$item->id)}}"><i class="fas fa-2x fa-edit"></i></a>
                                            &nbsp;&nbsp;
                                            <form action="{{route('Post.destroy',$item->id)}}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger"><i class="fas  fa-trash-alt"></i></button>
                                            </form>
                                        @endif
                                        &nbsp;&nbsp;
                                        <a class="btn btn-success" href="{{route('comment.index',$item->id)}}"><i class="fas fa-comments"></i></a>
                                        <a class="btn btn-success" href="{{route('Post.show',$item->slug)}}"><i class="fas fa-eye"></i></a>
                                        </div>
                                    </div>

                                </div>
                            </div>



                        @endforeach

            @else
                <div class="col">
                    <div class="alert alert-primary" role="alert">
                        you are all caught up for now
                    </div>
                </div>

    @endif
    </div>

    </div>
@endsection
