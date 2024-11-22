<?php

namespace App\Controllers;

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
    public function show($id = null)
    {
        $model = new SalesModel();
        $data = $model->find($id);

        if (!$data) {
            return $this->failNotFound('No data found with id ' . $id);
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

    public function getByEmployee($id = null)
    {
        $model = new SalesModel();
        $data = $model->where('id_employee', $id)->findAll();

        return $this->respond($data, ResponseInterface::HTTP_OK);
    }

    public function getByEmployeeAndItem($employeeId = null, $itemId = null)
    {
        $model = new SalesModel();
        $data = $model->where('id_employee', $employeeId)->where('id_item', $itemId)->findAll();

        return $this->respond($data, ResponseInterface::HTTP_OK);
    }
}
