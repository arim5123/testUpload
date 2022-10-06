<?php

namespace App\Controllers\admin;

use CodeIgniter\Controller;

class Login extends Controller
{
    public function index(){
        $session = session();
        $db = db_connect();
        $rs = "all_failed";
        $getPost = $this->request->getPost();

        if (empty($getPost)){
            $rs = "ready";
            return view("/admin/login/index",[
                'type' => $rs
            ]);
        } else {
            $id = $this->request->getPost('id');
            $pw = $this->request->getPost('pw');

            if( $id != null && $pw != null ){

                $sql = 'SELECT count(*) AS ac FROM admin_account WHERE id = ? ';
                $result = $db->query($sql, [$id]);
                $id_result = $result->getResultArray();

                if($id_result[0]['ac'] == 0) {
                    $rs = "id_failed";
                    return view("/admin/login/index",['type' => $rs]);
                }

                $sql = "SELECT pw FROM admin_account WHERE id = ?  ";
                $db_pw = $db->query($sql, [$id]);

                foreach ($db_pw->getResult() as $row) {
                    $pass = $row->pw;
                }

                if( password_verify ( $pw , $pass ) ) {
                    $session_data = array(
                        'id'=>$id
                    );
                    $session->set($session_data);
                    return $this->response->redirect("/admin/main/");
                }else{
                    $rs = "pw_failed";
                    return view("/admin/login/index",['type' => $rs]);
                }
            }
            $rs = "all_failed";
            return view("/admin/login/index",['type' => $rs]);
        }
    }

    public function  insert(){

        $getPost = $this->request->getPost();

        if (empty($getPost)){
            return view("/admin/login/insert");
        }else{
            $id = $this->request->getPost('id');
            $hash = password_hash($this->request->getPost('pw'), PASSWORD_DEFAULT);

            $db = db_connect();
            $sql = 'INSERT INTO admin_account(id, pw)VALUES(?, ?) ';
            $result = $db->query($sql, [$id,$hash]);

            if (!empty($result)) {
                $session_data = array(
                    'id'=>$id,
                    'pw'=>$hash
                );
                return view("/admin/login");
            }else{
                echo("<script type='text/javascript'>alert('실패');history.go(-1); </script>");
            }
        }
    }

    public function logout(){
        $session = session();
        $session->remove('id');
        return $this->response->redirect("/admin/login/");
    }

    public function info(){
        $session = session();
        $my_id = $session->get('id');
        if($my_id == null){ return $this->response->redirect("/admin/login/"); }
        return view("/admin/login/info",[
            'my_id' => $my_id
        ]);
    }

    public function pw_change(){

        $db = db_connect();
        $session = session();
        $my_id = $session->get('id');
        $rs = "failed";

        $pw = $this->request->getPost('chg_pw');
        if($pw == null){
            return $rs;
        }else {
            $new_password = password_hash($pw, PASSWORD_DEFAULT);
            $sql = 'UPDATE admin_account SET pw = ? WHERE id = ?';
            $result = $db->query($sql, [$new_password, $my_id]);
            if ($result != null) {
                $rs = "success";
                return $rs;
            }
            return $rs;
        }
    }
}