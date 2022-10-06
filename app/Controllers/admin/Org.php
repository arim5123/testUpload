<?php

namespace App\Controllers\admin;

use App\Models\DptExcelCTSModel;
use App\Models\DptExcelModel;
use App\Models\ExcelCTSModel;
use App\Models\ExcelModel;
use CodeIgniter\Controller;
use App\Libraries\PHPExcel;

class Org extends Controller
{
    public function list_div(){

        $session = session();
        $my_id = $session->get('id');
        if($my_id == null){
            return $this->response->redirect("/admin/login/");
        }

        $model = new DptExcelModel();
        $file_model = new DptExcelCTSModel();

        $get_max = $model->selectMax('post_id')->find();
        $post_id = (int)$get_max[0]['post_id'];

        $post_list = $file_model->where('post_id',$post_id)->orderBy('d_order')->findAll();

        return view("/admin/org/list_div",[
            'my_id' => $my_id,
            'post_list' => $post_list
        ]);
    }

    public function list_text(){

        $session = session();
        $my_id = $session->get('id');
        if($my_id == null){
            return $this->response->redirect("/admin/login/");
        }

        $model = new ExcelModel();
        $file_model = new ExcelCTSModel();

        $get_max = $model->selectMax('post_id')->find();
        $post_id = (int)$get_max[0]['post_id'];

        $post_query = $file_model->where('post_id',$post_id)->orderBy("d_order","asc");
        $post_list = $post_query->paginate(10);
        $pager = $post_query->pager;
        $pager->setPath("/admin/org/list_text/");

        return view("/admin/org/list_text",[
            'my_id' => $my_id,
            'post_list' => $post_list,
            'pager' => $pager
        ]);
    }

    public function detail($id){

        $session = session();
        $my_id = $session->get('id');
        if($my_id == null){
            return $this->response->redirect("/admin/login/");
        }

        $model = new ExcelCTSModel();

        $val = $model->where('id',$id)->find();

        $cmd = [];
        $commendation = $val[0]['commendation'];
        if( $commendation != null){
            $cmd_arr = explode( ',', $commendation );
            for($i=0; $i<count($cmd_arr); $i++){
                $cmd_val_day = $cmd_arr[$i];
                $cmd_val_txt = $cmd_arr[$i+1];
                $cmd_str = $cmd_val_txt."(".$cmd_val_day.")";
                array_push($cmd, $cmd_str);
                $i++;
            }
        }

        $dp = [];
        $disciplinary = $val[0]['disciplinary'];
        if( $disciplinary != null){
            $dp_arr = explode( ',', $disciplinary );
            for($i=0; $i<count($dp_arr); $i++){
                $dp_val_day = $dp_arr[$i];
                $dp_val_txt = $dp_arr[$i+1];
                $dp_str = $dp_val_txt."(".$dp_val_day.")";
                array_push($dp, $dp_str);
                $i++;
            }
        }

        $major_val = $val[0]['major'];
        $major_arr = explode( ',', $major_val );

        $detail_val = $val[0]['detail'];
        $detail_arr = explode( ',', $detail_val );

        return view("/admin/org/detail",[
            'my_id' => $my_id,
            'info' => $val,
            'cmd' => $cmd,
            'dp' => $dp,
            'major_arr' => $major_arr,
            'detail_arr' => $detail_arr
        ]);
    }


