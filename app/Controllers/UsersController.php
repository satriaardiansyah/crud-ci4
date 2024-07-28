<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Users;
use CodeIgniter\HTTP\ResponseInterface;

class UsersController extends BaseController
{
    public function index()
    {
        $user_model = new Users();
        $all_data_user = $user_model->findAll();
        return view('user', ['all_data_user' => $all_data_user]);
    }

    public function addUser()
    {
        $user_model = new Users();
        $data = [
            'name' => $this->request->getPost('name'),
            'email' => $this->request->getPost('email'),
            'alamat' => $this->request->getPost('alamat')
        ];
        $user_model->insert($data);
        $user_id = $user_model->getInsertID();

        return $this->response->setJSON(['id' => $user_id]);
    }

    public function editUserForm($id)
    {
        $user_model = new Users();
        $data['user'] = $user_model->find($id);
        $data['all_data_user'] = $user_model->findAll();

        return view('user', $data);
    }

    public function updateUser($id)
    {
        $user_model = new Users();
        $data = $this->request->getPost();

        if ($user_model->update($id, $data) === false) {
            $errors = $user_model->errors();
            return redirect()->back()->withInput()->with('errors', $errors);
        }

        return redirect()->to(base_url('/'));
    }

    public function deleteUser($id)
    {
        $user_model = new Users();
        $user_model->delete($id);
        return redirect()->to(base_url('/'));
    }
}
