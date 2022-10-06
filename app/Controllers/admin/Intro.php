<?php

namespace App\Controllers\admin;

use App\Models\IntroFilesModel;
use CodeIgniter\Controller;


class Intro extends Controller
{
    public function index(){

        $session = session();
        $my_id = $session->get('id');
        if($my_id == null){
            return $this->response->redirect("/admin/login/");
        }

        $model = new IntroFilesModel();
        $project = $model->find();

        return view("/admin/intro/list",[
            'my_id' => $my_id,
            'project' => $project
        ]);
    }

    public function state_modify($num){
        $session = session();
        $my_id = $session->get('id');
        if($my_id == null){
            return $this->response->redirect("/admin/login/");
        }

        $rs = "success";
        $model = new IntroFilesModel();

        $project = $model->where('num',$num)->first();
        $state = $project['state'];

        if($state == "on"){
            $data = ['state' => "off"];
            $result = $model->update($num, $data);
            if (!empty($result)) {
                return $rs;
            }
            $rs = "failed";
        }else{
            $data = ['state' => "on"];
            $result = $model->update($num, $data);
            if (!empty($result)) {
                return $rs;
            }
            $rs = "failed";
        }
        return $rs;
    }

    public function modify($num){
        $session = session();
        $my_id = $session->get('id');
        if($my_id == null){
            return $this->response->redirect("/admin/login/");
        }
        $model = new IntroFilesModel();
        $project = $model->find($num);


        return view("/admin/intro/modify",[
            'my_id' => $my_id,
            'project' => json_encode($project,true),
            'post_id' => $project['post_id'],
            'time' => $project['time']
        ]);
    }

    public function modify_upload(){

        $model = new IntroFilesModel();
        $rs = "success";

        $post_id = $this->request->getPost('post_id');
        $time = $this->request->getPost('time');
        $file = $this->request->getFile("file");

        if( $file == null && $time == null){
            return $rs;
        }

        if( $time != null){
            $model->set('time',$time)->where('post_id',$post_id)->update();
        }

        if( $file != null ){
            $data = [];
            if (!$file->isValid()) {
                $errorString = $file->getErrorString();
                $errorCode = $file->getError();
            } else {
                $savedPath = $file->store('../../public/img/intro/'); //무조건 public 폴더에 저장해야함!!!! 안그럼 이미지 못불러옴
                $file_name = $file->getName();
                $real_name = $file->getClientName();
                $file_size = $file->getSize();
                $data = ['file_size' =>$file_size, 'file_name' => $file_name, 'real_name' =>$real_name ];
                $result= $model->set($data)->where('post_id',$post_id)->update();
            }
            if ($result == null) {
                $rs = "failed";
                return $rs;
            }
        }
        return $rs;
    }

    public function create(){
        $session = session();
        $my_id = $session->get('id');
        if($my_id == null){
            return $this->response->redirect("/admin/login/");
        }

        return view("/admin/intro/create",[
            'my_id' => $my_id,
        ]);
    }

    public function create_upload(){

        $model = new IntroFilesModel();
        $rs = "failed";

        $time = $this->request->getPost('time');
        $files = $this->request->getFile("file");

        $get_max = $model->selectMax('post_id')->find();
        $post_id = (int)$get_max[0]['post_id'] + 1;

        $data = ['post_id' => $post_id, 'time' => $time, 'state' => "on"];

        $result_title = $model->insert($data);

        if( $result_title != null ){
            $fileInfo = [];
            if (!$files->isValid()) {
                $errorString = $files->getErrorString();
                $errorCode = $files->getError();
            }else{
                $savedPath = $files->store('../../public/img/intro/'); //무조건 public 폴더에 저장해야함!!!! 안그럼 이미지 못불러옴
                $fileInfo['file_size'] = $files->getSize();
                $fileInfo['file_name'] = $files->getName();
                $fileInfo['real_name'] = $files->getClientName();
            }
            $result = $model->set($fileInfo)->where('post_id',$post_id)->update();
            if($result != null) {
                $rs = 'success';
                return $rs;
            }
        }
        return $rs;
    }

    public function delete($num){
        $rs = "failed";
        $model = new IntroFilesModel();
        $result = $model->where('num', $num)->delete();
        if ($result != null) {
            $rs = "success";
            return $rs;
        }
        return $rs;
    }

}