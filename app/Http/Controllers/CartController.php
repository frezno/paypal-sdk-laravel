<?php

namespace App\Http\Controllers;

use Cart;
use Illuminate\Http\Request;

class CartController extends Controller
{
    /**
     * Add chosen product(s) to the shopping cart
     *
     * @param  Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function addToCart(Request $request)
    {
        $input = $request->all();

        Cart::add($input['id'], $input['title'], $input['price'], $input['quantity'], [
            'sku'     => $input['sku'],
            'img'     => $input['img']
        ]);

        $msg = $input['quantity'] .' x '. $input['title'] .' added to cart';

        return back()->withSuccess($msg);
    }

    /**
     * Display basket with all its content
     *
     * @return \Illuminate\View\View
     */
    public function getCart()
    {
        if (Cart::isEmpty()) {
            return redirect('/');
        }

        $cartCollection = Cart::getContent();

        $cartSubTotal = Cart::getSubTotal();

        $shipping = '5.20';

        return view('shop.cart', compact('cartCollection', 'cartSubTotal', 'shipping'));
    }

    /**
     * Add 1 item to the quantity count
     *
     * @param  integer $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function addQuantity($id)
    {
        Cart::update($id, ['quantity' => 1]);

        return back();
    }

    /**
     * Subtract 1 item from the quantity count
     *
     * @param  integer $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function subtractQuantity($id)
    {
        Cart::update($id, ['quantity' => -1]);

        return back();
    }

    /**
     * Remove selected product from shopping cart
     *
     * @param  integer $id
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function removeFromCart($id)
    {
        Cart::remove($id);

        return redirect('cart');
    }

    /**
     * Delete complete shopping cart
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function deleteCart()
    {
        Cart::clear();

        return redirect('/');
    }
}
