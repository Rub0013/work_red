@extends('layouts.admin')
@section('content')
    <section id="content">
        <div class="page-loader" style="display: none;"></div>
        @include('partials.title')
        <div class="col-md-5">
            <section class="panel panel-default">
                <div class="panel-body">
                    <h2>My Profile</h2>
                    </br>
                    <ul class="nav nav-tabs">
                        <li id="change_info_nav" class="active">
                            <a data-toggle="tab" href="#user_info">Change info</a>
                        </li>
                        <li>
                            <a data-toggle="tab" href="#user_pass">Change password</a>
                        </li>
                    </ul>
                    <div class="tab-content">
                        <div id="user_info" class="tab-pane fade in active">
                            <br/>
                            <div style="display: flex; justify-content: space-between" class="form-group text-left">
                                <h3 >Rrddit name</h3>
                                <h4 style="align-self: flex-end">{{$reddit_name}}</h4>
                            </div>
                            <div style="display: flex; justify-content: space-between" class="form-group text-left">
                                <h3>Name</h3>
                                <h4 style="align-self: flex-end" id="name_already_changed">
                                    <a href="#" id="username" data-type="text" data-pk="1" data-url="/update_name" data-title="Change username">{{$name}}</a>
                                </h4>
                            </div>
                            <div style="display: flex; justify-content: space-between" class="form-group text-left">
                                <h3>Email</h3>
                                <h4 style="align-self: flex-end">{{$email}}</h4>
                            </div>
                            <div style="display: flex; justify-content: space-between" class="form-group text-left">
                                <h3>Country</h3>
                                <h4 style="align-self: flex-end" id="country_already_changed">
                                    @if($country)
                                        <a href="#" id="country_name" data-pk="2" data-type="select" data-url="/update_country" data-title="Change country">{{$country}}</a>
                                    @else
                                        <a href="#" id="country_name" data-pk="2" data-type="select" data-url="/update_country" data-title="Change country">Empty</a>
                                    @endif
                                </h4>
                            </div>
                        </div>
                        <div id="user_pass" class="tab-pane fade">
                            <br/>
                            @if(session('success'))
                                <div class="alert alert-success">
                                    {{ session('success') }}
                                </div>
                            @endif
                            @if(session('error'))
                                <div class="alert alert-danger">
                                    {{ session('error') }}
                                </div>
                            @endif
                            <div id="msg"></div>
                            <form id="pass_form">
                                {{ csrf_field() }}
                                <div class="form-group">
                                    <div id="old_pass_div" class="form-group text-left">
                                        <label for="old_pass" class="control-label">Old password</label>
                                        <input name="old_pass" type="password" class="form-control" id="old_pass" placeholder="Password" required>
                                    </div>
                                    <div class="form-group text-left">
                                        <label for="new_pass" class="control-label">New password</label>
                                        <input name="new_pass" data-minlength="6" type="password" class="form-control" id="new_pass" placeholder="Minimum of 6 characters" required>
                                    </div>
                                    <div class="form-group text-left">
                                        <label for="confirm_pass" class="control-label">Confirm new password</label>
                                        <input name="confirm_pass" type="password" class="form-control" id="confirm_pass" data-match="#new_pass" data-match-error="Whoops, these don't match" placeholder="Confirm" required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <button id="submit_pass_change" type="button" class="btn btn-primary">Submit</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </section>
        </div>
        <script>
            $(document).ready(function(){
            });
        </script>
    </section>
@endsection