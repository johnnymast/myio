@extends('layouts.admin')

@section('content')
    @if (Session::get('flash_notification.message'))
        @include('layouts.partials.admin._flash')
    @endif

    <div class="columns">
        <div class="column is-two-thirds">
            <div class="title is-2">Link {{$link->url}}</div>
            <a href="{{ route('admin.links.index') }}" class="button">
                <span class="icon">
                  <i class="fa fa-arrow-left"></i>
                </span>
                <span>Links list</span>
            </a>
        </div>
    </div>


    <div class="columns">

        <div class="column is-5">
            <div class="card">
                <div class="card-content">
                    @lang('Full Url:') <a href="{{url($link['url'])}}">{{$link['url']}}</a><br/>
                    @lang('Short Url:') <a class="linkurl" href="{{url($link['hash'])}}">{{url($link['hash'])}}</a>

                    <button class="button is-small is-outlined" data-clipboard-target=".linkurl">
                        <span class="icon is-small">
                          <i class="fa fa-copy"></i>
                        </span>
                        <span>Copy</span>
                    </button><br />

                    @lang('Hits:') {{count($link->hits)}}
                </div>
            </div>
        </div>


    </div>

    <div class="columns">

        <div class="column is-fullwidth">
            <table class="table is-bordered is-striped is-narrow">
                <thead>
                <tr>
                    <th>@lang('User Agent')</th>
                    <th>@lang('IP')</th>
                </tr>
                </thead>
                <tbody>
                @if (count($hits) > 0)
                    @foreach($hits as $hit)
                        <?php
                        $pural = (count($link['hits']) > 0) ? 'times' : 'time';
                        ?>
                        <tr>
                            <td>{{$hit->user_agent}}</td>
                            <td>{{$hit->ip}}</td>
                        </tr>
                    @endforeach
                @else
                    <tr>
                        <td align="center" style="text-align: center" colspan="2">Currently there are no hits</td>
                    </tr>
                @endif
                </tbody>
                @if (count($hits) > 0)
                    <thead>
                    <tr>
                        <th>@lang('User Agent')</th>
                        <th>@lang('IP')</th>
                    </tr>
                    </thead>
                @endif
            </table>

            {{$hits->links('layouts.partials.admin._pagination')}}

        </div>

    </div>
@endsection

@section('footer.scripts')
    <script>new Clipboard('.button');</script>
@endsection