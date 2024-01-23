@extends('main')
@section("content")
<div class="container d-flex align-items-center justify-content-center">
    <div class="col-sm-6 border rounded p-4 mt-5">

        <div class="container text-center mb-4">
            <h1>Register</h1>
        </div>

        @if(session('success'))
                <div class="container alert alert-success text-center">
                    {{ session('success') }}
                </div>
        @endif

        @if(isset($error))
                <div>
                    {{ $error }}
                </div>
        @endif

        <form action="/register" method="POST">
            @csrf
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">User Name</label>
                <input type="text" name="name" class="form-control" id="exampleInputEmail1" placeholder="User Name" value="{{ old('name') }}">
                @error('name')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Email address</label>
                <input type="email" name="email" class="form-control" id="exampleInputEmail1" placeholder="Email" value="{{ old('email') }}">
                @error('email')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Password</label>
                <input type="password" name="password" class="form-control" id="exampleInputPassword1" placeholder="Password" value="{{ old('password') }}">
                @error('password')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="mb-3">
                <label for="exampleInputPassword2" class="form-label">Confirm Password</label>
                <input type="password" name="password_confirmation" class="form-control" id="exampleInputPassword2" placeholder="Confirm Password" value="{{ old('password_confirmation') }}">
                @error('password_confirmation')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="mb-3 text-center">
                <button type="submit" class="btn btn-primary">Register</button>
            </div>
            <div class="text-center">
                <p>Already registered? <a href="/login">Sign In</a></p>
            </div>
        </form>

    </div>
</div>
@endsection