<?php

namespace App\Models;

use CodeIgniter\Model;

class GalleryHistoryModel extends Model
{
    protected $table = 'gallery_history';
    protected $allowedFields = ['num', 'post_id','title'];
    protected $primaryKey = "num";
    protected $useAutoIncrement = true;
}