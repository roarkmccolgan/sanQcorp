<ul class="nav navbar-nav">
    <li class="{{ Ekko::isActiveURL('/') }}"><a href="{{ url('/') }}">Home</a></li>
    <li class="dropdown {{ Ekko::areActiveURLs(['/jobs','/jobs/newjob']) }}">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
            Jobs <span class="caret"></span>
        </a>

        <ul class="dropdown-menu" role="menu">
            <li class="{{ Ekko::isActiveURL('/jobs') }}"><a href="{{ url('/jobs') }}"><i class="fa fa-btn fa-sign-out"></i>Jobs</a></li>
            <li class="{{ Ekko::isActiveURL('/jobs/newjob') }}"><a href="{{ url('/jobs/newjob') }}"><i class="fa fa-btn fa-sign-out"></i>New Job</a></li>
        </ul>
    </li>
</ul>