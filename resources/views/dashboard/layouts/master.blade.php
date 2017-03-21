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
                Username
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
            <h3>Total Links: <b>0</b></h3>
            <h3>Total Clicks: <b>13</b></h3>
        </div>
    </div>
</section>
<section class="section height-100 pad-0">
    <div class="columns height-100">
        <div class="column is-one-quarter dash-sidebar height-100">
            <div class="columns stats-col">
                <div class="column is-half links-count">
                    0 links
                </div>
                <div class="column is-half">
                    Clicks all time
                </div>
            </div>
        </div>
        <div class="column height-100">
            <center>Something</center>
        </div>
    </div>
</section>
<script src="/js/app.js"></script>
</body>
</html>