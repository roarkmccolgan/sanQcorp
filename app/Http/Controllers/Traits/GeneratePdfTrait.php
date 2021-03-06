<?php

namespace App\Http\Controllers\Traits;

use PDF;

trait GeneratePdfTrait {

	public function WKtoHTML($html, $name, $order_number, $type='inline')
    {
    	
    	if($type=='save'){
			$name = base_path().'/uploads/job/'.$order_number.'/'.$name;
			if (file_exists($name)) { unlink ($name); }
    	}    	

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