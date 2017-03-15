@extends('layouts.master')

@section('content')
    <section class="hero is-fullheight is-bold hero-background">

        <div class="hero-body">
            <div class="container">
                <div class="columns is-vcentered">
                    <div class="column is-4 is-offset-4">
                        <h1 class="title color-is-white">
                            MyIO Login
                        </h1>
                        <div class="box">
                            <form role="form" method="POST" action="{{ route('login') }}">
                                {{ csrf_field() }}

                                <label class="label">Email</label>
                                <p class="control">
                                    <input class="input" id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required autofocus>
                                    @if ($errors->has('email'))
                                        <span class="help is-danger">
                                            <strong>{{ $errors->first('email') }}</strong>
                                        </span>
                                    @endif
                                </p>
                                <label class="label">Password</label>
                                <p class="control">
                                    <input class="input" id="password" type="password" class="form-control" name="password" required>

                                    @if ($errors->has('password'))
                                        <span class="help is-danger">
                                            <strong>{{ $errors->first('password') }}</strong>
                                        </span>
                                    @endif
                                </p>
                                <hr>
                                <p class="control">

                                        <label>
                                            <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}>
                                            <span class="remember">Remember Me</span>
                                        </label>

                                    <button class="button is-primary">Login</button>
                                    <button class="button is-default">Cancel</button>
                                </p>
                        </div>
                        <p class="has-text-centered">
                            <a href="register.html">Register an Account</a>
                            |
                            <a href="{{ route('password.request') }}">Forgot password? </a>
                            |
                            <a href="#">Need help?</a>
                        </p>
                            </form>

                    </div>
                </div>
            </div>
        </div>

    </section>

@endsection
