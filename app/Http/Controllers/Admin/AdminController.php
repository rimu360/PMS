<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\MedicineCategories;
use App\Medicines;
use App\User;
use App\Orders;
use Image;

class AdminController extends Controller
{

    public function index()
    {
        return view('admin.index');
    }

    //Category start----------------------------------------------------------------------
    public function add_category()
    {
        return view('admin.medicine.add_category');

    }

    public function add_category_post(Request $request) {
        MedicineCategories::create([
           'name' =>$request-> name,
           'description' =>$request-> description,
         ]);
         return back()->with('success','Medicine Category Added Sucessfully');
      }

      public function category_list()
      {
          $categories = MedicineCategories::all();
          return view('admin.medicine.category_list',compact('categories'));

      }

      public function update_category($id){
        $cat = MedicineCategories::findOrFail($id);
       //dd($cat);
        return view('admin.medicine.category_update',compact('cat'));
      }

      function update_category_post(Request $request,$id) {
        MedicineCategories::findOrFail($id)->update([
           'name' =>$request-> name,
           'description' =>$request-> description,
         ]);
         return redirect()->route('category_list')->with('success','Medicine Category Updated Sucessfully');
      }



   //Category end--------------------------------------------------------------------------



   //Medicine start------------------------------------------------------------------------

    public function add_medicine()
    {
        $categories = MedicineCategories::all();
        return view('admin.medicine.add_medicine',compact('categories'));
    }

    public function add_medicine_post(Request $request)
    {
              $last_inserted_id = Medicines::insertGetId([
                 'name' =>$request-> name,
                 'picture' =>$request-> picture,
                 'category_id' =>$request-> category_id,
                 'purchase_price' =>$request-> purchase_price,
                 'selling_price' =>$request-> selling_price,
                 'quantity' =>$request-> quantity,
                 'generic_name' =>$request-> generic_name,
                 'company' =>$request-> company,
                 'effects' =>$request-> effects,
                 'expiry_date' =>$request-> expiry_date,
              ]);

              if ($request->hasFile('picture')) {
               $photo_upload     =  $request ->picture;
               $photo_extension  =  $photo_upload -> getClientOriginalExtension();
               $photo_name       =  $last_inserted_id . "." . $photo_extension;
               Image::make($photo_upload)->resize(360,360)->save(base_path('public/medicines/'.$photo_name),100);
               Medicines::find($last_inserted_id)->update([
               'picture'          => $photo_name,
             ]);
             }
        return back()->with('success','Medicine Added Sucessfully');
    }


    public function medicine_list()
    {
      $medicines = Medicines::all();
        return view('admin.medicine.medicine_list',compact('medicines'));
    }

    public function update_medicine($id){
      $categories = MedicineCategories::all();
                $med = Medicines::findOrFail($id);
    //  dd($cat);
      return view('admin.medicine.medicine_update',compact('med', 'categories'));
    }

    function update_medicine_post(Request $request,$id) {
      Medicines::findOrFail($id)->update([
        'name' =>$request-> name,
        'category_id' =>$request-> category_id,
        'purchase_price' =>$request-> purchase_price,
        'selling_price' =>$request-> selling_price,
        'quantity' =>$request-> quantity,
        'generic_name' =>$request-> generic_name,
        'company' =>$request-> company,
        'effects' =>$request-> effects,
        'expiry_date' =>$request-> expiry_date,
       ]);
       return redirect()->route('medicine_list')->with('success','Medicine Updated Sucessfully');
    }

    //delete
    public function delete_medicine(Request $request)
    {
        Medicines::findOrFail($request->id)->delete();
        return back()->with('success','Medicine Deleted Successfully.');
    }


    //----------------------------------------customer list-----------------------------------
    public function customer_list()
    {
      $customers = User::whererole('customer')->get();
        return view('admin.customer_list',compact('customers'));
    }

    //----------------------------------------staff list-----------------------------------
    public function staff_list()
    {
      $staffs = User::whererole('pharmacist')->get();
        return view('admin.staff_list',compact('staffs'));
    }

    //--------------------------------------Assign role----------------------------------------

    public function assign_role($id){

        $user = User::whereRaw("id = '$id'")->update([
          'role' => 'pharmacist',
        ]);

      return back();
    }




}




  //Medicine end----------------------------------------------------------------------------
