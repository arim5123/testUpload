<?php

namespace App\Controllers\admin;

use App\Models\IntroFileModel;
use App\Models\IntroModel;
use App\Models\IntroSettingModel;
use CodeIgniter\API\ResponseTrait;
use CodeIgniter\Controller;

class Intro extends Controller
{

    public function index(){

        $session = session();
        $my_id = $session->get('id');
        if($my_id == null){ return $this->response->redirect("/admin/login/"); }
        $db = db_connect();
        $intro_info_array = [];

        $sql = 'SELECT i.num,i.title, i.d_order, f.file_name, f.real_name FROM intro AS i INNER JOIN intro_files AS f ON i.post_id = f.post_id ORDER BY i.d_order';
        $result = $db->query($sql);

        foreach ($result->getResult() as $row) {
            $introInfo['num'] = $row->num;
            $introInfo['title'] = $row->title;
            $introInfo['d_order'] = $row->d_order;
            $introInfo['file_name'] = $row->file_name;
            $introInfo['real_name'] = $row->real_name;

            array_push($intro_info_array, $introInfo);
        }

        return view("/admin/intro/index",[
            'my_id' => $my_id,
            'intro_info' => $intro_info_array
        ]);
    }


    public function create(){

        $session = session();
        $my_id = $session->get('id');
        if($my_id == null){ return $this->response->redirect("/admin/login/"); }
        $model_1 = new IntroModel();
        $model_2 = new IntroFileModel();

        if($this->request->getMethod() === "get") {
            return view("/admin/intro/create",[
                'my_id' => $my_id
            ]);
        }

    }

    use ResponseTrait;
    public function intro_upload(){

        $db = db_connect();
        $model = new IntroModel();
        $data = array();

        $files = $this->request->getFile("file");
        $title = $this->request->getPost('title');

        $sql_max = 'SELECT max(post_id) as post_id, max(d_order) as d_order FROM intro';
        $rst_max = $db->query($sql_max);
        $get_max = $rst_max->getResultArray();
        $post_id = (int)$get_max[0]['post_id'] + 1;
        $d_order = (int)$get_max[0]['d_order'] + 1;

        $data = ['post_id' => $post_id, 'title' => $title, 'd_order' => $d_order ];

        $model->insert($data);

        $fileInfo = [];

        $savedPath = $files->store('../../public/img/intro/'); //무조건 public 폴더에 저장해야함!!!! 안그럼 이미지 못불러옴
        $fileInfo['file_name'] = $files->getName();
        $fileInfo['real_name'] = $files->getClientName();
        $fileInfo['file_size'] = $files->getSize();
        $sql = 'INSERT INTO intro_files (post_id, file_name, real_name, file_size) VALUES (?,?,?,?)';
        $result = $db->query($sql, [$post_id, $fileInfo['file_name'], $fileInfo['real_name'],$fileInfo['file_size']]);

        if($result != null) {
            $data['success'] = 1;
        }else{
            $data['success'] = 2;
        }
        return $this->response->setJSON($data);
    }


