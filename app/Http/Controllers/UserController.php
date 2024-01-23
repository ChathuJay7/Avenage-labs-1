<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Maindish;
use App\Models\Sidedish;
use App\Models\Dessert;

use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display the place order page.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function index()
    {
        // Fetch main dishes, side dishes, and desserts from the database
        $mainDishes = Maindish::all();
        $sideDishes = Sidedish::all();
        $desserts = Dessert::all();

        return view('home', compact('mainDishes', 'sideDishes', 'desserts'));
    }

    public function store(Request $request)
    {
        // Validate the request
        $request->validate([
            'name' => 'required|string|max:255',
            'main_dish' => 'required|exists:main_dishes,id',
            'side_dish' => 'required|exists:side_dishes,id',
            'dessert' => 'nullable|exists:desserts,id',
        ]);

        // Calculate the total price
        $mainDish = Maindish::findOrFail($request->input('main_dish'));
        $sideDish = Sidedish::findOrFail($request->input('side_dish'));
        $dessert = $request->input('dessert') ? Dessert::findOrFail($request->input('dessert')) : null;

        $totalPrice = $mainDish->price + $sideDish->price + ($dessert ? $dessert->price : 0);

        // Create a new customer record
        Customer::create([
            'name' => $request->input('name'),
            'main_dish_id' => $mainDish->id,
            'side_dish_id' => $sideDish->id,
            'dessert_id' => $dessert ? $dessert->id : null,
            'total_price' => $totalPrice,
        ]);

        return redirect()->route('home')->with('success', 'Order placed successfully!');
    }
}
