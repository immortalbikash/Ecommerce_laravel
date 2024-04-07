@extends('admin.layout')
@section('content')
<main>
    <div class="container-fluid px-4">
        <h1 class="mt-4">Brands</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
            <li class="breadcrumb-item active">Brands</li>
        </ol>
        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-table me-1"></i>
                All Brands
                <a href="{{ route('brand.create') }}" class="btn btn-outline-primary btn-sm float-end"> + Add Brands</a>
            </div>
            <div class="card-body">
                <table id="datatablesSimple">
                    <thead>
                    <tr>
                        <th>Name</th>
                        <th>Image</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($brandList as  $brand)
                    <tr>
                        <td>{{ $brand->name }}</td>
                        <td><img src="{{ url('brands') . '/' .$brand->image }}" alt="{{ $brand->name }}" width="100"></td>
                        <td style="max-width: 30px">
                            <a href="{{ route('brand.edit', ['brand'=>$brand->id]) }}" class="btn btn-sm btn-info">Edit</a>
                            <form method="POST" action="{{ route('brand.destroy', ['brand'=>$brand->id]) }}">
                                @csrf
                                @method('DELETE')
                                <input type="submit" class="btn btn-danger" value="Delete"/>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</main>
@endsection
