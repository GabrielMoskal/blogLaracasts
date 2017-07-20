<div class="blog-masthead">
    <div class="container">
        <nav class="nav blog-nav">
            <a class="nav-link active" href="/">Home</a>
            <a class="nav-link" href="/tasks">Tasks</a>
            @if(Auth::check())
                <a class="nav-link" href="/posts/create">New post</a>
                <a class="nav-link" href="/logout">Logout</a>
                <a class="nav-link ml-auto" href="#">{{ Auth::user()->name }}</a>
            @else
                <a class="nav-link" href="/login">Login</a>
                <a class="nav-link" href="/register">Register</a>
            @endif
        </nav>
    </div>
</div>