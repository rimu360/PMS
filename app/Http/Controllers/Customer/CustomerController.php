<?php

namespace App\Http\Controllers\Customer;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Medicines;
use App\Carts;
use App\Orders;
use App\OrderDetails;
use App\Stocks;
use Auth;
use Carbon\carbon;
class CustomerController extends Controller
{

    public function index()
    {
        return view('customer.index');
    }

    public function medicine_list_customer()
    {
      $medicines = Medicines::all();
      $carts = Carts::where('customer_ip', $_SERVER["REMOTE_ADDR"])->get();
      //dd($count);
        return view('customer.medicine_list',compact('medicines','carts'));
    }

    public function cart(Request $request)
    {
      $medicine_id = $request -> medicine_id;
      $ip_address = $_SERVER['REMOTE_ADDR'];
      $p_quantity = Medicines::where('id',$request->medicine_id)->first();
      $n_quantity = ($p_quantity->quantity) - ($request -> quantity);
        //dd($n_quantity);
        if($n_quantity >= 0)
        {
             if (Carts::where('customer_ip',$ip_address)->where('medicine_id', $medicine_id)->exists()  )
              {
                Carts::where('customer_ip',$ip_address)->where('medicine_id', $medicine_id)->increment('quantity', 1);
             }
             else {
               Carts::insert([
                 'customer_id' => Auth::user()->id,
                 'customer_ip' => $ip_address,
                 'medicine_id' => $medicine_id,
                 'quantity' => $request->quantity,
                 'price' => $request->price,
               ]);
             }
             return back();
        }
        else
        {
          return back()->with('warning','Please enter less quantity for this medicine');
        }

    }


    //------------------------------------------cart item----------------------------------------
    function cart_items()
     {
       $cart_items = Carts::where('customer_ip', $_SERVER["REMOTE_ADDR"])->get();
       return view('customer.cart_items',compact('cart_items'));
     }

     //--------------------------------------------item delete-----------------------------------
     function item_delete($id)
      {
        $cart_items = Carts::find($id)->delete();
        return back();
      }

      //--------------------------------------------cart clear------------------------------------
      function cart_clear()
      {
      $cart_items =  Carts::where('customer_ip', $_SERVER["REMOTE_ADDR"])->delete();
        return back();
      }

      //------------------------------------------------check out------------------------------------
      function  checkout()
      {
        $cart_items = Carts::where('customer_ip', $_SERVER["REMOTE_ADDR"])->get();
       return view('customer.checkout', compact('cart_items'));
       return back();
      }

      //------------------------------------------------check out------------------------------------
      function  checkout_post(Request $request)
      {
          //dd($request);
          $order_id = Orders::insertGetId([
            'customer_id' => Auth::user()->id,
            'address' => $request->address,
            'total_price' => $request->total_price,
            'pm' => $request->pm,
            'payment_status' => 0,
            'created_at' => Carbon::now(),
          ]);

        $count = Carts::where('customer_ip', $_SERVER["REMOTE_ADDR"])->count();
        while($count>0){
        $cart_items = Carts::where('customer_ip', $_SERVER["REMOTE_ADDR"])->first();

        $p_quantity = Medicines::where('id',$cart_items->medicine_id)->first();
        $n_quantity = ($p_quantity->quantity) - ($cart_items -> quantity);
        //  dd($n_quantity);
        if($n_quantity >= 0)
        {
          OrderDetails::insert([
            'order_id'=> $order_id,
            'medicine_id'=> $cart_items -> medicine_id,
            'quantity'=> $cart_items -> quantity,
          ]);

          Carts::findOrFail($cart_items->id)->delete();
          Stocks::where('medicine_id',$cart_items->medicine_id)->update([
            'quantity'=> $n_quantity,
          ]);
          Medicines::where('id',$cart_items->medicine_id)->update([
            'quantity'=> $n_quantity,
          ]);

        }
        else
        {
          return back()->with('warning','This product is not available');
        }


        $count =$count-1;
        }

        if ($request->pm == 2) {
         return redirect()->route('orders')->with('success','Your Order Placed successfully');
        // echo "Your Order Placed successfully";


        }
        else {

          $total_price = $request->total_price;
         return view('customer.stripe_payment', compact('total_price', 'order_id'));
        }

      }

      //------------------------------------orders------------------------------------
      public function orders()
      {
        $medicines = Medicines::all();
        $orders = Orders::where('customer_id', Auth::user()->id)->get();
          return view('customer.orders',compact('orders'));
      }

      //------------------------------------orders------------------------------------
      public function order_details($id)
      {
        $medicines = Medicines::all();
        $orders = Orders::where('id', $id)->get();
        $order_details = OrderDetails::where('order_id', $id)->get();
        //dd($order_details);
          return view('customer.order_details',compact('orders','order_details'));
      }
}
