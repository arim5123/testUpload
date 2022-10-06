<?php

namespace App\Models;
use CodeIgniter\Model;

class AccountModel extends Model
{
    protected $table = 'admin_account';
    protected $allowedFields = ['id', 'pw'];
    protected $primaryKey = "num";
    protected $useAutoIncrement = true;
}