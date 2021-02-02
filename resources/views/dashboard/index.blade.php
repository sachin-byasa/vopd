@extends('layout.master')
@section('title', 'Dashboard')
@section('header', 'Dashboard')

@section('content')
  <div class="container-fluid">
    <div class="row">
      <div class="col-lg-12">
        <div class="card card-lightblue">
          <div class="card-body border border-dark">
          @include('layouts.alerts')
          <form action="{{ url()->current()}}" method="GET">
              <!--  <input type="hidden" name="_token" value="{{ Session::token() }}"> -->
              <div class="row">
                <div class="col-md-4">
                  <div class="input-group mb-3">
                  <div class="input-group-prepend">
                      <span class="input-group-text">Date Range</span>
                  </div>
                  <input type="text" name="date_range" id="reportrange"  value="{{ Request::get('date_range') }}" 
                  class="form-control @error('date_range') is-invalid @enderror"  
                  style="background: #fff; cursor: pointer; padding: 5px 5px; border: 1px solid #ccc; ">
                  @error('date_range')
                  <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                  </span>
                  @enderror
                  </div>
                </div>
                <div class="btn-group">
                  <div class="form-group mx-sm-1 mb-2">
                    <button type="submit" class="btn btn-primary mb-2" name="q"
                                    value="q"
                    >Search</button>
                  </div>
                  <div class="form-group mx-sm-1 mb-2">
                    <a href="{{ route('dashboard.index') }}"> 
                    <button type="button"class="btn btn-danger mb-2">Clear</button></a>
                  </div>
                </div>
              </div>
          </form>
          </div>
        </div>
      </div>
    </div>
  </div>

    <div class="container">
      <div class="row" style=" display: flex;
      justify-content: center;">

      <div class="col-md-2">
        <div class="card-counter success">
          <i class="fa fa-phone-alt"></i>
          <span class="count-numbers">{{$total_calls}}</span>
          <span class="count-name">Total Calls</span>
        </div>
      </div>

      <div class="col-md-2">
        <div class="card-counter primary">
          <i class="fa fa-female"></i>
          <span class="count-numbers">{{$ANC_calls}}</span>
          <span class="count-name">ANC Calls</span>
        </div>
      </div>

      <div class="col-md-2">
        <div class="card-counter danger">
          <i class="fa fa-female"></i>
          <span class="count-numbers">{{$before_ANC_hrs}}</span>
          <span class="count-name">Out Duty ANC</span>
        </div>
      </div>

      <div class="col-md-2">
        <div class="card-counter info">
          <i class="fa fa-child"></i>
          <span class="count-numbers">{{$PNC_calls}}</span>
          <span class="count-name">PNC Calls</span>
        </div>
      </div>
      <div class="col-md-2">
        <div class="card-counter danger">
          <i class="fa fa-child"></i>
          <span class="count-numbers">{{$after_PNC_hrs}}</span>
          <span class="count-name">Out Duty PNC</span>
        </div>
      </div>
    </div>
  </div>

@endsection

@section('script')
<script src="{{asset('assets/js/daterange_picker.js')}}"></script>
@endsection