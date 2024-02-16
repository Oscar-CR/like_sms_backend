<?php

namespace App\Http\Controllers;

use App\Models\CSVDataModel;
use App\Models\CSVModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CsvController extends Controller
{
    public function store(Request $request) {
        $request->validate([
            'csv_file' => 'required|mimes:csv,txt|max:10240', 
            'name' => 'required'
        ]);


        $create_csv = new CSVModel();
        $create_csv->name  = $request->name;
        $create_csv->created_by = auth()->user()->id;
        $create_csv->save(); 

        $csvFilePath = $request->file('csv_file')->getPathname();
        $csvFile = fopen($csvFilePath, 'r');

        // Ignora la primera fila (encabezado)
        /* fgetcsv($csvFile); */

       
        while (($row = fgetcsv($csvFile)) !== false) {
            
            $phone = $row[1]; 
            $message = $row[2];
            $status = $row[3];

            CSVDataModel::create([
                'phone' => $phone,
                'message' => $message,
                'status' => $status,
                'csv_id' => $create_csv->id,
            ]);

        }

        fclose($csvFile);

        return redirect()->route('home.index')->with('success', 'Archivo CSV subido correctamente.');
    }

    public function update(Request $request) {
        DB::table('csv')->where('id', $request->id)->update([
            'name'=> $request->name
        ]);

        return redirect()->route('home.index')->with('success', 'Nombre actualizado correctamente.');
    }

    public function delete(Request $request) {
        DB::table('csv')->where('id', $request->id)->delete();

        return redirect()->route('home.index')->with('success', 'Archivo borrado correctamente.');
    }

    public function moredata(Request $request) {

        $request->validate([
            'csv_file' => 'required|mimes:csv,txt|max:10240', 
        ]);
         $csvFilePath = $request->file('csv_file')->getPathname();
         $csvFile = fopen($csvFilePath, 'r');
 
         // Ignora la primera fila (encabezado)
         /* fgetcsv($csvFile); */
 
       
        while (($row = fgetcsv($csvFile)) !== false) {
        
            $phone = $row[1];
            $message = $row[2];
            $status = $row[3];

            CSVDataModel::create([
                'phone' => $phone,
                'message' => $message,
                'status' => $status,
                'csv_id' => $request->id,
            ]);

        }
 
        fclose($csvFile);

        return redirect()->route('home.index')->with('success', 'Registros agregados correctamente.');
    }
    
}
