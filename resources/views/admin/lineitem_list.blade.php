@extends('admin.layout')
@section('content')
<main>
    <div class="container-fluid px-4">
        <h1 class="mt-4">Lineitems</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="{{ route('admin_home') }}">Dashboard</a></li>
            <li class="breadcrumb-item active">Lineitems</li>
        </ol>
        <div class="card mb-4">
            <div class="card-body">
                <table id="datatablesSimple">
                    <thead>
                    <tr>
                        <th>Order id</th>
                        <th>User Name</th>
                        <th>Product Name</th>
                        <th>Quantity</th>
                        <th>Price</th>
                        <th>Total price</th>
                    </tr>
                    </thead>
                    <tfoot>
                    <tr>
                        <th>Order id</th>
                        <th>User Name</th>
                        <th>Product Name</th>
                        <th>Quantity</th>
                        <th>Price</th>
                        <th>Total price</th>
                    </tr>
                    </tfoot>
                    <tbody>
                        @foreach ($order_data->lineitemsData as $lineitemData)
                            <tr>
                                <td>{{ $lineitemData->order_id }}</td>
                                <td>{{ $lineitemData->customerData->first_name }}</td>
                                <td>{{ $lineitemData->productData->name }}</td>
                                <td>{{ $lineitemData->quantity }}</td>
                                <td>{{ $lineitemData->price }}</td>
                                <td>{{ $lineitemData->total_price }}</td>
                            </tr>
                            @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</main>
@endsection
