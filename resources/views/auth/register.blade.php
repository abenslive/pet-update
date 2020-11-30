@extends('layouts.front')
@section('title', 'Sign Up')
@section('content')
    <div class="col-8 offset-2">
        <div class="card">
            <div class="card-header">
                Create Account
            </div>
            <div class="card-body">
                <form action="{{route('register')}}" method="POST">
                    @csrf
                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <label>Email</label>
                            <input type="email" name="email"  class="form-control @error('email') is-invalid @enderror" value="{{old('email')}}" required>
                            @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{$message}}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="form-group col-md-12">
                            <label>Password</label>
                            <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" required>
                            @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{$message}}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="form-group col-md-12">
                            <label>Password Confirmation</label>
                            <input type="password" name="password_confirmation" class="form-control @error('password_confirmation') is-invalid @enderror" required>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">Sign in</button>
                </form>
            </div>
        </div>
    </div>


@endsection

