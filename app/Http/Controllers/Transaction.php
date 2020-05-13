<?php

namespace App\Http\Controllers;

use App\Domain\Model\Transaction as ModelTransaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class Transaction extends Controller
{
    //
    private $transaction;

    public function __construct()
    {
        $this->transaction = new ModelTransaction();
    }
    
    public function insert(){
        $data=[
            'client' => 'Araruano',
            "deal" => 'deal 2',
            "hour" => date('Y-m-d H:i:s', strtotime('14-05-2018')),
            "accepted" => 3,
            "refused" => 2
        ];
        DB::table('transactions')->insert($data);

        // $transaction = new ModelTransaction();
        // $this->transaction->client = 'joao';
        // $this->transaction->deal = 'deal 1';
        // $this->transaction->hour = date('Y-m-d H:i:s', strtotime('27-10-2020'));
        // $this->transaction->accepted = 1;
        // $this->transaction->refused = 2;
        // $this->transaction->save();
        return 'inserted';
    }

    public function show(Request $request){
        // dd($request->csvFile);
        // dd($request->file('csvFile'));
        // dd($request->all());
        if($request->file('csvFile')->isValid()){
        $filename = date('YmdHis') . '.' . $request->csvFile->extension();
            // $request->file('csvFile')->store('');
            $request->file('csvFile')->storeAs('',$filename);
        }

        if (Storage::disk('local')->exists($filename)) {
            // $dataCsv =  Storage::disk('local')->get($filename);
            // dd($dataCsv);
            $filenamePath = storage_path('app/'.$filename);
            $this->csvRead($filenamePath);
            // die($filenamePath);
            return 'foi';
            // return Storage::disk('local')->get($filename);
        }

        $data = ModelTransaction::all();
        // $data = ModelTransaction::all()->toArray();
        // User::get(['id', 'name', 'email'])->toArray()
        // dd($data);
        
        // return $data;
        return view('analysis');
        // [
        //     'teste' => 'iuriii',
        //     'record'=>$data
        // ]
        // ) ;
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
