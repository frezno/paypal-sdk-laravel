@extends('layouts.master')

<?php
$products = [
    0 => [
        'id' => 1,
        'sku' => '12345-1',
        'title' => 'T-Shirt 1',
        'img' => 'pic_001.jpg',
        'price' => '21.20',
        'desc' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit.'
    ],
    1 => [
        'id' => 2,
        'sku' => '12345-2',
        'title' => 'T-Shirt 2',
        'img' => 'pic_002.jpg',
        'price' => '22.20',
        'desc' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit.'
    ],
    2 => [
        'id' => 3,
        'sku' => '12345-3',
        'title' => 'T-Shirt 3',
        'img' => 'pic_003.jpg',
        'price' => '23.20',
        'desc' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit.'
    ],
    3 => [
        'id' => 4,
        'sku' => '12345-4',
        'title' => 'T-Shirt 4',
        'img' => 'pic_004.jpg',
        'price' => '24.20',
        'desc' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit.'
    ]
];
?>

@section('content')
<!-- Jumbotron Header -->
<header class="jumbotron hero-spacer">
    <h1>A Warm Welcome to our Shop!</h1>
    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ipsa, ipsam, eligendi, in quo sunt possimus non incidunt odit vero aliquid similique quaerat nam nobis illo aspernatur vitae fugiat numquam repellat.</p>
</header>

<hr>
<!-- Display Add-to-Cart Success Message -->
@if (Session::has('success'))
    <div class="alert alert-success" id="add-alert">
        <a href="#" class="close" data-dismiss="alert">&times;</a>
        <strong>Success!</strong> {{ Session::get('success') }}
    </div>
@endif

<!-- Show Featured Products -->
<div class="row text-center">

    @foreach ($products as $p)
        <div class="col-sm-6 col-md-3">
            <div class="thumbnail">
                <img src="./images/{{ $p['img'] }}" alt="{{ $p['title'] }}">
                <div class="caption">
                    <h3>{{ $p['title'] }}</h3>
                    <p>{{ $p['desc'] }}</p>
                    <p>Our Price: {{ $p['price'] }} &euro;</p>

                    <form method="post" action="{{ url('/addtocart') }}">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <input type="text" name="quantity" id="quantity" value="1" size="2" maxlength="2">
                        &nbsp;&nbsp;
                        <button type="submit" class="btn btn-success">
                            Add to Cart <span class="glyphicon glyphicon-shopping-cart" aria-hidden="true"></span>
                        </button>
                        <input type="hidden" name="id" value="{{ $p['id'] }}">
                        <input type="hidden" name="sku" value="{{ $p['sku'] }}">
                        <input type="hidden" name="title" value="{{ $p['title'] }}">
                        <input type="hidden" name="price" value="{{ $p['price'] }}">
                        <input type="hidden" name="img" value="{{ $p['img'] }}">
                    </form>

                </div>
            </div>
        </div>
    @endforeach

</div>
@endsection

@section('scripts')
<script>
    $(document).ready(function(){
        $(".close").click(function(){
            $("#add-alert").alert('close');
        });
    });
</script>
@endsection