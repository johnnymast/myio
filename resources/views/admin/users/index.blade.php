@extends('layouts.admin')

@section('content')
    <div class="title is-2">Users</div>
    <div class="columns files">
        <table class="table">
            <thead>
            <th>Name</th>
            <th>Email</th>
            <th>Created</th>
            <th>Active</th>
            <th></th>
            </thead>
            <tbody>
            @if (count($users) > 0)
                @foreach($users as $user)
                    <tr>
                        <td><a href="{{route('admin.users.edit', $user['id'])}}">{{$user['name']}}</a></td>
                        <td>{{$user['email']}}</td>
                        <td>{{$user['created_at']}}</td>
                        <td>{{$user['activated'] ? 'Yes' : 'No'}}</td>
                        <td><a class="button is-danger is-outlined">
                                <span>Delete</span>
                                <span class="icon is-small">
      <i class="fa fa-times"></i>
    </span>
                            </a></td>
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


@endsection