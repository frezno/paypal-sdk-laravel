<?php

namespace App\Http\Controllers;

use Cart;
use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    public function address()
    {
        return view('shop.address');
    }

    public function confirm()
    {
        $cartCollection = Cart::getContent();
        $cartSubTotal = Cart::getSubTotal();
        $shipping = '5.20';

        return view('shop.confirm', compact('cartCollection', 'cartSubTotal', 'shipping'));
    }

    public function gotConfirmation(Request $request)
    {
        $this->validate($request, ['randr' => 'required']);

        return 'Order confirmed !';
    }
}
