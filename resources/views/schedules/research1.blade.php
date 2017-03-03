@extends('layouts.admin')
@section('content')
    <section id="content">

        @include('partials.title')

        <section class="vbox" style="height: 1000px;">
            <section class="scrollable">
                <div class="container full content-body">
                    <div class="row undefined mason_row_3">
                        <div>
                            <section class="panel panel-default">
                                <header class="panel-heading"><!-- react-text: 1090 -->Input
                                    <!-- /react-text -->
                                    <hr>
                                </header>
                                <section class="panel-body text-center">
                                    <div class="undefined">
                                        <div class="iconic-input">
                                            <i class="fa fa-user"></i><input class="form-control " icon="fa fa-user" placeholder="email">
                                        </div>
                                    </div>
                                </section>
                            </section>
                        </div>
                        <div>
                            <section class="panel panel-default">
                                <header class="panel-heading"><!-- react-text: 1100 -->Drop Down
                                    <!-- /react-text -->
                                    <hr>
                                </header>
                                <section class="panel-body text-center" style="text-align: left;">
                                    <div class="btn-group undefined">
                                        <button type="button" class="btn btn-default" tabindex="-1">pick something...
                                        </button>
                                        <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                                            <span class="caret"></span></button>
                                        <ul class="dropdown-menu">
                                            <li><a href="#">item 1</a></li>
                                            <li><a href="#">item 2</a></li>
                                            <li><a href="#">item 3</a></li>
                                        </ul>
                                    </div>
                                </section>
                            </section>
                        </div>
                        <div>
                            <section class="panel panel-default">
                                <header class="panel-heading"><!-- react-text: 1117 -->Badge
                                    <!-- /react-text -->
                                    <hr>
                                </header>
                                <section class="panel-body text-center">
                                    <div class="d-i-b pull-left m-r-lg" style="width: 67px;">
                                        <div class="badgestack">
                                            <div class="hexagon badge-blue"></div>
                                            <i class="fa fa-2x fa-facebook"></i></div>
                                        <small class="text-muted">Facebook</small>
                                    </div>
                                    <div class="d-i-b pull-left m-r-lg" style="width: 67px;">
                                        <div class="badgestack">
                                            <div class="hexagon badge-red"></div>
                                            <i class="fa fa-2x fa-twitter"></i></div>
                                        <small class="text-muted">Twitter</small>
                                    </div>
                                    <div class="d-i-b pull-left m-r-lg" style="width: 67px;">
                                        <div class="badgestack">
                                            <div class="hexagon badge-green"></div>
                                            <i class="fa fa-2x fa-sign-out"></i></div>
                                        <small class="text-muted">Sign-out</small>
                                    </div>
                                    <div class="d-i-b pull-left m-r-lg" style="width: 67px;">
                                        <div class="badgestack">
                                            <div class="hexagon badge-yellow"></div>
                                            <i class="fa fa-2x fa-trophy"></i></div>
                                        <small class="text-muted">Congrats</small>
                                    </div>
                                </section>
                            </section>
                        </div>
                        <div>
                            <section class="panel panel-default">
                                <header class="panel-heading"><!-- react-text: 1143 -->Icon (font awesome)
                                    <!-- /react-text -->
                                    <hr>
                                </header>
                                <section class="panel-body text-center">
                                    <i class="fa fa-2x fa-rocket undefined" style="font-size: 48px;"></i>
                                </section>
                            </section>
                        </div>
                        <div>
                            <section class="panel panel-default">
                                <header class="panel-heading"><!-- react-text: 1150 -->Icon (meterial design)
                                    <!-- /react-text -->
                                    <hr>
                                </header>
                                <section class="panel-body text-center">
                                    <i class="material-icons undefined" style="font-size: 48px; vertical-align: middle; color: rgb(117, 117, 117);">g_translate</i>
                                </section>
                            </section>
                        </div>
                        <div>
                            <section class="panel panel-default">
                                <header class="panel-heading"><!-- react-text: 1157 -->Pager
                                    <!-- /react-text -->
                                    <hr>
                                </header>
                                <section class="panel-body text-center">
                                    <div class="tbl-footer undefined">
                                        <div>
                                            <div class="text-right m-t-lg"><!-- react-text: 1163 -->Showing
                                                <!-- /react-text --><!-- react-text: 1164 -->1
                                                <!-- /react-text --><!-- react-text: 1165 --> to
                                                <!-- /react-text --><!-- react-text: 1166 -->10
                                                <!-- /react-text --><!-- react-text: 1167 --> of
                                                <!-- /react-text --><!-- react-text: 1168 -->22
                                                <!-- /react-text --><!-- react-text: 1169 --> entries
                                                <!-- /react-text --></div>
                                        </div>
                                        <div>
                                            <div class="dataTables_paginate paging_simple_numbers text-right" id="DataTables_Table_1_paginate">
                                                <ul class="pagination" style="margin-top: 5px;">
                                                    <li class="paginate_button previous disabled" aria-controls="DataTables_Table_1" tabindex="0" id="DataTables_Table_1_previous">
                                                        <a href="javascript:;">Previous</a></li>
                                                    <li class="paginate_button " aria-controls="DataTables_Table_1" tabindex="0">
                                                        <a href="#">1</a></li>
                                                    <li class="paginate_button " aria-controls="DataTables_Table_1" tabindex="0">
                                                        <a href="#">2</a></li>
                                                    <li class="paginate_button " aria-controls="DataTables_Table_1" tabindex="0">
                                                        <a href="#">3</a></li>
                                                    <li class="paginate_button next" aria-controls="DataTables_Table_1" tabindex="0" id="DataTables_Table_1_next">
                                                        <a href="javascript:;">Next</a></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </section>
                            </section>
                        </div>
                        <div>
                            <section class="panel panel-default">
                                <header class="panel-heading"><!-- react-text: 1186 -->Switch
                                    <!-- /react-text -->
                                    <hr>
                                </header>
                                <section class="panel-body text-center">
                                    <div class="m-r-lg">
                                        <input type="checkbox" class="js-switch-small" value="on" style="display: none;"><span class="switchery switchery-small" style="border-color: rgb(121, 212, 167); box-shadow: rgb(121, 212, 167) 0px 0px 0px 0px inset; transition: border 0.4s, box-shadow 0.4s, background-color 1.2s; background-color: rgb(121, 212, 167);"><small style="left: 13px; transition: left 0.2s; background-color: rgb(255, 255, 255);"></small></span>
                                    </div>
                                    <div>
                                        <input type="checkbox" class="js-switch-small" value="on" style="display: none;"><span class="switchery switchery-small" style="border-color: rgb(232, 232, 232); box-shadow: rgb(232, 232, 232) 0px 0px 0px 0px inset; transition: border 0.4s, box-shadow 0.4s, background-color 1.2s; background-color: rgb(232, 232, 232);"><small style="left: 0px; transition: left 0.2s; background-color: rgb(255, 255, 255);"></small></span>
                                    </div>
                                </section>
                            </section>
                        </div>
                        <div>
                            <section class="panel panel-default">
                                <header class="panel-heading"><!-- react-text: 1200 -->Search Box
                                    <!-- /react-text -->
                                    <hr>
                                </header>
                                <section class="panel-body text-center">
                                    <form class="search-content" action="#" method="post">
                                        <input type="text" class="form-control" name="keyword" placeholder="Search...">
                                    </form>
                                </section>
                            </section>
                        </div>
                        <div>
                            <section class="panel panel-default">
                                <header class="panel-heading"><!-- react-text: 1208 -->Icon Stack
                                    <!-- /react-text -->
                                    <hr>
                                </header>
                                <section class="panel-body text-center">
                                    <div class="iconStack undefined">
                                        <span style="background-color: rgb(234, 90, 90);"><i class="material-icons undefined" style="font-size: 24px; vertical-align: middle; color: rgb(255, 255, 255);">check_circle</i></span>
                                    </div>
                                </section>
                            </section>
                        </div>
                        <div>
                            <section class="panel panel-default">
                                <header class="panel-heading"><!-- react-text: 1217 -->Timezone Control
                                    <!-- /react-text -->
                                    <hr>
                                </header>
                                <section class="panel-body text-center">
                                    <select class="form-control" name="person[time_zone_name]" id="person_time_zone_name">
                                        <option value="American Samoa">(GMT-11:00) American Samoa</option>
                                        <option value="International Date Line West">(GMT-11:00) International Date Line
                                            West
                                        </option>
                                        <option value="Midway Island">(GMT-11:00) Midway Island</option>
                                        <option value="Samoa">(GMT-11:00) Samoa</option>
                                        <option value="Hawaii">(GMT-10:00) Hawaii</option>
                                        <option value="Alaska">(GMT-09:00) Alaska</option>
                                        <option value="Pacific Time (US &amp; Canada)">(GMT-08:00) Pacific Time (US
                                            &amp; Canada)
                                        </option>
                                        <option value="Tijuana">(GMT-08:00) Tijuana</option>
                                        <option value="Arizona">(GMT-07:00) Arizona</option>
                                        <option value="Chihuahua">(GMT-07:00) Chihuahua</option>
                                        <option value="Mazatlan">(GMT-07:00) Mazatlan</option>
                                        <option value="Mountain Time (US &amp; Canada)">(GMT-07:00) Mountain Time (US
                                            &amp; Canada)
                                        </option>
                                        <option value="Central America">(GMT-06:00) Central America</option>
                                        <option value="Central Time (US &amp; Canada)">(GMT-06:00) Central Time (US
                                            &amp; Canada)
                                        </option>
                                        <option value="Guadalajara">(GMT-06:00) Guadalajara</option>
                                        <option value="Mexico City">(GMT-06:00) Mexico City</option>
                                        <option value="Monterrey">(GMT-06:00) Monterrey</option>
                                        <option value="Saskatchewan">(GMT-06:00) Saskatchewan</option>
                                        <option value="Bogota">(GMT-05:00) Bogota</option>
                                        <option value="Eastern Time (US &amp; Canada)">(GMT-05:00) Eastern Time (US
                                            &amp; Canada)
                                        </option>
                                        <option value="Indiana (East)">(GMT-05:00) Indiana (East)</option>
                                        <option value="Lima">(GMT-05:00) Lima</option>
                                        <option value="Quito">(GMT-05:00) Quito</option>
                                        <option value="Caracas">(GMT-04:30) Caracas</option>
                                        <option value="Atlantic Time (Canada)">(GMT-04:00) Atlantic Time (Canada)
                                        </option>
                                        <option value="Georgetown">(GMT-04:00) Georgetown</option>
                                        <option value="La Paz">(GMT-04:00) La Paz</option>
                                        <option value="Montevideo">(GMT-03:30) Montevideo</option>
                                        <option value="Newfoundland">(GMT-03:30) Newfoundland</option>
                                        <option value="Brasilia">(GMT-03:00) Brasilia</option>
                                        <option value="Buenos Aires">(GMT-03:00) Buenos Aires</option>
                                        <option value="Greenland">(GMT-03:00) Greenland</option>
                                        <option value="Santiago">(GMT-03:00) Santiago</option>
                                        <option value="Mid-Atlantic">(GMT-02:00) Mid-Atlantic</option>
                                        <option value="Azores">(GMT-01:00) Azores</option>
                                        <option value="Cape Verde Is.">(GMT-01:00) Cape Verde Is.</option>
                                        <option value="Casablanca">(GMT+00:00) Casablanca</option>
                                        <option value="Dublin">(GMT+00:00) Dublin</option>
                                        <option value="Edinburgh">(GMT+00:00) Edinburgh</option>
                                        <option value="Lisbon">(GMT+00:00) Lisbon</option>
                                        <option value="London">(GMT+00:00) London</option>
                                        <option value="Monrovia">(GMT+00:00) Monrovia</option>
                                        <option value="UTC">(GMT+00:00) UTC</option>
                                        <option value="Amsterdam">(GMT+01:00) Amsterdam</option>
                                        <option value="Belgrade">(GMT+01:00) Belgrade</option>
                                        <option value="Berlin">(GMT+01:00) Berlin</option>
                                        <option value="Bern">(GMT+01:00) Bern</option>
                                        <option value="Bratislava">(GMT+01:00) Bratislava</option>
                                        <option value="Brussels">(GMT+01:00) Brussels</option>
                                        <option value="Budapest">(GMT+01:00) Budapest</option>
                                        <option value="Copenhagen">(GMT+01:00) Copenhagen</option>
                                        <option value="Ljubljana">(GMT+01:00) Ljubljana</option>
                                        <option value="Madrid">(GMT+01:00) Madrid</option>
                                        <option value="Paris">(GMT+01:00) Paris</option>
                                        <option value="Prague">(GMT+01:00) Prague</option>
                                        <option value="Rome">(GMT+01:00) Rome</option>
                                        <option value="Sarajevo">(GMT+01:00) Sarajevo</option>
                                        <option value="Skopje">(GMT+01:00) Skopje</option>
                                        <option value="Stockholm">(GMT+01:00) Stockholm</option>
                                        <option value="Vienna">(GMT+01:00) Vienna</option>
                                        <option value="Warsaw">(GMT+01:00) Warsaw</option>
                                        <option value="West Central Africa">(GMT+01:00) West Central Africa
                                        </option>
                                        <option value="Zagreb">(GMT+01:00) Zagreb</option>
                                        <option value="Zurich">(GMT+01:00) Zurich</option>
                                        <option value="Athens">(GMT+02:00) Athens</option>
                                        <option value="Bucharest">(GMT+02:00) Bucharest</option>
                                        <option value="Cairo">(GMT+02:00) Cairo</option>
                                        <option value="Harare">(GMT+02:00) Harare</option>
                                        <option value="Helsinki">(GMT+02:00) Helsinki</option>
                                        <option value="Istanbul">(GMT+02:00) Istanbul</option>
                                        <option value="Jerusalem">(GMT+02:00) Jerusalem</option>
                                        <option value="Kaliningrad">(GMT+02:00) Kaliningrad</option>
                                        <option value="Kyiv">(GMT+02:00) Kyiv</option>
                                        <option value="Pretoria">(GMT+02:00) Pretoria</option>
                                        <option value="Riga">(GMT+02:00) Riga</option>
                                        <option value="Sofia">(GMT+02:00) Sofia</option>
                                        <option value="Tallinn">(GMT+02:00) Tallinn</option>
                                        <option value="Vilnius">(GMT+02:00) Vilnius</option>
                                        <option value="Baghdad">(GMT+03:00) Baghdad</option>
                                        <option value="Kuwait">(GMT+03:00) Kuwait</option>
                                        <option value="Minsk">(GMT+03:00) Minsk</option>
                                        <option value="Moscow">(GMT+03:00) Moscow</option>
                                        <option value="Nairobi">(GMT+03:00) Nairobi</option>
                                        <option value="Riyadh">(GMT+03:00) Riyadh</option>
                                        <option value="St. Petersburg">(GMT+03:00) St. Petersburg</option>
                                        <option value="Volgograd">(GMT+03:00) Volgograd</option>
                                        <option value="Tehran">(GMT+03:30) Tehran</option>
                                        <option value="Abu Dhabi">(GMT+04:00) Abu Dhabi</option>
                                        <option value="Baku">(GMT+04:00) Baku</option>
                                        <option value="Muscat">(GMT+04:00) Muscat</option>
                                        <option value="Samara">(GMT+04:00) Samara</option>
                                        <option value="Tbilisi">(GMT+04:00) Tbilisi</option>
                                        <option value="Yerevan">(GMT+04:00) Yerevan</option>
                                        <option value="Kabul">(GMT+04:30) Kabul</option>
                                        <option value="Ekaterinburg">(GMT+05:00) Ekaterinburg</option>
                                        <option value="Islamabad">(GMT+05:00) Islamabad</option>
                                        <option value="Karachi">(GMT+05:00) Karachi</option>
                                        <option value="Tashkent">(GMT+05:00) Tashkent</option>
                                        <option value="Chennai">(GMT+05:30) Chennai</option>
                                        <option value="Kolkata">(GMT+05:30) Kolkata</option>
                                        <option value="Mumbai">(GMT+05:30) Mumbai</option>
                                        <option value="New Delhi">(GMT+05:30) New Delhi</option>
                                        <option value="Sri Jayawardenepura">(GMT+05:30) Sri Jayawardenepura
                                        </option>
                                        <option value="Kathmandu">(GMT+05:45) Kathmandu</option>
                                        <option value="Almaty">(GMT+06:00) Almaty</option>
                                        <option value="Astana">(GMT+06:00) Astana</option>
                                        <option value="Dhaka">(GMT+06:00) Dhaka</option>
                                        <option value="Novosibirsk">(GMT+06:00) Novosibirsk</option>
                                        <option value="Urumqi">(GMT+06:00) Urumqi</option>
                                        <option value="Rangoon">(GMT+06:30) Rangoon</option>
                                        <option value="Bangkok">(GMT+07:00) Bangkok</option>
                                        <option value="Hanoi">(GMT+07:00) Hanoi</option>
                                        <option value="Jakarta">(GMT+07:00) Jakarta</option>
                                        <option value="Krasnoyarsk">(GMT+07:00) Krasnoyarsk</option>
                                        <option value="Beijing">(GMT+08:00) Beijing</option>
                                        <option value="Chongqing">(GMT+08:00) Chongqing</option>
                                        <option value="Hong Kong">(GMT+08:00) Hong Kong</option>
                                        <option value="Irkutsk">(GMT+08:00) Irkutsk</option>
                                        <option value="Kuala Lumpur">(GMT+08:00) Kuala Lumpur</option>
                                        <option value="Perth">(GMT+08:00) Perth</option>
                                        <option value="Singapore">(GMT+08:00) Singapore</option>
                                        <option value="Taipei">(GMT+08:00) Taipei</option>
                                        <option value="Ulaanbaatar">(GMT+08:00) Ulaanbaatar</option>
                                        <option value="Osaka">(GMT+09:00) Osaka</option>
                                        <option value="Sapporo">(GMT+09:00) Sapporo</option>
                                        <option value="Seoul">(GMT+09:00) Seoul</option>
                                        <option value="Tokyo">(GMT+09:00) Tokyo</option>
                                        <option value="Yakutsk">(GMT+09:00) Yakutsk</option>
                                        <option value="Adelaide">(GMT+09:30) Adelaide</option>
                                        <option value="Darwin">(GMT+09:30) Darwin</option>
                                        <option value="Brisbane">(GMT+10:00) Brisbane</option>
                                        <option value="Canberra">(GMT+10:00) Canberra</option>
                                        <option value="Guam">(GMT+10:00) Guam</option>
                                        <option value="Hobart">(GMT+10:00) Hobart</option>
                                        <option value="Magadan">(GMT+10:00) Magadan</option>
                                        <option value="Melbourne">(GMT+10:00) Melbourne</option>
                                        <option value="Port Moresby">(GMT+10:00) Port Moresby</option>
                                        <option value="Sydney">(GMT+10:00) Sydney</option>
                                        <option value="Vladivostok">(GMT+10:00) Vladivostok</option>
                                        <option value="New Caledonia">(GMT+11:00) New Caledonia</option>
                                        <option value="Solomon Is.">(GMT+11:00) Solomon Is.</option>
                                        <option value="Srednekolymsk">(GMT+11:00) Srednekolymsk</option>
                                        <option value="Auckland">(GMT+12:00) Auckland</option>
                                        <option value="Fiji">(GMT+12:00) Fiji</option>
                                        <option value="Kamchatka">(GMT+12:00) Kamchatka</option>
                                        <option value="Marshall Is.">(GMT+12:00) Marshall Is.</option>
                                        <option value="Wellington">(GMT+12:00) Wellington</option>
                                        <option value="Chatham Is.">(GMT+12:45) Chatham Is.</option>
                                        <option value="Nuku'alofa">(GMT+13:00) Nuku'alofa</option>
                                        <option value="Tokelau Is.">(GMT+13:00) Tokelau Is.</option>
                                    </select></section>
                            </section>
                        </div>
                        <div>
                            <section class="panel panel-default">
                                <section class="panel-body text-center">
                                    <div class="pull-left m-r-sm p-t-sm">
                                        <div class="iconStack undefined">
                                            <span style="width: 36px; height: 36px; background-color: rgb(168, 138, 221);"><i class="material-icons undefined" style="font-size: 24px; vertical-align: middle; color: rgb(255, 255, 255); line-height: 36px;">mail</i></span>
                                        </div>
                                    </div>
                                    <div class="pull-left text-left">
                                        <div class="d-b"><strong class="h4">125</strong>
                                            <!-- react-text: 1381 --> messages<!-- /react-text --></div>
                                        <span class="text-muted text-small">10 new today.</span></div>
                                </section>
                            </section>
                        </div>
                        <div>
                            <section class="panel panel-default">
                                <header class="panel-heading"><!-- react-text: 1386 -->Avatar
                                    <!-- /react-text -->
                                    <hr>
                                </header>
                                <section class="panel-body text-center" style="text-align: left;">
                                    <span class="thumb-sm avatar pull-left m-r-xs"><img src="/dist/images/img3.jpg"></span>
                                    <div class="d-b"><a href="user/@badRobot"><strong class="">Bad Robot</strong></a>
                                        <!-- react-text: 1394 --> Posted a message
                                        <!-- /react-text --></div>
                                                <span class="text-muted text-xs"><i class="fa fa-clock-o m-r-xs"></i>
                                                    <!-- react-text: 1397 -->a few seconds ago
                                                    <!-- /react-text --></span></section>
                            </section>
                        </div>
                        <div>
                            <section class="panel panel-default">
                                <header class="panel-heading"><!-- react-text: 1401 -->Profile
                                    <!-- /react-text -->
                                    <hr>
                                </header>
                                <section class="panel-body text-center">
                                    <div class="avatar">
                                        <img class="img-circle" src="/dist/images/5.png" alt=""></div>
                                    <a href="javascript:;"><h2 class="text-uppercase">Rocket Racoon</h2></a>
                                    <p>info@microsoft.com</p></section>
                            </section>
                        </div>
                        <div>
                            <section class="panel panel-default">
                                <header class="panel-heading"><!-- react-text: 1412 -->Users
                                    <!-- /react-text -->
                                    <hr>
                                </header>
                                <section class="panel-body text-center" style="text-align: left;">
                                    <article class="comment-item">
                                        <a class="pull-left thumb-sm m-r-sm"><img src="/dist/images/5.png" class="img-circle"></a>
                                        <section class="comment-body">
                                            <header><!-- react-text: 1420 -->
                                                <!-- /react-text --><a href="#"><strong>Andrew Wilson</strong></a>
                                            </header>
                                            <div class="text-muted">UI / UX Developer</div>
                                        </section>
                                    </article>
                                    <article class="comment-item">
                                        <a class="pull-left thumb-sm m-r-sm"><img src="/dist/images/7.png" class="img-circle"></a>
                                        <section class="comment-body">
                                            <header><!-- react-text: 1429 -->
                                                <!-- /react-text --><a href="#"><strong>Noah Wilson</strong></a>
                                            </header>
                                            <div class="text-muted">UI / UX Developer</div>
                                        </section>
                                    </article>
                                    <article class="comment-item">
                                        <a class="pull-left thumb-sm m-r-sm"><img src="/dist/images/8.png" class="img-circle"></a>
                                        <section class="comment-body">
                                            <header><!-- react-text: 1438 -->
                                                <!-- /react-text --><a href="#"><strong>Heather Smith</strong></a>
                                            </header>
                                            <div class="text-muted">UI / UX Developer</div>
                                        </section>
                                    </article>
                                    <article class="comment-item">
                                        <a class="pull-left thumb-sm m-r-sm"><img src="/dist/images/img3.jpg" class="img-circle"></a>
                                        <section class="comment-body">
                                            <header><!-- react-text: 1447 -->
                                                <!-- /react-text --><a href="#"><strong>Erin Vieira</strong></a>
                                            </header>
                                            <div class="text-muted">UI / UX Developer</div>
                                        </section>
                                    </article>
                                    <article class="comment-item">
                                        <a class="pull-left thumb-sm m-r-sm"><img src="/dist/images/avatar.png" class="img-circle"></a>
                                        <section class="comment-body">
                                            <header><!-- react-text: 1456 -->
                                                <!-- /react-text --><a href="#"><strong>Mia Vieira</strong></a>
                                            </header>
                                            <div class="text-muted">UI / UX Developer</div>
                                        </section>
                                    </article>
                                </section>
                            </section>
                        </div>
                        <div>
                            <section class="panel panel-default">
                                <header class="panel-heading"><!-- react-text: 1463 -->feed
                                    <!-- /react-text -->
                                    <hr>
                                </header>
                                <section class="panel-body text-center" style="text-align: left;">
                                    <div class="media chat-item">
                                        <div class="media-left p-r">
                                            <a href="#" class="sa-thumb-small"><img class="media-object avatar circle" src="https://s3-us-west-2.amazonaws.com/mindcraft.io/avatars/4.png" alt=""></a>
                                            <div class="backbar"></div>
                                        </div>
                                        <div class="media-body"><h4 class="media-heading">
                                                <!-- react-text: 1473 -->Commented on
                                                <!-- /react-text --><a href="#">Sign-up Modal</a>
                                                <!-- react-text: 1475 --> in
                                                <!-- /react-text --><a href="#">IPhone Landing Page</a></h4>
                                            <p>5 minutes ago</p></div>
                                    </div>
                                    <div class="media chat-item">
                                        <div class="media-left p-r">
                                            <a href="#" class="sa-thumb-small"><img class="media-object avatar circle" src="https://s3-us-west-2.amazonaws.com/mindcraft.io/avatars/6.png" alt=""></a>
                                            <div class="backbar"></div>
                                        </div>
                                        <div class="media-body"><h4 class="media-heading">
                                                <!-- react-text: 1485 -->Commented on
                                                <!-- /react-text --><a href="#">Sign-up Modal</a>
                                                <!-- react-text: 1487 --> in
                                                <!-- /react-text --><a href="#">IPhone Landing Page</a></h4>
                                            <p>5 minutes ago</p></div>
                                    </div>
                                    <div class="media chat-item">
                                        <div class="media-left p-r">
                                            <a href="#" class="sa-thumb-small"><img class="media-object avatar circle" src="https://s3-us-west-2.amazonaws.com/mindcraft.io/avatars/7.png" alt=""></a>
                                            <div class="backbar"></div>
                                        </div>
                                        <div class="media-body"><h4 class="media-heading">
                                                <!-- react-text: 1497 -->Added 2 new screens to
                                                <!-- /react-text --><a href="#">IPhone Landing Page</a></h4>
                                            <p>30 minutes ago</p></div>
                                    </div>
                                </section>
                            </section>
                        </div>
                    </div>
                </div>
            </section>
        </section>
    </section>
@endsection