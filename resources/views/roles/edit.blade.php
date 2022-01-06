@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row">

        <div class="col">
            <div class="jumbotron">
                <a class="btn btn-success" href="{{route('roles.index')}}"><i class="fas fa-home"></i></a>
            </div>
        </div>
    </div>

@php
    $rolesArray = [0,1];
@endphp

    <div class="col-md-3">
    <div class="well">
        <form action="{{route('roles.update',$user->id)}}"  method="POST">
            @method('PUT')
            @csrf
            <div class="mb-3">
                <h2>Edit Role</h2>
                <div class="form-group">
                    <label for="exampleFormControlTextarea1">Role</label>
                    <select class="form-control" aria-label="Default select example" name="role">
                        @foreach ($rolesArray as $item)

                            <option value="{{($item == 0 ? 'User' : 'Admin')}}" {{ $user->is_admin == $item ? 'selected' : '' }}>
                                {{($item == 0 ? 'User' : 'Admin')}}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="mb-3">
                <button class="btn btn-primary btn-block btn-h1-spacing" type="submit">Save</button>
            </div>
        </form>
    </div>
</div>
@endsection


