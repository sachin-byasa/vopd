<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserGroup extends Model
{
    protected $table = 'user_in_group';
    protected $primaryKey = 'user_group_id';
    const CREATED_AT = 'entry_date';
    const UPDATED_AT = 'updated_date';
    protected $fillable = ['group_id', 'user_id', 'isactive', 'entry_by', 'entry_date'];
    // protected $hidden = ['entry_by', 'updated_by', 'updated_date'];
}
