<?php
    
namespace App\Http\Controllers;
     
use Illuminate\Http\Request;
use Session;
use Stripe;
     
class StripePaymentController extends Controller
{
    /**
     * success response method.
     *
     * @return \Illuminate\Http\Response
     */
    public function stripe()
    {
        return view('stripe');
    }
    
    /**
     * success response method.
     *
     * @return \Illuminate\Http\Response
     */
    public function stripePost(Request $request)
    
        {
            Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
            $customer = Stripe\Customer::create(array(
                    "address" => [
                        "line1" => "Virani Chowk",
                        "postal_code" => "390008",
                        "city" => "Vadodara",
                        "state" => "GJ",
                        "country" => "IN",
                    ],
                    "email" => "demo@gmail.com",
                    "name" => "Nitin Pujari",
                    "source" => $request->stripeToken
                ));
            Stripe\Charge::create ([
                    "amount" => 10 * 100,
                    "currency" => "usd",
                    "customer" => $customer->id,
                    "description" => "Test payment ",
                    "shipping" => [
                        "name" => "Jenny Rosen",
                        "address" => [
                            "line1" => "510 Townsend St",
                            "postal_code" => "98140",
                            "city" => "San Francisco",
                            "state" => "CA",
                            "country" => "US",
                        ],
                    ]
            ]); 
            Session::flash('success', 'Payment successful!');
            return back();
        }
}
