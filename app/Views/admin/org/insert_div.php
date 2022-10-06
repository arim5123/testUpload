<?php
$today = date("Y-m-d");
?>
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
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="/assets/js/common.js"></script>
    <link rel="stylesheet" href="https://rawgit.com/enyo/dropzone/master/dist/dropzone.css" />
    <script src="/assets/js/dropzone.min.js"></script>
</head>
<body>
<div class="d-flex" id="wrapper">

    <?php echo view('\admin\include\nav_menu'); ?>

    <div id="page-content-wrapper">

        <?php echo view('\admin\include\top'); ?>

        <div class="container" style="margin-top: 50px">

            <header id="header">
                <h5 style="font-weight: 600">등록 ▶ 기관</h5>
            </header>

            <form class="form-inline" name="fname" method="POST" enctype="multipart/form-data">
                <h3>엑셀파일 등록</h3>
                <table class="intro">
                    <thead>
                    <tr>
                        <th width="20%"></th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td>등록일</td>
                        <td><?=$today?></td>
                    </tr>
                    <tr>
                        <td>첨부파일(CSV파일)</td>
                        <td><input type="file" name="files" /></td>
                    </tr>
                </table>
                <p style="text-align:center"><input type="submit" class="btn btn-primary" value="등록"></p>
            </form>
        </div>
    </div>
</div>
</body>
</html>
