<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Maindish extends Model
{
    use HasFactory;

    protected $table = 'main_dishes';

    protected $fillable = [
        'id',
        'main_dish',
        'price'
    ];

    public function users()
    {
        return $this->hasMany(Customer::class);
    }

}
