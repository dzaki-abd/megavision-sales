<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\EmployeeModel;
use CodeIgniter\HTTP\ResponseInterface;
use Hermawan\DataTables\DataTable;
use Config\Services;

class EmployeeController extends BaseController
{
    protected $encryption;

    public function __construct()
    {
        $this->encryption = Services::encrypter();
    }

    public function index()
    {
        if ($this->request->isAJAX()) {
            $data = new EmployeeModel();

            $data->select('id_employee, name, email, phone, office');

            return DataTable::of($data)
                ->addNumbering('no')
                ->add('action', function ($row) {
                    $encryptedId = $this->encryption->encrypt($row->id_employee);
                    $urlSafeId = strtr(base64_encode($encryptedId), '+/=', '-_?');

                    $btn = '<div class="btn-group" role="group" aria-label="Action">';
                    $btn .= '<button type="button" class="btn btn-warning btn-sm editButton" data-id="' . $urlSafeId . '" title="Edit Data"><i class="fas fa-edit"></i></button>';
                    $btn .= '<button type="button" class="btn btn-danger btn-sm deleteButton" data-id="' . $urlSafeId . '" title="Delete Data"><i class="fas fa-trash"></i></button>';
                    $btn .= '</div>';
                    return $btn;
                })
                ->toJson(true);
        } else {
            return view('employee/index');
        }
    }

    public function store()
    {
        $rules = [
            'id_employee' => 'required|is_unique[employees.id_employee]',
            'name' => 'required',
            'email' => 'required|valid_email',
            'phone' => 'required',
            'office' => 'required'
        ];

        if (!$this->validate($rules)) {
            $errors = $this->validator->getErrors();
            $errors = implode(',', $errors);
            return redirect()->to(site_url('employee'))->with('errors', $errors);
        }

        $data = [
            'id_employee' => $this->request->getPost('id_employee'),
            'name' => $this->request->getPost('name'),
            'email' => $this->request->getPost('email'),
            'phone' => $this->request->getPost('phone'),
            'office' => $this->request->getPost('office')
        ];

        $model = new EmployeeModel();
        $model->insert($data);

        return redirect()->to(site_url('employee'))->with('success', 'Data has been saved');
    }

    public function edit($urlSafeId)
    {
        $base64Id = strtr($urlSafeId, '-_=', '+/?');
        $decodedId = base64_decode($base64Id);

        $id = $this->encryption->decrypt($decodedId);

        if ($id === false) {
            return $this->response->setJSON(['error' => 'Invalid ID']);
        }

        $employeeModel = new EmployeeModel();
        $employee = $employeeModel->select('id_employee, name, email, phone, office')
            ->where('id_employee', $id)
            ->first();

        if (!$employee) {
            return $this->response->setJSON(['error' => 'Data not found']);
        }

        return $this->response->setJSON($employee);
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
            'id_employee' => 'required|is_unique[employees.id_employee,id_employee,' . $id . ']',
            'name' => 'required',
            'email' => 'required|valid_email',
            'phone' => 'required',
            'office_edit' => 'required'
        ];

        if (!$this->validate($rules)) {
            $errors = $this->validator->getErrors();
            $errors = implode(',', $errors);
            return redirect()->to(site_url('employee'))->with('errors', $errors);
        }

        $data = [
            'id_employee' => $this->request->getPost('id_employee'),
            'name' => $this->request->getPost('name'),
            'email' => $this->request->getPost('email'),
            'phone' => $this->request->getPost('phone'),
            'office' => $this->request->getPost('office_edit')
        ];

        $model = new EmployeeModel();
        $model->where('id_employee', $id)->set($data)->update();

        return redirect()->to(site_url('employee'))->with('success', 'Data has been updated');
    }

    public function delete($urlSafeId)
    {
        $base64Id = strtr($urlSafeId, '-_=', '+/?');
        $decodedId = base64_decode($base64Id);

        $id = $this->encryption->decrypt($decodedId);

        if ($id === false) {
            return $this->response->setJSON(['error' => 'Invalid ID']);
        }

        $model = new EmployeeModel();
        $model->where('id_employee', $id)->delete();

        return $this->response->setJSON(['success' => 'Data has been deleted']);
    }
}
