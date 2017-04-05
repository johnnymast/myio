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

        <div class="column is-one-third">

            <div class="card">
                <div class="card-image">
                    <figure class="image is-4by3">
                        <img src="http://bulma.io/images/placeholders/1280x960.png" alt="Image">
                    </figure>
                </div>
                <div class="card-content">
                    <div class="media">
                        <div class="media-left">
                            <figure class="image is-48x48">
                                <img src="http://bulma.io/images/placeholders/96x96.png" alt="Image">
                            </figure>
                        </div>
                        <div class="media-content">
                            <p class="title is-4">John Smith</p>
                            <p class="subtitle is-6">@johnsmith</p>
                        </div>
                    </div>

                    <div class="content">
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                        Phasellus nec iaculis mauris. <a>@bulmaio</a>.
                        <a>#css</a> <a>#responsive</a>
                        <br>
                        <small>11:09 PM - 1 Jan 2016</small>
                    </div>
                </div>
            </div>

        </div>

        <div class="column is-one-third">

            <nav class="panel">
                <p class="panel-heading">
                    @lang('Links')
                </p>
                <div class="panel-block">
                    <p class="control has-icon">
                        <input class="input is-small" type="text" placeholder="Search">
                        <span class="icon is-small">
        <i class="fa fa-search"></i>
      </span>
                    </p>
                </div>
                <p class="panel-tabs">
                    <a class="is-active">@lang('All')</a>
                </p>
                <a class="panel-block is-active">
    <span class="panel-icon">
      <i class="fa fa-book"></i>
    </span>
                    bulma
                </a>
                <a class="panel-block">
    <span class="panel-icon">
      <i class="fa fa-book"></i>
    </span>
                    marksheet
                </a>
                <a class="panel-block">
    <span class="panel-icon">
      <i class="fa fa-book"></i>
    </span>
                    minireset.css
                </a>
                <a class="panel-block">
    <span class="panel-icon">
      <i class="fa fa-book"></i>
    </span>
                    jgthms.github.io
                </a>
                <a class="panel-block">
    <span class="panel-icon">
      <i class="fa fa-code-fork"></i>
    </span>
                    daniellowtw/infBoard
                </a>
                <a class="panel-block">
    <span class="panel-icon">
      <i class="fa fa-code-fork"></i>
    </span>
                    mojs
                </a>
                <label class="panel-block">
                    <input type="checkbox">
                    Remember me
                </label>
                <div class="panel-block">
                    <button class="button is-primary is-outlined is-fullwidth">
                        Reset all filters
                    </button>
                </div>
            </nav>


        </div>

        <div class="column is-one-third">

            <nav class="panel">
                <p class="panel-heading">
                    @lang('Users')
                </p>
                <div class="panel-block">
                    <p class="control has-icon">
                        <input class="input is-small" type="text" placeholder="Search">
                        <span class="icon is-small">
        <i class="fa fa-search"></i>
      </span>
                    </p>
                </div>
                <p class="panel-tabs">
                    <a class="is-active">@lang('All')</a>
                    <a>@lang('Admins')</a>
                    <a>@lang('Users')</a>
                </p>
                <a class="panel-block is-active">
    <span class="panel-icon">
      <i class="fa fa-book"></i>
    </span>
                    bulma
                </a>
                <a class="panel-block">
    <span class="panel-icon">
      <i class="fa fa-book"></i>
    </span>
                    marksheet
                </a>
                <a class="panel-block">
    <span class="panel-icon">
      <i class="fa fa-book"></i>
    </span>
                    minireset.css
                </a>
                <a class="panel-block">
    <span class="panel-icon">
      <i class="fa fa-book"></i>
    </span>
                    jgthms.github.io
                </a>
                <a class="panel-block">
    <span class="panel-icon">
      <i class="fa fa-code-fork"></i>
    </span>
                    daniellowtw/infBoard
                </a>
                <a class="panel-block">
    <span class="panel-icon">
      <i class="fa fa-code-fork"></i>
    </span>
                    mojs
                </a>
                <label class="panel-block">
                    <input type="checkbox">
                    Remember me
                </label>
                <div class="panel-block">
                    <button class="button is-primary is-outlined is-fullwidth">
                        Reset all filters
                    </button>
                </div>
            </nav>

        </div>


    </div>

@endsection