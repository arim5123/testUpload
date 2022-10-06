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
    <script> var page_val = '3';</script>
</head>
<body>
<div class="d-flex" id="wrapper">

    <?php echo view('\admin\include\nav_menu'); ?>

    <div id="page-content-wrapper">

        <?php echo view('\admin\include\top'); ?>

        <div class="container" style="margin-top: 50px">

            <header id="header">
                <h5 style="font-weight: 600">학교소개</h5>
            </header>

            <form id="school_info" class="form-inline" method="POST">
                <table class="curriculum">
                    <thead>
                    <tr>
                        <th width="17%"></th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td>현재 등록 된 이미지</td>
                        <td><img src="/img/school/info/<?=$file_name?>" style="max-width: 700px; min-width: 500px;"/></td>
                    </tr>
                    <tr class="c_text">
                        <td></td>
                        <td>변경을 원하시는 경우, 파일을 첨부 후 수정버튼을 눌러주세요.</td>
                    </tr>
                    <tr class="c_input">
                        <td></td>
                        <td>
                            <input type="file" name="files" class="form-control-file border"/>
                            &nbsp;&nbsp;최적합 사이즈(가로*세로) : px * px
                        </td>
                    </tr>
                    </tbody>
                </table>
                <p style="text-align:center">
                    <button class="btn btn-green" type="button" onclick="School_Modify_Swal(this)">저장</button>
                </p>
            </form>
        </div>
    </div>
</div>
</body>
</html>
