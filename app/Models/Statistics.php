<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Statistics extends Model
{
    use HasFactory;

    protected $fillable = [
        'date', 
        'daily_sales_revenue', 
        'most_famous_main_dish_id', 
        'most_famous_side_dish_id'
    ];

    public function mostFamousMainDish()
    {
        return $this->belongsTo(Maindish::class, 'most_famous_main_dish_id');
    }

    public function mostFamousSideDish()
    {
        return $this->belongsTo(Sidedish::class, 'most_famous_side_dish_id');
    }
}
