<?php

namespace App\Models;

use CodeIgniter\Model;

class SchoolMsgFilesModel extends Model
{
    protected $table = 'school_msg';
    protected $allowedFields = ['num', 'file_name', 'real_name'];
    protected $primaryKey = "num";
    protected $useAutoIncrement = true;
}