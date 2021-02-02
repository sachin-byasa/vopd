@extends('layout.master')
@section('title', 'Group Management')
@section('content')

<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">

            <div class="card">

                <div class="card-body">
                    @include('layouts.alerts')
                    {{-- <h4 class="card-title">Inline Form</h4> --}}
                    <div class="basic-form">
                        <form action="{{ route('phc.index') }}" method="get">
                            <div class="row">
                       {{--         <!-- <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="state">PHC Name : </label>
                                        <input class="form-control" name="phc_name"  value="{{Request::get('phc_name')}}"  placeholder="PHC Name">
                                    </div>
                                </div> -->
                                
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="state">Select Block : </label>
                                        <select class="form-control" name="block_id">
                                            <option selected value="">Select Block</option>
                                            @forelse($blocks as $block)
                                            <option  @if($block->block_id == Request::get('block_id')) selected @endif value="{{$block->block_id}}">{{$block->block_name}}</option>
                                            @empty
                                            <option selected value="">No blocks available</option>
                                            @endforelse
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="state">Status : </label>
                                        <select class="form-control input-default" name="isactive">
                                            <option selected value="">Status</option>
                                            <option  @if(Request::get('isactive') == '1') selected @endif value="1">Active</option>
                                            <option  @if(Request::get('isactive') == '0') selected @endif value="0">Inactive</option>
                                        </select>
                                    </div>
                                </div>
                                --}}
                            </div>


                            <div class=" button-group mt-3">
                                <div class="btn-group">
                                    <div class="form-group mx-sm-1 mb-2">
                                    <a href="{{ route('group-master.group.create') }}"><button type="button" class="btn mb-1 btn-primary">Add Group </button></a>
                                    </div>
                                 {{--   <div class="form-group mx-sm-1 mb-2">
                                        <button type="submit" name="submit" class="btn btn-primary mb-2">Search</button>
                                    </div>
                                    <div class="form-group mx-sm-1 mb-2">
                                        <a href="{{ url()->current()}}"> <button type="button" class="btn btn-danger mb-2">Reset</button></a>
                                    </div>
                                    <div class="form-group mx-sm-1 mb-2">
                                        <a href="{{ route('phc.export') }}"> <button type="button" class="btn btn-warning mb-2">Export to csv</button></a>
                                    </div>
                                    --}}
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<div class="container-fluid mt-3">
<div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div class="active-member">
                        <div class="table-responsive">
                            <table id="group_master" class="table table-striped table-bordered zero-configuration mb-0">
                                <thead>
                                    <tr>
                                    <th>#</th>
                                    <th>Application Name</th>
                                    <th>group Name</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php $cnt = 1 ?>
                                @forelse($groupmaster as $group)
                                    <tr>
                                        <td>{{$cnt++}}</td>
                                        <td>{{$group->application_name}}</td>
                                        <td>{{$group->group_name}}</td>
                                        <td>@if($group->isactive === 0) <span class="badge badge-danger px-2">Inactive</span>  @else <span class="badge badge-primary px-2">Active</span> @endif</td>
                                        <td><a href="{{ route('group-master.group.edit', $group->group_id) }}">
                                                <i class="fa fa-pencil-square-o" style="font-size: 18px;line-height: 1.5;"></i>
                                            </a> | 
                                            @if($group->isactive == 0)  
                                                <a href="{{ route('group-master.group.enable', $group->group_id) }}"><i class="fas fa-recycle" style="font-size: 18px;line-height: 1.5;"></i></a>
                                            @else 
                                                <a href="{{ route('group-master.group.disable', $group->group_id) }}"><i class="fas fa-trash" style="font-size: 18px;line-height: 1.5;"></i></a> 
                                            @endif
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td width="100">No record found</td>
                                    <tr>
                                @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>                        
        </div>
    </div>
</div>

@stop

@section('script')
<script> $('#group_master').DataTable(); </script>
@endsection