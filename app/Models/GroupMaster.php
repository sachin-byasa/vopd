<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GroupMaster extends Model
{

    protected $table = 'group_master';
    public $timestamps = false;
    protected $primaryKey = 'group_id'; 
    // protected $hidden = ['entry_by', 'updated_by', 'updated_date'];

    protected $fillable = [
        'group_id',
        'application_id',
        'group_name',
        'isactive',
    ];


    // public function GroupMenuChild()
    // {
    //     return $this->belongsTo('App\Models\MenuChild', 'group_menu_items', 'menuchild_id', 'menuchild_id');
    // }

    public function MenuChilds()
    {
        return $this->belongsToMany(MenuChild::class, 'group_menu_items', 'group_id', 'menuchild_id')
                    ->where('menu_child.isactive', 1)
                    ->where('group_menu_items.isactive', '1')
                    ->orderBy('menu_child.serial_order', 'ASC');
    }
    
    public function groupMenu()
    {
        // return $groupMenuChilds = $this->MenuChilds();
        // $groupMenu = array();
        // foreach($groupMenuChilds)
    }

}
