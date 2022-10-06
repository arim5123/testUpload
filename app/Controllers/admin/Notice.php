<?php

namespace App\Controllers\admin;

use App\Models\NoticeFilesModel;
use App\Models\NoticeModel;
use CodeIgniter\Controller;

class Notice extends Controller
{
     public function index(){

         $db = db_connect();
         $session = session();

         $my_id = $session->get('id');
         if($my_id == null){ return $this->response->redirect("/admin/login/"); }

         $model = new NoticeModel();
         $post_query = $model->orderBy("d_order", "asc");
         $post_list = $post_query->paginate(5);
         $pager = $post_query->pager;
         $pager->setPath("/admin/notice");

         $files_array = [];
         $p_val = [];

         $sql = 'SELECT post_id, file_name FROM notice_files';
         $result = $db->query($sql);

         foreach ($result->getResult() as $row) {
             $Info['post_id'] = $row->post_id;
             $Info['file_name'] = $row->file_name;
             array_push($files_array, $Info);
         }

         $sql_max = 'SELECT * FROM notice ORDER BY d_order';
         $rst_max = $db->query($sql_max);

         foreach ($rst_max->getResult() as $row) {
             $Val['num'] = $row->num;
             $Val['post_id'] = $row->post_id;
             $Val['title'] = $row->title;
             $Val['d_order'] = $row->d_order;
             array_push($p_val, $Val);
         }

         return view("/admin/notice/index",[
             'my_id' => $my_id,
             'files_array' => $files_array,
             'p_val' => $p_val,
             'pager' => $pager,
             'post_list' => $post_list
         ]);
     }

     public function create(){
         $session = session();
         $my_id = $session->get('id');
         if($my_id == null){
             return $this->response->redirect("/admin/login/");
         }else{
             return view("/admin/notice/create", [
                 'my_id' => $my_id
             ]);
         }
     }

     public function upload(){

         $db = db_connect();
         $model = new NoticeModel();
         $rs = "failed";

         $files = $this->request->getFileMultiple("file");
         $title = $this->request->getPost('title');

         $sql_max = 'SELECT max(post_id) as post_id, max(d_order) as d_order FROM notice';
         $rst_max = $db->query($sql_max);
         $get_max = $rst_max->getResultArray();
         $post_id = (int)$get_max[0]['post_id'] + 1;
         $d_order = (int)$get_max[0]['d_order'] + 1;

         $data = ['post_id' => $post_id, 'title' => $title, 'd_order' => $d_order ];

         $result_title = $model->insert($data);

         if ($result_title != null) {
             foreach ($files as $file) {
                 $fileInfo = [];
                 if ($file != null) {
                     if (!$file->isValid()) {
                         $errorString = $file->getErrorString();
                         $errorCode = $file->getError();
                     } else {
                         $savedPath = $file->store('../../public/img/notice/'); //무조건 public 폴더에 저장해야함!!!! 안그럼 이미지 못불러옴
                         $fileInfo['file_name'] = $file->getName();
                         $fileInfo['real_name'] = $file->getClientName();
                         $fileInfo['file_size'] = $file->getSize();
                         $sql = 'INSERT INTO notice_files (post_id, file_name, real_name, file_size) VALUES (?,?,?,?)';
                         $result = $db->query($sql, [$post_id, $fileInfo['file_name'], $fileInfo['real_name'],$fileInfo['file_size']]);
                     }
                 }
             }
             if ($result != null) {
                 $rs = "success";
                 return $rs;
             }else{
                 return $rs;
             }
         }
         return $rs;
     }

     public function modify($num){

         $model = new NoticeModel();
         $files_model = new NoticeFilesModel();

         $session = session();
         $my_id = $session->get('id');
         if($my_id == null){ return $this->response->redirect("/admin/login/"); }

         $model->where('num', $num)->select('post_id, title');
         $md_val = $model->get();
         $get_max = $md_val->getResultArray();
         $title = $get_max[0]['title'];
         $post_id = (int)$get_max[0]['post_id'];

         $files_model->where('post_id', $post_id)->select('file_name,real_name,file_size');
         $query = $files_model->get();

         $file_val = [];
         foreach ($query->getResult() as $row) {
             $file_data['file_name'] = $row->file_name;
             $file_data['real_name'] = $row->real_name;
             $file_data['file_size'] = $row->file_size;
             array_push($file_val, $file_data);
         }

         return view("/admin/notice/modify", [
             'my_id' => $my_id,
             'file_val' => json_encode($file_val,true),
             'title' => $title,
             'post_id' => $post_id
         ]);

     }

