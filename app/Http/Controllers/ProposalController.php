<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProposalController extends Controller
{
    public function WktoHtml(Request $Request)
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
    		->setOption('footer-html', env('APP_DOMAIN').'/wkhtmltopdf/footer')
    		->$type($name);
    }
}
