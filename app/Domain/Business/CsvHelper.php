<?php

namespace App\Domain\Business;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Domain\Model\Transaction as ModelTransaction;

class CsvHelper
{
    private $error = 'false';
    private $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function store()
    {
        $filename = date('YmdHis').'.'.$this->request->csvFile->extension();
        if ($this->request->file('csvFile')->isValid()) {
            $this->request->file('csvFile')->storeAs('', $filename);
        } else {
            return $this->error = 'true';
        }

        if (Storage::disk('local')->exists($filename)) {
            $filenamePath = storage_path('app/'.$filename);
            $recordSet = $this->csvRead($filenamePath);
        } else {
            return $this->error = 'true';
        }

        for ($i = 1; $i < count($recordSet); ++$i) {
            $this->saveIntoDatabase($recordSet[$i]);
            if ($this->error == 'true') {
                break;
            }
        }

        return $this->error;
    }

    private function csvRead($filename)
    {
        $row = 1;
        $recordSet = array();

        if (($handle = fopen($filename, 'r')) !== false) {
            while (($data = fgetcsv($handle, 1000, ',')) !== false) {
                $aux = array();
                $num = count($data);
                for ($i = 0; $i < $num; ++$i) {
                    array_push($aux, $data[$i]);
                }
                array_push($recordSet, $aux);
            }
            fclose($handle);
        }

        return $recordSet;
    }

    public function saveIntoDatabase($row = array())
    {
        try {
            $transaction = new ModelTransaction();
            $transaction->client = $row[0];
            $transaction->deal = $row[1];
            $transaction->hour = date('Y-m-d H:i:s', strtotime($row[2]));
            $transaction->accepted = $row[3];
            $transaction->refused = $row[4];
            $transaction->save();
        } catch (\Throwable $th) {
            $this->error = 'true';
        }
    }
}
