<?php


namespace App\Repositories;


use App\Order;
use App\OrderProduct;
use Illuminate\Support\Facades\DB;

class OrderRepository implements IOrderRepository
{
    public function findAll()
    {
        return Order::all();
    }

    public function store(array $attributes)
    {
        $order = Order::query()->create([
            'customer_name' => $attributes['customer_name'],
            'created_at' => date('Y-m-d h:i:s'),
        ]);

        $orderProduct = $order->orderProduct()->createMany($attributes['cart']);

        return [
            'data' => [
                'order' => $order,
                'products' => $orderProduct
            ]
        ];
    }

    public function show($id, $year, $month, $day)
    {

        $order = DB::table('orders')
            ->select([
                'orders.id',
                'orders.customer_name',
                DB::raw('sum(order_products.price * order_products.qty) AS total_order')
            ])
            ->join('order_products', 'orders.id', '=', 'order_products.order_id')
            ->where('orders.id', '=', $id)
            ->whereRaw('orders.created_at::date = ?', "$year-$month-$day")
            ->groupBy([
                'orders.id',
                'orders.customer_name'
            ])
            ->first();

        $products = DB::table('orders')
            ->select([
                'order_products.id',
                'order_products.product',
                'order_products.price',
                'order_products.qty'
            ])
            ->join('order_products', 'orders.id', '=', 'order_products.order_id')
            ->where('orders.id', '=', $id)
            ->get();

        return [
            'data' => [
                'order' => $order,
                'products' => $products,
            ]
        ];
    }
}
