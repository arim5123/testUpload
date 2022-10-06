<?php

namespace App\Models;

use CodeIgniter\Model;

class SchoolHistoryFilesModel extends Model
{
    protected $table = 'school_history';
    protected $allowedFields = ['num', 'file_name', 'real_name'];
    protected $primaryKey = "num";
    protected $useAutoIncrement = true;
}