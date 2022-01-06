@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row">

            <div class="col">
                <div class="jumbotron">
                    <a class="btn btn-success" href="{{ route('Tag.create') }}">create</a>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-8">
                <h1>Tags</h1>
                <table class="table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Action</th>
                        </tr>
                    </thead>

                    <tbody>
                        @php
                            $i = 0;
                        @endphp
                        @foreach ($tag as $item)
                            <tr>
                                <th>{{ ++$i }}</th>
                                <td><a href="{{ route('Tag.show', $item->id) }}">{{ $item->name }}</a></td>
                                <td>
                                    <a href="{{ route('Tag.edit', $item->id) }}"><i class="fas fa-2x fa-edit"></i></a>
                                    <form action="{{ route('Tag.destroy', $item->id) }}" method="POST">
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
