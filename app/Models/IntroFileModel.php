<?php

namespace App\Models;

use CodeIgniter\Model;

class IntroFileModel extends Model
{
    protected $table = 'intro_files';
    protected $allowedFields = ['post_id','file_name','real_name', 'file_size'];
}