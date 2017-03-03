@extends('layouts.admin')
@section('content')
    <section id="content">
        <div class="page-loader" style="display: none;"></div>
        @include('partials.title')

        <section class="vbox col-md-3">
            <section class="scrollable">
                <div class="container full content-body">
                    @if (session('message'))
                        <div class="alert alert-success">
                            <strong><h5>{{ session('message') }}</h5></strong>
                        </div>
                    @endif
                    <div class="col-md-12">
                        <section class="panel panel-default">
                            <header class="panel-heading">
                                <h3>Research Time</h3>
                                <hr>
                            </header>
                            <div class="panel-body">
                                <div class="tab-content col-md-3">
                                        {!! HTML::ul($errors->all()) !!}
                                        <br/>
                                        {!! Form::open(array('route'=>'timeResearchBySubreddit')) !!}
                                         <h4>Analyze:</h4>
                                        <div class="form-group text-left">
                                            {!! Form::label('name', 'Enter Subreddit:') !!}
                                            {!! Form::text('subreddit', Input::old('subreddit'), array('id'=>'subreddit_for_search','class' => 'form-control', 'required' => 'required')) !!}
                                        </div>
                                        {!! Form::button('Create Graph', array('id' =>'create-graph','class' => 'btn btn-primary')) !!}
                                        <div class="form-group text-left">
                                            <?php $top_post_by_hour = array(0 => 'Choose Hour');
                                            for($i = 1;$i < 25; $i++)
                                                $top_post_by_hour[$i] = $i.' Hour';
                                            ?>
                                            {!! Form::label('name', 'Top Post by Hour') !!}
                                            {!! Form::select('hour', $top_post_by_hour, '', array('id'=>'hour','class' => 'form-control', 'required' => 'required'))!!}
                                            {!! Form::hidden('timezone', '', array('id' => 'timezone', 'class' => 'form-control', 'required' => 'required')) !!}
                                        </div>
                                        <div class="form-group text-left">
                                            <?php $top_post_by_day = array(0 => 'Choose Day');
                                            for($i = 1; $i < 31;$i++)
                                                $top_post_by_day[$i] = $i.' Day';
                                            ?>
                                            {!! Form::label('name', 'Top Post by Day') !!}
                                            {!! Form::select('day', $top_post_by_day, '', array('id'=>'day','class' => 'form-control', 'required' => 'required'))!!}
                                            {!! Form::hidden('timezone', '', array('id' => 'timezone1', 'class' => 'form-control', 'required' => 'required')) !!}
                                        </div>
                                        {!! Form::close() !!}
                                </div>
                                <div class="tab-content col-md-9">
                                    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
                                    <script type="text/javascript">

                                        chartDataOfPosts = {};
                                        function showChart(response){
                                            $('.page-loader').hide();
                                            chartDataOfPosts = $.parseJSON(response);
                                            if(chartDataOfPosts.length > 1){
                                                google.charts.load("current", {packages:['corechart']});
                                                google.charts.setOnLoadCallback(drawChart);
                                            }else{
                                                $('#columnchart_values').html('<div class="text-center top-posts"><h1>No published posts</h1></div>');
                                            }
                                        }
                                        function drawChart() {

                                            if(chartDataOfPosts.length > 0){

                                                var data = google.visualization.arrayToDataTable(chartDataOfPosts);

                                                var view = new google.visualization.DataView(data);

                                                view.setColumns([0, 1,
                                                    { calc: "stringify",
                                                        sourceColumn: 1,
                                                        type: "string",
                                                        role: "annotation" },
                                                    2]);

                                                var options = {
                                                    title: "Top Posts by Subreddits",
                                                    width: 1000,
                                                    height: 400,
                                                    bar: {groupWidth: "85%"},
                                                    legend: { position: "none" },
                                                };
                                                var chart = new google.visualization.ColumnChart(document.getElementById("columnchart_values"));
                                                chart.draw(view, options);
                                            }
                                        }
                                        $(document).on('click','#create-graph',function(){
                                            $('.page-loader').show();
                                            var csrf_token = '<?php echo csrf_token()?>';
                                            var subreddit = $('#subreddit_for_search').val();
                                            $.ajax({
                                                url: "/timeResearchBySubreddit",
                                                type:'POST',
                                                data:{
                                                    subreddit:subreddit
                                                },
                                                headers: {
                                                    'X-CSRF-TOKEN': csrf_token
                                                },
                                                success: function(response){
                                                    showChart(response);
                                                }});
                                        });
                                        $(document).on('change','#hour',function(){
                                            $('.page-loader').show();
                                            var csrf_token = '<?php echo csrf_token()?>';
                                            var subreddit = $('#subreddit_for_search').val();
                                            var hour = $(this).val();
                                            $.ajax({
                                                url: "/timeResearchByHour",
                                                type:'POST',
                                                data:{
                                                    subreddit:subreddit,
                                                    time:hour
                                                },
                                                headers: {
                                                    'X-CSRF-TOKEN': csrf_token
                                                },
                                                success: function(response){
                                                    showChart(response);
                                            }});

                                        });
                                        $(document).on('change','#day',function(){
                                            $('.page-loader').show();
                                            var csrf_token = '<?php echo csrf_token()?>';
                                            var subreddit = $('#subreddit_for_search').val();
                                            var day = $(this).val();
                                            $.ajax({
                                                url: "/timeResearchByDay",
                                                type:'POST',
                                                data:{
                                                    subreddit:subreddit,
                                                    time:day
                                                },
                                                headers: {
                                                    'X-CSRF-TOKEN': csrf_token
                                                },
                                                success: function(response){
                                                    showChart(response);
                                                }});

                                        });
                                    </script>
                                    <div id="columnchart_values" class="content"></div>
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