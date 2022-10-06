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
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="/assets/js/common.js"></script>
    <script>
        $(document).ready(function () {
            var time = <?=$intro_set['time']?>;
            $('#sel1').val(time).prop("selected",true);
        });
    </script>
</head>
<body>

<div class="d-flex" id="wrapper">

    <?php echo view('\admin\include\nav_menu'); ?>

    <div id="page-content-wrapper">

        <?php echo view('\admin\include\top'); ?>

        <div class="container" style="margin-top: 50px">

            <header id="header" style="margin-bottom: 0px;">
                <h5 style="font-weight: 600">대기화면 ▶ 환경설정</h5>
            </header>

            <div class="container">
                <form id="intro_setting" class="form-inline" method="POST" enctype="multipart/form-data">
                    <table class="intro">
                        <thead>
                        <tr>
                            <th width="15%"></th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td>사용여부</td>
                            <td>
                                <label class="form-check-label" for="radio1"><input type="radio" class="form-check-input" id="radio1" name="status" value="used" <?php if($intro_set['status'] == "used") { ?> checked <?php } ?> >사용</label>
                                &nbsp;
                                <label class="form-check-label" for="radio2"><input type="radio" class="form-check-input" id="radio2" name="status" value="stopped" <?php if($intro_set['status'] == "stopped") { ?> checked <?php } ?> >중지</label>
                            </td>
                        </tr>
                        <tr>
                            <td>대기시간</td>
                            <td>
                                <select id="sel1" name="time" style="width: 50px;">
                                    <option value="5">5</option>
                                    <option value="6">6</option>
                                    <option value="7">7</option>
                                    <option value="8">8</option>
                                    <option value="9">9</option>
                                    <option value="10">10</option>
                                    <option value="20">20</option>
                                    <option value="30">30</option>
                                    <option value="40">40</option>
                                    <option value="50">50</option>
                                    <option value="60">60</option>
                                    <option value="90">90</option>
                                    <option value="120">120</option>
                                </select>&nbsp;(초단위)
                                <p style="margin: 5px 0 0 0;">- 최소 값 5초<br>- 등록 된 이미지가 1개 이상 일 경우, 설정하신 시간에 맞게 이미지가 자동으로 롤링됩니다. </p>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                    <p style="text-align:center">
                        <button class="btn btn-green" type="button" onclick="ModifyFunction_Swal()" >수정</button>
                    </p>
                </form>
            </div>
        </div>
    </div>
</div>
</body>
</html>