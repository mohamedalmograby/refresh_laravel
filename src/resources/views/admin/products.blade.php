@extends('layouts.admin')

@section('dashboard-item-content')
    <div class="container">
        <h2>Orders</h2>

        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Description</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Image</th>
                </tr>
            </thead>
            <tbody>
                @foreach($products as $product)
                    <tr>
                        <td>{{ $product->id }}</td>
                        <td>{{ $product->name }}</td>
                        <td>{{ $product->description }}</td>
                        <td>{{ $product->price }}</td>
                        <td>{{ $product->quantity }}</td>
                        <td><img src="{{$product->image_url}}" alt="" width="100"></td>
                    </tr>
                @endforeach
            </tbody>
        </table>

    </div>
@endsection
