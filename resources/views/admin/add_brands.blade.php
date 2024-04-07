@extends('admin.layout')
@section('content')
<main>
    <div class="container-fluid px-4">
        <h1 class="mt-4">Brand</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
            <li class="breadcrumb-item active">Brands</li>
        </ol>
        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-table me-1"></i>
                    Add Brand
            </div>
            <div class="card-body">
                <div class="album py-5" style="height:120vh">
                    <div class="row h-100 justify-content-center align-items-center">
                        <div class="card border-success" style="max-width: 65rem;padding: 2%;">

                            <div class="row mb-3">
                                <div class="col">
                                    <h2> Add Brand </h2>
                                </div>
                            </div>
                            {{-- validation error message --}}
                            @if($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                            <hr>
                            <div class="card-body">
                                {{-- enctype is decleared to upload image other wise image wont upload --}}
                                <form method="POST" action="{{ route('brand.store') }}" enctype="multipart/form-data">
                                    @csrf
                                    <div class="row mb-3">
                                        <div class="col">
                                            <label for="name" class="form-label">Name</label>
                                            <input type="text" class="form-control" id="name" name="name" placeholder="Seiko"
                                                required="">
                                        </div>
                                    <div class="row mb-3">
                                        <div class="col">
                                            <label for="description" class="form-label">Description</label>
                                            <textarea class="form-control" id="description" rows="3" name="description"
                                                    placeholder="description" required=""></textarea>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col">
                                            <label for="image" class="form-label">Image</label><br>
                                            <input type="file" class="form-control-file" name="image" id="image">
                                        </div>
                                    </div>
                                    <br>
                                    <div class="mb-3">
                                        <input type="submit" name="add" id="add" value="Add" class="btn btn-primary">
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
@endsection
