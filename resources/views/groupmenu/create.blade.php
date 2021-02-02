@extends('layout.master')
@section('title', 'Group Menu')
@section('content')


<div class="container-fluid mt-3">

<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
            <form class="form-row mt-4 mb-2" method="get" action="{{ route('group-menu.create') }}">
                <div class="col-lg-2 col-md-12 mb-2">
                <select class="form-control input-default @error('group_id') is-invalid @enderror" name="group_id" required>
                <option selected disabled value="">Group</option>
                    @forelse($groups as $group)
                   <!--  <option @if($group->group_id == old('group_id')) selected @endif  value="{{$group->group_id}}">{{$group->group_name}}</option> -->
                     <option value="{{$group->group_id}}" @if (Request::get('group_id')==$group->group_id ) selected @endif >{{$group->group_name}}</option>
                    @empty
                    <option value="">no Role Available</option>
                    @endforelse
                </select>
                </div>
            

                <div class="ol-lg-2 col-md-12 mb-2">
                    <div class="btn-group">
                        <div class="form-group mx-sm-1 mb-2">
                            <button type="submit" class="btn btn-primary mb-2" >Search</button>
                        </div>
                        <div class="form-group mx-sm-1 mb-2">
                            <a href="{{ url()->current()}}"> <button type="button" class="btn btn-danger mb-2">Reset</button></a>
                        </div>
                        
                        <!-- <div class="form-group mx-sm-1 mb-2">
                            <a href="{{ route('group-menu.export')}}"> <button type="button" class="btn btn-warning mb-2">Export to csv</button></a>
                        </div> -->
                    </div>
                </div>

                <!-- <div class="col-lg-2 col-md-12 mb-2">
                    <button type="submit" class="btn btn-primary"><i class="fa fa-search"> Search</i></button>
                </div> -->
            </form>
      <hr>

      @if(!empty($menu))
      <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div class="active-member">
                       
                    <div class="table-responsive">
                        <form method="post" action="{{ route('group-menu.update') }}">
                        @csrf
                                    <table class="table table-striped table-bordered zero-configuration">
                                        <thead>
                                            <tr>
                                                <th>Menu</th>
                                                <th>Menu Child</th>
                                                <th>Allowed <input type="checkbox" id="menu_select_all" name="select_all" onclick="toggle()"></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse($menu as $m)
                                                <tr>
                                                    <td>{{$m->menu_name}}</td>
                                                    <td>{{$m->child_name}}</td>
                                                    <input type="hidden" name="menuchild[{{$m->menuchild_id}}]" value="0">
                                                    <td><input type="checkbox" id="menuchild" name="menuchild[{{$m->menuchild_id}}]" @if($m->isactive) checked @endif></td>
                                                   

                                                </tr>
                                            @empty
                                                <tr>
                                                    <td colspan="100"class="text-center">No record found</td>
                                                <tr>
                                            @endforelse
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                            <th>Menu</th>
                                                <th>Menu Child</th>
                                                <th>Allowed <input type="checkbox" id="menu_select_all" name="select_all" onclick="toggle()"></th>
                                            </tr>
                                        </tfoot>
                                    </table>

                                    <div class="modal-footer">
                                        <button type="submit" class="btn btn-primary">Update</button>
                                        <a href="{{ route('group-menu.index', $group_id)}}"><button type="button" class="btn btn-danger" data-dismiss="modal">Reset</button>
                                        <a href="{{ route('group-menu.create', $group_id)}}"><button type="button" class="btn btn-success" data-dismiss="modal">Add Menu to this Group</button></a>    
                                    </div>
                                    {{Form::hidden('group_id', $group_id)}}
                                </form>

                                    <script>
                                        function toggle() {
                                            checkboxes = document.getElementsById('menuchild');
                                            for(var i=0, n=checkboxes.length;i<n;i++) {
                                                checkboxes[i].checked = source.checked;
                                            }
                                        }

                                    </script>
                                </div>
                            </div>

                    </div>
                </div>
            </div>                        
        </div>
    </div>
@endif
@stop