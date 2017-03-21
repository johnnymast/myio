@extends('frontend.layouts.master')

@section('content')
    <section class="hero is-fullheight is-bold hero-background">

        <div class="hero-body">
            <div class="container">
                <div class="columns is-vcentered">
                    <div class="column is-4 is-offset-4">
                        <h1 class="title color-is-white has-text-centered">
                            MyIO Login
                        </h1>
                        <div class="box">

                            @if (session('unverified'))
                                <span class="help-custom is-danger">
                                    {{ session('unverified') }}
                                </span>
                            @endif
                            <form role="form" method="POST" action="{{ route('login') }}">
                                {{ csrf_field() }}

                                <label class="label">Email</label>
                                <p class="control">
                                    <input class="input" id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required autofocus>
                                    @if ($errors->has('email'))
                                        <span class="help-custom is-danger">
                                            <strong>{{ $errors->first('email') }}</strong>
                                        </span>
                                    @endif
                                </p>
                                <label class="label">Password</label>
                                <p class="control">
                                    <input class="input" id="password" type="password" class="form-control" name="password" required>

                                    @if ($errors->has('password'))
                                        <span class="help-custom is-danger">
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
                                </p>

                                <p class="control">
                                    <button class="button is-info">Login</button>
                                    <button class="button is-default">Cancel</button>
                                </p>
                            </form>
                        </div>

                        <p class="has-text-centered">
                            <a href="{{ route('register') }}">Register an Account</a>
                            |
                            <a href="{{ route('password.request') }}">Forgot password? </a>
                            |
                            <a href="#">Need help?</a>
                        </p>
                    </div>
                </div>
            </div>
        </div>

    </section>

@endsection
