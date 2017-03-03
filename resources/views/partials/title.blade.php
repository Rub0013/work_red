<div class="lock-header subheader m-b-lg">
    <div class="container full">
        <div class="m-b-lg">
            <div class="pull-left w50 m-t-xs">
                <h3 class="m-b-none">{{ trans('nav.autoSchedule') }}</h3>
                <small class="text-muted">Sample Reddit app.</small>
            </div>
            <div class="pull-right w50 text-right m-t-lg">
                <ul class="nav navbar-nav navbar-right  nav-user">
                    <li class="dropdown">
                        <a id="logged_usert_name_title" href="#" class="dropdown-toggle" data-toggle="dropdown">
                            {{ Auth::user()->name }}
                            {{--<span class="thumb-sm avatar pull-left">--}}
                                {{--<span class="fa fa-user"></span>--}}
                                {{--</span>--}}
                            <b class="caret"></b>
                        </a>
                        <ul class="dropdown-menu animated fadeInRight">
                            <span class="arrow top"></span>
                            <li><a href="/account">My account</a></li>
                            <li class="divider"></li>
                            <li><a href="{{route('logout')}}">Logout</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>