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
            $data = new SalesModel();

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
            $title = 'Sales';

            $employee = new EmployeeModel();
            $item = new ItemModel();
            $data['employee'] = $employee->findAll();
            $data['item'] = $item->findAll();

            return view('sales/index', compact('title', 'data'));
        }
    }
}
