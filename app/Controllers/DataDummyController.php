<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class DataDummyController extends BaseController
{
    private $url = 'https://dummyjson.com/users/?limit=10';

    public function getUsers()
    {
        $json_data = file_get_contents($this->url);
        $data['users'] = json_decode($json_data, true);

        return view('api_user', $data);
    }

    public function tambahUser()
    {
        $data = $this->request->getPost();
        $json_data = json_encode($data);
        return $this->response->setJSON($json_data);
    }

    public function perbaruiUser($id)
    {
        $client = \Config\Services::curlrequest();

        $newTitle = $this->request->getPost('title');

        $url = "https://dummyjson.com/users/{$id}";
        $data = [
            'title' => $newTitle,
        ];

        $response = $client->request('PUT', $url, [
            'headers' => ['Content-Type' => 'application/json'],
            'body' => json_encode($data),
        ]);

        if ($response->getStatusCode() == 200) {
            $data = $response->getBody();
            $result = json_decode($data, true);
            return $this->response->setJSON($result);
        } else {
            return $this->response->setStatusCode($response->getStatusCode())->setBody($response->getBody());
        }
    }

    public function hapusUser($id)
    {
        $client = \Config\Services::curlrequest();

        $url = "https://dummyjson.com/users/{$id}";

        $response = $client->delete($url);

        if ($response->getStatusCode() == 200) {
            $data = $response->getBody();
            $result = json_decode($data, true);
            return $this->response->setJSON($result);
        } else {
            return $this->response->setStatusCode($response->getStatusCode())->setBody($response->getBody());
        }
    }
}
