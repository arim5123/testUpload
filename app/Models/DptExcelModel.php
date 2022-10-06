<?php

namespace App\Models;

use CodeIgniter\Model;

class DptExcelModel extends Model
{
    protected $table = 'dpt_excel';
    protected $allowedFields = ['post_id', 'title'];
    protected $primaryKey = "num";
    protected $useAutoIncrement = true;
    protected $useSoftDeletes = true;
    protected $useTimestamps = true;
}