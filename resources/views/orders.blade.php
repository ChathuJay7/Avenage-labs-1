@extends('main')
@section('content')

<div class="container">
    <div class="text-center my-5">
        <h1 class="mx-auto text-center">Orders</h1>
    </div>

    <table class="table">
        <thead>
            <tr>
                <th scope="col">Customer Name</th>
                <th scope="col">Main Dish</th>
                <th scope="col">Side Dish</th>
                <th scope="col">Dessert</th>
                <th scope="col">Total Price</th>
            </tr>
        </thead>
        <tbody>
            @foreach($orders as $order)
                <tr>
                    <td>{{ $order->name }}</td>
                    <td>{{ $order->maindish->main_dish }}</td>
                    <td>{{ $order->sidedish->side_dish}}</td>
                    <td>{{ $order->dessert ? $order->dessert->dessert : 'N/A' }}</td>
                    <td>{{ $order->total_price }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

@endsection
