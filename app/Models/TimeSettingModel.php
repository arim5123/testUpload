<?php

namespace App\Models;

use CodeIgniter\Model;

class TimeSettingModel extends Model
{
    protected $table = 'time_setting';
    protected $allowedFields = ['num','time_val'];
    protected $primaryKey = "num";
    protected $useAutoIncrement = true;
}