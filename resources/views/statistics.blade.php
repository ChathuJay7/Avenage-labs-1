@extends('main')
@section('content')

<div class="container">
    <div class="text-center my-5">
        <h1 class="mx-auto text-center">Statistics</h1>
    </div>

    <div class="text-center mb-5">
        <div><h5>Most famouse Main dish: {{$mostFamousMainDishName}}</h5></div>
        <div><h5>Most famouse side dish: {{$mostFamousSideDishName}}</h5></div>
        <div><h5>Most famouse side dish with most famouse Main dish: {{$mostConsumedSideDishNameWithMostConsumedMainDish}}</h5></div>
    </div>

    <table class="table">
        <thead>
            <tr>
                <th>Date</th>
                <th>Daily Sales Revenue</th>
                <th>Most Famous Main Dish (Today)</th>
                <th>Most Famous Side Dish (Today)</th>
            </tr>
        </thead>
        <tbody>
            @foreach($statistics as $statistic)
                <tr>
                    <td>{{ $statistic->date }}</td>
                    <td>{{ $statistic->daily_sales_revenue }}</td>
                    <td>{{ $statistic->mostFamousMainDish->main_dish ?? 'N/A' }}</td>
                    <td>{{ $statistic->mostFamousSideDish->side_dish ?? 'N/A' }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

@endsection
