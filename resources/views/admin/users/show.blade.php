@extends('layouts.admin')

@section('content')

    <div class="title is-2">Users</div>
    <div class="nav menu">
        <div class="container">
            <div class="nav-left">
                <a class="nav-item is-tab is-active"><span class="icon-btn"><i class="fa fa-plus"></i></span></a>
                <a class="nav-item is-tab">
              <span class="icon-btn">
                <i class="fa fa-print"></i>
              </span>
                </a>
                <a class="nav-item is-tab">
              <span class="icon-btn thin">
                <i class="fa fa-lock"></i>
              </span>
                </a>
                <a class="nav-item is-tab">
              <span class="icon-btn">
                <i class="fa fa-trash"></i>
              </span>
                </a>
                <div class="nav-item is-tab">
                    <strong>2 items selected</strong>
                </div>
            </div>
            <div class="nav-right is-hidden-mobile">
                <a class="nav-item is-tab">Name</a>
                <a class="nav-item is-tab">Size</a>
                <a class="nav-item is-tab">Views</a>
                <a class="nav-item"><span class=" button is-success">Uploaded</span></a>
            </div>
        </div>
    </div>
    <div class="columns files">
        <div class="column is-2">
            <a class="file">
                <div class="image is-3by2">
                    <img src="https://images.unsplash.com/photo-1467321638755-7246fd0dc1f3?dpr=1&auto=format&crop=entropy&fit=crop&w=1500&h=1125&q=80">
                </div>
                <div class="name">swimmin.jpeg</div>
                <div class="timestamp">2 hours ago</div>
            </a>
            <a class="file">
                <div class="image is-3by2">
                    <img src="https://images.unsplash.com/photo-1467321638755-7246fd0dc1f3?dpr=1&auto=format&crop=entropy&fit=crop&w=1500&h=1125&q=80">
                </div>
                <div class="name">swimmin.jpeg</div>
                <div class="timestamp">2 hours ago</div>
            </a>
            <a class="file">
                <div class="image is-3by2">
                    <img src="https://source.unsplash.com/category/nature/640x480">
                </div>
                <div class="name">daisydaisydaisyuntitled.jpeg</div>
                <div class="timestamp">2 hours ago</div>
            </a>
        </div>
        <div class="column is-2">
            <a class="file active">
                <div class="image is-3by2">
                    <img src="https://source.unsplash.com/category/buildings/640x480">
                </div>
                <div class="name">untitled.jpeg</div>
                <div class="timestamp">2 minutes ago</div>
            </a>
            <a class="file">
                <div class="image is-3by2">
                    <img src="https://source.unsplash.com/category/nature/640x480">
                </div>
                <div class="name">daisydaisydaisyuntitled.jpeg</div>
                <div class="timestamp">2 hours ago</div>
            </a>
            <a class="file">
                <div class="image is-3by2">
                    <img src="https://images.unsplash.com/photo-1467321638755-7246fd0dc1f3?dpr=1&auto=format&crop=entropy&fit=crop&w=1500&h=1125&q=80">
                </div>
                <div class="name">swimmin.jpeg</div>
                <div class="timestamp">2 hours ago</div>
            </a>
        </div>
        <div class="column is-2">
            <a class="file active">
                <div class="image is-3by2">
                    <img src="https://source.unsplash.com/category/food/640x480">
                </div>
                <div class="name">splashsplash.jpeg</div>
                <div class="timestamp">2 hours ago</div>
            </a>
            <a class="file">
                <div class="image is-3by2">
                    <img src="https://source.unsplash.com/category/nature/640x480">
                </div>
                <div class="name">untitled.jpeg</div>
                <div class="timestamp">2 hours ago</div>
            </a>
        </div>
        <div class="column is-2">
            <a class="file">
                <div class="image is-3by2">
                    <img src="https://source.unsplash.com/category/objects/640x480">
                </div>
                <div class="name">untitled.jpeg</div>
                <div class="timestamp">2 hours ago</div>
            </a>
            <a class="file">
                <div class="image is-3by2">
                    <img src="https://images.unsplash.com/photo-1467321638755-7246fd0dc1f3?dpr=1&auto=format&crop=entropy&fit=crop&w=1500&h=1125&q=80">
                </div>
                <div class="name">swimmin.jpeg</div>
                <div class="timestamp">2 hours ago</div>
            </a>
        </div>
        <div class="column is-2">
            <a class="file">
                <div class="image is-3by2">
                    <img src="https://source.unsplash.com/category/people/640x480">
                </div>
                <div class="name">untitled.jpeg</div>
                <div class="timestamp">2 hours ago</div>
            </a>
            <a class="file">
                <div class="image is-3by2">
                    <img src="https://source.unsplash.com/category/objects/640x480">
                </div>
                <div class="name">swimmin.jpeg</div>
                <div class="timestamp">2 hours ago</div>
            </a>
        </div>
        <div class="column is-2">
            <a class="file">
                <div class="image is-3by2">
                    <img src="https://source.unsplash.com/category/nature/640x480">
                </div>
                <div class="name">untitled.jpeg</div>
                <div class="timestamp">2 hours ago</div>
            </a>
            <a class="file">
                <div class="image is-3by2">
                    <img src="https://source.unsplash.com/category/people/640x480">
                </div>
                <div class="name">untitled.jpeg</div>
                <div class="timestamp">2 hours ago</div>
            </a>
        </div>
    </div>

@endsection