@extends('layouts.master')

@section('content')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
        <li class="breadcrumb-item"><a href="{{ url('/cart') }}">Cart</a></li>
        <li class="breadcrumb-item"><a href="{{ url('/checkout/address') }}">Address</a></li>
        <li class="breadcrumb-item active">Confirm Purchase</li>
    </ol>
</nav>

<div class="row">
    <div class="col-sm-12">
        <h2 class="text-center">Confirm Purchase</h2>

        <legend class="col-sm-2">Address</legend>

        <div class="form-group">
            <div class="col-sm-6">
                <input type="text" name="firstname" class="form-control" value="John Doe" readonly>
            </div>
        </div>

        <div>
            <a href="{{ url('/checkout/address') }}" class="btn btn-default" role="button">Change Address</a>
        </div>

        <div class="form-group">
            <div class="col-sm-6">
                <input type="text" name="street" class="form-control" value="77 Jump Street" readonly>
            </div>
        </div>

        <div class="form-group">
            <div class="col-sm-2">
                <input type="text" name="zip" class="form-control" value="12345" readonly>
            </div>
        </div>

        <div class="form-group">
            <div class="col-sm-6">
                <input type="text" name="city" class="form-control" value="Gordon City" readonly>
            </div>
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
                        <th class="image" scope="col">Product</td>
                        <th class="price" scope="col">Price</td>
                        <th class="quantity" scope="col">Qty</td>
                        <th class="total" scope="col">Total</td>
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

        <div class="form-check">
            
            @if ($errors->has('randr'))
                <span class="alert-danger"> {{ $errors->first('randr') }} </span> <br>
            @endif

            <input class="form-check-input" type="checkbox" id="randr" name="randr" value="1">
            <label class="form-check-label font-weight-bold">I agree to your Rules &amp; Regulations.</label>
        </div>

        <div class="mt-2">
            <div id="paypal-button-container"></div>
            <button type="submit" class="btn btn-primary">Pay by Wire</button>
        </div>
    </form>
</div>
@endsection

@section('scripts')
<script src="https://www.paypalobjects.com/api/checkout.js"></script>
<script>
    paypal.Button.render({

        // Set your environment
        env: 'sandbox', // sandbox | production

        // Specify the style of the button
        style: {
            label: 'pay',
            size:  'small',
            shape: 'pill',
            color: 'gold'
        },

        // PayPal Client IDs - replace with your own
        client: {
            sandbox:    '<insert sandbox client id>',
            production: '<insert production client id>'
        },

        // Show the buyer a 'Pay Now' button in the checkout flow
        commit: true,
        
        // Wait for the PayPal button to be clicked
        payment: function(data, actions) {
            return actions.payment.create({
                payment: {
                    transactions: [
                        {
                            amount: { total: '', currency: '' }
                        }
                    ]
                }
            });
        },

        // Wait for the payment to be authorized by the customer
        onAuthorize: function(data, actions) {
            return actions.payment.execute().then(function() {
                window.alert('Payment Complete!');
            });
        }

    }, '#paypal-button-container');
</script>
@endsection
