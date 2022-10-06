<?php

namespace App\Controllers\sub;

use App\Models\CountFilesModel;
use CodeIgniter\Controller;

class Sub02 extends Controller
{
    public function index(){
        $model = new CountFilesModel();
        $query = $model->selectMax('num')->find();
        $max_val = $query[0]['num'];

        $project = $model->find($max_val);
        $file_name = $project['file_name'];

        return view("/sub/sub02", [
            'file_name' => $file_name
        ]);
    }
}