@extends('layouts.master')


@section('content')

  <div class="container is-fluid full-width">
            <section class="hero is-medium hero-background" style="padding-top:43px;">
                <!-- Hero content: will be in the middle -->
                <div class="hero-body">
                    <div class="container has-text-centered">
                        <h1 class="title color-is-white">
                            Welcome To MyIO
                        </h1>
                        <h2 class="subtitle color-is-white">
                            <a href="{{ route('url_create') }}">Click to create Short URL</a>
                        </h2>
                    </div>
                </div>
            </section>
        </div>
@endsection