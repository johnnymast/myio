@extends('layouts.master')

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
                                <div class="help-custom is-success">
                                    {{ session('status') }}
                                </div>
                            @endif

                            <form role="form" method="POST" action="{{ route('password.email') }}">
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

                                <hr>
                                <p class="control">
                                    <button class="button is-info">Send Password Reset Link</button>
                                </p>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    </section>

@endsection
