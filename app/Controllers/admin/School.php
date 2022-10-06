<?php

namespace App\Controllers\admin;

use App\Models\SchoolHistoryFilesModel;
use App\Models\SchoolInfoFilesModel;
use App\Models\SchoolMsgFilesModel;
use App\Models\SchoolSongFilesModel;
use CodeIgniter\Controller;

class School extends Controller
{
    public function msg(){
        $session = session();
        $model = new SchoolMsgFilesModel();
        $my_id = $session->get('id');
        if($my_id == null){ return $this->response->redirect("/admin/login/"); }

        $num_query = $model->selectMax('num')->find();
        $post_query = $model->where('num',$num_query[0]['num'])->select('file_name')->find();
        $file_name = $post_query[0]['file_name'];

        return view("/admin/school/msg",[
            'my_id' => $my_id,
            'file_name' => $file_name
        ]);
    }

    public function history(){
        $session = session();
        $model = new SchoolHistoryFilesModel();
        $my_id = $session->get('id');
        if($my_id == null){ return $this->response->redirect("/admin/login/"); }

        $num_query = $model->selectMax('num')->find();
        $post_query = $model->where('num',$num_query[0]['num'])->select('file_name')->find();
        $file_name = $post_query[0]['file_name'];

        return view("/admin/school/history",[
            'my_id' => $my_id,
            'file_name' => $file_name
        ]);
    }

    public function info(){
        $session = session();
        $model = new SchoolInfoFilesModel();
        $my_id = $session->get('id');
        if($my_id == null){ return $this->response->redirect("/admin/login/"); }

        $num_query = $model->selectMax('num')->find();
        $post_query = $model->where('num',$num_query[0]['num'])->select('file_name')->find();
        $file_name = $post_query[0]['file_name'];

        return view("/admin/school/info",[
            'my_id' => $my_id,
            'file_name' => $file_name
        ]);
    }

    public function song(){
        $session = session();
        $model = new SchoolSongFilesModel();
        $my_id = $session->get('id');
        if($my_id == null){ return $this->response->redirect("/admin/login/"); }

        $num_query = $model->selectMax('num')->find();
        $post_query = $model->where('num',$num_query[0]['num'])->select('file_name')->find();
        $file_name = $post_query[0]['file_name'];

        return view("/admin/school/song",[
            'my_id' => $my_id,
            'file_name' => $file_name
        ]);
    }

    public function ajax($page_val){

        $rs = 'failed';

        if($page_val == 1) {
            $url = '../../public/img/school/msg/';
            $model = new SchoolMsgFilesModel();
        }elseif ($page_val == 2){
            $url = '../../public/img/school/history/';
            $model = new SchoolHistoryFilesModel();
        }elseif ($page_val == 3){
            $url = '../../public/img/school/info/';
            $model = new SchoolInfoFilesModel();
        }else{
            $url = '../../public/img/school/song/';
            $model = new SchoolSongFilesModel();
        }
        $files = $this->request->getFile("files");

        if ( $files->isValid() != true ) {
            return $rs;
        }else{
            $fileInfo = [];
            if (!$files->isValid()) {
                $errorString = $files->getErrorString();
                $errorCode = $files->getError();
            } else {
                $savedPath = $files->store($url); //무조건 public 폴더에 저장해야함!!!! 안그럼 이미지 못불러옴
                $fileInfo['file_name'] = $files->getName();
                $fileInfo['real_name'] = $files->getClientName();
                $result = $model->insert($fileInfo);

                if($result != null) {
                    $rs = 'success';
                    return $rs;
                }else{
                    return $rs;
                }

            }
            return $rs;
        }
    }

}