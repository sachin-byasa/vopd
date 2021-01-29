<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use App\Models\MenuChild;
use App\Models\GroupMenuItem;
class GroupMenuController extends Controller
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
        $group_id = $request->group_id;
        $groups = DB::table('group_master')->select('group_id','group_name')->get();
        $menus = array();
        if(!empty($group_id)){
            
            $menus = MenuChild::from('menu_child as mc')
                                ->leftJoin('menu_master as mm','mm.menu_id', 'mc.menu_id')
                                ->orderBy('mm.serial_order', 'ASC')
                                ->orderBy('mc.serial_order', 'ASC')
                                ->where('mc.isactive',1)
                                ->get();
                                
            $group_menu_items = GroupMenuItem::where('group_id', $request->group_id)->get();
            foreach($menus as $key => $value){
                foreach($group_menu_items as $gmi){
                    if($gmi->menuchild_id == $value->menuchild_id){ $menus[$key]->gmi_status = $gmi->isactive; }
                }
            }
            // return $menus->toArray();
        }
                
        return view('groupmenu.index', compact('groups', 'menus', 'group_id'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        // $group_id = $request->group_id;
        // $groups = DB::table('group_master')->select('group_id','group_name')->get();
        // $group_menu_items = GroupMenuItem::where('group_id', $group_id)->get();
        // $menu = MenuChild::where('isactive', '1');

        // return view('groupmenu.create', compact('groups', 'menu', 'group_id', 'group_menu_items'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

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
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        foreach($request->input('group') as $key => $value){

            if( $value['insert']  != '0' && $value['update'] != '0' && $value['delete'] != '0' && $value['view'] != '0' && $value['download'] != '0' ){
                $group_menu = GroupMenuItem::firstOrNew([ 'menuchild_id' => $key, 'group_id' => $request->group_id ]);
                $group_menu->group_id = $request->group_id;
                $group_menu->menuchild_id = $key;
                $group_menu->isactive = 1;
                $group_menu->user_id = $request->user()->id;
                $group_menu->save();
            }
            else{
                GroupMenuItem::where(['menuchild_id' => $key, 'group_id' => $request->group_id])->update([ 'isactive' => 0 ]);
            }
        }
        
        return back()->withSuccess('Successfull');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
