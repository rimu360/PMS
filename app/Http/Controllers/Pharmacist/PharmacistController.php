<?php

namespace App\Http\Controllers\Pharmacist;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PharmacistController extends Controller
{

    public function index()
    {
        return view('pharmacist.index');
    }
}
