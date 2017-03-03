@extends('layouts.admin')
@section('content')
    <section id="content">
        <div class="page-loader" style="display: none;"></div>

        @include('partials.title')

        <section class="vbox col-md-12">
            <section class="scrollable">
                <div class="container full content-body">
                    @if (session('message'))
                        <div class="alert alert-success">
                            <strong><h5>{{ session('message') }}</h5></strong>
                        </div>
                    @endif
                        @if (count($errors) > 0)
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                    <div class="col-md-4">
                        <section class="panel panel-default">
                            <header class="panel-heading">
                                <h3>Create</h3>
                                <hr>
                            </header>
                            <div class="panel-body">
                                <ul class="nav nav-tabs">
                                    <li class="active"><a data-toggle="tab" href="#create_text_post">Crate text post</a>
                                    </li>
                                    <li><a data-toggle="tab" href="#create_link_post">Crate link post</a></li>
                                </ul>

                                <div class="tab-content">
                                    <div id="create_text_post" class="tab-pane fade in active">
                                        <br/>
                                        {!! Form::open(array('route'=>'posts.store')) !!}

                                        <div class="form-group text-left">
                                            {!! Form::label('name', 'Schedule Date') !!}
                                            {!! Form::text('date', '', array('id' => 'datepicker', 'class' => 'form-control', 'required' => 'required')) !!}
                                            {!! Form::hidden('timezone', '', array('id' => 'timezone', 'class' => 'form-control', 'required' => 'required')) !!}
                                        </div>

                                        <div class="form-group text-left">
                                            {!! Form::label('name', 'Title') !!}
                                            {!! Form::text('title', Input::old('title'), array('class' => 'form-control', 'required' => 'required')) !!}
                                        </div>

                                        <div class="form-group text-left">
                                            {!! Form::label('body', 'Body') !!}
                                            {!! Form::textarea('body', null, ['class' => 'form-control', 'required' => 'required']) !!}
                                        </div>

                                        <div class="form-group text-left">
                                            {!! Form::label('name', 'Choose a subreddit') !!}

                                            {!! Form::text('subreddit', Input::old('subreddit'), array('id'=>'subreddit_for_text','class' => 'form-control', 'required' => 'required')) !!}
                                        </div>

                                        {!! Form::hidden('post_type', 'text', array('class' => 'hidden_post_type')) !!}

                                        {!! Form::submit('SCHEDULE', array('class' => 'btn btn-primary')) !!}

                                        {!! Form::close() !!}
                                    </div>

                                    <div id="create_link_post" class="tab-pane fade">
                                        <br/>
                                        {!! Form::open(array('route' => 'posts.store', 'files' => true)) !!}

                                        <div class="form-group text-left">
                                            {!! Form::label('name', 'Schedule Date') !!}
                                            {!! Form::text('date', '', array('id' => 'datepicker1', 'class' => 'form-control', 'required' => 'required')) !!}
                                            {!! Form::hidden('timezone', '', array('id' => 'timezone1', 'class' => 'form-control', 'required' => 'required')) !!}
                                        </div>

                                        <div class="form-group text-left">
                                            {!! Form::label('url', 'Url') !!}
                                            {!! Form::text('url', Input::old('url'), array('class' => 'form-control', 'required' => 'required')) !!}
                                        </div>

                                        <div class="form-group text-center btn-upload-wrapper">
                                            {!! Form::label('image', 'Choose Image', array('class'=>'btn btn-info')) !!}
                                            {!! Form::file('image', Input::old('image'), array('class' => '', 'required' => 'required')) !!}
                                        </div>

                                        <div class="form-group text-left">
                                            {!! HTML::image('#', 'your image', array('id' => 'image_preview')) !!}
                                        </div>

                                        <div class="form-group text-left">
                                            {!! Form::label('name', 'Title') !!}
                                            {!! Form::text('title', Input::old('title'), array('class' => 'form-control', 'required' => 'required')) !!}
                                        </div>

                                        <div class="form-group text-left">
                                            {!! Form::label('name', 'Choose a subreddit') !!}
                                            {!! Form::text('subreddit', Input::old('subreddit'), array('id'=>'subreddit_for_link','class' => 'form-control', 'required' => 'required')) !!}
                                        </div>

                                        {!! Form::hidden('post_type', 'link', array('class' => 'hidden_post_type'))  !!}

                                        {!! Form::submit('SCHEDULE', array('class' => 'btn btn-primary')) !!}

                                        {!! Form::close() !!}
                                    </div>
                                </div>
                            </div>
                        </section>
                    </div>

                    <div class="col-md-8">
                        <section class="panel panel-default">
                            <header class="panel-heading">
                                <h3>Last 5 Scheduled Posts</h3>
                                <hr>
                            </header>
                            <div class="panel-body">


                                @if ($posts)
                                    <?php $n = 1; ?>
                                    <table id="example" class="table table-striped table-bordered" cellspacing="0" width="100%">
                                        <thead>
                                        <tr>
                                            <th>N</th>
                                            <th>Type</th>
                                            <th>Title</th>
                                            <th>Body</th>
                                            <th>URL</th>
                                            <th>Subreddit</th>
                                            <th>Created at</th>
                                            <th>Publish at</th>
                                            <th>Status</th>
                                            <th>Status</th>
                                        </tr>
                                        </thead>
                                        @foreach ($posts as $post)
                                            <tbody>
                                            <tr>
                                                <td>{{ $n++ }}</td>
                                                <td>{{ $post->is_link_post ? 'Link' : 'Text' }}</td>
                                                <td>{{ $post->title }}</td>
                                                <td>{{ $post->body }}</td>
                                                <td>{{ $post->url }}</td>
                                                <td>{{ $post->sub_reddit }}</td>
                                                <td>{{ convertTimeToUSERzone($post->created_at,$post->timezone) }}</td>
                                                <td>{{ convertTimeToUSERzone($post->publish_date,$post->timezone) }}</td>
                                                <td title="{{$post->published_message}}" style="cursor:pointer; {{($post->is_published)?'color:#0000ff':'color:#ff0000'}}">{{ ($post->is_published)?'Published':'Pending'}}</td>
                                                <td>
                                                    <a class="btn btn-small btn-success" href="{{ URL::to('posts/show/' . $post->id) }}">Show</a>
                                                    <a class="btn btn-small btn-info" href="{{ URL::to('posts/edit/' . $post->id ) }}">Edit</a>
                                                    {!! Form::open([
                                                        'method' => 'DELETE',
                                                        'route' => ['posts.destroy', $post->id]
                                                    ]) !!}
                                                    {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
                                                    {!! Form::close() !!}
                                            </td>
                                            </tr>
                                            </tbody>
                                        @endforeach
                                    </table>
                                @else
                                    No any records!
                                @endif

                                <div class="form-group text-right">
                                    <a href="#">Show more...</a>
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