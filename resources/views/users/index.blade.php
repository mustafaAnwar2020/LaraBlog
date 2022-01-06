@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row">

            <div class="col">
                <div class="jumbotron">
                    <a class="btn btn-success" href="{{ route('users.create') }}">create</a>
                    <a class="btn btn-success" href="{{ route('roles.index') }}">roles</a>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-8">
                <h1>Users</h1>
                <table class="table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>email</th>
                            <th>Action</th>
                        </tr>
                    </thead>

                    <tbody>
                        @php
                            $i = 0;
                        @endphp
                        @foreach ($user as $item)
                            <tr>
                                <th>{{ ++$i }}</th>
                                <td>{{$item->name}}</td>
                                <td>{{$item->email}}</td>
                                <td>
                                    <form action="{{ route('users.destroy', $item->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger"><i
                                                class="fas  fa-trash-alt"></i></button>
                                    </form>
                                </td>

                            </tr>
                        @endforeach


                    </tbody>
                </table>
            </div>

            <div class="col-md-3">
                <div class="well">

                </div>
            </div>
        </div>
    </div>

@endsection
