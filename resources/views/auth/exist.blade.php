@extends('layouts.auth')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Login</div>
                    <div class="panel-body">

                        This reddit account already registered in our system, please login with<br>
                        <a class="btn btn-link" href="{{ route('resetPassword') }}">
                            Forgot Your Password?
                        </a>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection