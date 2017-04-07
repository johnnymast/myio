@extends('layouts.admin')

@section('content')


    @if (Session::get('flash_notification.message'))
        @include('layouts.partials.admin._flash')
    @endif

    <div class="columns">
        <div class="column is-two-thirds">
            <div class="title is-2">@lang('Dashboard')</div>
        </div>
    </div>


    <div class="columns">


        <div class="column is-one-third is-offset-1">
            <nav class="panel">
                <div class="panel-heading">
                    @lang('New users')
                </div>
                @if (count($users) > 0)
                    @foreach ($users as $user)
                        <a href="{{route('admin.users.edit', $user->id)}}" class="panel-block">
                        <span class="panel-icon">
                          <i class="fa fa-user"></i>
                        </span>
                            {{$user->name}}</a>
                    @endforeach
                @else
                    <div class="panel-block">
                        <span class="panel-icon">
                          <i class="fa fa-user"></i>
                        </span>
                        @lang('No users found')</div>
                @endif
            </nav>


        </div>

        <div class="column is-one-third is-offset-1">

            <nav class="panel">
                <div class="panel-heading">
                    @lang('New Links')
                </div>
                @if (count($links) > 0)
                    @foreach ($links as $link)
                        <a href="{{route('admin.links.show', $link->id)}}" class="panel-block">
                        <span class="panel-icon">
                          <i class="fa fa-map-marker"></i>
                        </span>
                            {{$link->url}}
                        </a>
                    @endforeach
                @else
                    <div class="panel-block">
                        <span class="panel-icon">
                          <i class="fa fa-map-marker"></i>
                        </span>
                        @lang('No links found')</div>
                @endif
            </nav>
        </div>


    </div>

@endsection

@section('footer.scripts')
    <script>new Clipboard('.button');</script>
@endsection