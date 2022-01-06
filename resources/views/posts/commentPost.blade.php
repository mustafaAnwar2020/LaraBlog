@extends('layouts.app')

@section('content')


    <div class="container">
        <div class="row">
            <div class="row">
                <div class="col">
                    <div class="card" style="text-align:center">
                        <div class="card" style="text-align:center">
                            <h5 class="card-text">{{ $comment->title }}</h5>
                            <p class="card-text">{{ $comment->body }}</p>
                            <p class="date text-black-50">{{ $comment->created_at->diffForhumans() }}</p>
                            <p>{{ $comment->user->name }}</p>
                            <div class="btn-group" role="group" aria-label="Basic example">
                                <a class="btn btn-success" href="{{ route('reply.index', $comment->id) }}"><i
                                        class="fas fa-comments"></i></a>
                            </div>
                        </div>



                        @foreach ($reply as $item)

                            @if ($comment->id == $item->parent_id && $item->post_id == $comment->post_id)
                                <div class="card" style="text-align:center">
                                    <h5 class="card-text">{{ $item->title }}</h5>
                                    <p class="card-text">{{ $item->body }}</p>
                                    <p class="date text-black-50">{{ $item->created_at->diffForhumans() }}</p>
                                    <p>{{ $item->user->name }}</p>
                                    <div class="btn-group" role="group" aria-label="Basic example">
                                        <a class="btn btn-success" href="{{ route('reply.index', $item->id) }}"><i
                                                class="fas fa-comments"></i></a>
                                        <a class="btn btn-success" href="{{ route('comments.show', $item->id) }}"><i
                                                class="fas fa-eye"></i></a>
                                        @if ($item->user_id == Auth::id() || auth()->user()->is_admin == 1)
                                            &nbsp;&nbsp;
                                            <div class="btn-group" role="group" aria-label="Basic example">
                                                &nbsp;&nbsp;
                                                <form action="{{ route('comments.destroy', $item->id) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger"><i
                                                            class="fas  fa-trash-alt"></i></button>
                                                </form>
                                        @endif
                                    </div>
                                </div>
                            @endif
                        @endforeach

                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
