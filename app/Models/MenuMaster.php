<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MenuMaster extends Model
{
    protected $table = 'menu_master';
    protected $primaryKey = 'menu_id';
    // protected $hidden = ['entry_by', 'updated_by', 'updated_date'];
    
    public function menuChild()
    {
        return $this->hasMany('App\Models\MenuChild', 'menu_id', 'menu_id');
    }

    public static function groupMenu()
    {

        $group_menu =  GroupMaster::where('group_id',\Auth::guard('vopd')->user()->userGroup()->first()->group_id)
        ->with('MenuChilds')
        ->leftJoin('menu_master', 'menu_master.menu_id','menu_id')
        ->orderBy('menu_master.serial_order', 'ASC')
        ->orderBy('menu_child.serial_order', 'ASC')
        ->get()->toArray();
        dd($group_menu);

        $menu = array();
        foreach($group_menu as $gm){
            $menu[$gm['menu_name']] = array();
            foreach($gm['menu_childs'] as $mc){
                if($gm['menu_id'] == $mc['menu_id']){
                    array_push($menu[$gm['menu_name']], $mc);
                }
            }
            if(empty($menu[$gm['menu_name']])){
                unset($menu[$gm['menu_name']]);
            }
        }
        return $menu;
    }
    
    public static function activeGroupMenu()
    {

        $group_menu =  GroupMaster::where('group_id',\Auth::guard('vopd')->user()->userGroup()->first()->group_id)
                                ->leftJoin('menu_master', 'menu_master.menu_id','menu_id')
                                ->with('MenuChilds')
                                ->orderBy('menu_master.serial_order', 'ASC')
                                ->get()->toArray();
        $menu = array();
        foreach($group_menu as $gm){
            $menu[$gm['menu_name']] = array();
            foreach($gm['menu_childs'] as $mc){
                if($gm['menu_id'] == $mc['menu_id'] && $mc['isactive'] == 1){
                    array_push($menu[$gm['menu_name']], $mc);
                }
            }
            if(empty($menu[$gm['menu_name']])){
                unset($menu[$gm['menu_name']]);
            }
        }
        return $menu;

    }
    
    
}
