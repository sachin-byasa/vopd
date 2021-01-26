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
        if(count($date_arr)>0 && $request->report_type==Constants::$SUMMARY_REPORT && (isset($q)&& !is_null($q) ))
        {
            $start_date=str_replace(' ', '', $utils->date_format($date_arr[0]));
            $end_date=str_replace(' ', '', $utils->date_format($date_arr[1]));
            $params = [$start_date,$end_date];
            $results = $utils->CallRaw('sp_get_cdr_summary_report',$params);
          
            if(count($results)>0){

            $offset = ($page * $pageSize) - $pageSize;
            $data1 = array_slice($results, $offset, $pageSize, true);
            $paginator = new \Illuminate\Pagination\LengthAwarePaginator($data1, count($results), $pageSize, $page);
            $paginator->setPath(request('/admin/reports'));
            return view('reports.index', ['cdr_arry' => $paginator]);
        }   
    }
     return view('reports.index',['cdr_arry' => $results]);
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
