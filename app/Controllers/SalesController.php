<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\EmployeeModel;
use App\Models\ItemModel;
use App\Models\SalesModel;
use CodeIgniter\HTTP\ResponseInterface;
use Config\Services;
use DateTime;
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
            $dateSpesific = $this->request->getGet('dateSpesific');
            $dateStart = $this->request->getGet('dateStart');
            $dateEnd = $this->request->getGet('dateEnd');
            $data = new SalesModel();

            $data = $data->select('sales.*, employees.name as employee_name, items.name as item_name')
                ->join('employees', 'employees.id = sales.id_employee', 'left')
                ->join('items', 'items.id = sales.id_item', 'left');

            if ($dateSpesific) {
                $data = $data->where('order_date', $dateSpesific);
            } else {
                if ($dateStart) {
                    $data = $data->where('order_date >=', $dateStart);
                }

                if ($dateEnd) {
                    $data = $data->where('order_date <=', $dateEnd);
                }
            }

            return DataTable::of($data)
                ->addNumbering('no')
                ->add('id_client', function ($row) {
                    return $row->id_client;
                })
                ->add('employee', function ($row) {
                    return $row->employee_name;
                })
                ->add('item', function ($row) {
                    return $row->item_name;
                })
                ->add('order_date', function ($row) {
                    $date = date_create($row->order_date);

                    return date_format($date, 'd F Y');
                })
                ->add('client_name', function ($row) {
                    return $row->client_name;
                })
                ->add('client_email', function ($row) {
                    return $row->client_email;
                })
                ->add('client_phone', function ($row) {
                    return $row->client_phone;
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

    public function delete($urlSafeId)
    {
        $base64Id = strtr($urlSafeId, '-_=', '+/?');
        $decodedId = base64_decode($base64Id);

        $id = $this->encryption->decrypt($decodedId);

        if ($id === false) {
            return $this->response->setJSON(['error' => 'Invalid ID']);
        }

        $model = new SalesModel();
        $model->delete($id);

        return $this->response->setJSON(['success' => 'Data has been deleted']);
    }
}
