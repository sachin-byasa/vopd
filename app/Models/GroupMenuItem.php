<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GroupMenuItem extends Model
{
    protected $table = 'group_menu_items';
    protected $primaryKey = 'group_menu_id';
    const CREATED_AT = 'entry_date';
    const UPDATED_AT = 'updated_date';
    protected $fillable = ['isactive'];
    
}