    public function modify_upload(){

        $db = db_connect();
        $model = new NoticeModel();
        $files_model = new NoticeFilesModel();

        $rs = "success";

        $post_id = $this->request->getPost('post_id');
        $title = $this->request->getPost('title');
        $files = $this->request->getFileMultiple("file");
        $dlt_val = $this->request->getPost('delete_name');

        if( $files == null && $title == null && $dlt_val == null){
            return $rs;
        }

        if( $title != null){
            $model->set('title',$title)->where('post_id',$post_id)->update();
        }

        if( $dlt_val != null ){
            $jbexplode = explode( ',', $dlt_val );
            for($i=0; $i < count($jbexplode) ; $i++){
                $files_model->where('file_name', $jbexplode[$i])->delete();
            }
        }

        if( $files != null ){
            foreach ($files as $file) {
                $fileInfo = [];
                if ($file != null) {
                    if (!$file->isValid()) {
                        $errorString = $file->getErrorString();
                        $errorCode = $file->getError();
                    } else {
                        $savedPath = $file->store('../../public/img/notice/'); //무조건 public 폴더에 저장해야함!!!! 안그럼 이미지 못불러옴
                        $fileInfo['file_name'] = $file->getName();
                        $fileInfo['real_name'] = $file->getClientName();
                        $fileInfo['file_size'] = $file->getSize();
                        $sql = 'INSERT INTO notice_files (post_id, file_name, real_name, file_size) VALUES (?,?,?,?)';
                        $result = $db->query($sql, [$post_id, $fileInfo['file_name'], $fileInfo['real_name'], $fileInfo['file_size']]);
                    }
                }
            }
            if ($result == null) {
                $rs = "failed";
                return $rs;
            }
        }
        return $rs;
    }

    public function ajaxData() {

        $db = db_connect();
        $rs="failed";

        $order = $this->request->getPost();
        $aa = array_keys($order);

        $chg = explode('_',$aa[0]);  //75(num)_5(변경)_3(현재) 이렇게 넘어옴
        $num = (int)$chg[0];
        $chg_order = (int)$chg[1]; //변경 될 순서(순위)
        $now_order = (int)$chg[2]; //현재 순서(순위)

        //현재 순서를 0으로 임시 저장
        $sql_1 = 'UPDATE notice SET d_order = 0 WHERE num = ?';
        $result_1 = $db->query($sql_1,[$num]);

        if ($result_1 != null) {
            if ($chg_order < $now_order) { //아래에서 위로 올라갈 때 ex.5->3
                //변경되는 순서에 의해 변경되어야 하는 애들 업데이트
                $sql = 'UPDATE notice SET d_order = d_order + 1 WHERE num in ( SELECT c.num FROM ( SELECT num FROM notice WHERE ? <= d_order && d_order < ? ) AS c )';
                $result = $db->query($sql, [$chg_order, $now_order]);
                //현재 순서 변경 된 순서로 업데이트
                $sql_2 = 'UPDATE notice SET d_order = ? WHERE num = ?';
                $result_2 = $db->query($sql_2, [$chg_order, $num]);

            } else { //위에서 아래로 내려갈 때 ex.1->3
                $sql = 'UPDATE notice SET d_order = d_order - 1 WHERE num in ( SELECT c.num FROM ( SELECT num FROM notice WHERE ? >= d_order && ? < d_order ) AS c )';
                $result = $db->query($sql, [$chg_order, $now_order]);
                $sql_2 = 'UPDATE notice SET d_order = ? WHERE num = ?';
                $result_2 = $db->query($sql_2, [$chg_order, $num]);
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



    public function delete($num)
    {
        $db = db_connect();
        $rs = "failed";
        $model = new NoticeModel();
        $files_model = new NoticeFilesModel();

        $sql = 'SELECT d_order, post_id FROM notice WHERE num = ?';
        $result = $db->query($sql, [$num]);
        $i_value = $result->getResultArray();
        $order = (int)$i_value[0]['d_order'];
        $post_id = (int)$i_value[0]['post_id'];

        $update_1 = 'UPDATE notice SET d_order = d_order-1 WHERE d_order > ?';
        $result_1 = $db->query($update_1, [$order]);

        if ($result_1 != false ) {
            $model->where('num', $num)->delete();
            $files_model->where('post_id', $post_id)->delete();
            $rs = "success";
            return $rs;
        }else{
            return $rs;
        }
    }


}