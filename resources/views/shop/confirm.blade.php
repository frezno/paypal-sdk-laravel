@extends('layouts.master')

@section('content')
<div class="breadcrumbs">
    <ol class="breadcrumb">
        <li><a href="{{ url('/') }}">Home</a></li>
        <li><a href="{{ url('/cart') }}">Cart</a></li>
        <li><a href="{{ url('/checkout/address') }}">Address</a></li>
        <li class="active">Confirm Purchase</li>
    </ol>
</div>

<div class="row">
    <div class="col-md-12">
        <h2>Confirm Purchase</h2>

        <legend>Address</legend>

        <div class="form-group">
            <div class="col-sm-6">
                <input type="text" name="firstname" class="form-control" value="John Doe" readonly>
            </div>
        </div>

        <div class="col-sm-2">
            <a href="{{ url('/checkout/address') }}" class="btn btn-default" role="button">Change Address</a>
        </div>

        <div class="form-group">
            <div class="col-sm-4 col-sm-offset-4"></div>
        </div>

        <div class="form-group">
            <div class="col-sm-6">
                <input type="text" name="street" class="form-control" value="77 Jump Street" readonly>
            </div>
        </div>

        <div class="form-group">
            <div class="col-sm-6 col-sm-offset-6"></div>
        </div>

        <div class="form-group">
            <div class="col-sm-2">
                <input type="text" name="zip" class="form-control" value="12345" readonly>
            </div>
            <div class="col-sm-4">
                <input type="text" name="city" class="form-control" value="Gordon City" readonly>
            </div>
        </div>

        <div class="form-group">
            <div class="col-sm-6 col-sm-offset-6"></div>
        </div>

        <div class="form-group">
            <div class="col-sm-6">
                <input type="text" name="country" class="form-control" value="Germany" readonly>
            </div>
        </div>

        <div class="form-group">
            <div class="col-sm-6 col-sm-offset-6"></div>
        </div>
    </div>
</div>
<hr>
<div class="row">
    <div class="col-sm-12">
        <div class="table-responsive">
            <table class="table table-condensed">
                <thead>
                    <tr>
                        <td class="image">Product</td>
                        <td class="price">Price</td>
                        <td class="quantity">Qty</td>
                        <td class="total">Total</td>
                    </tr>
                </thead>

                <tbody>
                    @foreach($cartCollection as $cart)
                    <tr>
                        <td>{{ $cart['name'] }} - {{ $cart['attributes']['sku'] }}</td>
                        <td>{{ $cart['price'] }} &euro;</td>
                        <td>{{ $cart['quantity'] }}</td>
                        <td><?php $price = $cart['quantity'] * $cart['price']; ?>
                            {{ number_format($price, 2, ',', '.') }} &euro;
                        </td>
                    </tr>
                    @endforeach
                    <tr>
                        <td>
                            <?php $total = $cartSubTotal + $shipping; ?>
                            Subtotal: {{ number_format($cartSubTotal, 2, ',', '.') }} &euro;<br>
                            Shipping: {{ number_format($shipping, 2, ',', '.') }} &euro;<br>
                            <strong>Grand Total: {{ number_format($total, 2, ',', '.') }} &euro; </strong><small> (incl. 19% VAT)</small>
                        </td>
                    </tr>
                </tbody>
            </table>
            <hr>
        </div>
    </div>
</div>

<div class="col-sm-12">
    <form method="post" action="{{ url('/checkout/confirmed') }}">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">

        <div class="form-group">
            <label class="checkbox-inline">
                @if ($errors->has('randr')) <span class="alert-danger"> {{ $errors->first('randr') }} </span> <br> @endif
                <input type="checkbox" id="randr" name="randr" value="1">
                    <strong>I agree to your Rules &amp; Regulations.</strong>
            </label>
        </div>

        <div class="form-group">
            <button type="submit" class="btn btn-primary">Pay with Paypal</button>
            <button type="submit" class="btn btn-primary">Pay by Wire</button>
        </div>
    </form>
</div>
@endsection
