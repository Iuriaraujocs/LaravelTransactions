<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Domain\Model\Transaction as ModelTransaction;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */


     
    public function __construct()
    {
        $this->middleware('auth');
        $this->transaction = new ModelTransaction();
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    public function show()
    {
        $data = ModelTransaction::all();
        return view('analysis',['record'=>$data]) ;
        // return view('analysis');
    }
}
