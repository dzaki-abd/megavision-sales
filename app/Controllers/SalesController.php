<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\EmployeeModel;
use App\Models\ItemModel;
use App\Models\SalesModel;
use CodeIgniter\HTTP\ResponseInterface;
use Config\Services;
use Hermawan\DataTables\DataTable;

class SalesController extends BaseController
{
    protected $encryption;

    public function __construct()
    {
        $this->encryption = Services::encrypter();
    }

    public function index()
    {
        if ($this->request->isAJAX()) {
            $dateStart = $this->request->getGet('dateStart');
            $dateEnd = $this->request->getGet('dateEnd');
            $data = new SalesModel();

            if ($dateStart && $dateEnd) {
                $data = $data->where('order_date >=', $dateStart)
                    ->where('order_date <=', $dateEnd);
            } elseif ($dateStart) {
                $data = $data->where('order_date >=', $dateStart);
            } elseif ($dateEnd) {
                $data = $data->where('order_date <=', $dateEnd);
            }

            return DataTable::of($data)
                ->addNumbering('no')
                ->add('employee', function ($row) {
                    $employee = new EmployeeModel();
                    $employeeData = $employee->where('id', $row->id_employee)->first();

                    return $employeeData ? $employeeData['name'] : null;
                })
                ->add('item', function ($row) {
                    $item = new ItemModel();
                    $itemData = $item->where('id', $row->id_item)->first();

                    return $itemData ? $itemData['name'] : null;
                })
                ->add('order_date', function ($row) {
                    $date = date_create($row->order_date);

                    return date_format($date, 'd F Y');
                })
                ->add('action', function ($row) {
                    $encryptedId = $this->encryption->encrypt($row->id);
                    $urlSafeId = strtr(base64_encode($encryptedId), '+/=', '-_?');

                    $btn = '<div class="btn-group" role="group" aria-label="Action">';
                    $btn .= '<button type="button" class="btn btn-warning btn-sm editButton" data-id="' . $urlSafeId . '" title="Edit Data"><i class="fas fa-edit"></i></button>';
                    $btn .= '<button type="button" class="btn btn-danger btn-sm deleteButton" data-id="' . $urlSafeId . '" title="Delete Data"><i class="fas fa-trash"></i></button>';
                    $btn .= '</div>';
                    return $btn;
                })
                ->toJson(true);
        } else {
            $title = 'Sales';

            $employee = new EmployeeModel();
            $item = new ItemModel();
            $data['employee'] = $employee->findAll();
            $data['item'] = $item->findAll();

            return view('sales/index', compact('title', 'data'));
        }
    }
}
