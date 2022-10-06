<?php

namespace App\Models;

use CodeIgniter\Model;

class SchoolInfoFilesModel extends Model
{
    protected $table = 'school_info';
    protected $allowedFields = ['num', 'file_name', 'real_name'];
    protected $primaryKey = "num";
    protected $useAutoIncrement = true;
}