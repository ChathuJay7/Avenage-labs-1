@extends('main')
@section("content")

<div class="container ">
    <div class="text-center my-5">
        <h1 class="mx-auto text-center">Place an order</h1>
    </div>

    @if(session('success'))
        <div id="successMessage" class="alert alert-success">
            {{ session('success') }}
        </div>
        <script>
            // Hide success message after 5 seconds
            setTimeout(function () {
                document.getElementById('successMessage').style.display = 'none';
            }, 5000);
        </script>
    @endif

    <div class="mx-auto text-center mb-10" ><h5 id="totalPrice">Total Price: Rs. 0.00</h5></div>

    <form action="/store" method="post">
        @csrf
        <div class="mb-3">
            <label for="name" class="form-label">Customer Name</label>
            <input type="text" class="form-control" id="name" name="name" required>
        </div>
        <div class="mb-3">
            <label for="main_dish" class="form-label">Main Dish</label>
            <select class="form-select" id="main_dish" name="main_dish" required onchange="calculateTotal()">
                <option value="" selected>Select Main Dish</option>
                @foreach($mainDishes as $mainDish)
                    <option value="{{ $mainDish->id }}|{{ $mainDish->price }}" >{{ $mainDish->main_dish }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label for="side_dish" class="form-label">Side Dish</label>
            <select class="form-select" id="side_dish" name="side_dish" required onchange="calculateTotal()">
                <option value="" selected>Select Side Dish</option>
                @foreach($sideDishes as $sideDish)
                    <option value="{{ $sideDish->id }}|{{ $sideDish->price }}">{{ $sideDish->side_dish }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label for="dessert" class="form-label">Dessert (Optional)</label>
            <select class="form-select" id="dessert" name="dessert" onchange="calculateTotal()">
                <option value="" selected>Select Dessert</option>
                @foreach($desserts as $dessert)
                    <option value="{{ $dessert->id }}|{{ $dessert->price }}">{{ $dessert->dessert }}</option>
                @endforeach
            </select>
        </div>

        <script>
            function calculateTotal() {

                console.log("Function called");

                // Get selected values
                var mainDishValue = document.getElementById('main_dish').value.split('|');
                var sideDishValue = document.getElementById('side_dish').value.split('|');
                var dessertValue = document.getElementById('dessert').value.split('|');


                var mainDishPrice = parseFloat(mainDishValue[1]) || 0;
                var sideDishPrice = parseFloat(sideDishValue[1]) || 0;
                var dessertPrice = parseFloat(dessertValue[1]) || 0;
        
                // Calculate total price
                var totalPrice = mainDishPrice + sideDishPrice + dessertPrice;
        
                document.getElementById('totalPrice').innerHTML = '<h5>Total Price: Rs. ' + totalPrice.toFixed(2) + '</h5>';
                
            }
        </script>

        <button type="submit" class="btn btn-primary">Submit Order</button>
    </form>

    
</div>
@endsection