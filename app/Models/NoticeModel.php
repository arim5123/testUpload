<?php

namespace App\Models;

use CodeIgniter\Model;

class NoticeModel extends Model
{
    protected $table = 'notice';
    protected $allowedFields = ['num', 'post_id', 'title', 'd_order'];
    protected $primaryKey = "num";
    protected $useAutoIncrement = true;
}