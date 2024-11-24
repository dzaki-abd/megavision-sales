<?php

namespace App\Controllers;

use App\Models\EmployeeModel;
use App\Models\ItemModel;
use App\Models\SalesModel;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\RESTful\ResourceController;

class SalesAPIController extends ResourceController
{
    /**
     * Return an array of resource objects, themselves in array format.
     *
     * @return ResponseInterface
     */
    public function index()
    {
        $model = new SalesModel();
        $data = $model->findAll();

        return $this->respond($data, ResponseInterface::HTTP_OK);
    }

    /**
     * Return the properties of a resource object.
     *
     * @param int|string|null $id
     *
     * @return ResponseInterface
     */
    public function show($clientId = null)
    {
        $model = new SalesModel();
        $data = $model->where('id_client', $clientId)->where('active', 1)->first();

        if (!$data) {
            return $this->failNotFound('No data found with client ' . $clientId);
        }

        return $this->respond($data, ResponseInterface::HTTP_OK);
    }

    /**
     * Return a new resource object, with default properties.
     *
     * @return ResponseInterface
     */
    public function new()
    {
        //
    }

    /**
     * Create a new resource object, from "posted" parameters.
     *
     * @return ResponseInterface
     */
    public function create()
    {
        //
    }

    /**
     * Return the editable properties of a resource object.
     *
     * @param int|string|null $id
     *
     * @return ResponseInterface
     */
    public function edit($id = null)
    {
        //
    }

    /**
     * Add or update a model resource, from "posted" properties.
     *
     * @param int|string|null $id
     *
     * @return ResponseInterface
     */
    public function update($id = null)
    {
        //
    }

    /**
     * Delete the designated resource object from the model.
     *
     * @param int|string|null $id
     *
     * @return ResponseInterface
     */
    public function delete($id = null)
    {
        //
    }

    public function getByEmployee($employeeNumber = null)
    {
        $employee = new EmployeeModel();
        $employeeData = $employee->where('number', $employeeNumber)->where('active', 1)->first();
        if (!$employeeData) {
            return $this->failNotFound('No data found with employee number ' . $employeeNumber);
        }
        $employeeId = $employeeData['id'];

        $model = new SalesModel();
        $data = $model->where('id_employee', $employeeId)->findAll();

        if (!$data) {
            return $this->failNotFound('No data found with employee ' . $employeeNumber);
        }

        return $this->respond($data, ResponseInterface::HTTP_OK);
    }

    public function getByEmployeeAndItem($employeeNumber = null)
    {
        $employee = new EmployeeModel();
        $employeeData = $employee->where('number', $employeeNumber)->where('active', 1)->first();
        if (!$employeeData) {
            return $this->failNotFound('No data found with employee number ' . $employeeNumber);
        }
        $employeeId = $employeeData['id'];

        $itemName = $this->request->getGet('name');
        $item = new ItemModel();
        $itemData = $item->where('name', $itemName)->first();
        if (!$itemData) {
            return $this->failNotFound('No data found with item name ' . $itemName);
        }
        $itemId = $itemData['id'];

        $model = new SalesModel();
        $data = $model->where('id_employee', $employeeId)->where('id_item', $itemId)->findAll();

        if (!$data) {
            return $this->failNotFound('No data found with employee ' . $employeeNumber . ' and item ' . $itemName);
        }

        return $this->respond($data, ResponseInterface::HTTP_OK);
    }
}
