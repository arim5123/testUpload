<?php

namespace App\Controllers\admin;

use CodeIgniter\Controller;

class Main extends Controller
{
    public function index(){

        $session = session();
        $my_id = $session->get('id');

        if($my_id == null){
           return $this->response->redirect("/admin/login/");
        }else{

            $db = db_connect();
            $sql = 'SELECT time_val FROM time_setting WHERE num = (SELECT MAX(num) FROM time_setting)';
            $result = $db->query($sql);
            $order = $result->getResultArray();
            $val = (int)$order[0]['time_val'];

            return view("/admin/index",[
                'my_id' => $my_id,
                'val' => $val
            ]);
        }
    }

    public function time_val(){
        $db = db_connect();
        $sql = 'SELECT time_val FROM time_setting WHERE num = (SELECT MAX(num) FROM time_setting)';
        $result = $db->query($sql);
        $order = $result->getResultArray();
        $val = (int)$order[0]['time_val'];
        print_r($val); /*지우면안됨,, 이유를 모르겠음*/
        return $val;
    }

    public function time_setting(){

        $db = db_connect();
        $time_val = $this->request->getPost('time_set');
        $sql = 'INSERT INTO time_setting(time_val) VALUES(?) ';
        $result_1 = $db->query($sql, [$time_val]);

        if ($result_1 == '1') {
            $rs = "success";
            return $rs;
        } else {
            $rs = "failed";
            return $rs;
        }
    }

}