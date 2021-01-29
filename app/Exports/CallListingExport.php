<?php

namespace App\Exports;

use DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\Exportable;

class CallListingExport implements FromCollection,WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    use Exportable;
    private $data;

    public function __construct($data)
    {
        $this->data = $data;
        //dd($this->data);
    }

    public function collection()
    {

      return collect(
            $this->data
        );
     
    }

    public function headings(): array
    {
        return [
            'Call Date Time',
            'Agent Phone Number',
             'Agent Name',
            'Doctor Name',
            'Doctor Phone Number',
            'Recording URL'
        ];
    }
    public function columnFormats(): array
    {
        return [
                'Agent Phone Number' =>'@',
            ];
      
    }

}

