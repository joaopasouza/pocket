<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table = 'orders';

    protected $fillable = [
        'customer_name',
        'created_at',
    ];

    public $timestamps = false;

    public function orderProduct()
    {
        return $this->hasMany(OrderProduct::class);
    }
}
