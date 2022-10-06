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
</head>
<body>
<div class="d-flex" id="wrapper">
    <?php echo view('\admin\include\nav_menu'); ?>
    <div id="page-content-wrapper">
        <?php echo view('\admin\include\top'); ?>
        <div class="container" style="margin-top: 50px">

            <header id="header">
                <h5 style="font-weight: 600">조직도 ▶ 인사정보</h5>
            </header>
            <div class="insert_div">
                <p class="insert_btn">
                    인사정보 파일 등록하기(.csv) ▶
                    <a href="/admin/org/insert_text"><button type="button" class="btn btn-primary">등록</button></a>
                </p>
            </div>
            <h6 style="font-weight: 600; margin: 30px;">
                ▶ 현재 등록 된 인사 정보
            </h6>
            <div class="middle" style="width: 95%; margin-left: 30px;">
                <table class="table">
                    <thead>
                    <tr style="text-align: center;">
                        <th width=4%"">구분</th>
                        <th width="12%">성명(한자)</th>
                        <th width="13%">소속</th>
                        <th width="7%">계급</th>
                        <th width="16%">직위</th>
                        <th width="8%">생년월일</th>
                        <th width="7%">출신지역</th>
                        <th width="8%">현급배명일</th>
                        <th width="8%">최초배명일</th>
                        <th width="8%">현보직일</th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php if($post_list != null){
                        $url = $_SERVER['REQUEST_URI'];
                        $array = explode("=", $_SERVER['QUERY_STRING']);
                        if($array[0] != null){
                            if($array[1] > 1){
                                $no = 0 + (($array[1]-1)*10);
                            }else{
                                $no = 0;
                            }
                        }else{
                            $no = 0;
                        }
                        foreach ($post_list as $ntc) : $no++;?>
                            <tr style="text-align: center; vertical-align: middle;">
                                <th style="text-align: center;"><?=$no?></th>
                                <td><?=$ntc['name']?> (<?=$ntc['c_name']?>)</td>
                                <td><?=$ntc['depart']?></td>
                                <td><?=$ntc['rank']?></td>
                                <td><?=$ntc['position']?><?php if($ntc['div'] != null){ ?>(<?=$ntc['div']?>)<?php } ?></td>
                                <td><?=$ntc['birthday']?></td>
                                <td><?=$ntc['country']?></td>
                                <td><?=$ntc['n_day']?></td>
                                <td><?=$ntc['initial_day']?></td>
                                <td><?=$ntc['p_day']?></td>
                                <td>
                                    <a href="/admin/org/detail/<?=$ntc['id']?>"><button type="button" class="btn btn-outline-warning">상세보기</button></a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php }else{ ?>
                        <tr>
                            <td colspan="10"><span class="none">등록 된 정보가 없습니다.</span></td>
                        </tr>
                    <?php }?>
                    </tbody>
                </table>
            </div>

            <div class="page_css">
                <?php if($pager) :?>
                    <?= $pager->links() ?>
                <?php endif ?>
            </div>
        </div>
    </div>
</div>
</body>
</html>