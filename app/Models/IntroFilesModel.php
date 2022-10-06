<?php

namespace App\Models;
use CodeIgniter\Model;

class IntroFilesModel extends Model
{
    protected $table = 'intro';
    protected $allowedFields = ['post_id', 'time', 'file_size', 'file_name', 'real_name', 'state'];
    protected $primaryKey = "num";
    protected $useAutoIncrement = true;
}