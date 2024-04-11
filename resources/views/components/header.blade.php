<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <x-logo/>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <form class="form-inline mr-auto" action="/list">
            <input class="form-control mr-sm-2" type="search" name="q" placeholder="Search" aria-label="Search">
            <button class="btn btn-outline-warning my-2 my-sm-0" type="submit">Search</button>
        </form>
        <ul class="navbar-nav my-2 my-lg-0"">
            <li class=" nav-item">
            <a class="nav-link" href="/list">Songs</a>
            </li>
            @guest
            <li class="nav-item">
                <a class="nav-link" href="/login">Login</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/register">Register</a>
            </li>
            @else
            <li class="nav-item">
                <a class="nav-link" href="/dashboard">Dashboard</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/create">Create Song</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/logout">Logout</a>
            </li>
            @endguest
    </div>
</nav>