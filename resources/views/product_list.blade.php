@extends('layout_user')
@section('content')
<header class="bg-dark py-5">
    <div class="container px-4 px-lg-5 my-5">
        <div class="text-center text-white">
            <h1 class="display-4 fw-bolder">Shop in style</h1>
            <p class="lead fw-normal text-white-50 mb-0">With Mero Store</p>
        </div>
    </div>
</header>
<section class="py-5">
    <div class="container px-4 px-lg-5 mt-5">
        <div class="card box" style="width: 75rem;">
            <h5 class="card-header">FILTER BY</h5>
            <div class="card-body">
                <form name="search_by_detail" action="{{ route('product_list') }}" method="get" enctype="multipart/form-data">
                    <div class="form-row">
                        <div class="form-group col-md m-1">
                            <label><b>Gender:</b></label>
                            <select class="form-select" name="gender" id="gender" aria-label="gender filter">
                                <option selected disabled>Select</option>
                                <option value="male">Male</option>
                                <option value="female">Female</option>
                                <option value="children">Children</option>
                                <option value="children">Unisex</option>
                            </select>
                        </div>
                        <div class="form-group col-md m-1">
                            <label><b>Price:</b></label>
                            <select class="form-select" name="price" id="price" aria-label="price filter">
                                <option selected disabled>Select</option>
                                <option value="less_than_1500">Less than ₹1500</option>
                                <option value="between_1500_5k">₹1500 - ₹5000</option>
                                <option value="between_5k_10k">₹5000 - ₹10,000</option>
                                <option value="between_10k_30k">₹10,000 - ₹30,000</option>
                                <option value="greater_than_30k">More than ₹30,000</option>
                            </select>
                        </div>
                        <div class="form-group col-md m-1">
                            <label><b>Color:</b></label>
                            <select class="form-select" name="color" id="color" aria-label="color filter">
                                <option selected disabled>Select</option>
                                @foreach (Config::get('colors') as $value )
                                <option value="{{ $value }}">{{ $value }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-md m-1">
                            <label><b>Function:</b></label>
                            <select class="form-select" name="function" id="function" aria-label="function filter">
                                <option selected disabled>Select</option>
                                @foreach (Config::get('watch_functions') as $value )
                                <option value="{{ $value }}">{{ $value }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-md m-1">
                            <label><b>Brand:</b></label>
                            <select class="form-select" name="brand" id="brand" aria-label="brand filter">
                                <option selected disabled>Select</option>
                                @foreach ($brands as $brand)
                                <option value="{{ $brand->id }}">{{ $brand->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-md m-1">
                            <label><b>Sort By:</b></label>
                            <select class="form-select" name="sort_by" id="sort_by" aria-label="sort filter">
                                <option selected disabled>Select</option>
                                <option value="lower_to_higher">Price Lower to Higher</option>
                                <option value="higher_to_lower">Price Higher to Lower</option>
                                <option value="model_a_z">Model (A-Z)</option>
                                <option value="model_z_a">Model (Z-A)</option>
                            </select>
                        </div>
                    </div>
                    <div class="text-center mt-3">
                        <input type="submit" class="btn btn-success btn-sm" name="search" value="Search" id="search"
                               style="width:8rem;color: #ffffff">
                        <input type="reset" class="btn btn-warning btn-sm" name="reset_filters" value="Clear Filters" id="reset_filters"
                               style="width:8rem;color: #ffffff">
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
<!-- Section-->

<section class="py-5">
    <div class="container px-4 px-lg-5 mt-5">
        <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center">

            @foreach ($products as $product)
<div class="col mb-5">
<div class="card h-100">
{{-- sale batch --}}
{{-- @if ($product->sale_price < $product->price )
<div class="badge bg-dark text-white position-absolute" style="top: 0.5rem; right: 0.5 rem">Sale </div>
@endif --}}
@if ($product->stock == 0)
<div class="badge bg-danger text-white position-absolute" style="top:0.5rem; right: 0.5rem">Out of stock</div>
@elseif ($product->stock <1000)
<div class="badge bg-danger text-white position-absolute" style="top:0.5rem; right: 0.5rem">Low stock</div>
@endif

<!-- Product image-->
<img class="card-img-top" src="{{ $product->image }}" alt="product image"/>
{{-- if image local ma bhako bhaye --}}
{{-- <img class="card-img-top" src="{{ url('/products') . '/' .$product->image }}" alt="product image"/> --}}
<!-- Product details-->
<div class="card-body p-4">
<div class="text-center">
<!-- Product name-->
<h5 class="fw-bolder">{{ $product->name }}</h5>
<!-- Product price-->
<span class="text-muted text-decoration-line-through">NPR {{ $product->price }}</span>
NPR {{ $product->sale_price }}
</div>
</div>
<!-- Product actions-->
<div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
<div class="text-center"><a class="btn btn-outline-dark mt-auto" href="{{ route('productInfo', ['id' => $product->product_code]) }}">View Product</a></div>
</div>
</div>
</div>
@endforeach
            {{-- products bhaneko compact bata pathako ho --}}
            {!! $products->links() !!}
            {{-- app/providers/appserrviceprovider ma jane ani boot ma code lekhne for bootstrap --}}

        </div>
    </div>
</section>
<!------ Store Locator ------->
<section class="bg-light py-5">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <iframe
                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3671.957106553375!2d72.55422921489071!3d23.025347084951655!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x395e84f9f38dec53%3A0xf88c617eb48b0674!2sChimanlal%20Girdharlal%20Rd%2C%20Ellisbridge%2C%20Ahmedabad%2C%20Gujarat!5e0!3m2!1sen!2sin!4v1647644630959!5m2!1sen!2sin"
                    width="600" height="300" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
            </div>
            <div class="col-md-6 float-end">
                <h3>Mero Store</h3>
                <hr>
                <table class="table table-borderless table-condensed">
                    <tbody>
                    <tr>
                        <td style="width: 16.66%"><i class="fa fa-whatsapp" aria-hidden="true"></i>&nbsp;Mobile</td>
                        <td style="width: 2.66%">:</td>
                        <td><a href="http://wa.me/8849004643" target="_blank" style="color: black;">+977-1234567891</a>
                        </td>
                    </tr>
                    <tr>
                        <td><i class="fa fa-envelope" aria-hidden="true"></i>&nbsp;Email</td>
                        <td>:</td>
                        <td><a href="mailto:info@learnvern.com"
                               style="color: black;">store@test.com</a></td>
                    </tr>
                    <tr>
                        <td><i class="fa fa-map-marker" aria-hidden="true"></i>&nbsp;Address</td>
                        <td>:</td>
                        <td>Mero Store, <br>
                            Nilopul Ashari/Dharan Road <br>
                            Gaighat, Udayapur, <br>
                            Nepal
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</section>
@endsection

@section('css')
<style>
    .form-group {
        margin-bottom: 1rem;
    }

    .form-inline .form-control {
        display: inline-block;
        width: auto;
        vertical-align: middle;
    }

    .form-row {
        display: flex;
        flex-wrap: wrap;
        margin-right: -5px;
        margin-left: -5px;
    }

    label {
        margin-bottom: 0.5rem;
    }
</style>
