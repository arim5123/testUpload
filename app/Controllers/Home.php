<?php

namespace App\Controllers;

use App\Models\IntroSettingModel;

class Home extends BaseController
{
    public function index()
    {
        $db = db_connect();
        $model = new IntroSettingModel();

        $intro_info_array = [];

        $val = $model->where('num', 1)->first();
        $status = $val['status'];

        if($status=="used"){
            $intro_set = $model->find(1);
            $sql = 'SELECT i.post_id, i.d_order, f.file_name FROM intro AS i INNER JOIN intro_files AS f ON i.post_id = f.post_id ORDER BY i.d_order';
            $result = $db->query($sql);

            foreach ($result->getResult() as $row) {
                $introInfo['post_id'] = $row->post_id;
                $introInfo['d_order'] = $row->d_order;
                $introInfo['file_name'] = $row->file_name;

                array_push($intro_info_array, $introInfo);
            }

            return view("/index_intro",[
                'intro_info' => $intro_info_array,
                'intro_set' => $intro_set
            ]);
        }else{
            return view('/index');
        }
    }

    public function index_main(){
        return view('/index');
    }
}
