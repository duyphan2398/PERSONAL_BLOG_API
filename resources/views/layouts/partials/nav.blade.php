<!-- Navigation -->
<nav class="navbar navbar-expand-lg navbar-light fixed-top" id="mainNav">
    <div class="container">
        <a class="navbar-brand" href="{{ url('/') }}">TNguyenOfficial</a>
        <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
            Menu
            <i class="fas fa-bars"></i>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
            <ul class="navbar-nav ml-auto">
                <li id='home' name="{{ (request()->is('/')) ?  $category['id'] : '' }}" class="nav-item {{ (request()->is('/')) ? 'active' : '' }}">
                    <a class="nav-link" href="{{ url('/') }}">Home</a>
                </li>
                <li id='story' name="{{ (request()->is('stories')) ?  $category['id'] : '' }}" class="nav-item {{ (request()->is('stories')) ? 'active' : '' }}">
                    <a class="nav-link" href="{{ url('stories') }}">Stories</a>
                </li>
                <li id='blog' name="{{ (request()->is('blogs')) ?  $category['id'] : '' }}" class="nav-item {{ (request()->is('blogs')) ? 'active' : '' }}">
                    <a class="nav-link" href="{{ url('blogs') }}">Blogs</a>
                </li>
                <li id='project' name="{{ (request()->is('projects')) ?  $category['id'] : '' }}" class="nav-item {{ (request()->is('projects')) ? 'active' : '' }}">
                    <a class="nav-link" href="{{ url('projects') }}">Projects</a>
                </li>
                <li id='service' name="{{ (request()->is('services')) ?  $category['id'] : '' }}" class="nav-item {{ (request()->is('services')) ? 'active' : '' }}">
                    <a class="nav-link" href="{{ url('services') }}">Services</a>
                </li>
                <li id='contact' name="{{ (request()->is('contacts')) ?  $category['id'] : '' }}" class="nav-item {{ (request()->is('contacts')) ? 'active' : '' }}">
                    <a class="nav-link" href="{{ url('contacts') }}">Contact Me</a>
                </li>
            </ul>
        </div>
    </div>
</nav>