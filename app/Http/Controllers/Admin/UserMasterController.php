<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\UserMaster;
use App\Models\UserType;
use App\Models\UserGroup;
use App\Models\GroupMaster;
use Carbon\Carbon;
use Auth;

class UserMasterController extends Controller
{

    public function __construct()
    {
        $this->middleware('user.control');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if($request->has('user_name') && !empty($request->user_name) || $request->has('email_id') && !empty($request->email_id)  || $request->has('mobile_number') && !empty($request->mobile_number)  || $request->has('isactive') && $request->isactive != null ){
            $usermaster = UserMaster::from('user_master as um')
            ->leftJoin('user_types as ut', 'ut.user_type', 'um.user_type')
            ->leftJoin('user_in_group as uig', 'um.user_id','uig.user_id')
            ->leftJoin('group_master as gm', 'gm.group_id', 'uig.group_id')
            ->where(function ($query) use ($request) {
                if(!empty($request->user_name)){
                    $query->where('um.user_name', 'like', '%' . $request->user_name . '%');
                }
                if(!empty($request->email_id)){
                    $query->where('um.email_id', 'like', '%' .$request->email_id . '%');
                }
                if(!empty($request->mobile_number)){
                    $query->where('um.mobile_number', 'like', '%' . $request->mobile_number . '%');
                }
                if($request->isactive != null){
                    $query->where('um.isactive', 'like', '%' . $request->isactive . '%');
                }
            })
            ->select('um.user_id', 'um.user_name', 'um.login_id', 'um.email_id', 'um.mobile_number', 'um.isactive', 'ut.user_description', 'gm.group_name')
            ->get();
        }
        else if($request->has('user_name') && empty($request->user_name) || $request->has('email_id') && empty($request->email_id)  || $request->has('mobile_number') && empty($request->mobile_number)  || $request->has('isactive') && empty($request->isactive)){
            $usermaster = UserMaster::from('user_master as um')
                                ->leftJoin('user_types as ut', 'ut.user_type', 'um.user_type')
                                ->leftJoin('user_in_group as uig', 'um.user_id','uig.user_id')
                                ->leftJoin('group_master as gm', 'gm.group_id', 'uig.group_id')
                                ->select('um.user_id', 'um.user_name', 'um.login_id', 'um.email_id', 'um.mobile_number', 'um.isactive', 'ut.user_description', 'gm.group_name')
                                ->get();
        }
        else{
            $usermaster = array();
        }
        $userTypes = UserType::where('isactive',1)->get();
        $GroupMasters = GroupMaster::where('isactive',1)->get();
        return view('usermaster.index', ['usermaster' => $usermaster, 'userTypes' => $userTypes, 'GroupMasters' => $GroupMasters, 'request' => $request]);
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $userTypes = UserType::where('isactive',1)->get();
        $GroupMasters = GroupMaster::where('isactive',1)->get();
        return view('usermaster.create', compact('userTypes', 'GroupMasters'));   
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validation = $request->validate([
            'user_name' => ['required', 'string', 'max:255'],
            'login_id' => ['required', 'string', 'max:50', 'unique:user_master'],
            'email_id' => ['required', 'string', 'email', 'max:255', 'unique:user_master'],
            'mobile_number' => ['required', 'string', 'min:10', 'max:10', 'unique:user_master'],
            'user_key' => ['required', 'string', 'min:4', 'max:100', 'confirmed'],
            'user_type' => ['required', 'integer', 'min:1'],
            'isactive' => ['required', 'integer'],
            'user_group' => ['required', 'integer'],
        ]);
                        
        if(!$validation){ return redirect()->back()->withInput($request->all())->withErrors($validation); }
                        
        $id = UserMaster::insertGetId([
                'user_name' => trim($request->user_name),
                'login_id' => trim($request->login_id),
                'email_id' => trim($request->email_id),
                'mobile_number' => trim($request->mobile_number),
                'user_key' => \Hash::make(trim($request->user_key)),
                'user_type' => trim($request->user_type),
                'isactive' => trim($request->isactive),
                'entry_date' => Carbon::now()->toDateTimeString(),
                'entry_by' => Auth::user()->user_id,
        ]);

        $response = UserGroup::create([
            'group_id' => trim($request->user_group),
            'user_id' => $id,
            'isactive' => trim($request->isactive),
            'entry_by' => Auth::user()->user_id,
            'entry_date' => Carbon::now()->toDateTimeString(),
        ]);

       return ($response)? back()->with(['message' => 'User Created', 'type' => 'success']) : back()->with(['message' => 'something went wrong please try again later', 'type' => 'error']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = $usermaster = UserMaster::from('user_master as um')
                    ->leftJoin('user_types as ut', 'ut.user_type', 'um.user_type')
                    ->leftJoin('user_in_group as uig', 'um.user_id','uig.user_id')
                    ->leftJoin('group_master as gm', 'gm.group_id', 'uig.group_id')
                    ->select('um.user_id', 'um.user_name', 'um.login_id', 'um.email_id', 'um.mobile_number', 'um.isactive', 'um.user_type', 'ut.user_description', 'gm.group_name', 'uig.group_id')
                    ->where('um.user_id' , $id)
                    ->first();
                    
        $userTypes = UserType::where('isactive',1)->get();
        $GroupMasters = GroupMaster::where('isactive',1)->get();

        return view('usermaster.edit', ['user' => $user, 'page' => 'edit', 'userTypes' => $userTypes, 'GroupMasters' => $GroupMasters]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $user = $request->all();
        $validation = $request->validate([
            'user_name' => ['required', 'string', 'max:255'],
            'login_id' => ['required', 'string', 'max:50', 'unique:user_master,login_id,'.$id.',user_id'],
            'email_id' => ['required', 'string', 'email', 'max:255', 'unique:user_master,email_id,'.$id.',user_id'],
            'mobile_number' => ['required', 'string', 'min:10', 'max:10', 'unique:user_master,mobile_number,'.$id.',user_id'],
            'user_type' => ['required', 'integer', 'min:1'],
            'isactive' => ['required', 'integer'],
            'user_group' => ['required', 'integer', 'alpha_dash'],
        ]);

        if(!$validation){ return redirect()->back()->withInput($request->all())->withErrors($validation); }

        $response_user_master = UserMaster::find($id)->update([
            'user_name' => trim($request->user_name),
            'login_id' => trim($request->login_id),
            'email_id' => trim($request->email_id),
            'mobile_number' => trim($request->mobile_number),
            'user_key' => \Hash::make(trim($request->user_key)),
            'user_type' => trim($request->user_type),
            'isactive' => trim($request->isactive),
            'updated_date' => Carbon::now()->toDateTimeString(),
            'updated_by' => Auth::user()->user_id,
        ]);
        $response = UserGroup::where('user_id',$id)->update([
                'group_id' => trim($request->user_group),
                'updated_by' => Auth::user()->user_id,
                'updated_date' => Carbon::now()->toDateTimeString(),
            ]);
        
        if($response){
            return back()->with(['message' => 'user data updated', 'type' => 'success']);
        }
        else{
            return back()->with(['message' => 'something went wrong please try again later', 'type' => 'success']);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function disable($id)
    {
        $disable_response = UserMaster::find($id)->update([
            'isactive' => 0,
            'updated_by' => \Auth::user()->user_id,
            'updated_date' => \Carbon\Carbon::now()->toDateTimeString(),
        ]);

        if($disable_response){
            return back()->with('success', 'User inactivated');
        }
        else{
            return back()->with('error', 'something went wrong! please try again later.');
        }
    }
   
    public function enable($id)
    {
        $enable_response = UserMaster::find($id)->update([
            'isactive' => 1,
            'updated_by' => \Auth::user()->user_id,
            'updated_date' => \Carbon\Carbon::now()->toDateTimeString(),
        ]);

        if($enable_response){
            return back()->with('success', 'User activated');
        }
        else{
            return back()->with('error', 'something went wrong! please try again later.');
        }
    }

    public function export()
    {
        return Excel::download(new UserExport, 'users_'.\Carbon\Carbon::now()->format('d-m-Y-h.m.s').'.csv');
    }
}
