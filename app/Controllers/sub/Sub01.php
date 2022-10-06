<?php
namespace App\Controllers\sub;

use App\Models\DptExcelCTSModel;
use App\Models\DptExcelModel;
use App\Models\ExcelCTSModel;
use App\Models\ExcelModel;
use CodeIgniter\API\ResponseTrait;
use CodeIgniter\Controller;

class Sub01 extends Controller
{
    public function view($dpt){

        $model = new DptExcelModel();
        $file_model = new DptExcelCTSModel();
        $ps_model = new ExcelModel();
        $ps_file_model = new ExcelCTSModel();

        /* 사이드메뉴_기관 리스트 메뉴 표출용 */
        $get_max = $model->selectMax('post_id')->find();
        $post_id = (int)$get_max[0]['post_id'];
        $post_list = $file_model->where('post_id',$post_id)->orderBy("d_order","asc")->findAll();

        /* 해당 기관 인사정보 자료 표출용 */
        $ps_get_max = $ps_model->selectMax('post_id')->find();
        $ps_post_id = (int)$ps_get_max[0]['post_id'];

        /* 해당 기관명, 상단 제목, 국관 추출 */
        $this_val = $file_model->select('depart, title, team')->where('d_order',$dpt)->find();
        $team  = $this_val[0]['team'];
        $team_arr = explode(",", preg_replace("/\s+/", "", $team));

        $post_query = [];
        for($i=0; $i<count($team_arr); $i++){
            $data = [ 'post_id' => $ps_post_id, 'd_order' => $dpt, 'team' => $team_arr[$i] ];
            $query = $ps_file_model->where($data)->orderBy("c_order","asc")->findAll();
            array_push($post_query, $query);
        }


        return view("/sub/sub01",[
            'post_list' => $post_list,
            'this_depart' => $this_val[0]['depart'],
            'title' => $this_val[0]['title'],
            'team_arr' => $team_arr,
            'post_query' => $post_query
        ]);

    }

