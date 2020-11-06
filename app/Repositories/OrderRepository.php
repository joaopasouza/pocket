<?php


namespace App\Repositories;


use App\Order;

class OrderRepository implements IOrderRepository
{
    public function findAll()
    {
        return Order::all();
    }
}
