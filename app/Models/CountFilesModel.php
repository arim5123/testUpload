<?php

namespace App\Models;

use CodeIgniter\Model;

class CountFilesModel extends Model
{
    protected $table = 'count';
    protected $allowedFields = ['num', 'file_name', 'real_name'];
    protected $primaryKey = "num";
    protected $useAutoIncrement = true;
}