@extends('layout_user')
@section('content')
<header class="bg-dark py-5">
    <div class="container px-4 px-lg-5 my-5">
        <div class="text-center text-white">
            <h1 class="display-4 fw-bolder">Shop in style</h1>
            <p class="lead fw-normal text-white-50 mb-0">With LearnVern Store</p>
        </div>
    </div>
</header>
<!-- Section-->

<section class="py-5">
    <div class="container px-4 px-lg-5 mt-5">
        <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center">
            @foreach ($products as $product)
            <div class="col mb-5">
                <div class="card h-100">
                    {{-- sale batch --}}
                    @if ($product->sale_price < $product->price )
                    <div class="badge bg-dark text-white position-absolute" style="top: 0.5rem; right: 0.5 rem">Sale </div>
                    @endif
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
            <div class="d-grid gap-2 col-6 mx-auto">
                <a href="{{ route('product_list') }}" class="btn btn-outline-dark">View All</a>
            </div>

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
                <h3>LearnVern Store</h3>
                <hr>
                <table class="table table-borderless table-condensed">
                    <tbody>
                    <tr>
                        <td style="width: 16.66%"><i class="fa fa-whatsapp" aria-hidden="true"></i>&nbsp;Mobile</td>
                        <td style="width: 2.66%">:</td>
                        <td><a href="http://wa.me/8849004643" target="_blank" style="color: black;">+91-1234567891</a>
                        </td>
                    </tr>
                    <tr>
                        <td><i class="fa fa-envelope" aria-hidden="true"></i>&nbsp;Email</td>
                        <td>:</td>
                        <td><a href="mailto:info@learnvern.com"
                               style="color: black;">info@test.com</a></td>
                    </tr>
                    <tr>
                        <td><i class="fa fa-map-marker" aria-hidden="true"></i>&nbsp;Address</td>
                        <td>:</td>
                        <td>LearnVern Store, <br>
                            1001 ABC Complex, <br>
                            Chimanlal Girdharlal Rd, <br>
                            Ahmedabad, Gujarat, <br>
                            INDIA 380001
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</section>
@endsection
