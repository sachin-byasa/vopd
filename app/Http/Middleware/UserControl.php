<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\DB;
use Route;
use Auth;
use App\Models\UserMaster;

class UserControl
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        // if (Auth::guard()->check()) {
        //     $group = \DB::table('user_in_group')->where('user_id', Auth::user()->user_id)->first()->group_id;
        //     $menu = \DB::table('group_menu_items as gmi')
        //     ->join('menu_child as mc','gmi.menuchild_id','mc.menuchild_id', 'left outer')
        //     ->where('controllername', class_basename($request->route()->controller))
        //     ->where('gmi.group_id', $group)
        //     ->get();
        //     if($menu->isEmpty()){
        //         back()->with('error', 'you are not allowed to view page');
        //     }
            
        // $user = \Auth::guard('arogyasakhi')->user()->with('isAllowedController'); 
        $user = UserMaster::isAllowedController(); 
        // dd($user);
        if(!$user){
            // return redirect(route('unauthenticated'));
            // return 'You are not allowed to access this page.';
            return back()->with('error', 'you are not allowed to view page');
        }
        return $next($request);
    }
}
