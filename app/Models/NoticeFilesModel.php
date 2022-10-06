<?php

namespace App\Models;

use CodeIgniter\Model;

class NoticeFilesModel extends Model
{
    protected $table = 'notice_files';
    protected $allowedFields = ['post_id', 'file_name', 'real_name', 'file_size'];
}