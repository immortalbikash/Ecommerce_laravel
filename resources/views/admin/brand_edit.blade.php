@extends('admin.layout')
@section('content')
<div class="container h-100" style="margin: 7% 0% 7% 15%;">
    <h1 class="mt-4">Users</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
            <li class="breadcrumb-item active">Edit Brand</li>
        </ol>
    <div class="container-xl px-4 mt-4">
        <!-- Account page navigation-->
        <div class="row">
            <div class="col-xl-4">
                <!-- Profile picture card-->
                <div class="card mb-4 mb-xl-0">
                    <div class="card-header"><h5>Brand Picture</h5></div>
                    <div class="card-body text-center">
                        <!-- Profile picture image-->
                        <img class="img-account-profile rounded-circle mb-2"
                             src="{{ url('brands') . '/' .$brand->image }}" alt="profile pic" style="width: 250px; height: 250px;">
                        <!-- Profile picture help block-->
                        <div class="small font-italic text-muted mb-4">JPG or PNG no larger than 5 MB</div>
                        <form method="POST" action="{{ route('admin_brand_image_change', ['id' =>$brand->id]) }}" enctype="multipart/form-data">
                            @csrf
                        <!-- Profile picture upload button-->
                            <input type="file" class="form-control" id="image" name="image" placeholder="brand image">
                            <input type="submit" name="update" id="update" value="Update Profile Image"
                            class="btn btn-outline-primary mt-2">
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-xl-8">
                <!-- Account details card-->
                <div class="card mb-4">
                    <div class="card-header"><h5>Brand Details</h5></div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('brand.update', ['brand'=>$brand->id]) }}" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="row mb-3">
                                <div class="col">
                                    <label for="name" class="form-label">Name</label>
                                    <input type="text" class="form-control" id="name" name="name"
                                           required="" value="{{ $brand->name }}">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col">
                                    <label for="description" class="form-label">Description</label>
                                    <textarea class="form-control" id="description" rows="3" name="description"
                                              placeholder="address" required="">{{ $brand->description }}</textarea>
                                </div>
                            </div>
                            <br>
                            <div class="mb-3">
                                <input type="submit" name="update" id="update" value="Update Brand"
                                       class="btn btn-outline-primary">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
