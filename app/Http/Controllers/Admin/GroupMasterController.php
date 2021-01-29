<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\GroupMaster;

class GroupMasterController extends Controller
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
        $groupmaster = GroupMaster::leftJoin('application_master as am', 'group_master.application_id', 'am.application_id')->get();
        return view('groupmaster.index', ['groupmaster' => $groupmaster, 'request' => $request]);
    }

    public function create()
    {
        $applications = \DB::table('application_master')->get();
        return view('groupmaster.create', ['applications' => $applications]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'application_id' => 'integer|required',
            'group_name' => ['required', 'string', 'max:50', 'unique:group_master'],
            'isactive' => 'integer|required',
        ]);
        $response = GroupMaster::insert([
            'application_id' => $request->application_id,
            'group_name' => $request->group_name,
            'isactive' => $request->isactive,
        ]);
        
        if($response){
            return back()->with(['message' => 'Group Created', 'type' => 'success']);
        }
        else{
            return back()->with(['message' => 'something went wrong please try again later', 'type' => 'success']);
        }
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
        $group = GroupMaster::where('group_id', $id)->leftJoin('application_master as am', 'group_master.application_id', 'am.application_id')->first();
        // return $group->toArray();
        $applications = \DB::table('application_master')->get();
        return view('groupmaster.edit', ['group' => $group,  'applications' => $applications]);
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
        $response = GroupMaster::find($id)->update([
            'application_id' => $request->application_id,
            'group_name' => $request->group_name,
            'isactive' => $request->isactive,
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
    public function destroy($id)
    {
        $response = GroupMaster::find($id)->update([
            'isactive' => 0
        ]);
        if($response){
            return back()->with(['message' => 'group disabled', 'type' => 'success']);
        }
        else{
            return back()->with(['message' => 'something went wrong please try again later', 'type' => 'success']);
        }
    }

    public function activate($id)
    {
        $response = GroupMaster::find($id)->update([
            'isactive' => 1
        ]);
        if($response){
            return back()->with(['message' => 'group enabled', 'type' => 'success']);
        }
        else{
            return back()->with(['message' => 'something went wrong please try again later', 'type' => 'success']);
        }
    }
}
