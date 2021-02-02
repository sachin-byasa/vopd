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

                <form class="form-row mt-4 mb-4" method="post" action="{{ route('group-master.group.update', $group->group_id) }}">
                    @csrf
                    <div class="modal-body">
                    <div class="form-row">

                    <div class="col-lg-3 col-md-12 mb-2">
                        <label for="application_id">Application Name :</label>
                        <select class="form-control input-default @error('application_id') is-invalid @enderror" name="application_id" required>

                        <option selected disabled value="">Application Name</option>
                        @forelse($applications as $app)
                        <option @if($app->application_id == $group->application_id) selected @endif  value="{{$app->application_id}}">{{$app->application_name}}</option>
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

                    
                    <div class="col-lg-3 col-md-12 mb-2">
                        <label for="name">Group Name</label>
                        <input type="text" class="form-control input-default @error('group_name') is-invalid @enderror" id="group-name" name="group_name" value="{{$group->group_name}}"  required>

                        @error('group_name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="col-lg-3 col-md-12 mb-2">
                        <label for="isactive">Status</label>
                        <select class="form-control input-default" id="isactive" name="isactive" required>
                            <option selected disabled value="">Choose...</option>
                            <option @if($group->isactive == 1) selected @endif value="1">Active</option>
                            <option @if($group->isactive == 0) selected @endif value="0">Inactive</option>
                        </select>
                    </div>
                </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Update</button>
                        <button type="reset" class="btn btn-primary">Reset</button>
                        <a href ="{{ url('/admin/group-master') }}"><button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button></a>
                                    </div>
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