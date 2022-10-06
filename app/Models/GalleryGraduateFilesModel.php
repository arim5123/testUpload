<?php

namespace App\Models;

use CodeIgniter\Model;

class GalleryGraduateFilesModel extends Model
{
    protected $table = 'gallery_graduate';
    protected $allowedFields = ['num', 'post_id','title', 'file_name', 'real_name'];
    protected $primaryKey = "num";
    protected $useAutoIncrement = true;
}