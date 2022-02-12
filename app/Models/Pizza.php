<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Pizza extends Model
{
    // use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'pizza_name',
        'pizza_image',
        'crust',
        'toppings',
        'price',
    ];
}
