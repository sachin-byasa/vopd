<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Hash;
use DB;
use App\Constants;
use App\Utils;
class ReportController extends Controller
{
     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $cdr_arry['cdr']=[];
        $q =$request->input('q');
        $page = request('page', 1);
        $pageSize =10;
        if($request->page_size!=null)
            $pageSize = $request->page_size;
        $start_date=null;
        $end_date=null;
        $date_arr=explode('-', $request->date_range);
        $data=[];
        $cdr_arry['cdr']=[];
        $utils=new Utils();
        if(count($date_arr)>0 && $request->report_type==Constants::$SUMMARY_REPORT && (isset($q)&& !is_null($q) ))
        {
            $start_date=str_replace(' ', '', $utils->date_format($date_arr[0]));
            $end_date=str_replace(' ', '', $utils->date_format($date_arr[1]));
            $params = [$start_date,$end_date];
            $results = $utils->CallRaw('sp_get_summary_count_records',$params);
            //dd($results);
            if(count($results)>0){
                $data['total_calls']=$results[0];
                $data['out_anc_duty']=$results[1];
                $data['out_duty_anc_agent_count']=$results[2];
                $data['out_duty_anc_doctor_count']=$results[3];
                $data['out_pnc_duty']=$results[4];
                $data['out_duty_pnc_agent_count']=$results[5];
                $data['out_duty_pnc_doctor_count']=$results[6];
                $data['in_anc_duty']=$results[7];
                foreach ($data['total_calls'] as $key => $value) {
                    
                    $cdr_data['cdr_date']=$value->cdr_date;
                    $cdr_data['total_calls']=$value->total_calls;
                    $cdr_data['out_anc_duty']=$data['out_anc_duty'][$key]->out_anc_duty;
                    $cdr_data['in_anc_duty']=$data['in_anc_duty'][$key]->in_anc_duty;
                    $cdr_data['out_duty_anc_agent_count']=$data['out_duty_anc_agent_count'][$key]->out_duty_anc_agent_count;
                    $cdr_data['out_duty_anc_doctor_count']=$data['out_duty_anc_doctor_count'][$key]->out_duty_anc_doctor_count;
                    $cdr_data['out_pnc_duty']=$data['out_pnc_duty'][$key]->out_pnc_duty;
                    $cdr_data['out_duty_pnc_agent_count']=$data['out_duty_pnc_agent_count'][$key]->out_duty_pnc_agent_count;
                    $cdr_data['out_duty_pnc_doctor_count']=$data['out_duty_pnc_doctor_count'][$key]->out_duty_pnc_doctor_count;
                    array_push($cdr_arry['cdr'], $cdr_data);
                }
            }
            $offset = ($page * $pageSize) - $pageSize;
            $data1 = array_slice($cdr_arry['cdr'], $offset, $pageSize, true);
            $paginator = new \Illuminate\Pagination\LengthAwarePaginator($data1, count($cdr_arry['cdr']), $pageSize, $page);
            $paginator->setPath(request('/admin/reports'));
            return view('reports.index', ['cdr_arry' => $paginator]);
        }
            return view('reports.index', $cdr_arry);
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
