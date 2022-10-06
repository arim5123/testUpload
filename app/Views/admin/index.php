<!DOCTYPE>
<html>
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>안덕초등학교_관리자페이지</title>
    <link rel="icon" type="image/x-icon" href="/assets/favicon.ico" />
    <link href="/bootstrap/css/styles.css" rel="stylesheet" />
    <script src="/bootstrap/js/jquery.min.js"></script>
    <script src="/assets/js/common.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        .zoom_4kp  {
            -moz-transform: scale(0.2);
            -moz-transform-origin: 0 0;
            -webkit-transform: scale(0.2);
            -webkit-transform-origin: 0 0;
            -o-transform: scale(0.2);
            -o-transform-origin: 0 0;
            -ms-transform: scale(0.2);
            -ms-transform-origin: 0 0;
            transform: scale(0.2);
            transform-origin: 0 0;
            border:0;
        }
        .preFrame {transform: scale(0.4); transform-origin: 0 0;  border: 0; }
    </style>
</head>
<body>
<div class="d-flex" id="wrapper">
    <?php echo view('\admin\include\nav_menu'); ?>
    <div id="page-content-wrapper">
        <?php echo view('\admin\include\top'); ?>
        <div class="container" style="margin-top: 50px">
            <header id="header">
                <h5 style="font-weight: 600">미리보기</h5>
            </header>
            <div style="width: 100%; margin-bottom: 20px">
                <span>▶ 자동전환시간</span>
                <select id="sel1" name="time" style="width: 70px;" onchange="changeTimeSetting(this.value)">
                    <?php for($i=1; $i <= 10; $i++) { ?>
                        <option <?php if($val == $i) {?> selected <?php }?> value="<?=$i?>" ><?=$i?>분</option>
                    <?php } ?>
                </select>
            </div>

            <div class="kiosk_pre">
                <span>▶ 미리보기</span>
                <div style=" width:432px; height:768px; margin:20px 0; padding:0; overflow:hidden; border:2px solid #000000;">
                    <iframe id="pre_view" src="http://localhost:8080/" width="2160" height="3840" class="zoom_4kp"></iframe>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>