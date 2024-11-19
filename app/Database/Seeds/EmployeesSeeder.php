<?php

namespace App\Database\Seeds;

use App\Models\EmployeeModel;
use CodeIgniter\Database\Seeder;

class EmployeesSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'id_employee' => 'S001',
                'name' => 'Martin Lloyd',
                'email' => 'martin.lloyd@office.com',
                'phone' => '+62 862-5031-53370',
                'office' => 'Jakarta',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'id_employee' => 'S002',
                'name' => 'John Hobson',
                'email' => 'john.hobson@office.com',
                'phone' => '+62 813-105-750',
                'office' => 'Jakarta',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'id_employee' => 'S003',
                'name' => 'Boris Baker',
                'email' => 'boris.baker@office.com',
                'phone' => '+62 866-541-918',
                'office' => 'Jakarta',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'id_employee' => 'S004',
                'name' => 'Margot Sinclair',
                'email' => 'margot.sinclair@office.com',
                'phone' => '+62 898-1644-343',
                'office' => 'Bogor',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'id_employee' => 'S005',
                'name' => 'Alessandra Fall',
                'email' => 'alessandra.fall@office.com',
                'phone' => '+62 828-806-332',
                'office' => 'Bogor',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'id_employee' => 'S006',
                'name' => 'Doug Callan',
                'email' => 'doug.callan@office.com',
                'phone' => '+62 881-180-462',
                'office' => 'Bogor',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'id_employee' => 'S007',
                'name' => 'Elisabeth Nanton',
                'email' => 'elisabeth.nanton@office.com',
                'phone' => '+62 853-3431-15623',
                'office' => 'Bandung',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'id_employee' => 'S008',
                'name' => 'Bob Carter',
                'email' => 'bob.carter@office.com',
                'phone' => '+62 853-255-099',
                'office' => 'Bandung',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'id_employee' => 'S009',
                'name' => 'Livia Roberts',
                'email' => 'livia.roberts@office.com',
                'phone' => '+62 889-648-234',
                'office' => 'Bandung',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'id_employee' => 'S010',
                'name' => 'Jane Bell',
                'email' => 'jane.bell@office.com',
                'phone' => '+62 898-9997-62059',
                'office' => 'Jakarta',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
        ];

        $model = new EmployeeModel();
        $model->insertBatch($data);
    }
}
