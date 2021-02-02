@extends('layout.master')
@section('title', 'User Management')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">

                <div class="card-body">
                    <div class="card-title">
                    </div>
                    @include('layouts.alerts')
                    <div class="form-validation">
                        <form action="{{ route('user-master.store') }}" method="post">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">

                            <div class="form-group row">
                                <label class="col-lg-2 col-form-label" for="user_name">User Name <span class="text-danger">*</span></label>
                                <div class="col-lg-6">
                                    <input type="text" class="form-control" id="user_name" name="user_name" value="{{ old('user_name') }}" required>
                                    @if ($errors->has('user_name'))
                                    <span style="display:block" class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('user_name') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-2 col-form-label" for="login_id">Login ID <span class="text-danger">*</span></label>
                                <div class="col-lg-6">
                                    <input type="text" class="form-control" id="login_id" name="login_id" value="{{ old('login_id') }}" required>
                                    @if ($errors->has('login_id'))
                                    <span style="display:block" class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('login_id') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-2 col-form-label" for="email_id">Email ID <span class="text-danger">*</span></label>
                                <div class="col-lg-6">
                                    <input type="email" class="form-control" id="email_id" name="email_id" value="{{ old('email_id') }}" required>
                                    @if ($errors->has('email_id'))
                                    <span style="display:block" class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email_id') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-2 col-form-label" for="mobile_number">Mobile Number<span class="text-danger">*</span></label>
                                <div class="col-lg-6">
                                    <input type="text" class="form-control" id="mobile_number" name="mobile_number" value="{{ old('mobile_number') }}" required>
                                    @if ($errors->has('mobile_number'))
                                    <span style="display:block" class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('mobile_number') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-2 col-form-label" for="user_key">Password<span class="text-danger">*</span></label>
                                <div class="col-lg-6">
                                    <input type="password" class="form-control" id="user_key" name="user_key" value="{{ old('user_key') }}" required>
                                    @if ($errors->has('user_key'))
                                    <span style="display:block" class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('user_key') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-2 col-form-label" for="user_key_confirmation">Confirm Password <span class="text-danger">*</span></label>
                                <div class="col-lg-6">
                                    <input type="password" class="form-control" id="user_key_confirmation" name="user_key_confirmation" value="{{ old('user_key_confirmation') }}" required>
                                    @if ($errors->has('user_key_confirmation'))
                                    <span style="display:block" class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('user_key_confirmation') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-2 col-form-label" for="user_type">User Type<span class="text-danger">*</span></label>
                                <div class="col-lg-6">
                                    <select class="form-control" id="user_type" name="user_type" aria-required="true" required>
                                        <option selected disabled value="">User Type</option>
                                        @forelse($userTypes as $userType)
                                        <option @if($userType->user_type == old('user_type')) selected @endif value="{{$userType->user_type}}">{{$userType->user_description}}</option>
                                        @empty
                                        <option value="">no Role Available</option>
                                        @endforelse
                                    </select>

                                    @if ($errors->has('user_type'))
                                    <span style="display:block" class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('user_type') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>



                            
                            <div class="form-group row">
                            <label class="col-lg-2 col-form-label" for="user_group">Group <span class="text-danger">*</span></label>
                                <div class="col-lg-6">
                                    <select class="form-control" id="user_group" name="user_group" aria-required="true" required>
                                        <option value="">Please select User Group</option>
                                        @foreach ($GroupMasters as $gm)
                                        <option value="{{$gm->group_id}}" 
                                        @if ($gm->group_id == old('user_group') ) selected @endif >{{$gm->group_name}}</option>
                                        @endforeach
                                    </select>
                                    @if ($errors->has('user_group'))
                                    <span style="display:block" class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('user_group') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                            <label class="col-lg-2 col-form-label" for="isactive">Status <span class="text-danger">*</span></label>
                                <div class="col-lg-6">
                                    <select class="form-control" id="isactive" name="isactive" aria-required="true" required>
                                        <option value="" disabled>Please select Status</option>
                                        <option value="1" selected >Active</option>
                                        <option value="0" >Inctive</option>
                                    </select>
                                    @if ($errors->has('isactive'))
                                    <span style="display:block" class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('isactive') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-lg-3">
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                    <button type="reset" class="btn btn-primary">Reset</button>
                                    <a href="{{ route('user-master.index') }}">  <button type="button" class="btn btn-primary">Back</button></a>
                                </div>
                            </div>
                        </form>
                    </div>

                </div>

            </div>
        </div>
    </div>
</div>


@endsection

@section('script')
<script src="{{asset('assets/js/jquery-validate.js')}}"></script>
<script src="{{asset('assets/js/states.js')}}"></script>
@endsection