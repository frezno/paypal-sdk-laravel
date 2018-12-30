@extends('layouts.master')

@section('content')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
        <li class="breadcrumb-item active">Shopping Cart</li>
    </ol>
</nav>

<div class="table-responsive">
    <table class="table table-condensed">
        <thead>
            <tr>
                <td class="image">Product</td>
                <td class="description"></td>
                <td class="price">Price</td>
                <td class="quantity">Qty</td>
                <td class="total">Total</td>
                <td></td>
            </tr>
        </thead>

        <tbody>
        @foreach($cartCollection as $cart)
            <tr>
                <td>
                    <img src="images/{{ $cart['attributes']['img'] }}"
                        alt="{{ $cart['name'] }}" height="65"></a>
                </td>

                <td>
                    <h4>{{ $cart['name'] }}</h4>
                    <p>{{ $cart['attributes']['sku'] }}</p>
                </td>

                <td>
                    <p>{{ $cart['price'] }} &euro;</p>
                </td>

                <td>
                    <div>
                        <a href="{{ url('/sub_qty/'.$cart['id']) }}" class="cart_quantity_down btn btn-secondary">
                            -
                        </a>
                        <input class="cart_quantity_input" type="text" name="quantity" value="{{ $cart['quantity'] }}" autocomplete="off" size="2">
                        <a href="{{ url('/add_qty/'.$cart['id']) }}" class="cart_quantity_up btn btn-secondary">
                            +
                        </a>
                    </div>
                </td>

                <td>
                    <?php $price = $cart['quantity'] * $cart['price']; ?>
                    <p class="cart_total_price">{{ number_format($price, 2, ',', '.') }} &euro;</p>
                </td>

                <td>
                    <a href="{{ url('/remove/'.$cart['id']) }}" class="btn btn-danger">
                        x
                    </a>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    <hr>
</div>
<div class="row">
    <div class="col-sm-10 col-sm-offset-1 text-right">
        <h4>Subtotal: {{ number_format($cartSubTotal, 2, ',', '.') }} &euro;</h4>
        <h4>Shipping: {{ number_format($shipping, 2, ',', '.') }} &euro;</h4>
        <small>incl. 19% VAT</small>
        <hr>
    </div>

    <div class="col-sm-10 col-sm-offset-1 text-right">
        <a class="btn btn-danger" href="{{ url('/delete_cart') }}">
            <span class="glyphicon glyphicon-trash" aria-hidden="true"></span> Delete Cart
        </a>
        <a class="btn btn-primary" href="{{ url('/checkout/address') }}">Checkout Address
            <span class="glyphicon glyphicon-forward" aria-hidden="true"></span>
        </a>
    </div>
</div>
@endsection
