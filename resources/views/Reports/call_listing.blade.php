@extends('layout.master')
@section('header', 'CALL LISTING REPORT')

@section('content')
 <div class="container-fluid">
    <div class="row">
      <div class="col-lg-12">
          <div class="card card-lightblue">
              <div class="card-body border border-dark">

                  @include('layouts.alerts')
                <form action="{{ url()->current()}}" method="GET">
               <!--    <input type="hidden" name="_token" value="{{ Session::token() }}"> -->
                   <div class="row">
                      <div class="col-md-4">
                        <div class="input-group mb-3">
                          <div class="input-group-prepend">
                                <span class="input-group-text">Date Range</span>
                            </div>
                          <input type="text" name="date_range" id="reportrange"  value="{{ Request::get('date_range')}}" 
                          class="form-control @error('date_range') is-invalid @enderror"  
                          style="background: #fff; cursor: pointer; padding: 5px 5px; border: 1px solid #ccc; ">
                           @error('date_range')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                          @enderror
                        </div>
                      </div>
                       <div class="col-md-6">
                          <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text">Caller Number</span>
                            </div>
                            <input type="text" name="caller_number" id="caller_number" value="{{ Request::get('caller_number') }}" class="form-control col-md-4 @error('caller_number') is-invalid @enderror">
                            @error('caller_number')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                          @enderror
                          </div>
                       </div>
                    </div>
                    <div class="row">
                       <div class="col-md-4">
                        <div class="input-group mb-3">
                          <div class="input-group-prepend">
                                <span class="input-group-text">Page Size</span>
                            </div>
                          <input type="text" name="page_size" id="page_size"  value="{{ Request::get('page_size') }}" 
                          class="form-control col-md-4 @error('page_size') is-invalid @enderror">
                           @error('page_size')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                          @enderror
                        </div>
                      </div>
                  </div>
                    <div class=" button-group mt-3">
                      <div class="btn-group">
                        <div class="form-group mx-sm-1 mb-2">
                          <button type="submit" class="btn btn-primary mb-2" id="submit_q" name="q"
                                            value="q" data-value="{{ Request::get('q') }}"
                          >Search</button>
                        </div>
                        <div class="form-group mx-sm-1 mb-2">
                          <a href="{{ route('report.call_listing') }}"> 
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
  <div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            @if (isset($cdr_arry) && count($cdr_arry)>0)
            <div class="card">
              <div class="card-header">
                 <div class="form-group pull-right">

                          <!-- <a href="{{ route('report.call_listing.export',[$cdr_arry->start_date,$cdr_arry->end_date,$cdr_arry->caller_number,$cdr_arry->q]) }}"> <button type="button"
                          class="btn btn-default" style="background-color: #3c8dbc;color: #eef8ff"> <i class="fas fa-file-export"></i>Export to csv</button></a> -->
                          <button type="button"
                          class="btn btn-default" onclick="csvdownload()" style="background-color: #3c8dbc;color: #eef8ff"> <i class="fas fa-file-export"></i>Export to csv</button>
                  </div>
              </div>
                <div class="card-body border border-dark">
                    <div class="table-responsive">

                        <table id="cdr_table" class="table table-bordered table-striped table-secondary">

                            <thead>
                                <tr>
                                   
                                    <th>Call Date Time</th>
                                    <th>Caller Number</th>
                                    <th>Agent Name</th>
                                    <th>Agent Phone Number</th>
                                    <th>Doctor Name</th>
                                    <th>Doctor Phone Number</th>
                                    <th>Hangup Cause</th>
                                    <th>Recording URL</th>
                                </tr>
                            </thead>
                            <tbody>
                                 
                                @foreach ($cdr_arry as $key =>$value)
                                <tr>
                                    <td>{{$value->start_stamp}}</td>
                                     <td><a  class="btn btn-block btn-default" type="button"> {{$value->caller_id_number}}</a></td>
                                    <td><a  class="btn btn-block btn-default" type="button"> {{$value->agent_name}} </a></td>
                                    <td><a  class="btn btn-block btn-default" type="button" 
                                   > {{$value->agent_phone_number}} </a></td>
                                    <td><a  class="btn btn-block btn-default" type="button" 
                                    > {{$value->doctor_name}} </a></td>
                                    <td><a  class="btn btn-block btn-default" type="button" 
                                    > {{$value->doctor_phone_number}} </a></td>
                                    <td>{{$value->hangup_cause}}</td>
                                    <td> 
                                      <audio controls="controls" id="audio" src="{{$value->recording_url}}"></audio></td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div> 
                </div>  
                  <div class="card-footer">
                     {{ $cdr_arry->appends(request()->query())->links() }}
                     @if (strpos(Request::get('q'), 'cdr_') === 0) 
                     <a class="btn btn-danger back" type="button" 
                     href="{{route('report.index')}}?date_range={{ strstr($value->start_stamp,' ',true)}} - {{ strstr($value->start_stamp,' ',true)}}&report_type=Summary&page_size=&q=q"> Back </a> 
                    @elseif(strpos(Request::get('q'), 'agent_') === 0)
                    <a class="btn btn-danger back" type="button" 
                     href="{{route('report.agent')}}?date_range={{ strstr($value->start_stamp,' ',true)}} - {{ strstr($value->start_stamp,' ',true)}}&report_type=Summary&page_size=&q=q"> Back </a> 
                     @elseif(strpos(Request::get('q'), 'doctor_') === 0)
                    <a class="btn btn-danger back" type="button" 
                     href="{{route('report.doctor')}}?date_range={{ strstr($value->start_stamp,' ',true)}} - {{ strstr($value->start_stamp,' ',true)}}&report_type=Summary&page_size=&q=q"> Back </a> 
                    @endif
                    
                  </div> 
            </div>
             @endif
              @if (isset($search))
              <h5>NO DATA FOUND</h5>
              @endif
        </div>
    </div>
</div>
@endsection
@section('script')
  <script src="{{asset('assets/js/jquery-validate.js')}}"></script>
 <script src="{{asset('assets/js/jquery.tabletoCSV.js')}}" type="text/javascript" charset="utf-8"></script>


  <script type="text/javascript">
   $("#cdr_table td a").each(function(){
        if ($(this).text()== 0) {
            $(this).hide();
;
        }
});
function csvdownload() {
 $("#cdr_table").tableToCSV();
}


   $('.back').hide();
    var buttom = document.querySelector("button");
    var submit_val = buttom.getAttribute("data-value");
    console.log(submit_val);
    if(submit_val!="q")
      $('.back').show();

  </script>
  <script src="{{asset('assets/js/daterange_picker.js')}}"></script>
   @endsection