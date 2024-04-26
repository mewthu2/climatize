<?php

namespace App\Http\Controllers;

use App\Models\Freezer;

class CadFreezersController extends Controller
{
    public function index()
    {   
        $freezers = Freezer::all();

        return view('freezers.index', ['freezers' => $freezers]);
    }
}