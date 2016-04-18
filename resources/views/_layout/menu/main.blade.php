<ul class="nav navbar-nav">
    <li class="{{ Ekko::isActiveURL('/') }}"><a href="{{ url('/') }}">Home</a></li>
    <li class="{{ Ekko::isActiveURL('/jobs/current') }}"><a href="{{ url('/jobs/current') }}">Current</a></li>
</ul>