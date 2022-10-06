<?php

namespace App\Models;

use CodeIgniter\Model;

class GalleryHistoryFilesModel extends Model
{
    protected $table = 'gallery_history_files';
    protected $allowedFields = ['post_id','file_name','real_name', 'file_size'];
}