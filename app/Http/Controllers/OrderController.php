<?php

namespace App\Http\Controllers;

use App\Order;
use App\OrderProduct;
use App\Repositories\IOrderRepository;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

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

    public function store(Request $request)
    {
        try {
            $body = $request->all();

            $validation = Validator::make($body, [
                'customer_name' => 'required',
                'cart.*.qty' => 'required',
                'cart.*.product' => 'required',
                'cart.*.price' => 'required',
            ]);

            if ($validation->fails()) {
                return response()->json([
                    'message' => 'Unprocessable Entity',
                    'errors' => $validation->errors(),
                ], 422);
            }

            $data = $this->orderRepository->store($body);
            return response()->json($data, 201);
        } catch (Exception $e) {
            return response()->json([
                'message' => $e->getMessage(),
            ], 500);
        }
    }

    public function show($id, $year, $month, $day)
    {
        $data = $this->orderRepository->show($id, $year, $month, $day);
        return response()->json($data);
    }
}
