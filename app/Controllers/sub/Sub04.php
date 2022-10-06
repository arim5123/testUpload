<?php

namespace App\Controllers\sub;

use App\Models\GalleryGraduateFilesModel;
use CodeIgniter\API\ResponseTrait;
use CodeIgniter\Controller;

class Sub04 extends Controller
{
    public function index(){
        return view("/sub/sub04");
    }

    public function graduate(){

        $model = new GalleryGraduateFilesModel();

        $post_query = $model->orderBy("num", "asc");
        $post_list = $post_query->paginate(9);
        $pager = $post_query->pager;
        $pager->setPath("/sub/sub04/graduate");

        return view("/sub/sub04_1",[
            'pager' => $pager,
            'post_list' => $post_list
        ]);
    }

    use ResponseTrait;
    public function graduate_view($num){

        $model = new GalleryGraduateFilesModel();

        $project = $model->find($num);
        $file_name = $project['file_name'];
        $title = $project['title'];

        $html = '<div id="popup_area">
                      <div class="pop_img_area">
                            <img src="/img/gallery/graduate/'.$file_name.'" style="width:1850px; padding: 40px 0;"/>
                      </div>
                      <div class="btn_close" onclick="Swal.close();"><img src="/images/main/close_b.png" width="150"/></div>
                 </div>';
        $return_val = ['status'=>'success', 'html' =>$html];
        return $this->respond($return_val);
        
    }

    public function history(){

    }
}