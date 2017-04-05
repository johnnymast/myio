@extends('layouts.admin')

@section('content')
    @if (Session::get('flash_notification.message'))
        @include('layouts.partials.admin._flash')
    @endif

    <div class="columns">
        <div class="column is-two-thirds">
            <div class="title is-2">New User</div>
            <a href="{{ route('admin.users.index') }}" class="button">
                <span class="icon">
                  <i class="fa fa-arrow-left"></i>
                </span>
                <span>User list</span>
            </a>

        <!--
            <a href="{{ route('admin.users.index') }}" class="button is-dark">
                <span class="icon">
                  <i class="fa fa-user"></i>
                </span>
                <span>@lang('Login as ...')</span>
            </a>
            -->
        </div>
    </div>



    <div class="columns">

        <div class="column is-half">
            {{ Form::open(['route' => ['admin.users.store'], 'method'=>'post']) }}
            {{ csrf_field() }}

            {{form::label('name', 'Name', ['class' => 'label'])}}
            <div class="control">
                {{form::text('name', '', ['placeholder' => 'Name of the user', 'class' => 'input form-control', 'autofocus' => true])}}
                @if ($errors->has('name'))
                    <span class="help is-danger">
                    <strong>{{ $errors->first('name') }}</strong>
                </span>
                @endif
            </div>

            {{form::label('password', 'Password', ['class' => 'label'])}}
            <div class="control">
                <p class="control has-icon">
                    {{form::password('password', ['placeholder' => 'Password', 'class' => 'input'])}}
                    <span class="icon is-small">
                    <i class="fa fa-lock"></i>
                </span>
                </p>
                @if ($errors->has('name'))
                    <span class="help is-danger">
                    <strong>{{ $errors->first('password') }}</strong>
                </span>
                @endif
            </div>


            {{form::label('password_again', 'Repeat password', ['class' => 'label'])}}
            <div class="control">
                <p class="control has-icon">
                    {{form::password('password_again', ['placeholder' => 'Repeat the user\'s password', 'class' => 'input'])}}
                    <span class="icon is-small">
                    <i class="fa fa-lock"></i>
                </span>
                </p>
                @if ($errors->has('name'))
                    <span class="help is-danger">
                    <strong>{{ $errors->first('password_again') }}</strong>
                </span>
                @endif
            </div>

            {{form::label('	email', 'Email', ['class' => 'label'])}}
            <div class="control">
                {{form::email('email', '', ['placeholder' => 'Email address', 'class' => 'input form-control'])}}
                @if ($errors->has('email'))
                    <span class="help is-danger">
                    <strong>{{ $errors->first('email') }}</strong>
                </span>
                @endif
            </div>

            {{form::label('role', 'Role', ['class' => 'label'])}}
            <div class="control">

            <span class="select is-medium is-fullwidth">
                {{form::select('role', $roles->pluck('name', 'id'), '')}}
            </span>
                @if ($errors->has('activated'))
                    <span class="help is-danger">
                    <strong>{{ $errors->first('role') }}</strong>
                </span>
                @endif
            </div>

            {{form::label('activated', 'Activated', ['class' => 'label'])}}
            <div class="control">

            <span class="select is-medium is-fullwidth">
                {{form::select('activated',['No', 'Yes'], config('myio.admin.user_create.default_activate_user'), ['@change' => 'activateChanged'])}}
            </span>
                @if ($errors->has('activated'))
                    <span class="help is-danger">
                    <strong>{{ $errors->first('name') }}</strong>
                </span>
                @endif
            </div>

            <div class="control" v-show="admin_user_create_form.show_opt_actv_mail">
                {{Form::label('act_mail', 'Send activation mail', ['class' => 'label'])}}
                {{Form::checkbox('act_mail', true, false) }}
            </div>


            {{ form::submit('Create', ['class' => 'button is-primary']) }}
            {{ form::close() }}
        </div>
    </div>

@endsection
