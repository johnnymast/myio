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
        <table class="table">
            <thead>
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Created</th>
                <th>Active</th>
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
                        <td>

                            {!! Form::open(['method' => 'DELETE', 'id' => 'user_row'.$user['id'],  'route' => ['admin.users.destroy', $user['id']]]) !!}
                            {{ csrf_field() }}

                            <a href="#" class="button is-danger is-outlined"
                               onclick="return confirmDelete({{$user['id']}});">
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
                    <td align="center" style="text-align: center" colspan="4">Currently there are no active users</td>
                </tr>
            @endif
            </tbody>
        </table>


    </div>
    {{$users->links('layouts.partials.admin._pagination')}}

    <strong>TODO:</strong>
    <ol>
        <li>Create: Make mail token</li>
        <li>Create: Only provide the email activation link IF the active is set to no.</li>
    </ol>
    <script>
        function confirmDelete(user_id) {
            if (confirm('Are you sure to delete this user?')) {
                document.getElementById('user_row' + user_id).submit();
            }
        }
    </script>
@endsection