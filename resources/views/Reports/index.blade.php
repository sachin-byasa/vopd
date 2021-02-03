@extends('layout.master')
@section('header', 'CDR REPORT')

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
                       <div class="col-md-6">
                          <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text">Report Type</span>
                            </div>
                            <select class="form-control  @error('report_type') is-invalid @enderror" name="report_type">
                              <option value="">---Select Report Type---</option>
                              <option @if (Request::get('report_type')=='Detailed') selected @endif>Detailed</option>
                              <option @if (Request::get("report_type")=='Summary') selected @endif>Summary</option>
                            </select>

                            @error('report_type')
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
                          class="form-control col-md-4 @error('page_size') is-invalid @enderror" value="2">
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
                          <button type="submit" class="btn btn-primary mb-2" name="q"
                                            value="q"
                          >Search</button>
                        </div>
                        <div class="form-group mx-sm-1 mb-2">
                          <a href="{{ route('report.index') }}"> 
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
                          <a href="{{ route('report.index.export',[$cdr_arry->start_date,$cdr_arry->end_date]) }}"> <button type="button"
                          class="btn btn-default" style="background-color: #3c8dbc;color: #eef8ff"> <i class="fas fa-file-export"></i>Export to csv</button></a>
                  </div>
                </div>
                <div class="card-body border border-dark">
                    <div class="table-responsive">
                        <table id="cdr_table" class="table table-bordered table-striped table-secondary">
                            <thead>
                                <tr>
                                   
                                    <th>Date</th>
                                    <th>Total no of Calls</th>
                                    <th>Before ANC hrs</th>
                                    <th>After PNC hrs</th>
                                    <th>ANC Calls</th>
                                    <th>PNC Calls</th>
                                </tr>
                            </thead>
                            <tbody>
                                 
                                @foreach ($cdr_arry as $key =>$value)
                                <tr>
                                   
                                    <th>{{$value->start_stamp}}</th>
                                    <td><a class="btn btn-block btn-default" type="button" value="{{$value->total_calls}}" href="{{route('report.call_listing')}}?date_range={{ str_replace('/','%2F',$value->start_stamp)}} - {{ str_replace('/','%2F',$value->start_stamp)}}&caller_number=&page_size=&q=q">{{$value->total_calls}}</a></td>
                                    <td><input  class="btn btn-block btn-default" type="button" 
                                    value="{{$value->before_ANC_hrs}}"></td>
                                    <td><input  class="btn btn-block btn-default" type="button" 
                                    value="{{$value->after_PNC_hrs}}"></td>
                                    <td><input  class="btn btn-block btn-default" type="button" 
                                    value="{{$value->ANC_calls}}"></td>
                                    <td><input  class="btn btn-block btn-default" type="button" 
                                    value="{{$value->PNC_calls}}"></td>
                                </tr>
                               
                                @endforeach
                                 
                            </tbody>
                        </table>
                    </div>
                    
                </div>  
                  <div class="card-footer">
                     {{ $cdr_arry->appends(request()->query())->links() }}
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
  <script type="text/javascript">
   $("#cdr_table td input").each(function(){
        if ($(this).val()== 0) {
            $(this).removeClass( "btn btn-default" ).addClass( "btn btn-block btn-default disabled" );
;
        }
});
  </script>
  <script src="{{asset('assets/js/daterange_picker.js')}}"></script>
@endsection