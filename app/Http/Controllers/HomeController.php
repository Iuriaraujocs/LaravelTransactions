<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Domain\Business\RequestHelper;
use App\Domain\Model\Transaction as ModelTransaction;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     */
    private $request;

    public function __construct(Request $request)
    {
        $this->middleware('auth');
        $this->request = new RequestHelper($request);
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
        $data = ModelTransaction::paginate(15);
        $pageIterator = $this->request->pageIterator();

        return view('analysis', ['record' => $data, 'pageIterator' => $pageIterator]);
    }
}
