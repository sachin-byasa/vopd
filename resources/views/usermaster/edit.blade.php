@extends('layout.master')
@section('title', 'User Management')
@section('content')


<div class="container-fluid mt-3">

@if(!empty(session('message')))
    <div class="alert alert-{{session('type')}}  mt-4 mb-4" >{{session('message')}}</div>
  @endif
  

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">

                <form class="form-row mt-4 mb-4" method="post" action="{{ route('user-master.update', $user->user_id) }}">
                    @csrf
                    <div class="modal-body">
                    <div class="form-row">
                    
                    <div class="col-lg-3 col-md-12 mb-2">
                        <label for="name">Name</label>
                        <input type="text" class="form-control input-default @error('user_name') is-invalid @enderror" id="user_name" name="user_name" value="@if(!empty(old('user_name'))){{old('user_name')}}@else{{$user->user_name}}@endif"  required>

                        @error('user_name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="col-lg-3 col-md-12 mb-2">
                        <label for="email">Email</label>
                        <input type="email" class="form-control input-default @error('email_id') is-invalid @enderror" id="email_id" name="email_id" value="@if(!empty(old('email_id'))){{old('email_id')}}@else{{$user->email_id}}@endif" required>

                        @error('email_id')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="col-lg-3 col-md-12 mb-2">
                        <label for="name">Login Name</label>
                        <input type="text" class="form-control input-default @error('login_id') is-invalid @enderror" id="login_id" name="login_id" value="@if(!empty(old('login_id'))){{old('login_id')}}@else{{$user->login_id}}@endif" >

                        @error('login_id')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="col-lg-3 col-md-12 mb-2">
                        <label for="phone">Phone</label>
                        <input type="text" class="form-control input-default @error('mobile_number') is-invalid @enderror" name="mobile_number" id="mobile_number" value="@if(!empty(old('mobile_number'))){{old('mobile_number')}}@else{{$user->mobile_number}}@endif">
                        
                        @error('mobile_number')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="col-lg-3 col-md-12 mb-2">
                        <label for="isactive">Status</label>
                        <select class="form-control input-default input-default @error('user_type') is-invalid @enderror" id="isactive" name="isactive" required >
                            <option selected disabled value="">Choose...</option>
                            <option @if(old('isactive') == null && $user->isactive == '1') selected @else @if(old('isactive') == '1') selected @endif @endif value="1">Active</option>
                            <option @if(old('isactive') == null && $user->isactive == '0') selected @else @if(old('isactive') == '0') selected @endif @endif value="0">Inactive</option>
                        </select>

                        @error('isactive')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="col-lg-3 col-md-12 mb-2">
                        <label for="user_type">User Type :</label>
                        <select class="form-control input-default @error('user_type') is-invalid @enderror" id="user_type" name="user_type" required>

                        <option selected disabled value="">User Type</option>
                        @forelse($userTypes as $userType)
                        <option @if(old('user_type') == null && $user->user_type == $userType->user_type) selected @else @if(old('user_type') == $userType->user_type) selected @endif @endif  value="{{$userType->user_type}}">{{$userType->user_description}}</option>
                        @empty
                        <option value="">no Role Available</option>
                        @endforelse
                        
                        </select>
                        @error('user_type')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="col-lg-3 col-md-12 mb-2">
                        <label for="user_group">Group :</label>
                        <select class="form-control input-default @error('user_group') is-invalid @enderror" id="user_group" name="user_group" required>

                        <option selected disabled value="">Group</option>
                        @forelse($GroupMasters as $gm)
                        <option  @if(old('group_id') == null && $user->group_id == $gm->group_id) selected @else @if(old('group_id') == $gm->group_id) selected @endif @endif  value="{{$gm->group_id}}">{{$gm->group_name}}</option>
                        @empty
                        <option value="">no Role Available</option>
                        @endforelse
                        
                        </select>
                        @error('user_group')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Update</button>
                    <button type="reset" class="btn btn-primary">Reset</button>
                    <a href="{{ url('/admin/user-master') }}"><button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
                </div>
                </form>
                <script>
                // var form_data = [
                //     'user_name' => {{$user->user_name}}
                //     'email_id' => {{$user->email_id}}
                //     'login_id' => {{$user->login_id}}
                //     'mobile_number' => {{$user->mobile_number}}
                //     'isactive' => {{$user->isactive}}
                //     'user_type' => {{$user->user_type}}
                //     'user_group' => {{$user->user_group}}
                // ];
                // function reset(){
                //     foreach(form_data as fd){
                //         document.getelement
                //     }
                // }
                </script>
                <hr>

            </div>
        </div>
        <!-- #/ container -->
    </div>

</div>
</div>


@stop