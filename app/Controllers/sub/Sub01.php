<?php

namespace App\Controllers\sub;

use App\Models\SchoolSongFilesModel;
use CodeIgniter\Controller;
use App\Models\SchoolMsgFilesModel;
use App\Models\SchoolHistoryFilesModel;
use App\Models\SchoolInfoFilesModel;


class Sub01 extends Controller
{
    public function index(){
        $model_01 = new SchoolMsgFilesModel();
        $model_02 = new SchoolHistoryFilesModel();
        $model_03 = new SchoolInfoFilesModel();
        $model_04 = new SchoolSongFilesModel();

        $query_01 = $model_01->selectMax('num')->find();
        $query_02 = $model_02->selectMax('num')->find();
        $query_03 = $model_03->selectMax('num')->find();
        $query_04 = $model_04->selectMax('num')->find();

        $max_01 = $query_01[0]['num'];
        $max_02 = $query_02[0]['num'];
        $max_03 = $query_03[0]['num'];
        $max_04 = $query_04[0]['num'];

        $project_01 = $model_01->find($max_01);
        $project_02 = $model_02->find($max_02);
        $project_03 = $model_03->find($max_03);
        $project_04 = $model_04->find($max_04);

        $file_name_01 = $project_01['file_name'];
        $file_name_02 = $project_02['file_name'];
        $file_name_03 = $project_03['file_name'];
        $file_name_04 = $project_04['file_name'];

        return view("/sub/sub01", [
            'file_name_01' => $file_name_01,
            'file_name_02' => $file_name_02,
            'file_name_03' => $file_name_03,
            'file_name_04' => $file_name_04
        ]);

    }

}