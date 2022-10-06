<!DOCTYPE>
<html>
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>경찰청_관리자페이지</title>
    <link rel="icon" type="image/x-icon" href="/assets/favicon.ico" />
    <link href="/bootstrap/css/styles.css" rel="stylesheet" />
    <script src="/bootstrap/js/jquery.min.js"></script>
    <script src="/assets/js/common.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        .table tr td { vertical-align:middle; text-align:center; border-right: 1px solid #dee2e6; }
        .table tr td.div { border-right: 1px solid #858686; }
        .table tr td.none { border-right: 0px; background: #efefef }
        .table tr td:last-child { border-right: 0px; }
        .table tr td.long_txt { text-align: left; padding-left: 30px; }
    </style>
</head>
<body>
<div class="d-flex" id="wrapper">
    <?php echo view('\admin\include\nav_menu'); ?>
    <div id="page-content-wrapper">
        <?php echo view('\admin\include\top'); ?>
        <div class="container" style="margin-top: 50px">

            <header id="header">
                <h5 style="font-weight: 600">지휘부 상세 정보</h5>
            </header>

            <span class="middle_top_span"><?=$info[0]['name']?> <?=$info[0]['rank']?> 프로필 상세보기</span>
            <span class="middle_top_span right">
                <a href="/admin/org/list_text"><button type="button" class="btn btn-outline-primary" style="margin-top:-40px">목록으로</button></a>
            </span>
            <div class="middle" style="width: 80%; margin-left: 80px;">
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
                            <td class="div"><?=$info[0]['name']?> (<?=$info[0]['c_name']?>)</td>
                            <td>소속</td>
                            <td><?=$info[0]['depart']?></td>
                        </tr>
                        <tr>
                            <?php
                                if($info[0]['option_1'] != null){
                                    $option = "(치안정책관정)";
                                }else if($info[0]['option_2'] != null){
                                    $option = "(치안지도관)";
                                }else if($info[0]['option_3'] != null){
                                    $option = "(대기자)";
                                }else{
                                    $option = "";
                                }
                            ?>
                            <td>계급</td>
                            <td class="div"><?=$info[0]['rank']?><?=$option?></td>
                            <td>직위</td>
                            <td><?=$info[0]['position']?> <?php if($info[0]['div'] != null){ ?>(<?=$info[0]['div']?>)<?php } ?> </td>
                        </tr>

                        <tr>
                            <td>생년월일</td>
                            <td class="div"><?=$info[0]['birthday']?></td>
                            <td>연령</td>
                            <td><?=$info[0]['age']?></td>
                        </tr>

                        <tr>
                            <td>임용구분</td>
                            <td class="div"><?=$info[0]['apm']?></td>
                            <td>현급배명일</td>
                            <td><?=$info[0]['n_day']?></td>
                        </tr>

                        <tr>
                            <td>출신지역</td>
                            <td class="div"><?=$info[0]['country']?></td>
                            <td>출신고지역</td>
                            <td><?=$info[0]['hs_place']?></td>
                        </tr>

                        <tr>
                            <td>학력</td>
                            <td class="div"><?=$info[0]['education']?></td>
                            <td>최초배명일</td>
                            <td><?=$info[0]['initial_day']?></td>
                        </tr>

                        <tr>
                            <td>현보직일</td>
                            <td class="div"><?=$info[0]['p_day']?></td>
                            <td colspan="2" class="none"></td>
                        </tr>


                        <?php if($info[0]['rank'] == "총경"){
                            /* 연속참모 또는 서장기간 */
                            $period = (int)$info[0]['period'];
                            $quotient = (int)($period / 12);
                            $remainder = $period % 12;
                        ?>
                        <tr>
                            <td>현급승진</td>
                            <td class="div"><?=$info[0]['promote_pot']?> <?=$info[0]['promote_day']?></td>
                            <td>서울서장역임</td>
                            <td><?=$info[0]['s_h_fill']?></td>
                        </tr>
                        <tr>
                            <td>치안정책과정</td>
                            <td class="div"><?=$info[0]['course']?></td>
                            <td>정년임박여부</td>
                            <td><?=$info[0]['retirement']?></td>
                        </tr>
                        <tr>
                            <td>연속참모 또는 서장기간</td>
                            <td class="div"><?php if($quotient!=null){?> <?=$quotient?>년<?php } if($remainder!=null){ ?> <?=$remainder?>개월<?php }?></td>
                            <td colspan="2" class="none"></td>
                        </tr>
                        <?php }else{ ?>
                        <tr>
                            <td>정년임박여부</td>
                            <td class="div"><?=$info[0]['retirement']?></td>
                            <td colspan="2" class="none"></td>
                        </tr>
                        <?php } ?>
                        <tr>
                            <td>순경임용일</td>
                            <td class="div"><?=$info[0]['a_day_1']?></td>
                            <td>경장임용일</td>
                            <td><?=$info[0]['a_day_2']?></td>
                        </tr>
                        <tr>
                            <td>경사임용일</td>
                            <td class="div"><?=$info[0]['a_day_3']?></td>
                            <td>경위임용일</td>
                            <td><?=$info[0]['a_day_4']?></td>
                        </tr>
                        <tr>
                            <td>경감임용일</td>
                            <td class="div"><?=$info[0]['a_day_5']?></td>
                            <td>경정임용일</td>
                            <td><?=$info[0]['a_day_6']?></td>
                        </tr>
                        <tr>
                            <td>총경임용일</td>
                            <td class="div"><?=$info[0]['a_day_7']?></td>
                            <td>경무관임용일</td>
                            <td><?=$info[0]['a_day_8']?></td>
                        </tr>
                        <tr>
                            <td>치안감임용일</td>
                            <td class="div"><?=$info[0]['a_day_9']?></td>
                            <td>치안정감임용일</td>
                            <td><?=$info[0]['a_day_10']?></td>
                        </tr>

                        <tr>
                            <td>상훈</td>
                            <td class="div long_txt">
                                <?php if($cmd != null){
                                    for($i=0; $i<count($cmd); $i++){ ?>
                                        <?=$cmd[$i]?></br>
                                <?php } } ?>
                            </td>
                            <td>징계</td>
                            <td class="long_txt">
                                <?php if($dp != null){
                                    for($i=0; $i<count($dp); $i++){ ?>
                                        <?=$dp[$i]?></br>
                                <?php } }?>
                            </td>
                        </tr>
                        <tr>
                            <td>주요 경력</td>
                            <td class="div long_txt">
                                <?php for($i=0; $i<count($major_arr); $i++){ ?>
                                    <?=$major_arr[$i]?></br>
                                <?php } ?>
                            </td>
                            <td>세부 경력</td>
                            <td class="long_txt">
                                <?php for($i=0; $i<count($detail_arr); $i++){ ?>
                                    <?=$detail_arr[$i]?></br>
                                <?php } ?>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
</body>
</html>