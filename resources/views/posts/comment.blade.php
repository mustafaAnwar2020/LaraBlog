@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row">

            <div class="col">
                <div class="jumbotron">
                    <a class="btn btn-success" href="{{ route('Tag.index') }}"><i class="fas fa-home"></i></a>
                </div>
            </div>
        </div>



        <div class="col-md-3">
            <div class="well">
                <form action="{{ route('comments.store') }}" method="POST">
                    @csrf
                    <h2>comment to {{ $post->user->name }}'s post</h2>
                    <div class="form-group">
                        <label for="exampleFormControlInput1">title</label>
                        <input type="text" class="form-control" id="exampleFormControlInput1" name="title">
                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlTextarea1">comment</label>
                        <textarea class="form-control" id="exampleFormControlTextarea1" name="body"></textarea>
                    </div>
                    <div class="mb-3">
                        <input type="hidden" name="id" value="{{ $post->id }}">
                        <button class="btn btn-primary btn-block btn-h1-spacing" type="submit">Save</button>
                    </div>
                </form>
            </div>
        </div>
    @endsection
