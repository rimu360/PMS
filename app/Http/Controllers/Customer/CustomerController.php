<?php

namespace App\Http\Controllers\Customer;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Medicines;

class CustomerController extends Controller
{

    public function index()
    {
        return view('customer.index');
    }

    public function medicine_list_customer()
    {
      $medicines = Medicines::all();
        return view('customer.medicine_list',compact('medicines'));
    }

}
