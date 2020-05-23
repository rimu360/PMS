<?php

namespace App\Http\Controllers\Pharmacist;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Medicines;
use App\Stocks;


class PharmacistController extends Controller
{

    public function index()
    {
        return view('pharmacist.index');
    }

    //--------------------------------stock---------------------------------
    public function stock()
    {
        $medicines = Medicines::all();
        return view('pharmacist.stock',compact('medicines'));
    }

    //--------------------------------update stock---------------------------------
    public function update_stock(Request $request)
    {
        Stocks::where('medicine_id',$request->id)->update([
          'quantity'=> $request->quantity,
        ]);
        Medicines::where('id',$request->id)->update([
          'quantity'=> $request->quantity,
        ]);
        return redirect()->route('stock')->with('success','Stock updated successfully');
    }


}
