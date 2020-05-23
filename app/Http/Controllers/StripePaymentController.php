<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Stripe;
use Session;
use OrderDetails;
use App\Orders;



class StripePaymentController extends Controller
{

  public function stripe()
   {
       return view('customer.stripe_payment');
   }



   public function stripePost(Request $request)
    {
        Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
        Stripe\Charge::create ([
                "amount" => 100 * $request->total_price,
                "currency" => "bdt",
                "source" => $request->stripeToken,
                "description" => "Test payment from pms"
        ]);
        $id = $request->order_id;
        Orders::find($id)->update([
          'payment_status'=> 1
        ]);
        return redirect()->route('orders')->with('success','Payment Successfull');
          //return redirect()->route('invoice',$id);
        // Session::flash('success', 'Payment successful!');
        //
        // return back();
    }



}
