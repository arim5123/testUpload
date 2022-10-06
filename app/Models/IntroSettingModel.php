<?php

namespace App\Models;

use CodeIgniter\Model;

class IntroSettingModel extends Model
{
    protected $table = 'intro_setting';
    protected $allowedFields = ['time','status'];
    protected $primaryKey = "num";
}