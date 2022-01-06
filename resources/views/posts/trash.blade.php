@extends('layouts.app')

@section('content')


@if (count(array($post))>0)
<div class="container">
    <div class="row">
        <div class="col">
            <div class="jumbotron">
            <h1 class="display-4">Recycle Bin</h1>
            <a class="btn btn-success" href="{{route('Post.index')}}"><i class="fas fa-home"></i></a>
            </div>
        </div>
    </div>
    <div class="col">
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Title</th>
                    <th scope="col">Photo</th>
                    <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $i=0;
                @endphp
                @foreach ($post as $item)
                    <tr>
                        <th scope="row">{{++$i}}</th>
                        <td>{{$item->title}}</td>
                        <td><img src="{{URL::asset($item->photo)}}" height="100" width="100" class="img-thumbnail"></td>
                        <td>
                            <a class="btn btn-danger" href="{{route('posts.delete',$item->id)}}" ><i class="fas  fa-trash-alt"></i></a>
                            <a class="btn btn-danger" href="{{route('posts.restore',$item->id)}}" ><i class="fas fa-trash-restore"></i></a>
                            {{-- <form action="{{route('Post.destroy',$item->id)}}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger"><i class="fas  fa-trash-alt"></i></button>
                            </form> --}}
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

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