    public function insert_div(){
        $session = session();
        $my_id = $session->get('id');
        if($my_id == null){
            return $this->response->redirect("/admin/login/");
        }
        if($this->request->getMethod() === "get") {
            return view("/admin/org/insert_div",[
                'my_id' => $my_id
            ]);
        }

        $files = $this->request->getFile("files");
        $tmp = $files->getName();
        $chk = explode('.', $tmp);

        if ($chk[0] == null) {
            echo "<script>alert('파일을 첨부해주세요.'); history.back(-2);</script>";
        }else{
            if($chk[1] != 'csv') {
                echo "<script>alert('CSV파일을 첨부해주세요.'); history.back(-2); </script>";
            }else{

                $today = date("Y-m-d");
                $model = new DptExcelModel();
                $file_model = new DptExcelCTSModel();

                $get_max = $model->selectMax('post_id')->find();
                $post_id = (int)$get_max[0]['post_id'] + 1;

                $data = ['post_id' => $post_id, 'title' => $today];

                if ($files != null) {
                    if (!$files->isValid()) {
                        $errorString = $files->getErrorString();
                        $errorCode = $files->getError();
                    } else {
                        $savedPath = $files->store('../../public/csv/'); //무조건 public 폴더에 저장해야함!!!! 안그럼 이미지 못불러옴
                        $randomName = $files->getName();
                        $files = fopen("../public/csv/".$randomName, "r");
                        $i = 0;

                        $collection = array();
                        while (($filedata = fgetcsv($files, 15000, ",")) !== FALSE) {
                            if($i>0){
                                $d_order = iconv('CP949','utf-8//IGNORE',$filedata[0]);
                                if($d_order!=null){
                                    $collection[$i]['post_id']  = $post_id;
                                    $collection[$i]['d_order']  = $d_order;
                                    $collection[$i]['depart']   = iconv('CP949','utf-8//IGNORE',$filedata[1]);
                                    $collection[$i]['title']    = iconv('CP949','utf-8//IGNORE',$filedata[2]);
                                    $collection[$i]['team']     = iconv('CP949','utf-8//IGNORE',$filedata[3]);
                                    $i++;
                                }
                            }
                            if($i===0){
                                $i++;
                            }
                        }

                        $file_model->where('post_id', $get_max[0]['post_id'])->delete();
                        $model->insert($data);

                        foreach($collection as $prodData){
                            $file_model->insert($prodData, 'utf8');
                        }
                    }
                }
                return $this->response->redirect("/admin/org/list_div");
            }
        }
    }


