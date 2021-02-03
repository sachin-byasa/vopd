<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Log;
use DB;
use App\Constants;
use Carbon\Carbon;
class CronMaster extends Model
{
    protected $table = '';
    protected $primaryKey = '';
    const UPDATED_AT = 'updated_date';

    
    protected $fillable=[];

    public function fetch_cdr()
    {
            //TODO :at the time of deployment take the value from env
            $cron_time=ENV('FETCH_CDR_START_TIME');
            $get_fetched_at=DB::select('call sp_get_cron_master_id()');

            if(count($get_fetched_at)>0){

                 if(isset($get_fetched_at[0]))
                {
                    $cron_time=$get_fetched_at[0]->fetched_at;
                    $cron_time=date('Y-m-d H:i:s',strtotime('+1 seconds',strtotime($cron_time)));
                }
            }
               
             //$cron_time=ENV('FETCH_CDR_START_TIME');
            //TODO:end time should be current-30 mins
          

            $data_string="start_date=".$cron_time."&end_date=".date('Y-m-d H:i:s');
           //dd($data_string);
            log::info($data_string);
            $url = env('FETCH_CDR_URL');
            log::info($url);
            $current_time=Carbon::now('Asia/Calcutta')->toDateTimeString();
                                           
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/x-www-form-urlencoded'));   
            curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
            // receive server response ...
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            $response = curl_exec($ch);
            $httpCode = curl_getinfo($ch,CURLINFO_HTTP_CODE);
            $err = curl_error($ch);
            curl_close($ch);

            if($httpCode>=400){

                $status=Constants::$FAILED;
                DB::select(" call sp_insert_cron_master ('$status')");
            }
            elseif (!$err)
            {

                $status=Constants::$SUCCESS;
                log::info($response);
                $this->save_fetched_cdr_into_db($response);
                DB::select(" call sp_insert_cron_master ('$status')");
                return $response;
            }
            else{
                 $status=Constants::$FAILED;
                 DB::select(" call sp_insert_cron_master ('$status')");
               
            }
    }

    public function save_fetched_cdr_into_db($json)
    {
        $data = json_decode($json);
        if($json){

            try{
                    $user = DB::select("CALL sp_insert_cdr('$json')"); 
                }
            catch(Exception $e)
               {
                    log::info("Exception:");
                    log::info($e);
               }
        }
    }
}
