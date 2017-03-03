@extends('layouts.admin')
@section('content')
    <section id="content">

        @include('partials.title')

        <section class="vbox col-md-12">
            <section class="scrollable">
                <div class="container full content-body">
                    @if (session('message'))
                        <div class="alert alert-success">
                            <strong><h5>{{ session('message') }}</h5></strong>
                        </div>
                    @endif
                    <div class="col-md-4">
                        <section class="panel panel-default">
                            <header class="panel-heading">
                                <h3>Influencer Tab Ignore for now</h3>
                                <hr>
                            </header>
                            <div class="panel-body">
                                <ul class="nav nav-tabs">
                                    <li class="active"><a data-toggle="tab" href="#disscussions">Disscussions</a>
                                    </li>
                                    <li><a data-toggle="tab" href="#find_influencers">Find Influencers</a></li>
                                    <li><a data-toggle="tab" href="#respond_to_influencers">Respond to Influencers</a></li>
                                </ul>

                                <div class="tab-content">
                                    <div id="disscussions" class="tab-pane fade in active">
                                        {!! HTML::ul($errors->all()) !!}
                                        <br/>
                                        {!! Form::open(array('route'=>'ignore')) !!}

                                        <div class="form-group text-left">
                                            {!! Form::label('name', 'Enter Keyword or Phrase') !!}
                                            {!! Form::text('keyword', '', array('id' => 'keyword', 'class' => 'form-control', 'required' => 'required')) !!}
                                        </div>

                                        <div class="form-group text-left">
                                            {!! Form::label('name', 'Enter Specific Subreddits') !!}
                                            {!! Form::text('specific_subreddits', Input::old('specific_subreddits'), array('class' => 'form-control', 'required' => 'required')) !!}
                                        </div>
                                        {!! Form::button('Find', array('class' => 'btn btn-primary')) !!}

                                        {!! Form::label('name', 'Filter Results by:') !!}

                                        <div class="form-group text-left">
                                            {!! Form::label('name', 'SubReddit') !!}
                                            {!! Form::select('subreddit', $subreddit , '', array('class' => 'form-control', 'required' => 'required'))!!}
                                        </div>
                                        <div class="form-group text-left">
                                            {!! Form::label('name', 'Time') !!}
                                            {!! Form::select('time',array('Choose Time') , '', array('class' => 'form-control', 'required' => 'required'))!!}
                                        </div>
                                        <div class="form-group text-left">
                                            {!! Form::label('name', 'Most Recent/Most Popular') !!}
                                            {!! Form::select('recent_popular',array('Choose Recent or Popular') , '', array('class' => 'form-control', 'required' => 'required'))!!}
                                        </div>
                                        {!! Form::button('Update', array('class' => 'btn btn-primary')) !!}
                                        <div class="form-group text-left">
                                            <ul class="list-unstyled press">
                                                <li class="press-release">
                                                    {!! Form::button('Respond', array('class' => 'btn btn-primary')) !!}
                                                    <i class="fa fa-file-text-o fa-lg"></i>
                                                    <a target="_blank" href="http://kentucky.gov/Pages/Activity-Stream.aspx?viewMode=ViewDetailInNewPage&amp;eventID=%7b6E29454C-D824-40C1-9C3B-F3317AFC6670%7d&amp;activityType=PressRelease">Archery Tournament for Beginners Jan. 2 at E.P. ‘Tom’ State Park</a>
                                                    <p><cite class="publishedAgency">CHFS</cite> - <span class="publishedDate">Published 12/9/2014</span></p>
                                                    <p class="summary">Beginner archers have an opportunity to <span class="highlight">test</span> <span>their skills at The Snowflake Shoot</span></p>
                                                </li>
                                                <li class="event">
                                                    {!! Form::button('Respond', array('class' => 'btn btn-primary')) !!}
                                                    <i class="fa fa-calendar fa-lg"></i>
                                                    <a target="_blank" href="http://kentucky.gov/Pages/Activity-Stream.aspx?viewMode=ViewDetailInNewPage&amp;eventID=%7b6E29454C-D824-40C1-9C3B-F3317AFC6670%7d&amp;activityType=PressRelease">Archery Tournament for Beginners Jan. 2 at E.P. ‘Tom’ State Park</a>
                                                    <p><cite class="publishedAgency">CHFS</cite> - <span class="publishedDate">Published 12/9/2014</span></p>
                                                    <p class="summary">Beginner archers have an opportunity to <span class="highlight">test</span> <span>their skills at The Snowflake Shoot</span></p>
                                                </li>
                                            </ul>
                                        </div>
                                        {!! Form::close() !!}
                                    </div>
                                    <div id="find_influencers" class="tab-pane fade">
                                        {!! HTML::ul($errors->all()) !!}
                                        <br/>
                                        {!! Form::open(array('route' => 'ignore', 'files' => true)) !!}

                                        <div class="form-group text-left">
                                            {!! Form::label('name', 'Search SubReddit or Keyword') !!}
                                            {!! Form::text('subreddit_keyword', '', array('id' => 'subreddit_keyword', 'class' => 'form-control', 'required' => 'required')) !!}
                                        </div>

                                        {!! Form::submit('Search', array('class' => 'btn btn-primary')) !!}
                                        <div class="form-group text-left">
                                            <ul class="list-unstyled press">
                                                <li class="press-release">
                                                    {!! Form::button('Add', array('class' => 'btn btn-primary')) !!}
                                                    <i class="fa fa-file-text-o fa-lg"></i>
                                                    <a target="_blank" href="http://kentucky.gov/Pages/Activity-Stream.aspx?viewMode=ViewDetailInNewPage&amp;eventID=%7b6E29454C-D824-40C1-9C3B-F3317AFC6670%7d&amp;activityType=PressRelease">Archery Tournament for Beginners Jan. 2 at E.P. ‘Tom’ State Park</a>
                                                    <p><cite class="publishedAgency">CHFS</cite> - <span class="publishedDate">Published 12/9/2014</span></p>
                                                    <p class="summary">Beginner archers have an opportunity to <span class="highlight">test</span> <span>their skills at The Snowflake Shoot</span></p>
                                                </li>
                                                <li class="event">
                                                    {!! Form::button('Add', array('class' => 'btn btn-primary')) !!}
                                                    <i class="fa fa-calendar fa-lg"></i>
                                                    <a target="_blank" href="http://kentucky.gov/Pages/Activity-Stream.aspx?viewMode=ViewDetailInNewPage&amp;eventID=%7b6E29454C-D824-40C1-9C3B-F3317AFC6670%7d&amp;activityType=PressRelease">Archery Tournament for Beginners Jan. 2 at E.P. ‘Tom’ State Park</a>
                                                    <p><cite class="publishedAgency">CHFS</cite> - <span class="publishedDate">Published 12/9/2014</span></p>
                                                    <p class="summary">Beginner archers have an opportunity to <span class="highlight">test</span> <span>their skills at The Snowflake Shoot</span></p>
                                                </li>
                                            </ul>
                                        </div>
                                        {!! Form::close() !!}
                                    </div>
                                    <div id="respond_to_influencers" class="tab-pane fade">
                                        {!! HTML::ul($errors->all()) !!}
                                        <br/>
                                        {!! Form::open(array('route' => 'posts.store', 'files' => true)) !!}

                                        <div class="form-group text-left">
                                            {!! Form::label('name', 'Select Influencers:') !!}
                                            {!! Form::select('influencers',array('Choose Influencers'), '', array('id' => 'influencers', 'class' => 'form-control', 'required' => 'required')) !!}
                                        </div>
                                        <div class="form-group text-left">
                                            {!! Form::label('name', 'Sort By:') !!}
                                            {!! Form::select('sort_by',array('Choose Sorting By'), '', array('id' => 'sort_by', 'class' => 'form-control', 'required' => 'required')) !!}
                                        </div>
                                        <div class="form-group text-left">
                                            {!! Form::label('name', 'Select Influencers:') !!}
                                            {!! Form::select('time',array('Choose Time'), '', array('id' => 'time', 'class' => 'form-control', 'required' => 'required')) !!}
                                        </div>
                                        {!! Form::submit('Go', array('class' => 'btn btn-primary')) !!}

                                        {!! Form::close() !!}
                                    </div>
                                </div>
                            </div>
                        </section>
                    </div>
                </div>
            </section>
        </section>

    </section>
    </section>
@endsection