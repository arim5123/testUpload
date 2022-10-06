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
                <h5 style="font-weight: 600">조직도 ▶ 기관</h5>
            </header>
            <div class="insert_div">
                <p class="insert_btn">
                    기관 파일 등록하기(.csv) ▶
                    <a href="/admin/org/insert_div"><button type="button" class="btn btn-primary">등록</button></a>
                </p>
            </div>
            <h6 style="font-weight: 600; margin: 30px;">
                ▶ 현재 등록 된 기관 정보
            </h6>
            <div class="middle" style="width: 80%; margin: 0 0 50px 100px;">
                <table class="table">
                    <thead>
                    <tr style="text-align: center;">
                        <th width="10%">표출순서</th>
                        <th width="20%">기관명</th>
                        <th width="30%">상단제목</th>
                        <th>국관</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php if($post_list != null){
                        foreach ($post_list as $ntc) : ?>
                            <tr style="text-align: center; vertical-align: middle;">
                                <td><?=$ntc['d_order']?></td>
                                <td><?=$ntc['depart']?></td>
                                <td><?=$ntc['title']?></td>
                                <td><?=$ntc['team']?></td>
                            </tr>
                        <?php endforeach; ?>
                    <?php }else{ ?>
                        <tr>
                            <td colspan="2"><span class="none">등록 된 정보가 없습니다.</span></td>
                        </tr>
                    <?php }?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
</body>
</html>