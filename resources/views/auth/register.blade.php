@extends('layouts.front.login_signin')
@section('content')
    <div class="form-signin">
        <form class="form-horizontal" role="form" method="POST" action="{{ url('/register') }}">
            {{ csrf_field() }}
            <h2 class="form-signin-heading">sign in now</h2>
            <div class="login-wrap">

                <div class="form-group{{ $errors->has('first_name') ? ' has-error' : '' }}">

                    <input id="first_name" type="text" class="form-control" name="first_name" value="{{ old('first_name') }}" placeholder="Votre prenom" autofocus>

                    @if ($errors->has('first_name'))
                        <span class="help-block">
                                                <strong>{{ $errors->first('first_name') }}</strong>
                        </span>
                    @endif
                </div>

                <div class="form-group{{ $errors->has('last_name') ? ' has-error' : '' }}">

                    <input id="last_name" type="text" class="form-control" name="last_name" value="{{ old('last_name') }}" placeholder="Votre nom" autofocus>

                    @if ($errors->has('last_name'))
                        <span class="help-block">
                                                <strong>{{ $errors->first('last_name') }}</strong>
                        </span>
                    @endif
                </div>


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

                <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">

                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" placeholder="Password">


                    @if ($errors->has('password_confirmation'))
                        <span class="help-block">
                            <strong>{{ $errors->first('password_confirmation') }}</strong>
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
