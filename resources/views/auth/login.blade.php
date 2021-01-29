@extends('layouts.app')

@section('content')
<!-- <div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
        <div class="text-center pb-3">
        <img src="{{ asset('images/arogyasakhi.png') }}">
        </div> 
            <div class="card">
                <div class="card-header">{{ __('Login') }}</div>
<?php
/*
@if($errors->any())
{{ implode('', $errors->all('<div>:message</div>')) }}
@endif 
*/
?>
                <div class="card-body">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="login_id" class="col-md-4 col-form-label text-md-right">Login Id</label>

                            <div class="col-md-6">
                                <input id="login_id" type="text" class="form-control @error('login_id') is-invalid @enderror" name="login_id" value="{{ old('login_id') }}" required autocomplete="login_id" autofocus>

                                @if($errors->has('login_id'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('login_id') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @endif" name="password" required autocomplete="current-password">

                                @if($errors->has('password'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-6 offset-md-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">
                                        {{ __('Remember Me') }}
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Login') }}
                                </button>

                                @if (Route::has('password.request'))
                                    <a class="btn btn-link" href="{{ route('password.request') }}">
                                        {{ __('Forgot Your Password?') }}
                                    </a>
                                @endif
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div> -->

<div class="container">
        <div class="card col-lg-12 col-md-12 col-xs-12 col-xs-12 shadow-lg">
            <div class="row">
                <div class="col-md-6 col-lg-4">
                    <img src="{{ asset('assets/dist/img/vopd_sample1.png') }}" style="width: 100%">
                    <div class="row">
                        <div class="card-body">
                            <form method="POST" action="{{ route('login') }}">
                                    @csrf

                                    <div class="form-group row">
                                        <label for="login_id" class="col-md-4 col-form-label text-md-left">Login Id</label>

                                        <div class="col-lg-12 col-md-12 col-xs-12 col-sm-12">
                                            <input id="login_id" type="text" class="form-control @error('login_id') is-invalid @enderror" name="login_id" value="{{ old('login_id') }}" required autocomplete="login_id" autofocus="autofocus" >

                                            @if($errors->has('login_id'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('login_id') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="password" class="col-md-4 col-form-label text-md-left">{{ __('Password') }}</label>

                                        <div class="col-lg-12 col-md-12 col-xs-12 col-sm-12">
                                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                            @error('password')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <div class="col-lg-12 col-md-12 col-xs-12 col-sm-12">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                                <label class="form-check-label" for="remember">
                                                    {{ __('Remember Me') }}
                                                </label>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group row mb-0">
                                        <div class="col-lg-12 col-md-12 col-xs-12 col-sm-12">
                                            <button type="submit" class="btn btn-primary">
                                                {{ __('Login') }}
                                            </button>

                                            @if (Route::has('password.request'))
                                                <a class="btn btn-link" href="{{ route('password.request') }}">
                                                    {{ __('Forgot Your Password?') }}
                                                </a>
                                            @endif
                                        </div>
                                    </div>
                                </form>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-8"  style=" display: flex;justify-content: center;align-items: center;">
                   
                        <img src="{{ asset('images/ArmmanLogo.jpg') }}"  style="background-repeat: no-repeat; width: 70%; text-align: center; "></div>
                   
                </div>
            </div>
        </div>
</div>




@endsection
