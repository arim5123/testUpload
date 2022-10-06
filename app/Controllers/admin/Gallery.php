<?php

namespace App\Controllers\admin;

use App\Models\GalleryGraduateFilesModel;
use App\Models\GalleryHistoryFilesModel;
use App\Models\GalleryHistoryModel;
use CodeIgniter\Controller;

class Gallery extends Controller
{
    public function graduate(){

        $session = session();
        $my_id = $session->get('id');
        if($my_id == null){ return $this->response->redirect("/admin/login/"); }

        $model = new GalleryGraduateFilesModel();

        $post_query = $model->orderBy("num", "asc");
        $post_list = $post_query->paginate(10);
        $pager = $post_query->pager;
        $pager->setPath("/admin/gallery/graduate");

        return view("/admin/gallery/graduate",[
            'my_id' => $my_id,
            'pager' => $pager,
            'post_list' => $post_list
        ]);
    }

    public function graduate_create(){
        $session = session();
        $my_id = $session->get('id');
        if($my_id == null){
            return $this->response->redirect("/admin/login/");
        }else{
            return view("/admin/gallery/graduate_create", [
                'my_id' => $my_id
            ]);
        }
    }

    public function graduate_upload(){

        $model = new GalleryGraduateFilesModel();
        $rs = "failed";

        $files = $this->request->getFile("file");
        $title = $this->request->getPost('title');

        $get_max = $model->selectMax('post_id')->find();
        $post_id = (int)$get_max[0]['post_id'] + 1;

        $data = ['post_id' => $post_id, 'title' => $title];

        $result_title = $model->insert($data);

        if( $result_title != null ){

            $fileInfo = [];
            if (!$files->isValid()) {
                $errorString = $files->getErrorString();
                $errorCode = $files->getError();
            }else{
                $savedPath = $files->store('../../public/img/gallery/graduate/'); //무조건 public 폴더에 저장해야함!!!! 안그럼 이미지 못불러옴
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

    public function graduate_modify($num){

        $model = new GalleryGraduateFilesModel();
        $file_data = [];
        $session = session();
        $my_id = $session->get('id');
        if($my_id == null){ return $this->response->redirect("/admin/login/"); }

        $project = $model->find($num);
        $title = $project['title'];

        return view("/admin/gallery/graduate_modify", [
            'my_id' => $my_id,
            'project' => json_encode($project,true),
            'title' => $title
        ]);
    }

    public function graduate_modify_upload(){

        $model = new GalleryGraduateFilesModel();
        $rs = "success";

        $post_id = $this->request->getPost('post_id');
        $title = $this->request->getPost('title');
        $file = $this->request->getFile("file");

        if( $file == null && $title == null){
            return $rs;
        }

        if( $title != null){
            $model->set('title',$title)->where('post_id',$post_id)->update();
        }
        if( $file != null ){
            $fileInfo = [];
            if (!$file->isValid()) {
                $errorString = $file->getErrorString();
                $errorCode = $file->getError();
            } else {
                $savedPath = $file->store('../../public/img/gallery/graduate/'); //무조건 public 폴더에 저장해야함!!!! 안그럼 이미지 못불러옴
                $file_name = $file->getName();
                $real_name = $file->getClientName();
                $data = ['file_name' => $file_name, 'real_name' =>$real_name ];
                $result= $model->set($data)->where('post_id',$post_id)->update();
            }
            if ($result == null) {
                $rs = "failed";
                return $rs;
            }
        }
        return $rs;
    }

    public function graduate_delete($num)
    {
        $rs = "failed";
        $model = new GalleryGraduateFilesModel();

        $result = $model->where('num', $num)->delete();

        if ($result != null) {
            $rs = "success";
            return $rs;
        }
        return $rs;
    }








    // 역사관 history
    public function history(){
        $session = session();
        $my_id = $session->get('id');
        if($my_id == null){ return $this->response->redirect("/admin/login/"); }

        $model = new GalleryHistoryModel();
        $files_model = new GalleryHistoryFilesModel();

        $post_query = $model->orderBy("title", "asc");
        $post_list = $post_query->paginate(10);
        $pager = $post_query->pager;
        $pager->setPath("/admin/gallery/history");

        $files_array = $files_model->findAll();

        return view("/admin/gallery/history",[
            'my_id' => $my_id,
            'pager' => $pager,
            'post_list' => $post_list,
            'files_array' => $files_array
        ]);
    }

    public function history_create(){

        $session = session();
        $my_id = $session->get('id');
        if($my_id == null){ return $this->response->redirect("/admin/login/"); }

        return view("/admin/gallery/history_create", [
            'my_id' => $my_id
        ]);

    }

    public function history_upload(){

        $rs = "failed";
        $model = new GalleryHistoryModel();
        $files_model = new GalleryHistoryFilesModel();

        $files = $this->request->getFileMultiple("file");
        $title = $this->request->getPost('title');

        $get_max = $model->selectMax('post_id')->find();
        $post_id = (int)$get_max[0]['post_id'] + 1;

        $data = ['post_id' => $post_id, 'title' => $title];
        $result_title = $model->insert($data);

        if($result_title != null){
            foreach ($files as $file) {
                $fileInfo = [];
                if ($file != null) {
                    if (!$file->isValid()) {
                        $errorString = $file->getErrorString();
                        $errorCode = $file->getError();
                    } else {
                        $savedPath = $file->store('../../public/img/gallery/history/'); //무조건 public 폴더에 저장해야함!!!! 안그럼 이미지 못불러옴
                        $fileInfo['post_id'] = $post_id;
                        $fileInfo['file_name'] = $file->getName();
                        $fileInfo['real_name'] = $file->getClientName();
                        $fileInfo['file_size'] = $file->getSize();
                    }
                }
                $result = $files_model->insert($fileInfo);
            }
            if($result != null) {
                $rs = "success";
            }
        }
        return $rs;
    }

    public function history_modify($num){

        $model = new GalleryHistoryModel();
        $files_model = new GalleryHistoryFilesModel();

        $session = session();
        $my_id = $session->get('id');
        if($my_id == null){ return $this->response->redirect("/admin/login/"); }

        $info = $model->find($num);
        $project = $files_model->where('post_id',$info['post_id'])->find();

        $files_array= [];
        for($i=0; $i < count($project) ;$i++) {
            $fileInfo['file_name'] = $project[$i]['file_name'];
            $fileInfo['real_name'] = $project[$i]['real_name'];
            $fileInfo['file_size'] = $project[$i]['file_size'];
            array_push($files_array, $fileInfo);
        }

        return view("/admin/gallery/history_modify", [
            'my_id' => $my_id,
            'file_val' => json_encode($files_array,true),
            'title' => $info['title'],
            'post_id' => $info['post_id']
        ]);
    }

    public function history_modify_upload(){

        $model = new GalleryHistoryModel();
        $files_model = new GalleryHistoryFilesModel();
        $rs = "success";

        $post_id = $this->request->getPost('post_id');
        $title = $this->request->getPost('title');
        $files = $this->request->getFileMultiple("file");
        $dlt_val = $this->request->getPost('delete_name');

        if( $title != null ){
            $model->set('title', $title)->where('post_id',$post_id)->update();
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
                        $savedPath = $file->store('../../public/img/gallery/history/'); //무조건 public 폴더에 저장해야함!!!! 안그럼 이미지 못불러옴
                        $fileInfo['post_id'] = $post_id;
                        $fileInfo['file_name'] = $file->getName();
                        $fileInfo['real_name'] = $file->getClientName();
                        $fileInfo['file_size'] = $file->getSize();
                    }
                }
                $result = $files_model->insert($fileInfo);
            }
            if ($result == null) {
                $rs = "failed";
                return $rs;
            }
        }
        return $rs;
    }

    public function history_delete($num)
    {
        $rs = "failed";
        $model = new GalleryHistoryModel();
        $files_model = new GalleryHistoryFilesModel();

        $query = $model->where('num',$num)->select('post_id')->find();
        $post_id = $query[0]['post_id'];

        $result01 = $model->where('num', $num)->delete();

        if ($result01 != null) {
            $result02 = $files_model->where('post_id', $post_id)->delete();
            if($result02 != null){
                $rs = "success";
                return $rs;
            }
        }
        return $rs;
    }

}