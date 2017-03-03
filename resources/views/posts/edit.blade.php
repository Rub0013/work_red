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
                                <h3>Update</h3>
                                <hr>
                            </header>
                            <div class="panel-body">
                                <div class="tab-content">
                                        <?php
                                       if(!$post->is_link_post){

                                        ?>
                                        {!! Form::open(array('route' => array('posts.update', $post->id))) !!}

                                        <div class="form-group text-left">
                                            {!! Form::label('name', 'Schedule Date') !!}
                                            {!! Form::text('date', convertTimeToUSERzone($post->publish_date,$post->timezone), array('id' => 'datepicker', 'class' => 'form-control', 'required' => 'required')) !!}
                                            {!! Form::hidden('timezone', '', array('id' => 'timezone', 'class' => 'form-control', 'required' => 'required')) !!}
                                        </div>

                                        <div class="form-group text-left">
                                            {!! Form::label('name', 'Title') !!}
                                            {!! Form::text('title', $post->title, array('class' => 'form-control', 'required' => 'required')) !!}
                                        </div>

                                        <div class="form-group text-left">
                                            {!! Form::label('body', 'Body') !!}
                                            {!! Form::textarea('body', $post->body, ['class' => 'form-control', 'required' => 'required']) !!}
                                        </div>

                                        <div class="form-group text-left">
                                            {!! Form::label('name', 'Choose a subreddit') !!}

                                            {!! Form::select('subreddit', $subreddit, strtoupper($post->sub_reddit), array('class' => 'form-control', 'required' => 'required'))!!}
                                        </div>

                                        {!! Form::hidden('post_type', 'text', array('class' => 'hidden_post_type')) !!}

                                        {!! Form::submit('Update', array('class' => 'btn btn-primary')) !!}

                                        {!! Form::close() !!}
                                    <?php }else {?>

                                        {!!  Form::open(array('route' => array('posts.update', $post->id),'files' => true)) !!}

                                        <div class="form-group text-left">
                                            {!! Form::label('name', 'Schedule Date') !!}
                                            {!! Form::text('date', convertTimeToUSERzone($post->publish_date,$post->timezone), array('id' => 'datepicker1', 'class' => 'form-control', 'required' => 'required')) !!}
                                            {!! Form::hidden('timezone', '', array('id' => 'timezone1', 'class' => 'form-control', 'required' => 'required')) !!}
                                        </div>

                                        <div class="form-group text-left">
                                            {!! Form::label('name', 'Url') !!}
                                            {!! Form::text('url', $post->url, array('class' => 'form-control', 'required' => 'required')) !!}
                                        </div>

                                        <div class="form-group text-center btn-upload-wrapper">
                                            {!! Form::label('image_edit', 'Choose Image', array('class'=>'btn btn-info')) !!}
                                            {!! Form::file('image_edit', Input::old('image'), array('class' => '', 'required' => 'required')) !!}
                                        </div>

                                        <div class="form-group text-left">
                                            {!! HTML::image('/uploads/'.$post->imageUrl, $post->imageUrl, array('id' => 'image_preview_edit')) !!}
                                        </div>

                                        <div class="form-group text-left">
                                            {!! Form::label('name', 'Title') !!}
                                            {!! Form::text('title', $post->title, array('class' => 'form-control', 'required' => 'required')) !!}
                                        </div>

                                        <div class="form-group text-left">
                                            {!! Form::label('name', 'Choose a subreddit') !!}
                                            {!! Form::select('subreddit', $subreddit,strtoupper($post->sub_reddit), array('class' => 'form-control', 'required' => 'required'))!!}
                                        </div>

                                        {!! Form::hidden('post_type', 'link', array('class' => 'hidden_post_type'))  !!}

                                        {!! Form::submit('Update', array('class' => 'btn btn-primary')) !!}

                                        {!! Form::close() !!}
                                   <?php } ?>
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