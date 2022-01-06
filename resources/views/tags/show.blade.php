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
        <div class="row">
            <div class="col-md-8">
                <h1><small> {{ $tag->posts()->count() }} Posts</small></h1>
            </div>
        </div>



        <div class="row">
            <div class="col-md-12">
                <table class="table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Title</th>
                            <th>Tags</th>
                            <th></th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($tag->posts as $post)
                            <tr>
                                <th>{{ $post->id }}</th>
                                <td>{{ $post->title }}</td>
                                <td>
                                    @foreach ($post->tags as $tag)
                                        <span class="label label-default">{{ $tag->name }}</span>
                                    @endforeach
                                </td>
                                <td>
                                    <a href="{{ route('Post.show', $post->slug) }}" class="btn btn-default btn-xs"><i class="fas fa-2x fa-eye"></i></a>
                                    <a href="{{ route('Post.edit', $post->id) }}"><i class="fas fa-2x fa-edit"></i></a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
