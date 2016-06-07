<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PDF;
use App\Http\Requests;

class ProposalController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function WKtoHTML(Request $request)
    {
    	$html = $request->input('html');
    	$name = $request->input('name');
    	$type = $request->input('type','inline');

    	return PDF::loadHTML($html)
    		->setPaper('a4')
    		->setOption('margin-top', 15)
    		->setOption('margin-right', 0)
    		->setOption('margin-bottom',25)
    		->setOption('margin-left', 0)
    		->setOption('footer-html', 'http://sanqcorp.app/wkhtmltopdf/footer.html')
    		->$type($name);
    }
}
