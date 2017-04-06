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
        <div class="column is-fullwidth">
            <table class="table is-bordered is-striped is-narrow">
                <thead>
                <tr>
                    <th>@lang('Real URL')</th>
                    <th>@lang('Short url')</th>
                    <th>@lang('User')</th>
                    <th>@lang('Created')</th>
                    <th>@lang('Click troughs')</th>
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
                            <td><a href="{{route('admin.links.show', $link['id'])}}">{{$link['url']}}</a></td>
                            <td><span class="linkurl">{{url($link['hash'])}}</span>

                                <button class="button is-small is-outlined" data-clipboard-target=".linkurl">
                                    <span class="icon is-small">
                                      <i class="fa fa-copy"></i>
                                    </span>
                                    <span>Copy</span>
                                </button>

                            </td>
                            <td>
                                <a href="{{route('admin.users.edit', $link['user']['id'])}}"> {{$link['user']['name']}}</a>
                            </td>
                            <td>{{$link['created_at']}}</td>
                            <td>{{ count($link['hits']) }} {{ $pural }}</td>
                            <td>

                                {!! Form::open(['method' => 'DELETE', 'id' => 'link_row'.$link['id'],  'route' => ['admin.links.destroy', $link['id']]]) !!}
                                {{ csrf_field() }}

                                <a href="#" class="button is-danger is-outlined"
                                   @click="confirmDeletingItem({{$link['id']}}, 'link_row');">
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
                        <td align="center" style="text-align: center" colspan="6">Currently there are no links</td>
                    </tr>
                @endif
                </tbody>
                @if (count($links) > 0)
                    <tfoot>
                    <tr>
                        <th>@lang('Real URL')</th>
                        <th>@lang('Short url')</th>
                        <th>@lang('User')</th>
                        <th>@lang('Created')</th>
                        <th>@lang('Click troughs')</th>
                        <th></th>
                    </tr>
                    </tfoot>
                @endif
            </table>
        </div>
    </div>

    {{ $links->links('layouts.partials.admin._pagination') }}

@endsection

@section('footer.scripts')
    <script>new Clipboard('.button');</script>
@endsection