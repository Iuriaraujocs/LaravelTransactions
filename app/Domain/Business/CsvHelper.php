<?php

namespace App\Domain\Business;

use Illuminate\Http\Client\Request;

class CsvHelper{

    public function store(Request $request)
    {
        $filename = date('YmdHis') . '.' . $request->csvFile->extension();
               if($request->file('csvFile')->isValid()){
            // $request->file('csvFile')->store('');
            $request->file('csvFile')->storeAs('',$filename);
        }

        if (Storage::disk('local')->exists($filename)) {
            $filenamePath = storage_path('app/'.$filename);
            $this->csvRead($filenamePath);
            return 'foi';
        }
    }

    private function csvRead($filename){
        $row = 1;
        $recordSet = array();

		if (($handle = fopen($filename, "r")) !== FALSE) {
  		while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
    $aux = array();
              $num = count($data);
                for ($i=0; $i < $num; $i++) {
                    array_push($aux,$data[$i]);
                }
                array_push($recordSet,$aux);
  			}
  			fclose($handle);
        }
        return $recordSet;
    }
}