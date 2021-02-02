@extends('layout.master')
@section('title', 'Group Menu')
@section('content')


<div class="container-fluid mt-3">

<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body border border-dark">
            <form class="form-row mt-4 mb-2" method="get" action="{{ route('group-menu.index') }}">
                <div class="col-lg-2 col-md-12 mb-2">
                <select class="form-control input-default @error('group_id') is-invalid @enderror" name="group_id" required>
                <option selected disabled value="">Group</option>
                    @forelse($groups as $group)
                   <!--  <option @if($group->group_id == old('group_id')) selected @endif  value="{{$group->group_id}}">{{$group->group_name}}</option> -->
                     <option value="{{$group->group_id}}" @if ($group_id ==$group->group_id ) selected @endif >{{$group->group_name}}</option>
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
                            <a href="{{ route('group-menu.index', Request::get('group_id'))}}"> <button type="button" class="btn btn-danger mb-2">Reset</button></a>
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

      @if(!empty($menus))
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
                                                <th>Menu Child Name</th>
                                                <th>Allow Insert</th>
                                                <th>Update</th>
                                                <th>Delete</th>
                                                <th>View</th>
                                                <th>Download</th>
                                                <th>Select All</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse($menus as $menu)
                                                <tr>
                                                    <td>{{$menu->menu_name}}</td>
                                                    <td>{{$menu->child_name}}</td>
                                                    <input type="hidden" name="group[{{$menu->menuchild_id}}][insert]" value="0">
                                                    <input type="hidden" name="group[{{$menu->menuchild_id}}][update]" value="0" >
                                                    <input type="hidden" name="group[{{$menu->menuchild_id}}][delete]" value="0" >
                                                    <input type="hidden" name="group[{{$menu->menuchild_id}}][view]" value="0" >
                                                    <input type="hidden" name="group[{{$menu->menuchild_id}}][download]" value="0" >
                                                    <input type="hidden" name="group[{{$menu->menuchild_id}}][select_all]" value="0" >
                                                    
                                                    
                                                    <td><input type="checkbox" id="group_insert_{{$menu->menuchild_id}}" name="group[{{$menu->menuchild_id}}][insert]" @if(isset($menu->gmi_status) && $menu->gmi_status == 1) checked @endif></td>
                                                    <td><input type="checkbox" id="group_update_{{$menu->menuchild_id}}" name="group[{{$menu->menuchild_id}}][update]" @if(isset($menu->gmi_status) && $menu->gmi_status == 1) checked @endif></td>
                                                    <td><input type="checkbox" id="group_delete_{{$menu->menuchild_id}}" name="group[{{$menu->menuchild_id}}][delete]" @if(isset($menu->gmi_status) && $menu->gmi_status == 1) checked @endif></td>
                                                    <td><input type="checkbox" id="group_view_{{$menu->menuchild_id}}" name="group[{{$menu->menuchild_id}}][view]" @if(isset($menu->gmi_status) && $menu->gmi_status == 1) checked @endif></td>
                                                    <td><input type="checkbox" id="group_download_{{$menu->menuchild_id}}" name="group[{{$menu->menuchild_id}}][download]" @if(isset($menu->gmi_status) && $menu->gmi_status == 1) checked @endif></td>
                                                    <td><input type="checkbox" id="group_select_all_{{$menu->menuchild_id}}" name="group[{{$menu->menuchild_id}}][select_all]" onclick="toggle({{$menu->menuchild_id}})" @if(isset($menu->gmi_status) && $menu->gmi_status == 1) checked @endif    ></td>

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
                                                <th>Menu Child Name</th>
                                                <th>Allow Insert</th>
                                                <th>Update</th>
                                                <th>Delete</th>
                                                <th>View</th>
                                                <th>Download</th>
                                                <th>Select All</th>
                                            </tr>
                                        </tfoot>
                                    </table>

                                    <div class="modal-footer">
                                        <button type="submit" class="btn btn-primary">Update</button>
                                        <a href="{{ route('group-menu.index',Request::get('group_id'))}}"><button type="button" class="btn btn-danger" data-dismiss="modal">Reset</button>
                                    </div>
                                    {{Form::hidden('group_id', Request::get('group_id'))}}
                                </form>

                                    <script>
                                        function toggle(id) {
                                            checkboxes = document.getElementById('group_insert_'+id).checked = document.getElementById('group_select_all_'+id).checked;
                                            checkboxes = document.getElementById('group_update_'+id).checked = document.getElementById('group_select_all_'+id).checked;
                                            checkboxes = document.getElementById('group_delete_'+id).checked = document.getElementById('group_select_all_'+id).checked;
                                            checkboxes = document.getElementById('group_view_'+id).checked = document.getElementById('group_select_all_'+id).checked;
                                            checkboxes = document.getElementById('group_download_'+id).checked = document.getElementById('group_select_all_'+id).checked;
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