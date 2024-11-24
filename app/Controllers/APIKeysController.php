<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\APIKeysModel;
use CodeIgniter\HTTP\ResponseInterface;

class APIKeysController extends BaseController
{
    public function index()
    {
        //
    }

    private function generateKey()
    {
        return bin2hex(random_bytes(32));
    }

    public function createApiKey()
    {
        $userId = $this->request->getVar('userId');
        $apiKey = $this->generateKey();
        $expiresAt = date('Y-m-d H:i:s', strtotime('+1 year'));

        $model = new APIKeysModel();
        $data = $model->where('user_id', $userId)->first();

        if ($data) {
            $model->update($data['id'], ['api_key' => $apiKey, 'expires_at' => $expiresAt, 'updated_at' => date('Y-m-d H:i:s')]);
        } else {
            $model->save([
                'user_id' => $userId,
                'api_key' => $apiKey,
                'expires_at' => $expiresAt,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ]);
        }

        return $this->response->setJSON(['success' => 'Here\'s Your API Keys', 'api_key' => $apiKey]);
    }

    public function showApiKey()
    {
        $userId = $this->request->getVar('userId');
        $model = new APIKeysModel();
        $data = $model->where('user_id', $userId)->first();

        $key = $data['api_key'];
        $expiresAt = date('d F Y', strtotime($data['expires_at']));

        if (!$data) {
            return $this->response->setJSON(['error' => 'Data not found']);
        }

        return $this->response->setJSON(['api_key' => $key, 'expires_at' => $expiresAt]);
    }
}
