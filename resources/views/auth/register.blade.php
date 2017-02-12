@extends('layouts.auth')

@section('title') <title>Piyes | Register</title> @endsection

@section('content')
<div class="row">
    <div class="col-md-6">
        <h2 class="font-bold">Register New Account</h2>

        <p>
            Perfectly designed and precisely prepared role-based multi-language admin application.
        </p>

        <p>
            Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s.
        </p>

        <p>
            When an unknown printer took a galley of type and scrambled it to make a type specimen book.
        </p>

        <p>
            <small>It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.</small>
        </p>
    </div>
    <div class="col-md-6">
        <div class="ibox-content">
            <form class="m-t" role="form" method="POST" action="{{ route('register') }}">
                {{ csrf_field() }}
                @if(isset($invitee))
                <input type="hidden" name="token" value="{{ $token }}">
                @endif
                <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                    <input {{ isset($invitee) ? 'readonly' : '' }} type="text" name="name" class="form-control" placeholder="Your Name" required="" value="{{ $invitee->name or old('name') }}">
                    @if($errors->has('name'))
                        <span class="help-block">
                            <strong>{{ $errors->first('name') }}</strong>
                        </span>
                    @endif
                </div>
                <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                    <input {{ isset($invitee) ? 'readonly' : '' }} type="email" name="email" class="form-control" placeholder="E-Mail" required="" value="{{ $invitee->email or old('email') }}">
                    @if($errors->has('email'))
                        <span class="help-block">
                            <strong>{{ $errors->first('email') }}</strong>
                        </span>
                    @endif
                </div>
                <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                    <input type="password" name="password" class="form-control" placeholder="Password" required="">
                    @if($errors->has('password'))
                        <span class="help-block">
                            <strong>{{ $errors->first('password') }}</strong>
                        </span>
                    @endif
                </div>
                <div class="form-group{{ $errors->has('password-confirm') ? ' has-error' : '' }}">
                    <input type="password" name="password_confirmation" class="form-control" placeholder="Confirm Password" required="">
                    @if($errors->has('password-confirm'))
                        <span class="help-block">
                            <strong>{{ $errors->first('password-confirm') }}</strong>
                        </span>
                    @endif
                </div>
                <button type="submit" class="btn btn-primary block full-width m-b">Register</button>

                <a href="{{ route('password.request') }}">
                    <small>Forgot password?</small>
                </a>

                <p class="text-muted text-center">
                    <small>Already have an account?</small>
                </p>
                <a class="btn btn-sm btn-white btn-block" href="{{ route('login') }}">Login</a>
            </form>
            <p class="m-t">
                <small>Piyes Content Management System v1.4.2 &copy; 2017</small>
            </p>
        </div>
    </div>
</div>
@endsection

