<?php

namespace App\Models;

use CodeIgniter\Model;

class DptExcelCTSModel extends Model
{
    protected $table = 'dpt_excel_cts';
    protected $allowedFields = ['post_id','d_order','depart','title','team'];
}