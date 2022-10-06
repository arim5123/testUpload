<?php

namespace App\Models;

use CodeIgniter\Model;

class ExcelModel extends Model
{
    protected $table = 'excel';
    protected $allowedFields = ['post_id', 'title'];
    protected $primaryKey = "num";
    protected $useAutoIncrement = true;
    protected $useSoftDeletes = true;
    protected $useTimestamps = true;
}