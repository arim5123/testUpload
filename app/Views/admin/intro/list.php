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
                <h5 style="font-weight: 600">대기화면</h5>
            </header>

            <div class="middle">
                <?php if($project == null){ ?>
                <span class="none">게시글을 등록해 주세요.</span>
                <?php }else{ ?>
                <ul>
                    <?php $no = 1; foreach ($project as $ntc) : ?>
                    <li>
                        <span class="top_span">게시물 <?=$no?></span>
                        <span class="time_span"><?=$ntc['time']?>분 후 작동</span>
                        <img src="/img/intro/<?=$ntc['file_name']?>"/>
                        <div class="intro_btn">
                            <a href="/admin/intro/modify/<?=$ntc['num']?>"><button type="button" class="btn btn-outline-success">수정</button></a>
                            <a href="javascript:Intro_Delete_Swal(<?=$ntc['num']?>);"><button type="button" class="btn btn-outline-danger">삭제</button></a>
                            <label class="switch-button">
                                <input id="on_off" type="checkbox" <?php if($ntc['state'] == "on"){ ?>checked <?php } ?> onclick="getCheckboxValue(<?=$ntc['num']?>)" />
                                <span class="onoff-switch"></span>
                            </label>
                            <script>
                                function getCheckboxValue(num){
                                    Intro_State_chg(num);
                                }
                            </script>
                        </div>
                    </li>
                    <?php $no++; endforeach; } ?>
                </ul>
            </div>

            <div style="text-align: center; width: 100%; margin-bottom: 50px;">
                <a href="/admin/intro/create"><button type="button" class="btn btn-green">추가</button></a>
            </div>

        </div>

    </div>
</div>
</body>
</html>