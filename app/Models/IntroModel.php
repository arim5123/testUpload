<?php

namespace App\Models;

use CodeIgniter\Model;

class IntroModel extends Model
{
    protected $table = 'intro';
    protected $allowedFields = ['post_id', 'title', 'd_order'];
    protected $primaryKey = "num";
    protected $useAutoIncrement = true;
}