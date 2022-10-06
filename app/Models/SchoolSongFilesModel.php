<?php

namespace App\Models;

use CodeIgniter\Model;

class SchoolSongFilesModel extends Model
{
    protected $table = 'school_song';
    protected $allowedFields = ['num', 'file_name', 'real_name'];
    protected $primaryKey = "num";
    protected $useAutoIncrement = true;
}