@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row">

            <div class="col">
                <div class="jumbotron">
                    <a class="btn btn-success" href="{{ route('users.index') }}">Users</a>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-8">
                <h1>Roles</h1>
                <table class="table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Role</th>
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
                                <td>{{ $item->name }}</a></td>
                                <td>
                                    {{-- <a href="{{ route('Tag.edit', $item->id) }}"><i class="fas fa-2x fa-edit"></i></a>
                                    <form action="{{ route('Tag.destroy', $item->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger"><i
                                                class="fas  fa-trash-alt"></i></button>
                                    </form> --}}

                                    @if ($item->is_admin == 1)
                                    Admin
                                    @else
                                    User
                                    @endif
                                </td>
                                <td><a href="{{ route('roles.edit', $item->id) }}"><i class="fas fa-2x fa-edit"></i></a></td>

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