    public function insert_text(){

        $session = session();
        $my_id = $session->get('id');

        if($my_id == null){
            return $this->response->redirect("/admin/login/");
        }

        if($this->request->getMethod() === "get") {
            return view("/admin/org/insert_text",[
                'my_id' => $my_id
            ]);
        }

        $files = $this->request->getFile("files");
        $tmp = $files->getName();
        $chk = explode('.', $tmp);

        if ($chk[0] == null) {
            echo "<script>alert('파일을 첨부해주세요.'); history.back(-2);</script>";
        }else{
            if($chk[1] != 'csv') {
                echo "<script>alert('CSV파일을 첨부해주세요.'); history.back(-2); </script>";
            }else{

                $today = date("Y-m-d");

                $model = new ExcelModel();
                $file_model = new ExcelCTSModel();
                $dpt_model = new DptExcelCTSModel();

                $get_max = $model->selectMax('post_id')->find();
                $post_id = (int)$get_max[0]['post_id'] + 1;

                $data = ['post_id' => $post_id, 'title' => $today];

                if ($files != null) {
                    if (!$files->isValid()) {
                        $errorString = $files->getErrorString();
                        $errorCode = $files->getError();
                    } else {
                        $savedPath = $files->store('../../public/csv/'); //무조건 public 폴더에 저장해야함!!!! 안그럼 이미지 못불러옴
                        $randomName = $files->getName();
                        $files = fopen("../public/csv/".$randomName, "r");

                        $i = 0;
                        $collection = array();

                        while (($filedata = fgetcsv($files, 15000, ",")) !== FALSE) {
                            if($i>0){
                                $id = iconv('CP949','utf-8//IGNORE',$filedata[1]);
                                if($id != null){
                                    $depart_val = iconv('CP949','utf-8//IGNORE',$filedata[2]);
                                    $get_val = $dpt_model->where('depart',$depart_val)->select('d_order')->find();
                                    if(empty($get_val)){
                                        echo "<script>alert('파일에 등록되지 않은 기관이 기재되어 있습니다.'); location.replace('/admin/org/insert_text');</script>";
                                    }
                                    $d_order = (int)$get_val[0]['d_order'];

                                    /* 표창 */
                                    $a_ary = [];
                                    for($j=37; $j<47; $j++){
                                        $a_val = iconv('CP949','utf-8//IGNORE',$filedata[$j]);
                                        if($a_val != null){
                                            array_push($a_ary, $a_val);
                                        }
                                    }
                                    $commendation = implode( ',', $a_ary );

                                    /* 징계 */
                                    $b_ary = [];
                                    for($j=47; $j<57; $j++){
                                        $b_val = iconv('CP949','utf-8//IGNORE',$filedata[$j]);
                                        if($b_val != null){
                                            array_push($b_ary, $b_val);
                                        }
                                    }
                                    $disciplinary = implode( ',', $b_ary );

                                    /* 주요 경력 */
                                    $c_ary = [];
                                    for($j=57; $j<60; $j++){
                                        $c_val = iconv('CP949','utf-8//IGNORE',$filedata[$j]);
                                        if($c_val != null){
                                            array_push($c_ary, $c_val);
                                        }
                                    }
                                    $major  = implode( ',', $c_ary );

                                    /* 세부 경력 */
                                    $d_ary = [];
                                    for($j=60; $j<120; $j++){
                                        $d_val_date = iconv('CP949','utf-8//IGNORE',$filedata[$j]);
                                        $j++;
                                        $d_val_text = iconv('CP949','utf-8//IGNORE',$filedata[$j]);
                                        if($d_val_date != null && $d_val_text != null ){
                                            $d_val = $d_val_date.$d_val_text;
                                            array_push($d_ary, $d_val);
                                        }
                                    }
                                    $detail = implode( ',', $d_ary );

                                    /* 연속 참모 기간 */
                                    $period_val = iconv('CP949','utf-8//IGNORE',$filedata[22]);
                                    if( $period_val != null ){
                                        $tmp_st = preg_replace("/\s+/", "",$period_val);
                                        $ret = array();
                                        for ($k=0; $k<mb_strlen($tmp_st, "utf-8"); $k++){
                                            array_push($ret, mb_substr($tmp_st, $k, 1, "utf-8"));
                                        }
                                        if(strpos($tmp_st,"년")){
                                            $chk = mb_strpos($tmp_st,"년");
                                            $num = (int)$chk-1;
                                            $year_val = $ret[$num];
                                            $t_val_01 = (int)$year_val*12;
                                        }else{
                                            $t_val_01 = 0;
                                        }
                                        if(strpos($tmp_st,"개월")){
                                            $m_chk = mb_strpos($tmp_st,"개");
                                            $m_num = (int)$m_chk-1;
                                            $mon_val = $ret[$m_num];
                                            $t_val_02 = (int)$mon_val;
                                        }else{
                                            $t_val_02 = 0;
                                        }
                                        $period = $t_val_01 + $t_val_02;
                                    }else{
                                        $period = 0;
                                    }

                                    $collection[$i]['id']           = $id;
                                    $collection[$i]['post_id']      = $post_id;
                                    $collection[$i]['d_order']      = $d_order;
                                    $collection[$i]['c_order']      = iconv('CP949','utf-8//IGNORE',$filedata[0]);
                                    $collection[$i]['depart']       = $depart_val;
                                    $collection[$i]['team']         = iconv('CP949','utf-8//IGNORE',$filedata[3]);
                                    $collection[$i]['position']     = iconv('CP949','utf-8//IGNORE',$filedata[4]);
                                    $collection[$i]['div']          = iconv('CP949','utf-8//IGNORE',$filedata[5]);
                                    $collection[$i]['rank']         = iconv('CP949','utf-8//IGNORE',$filedata[6]);
                                    $collection[$i]['option_1']     = iconv('CP949','utf-8//IGNORE',$filedata[7]);
                                    $collection[$i]['option_2']     = iconv('CP949','utf-8//IGNORE',$filedata[8]);
                                    $collection[$i]['option_3']     = iconv('CP949','utf-8//IGNORE',$filedata[9]);
                                    $collection[$i]['name']         = iconv('CP949','utf-8//IGNORE',$filedata[10]);
                                    $collection[$i]['c_name']       = iconv('EUC-KR','utf-8//IGNORE',$filedata[11]); //한자
                                    $collection[$i]['birthday']     = iconv('CP949','utf-8//IGNORE',$filedata[12]);
                                    $collection[$i]['age']          = iconv('CP949','utf-8//IGNORE',$filedata[13]);
                                    $collection[$i]['apm']          = iconv('CP949','utf-8//IGNORE',$filedata[14]);
                                    $collection[$i]['n_day']        = iconv('CP949','utf-8//IGNORE',$filedata[15]);
                                    $collection[$i]['country']      = iconv('CP949','utf-8//IGNORE',$filedata[16]);
                                    $collection[$i]['hs_place']     = iconv('CP949','utf-8//IGNORE',$filedata[17]);
                                    $collection[$i]['education']    = iconv('CP949','utf-8//IGNORE',$filedata[18]);
                                    $collection[$i]['initial_day']  = iconv('CP949','utf-8//IGNORE',$filedata[19]);
                                    $collection[$i]['p_day']        = iconv('CP949','utf-8//IGNORE',$filedata[20]);
                                    $collection[$i]['retirement']   = iconv('CP949','utf-8//IGNORE',$filedata[21]);
                                    $collection[$i]['period']       = $period;
                                    $collection[$i]['a_day_1']      = iconv('CP949','utf-8//IGNORE',$filedata[23]);
                                    $collection[$i]['a_day_2']      = iconv('CP949','utf-8//IGNORE',$filedata[24]);
                                    $collection[$i]['a_day_3']      = iconv('CP949','utf-8//IGNORE',$filedata[25]);
                                    $collection[$i]['a_day_4']      = iconv('CP949','utf-8//IGNORE',$filedata[26]);
                                    $collection[$i]['a_day_5']      = iconv('CP949','utf-8//IGNORE',$filedata[27]);
                                    $collection[$i]['a_day_6']      = iconv('CP949','utf-8//IGNORE',$filedata[28]);
                                    $collection[$i]['a_day_7']      = iconv('CP949','utf-8//IGNORE',$filedata[29]);
                                    $collection[$i]['a_day_8']      = iconv('CP949','utf-8//IGNORE',$filedata[30]);
                                    $collection[$i]['a_day_9']      = iconv('CP949','utf-8//IGNORE',$filedata[31]);
                                    $collection[$i]['a_day_10']     = iconv('CP949','utf-8//IGNORE',$filedata[32]);
                                    $collection[$i]['course']       = iconv('CP949','utf-8//IGNORE',$filedata[33]);
                                    $collection[$i]['s_h_fill']     = iconv('CP949','utf-8//IGNORE',$filedata[34]);
                                    $collection[$i]['promote_day']  = iconv('CP949','utf-8//IGNORE',$filedata[35]);
                                    $collection[$i]['promote_pot']  = iconv('CP949','utf-8//IGNORE',$filedata[36]);
                                    $collection[$i]['commendation'] = $commendation;
                                    $collection[$i]['disciplinary'] = $disciplinary;
                                    $collection[$i]['major']        = $major;
                                    $collection[$i]['detail']       = $detail;
                                    $i++;
                                }
                            }
                            if($i===0){
                                $i++;
                            }
                        }

                        $file_model->where('post_id', $get_max[0]['post_id'])->delete();
                        $model->insert($data);

                        foreach($collection as $prodData){
                            $file_model->insert($prodData, 'CP949');
                        }

                    }
                }
                return $this->response->redirect("/admin/org/");
            }
        }
    }

    public function insert_img(){
        $session = session();
        $my_id = $session->get('id');
        if($my_id == null){
            return $this->response->redirect("/admin/login/");
        }
    }

}