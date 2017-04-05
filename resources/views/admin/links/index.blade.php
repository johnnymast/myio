@extends('layouts.admin')

@section('content')
    <div class="columns">
        <div class="column is-two-thirds">
            <div class="title is-2">Links</div>
            <a href="{{ route('admin.users.create') }}" class="button">
                <span class="icon">
                  <i class="fa fa-user-circle"></i>
                </span>
                <span>New link</span>
            </a>
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
                        <td><a href="{{route('admin.users.show', $link['user']['id'])}}"> {{$link['user']['name']}}</a>
                        </td>
                        <td>{{$link['created_at']}}</td>
                        <td>{{ count($link['hits']) }} {{ $pural }}</td>
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
                    <td align="center" style="text-align: center" colspan="5">Currently there are no links</td>
                </tr>
            @endif
            </tbody>
        </table>


    </div>

    {{ $links->links('layouts.partials.admin._pagination') }}


@endsection