<?php

namespace App\Repositories;

interface IOrderRepository
{
    public function findAll();

    public function store(array $attributes);

    public function show($id, $year, $month, $day);
}
