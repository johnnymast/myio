@extends('layouts.admin')

@section('content')
    <div class="title is-2">Links</div>
    <div class="columns files">
        <table class="table">
            <thead>
            <th>Real URL</th>
            <th>Short url</th>
            <th>User</th>
            <th>Created</th>
            <th>Click troughs</th>
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
                        <td><a href="{{route('admin.users.show', $link['user']['id'])}}"> {{$link['user']['name']}}</a></td>
                        <td>{{$link['created_at']}}</td>
                        <td>{{ count($link['hits']) }} {{ $pural }}</td>
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


@endsection