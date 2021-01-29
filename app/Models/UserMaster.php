<?php

namespace App\Models;

use 
Illuminate\Foundation\Auth\User as Authenticatable,
Illuminate\Notifications\Notifiable,
App\Models\MenuMaster;


class UserMaster extends Authenticatable
{
    use  Notifiable;
    use Notifiable;

    protected $table = 'user_master';
    const CREATED_AT = 'entry_date';
    const UPDATED_AT = 'updated_date';
    protected $primaryKey = 'user_id'; 
    protected $guard = 'vopd';
    // protected $hidden = ['entry_by', 'updated_by', 'updated_date'];

    protected $fillable = [
        'user_name',
        'login_id',
        'email_id',
        'mobile_number',
        'user_key',
        'user_type',
        'arogya_sakhi_id',
        'funder_id',
        'isactive',
        'entry_by',
        'entry_date',
        'updated_by',
        'updated_date',
    ];

    protected $hidden = [
        'user_key'
    ];

    public function userType()
    {
        return $this->hasOne('App\Models\UserType','user_type');
    }

    public function userGroup()
    {
        return $this->belongsToMany('App\Models\GroupMaster', 'user_in_group', 'user_id', 'group_id')->select('group_master.group_id', 'group_master.group_name', 'group_master.isactive');
    }

    public function getMenu()
    {
        $group = \Auth::guard('vopd')->user()->userGroup[0]->group_id; 
        // return MenuMaster::find(1)->with('menuChild')->get();

    }
    
    public static function isAllowedController()
    {
        $user = \Auth::guard('vopd')->user()->with('userGroup')->first()->toArray();
        if(isset($user['user_group'][0]['isactive']) && $user['user_group'][0]['isactive'] == 0){
            return false;
        }
        
        $group = $user['user_group'][0]['group_id'];
        $menu = \DB::table('group_menu_items as gmi')
        ->join('menu_child as mc','gmi.menuchild_id','mc.menuchild_id', 'left outer')
        ->where('mc.controllername', class_basename(\Route::current()->controller))
        ->where('gmi.group_id', $group)
        ->where('mc.isactive', 1)
        ->where('gmi.isactive', 1)
        ->get();
        if($menu->isNotEmpty()){
            \Session::put('active_page_controller',$menu[0]->controllername);
            \Session::put('active_page_menu_master',$menu[0]->menu_id);
        }
        return $menu->isNotEmpty(); 
    }

    public static function check()
    {
        return ! is_null($this->user());
    }

    public function username()
    {
        return 'email_id';
    }   
    
    public function getAuthPassword()
    {
        return $this->user_key;
    } 
    
    public function getIdAttribute()
    {
        return $this->user_id;
    }
    public function getNameAttribute($value)
    {
        return $this->user_name; 
    }
    
    public function getEmailAttribute($value)
    {
        return $this->email_id; 
    }
 
    public function getPasswordAttribute($value)
    {
        return $this->user_key; 
    }

    public function getEmailForPasswordReset()
    {
        return $this->email_id;
    }

}
