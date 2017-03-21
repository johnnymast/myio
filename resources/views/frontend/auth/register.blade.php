@extends('frontend.layouts.master')

@section('content')
    <section class="hero is-fullheight is-bold hero-background">

    <div class="hero-body">
        <div class="container">
            <div class="columns is-vcentered">
                <div class="column is-4 is-offset-4">
                    <h1 class="title color-is-white has-text-centered">
                        Join MyIO
                    </h1>
                    <div class="box">
                        <form role="form" method="POST" action="{{ route('register') }}">
                            {{ csrf_field() }}

                            <label class="label">Name</label>
                            <p class="control">
                                <input class="input" id="name" type="name" class="form-control" name="name" value="{{ old('name') }}" required autofocus>
                                @if ($errors->has('name'))
                                    <span class="help is-danger">
                                            <strong>{{ $errors->first('name') }}</strong>
                                        </span>
                                @endif
                            </p>

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

                            <label class="label">Confirm Password</label>
                            <p class="control">
                                <input class="input" id="password_confirmation" type="password" class="form-control" name="password_confirmation" required>
                            </p>

                            <hr>
                    <p class="has-text-centered">
                        <button class="button is-primary" type="submit">Register</button>
                    </p>
                    </form>

                </div>
            </div>
        </div>
    </div>

    </section>
@endsection
