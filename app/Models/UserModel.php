<?php

namespace App\Models;
use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table = 'pengguna';
    protected $primaryKey = 'id_user';
    protected $allowedFields = ['username', 'password', 'role'];
}