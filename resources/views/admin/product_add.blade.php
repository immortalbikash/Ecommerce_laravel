@extends('admin.layout')
@section('content')
<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">
            <h1 class="mt-4">Products</h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="products.html">Products</a></li>
                <li class="breadcrumb-item active">Add New Product</li>
            </ol>
            <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-table me-1"></i>
                    Add Product
                </div>
                @if($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach($errors->all() as $error)
                                <li> {{ $error }} </li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <div class="card-body">
                    <!-- Start col -->
                    <div class="album py-5" style="height:120vh;margin-top: -15%;margin-bottom: -15%;">
                        <div class="row h-100 justify-content-center align-items-center">
                            <div class="card border-success" style="max-width: 85rem;padding: 2%;">
                                <div class="card-body">
                                    <form method="POST" action="{{ route('product.store') }}"
                                          enctype="multipart/form-data">
                                          @csrf
                                        <div class="row mb-3">
                                            <div class="col">
                                                <label for="name" class="form-label">Product Name</label>
                                                <input type="text" class="form-control" id="name" name="name"
                                                       placeholder="Titan Watch"
                                                       required="">
                                            </div>
                                            <div class="col">
                                                <label for="price" class="form-label">Price</label>
                                                <input type="text" class="form-control" id="price" name="price"
                                                       placeholder="15000"
                                                       required="">
                                            </div>
                                            <div class="col">
                                                <label for="sale_price" class="form-label">Sale Price</label>
                                                <input type="text" class="form-control" id="sale_price"
                                                       name="sale_price"
                                                       placeholder="10000">
                                            </div>
                                            <div class="col">
                                                <label for="color" class="form-label">Color</label>
                                                <select class="form-select" id="color"
                                                        aria-label="Default select example"
                                                        required="" name="color">
                                                    @foreach(Config::get('colors') as $color)
                                                        <option value="{{ $color }}">{{ $color }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col">
                                                <label for="brand_id" class="form-label">Brand</label>
                                                <select class="form-select" id="brand_id"
                                                        aria-label="Default select example"
                                                        required="" name="brand_id">
                                                    @foreach ($brands as $brand)
                                                        <option value="{{ $brand->id }}">{{ $brand->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col">
                                                <label for="product_code" class="form-label">Product Code</label>
                                                <input type="text" class="form-control" id="product_code"
                                                       name="product_code"
                                                       placeholder="LV-123"
                                                       required="">
                                            </div>
                                            <div class="col">
                                                <label for="gender" class="form-label">Gender</label><br>
                                                <input type="radio" id="gender" name="gender" value="Male" checked>&nbsp;&nbsp;Male&nbsp;&nbsp;
                                                <input type="radio" id="gender" name="gender" value="Female">&nbsp;&nbsp;Female
                                                <input type="radio" id="gender" name="gender" value="Children">&nbsp;&nbsp;Children
                                                <input type="radio" id="gender" name="gender" value="Unisex">&nbsp;&nbsp;Unisex
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col-3">
                                                <label for="function" class="form-label">Function</label>
                                                <select class="form-select" id="function"
                                                        aria-label="Default select example"
                                                        required="" name="function">
                                                    @foreach(Config::get('watch_functions') as $value)  {{-- config bhitra watch_functions cha --}}
                                                        <option value="{{ $value }}">{{ $value }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-3">
                                                <label for="stock" class="form-label">Stock</label>
                                                <input type="number" class="form-control" id="stock" name="stock"
                                                       placeholder="100"
                                                       required="">
                                            </div>
                                            <div class="col">
                                                <label for="description" class="form-label">Description</label>
                                                <textarea class="form-control" id="description" rows="3"
                                                          name="description"
                                                          placeholder="description" required=""></textarea>
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col">
                                                <label for="image" class="form-label">Image</label><br>
                                                <input type="file" class="form-control-file" name="image"
                                                       id="image">
                                            </div>
                                        </div>
                                        <br>
                                        <div class="mb-3">
                                            <input type="submit" name="add_product" id="add_product"
                                                   value="Add Product"
                                                   class="btn btn-outline-success">
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
</div>

@endsection
