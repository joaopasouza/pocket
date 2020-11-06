<?php

namespace App\Http\Controllers;

use App\Order;
use App\Repositories\IOrderRepository;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    private $orderRepository;

    public function __construct(IOrderRepository $orderRepository)
    {
        $this->orderRepository = $orderRepository;
    }

    public function index()
    {
        return $this->orderRepository->findAll();
    }
}