    public function ajaxData() {

        $db = db_connect();
        $model = new IntroModel();
        $rs="failed";

        $order = $this->request->getPost();
        $aa = array_keys($order);

        $chg = explode('_',$aa[0]);  //75(num)_5(변경)_3(현재) 이렇게 넘어옴
        $num = (int)$chg[0];
        $chg_order = (int)$chg[1]; //변경 될 순서(순위)
        $now_order = (int)$chg[2]; //현재 순서(순위)

        $post_query = $model->where('num',$num)->select('post_id')->find();
        $post_id = $post_query[0]['post_id'];

        //현재 순서를 0으로 임시 저장
        $sql_1 = 'UPDATE intro SET d_order = 0 WHERE post_id = ?';
        $result_1 = $db->query($sql_1,[$post_id]);

        if ($result_1 != null) {

            if ($chg_order < $now_order) { //아래에서 위로 올라갈 때 ex.5->3
                //변경되는 순서에 의해 변경되어야 하는 애들 업데이트
                $sql = 'UPDATE intro SET d_order = d_order + 1 WHERE post_id in ( SELECT c.post_id FROM ( SELECT post_id FROM intro WHERE ? <= d_order && d_order < ? ) AS c )';
                $result = $db->query($sql, [$chg_order, $now_order]);
                //현재 순서 변경 된 순서로 업데이트
                $sql_2 = 'UPDATE intro SET d_order = ? WHERE post_id = ?';
                $result_2 = $db->query($sql_2, [$chg_order, $post_id]);

            } else { //위에서 아래로 내려갈 때 ex.1->3
                $sql = 'UPDATE intro SET d_order = d_order - 1 WHERE post_id in ( SELECT c.post_id FROM ( SELECT post_id FROM intro WHERE ? >= d_order && ? < d_order ) AS c )';
                $result = $db->query($sql, [$chg_order, $now_order]);
                $sql_2 = 'UPDATE intro SET d_order = ? WHERE post_id = ?';
                $result_2 = $db->query($sql_2, [$chg_order, $post_id]);
            }

            if($result != null && $result_2 != null) {
                $rs = "success";
                return $rs;
            }else{
                return $rs;
            }
        }else{
            return $rs;
        }
    }

    public function setting(){
        $session = session();
        $my_id = $session->get('id');
        if($my_id == null){ return $this->response->redirect("/admin/login/"); }
        $db = db_connect();
        $num = 1;

        $model = new IntroSettingModel();
        $intro_set = $model->find($num);

        return view("/admin/intro/setting",[
            'my_id' => $my_id,
            'intro_set' => $intro_set
        ]);
    }

    public function setting_ajax(){

        $db = db_connect();
        $num = 1;

        $rst = $this->request->getPost();

        $sql_count = 'SELECT COUNT(*) AS cnt FROM intro';
        $result_count = $db->query($sql_count);
        $intro_count = $result_count->getResultArray();
        $count = (int)$intro_count[0]['cnt'];

        if($count =="0" && $rst['status'] == "used"){
            $rs = "used"; return $rs;
        }else{
            $sql = 'UPDATE intro_setting SET status = ?, time = ? WHERE num = ?';
            $result = $db->query($sql, [$rst['status'], $rst['time'], $num]);

            if ($result != null) {
                $rs = "success"; return $rs;
            }else{ $rs = "error"; return $rs; }
        }
    }

    public function delete($num) {

        $db = db_connect();
        $rs = "failed";

        $sql_status = 'SELECT status FROM intro_setting';
        $result_status = $db->query($sql_status);
        $intro_status = $result_status->getResultArray();
        $status = $intro_status[0]['status'];

        $sql_count = 'SELECT COUNT(*) AS cnt FROM intro';
        $result_count = $db->query($sql_count);
        $intro_count = $result_count->getResultArray();
        $count = (int)$intro_count[0]['cnt'];

        if($status == "used" && $count == "1"){
            $rs = "used";
            return $rs;
        }else{
            $sql = 'SELECT post_id, d_order FROM intro WHERE num = ?';
            $result = $db->query($sql, [$num]);
            $i_value = $result->getResultArray();
            $post_id = (int)$i_value[0]['post_id'];
            $i = (int)$i_value[0]['d_order'];

            $update_1 = 'UPDATE intro SET d_order = d_order-1 WHERE d_order > ?';
            $result_1 = $db->query($update_1, [$i]);

            if ($result_1 != false ) {
                $sql_2 = 'DELETE FROM intro WHERE num = ?';
                $result_2 = $db->query($sql_2, [$num]);
                $sql_3 = 'DELETE FROM intro_files WHERE post_id = ?';
                $result_3 = $db->query($sql_3, [$post_id]);

                if ($result_3 != false && $result_2 != false) {
                    $rs = "success";
                    return $rs;
                }else{
                    return $rs;
                }
            }else{
                return $rs;
            }
        }
    }

}