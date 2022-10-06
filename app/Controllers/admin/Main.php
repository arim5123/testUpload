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
        }
        return view("/admin/index",[
            'my_id' => $my_id
        ]);

    }

}