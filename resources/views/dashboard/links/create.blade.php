@extends('dashboard.layouts.app', ['title' => 'Create Short URL'])

@section('content')
    <div class="box">
        @if(Session::has('message'))
            <div class="notification">
                {!! Session::get('message') !!}
            </div>
        @endif

        {!! Form::open(array('route' => 'url_store', 'class' => 'form')) !!}
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

            {!! Form::label('url', 'URL', ['for' => 'url','class' => 'label']) !!}
            <p class="control">
                {!! Form::text('url', null, ['required' => 'required', 'id' => 'url', 'class'=>'input', 'placeholder'=> 'Your URL']) !!}
            </p>

            <div class="control is-grouped">
                <p class="control">
                    {!! Form::submit('Create Short URL!', ['class'=>'button is-primary']) !!}
                </p>
            </div>
        {{ Form::close() }}
    </div>
@endsection
