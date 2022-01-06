@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row">

        <div class="col">
            <div class="jumbotron">
                <a class="btn btn-success" href="{{route('users.index')}}"><i class="fas fa-home"></i></a>
            </div>
        </div>
    </div>



    <div class="col-md-3">
    <div class="well">
        <form action="{{route('users.store')}}"  method="POST">
            @csrf
            <h2>New User</h2>
            <div class="mb-3">
                <label >Name</label>
                <input class="form-control" name="name" type="text">
            </div>
            <div class="mb-3">
                <label >email</label>
                <input class="form-control" name="email" type="email">
            </div>
            <div class="mb-3">
                <label >password</label>
                <input class="form-control" name="password" type="password">
            </div>
            <div class="mb-3">
                <label >confirm password</label>
                <input class="form-control" name="password_confirmation" type="password">
            </div>

            <div class="mb-3">
                <button class="btn btn-primary btn-block btn-h1-spacing" type="submit">Save</button>
            </div>
        </form>
    </div>
</div>
@endsection


