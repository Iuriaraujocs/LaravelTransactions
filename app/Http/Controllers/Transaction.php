<?php

namespace App\Http\Controllers;

use App\Domain\Model\Transaction as ModelTransaction;
use Illuminate\Http\Request;
use App\Domain\Business\CsvHelper;

class Transaction extends Controller
{
    private $transaction;
    private $request;
    private $csvHelper;

    public function __construct(Request $request)
    {
        $this->transaction = new ModelTransaction();
        $this->request = $request;
        $this->csvHelper = new CsvHelper($this->request);
    }

    public function insert()
    {
        $error = $this->csvHelper->store();
        if ($error == 'true') {
            return view('home', ['result' => 'no']);
        } else {
            return view('home', ['result' => 'yes']);
        }
    }

    public function show()
    {
        $data = ModelTransaction::all()->paginate(15);

        return view('analysis');
    }
}
