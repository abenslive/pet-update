@extends('layouts.back')
@section('title','Profile')
@section('content')
    <div class="container-fluid">

        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Update Profile</h6>
            </div>
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col m-2">
                        <form action="{{route('user-profile-information.update')}}" method="POST">
                            @method('PUT')
                            @csrf
                            <div class="form-row">
                                <div class="form-group col-md-12">
                                    <label for="name">Username</label>
                                    <input type="text" name="username" id="username" class="form-control @error('username') is-invalid @enderror" value="{{$user->username}}" required>
                                    @error('username')
                                    <span class="invalid-feedback" role="alert"><strong>{{$message}}</strong></span>
                                    @enderror
                                </div>
                                <div class="form-group col-md-12">
                                    <label>Your Email</label>
                                    <input type="email" name="email"  class="form-control @error('email') is-invalid @enderror" value="{{$user->email}}" required>
                                    @error('email')
                                    <span class="invalid-feedback" role="alert"><strong>{{$message}}</strong></span>
                                    @enderror
                                </div>
                                <div class="form-group col-md-12">
                                    <label>Your Name</label>
                                    <input type="text" name="name"  class="form-control @error('name') is-invalid @enderror" value="{{$user->name}}" required>
                                    @error('name')
                                    <span class="invalid-feedback" role="alert"><strong>{{$message}}</strong></span>
                                    @enderror
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary btn-block">Sign in</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
