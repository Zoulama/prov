@extends('layouts.front.login_signin')
@section('content')
    <div class="form-signin">
                    <form class="form-horizontal" role="form" method="POST" action="{{ url('/login') }}">
                        {{ csrf_field() }}
                        <h2 class="form-signin-heading">sign in now</h2>
                            <div class="login-wrap">
                                <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">

                                        <input id="email" type="text" class="form-control" name="email" value="{{ old('email') }}" placeholder="Votre email" autofocus>

                                        @if ($errors->has('email'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('email') }}</strong>
                                            </span>
                                        @endif
                                    </div>


                                <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">

                                        <input id="password" type="password" class="form-control" name="password" placeholder="Password">


                                        @if ($errors->has('password'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('password') }}</strong>
                                            </span>
                                        @endif

                                    </div>


                                <button class="btn btn-lg btn-login btn-block" type="submit">Sign in</button>
                                        <span class="pull-right">
                                                     <a data-toggle="modal" href="{{ url('/password/reset') }}"> Forgot Password?</a>
                                        </span>
                            </div>
                    </form>

@endsection
