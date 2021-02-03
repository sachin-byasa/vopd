<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Hash;
use Auth;
use App\Constants;
use App\Utils;
use DB;
use Log;

class DashboardController extends Controller
{
     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
   public function __construct()
    {
        $this->middleware('user.control');
    }
    public function index(Request $request)
    {
        $date_arr=[];
        $date_arr=explode('-', $request->date_range);
        $data['total_calls']=0;
        $data['ANC_calls']=0;
        $data['PNC_calls']=0;
        $data['before_ANC_hrs']=0;
        $data['after_PNC_hrs']=0;
     
        if(count($date_arr)>0)
        {

            $utils=new Utils();
            if($date_arr[0]==""){
                    $date_arr[0]=date('m/d/Y');
                    $date_arr[1]=date('m/d/Y');
            }
            log::info($date_arr[0]);
            $start_date=str_replace(' ', '', $utils->date_format($date_arr[0]));
            $end_date=str_replace(' ', '', $utils->date_format($date_arr[1]));
            $results=DB::select("call sp_get_cdr_summary_report('$start_date','$end_date')");
           
            if(count($results)>0){

                foreach ($results as $value) {
                    
                    $data['total_calls']=$data['total_calls']+$value->total_calls;
                    $data['ANC_calls']=$data['ANC_calls']+$value->ANC_calls;
                    $data['PNC_calls']=$data['PNC_calls']+$value->PNC_calls;
                    $data['before_ANC_hrs']=$data['before_ANC_hrs']+$value->before_ANC_hrs;
                    $data['after_PNC_hrs']=$data['after_PNC_hrs']+$value->after_PNC_hrs;
                }
            }
            return view('dashboard.index',$data);
        }
        return view('dashboard.index',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
    public function update(Request $request, $id)
    {
        //
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
