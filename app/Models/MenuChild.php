<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MenuChild extends Model
{
    protected $table = 'menu_child';
    protected $primaryKey = 'menuchild_id';

    // protected $hidden = ['entry_by', 'updated_by', 'updated_date'];

    public function groups()
    {
        return $this->belongsToMany(GroupMaster::class, 'group_menu_items', 'menuchild_id', 'group_id');
    }

    // public function MenuChildGroup()
    // {
    //     return $this->belongsTo('App\Model\GroupMaster', 'group_menu_items', 'menuchild_id', 'menuchild_id');
    // }
}
