@extends('layouts.master')

@section('content')
<div class="breadcrumbs">
    <ol class="breadcrumb">
        <li><a href="{{ url('/') }}">Home</a></li>
        <li><a href="{{ url('/cart') }}">Cart</a></li>
        <li class="active">Address</li>
    </ol>
</div>

<div class="row">
    <div class="col-sm-8 col-sm-offset-2">

        <fieldset class="form-horizontal" id="billing-address">
            <legend>Address</legend>

            <div class="form-group">
                <label for="firstname" class="col-sm-2 control-label">First Name <span class="text-danger">*</span></label>
                <div class="col-sm-3">
                    <input type="text" name="firstname" id="firstname" class="form-control" value="John" required>
                </div>
                <label for="lastname" class="col-sm-2 control-label">Last Name <span class="text-danger">*</span></label>
                <div class="col-sm-5">
                    <input type="text" name="lastname" id="lastname" class="form-control" value="Doe" required>
                </div>
            </div>

            <div class="form-group">
                <label for="company" class="col-sm-2 control-label">Company</label>
                <div class="col-sm-10">
                    <input type="text" name="company" id="company" class="form-control" value="">
                </div>
            </div>

            <div class="form-group">
                <label for="street" class="col-sm-2 control-label">Street <span class="text-danger">*</span></label>
                <div class="col-sm-10">
                    <input type="text" name="street" id="street" class="form-control" value="77 Jump Street" required>
                </div>
            </div>

            <div class="form-group">
                <label for="street2" class="col-sm-2 control-label">Optional</label>
                <div class="col-sm-10">
                    <input type="text" name="street2" id="street2" class="form-control" value="">
                </div>
            </div>

            <div class="form-group">
                <label for="zip" class="col-sm-2 control-label">Zip-Code <span class="text-danger">*</span></label>
                <div class="col-sm-2">
                    <input type="text" name="zip" id="zip" class="form-control" value="12345" required>
                </div>
                <label for="city" class="col-sm-2 control-label">City <span class="text-danger">*</span></label>
                <div class="col-sm-6">
                    <input type="text" name="city" id="city" class="form-control" value="Gordon City" required>
                </div>
            </div>

            <div class="form-group">
                <label for="country" class="col-sm-2 control-label">Country <span class="text-danger">*</span></label>
                <div class="col-sm-10">
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
            </div>

            <div class="form-group">
                <label for="telephone" class="col-sm-2 control-label">Telephone</label>
                <div class="col-sm-10">
                    <input type="text" name="telephone" id="telephone" class="form-control" value="123-456789">
                </div>
            </div>

            <div class="form-group">
                <label for="email" class="col-sm-2 control-label">Email <span class="text-danger">*</span></label>
                <div class="col-sm-10">
                    <input type="text" name="email" id="email" class="form-control" value="john.doe@example.com" required>
                </div>
            </div>
        </fieldset>
    </div>

    <div class="col-sm-8 col-sm-offset-2 text-right">
        <a class="btn btn-primary" href="{{ url('/checkout/confirm') }}">Checkout Confirmation
            <span class="glyphicon glyphicon-forward" aria-hidden="true"></span>
        </a>
    </div>
</div>
@endsection