<?php
    $routeName = Route::currentRouteName();
?>
<aside class="column is-2 aside hero is-fullheight is-hidden-mobile">
    <div>
        <div class="main">
            <div class="title">Main</div>
            <a href="{{ route('admin.dashboard.index') }}" class="item @if($routeName == 'admin.dashboard.index')active @endif"><span class="icon"><i class="fa fa-dashboard"></i></span><span class="name">Dashboard</span></a>
            <a href="{{ route('admin.users.index') }}" class="item @if($routeName == 'admin.users.show' || $routeName == 'admin.users.index')active @endif"><span class="icon"><i class="fa fa-user"></i></span><span class="name">Users</span></a>
            <a href="{{ route('admin.links.index') }}" class="item @if($routeName == 'admin.links.show' || $routeName == 'admin.links.index')active @endif"><span class="icon"><i class="fa fa-map-marker"></i></span><span class="name">Links</span></a>
        </div>
    </div>
</aside>