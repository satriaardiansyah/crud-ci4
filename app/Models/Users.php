<?php

namespace App\Models;

use CodeIgniter\Model;

class Users extends Model
{
    protected $table = 'users';
    protected $allowedFields = ['name', 'email', 'alamat'];
    protected $validationRules = [
        'name' => 'required|min_length[3]|max_length[255]',
        'email' => 'required|valid_email',
        'alamat' => 'required|min_length[5]|max_length[255]',
    ];
}
