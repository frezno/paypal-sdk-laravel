@extends('layouts.master')

@section('content')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
        <li class="breadcrumb-item"><a href="{{ url('/cart') }}">Cart</a></li>
        <li class="breadcrumb-item active">Address</li>
    </ol>
</nav>

<div class="row">
    <div class="col-sm-10 offset-sm-1">

        <fieldset class="form-horizontal" id="billing-address">
            <legend>Address</legend>

            <div class="form-row">
                <div class="form-group col-sm-5">
                    <label for="firstname">First Name <span class="text-danger">*</span></label>
                    <input type="text" name="firstname" id="firstname" class="form-control" value="John" required>
                </div>
                <div class="form-group col-sm-7">
                    <label for="lastname">Last Name <span class="text-danger">*</span></label>
                    <input type="text" name="lastname" id="lastname" class="form-control" value="Doe" required>
                </div>
            </div>

            <div class="form-group">
                <label for="company">Company</label>
                <input type="text" name="company" id="company" class="form-control" value="">
            </div>

            <div class="form-group">
                <label for="street">Street <span class="text-danger">*</span></label>
                <input type="text" name="street" id="street" class="form-control" value="77 Jump Street" required>
            </div>

            <div class="form-group">
                <label for="street2">Optional</label>
                <input type="text" name="street2" id="street2" class="form-control" value="">
            </div>

            <div class="form-row">
                <div class="form-group col-sm-3">
                    <label for="zip">Zip-Code <span class="text-danger">*</span></label>
                    <input type="text" name="zip" id="zip" class="form-control" value="12345" required>
                </div>
                <div class="form-group col-sm-9">
                    <label for="city">City <span class="text-danger">*</span></label>
                    <input type="text" name="city" id="city" class="form-control" value="Gordon City" required>
                </div>
            </div>

            <div class="form-group">
                <label for="country">Country <span class="text-danger">*</span></label>
                <select name="country" id="country" class="form-control">
                    <option value="BE">Belgium</option>
                    <option value="BR">Brazil</option>
                    <option value="KH">Cambodia</option>
                    <option value="CA">Canada</option>
                    <option value="CN">China</option>
                    <option value="DK">Denmark</option>
                    <option value="FR">France</option>
                    <option value="DE" selected>Germany</option>
                    <option value="GR">Greece</option>
                    <option value="IN">India</option>
                    <option value="IT">Italy</option>
                    <option value="NL">Netherlands</option>
                    <option value="ZA">South Africa</option>
                    <option value="ES">Spain</option>
                    <option value="CH">Switzerland</option>
                    <option value="TH">Thailand</option>
                    <option value="GB">United Kingdom</option>
                    <option value="US">United States</option>
                </select>
            </div>

            <div class="form-group">
                <label for="telephone">Telephone</label>
                <input type="text" name="telephone" id="telephone" class="form-control" value="123-456789">
            </div>

            <div class="form-group">
                <label for="email">Email <span class="text-danger">*</span></label>
                <input type="text" name="email" id="email" class="form-control" value="john.doe@example.com" required>
            </div>
        </fieldset>
    </div>

    <div class="col-sm-10 offset-sm-1 text-right">
        <a class="btn btn-primary" href="{{ url('/checkout/confirm') }}">
            Checkout Confirmation &gt;
        </a>
    </div>
</div>
@endsection
