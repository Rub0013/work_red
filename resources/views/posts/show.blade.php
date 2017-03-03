@extends('layouts.admin')
@section('content')
    <section id="content">

        @include('partials.title')

        <section class="vbox col-md-12">
            <section class="scrollable">
                <div class="container full content-body">
                    <div class="col-md-12">
                        <section class="panel panel-default">
                            <header class="panel-heading">
                                <h3>Show Post</h3>
                                <hr>
                            </header>
                            <div class="panel-body">
                                <div class="container">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="row">
                                                <div class="col-md-8">
                                                    <h4><strong><a href="{{$post->url}}">{{ $post->title}}</a></strong></h4>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <?php if($post->is_link_post){ ?>
                                                <div class="col-md-2">
                                                    <a href="{{$post->url}}" class="thumbnail">
                                                        <img src="/uploads/{{$post->imageUrl}}" alt="{{$post->title}}">
                                                    </a>
                                                </div>
                                                <?php } ?>
                                                <div class="col-md-8">
                                                    <p>{{$post->body}}</p>
                                                    <p><a class="btn btn-primary" href="{{$post->url}}">Read more</a></p>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-8">
                                                    <p></p>
                                                    <p>
                                                        <i class="icon-user"></i> by <a href="#">{{$post->user->name}}</a>
                                                        | <i class="icon-calendar"></i>Publish Date {{convertTimeToUSERzone($post->publish_date,$post->timezone)}}
                                                        | <i class="icon-tags"></i> Subreddit :
                                                        <a href="https://www.reddit.com/r/{{$post->sub_reddit}}/"><span class="label label-info">{{$post->sub_reddit}}</span></a>
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
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