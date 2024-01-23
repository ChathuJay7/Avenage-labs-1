<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Maindish;
use App\Models\Sidedish;
use App\Models\Dessert;
use App\Models\Statistics;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
        try{
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

            return redirect()->back()->with('success', 'Order placed successfully!');

        } catch (Exception $e) {
            // Registration failed
            $response = [
                'message' => "Place order failed. Please try again.",
                'error' => $e->getMessage(),
            ];
    
            return redirect()->back()->withErrors($response);
        }
        
    }

    public function showOrders()
    {
        $orders = Customer::with(['maindish', 'sidedish', 'dessert'])->get();

        return view('orders', compact('orders'));
    }

    public function statistics()
    {
        $this->calculateStatistics();
        $statistics = Statistics::all();

        $mostFamousMainDishFromAllRecords = Customer::select('main_dish_id', DB::raw('count(main_dish_id) as count'))
            ->groupBy('main_dish_id')
            ->orderByDesc('count')
            ->first();

        $mostFamousSideDishFromAllRecords = Customer::select('side_dish_id', DB::raw('count(side_dish_id) as count'))
            ->groupBy('side_dish_id')
            ->orderByDesc('count')
            ->first();

        // Fetch the names of the most famous main dish and side dish
        $mostFamousMainDishName = Maindish::find($mostFamousMainDishFromAllRecords->main_dish_id)->main_dish ?? 'N/A';
        $mostFamousSideDishName = Sidedish::find($mostFamousSideDishFromAllRecords->side_dish_id)->side_dish ?? 'N/A';

        return view('statistics', compact('statistics', 'mostFamousMainDishName','mostFamousSideDishName'));
        
    }

    public function calculateStatistics()
    {
        $date = now()->toDateString(); // Change this based on your date format

        // Check if a record already exists for the current date
        $existingRecord = Statistics::where('date', $date)->first();

        $dailySalesRevenue = Customer::whereDate('created_at', $date)->sum('total_price');

        $mostFamousMainDish = Customer::whereDate('created_at', $date)
            ->select('main_dish_id', DB::raw('count(main_dish_id) as count'))
            ->groupBy('main_dish_id')
            ->orderByDesc('count')
            ->first();

        $mostFamousSideDish = Customer::whereDate('created_at', $date)
            ->select('side_dish_id', DB::raw('count(side_dish_id) as count'))
            ->groupBy('side_dish_id')
            ->orderByDesc('count')
            ->first();

        if ($existingRecord) {
            // If a record exists, update it
            $existingRecord->update([
                'daily_sales_revenue' => $dailySalesRevenue,
                'most_famous_main_dish_id' => $mostFamousMainDish->main_dish_id ?? null,
                'most_famous_side_dish_id' => $mostFamousSideDish->side_dish_id ?? null,
            ]);

            return redirect()->route('statistics.index');
        } else {
            // If no record exists, create a new one
            Statistics::create([
                'date' => $date,
                'daily_sales_revenue' => $dailySalesRevenue,
                'most_famous_main_dish_id' => $mostFamousMainDish->main_dish_id ?? null,
                'most_famous_side_dish_id' => $mostFamousSideDish->side_dish_id ?? null,
            ]);

            return redirect()->route('statistics.index');
        }
    }


}
