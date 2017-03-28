@extends('layouts.master', ['title' => 'Create Short URL'])

@section('content')

    <div class="container is-fluid full-width">
        <section class="hero is-medium hero-background" style="padding-top:43px;">
            <div class="hero-body">
                <div class="container has-text-centered">
                    <div class="columns">
                        <div class="column is-half is-offset-one-quarter">
                            <div class="box">
                                @if(Session::has('message'))
                                    <div class="notification">
                                        {!! Session::get('message') !!}
                                    </div>
                                @endif
                                <div class="control is-horizontal">
                                    {!! Form::open(array('route' => 'url_store', 'class' => 'shortener-form')) !!}
                                    {{ csrf_field() }}

                                    <h3 class="title is-3">Create Short URL</h3>

                                    @if (count($errors) > 0)
                                        <div class="help-custom is-danger">
                                            <ul>
                                                @foreach ($errors->all() as $error)
                                                    <li>{{ $error }}</li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    @endif
                                    <div class="field is-grouped">
                                        <div class="control has-addons">
                                            {!! Form::text('url', null, ['required' => 'required', 'id' => 'url', 'class'=>'input', 'placeholder'=> 'Type in your URL - lets shorten it for you']) !!}
                                            {!! Form::submit('Create It!', ['class'=>'button is-info']) !!}
                                        </div>

                                        <p class="control">{!! Recaptcha::render() !!}</p>
                                    </div>
                                    {{ Form::close() }}
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>



@endsection
