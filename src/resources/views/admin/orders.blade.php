@extends('layouts.admin')

@section('dashboard-item-content')
    <div class="container">
        <h2>Orders</h2>

        <table class="table">
            <thead>
                <tr>
                    <th>Order number</th>
                    <th>Status</th>
                    <th>Total Amount</th>
                    <th>Payment Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($orders as $order)
                    <tr>
                        <td>{{ $order->order_number }}</td>
                        <td>{{ $order->status }}</td>
                        <td>{{ $order->total_amount }}</td>
                        <td>{{ $order->payment_status }}</td>
                        <td>
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#orderModal{{ $order->id }}">
                                View Items
                            </button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        @foreach($orders as $order)
            <div class="modal fade" id="orderModal{{ $order->id }}" tabindex="-1" role="dialog" aria-labelledby="orderModalLabel{{ $order->id }}" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="orderModalLabel{{ $order->id }}">Order Items</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Product Name</th>
                                        <th>Product Image</th>
                                        <th>Quantity</th>
                                        <th>Price</th>
                                        <th>Subtotal</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($order->orderItems as $orderItem)
                                        <tr>
                                            <td>{{ $orderItem->product->name }}</td>
                                            <td><img src="{{ $orderItem->product->image_url }}" alt="{{ $orderItem->product->name }}" width="30"></td>
                                            <td>{{ $orderItem->quantity }}</td>
                                            <td>{{ $orderItem->price }}</td>
                                            <td>{{ $orderItem->subtotal }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endsection
