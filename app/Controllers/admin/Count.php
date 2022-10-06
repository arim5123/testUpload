<?php

namespace App\Controllers\admin;

use App\Models\CountFilesModel;
use CodeIgniter\Controller;

class Count extends Controller
{
    public function index(){
        $session = session();
        $model = new CountFilesModel();
        $my_id = $session->get('id');
        if($my_id == null){ return $this->response->redirect("/admin/login/"); }

        $num_query = $model->selectMax('num')->find();
        $post_query = $model->where('num',$num_query[0]['num'])->select('file_name')->find();
        $file_name = $post_query[0]['file_name'];

        return view("/admin/count/index",[
            'my_id' => $my_id,
            'file_name' => $file_name
        ]);
    }

    public function ajax(){
        $model = new CountFilesModel();
        $rs = 'failed';

        $files = $this->request->getFile("files");
        if ( $files->isValid() != true ) {
            return $rs;
        }else{
            $fileInfo = [];
            if (!$files->isValid()) {
                $errorString = $files->getErrorString();
                $errorCode = $files->getError();
            } else {
                $savedPath = $files->store('../../public/img/count'); //무조건 public 폴더에 저장해야함!!!! 안그럼 이미지 못불러옴
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