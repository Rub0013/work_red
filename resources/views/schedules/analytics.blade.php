@extends('layouts.admin')
@section('content')
    <section id="content">
        <div class="page-loader" style="display: none;"></div>
        @include('partials.title')
        <div class="col-md-8">
            {!! Form::open(array('route'=>'generateReports')) !!}
            {!! Form::submit('GENERATE REPORTS',['class' => 'btn btn-primary','id' => 'generate_reports']) !!}
            <div class="form-group text-left">
                <h3>Post Karma Growth</h3>
                {!! Form::label('name', 'Show by') !!}
                {!! Form::select('show_post_karma_by', ['week' => 'This week',
                'month' => 'This month',
                'all' => 'All time',
                'six_months' => 'Last 6 months'], 'week',
                ['class' => 'form-control chosen-type','id' => 'show_post_karma_by']) !!}
                <div style="margin-top:20px;height: 400px;background: rgba(128,128,128,0.61)" id="post_karma"></div>
            </div>
            <div class="form-group text-left">
                <h3>Comment Karma Growth</h3>
                {!! Form::label('name', 'Show by') !!}
                {!! Form::select('show_comment_karma_by', ['week' => 'This week',
                'month' => 'This month',
                'all' => 'All time',
                'six_months' => 'Last 6 months'], 'week',
                ['class' => 'form-control chosen-type','id' => 'show_comment_karma_by']) !!}
                <div style="margin-top:20px;height: 400px;background: rgba(128,128,128,0.61)" id="comment_karma"></div>
            </div>
            {!! Form::close() !!}
        </div>
    </section>
@endsection