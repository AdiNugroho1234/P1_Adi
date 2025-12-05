<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'name',
        'phone',
        'email',
        'address',
        'city',
        'province',
        'postal_code',
        'country',
        'total',
        'status',
        'payment_method',
        'catatan'
    ];


    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }
}
