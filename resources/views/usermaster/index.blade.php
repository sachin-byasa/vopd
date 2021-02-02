@extends('layout.master')
@section('title', 'User Management')

@section('content')

<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">

            <div class="card">

                <div class="card-body">
                    @include('layouts.alerts')
                    <div class="basic-form">
                        <form method="post" action="{{ route('user-master.index') }}">
                        @csrf
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="state">User Name : </label>
                                        <input class="form-control" name="user_name"  value="{{Request::get('user_name')}}"  placeholder="User Name">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="state"> Email: </label>
                                        <input class="form-control" name="email_id"  value="{{Request::get('email_id')}}"  placeholder="Email">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="state"> Mobile Number: </label>
                                        <input class="form-control" name="mobile_number"  value="{{Request::get('mobile_number')}}"  placeholder="Mobile Number">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="state">Status : </label>
                                        <select class="form-control input-default" name="isactive">
                                            <option selected value="">Status</option>
                                            <option  @if(Request::get('isactive') == '1') selected @endif value="1">Active</option>
                                            <option  @if(Request::get('isactive') == '0') selected @endif value="0">Inactive</option>
                                        </select>
                                    </div>
                                </div>
                            </div>


                            <div class=" button-group mt-3">
                                <div class="btn-group">
                                    <div class="form-group mx-sm-1 mb-2">
                                        <button type="submit" class="btn btn-primary mb-2">Search</button>
                                    </div>
                                    <div class="form-group mx-sm-1 mb-2">
                                        <a href="{{ url()->current()}}"> <button type="button" class="btn btn-danger mb-2">Reset</button></a>
                                    </div>
                                    <div class="form-group mx-sm-1 mb-2">
                                    <a href="{{ route('user-master.create') }}"><button type="button" class="btn mb-1 btn-primary">  Add User </button></a>
                                    </div>
                                    <div class="form-group mx-sm-1 mb-2">
                                        <a href="{{ route('user-master.index') }}"> <button type="button" class="btn btn-warning mb-2">Export to csv</button></a>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


@if(!empty($usermaster))
<div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div class="active-member">
                        <div class="table-responsive">
                            <table id="user_master" class="table table-striped table-bordered zero-configuration">
                                <thead>
                                    <tr>
                                    <th>#</th>
                                    <th>User Name</th>
                                    <th>Login Name</th>
                                    <th>Email</th>
                                    <th>Phone Nuber</th>
                                    <th>Type</th>
                                    <th>Group</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php $cnt = 1 ?>
                                @forelse($usermaster as $user)
                                    <tr>
                                        <td>{{$cnt++}}</td>
                                        <td>{{$user->user_name}}</td>
                                        <td>{{$user->login_id}}</td>
                                        <td>{{$user->email_id}}</td>
                                        <td>{{$user->mobile_number}}</td>
                                        <td>{{$user->user_description}}</td>
                                        <td>{{$user->group_name}}</td>
                                        @if ($user->isactive == 1)
                                        <td><span class="badge badge-primary px-2">Active</span></td>
                                        @else
                                        <td><span class="badge badge-danger px-2">Inactive</span></td>
                                        @endif

                                        <td class="center" style="width: 120px;">

                                        <a href="{{ route('user-master.edit', $user->user_id) }}">
                                            <i class="fa fa-pencil-square-o" style="font-size: 18px;line-height: 1.5;"></i>
                                        </a> |
                                        @if($user->isactive == 1)
                                        <a href="{{ route('user-master.disable', $user->user_id) }}" >
                                             <i class="fa fa-trash" style="font-size: 18px;line-height: 1.5;"></i>
                                        </a>
                                        @else
                                        <a href="{{ route('sub-centre.enable', $user->user_id) }}" >
                                             <i class="fa fa-recycle" style="font-size: 18px;line-height: 1.5;"></i> 
                                        </a>
                                        @endif
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="100" class="text-center">No record found</td>
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
@endif


@stop

@section('script')
<script> $('#user_master').DataTable(); </script>
@endsection