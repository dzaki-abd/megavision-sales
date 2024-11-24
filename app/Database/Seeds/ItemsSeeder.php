<?php

namespace App\Database\Seeds;

use App\Models\ItemModel;
use CodeIgniter\Database\Seeder;

class ItemsSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'name' => 'Item A',
                'price' => 200000,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'name' => 'Item B',
                'price' => 500000,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ]
        ];

        $model = new ItemModel();
        $model->insertBatch($data);
    }
}
