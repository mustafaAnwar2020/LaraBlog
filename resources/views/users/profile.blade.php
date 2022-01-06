@extends('layouts.app')

@section('content')



    @php
    $genderArray = ['Male', 'Female'];
    @endphp
    <div class="container">

        @if (count($errors) > 0)
            @foreach ($errors as $items)
                <div class="alert alert-danger" role="alert">
                    {{ $items }}
                </div>

            @endforeach

        @endif
        <form method="POST" action="{{ route('profile.update') }}">
            @csrf
            @method('PUT')
            <div class="row mb-3">
                <label for="inputEmail3" class="col-sm-2 col-form-label">name</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" value="{{ $user->name }}" name="name">
                </div>
            </div>
            <div class="row mb-3">
                <label for="inputEmail3" class="col-sm-2 col-form-label">Facebook</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" value="{{$user->profile->facebook}}" name="facebook">
                </div>
            </div>
            <div class="row mb-3">
                <label for="inputEmail3" class="col-sm-2 col-form-label">province</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" value="{{ $user->profile->province }}" name="province">
                </div>
            </div>
            <div class="row mb-3">
                <label for="inputEmail3" class="col-sm-2 col-form-label">password</label>
                <div class="col-sm-10">
                    <input type="password" class="form-control" value="" name="password">
                </div>
            </div>
            <div class="row mb-3">
                <label for="inputEmail3" class="col-sm-2 col-form-label">confirm password</label>
                <div class="col-sm-10">
                    <input type="password" class="form-control" value="" name="confirm">
                </div>
            </div>
            <div class="form-group">
                <label for="exampleFormControlTextarea1">Gender</label>
                <select class="form-control" aria-label="Default select example" name="gender">
                    @foreach ($genderArray as $item)

                        <option value="{{ $item }}" {{ $user->profile->gender == $item ? 'selected' : '' }}>
                            {{ $item }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="exampleFormControlTextarea1">Bio</label>
                <textarea class="form-control" placeholder="Leave a comment here" name="bio" rows="3">
                    {!! $user->profile->bio !!}
                </textarea>
            </div>

            <div class="form-group">
                <button class="btn btn-success" type="submit">Update</button>
            </div>
        </form>
    </div>
@endsection
