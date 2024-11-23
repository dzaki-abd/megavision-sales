<?php

namespace App\Controllers;

use App\Models\ItemModel;
use App\Models\SalesModel;

class Home extends BaseController
{
    public function index(): string
    {
        $totalOrder = 0;
        $totalEarning = 0;

        $model = new SalesModel();
        $itemModel = new ItemModel();
        $model->where('active', 1);

        $totalOrder = $model->countAllResults();

        foreach ($model->findAll() as $row) {
            $price = $itemModel->find($row['id_item'])['price'];
            $totalEarning += $price;
        }

        $data = [
            'totalOrder' => $totalOrder,
            'totalEarning' => number_format($totalEarning, 0, ',', '.'),
        ];

        return view('index', compact('data'));
    }
}
