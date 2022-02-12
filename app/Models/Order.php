<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
    // use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'user_id',
        'pizza_id',
        'no_of_order',
        'total_amount',
    ];

    // One to One Relationship using Eloquent ORM
    public function userrelation() {
        return $this->hasOne(User::class,'id', 'user_id');
    }

    public function pizzarelation() {
        return $this->hasOne(Pizza::class,'id', 'pizza_id');
    }
}
