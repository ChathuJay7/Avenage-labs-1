<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dessert extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'dessert',
        'price'
    ];

    public function users()
    {
        return $this->hasMany(Customer::class);
    }
}
