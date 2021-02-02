@extends('layout.master')
@section('title', 'Group Management')
@section('content')


<div class="container-fluid mt-3">

@if(!empty(session('message')))
    <div class="alert alert-{{session('type')}}  mt-4 mb-4" >{{session('message')}}</div>
  @endif

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">

                <form method="post" action="{{ route('group-master.group.store') }}">
                    @csrf


                    <div class="form-group row">
                            <label class="col-lg-2 col-form-label" for="state">Application :<span class="text-danger">*</span></label>
                            <div class="col-lg-6">
                            <select class="form-control input-default @error('application_id') is-invalid @enderror" name="application_id" required>
                                <option selected disabled value="">Application Name</option>
                                @forelse($applications as $app)
                                <option @if($app->application_id == old('application_id')) selected @endif  value="{{$app->application_id}}">{{$app->application_name}}</option>
                                @empty
                                <option value="">no App Available</option>
                                @endforelse
                            </select>
                            @error('application_id')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-lg-2 col-form-label" for="state">Group Name :<span class="text-danger">*</span></label>
                            <div class="col-lg-6">
                            <input type="text" class="form-control input-default @error('group_name') is-invalid @enderror" id="group-name" name="group_name" value="{{old('group_name')}}"  required>
                            @error('group_name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-lg-2 col-form-label" for="state">Status : <span class="text-danger">*</span></label>
                            <div class="col-lg-6">
                            <select class="form-control input-default" id="isactive" name="isactive" required>
                                <option selected disabled value="">Choose...</option>
                                <option selected value="1">Active</option>
                                <option @if(!empty(old('isactive')) && !old('isactive')) selected @endif value="0">Inactive</option>
                            </select>
                            @error('isactive')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                            </div>
                        </div>
                </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Submit</button>
                        <a href ="{{ url('/admin/group-master') }}"><button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button></a>
                    </div>
                </form>
                <hr>

            </div>
        </div>
        <!-- #/ container -->
    </div>

</div>
</div>


@stop