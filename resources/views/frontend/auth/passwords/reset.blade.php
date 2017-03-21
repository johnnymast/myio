@extends('frontend.layouts.master')

@section('content')
    <section class="hero is-medium is-bold hero-background">
        <div class="hero-body">
            <div class="container">
                <div class="columns is-vcentered">
                    <div class="column is-4 is-offset-4">
                        <h1 class="title color-is-white">
                            Reset Password
                        </h1>
                        <div class="box">
                            @if (session('status'))
                                <div class="alert alert-success">
                                    {{ session('status') }}
                                </div>
                            @endif

                            <form role="form" method="POST" action="/password/reset">
                                {{ csrf_field() }}

                                <input type="hidden" name="token" value="{{ $token }}">

                                <label class="label">E-mail Address</label>
                                <p class="control">

                                    <input class="input" id="email" type="email" name="email" value="{{ old('email') }}" required autofocus>

                                    @if ($errors->has('email'))
                                        <span class="help is-danger">
                                            <strong>{{ $errors->first('email') }}</strong>
                                        </span>
                                    @endif
                                </p>

                                <label class="label">Password</label>
                                <p class="control">

                                    <input class="input" id="password" type="password"  name="password" value="{{ old('password') }}" required autofocus>

                                    @if ($errors->has('password'))
                                        <span class="help is-danger">
                                            <strong>{{ $errors->first('password') }}</strong>
                                        </span>
                                    @endif
                                </p>

                                <label class="label">Confirm Password</label>
                                <p class="control">

                                    <input class="input" id="password_confirmation" type="password"  name="password_confirmation" required autofocus>

                                    @if ($errors->has('password_confirmation'))
                                        <span class="help is-danger">
                                            <strong>{{ $errors->first('password_confirmation') }}</strong>
                                        </span>
                                    @endif
                                </p>

                                <hr>
                                <p class="control">
                                    <button class="button is-info">Reset Password</button>
                                </p>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </section>
@endsection
