<?php

namespace App\Library;

use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\UserMaster;
use App\Models\UserType;
use App\Models\UserGroup;
use App\Models\GroupMaster;
use DB;
use Str;


class CommonUtils extends Controller
{

    public function getSlug($controller_name)
    {
        return str_replace("-controller", '', Str::kebab($controller_name));
        // return Str::of($menu_child_name)->slug('-');
    }
    

    // public function getController($menumaster = array())
    // {
    //     return $slug->singular()->camel()->ucfirst()->finish('Controller');  
    // }

    public function getMenuChild()
    {
        return DB::table('menu_child')->get();
    }

}
