<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Hash;
use DB;
use App\Constants;
use App\Utils;
use App\Exports\CdrExport;
use App\Exports\CallListingExport;
use App\Exports\DoctorExport;
use App\Exports\AgentExport;
use Maatwebsite\Excel\Facades\Excel;
use Auth;
use Log;
class ReportController extends Controller
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
       
        $q =$request->input('q');
        $page = request('page', 1);
        $pageSize =10;
        if($request->page_size!=null)
            $pageSize = $request->page_size;
        $start_date=null;
        $end_date=null;
        $date_arr=explode('-', $request->date_range);
       
        $utils=new Utils();

        if(isset($q)&& !is_null($q)){
           $request->validate([
            "report_type"=>'required',
            "date_range"=>'required'
           ]);
        }
        if(count($date_arr)>0 && $request->report_type==Constants::$SUMMARY_REPORT && (isset($q)&& !is_null($q) ))
        {
            $start_date=str_replace(' ', '', $utils->date_format($date_arr[0]));
            $end_date=str_replace(' ', '', $utils->date_format($date_arr[1]));
            $params = [$start_date,$end_date];
            
            $results=DB::select("call sp_get_cdr_summary_report('$start_date','$end_date')");
           
            if(count($results)>0){

            $offset = ($page * $pageSize) - $pageSize;
            $data1 = array_slice($results, $offset, $pageSize, true);
            $paginator = new \Illuminate\Pagination\LengthAwarePaginator($data1, count($results), $pageSize, $page);
            $paginator->setPath(request('/admin/reports'));
            $paginator->start_date=$start_date;
            $paginator->end_date=$end_date;

           log::info($paginator);
            return view('reports.index', ['cdr_arry' => $paginator]);
        }   
    }
     return view('reports.index',['search' => $q]);
}

    public function doctor_report(Request $request)
    {
        $q =$request->input('q');
        $page = request('page', 1);
        $pageSize =10;
        if($request->page_size!=null)
            $pageSize = $request->page_size;
        $start_date=null;
        $end_date=null;
        $date_arr=explode('-', $request->date_range);
        $results=[];
        $utils=new Utils();

         if(isset($q)&& !is_null($q)){
           $request->validate([
            "date_range"=>'required'
           ]);
       }
        if(count($date_arr)>0 && (isset($q)&& !is_null($q) ))
        {
            $start_date=str_replace(' ', '', $utils->date_format($date_arr[0]));
            $end_date=str_replace(' ', '', $utils->date_format($date_arr[1]));
            $params = [$start_date,$end_date];
            $results = DB::select("call sp_get_doctor_report('$start_date','$end_date')");

            if(count($results)>0){

                $offset = ($page * $pageSize) - $pageSize;
                $data1 = array_slice($results, $offset, $pageSize, true);
                $paginator = new \Illuminate\Pagination\LengthAwarePaginator($data1, count($results), $pageSize, $page);
                $paginator->setPath(request('/admin/reports'));
                $paginator->start_date=$start_date;
                $paginator->end_date=$end_date;
              
                return view('reports.doctor', ['cdr_arry' => $paginator]);
            }   
        }
        return view('reports.doctor',['search' => $q]);
    }

    public function agent_report(Request $request)
    {
    
        $q =$request->input('q');
        $page = request('page', 1);
        $pageSize =10;
        if($request->page_size!=null)
            $pageSize = $request->page_size;
        $start_date=null;
        $end_date=null;
        $date_arr=explode('-', $request->date_range);
        $results=[];
        $utils=new Utils();
        if(isset($q)&& !is_null($q)){
           $request->validate([
            "date_range"=>'required'
           ]);
       }
        if(count($date_arr)>0 && (isset($q)&& !is_null($q) ))
        {
            $start_date=str_replace(' ', '', $utils->date_format($date_arr[0]));
            $end_date=str_replace(' ', '', $utils->date_format($date_arr[1]));
            $params = [$start_date,$end_date];
            $results = DB::select("call sp_get_agent_report('$start_date','$end_date')");//
          
            if(count($results)>0){

                $offset = ($page * $pageSize) - $pageSize;
                $data1 = array_slice($results, $offset, $pageSize, true);
                $paginator = new \Illuminate\Pagination\LengthAwarePaginator($data1, count($results), $pageSize, $page);
                $paginator->setPath(request('/admin/reports'));
                $paginator->start_date=$start_date;
                $paginator->end_date=$end_date;
                return view('reports.agent', ['cdr_arry' => $paginator]);
            }   
        }
        return view('reports.agent',['search' => $q]);
    }

     public function call_listing(Request $request)
    {
    
        $q =$request->input('q');
        $page = request('page', 1);
        $pageSize =10;
        if($request->page_size!=null)
            $pageSize = $request->page_size;
        $start_date=null;
        $end_date=null;
        $date_arr=str_replace(" ","",explode('-', $request->date_range));
        $results=[];
        $utils=new Utils();
        if(isset($q)&& !is_null($q)){
           $request->validate([
             "date_range"=>'required'
           ]);
        }
        if(count($date_arr)>0 && (isset($q)&& !is_null($q) ))
        {
            if($request->caller_number==null)
                $request->caller_number="";

            $start_end_time_arr=$this->get_start_end_time($q);
       
            $start_date= $utils->date_format($date_arr[0])." ".$start_end_time_arr['start_time'];
          
            $end_date=$utils->date_format($date_arr[1])." ".$start_end_time_arr['end_time'];


            $results =  DB::select("call sp_get_call_listing_report('$start_date','$end_date','$request->caller_number')");

           if(in_array($q,['agent_total','agent_missed','agent_answered','doctor_missed','doctor_answered','doctor_total'])){

                $results=$this->call_filter_results($q,$request->phone_number,$results);
               
           }


        }
           
            if(count($results)>0){

                $offset = ($page * $pageSize) - $pageSize;
                $data1 = array_slice($results, $offset, $pageSize, true);
                $paginator = new \Illuminate\Pagination\LengthAwarePaginator($data1, count($results), $pageSize, $page);
                $paginator->setPath(request('/admin/reports'));
                $paginator->start_date=$start_date;
                $paginator->end_date=$end_date;
                $paginator->caller_number= $request->caller_number;
                $paginator->q=$q;
                $paginator->phone_number="all";
                if($request->phone_number)
                   $paginator->phone_number=$request->phone_number;
                if($paginator->caller_number=="")//if user does not enter caller number 
                        $paginator->caller_number="all";

                //dd($paginator);
                return view('reports.call_listing', ['cdr_arry' => $paginator]);
            }   
        
        return view('reports.call_listing',['search' => $q]);
    }

    public function call_listing_export(Request $request,$start_date,$end_date,$caller_number,$q,$phone_number)
    {
        # code...
      
        $utils=new Utils();
        if($caller_number=="all")
            $caller_number="";
         
         $results =  DB::select("call sp_get_call_listing_report('$start_date','$end_date','$caller_number')");

          if(in_array($q,['agent_total','agent_missed','agent_answered','doctor_missed','doctor_answered','doctor_total'])){

               
                $results=$this->call_filter_results($q,$request->phone_number,$results);
               
           }

        if(count($results)>0){
            return Excel::download(new CallListingExport($results), 'call_listing.csv');
        }
    }
     public function doctor_export(Request $request,$start_date,$end_date)
    {
        # code...
        $utils=new Utils();
      
        $results = DB::select("call sp_get_doctor_report('$start_date','$end_date')");
        if(count($results)>0){
            return Excel::download(new DoctorExport($results), 'doctor_performance_report.csv');
        }
    }
     public function agent_export(Request $request,$start_date,$end_date)
    {
        # code...
        $utils=new Utils();
        $results =  DB::select("call sp_get_agent_report('$start_date','$end_date')");
        if(count($results)>0){
            return Excel::download(new AgentExport($results), 'agent_performance_report.csv');
        }
    }
     public function report_export(Request $request,$start_date,$end_date)
    {
        # code...
        $utils=new Utils();
        $params = [$start_date,$end_date];
        $results = DB::select("call sp_get_cdr_summary_report('$start_date','$end_date')");
        if(count($results)>0){
            return Excel::download(new CdrExport($results), 'report.csv');
        }
    }

    public function get_start_end_time($value)
    {
          $anc_opd_time=DB::table('opd_timing')->where('name','ANC')->select(DB::raw('min(start_time) as anc_start_time ,max(end_time) as anc_end_time'))->first();

          $pnc_opd_time=DB::table('opd_timing')->where('name','PNC')->select(DB::raw('min(start_time)  as pnc_start_time ,max(end_time)  as pnc_end_time'))->first();


         if($value=="cdr_before_anc")
            {
              
                $start_time="00:01:00";
                $end_time=$anc_opd_time->anc_start_time;
            }
            elseif($value=="cdr_after_pnc")
            {
                $start_time=$pnc_opd_time->pnc_end_time;
                $end_time="23:59:00";
            }
            elseif($value=="cdr_anc")
            {
                $start_time=$anc_opd_time->anc_start_time;
                $end_time=$anc_opd_time->anc_end_time;
            }
             elseif($value=="cdr_pnc")
            {
               $start_time=$pnc_opd_time->pnc_start_time;
               $end_time=$pnc_opd_time->pnc_end_time;
            }
            else{
                $start_time="00:01:00";
                $end_time="23:59:00";
            }

            return ['start_time'=>$start_time,'end_time'=>$end_time];
    }

    public function call_filter_results($q,$phone_number,$results)
    {

            if($q=="agent_total" && $phone_number){

                $results = array_filter($results,function ($item) use($phone_number) {
                return $item->agent_phone_number == $phone_number;
              });
                
            }
            elseif($q=="agent_missed" && $phone_number){

                $results = array_filter($results,function ($item) use($phone_number) {
                return $item->agent_phone_number == $phone_number&&$item->agent_answered=='0'
                  ;                    
              });
            }
            elseif($q=="agent_answered" && $phone_number){

                $results = array_filter($results,function ($item) use($phone_number) {
                return $item->agent_phone_number == $phone_number&&$item->agent_answered=='1'
                  ;                    
              });      
            }
            elseif($q=="doctor_missed" && $phone_number){

                $results = array_filter($results,function ($item) use($phone_number) {
                return $item->doctor_phone_number == $phone_number&&$item->doctor_answered=='0'
                  ;                    
              });
            }
            elseif($q=="doctor_answered" && $phone_number){
          
                $results = array_filter($results,function ($item) use($phone_number) {
                return $item->doctor_phone_number == $phone_number&&$item->doctor_answered=='1'
                  ;                    
              });      
            }

           elseif($q=="doctor_total" && $phone_number){

                $results = array_filter($results,function ($item) use($phone_number) {
                return $item->doctor_phone_number == $phone_number;
              });
            }
            return $results;
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
