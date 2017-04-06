@extends('layouts.admin')

@section('content')
    @if (Session::get('flash_notification.message'))
        @include('layouts.partials.admin._flash')
    @endif

    <div class="columns">
        <div class="column is-two-thirds">
            <div class="title is-2">@lang('Users')</div>
            <a href="{{ route('admin.users.create') }}" class="button">
                <span class="icon">
                  <i class="fa fa-user-circle"></i>
                </span>
                <span>@lang('New user')</span>
            </a>
        </div>
    </div>


    <div class="columns">
        <div class="column is-fullwidth">
            <table class="table is-bordered is-striped is-narrow">
                <thead>
                <tr>
                    <th>@lang('Name')</th>
                    <th>@lang('Email')</th>
                    <th>@lang('Created')</th>
                    <th>@lang('Active')</th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                @if (count($users) > 0)
                    @foreach($users as $user)
                        <tr>
                            <td><a href="{{route('admin.users.edit', $user['id'])}}">{{$user['name']}}</a></td>
                            <td>{{$user['email']}}</td>
                            <td>{{$user['created_at']}}</td>
                            <td>{{$user['activated'] ? 'Yes' : 'No'}}</td>
                            <td class="has-text-centered">

                                {!! Form::open(['method' => 'DELETE', 'id' => 'user_row'.$user['id'],  'route' => ['admin.users.destroy', $user['id']]]) !!}
                                {{ csrf_field() }}

                                <a href="#" class="button is-danger is-outlined"
                                   @click="confirmDeletingItem({{$user['id']}}, 'user_row');">
                                    <span>Delete</span>
                                    <span class="icon is-small">
                                  <i class="fa fa-times"></i>
                                </span>
                                </a>

                                {!! Form::close() !!}
                            </td>
                        </tr>
                    @endforeach
                @else
                    <tr>
                        <td align="center" style="text-align: center" colspan="5">Currently there are no active users
                        </td>
                    </tr>
                @endif
                </tbody>

                @if (count($users) > 0)
                <tfoot>
                <tr>
                    <th>@lang('Name')</th>
                    <th>@lang('Email')</th>
                    <th>@lang('Created')</th>
                    <th>@lang('Active')</th>
                    <th></th>
                </tr>
                </tfoot>
                @endif
            </table>
        </div>
    </div>
    {{$users->links('layouts.partials.admin._pagination')}}

@endsection