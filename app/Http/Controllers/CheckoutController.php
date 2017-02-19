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
        return 'Confirmed';
    }
}
