<?php

namespace App\Controllers\sub;

use App\Models\NoticeFilesModel;
use App\Models\NoticeModel;
use CodeIgniter\Controller;

class Sub03 extends Controller
{

    public function index(){

        $db = db_connect();
        $model = new NoticeModel();

        $post_query = $model->orderBy("d_order", "asc");
        $post_list = $post_query->paginate(6);
        $pager = $post_query->pager;
        $pager->setPath("/sub/sub03");

        $files_array = [];
        $p_val = [];

        $sql = 'SELECT post_id, file_name FROM (SELECT *, ROW_NUMBER() OVER (PARTITION BY post_id ORDER BY post_id asc) AS RankNo FROM notice_files) AS t1 WHERE RankNo = 1;';
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

        return view("/sub/sub03",[
            'files_array' => $files_array,
            'p_val' => $p_val,
            'pager' => $pager,
            'post_list' => $post_list
        ]);
    }

    public function view($num){

        $model = new NoticeModel();
        $files_model = new NoticeFilesModel();

        $model->where('num', $num)->select('post_id, title');
        $md_val = $model->get();
        $get_max = $md_val->getResultArray();
        $title = $get_max[0]['title'];
        $post_id = (int)$get_max[0]['post_id'];

        $files_model->where('post_id', $post_id)->select('file_name');
        $query = $files_model->get();

        $file_val = [];
        foreach ($query->getResult() as $row) {
            $file_data['file_name'] = $row->file_name;
            array_push($file_val, $file_data);
        }

        return view("/sub/sub03_detail", [
            'file_val' => $file_val,
            'title' => $title
        ]);

    }
}