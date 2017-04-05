@extends('layouts.admin')

@section('content')
    @if (Session::get('flash_notification.message'))
        @include('layouts.partials.admin._flash')
    @endif

    <div class="columns">
        <div class="column is-two-thirds">
            <div class="title is-2">@lang('Links')</div>
        </div>
    </div>

    <div class="columns">
        <table class="table">
            <thead>
            <tr>
                <th>Real URL</th>
                <th>Short url</th>
                <th>User</th>
                <th>Created</th>
                <th>Click troughs</th>
                <th></th>
            </tr>
            </thead>
            <tbody>
            @if (count($links) > 0)
                @foreach($links as $link)
                    <?php
                    $pural = (count($link['hits']) > 0) ? 'times' : 'time';
                    ?>
                    <tr>
                        <td><a href="{{$link['url']}}">{{$link['url']}}</a></td>
                        <td><a href="/{{$link['hash']}}">{{$link['hash']}}</a></td>
                        <td><a href="{{route('admin.users.edit', $link['user']['id'])}}"> {{$link['user']['name']}}</a>
                        </td>
                        <td>{{$link['created_at']}}</td>
                        <td>{{ count($link['hits']) }} {{ $pural }}</td>
                        <td>

                            {!! Form::open(['method' => 'DELETE', 'id' => 'link_row'.$link['id'],  'route' => ['admin.links.destroy', $link['id']]]) !!}
                            {{ csrf_field() }}

                            <a href="#" class="button is-danger is-outlined"
                               onclick="return confirmDelete({{$link['id']}});">
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
                    <td align="center" style="text-align: center" colspan="5">Currently there are no links</td>
                </tr>
            @endif
            </tbody>
        </table>
    </div>

    {{ $links->links('layouts.partials.admin._pagination') }}
    <strong>TODO:</strong>
    <ol>
        <li>Some todo here</li>
    </ol>
    <script>
        function confirmDelete(user_id) {
            if (confirm('Are you sure to delete this user?')) {
                document.getElementById('link_row' + user_id).submit();
            }
        }
    </script>
@endsection