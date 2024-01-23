<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'main_dish_id',
        'side_dish_id',
        'dessert_id',
        'total_price'
    ];

    public function maindish()
    {
        return $this->belongsTo(Maindish::class);
    }

    public function sidedish()
    {
        return $this->belongsTo(Sidedish::class);
    }

    public function dessert()
    {
        return $this->belongsTo(Dessert::class);
    }
}
