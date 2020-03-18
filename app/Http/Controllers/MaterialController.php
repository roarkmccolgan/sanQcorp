<?php

namespace App\Http\Controllers;

use App\Material;
use Illuminate\Http\Request;

class MaterialController extends Controller
{
    public function index(Request $request)
    {
        $q = $request->q ?? '';

        $materials = Material::query()
        ->whereLike('name', "%{$q}%")
        ->get();
        if ($request->ajax()) {
            return response()->json(['materials'=>$materials]);
        }

        return 'HTTP';
    }
}