    use ResponseTrait;
    public function detail($id){

        $model = new ExcelCTSModel();

        $post_query = $model->where('id',$id)->find();

        $name           = $post_query[0]['name'];
        $c_name         = $post_query[0]['c_name'];
        $depart         = $post_query[0]['depart'];
        $position       = $post_query[0]['position'];
        $div            = $post_query[0]['div'];
        $rank           = $post_query[0]['rank'];
        $birthday       = $post_query[0]['birthday'];
        $age            = $post_query[0]['age'];
        $apm            = $post_query[0]['apm'];
        $n_day          = $post_query[0]['n_day'];
        $country        = $post_query[0]['country'];
        $hs_place       = $post_query[0]['hs_place'];
        $education      = $post_query[0]['education'];
        $initial_day    = $post_query[0]['initial_day'];
        $p_day          = $post_query[0]['p_day'];
        $retirement     = $post_query[0]['retirement'];
        $period         = $post_query[0]['period'];
        $a_day_1        = $post_query[0]['a_day_1'];
        $a_day_2        = $post_query[0]['a_day_2'];
        $a_day_3        = $post_query[0]['a_day_3'];
        $a_day_4        = $post_query[0]['a_day_4'];
        $a_day_5        = $post_query[0]['a_day_5'];
        $promotion      = $post_query[0]['promotion'];
        $h_num          = $post_query[0]['h_num'];
        $course         = $post_query[0]['course'];
        $s_h_fill       = $post_query[0]['s_h_fill'];
        $promote_day    = $post_query[0]['promote_day'];
        $promote_pot    = $post_query[0]['promote_pot'];
        $commendation   = $post_query[0]['commendation'];
        $disciplinary   = $post_query[0]['disciplinary'];
        $major          = $post_query[0]['major'];
        $detail         = $post_query[0]['detail'];

        if($period != 0 ){
            $quotient = ($period - ($period % 12)) / 12;
            $remainder = $period % 12;
            if($quotient!=0 && $remainder!=0){
                $period_rs = $quotient."년".$remainder."개월";
            }elseif($quotient!=0 && $remainder==0){
                $period_rs = $quotient."년";
            }elseif($quotient==0 && $remainder!=0){
                $period_rs = $remainder."개월";
            }else{
                $period_rs = "";
            }
        }else{
            $period_rs = "";
        }

        $html = '
        <table class="table">
                    <thead>
                        <tr>
                            <th width="20%"></th>
                            <th width="30%"></th>
                            <th width="20%"></th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>이름</td>
                            <td class="div">'.$name.'('.$c_name.')</td>
                            <td>소속</td>
                            <td>'.$depart.'</td>
                        </tr>
                        <tr>
                            <td>계급</td>
                            <td class="div">'.$position.' '.$div.'</td>
                            <td>직위</td>
                            <td>'.$rank.'</td>
                        </tr>

                        <tr>
                            <td>생년월일</td>
                            <td class="div">'.$birthday.'</td>
                            <td>연령</td>
                            <td>'.$age.'</td>
                        </tr>

                        <tr>
                            <td>임용구분</td>
                            <td class="div">'.$apm.'</td>
                            <td>현급배명일</td>
                            <td>'.$n_day.'</td>
                        </tr>

                        <tr>
                            <td>출신지역</td>
                            <td class="div">'.$country.'</td>
                            <td>출신고지역</td>
                            <td>'.$hs_place.'</td>
                        </tr>

                        <tr>
                            <td>학력</td>
                            <td class="div">'.$education.'</td>
                            <td>최초배명일</td>
                            <td>'.$initial_day.'</td>
                        </tr>

                        <tr>
                            <td>현보직일</td>
                            <td class="div">'.$p_day.'</td>
                            <td>정년임박여부</td>
                            <td>'.$retirement.'</td>
                        </tr>

                        <tr>
                            <td>연속 참모 또는 서장기간</td>
                            <td class="div">'.$period_rs.'</td>
                            <td colspan="2" class="none"></td>
                        </tr>
                        <tr>
                            <td>경정임용일</td>
                            <td class="div">'.$a_day_1.'</td>
                            <td>총경임용일</td>
                            <td>'.$a_day_2.'</td>
                        </tr>

                        <tr>
                            <td>경무관임용일</td>
                            <td class="div">'.$a_day_3.'</td>
                            <td>치안감임용일</td>
                            <td>'.$a_day_4.'</td>
                        </tr>

                        <tr>
                            <td>치안정감임용일</td>
                            <td class="div">'.$a_day_5.'</td>
                            <td colspan="2" class="none"></td>
                        </tr>

                        <tr>
                            <td>서장횟수</td>
                            <td class="div">'.$h_num.'</td>
                            <td>서울서장역임</td>
                            <td>'.$s_h_fill.'</td>
                        </tr>

                        <tr>
                            <td>현급승진</td>
                            <td class="div">'.$promotion.'</td>
                            <td>치안정책과정</td>
                            <td>'.$course.'</td>
                        </tr>

                        <tr>
                            <td>표창</td>
                            <td class="div long_txt">'.$commendation.'</td>
                            <td>징계</td>
                            <td class="long_txt">'.$disciplinary.'</td>
                        </tr>
                        <tr>
                            <td>주요 경력</td>
                            <td class="div long_txt">'.$major.'</td>
                            <td>세부 경력</td>
                            <td class="long_txt"><a href="javascript:open();">[자세히보기]</a></td>
                        </tr>
                    </tbody>
                </table>
                <div class="btn_close" onclick="Swal.close();" style="position: absolute; bottom:-30px; left:725px;">
                    <img src="/img/close_b.png" width="50"/>
                </div>
                <div id="open" style="display: none; width: 400px; height: 250px; position: absolute; top:500px; left:1050px; background-color: #d6e7fb;"> 
                    <p>'.$detail.'</p>
                    <div id="close" style="position: absolute; top:220px; left:170px;">
                        <a href="javascript:close();"><img src="/img/close_b.png" width="50"/></a>
                    </div>
                </div>
        ';
        $return_val = ['status'=>'success', 'html' =>$html];
        return $this->respond($return_val);
    }
}