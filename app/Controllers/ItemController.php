<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ItemModel;
use CodeIgniter\HTTP\ResponseInterface;
use Config\Services;
use Hermawan\DataTables\DataTable;

class ItemController extends BaseController
{
    protected $encryption;

    public function __construct()
    {
        $this->encryption = Services::encrypter();
    }

    public function index()
    {
        if ($this->request->isAJAX()) {
            $data = new ItemModel();
            $data->where('active', 1);

            return DataTable::of($data)
                ->addNumbering('no')
                ->add('action', function ($row) {
                    $encryptedId = $this->encryption->encrypt($row->id);
                    $urlSafeId = strtr(base64_encode($encryptedId), '+/=', '-_?');

                    $btn = '<div class="btn-group" role="group" aria-label="Action">';
                    $btn .= '<button type="button" class="btn btn-warning btn-sm editButton" data-id="' . $urlSafeId . '" data-name="' . $row->name . '" data-price="' . $row->price . '" title="Edit Data"><i class="fas fa-edit"></i></button>';
                    $btn .= '<button type="button" class="btn btn-danger btn-sm deleteButton" data-id="' . $urlSafeId . '" title="Delete Data"><i class="fas fa-trash"></i></button>';
                    $btn .= '</div>';
                    return $btn;
                })
                ->toJson(true);
        } else {
            $title = 'Item';

            return view('item/index', compact('title'));
        }
    }

    public function store()
    {
        $rules = [
            'name' => 'required|is_unique[items.name,active,0]',
            'price' => 'required'
        ];

        if (!$this->validate($rules)) {
            $errors = $this->validator->getErrors();
            $errors = implode(',', $errors);
            return redirect()->to(site_url('item'))->with('errors', $errors);
        }

        $data = [
            'name' => $this->request->getPost('name'),
            'price' => $this->request->getPost('price'),
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ];

        $model = new ItemModel();
        $model->insert($data);

        return redirect()->to(site_url('item'))->with('success', 'Data has been saved');
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
            'name' => 'required|is_unique[items.name,id,' . $id . ']',
            'price' => 'required'
        ];

        if (!$this->validate($rules)) {
            $errors = $this->validator->getErrors();
            $errors = implode(',', $errors);
            return redirect()->to(site_url('item'))->with('errors', $errors);
        }

        $data = [
            'name' => $this->request->getPost('name'),
            'price' => $this->request->getPost('price'),
            'updated_at' => date('Y-m-d H:i:s')
        ];

        $model = new ItemModel();
        $model->update($id, $data);

        return redirect()->to(site_url('item'))->with('success', 'Data has been updated');
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

        $model = new ItemModel();
        $model->update($id, $data);

        return $this->response->setJSON(['success' => 'Data has been deleted']);
    }
}
