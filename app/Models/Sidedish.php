<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sidedish extends Model
{
    use HasFactory;

    protected $table = 'side_dishes';

    protected $fillable = [
        'id',
        'side_dish',
        'price'
    ];

    public function users()
    {
        return $this->hasMany(Customer::class);
    }

}
