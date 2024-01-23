@extends('main')
@section("content")
<div class="container d-flex align-items-center justify-content-center ">
    <div class="col-sm-6 border rounded p-4 mt-5">

        <div class="container text-center mb-4">
            <h1>Login</h1>
        </div>

        @if(isset($error))
        <div class="alert alert-danger">
            {{ $error }}
        </div>
        @endif

        <form action="/login" method="POST">
            @csrf
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Email address</label>
                <input type="email" name="email" class="form-control" id="exampleInputEmail1" placeholder="Email" value="{{ old('email') }}">
                @error('email')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Password</label>
                <input type="password" name="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
                @error('password')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="mb-3 text-center">
                <button type="submit" class="btn btn-primary">Login</button>
            </div>
            <div class="text-center">
                <p>Dont have an account? <a href="/register">SignUp</a></p>
            </div>
        </form>

    </div>
</div>
@endsection
