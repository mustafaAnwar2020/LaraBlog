@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row">

        <div class="col">
            <div class="jumbotron">
                <a class="btn btn-success" href="{{route('Tag.index')}}"><i class="fas fa-home"></i></a>
            </div>
        </div>
    </div>



    <div class="col-md-3">
    <div class="well">
        <form action="{{route('Tag.store')}}"  method="POST">
            @csrf
            <div class="mb-3">
                <h2>New Tag</h2>
                <label >Name</label>
                <input class="form-control" name="name" type="text">
            </div>

            <div class="mb-3">
                <button class="btn btn-primary btn-block btn-h1-spacing" type="submit">Save</button>
            </div>
        </form>
    </div>
</div>
@endsection


