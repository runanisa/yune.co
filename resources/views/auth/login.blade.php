@extends('layouts.auth')

@section('title', 'Login Kasir')

@section('content')

<div class="auth-card"> <div class="auth-left"> 
    <img src="{{ asset('assets/images/furina2.png') }}" alt="Login Image" class="auth-illustration"> 
</div>
<div class="auth-right">
    <h3 class="mb-4">
        Hello,<br>
        <span>Welcome back</span>
    </h3>

    @if($errors->any())
        <div class="alert alert-danger">
            {{ $errors->first() }}
        </div>
    @endif

    <form method="POST" action="{{ route('login.post') }}">
        @csrf

        <div class="mb-3">
            <input type="email"
                   name="email"
                   class="form-control"
                   placeholder="Email"
                   required autofocus>
        </div>

        <div class="mb-3">
            <input type="password"
                   name="password"
                   class="form-control"
                   placeholder="Password"
                   required>
        </div>

        <button type="submit" class="btn btn-login w-100">
            Login
        </button>
    </form>
</div>

</div> @endsection