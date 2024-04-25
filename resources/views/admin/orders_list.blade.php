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
                All Users
                <a href="{{ route('admin_register_user') }}" class="btn btn-outline-primary btn-sm float-end"> + Add User</a>
            </div>
            <div class="card-body">
                <table id="datatablesSimple">
                    <thead>
                    <tr>
                        <th>Order ID</th>
                        <th>User Name</th>
                        <th>Sub Total</th>
                        <th>Tax Rate</th>
                        <th>Shipping</th>
                        <th>Tax Amount</th>
                        <th>Comment</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tfoot>
                    <tr>
                        <th>Order ID</th>
                        <th>User Name</th>
                        <th>Sub Total</th>
                        <th>Tax Rate</th>
                        <th>Shipping</th>
                        <th>Total Amount</th>
                        <th>Comment</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                    </tfoot>
                    <tbody>
                    @foreach ($orders as  $order)
                    <tr>
                        <td>{{ $order->id }}</td>
                        {{-- <td>@if($user->role_id == 0) User @else Admin @endif</td> --}}
                        <td>{{ $order->customerData->first_name }}</td>
                        <td>{{ $order->sub_total }}</td>
                        <td>{{ $order->tax_rate }}</td>
                        <td>{{ $order->shipping }}</td>
                        <td>{{ $order->tax_amount }}</td>
                        <td>{{ $order->comment }}</td>
                        <td>{{ $order->status }}</td>
                        <td style="max-width: 30px">
                            <form method="POST" action="{{ route('admin_change_order_status', ['id' => $order->id]) }}">
                                @csrf
                                <select class="form-select" id="status"
                                                        aria-label="Default select example"
                                                        required="" name="status">
                                                    @foreach(Config::get('order_status') as $order_status)
                                                        <option value="{{ $order_status }}" @if($order_status==$order->status) {{ 'selected' }}@endif>{{ $order_status }}</option>
                                                    @endforeach
                                                </select>
                                <input type="submit" class="btn btn-primary btn-sm" />
                            </form>
                            <a href="{{ route('get_line_items', ['id'=>$order->id]) }}" class="btn btn-sm btn-warning">View</a>
                            <a href="" class="btn btn-sm btn-danger">Delete</a>
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
