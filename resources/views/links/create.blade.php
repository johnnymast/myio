@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Create Short URL</div>
                    <div class="panel-body">


                        @if(Session::has('message'))
                            <div class="alert alert-success" role="alert">
                                {!! Session::get('message') !!}
                            </div>
                        @endif

                        {!! Form::open(array('route' => 'url_store', 'class' => 'form')) !!}
                        {{ csrf_field() }}

                        <div class="form-group">
                            {!! Form::label('url', 'Url', ['for' => 'url','class' => 'col-md-4 control-label']) !!}
                            <div class="col-md-6">
                                {!! Form::text('url', null, ['required' => 'required', 'id' => 'url',
                                'class'=>'form-control', 'placeholder'=> 'Your url']) !!}
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-8 col-md-offset-4">
                                {!! Form::submit('Submit', ['class'=>'btn btn-primary']) !!}
                            </div>
                        </div>
                        {{ Form::close() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
