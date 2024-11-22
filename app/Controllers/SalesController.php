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

            $data->select('sales.*, employees.name as employee_name, items.name as item_name')
                ->join('employees', 'employees.id = sales.id_employee', 'left')
                ->join('items', 'items.id = sales.id_item', 'left')
                ->where('sales.active', 1);

            if ($dateSpesific) {
                $data->where('order_date', $dateSpesific);
            } else {
                if ($dateStart) {
                    $data->where('order_date >=', $dateStart);
                }

                if ($dateEnd) {
                    $data->where('order_date <=', $dateEnd);
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

                    $employee = new EmployeeModel();
                    $employee->select('number')->where('id', $row->id_employee)->where('active', 1)->first();

                    $item = new ItemModel();
                    $item->select('name')->where('id', $row->id_item)->where('active', 1)->first();

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
            $employee->select('number, name')->where('active', 1);
            $item = new ItemModel();
            $item->select('name, price')->where('active', 1);
            $data['employee'] = $employee->findAll();
            $data['item'] = $item->findAll();

            return view('sales/index', compact('title', 'data'));
        }
    }

    public function store()
    {
        $rules = [
            'client' => 'required|is_unique[sales.id_client,active,0]',
            'employee' => 'required',
            'item' => 'required',
            'order_date' => 'required',
            'client_name' => 'required',
            'client_email' => 'required',
            'client_phone' => 'required'
        ];

        if (!$this->validate($rules)) {
            $errors = $this->validator->getErrors();
            $errors = implode(',', $errors);
            return redirect()->to(site_url('sales'))->with('errors', $errors);
        }

        $employee = new EmployeeModel();
        $employee->select('id')->where('number', $this->request->getPost('employee'))->where('active', 1);
        $employee = $employee->first();
        if (!$employee) {
            return redirect()->to(site_url('sales'))->with('errors', 'Employee not found');
        }

        $item = new ItemModel();
        $item->select('id')->where('name', $this->request->getPost('item'))->where('active', 1);
        $item = $item->first();
        if (!$item) {
            return redirect()->to(site_url('sales'))->with('errors', 'Item not found');
        }

        $data = [
            'id_client' => $this->request->getPost('client'),
            'id_employee' => $employee,
            'id_item' => $item,
            'order_date' => $this->request->getPost('order_date'),
            'client_name' => $this->request->getPost('client_name'),
            'client_email' => $this->request->getPost('client_email'),
            'client_phone' => $this->request->getPost('client_phone'),
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ];

        $model = new SalesModel();
        $model->insert($data);

        return redirect()->to(site_url('sales'))->with('success', 'Data has been saved');
    }

    public function edit($urlSafeId)
    {
        $base64Id = strtr($urlSafeId, '-_=', '+/?');
        $decodedId = base64_decode($base64Id);

        $id = $this->encryption->decrypt($decodedId);

        if ($id === false) {
            return $this->response->setJSON(['error' => 'Invalid ID']);
        }

        $model = new SalesModel();
        $data = $model->select('id_client, id_employee, id_item, order_date, client_name, client_email, client_phone')->where('id', $id)->where('active', 1)->first();

        if (!$data) {
            return $this->response->setJSON(['error' => 'Data not found']);
        }

        $employee = new EmployeeModel();
        $data['employee'] = $employee->select('number')->where('id', $data['id_employee'])->where('active', 1)->first();
        $item = new ItemModel();
        $data['item'] = $item->select('name, price')->where('id', $data['id_item'])->where('active', 1)->first();

        return $this->response->setJSON($data);
    }

    public function update($urlSafeId)
    {
        $base64Id = strtr($urlSafeId, '-_=', '+/?');
        $decodedId = base64_decode($base64Id);

        $id = $this->encryption->decrypt($decodedId);

        if ($id === false) {
            return $this->response->setJSON(['error' => 'Invalid ID']);
        }

        $rules = [
            'client' => 'required|is_unique[sales.id_client,id,' . $id . ']',
            'employee' => 'required',
            'item' => 'required',
            'order_date' => 'required',
            'client_name' => 'required',
            'client_email' => 'required',
            'client_phone' => 'required'
        ];

        if (!$this->validate($rules)) {
            $errors = $this->validator->getErrors();
            $errors = implode(',', $errors);
            return redirect()->to(site_url('sales'))->with('errors', $errors);
        }

        $employee = new EmployeeModel();
        $employee->select('id')->where('number', $this->request->getPost('employee'))->where('active', 1);
        $employee = $employee->first();
        if (!$employee) {
            return redirect()->to(site_url('sales'))->with('errors', 'Employee not found');
        }

        $item = new ItemModel();
        $item->select('id')->where('name', $this->request->getPost('item'))->where('active', 1);
        $item = $item->first();
        if (!$item) {
            return redirect()->to(site_url('sales'))->with('errors', 'Item not found');
        }

        $data = [
            'id_client' => $this->request->getPost('client'),
            'id_employee' => $employee,
            'id_item' => $item,
            'order_date' => $this->request->getPost('order_date'),
            'client_name' => $this->request->getPost('client_name'),
            'client_email' => $this->request->getPost('client_email'),
            'client_phone' => $this->request->getPost('client_phone'),
            'updated_at' => date('Y-m-d H:i:s')
        ];

        $model = new SalesModel();
        $model->update($id, $data);

        return redirect()->to(site_url('sales'))->with('success', 'Data has been updated');
    }

    public function delete($urlSafeId)
    {
        $base64Id = strtr($urlSafeId, '-_=', '+/?');
        $decodedId = base64_decode($base64Id);

        $id = $this->encryption->decrypt($decodedId);

        if ($id === false) {
            return $this->response->setJSON(['error' => 'Invalid ID']);
        }

        $data = [
            'active' => 0,
            'updated_at' => date('Y-m-d H:i:s')
        ];

        $model = new SalesModel();
        $model->update($id, $data);

        return $this->response->setJSON(['success' => 'Data has been deleted']);
    }
}
