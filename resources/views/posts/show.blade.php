@extends('layouts.app')

@section('content')


    <div class="container">
        <div class="row">
            <div class="row">
                <div class="col">
                    <div class="card" style="text-align:center">
                        <img src="{{ URL::asset($post->photo) }}" class="card-img-top" alt="">
                        <div class="card-body">
                            <h5 class="card-text">{{ $post->title }}</h5>
                            <p class="card-text">{{ $post->subject }}</p>
                            <p class="date text-black-50">{{ $post->created_at->diffForhumans() }}</p>
                            <p>{{ $post->user->name }}</p>
                            <a href="{{ route('Post.index') }}" class="btn btn-success">All posts</a>
                        </div>



                        @foreach ($comment as $item)

                            @if ($post->id == $item->parent_id)
                                <div class="card" style="text-align:center">
                                    <h5 class="card-text">{{ $item->title }}</h5>
                                    <p class="card-text">{{ $item->body }}</p>
                                    <p class="date text-black-50">{{ $item->created_at->diffForhumans() }}</p>
                                    <p>{{ $item->user->name }}</p>
                                    <div class="btn-group" role="group" aria-label="Basic example">

                                        <a class="btn btn-success" href="{{ route('reply.index', $item->id) }}"><i
                                            class="fas fa-comments"></i></a>
                                    <a class="btn btn-success" href="{{route('comments.show',$item->id)}}"><i class="fas fa-eye"></i></a>
                                    @if ($item->user_id == Auth::id() || auth()->user()->is_admin == 1)
                                        &nbsp;&nbsp;
                                        <div class="btn-group" role="group" aria-label="Basic example">
                                            &nbsp;&nbsp;
                                            <form action="{{route('comments.destroy',$item->id)}}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger"><i class="fas  fa-trash-alt"></i></button>
                                            </form>
                                        @endif
                                    </div>

                                    {{-- @foreach ($reply as $data)
                                        @if ($item->id == $data->parent_id)
                                            <p class="date text-black-50">{{ $data->user->name }} added a comment to
                                                {{ $item->user->name }}</p>
                                            <h5 class="card-text">{{ $data->title }}</h5>
                                            <p class="card-text">{{ $data->body }}</p>
                                            <p class="date text-black-50">{{ $data->created_at->diffForhumans() }}</p>
                                            <p>{{ $data->user->name }}</p>
                                            <a class="card btn btn-success"
                                                href="{{ route('reply.index', $data->id) }}"><i
                                                    class="fas fa-comments"></i></a>
                                        @endif
                                    @endforeach --}}

                                </div>
                            @endif
                        @endforeach

                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
