<?php

namespace App\Exports;

use DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\Exportable;

class AgentExport implements FromCollection,WithHeadings
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
            'Date',
            'Total no of Calls sent',
             'Agent Name',
            'Agent Phone Number',
            'Calls Answered',
            'Calls Missed'
        ];
    }

}

