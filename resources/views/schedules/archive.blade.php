@extends('layouts.admin')
@section('content')
    <section id="content">
        <div class="page-loader" style="display: none;"></div>
        @include('partials.title')
        <div class="col-md-10">
            <section class="panel panel-default">
                <div class="panel-body">
                    <ul class="nav nav-tabs">
                        <li class="active"><a data-toggle="tab" href="#archive_subreddits">Subreddits</a>
                        </li>
                        <li><a data-toggle="tab" href="#archive_content_ideas">Content ideas</a></li>
                    </ul>
                    <div class="tab-content">
                        <div id="archive_subreddits" class="tab-pane fade in active">
                            <br/>
                            {!! Form::open() !!}
                            <div style="margin-bottom: 60px" class="form-group text-left">
                                {!! Form::label('name', 'Order by') !!}
                                {!! Form::select('type', ['default'=>'Default','new' => 'Date Addeed', 'popular' => 'Popularity'], 'Default',
                                    ['class' => 'form-control chosen-type','id' => 'order_type']) !!}
                            </div>
                            <table id="arch_sub" class="table table-striped table-bordered" cellspacing="0">
                                <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>URL</th>
                                    <th>Number of Subscribers</th>
                                    <th>Date added</th>
                                </tr>
                                </thead>
                                <tfoot>
                                <tr>
                                    <th>Name</th>
                                    <th>URL</th>
                                    <th>Number of Subscribers</th>
                                    <th>Date added</th>
                                </tr>
                                </tfoot>
                                <tbody id="sub_body">
                                @if(!empty($defaultSubreddits))
                                    @foreach($defaultSubreddits as $value)
                                        <tr>
                                            <td>/{{$value['name']}}</td>
                                            <td><a href="{{$value['url']}}" target="_blank">{{$value['url']}}</a></td>
                                            <td>{{$value['subscribers']}}</td>
                                            <td>{{$value['date_added']}}</td>
                                        </tr>
                                    @endforeach
                                @endif
                                </tbody>
                            </table>
                            {!! Form::close() !!}
                        </div>

                        <div id="archive_content_ideas" class="tab-pane fade">
                            <br/>
                            {!! Form::open() !!}
                            <div class="form-group text-left">
                                {!! Form::label('name', 'Filter by Subreddit') !!}
                                {!! Form::text('filter_by_subreddit', Input::old('filter_by_subreddit'),array('id'=>'filter_by_subreddit','class' => 'form-control chosen-type','placeholder' => 'Write in a subreddit'))!!}
                            </div>
                            <div class="form-group text-left">
                                {!! Form::label('name', 'Filter by User') !!}
                                {!! Form::select('filter_by_user', ['default' => 'By all users'], '',
                                    ['class' => 'form-control chosen-type','id' => 'filter_by_user']) !!}
                            </div>
                            <div class="form-group text-left">
                                {!! Form::label('name', 'Filter by Type') !!}
                                {!! Form::select('filter_by_type', ['default' => 'Of all types'], '',
                                   ['class' => 'form-control chosen-type','id' => 'filter_by_type']) !!}
                            </div>
                            {!! Form::close() !!}
                            <button id="update_list_button" class="btn btn-primary" style="margin-bottom:20px">UPDATE</button>
                            <table id="arch_content" class="table table-striped table-bordered" cellspacing="0">
                                <thead>
                                <tr>
                                    <th>Subreddit link</th>
                                    <th>User</th>
                                    <th class="no-sort">Type</th>
                                    <th class="no-sort">Command</th>
                                </tr>
                                </thead>
                                <tfoot>
                                <tr>
                                    <th>Subreddit link</th>
                                    <th>User</th>
                                    <th>Type</th>
                                    <th>Command</th>
                                </tr>
                                </tfoot>
                                <tbody id="arch_content_body">
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </section>
    <script>
        $(document).ready(function() {
        });
    </script>
@endsection