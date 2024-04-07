@extends('admin.layout')
@section('content')
    <main>
        <div class="container h-100" style="margin: 7% 0% 7% 15%;">
            <h1 class="mt-4">Edit Product</h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item"><a href="{{ route('admin_home') }}">Dashboard</a></li>
                <li class="breadcrumb-item active">Products</li>
            </ol>
            <div class="container-xl px-4 mt-4">
                {{-- @if($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach($errors->all() as $error)
                                <li> {{ $error }} </li>
                            @endforeach
                        </ul>
                    </div>
            @endif --}}
            <!-- Account page navigation-->
                <div class="row">
                    <div class="col-xl-3">
                        <!-- image picture card-->
                        <div class="card mb-4 mb-xl-0">
                            <div class="card-header"><h5>Image</h5></div>
                            <div class="card-body text-center">
                                <!-- image picture image-->
                                <img class="img-account-image rounded-circle mb-2"
                                     src="{{ url('products') . '/' .$product->image }}" alt="Product image" width="200">
                                <!-- image picture help block-->
                                <div class="small font-italic text-muted mb-4">JPG or PNG no larger than 5 MB</div>
                                <form method="POST"
                                      action="{{ route('admin_product_image_change', ['product'=>$product->id]) }}"
                                      enctype="multipart/form-data">
                                    @csrf
                                    @method('POST')
                                    <div class="row mb-3">
                                        <div class="col">
                                            <input type="file" class="form-control" id="image" name="image"
                                                   placeholder="image">
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col">
                                            <input type="submit" name="update" id="update" value="Update image"
                                                   class="btn btn-outline-primary">
                                        </div>
                                    </div>
                                </form>

                            </div>
                        </div>
                    </div>
                    <div class="col-xl-9">
                        <!-- Account details card-->
                        <div class="card mb-4">
                            <div class="card-header"><h5>Product Details</h5></div>
                            <div class="card-body">
                                <form method="POST" action="{{ route('product.update', ['product'=>$product->id]) }}"
                                      enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')
                                    <div class="row mb-3">
                                        <div class="col">
                                            <label for="name" class="form-label">Product Name</label>
                                            <input type="text" class="form-control" id="name" name="name"
                                                   placeholder="Titan Watch" value="{{ $product->name }}"
                                                   required="">
                                        </div>
                                        <div class="col">
                                            <label for="price" class="form-label">Price</label>
                                            <input type="text" class="form-control" id="price" name="price"
                                                   placeholder="15000" value="{{ $product->price }}"
                                                   required="">
                                        </div>
                                        <div class="col">
                                            <label for="sale_price" class="form-label">Sale Price</label>
                                            <input type="text" class="form-control" id="sale_price"
                                                   name="sale_price" value="{{ $product->sale_price }}"
                                                   placeholder="10000">
                                        </div>
                                        <div class="col">
                                            <label for="color" class="form-label">Color</label>
                                            <input type="text" class="form-control" id="color" name="color"
                                                   placeholder="Rose Gold" value="{{ $product->color }}"
                                                   required="">
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col">
                                            <label for="Product_id" class="form-label">Brand</label>
                                            <select class="form-select" id="brand_id"
                                                    aria-label="Default select example"
                                                    required="" name="brand_id">
                                                @foreach($brands as $brand)
                                                    <option value="{{ $brand->id }}" @if($brand->name == $brand->id) selected @endif >{{ $brand->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col">
                                            <label for="product_code" class="form-label">Product Code</label>
                                            <input type="text" class="form-control" id="product_code"
                                                   name="product_code"
                                                   placeholder="LV-123" value="{{ $product->product_code }}"
                                                   required="">
                                        </div>
                                        <div class="col">
                                            <label for="gender" class="form-label">Gender</label><br>
                                            <input type="radio" id="gender" name="gender" value="Male" @if($product->gender == 'Male') checked @endif>&nbsp;&nbsp;Male&nbsp;&nbsp;
                                            <input type="radio" id="gender" name="gender" value="Female"  @if($product->gender == 'Female') checked @endif >&nbsp;&nbsp;Female
                                            <input type="radio" id="gender" name="gender" value="Children" @if($product->gender == 'Children') checked @endif>&nbsp;&nbsp;Children
                                            <input type="radio" id="gender" name="gender" value="Unisex" @if($product->gender == 'Unisex') checked @endif>&nbsp;&nbsp;Unisex
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-3">
                                            <label for="function" class="form-label">Function</label>
                                            <select class="form-select" id="function"
                                                    aria-label="Default select example"
                                                    required="" name="function">
                                                {{-- @foreach (Config::get('watch_functions') as $value)
                                                    <option value="{{ $value }}" @if($value == $product->funtion) {{ 'selected' }} @endif>{{ $value }}</option>
                                                @endforeach --}}
                                                @foreach(Config::get('watch_functions') as $value)
                                                    <option value="{{ $value }}" @if($value == $product->function) {{ 'selected' }} @endif>{{ $value }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-3">
                                            <label for="stock" class="form-label">Stock</label>
                                            <input type="number" class="form-control" id="stock" name="stock"
                                                   placeholder="100" value="{{ $product->stock }}"
                                                   required="">
                                        </div>
                                        <div class="col">
                                            <label for="description" class="form-label">Description</label>
                                            <textarea class="form-control" id="description" rows="3"
                                                      name="description"
                                                      placeholder="description" required="">{{ $product->description }}</textarea>
                                        </div>
                                    </div>
                                    <br>
                                    <div class="mb-3">
                                        <input type="submit" name="update_product" id="update_product"
                                               value="Update Product"
                                               class="btn btn-outline-success">
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
