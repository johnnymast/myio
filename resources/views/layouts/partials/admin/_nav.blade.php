<nav class="nav is-dark has-shadow" id="top">
    <div class="container">
        <div class="nav-left">
            <a class="nav-item" href="{{ route('admin.dashboard.index') }}">
                <img src="/images/bulma.png" alt="Description">
            </a>
        </div>
        <div class="nav-right">
            <a class="nav-item" href="{{ route('user.logout') }}">Logout</a>
        </div>

        <span class="nav-toggle">
        <span></span>
        <span></span>
        <span></span>
      </span>
        <div class="nav-right nav-menu is-hidden-tablet">
            <a class="nav-item is-tab is-active">
                Users
            </a>
            <a class="nav-item is-tab">
                Links
            </a>
            <a class="nav-item is-tab">
                Timeline
            </a>
            <a class="nav-item is-tab">
                Folders
            </a>
        </div>
    </div>
</nav>