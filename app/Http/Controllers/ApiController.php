<?php

namespace App\Http\Controllers;

use App\Models\CSVModel;
use Illuminate\Http\Request;

class ApiController extends Controller
{
    public function csv()  {
        $csvs = CSVModel::latest()->paginate(10);

        $data = [];
        foreach( $csvs as $csv){
            $csv_data = [];

            foreach($csv->csvData as $cdata){
                array_push($data, (object)[
                    'id' => $cdata->id,
                    'phone' => $cdata->phone,
                    'message' => $cdata->message,
                    'status' => $cdata->status,
                    'csv_id' => $cdata->csv_id,
                ]);
            }
            array_push($data, (object)[
                'id' => $csv->id,
                'name' => $csv->name,
                'data' => $csv_data 
            ]);
        }

        return $data;
    }
}
