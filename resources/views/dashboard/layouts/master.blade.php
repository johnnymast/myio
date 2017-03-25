<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Myio Link Shortener</title>
    <link rel="stylesheet" href="/css/app.css">
</head>
<body style="
    overflow: hidden;
    height: 100vh;">
<div class="container">
    <nav class="nav">
        <div class="nav-left">
            <a class="nav-item">
                MyIO
            </a>
        </div>

        <!-- This "nav-toggle" hamburger menu is only visible on mobile -->
        <!-- You need JavaScript to toggle the "is-active" class on "nav-menu" -->
        <span class="nav-toggle">
            <span></span>
            <span></span>
            <span></span>
        </span>

        <!-- This "nav-menu" is hidden on mobile -->
        <!-- Add the modifier "is-active" to display it on mobile -->
        <div class="nav-right nav-menu">
            <span class="nav-item">
                <div class="field">
                    <p class="control has-icon has-icon-right">
                        <input class="input" type="email" placeholder="Search">
                        <span class="icon is-small">
                          <i class="fa fa-search"></i>
                        </span>
                    </p>
                </div>
            </span>
            <span class="nav-item">
                <a class="button is-primary">
                    <span class="icon is-small">
                        <i class="fa fa-link"></i>
                    </span>
                    <span>CREATE LINK</span>
                </a>
            </span>
            <a class="nav-item">
                {{ $user->name }}
            </a>
             <a class="nav-item">
                Logout
             </a>
        </div>
    </nav>
</div>
<section class="hero is-primary">
    <div class="hero-body">
        <div class="container">
            <h3>Total Links: <b>{{ $linkCount }}</b></h3>
            <h3>Total Clicks: <b>{{ $user->totalHits() }}</b></h3>
        </div>
    </div>
</section>
<section class="section height-100 pad-0" id="links">
    <div class="columns height-100">
        <div class="column is-one-quarter dash-sidebar height-100">
            <div class="columns stats-col">
                <div class="column is-half links-count">
                    {{ $linkCount }} Link{{ $linkCount > 1 ? "s" : "" }}
                </div>
                <div class="column is-half">
                    Clicks all time
                </div>
            </div>

            <hr>

            @foreach($user->links as $link)
                <div class="columns" @click="changeLink( {{ $link->id }})" :style="getBackground({{ $link->id }})">
                    <div class="column is-half links-count">
                        {{ $link->url }}
                        <br>
                        <a href="{{ url($link->hash) }}">{{ url($link->hash) }}</a>
                    </div>
                    <div class="column is-half">
                        {{ $link->hits->count() }}
                    </div>
                </div>
            @endforeach

        </div>
        <div class="column height-100">
            @if(Session::has('message'))
                <div class="notification">
                    {!! Session::get('message') !!}
                </div>
            @endif

            @foreach($user->links as $link)
                <myio-link link-id="{{ $link->id }}"
                           url="{{ $link->url }}"
                           created-at="{{ date("d M", strtotime($link->created_at)) }}"
                           hash="{{ url($link->hash) }}"
                           delete-link="{{ route('links.destroy', $link) }}"
                           hits="{{ $link->hits->count() }}"
                           v-if="currentLink === {{ $link->id }}"
                           @click="changeLink({{ $link->id }})"></myio-link>
            @endforeach

        </div>
    </div>
</section>
<script src="/js/app.js"></script>

<script type="text/javascript">

  // All this JS needs moving. A .Vue file can be created from the component
  // and perhaps a .js file for the Vue instance below
  Vue.component('myio-link', {
    methods: {
        copy() {
          // To be implemented
          // there do appear to be packages to make this easier but sadly my Mix isn't working
          // https://github.com/xiaokaike/vue-clipboard
        }
    },
    props: [
      'linkId',
      'url',
      'createdAt',
      'hash',
      'hits',
      'deleteLink'
    ],
    template: `
      <div class="columns">
          <div class="column">
              <h2 class="subtitle">@{{ createdAt }}</h2>
              <h1 class="title">@{{ url }}</h1>

              <a :href="hash">@{{ hash }}</a>

              <hr>


              <form :action="deleteLink" method="post">
                  {{ csrf_field() }}
                  <input type="hidden" name="_method" value="DELETE">
                  <button type="submit" class="button is-danger">Delete</button>
              </form>

              <a href="#" class="button is-success" @click="copy()">Copy</a>

              <hr>

              @{{ hits }} Total Clicks
          </div>
      </div>
    `,
  });

  var links = new Vue({
    el: "#links",
    data: {
      currentLink: {{ $user->links->first()->id }}
    },
    methods: {
      changeLink(linkId) {
        this.currentLink = linkId;
      },
      setFirstLink(linkId) {
        console.log(linkId);
        this.currentLink = this.currentLink === null ? linkId : this.currentLink;
      },
      getBackground(linkId) {
        return this.currentLink === linkId ? "background-color: white" : "";
      }
    }
  });

</script>

</body>
</html>
