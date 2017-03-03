<aside class="bg-black aside-md hidden-print nav-xs" id="nav">
    <section class="vbox">
        <header class="header bg-danger brand-header lock-header pos-stat clearfix">
            <a class="btn btn-link visible-xs" data-toggle="class:nav-off-screen,open" data-target="#nav,html">
                <i class="fa fa-bars"></i></a>
            <div class="text-center tophead">
                <span class="fa fa-user fa-3x"></span>
            </div>
        </header>
        <section class="w-f scrollable">
            <div class="slimScrollDiv">
                <div class="slim-scroll" data-height="auto" data-disable-fade-out="true" data-distance="0" data-size="5px" data-color="#333333">
                    <nav class="nav-primary hidden-xs">
                        <ul class="nav">
                            <li {{ Request::is( 'schedules') ? 'class=active' : '' }}>
                                <a class="" href="{{URL::route('schedules')}}"><i class="m-l-md fa icon fa-calendar"></i><span>{{ trans('nav.autoSchedule') }}</span></a>
                            </li>
                            <li { { Request::is( 'research') ? 'class=active' : '' }}>
                                <a class="" href="{{URL::route('research')}}"><i class="m-l-md fa icon fa-search"></i><span>{{ trans('nav.timeResearch') }}</span></a>
                            </li>
                            <li {{ Request::is( 'archive') ? 'class=active' : '' }}>
                                <a class="" href="{{URL::route('archive-browser-extension')}}"><i class="m-l-md fa icon fa-file-archive-o"></i><span>{{ trans('nav.archive') }}</span></a>
                            </li>
                            {{--<li {{ Request::is( 'ignore') ? 'class=active' : '' }}>--}}
                                {{--<a class="" href="{{URL::route('ignore')}}"><i class="m-l-md fa icon fa-file-o"></i><span>{{ trans('nav.ignore') }}</span></a>--}}
                            {{--</li>--}}
                            <li {{ Request::is( 'analytics') ? 'class=active' : '' }}>
                                <a class="" href="{{URL::route('analytics')}}"><i class="m-l-md fa icon fa-file-o"></i><span>{{ trans('nav.analytics') }}</span></a>
                            </li>
                        </ul>
                    </nav>
                </div>
                <div class="slimScrollBar scrollBar"></div>
                <div class="slimScrollRail scrollRail"></div>
            </div>
        </section>
    </section>
</aside>
