@extends('layouts.app')

@section('content')


<div class="container">
    <div class="row">

        <div class="col">
            <div class="jumbotron">
                <h1 class="display-4">Create Post</h1>
                <a class="btn btn-success" href="{{route('Post.index')}}">Home</a>
            </div>
        </div>
    </div>
    <div class="row">

        @if (count($errors)>0)
            @foreach ($errors as $items)
                <div class="alert alert-danger" role="alert">
                    {{ $items }}
                </div>

            @endforeach
        @endif
        <div class="col">
            <form action="{{ route('Post.store')}}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="formgroup">
                        @foreach ($tags as $item)
                            <input type="checkbox"  name="name[]" value="{{$item->id}}">
                            <label for="">{{$item->name}}</label>
                        @endforeach
                </div>


                <div class="jumbotron">
                    <div class="mb-3">
                        <label for="exampleFormControlInput1" class="form-label">title</label>
                        <input type="text" class="form-control" name="title" id="exampleFormControlInput1" >
                    </div>

                    <div class="mb-3">
                        <label for="exampleFormControlTextarea1" class="form-label">subject</label>
                        <textarea class="form-control" name="subject" id="exampleFormControlTextarea1" rows="3" placeholder="what's on your mind, {{ $user->name }}?"></textarea>
                    </div>

                    <div class="mb-3">
                        <label for="exampleFormControlInput1" class="form-label">Upload</label>
                        <input type="file" class="form-control" name="photo" id="exampleFormControlInput1" >
                    </div>

                    <div class="mb-3">
                        <button class="btn btn-danger" type="submit">Save</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

@endsection
