<!DOCTYPE>
<html>
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>모전초등학교_관리자페이지</title>
    <link rel="icon" type="image/x-icon" href="/assets/favicon.ico" />
    <link href="/bootstrap/css/styles.css" rel="stylesheet" />
    <script src="/bootstrap/js/jquery.min.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="/assets/js/common.js"></script>
    <style> a.p_ck { background-color: #04aa90; padding: 5px 8px; color: #fbfbfc; font-weight: 500; border-radius: 5px; } </style>
    <script type="text/javascript">
        function doDisplay(){
            var con = document.getElementById("myDIV");
            if(con.style.display=='block'){
                con.style.display = 'none';
            }else{
                con.style.display = 'block';
            }
        }
    </script>
</head>
<body>
<div class="d-flex" id="wrapper">

    <?php echo view('\admin\include\nav_menu'); ?>

    <div id="page-content-wrapper">

        <?php echo view('\admin\include\top'); ?>

        <div class="container" style="margin-top: 50px">

            <header id="header">
                <h5 style="font-weight: 600">관리자 정보 변경</h5>
            </header>

            <form id="pw_info" class="form-inline" method="POST" enctype="multipart/form-data">
                <table class="curriculum">
                    <thead>
                    <tr>
                        <th width="17%"></th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td>아이디</td>
                        <td><?=$my_id?></td>
                    </tr>
                    <tr>
                        <td>비밀번호</td>
                        <td>
                            <div id="myDIV" style="display: none; margin-bottom: 15px;">
                                <input type="password" name="chg_pw">
                            </div>
                            <a class="p_ck" href="javascript:doDisplay();">비밀번호변경</a>
                        </td>
                    </tr>
                    </tbody>
                </table>
                <p style="text-align:center">
                    <button class="btn btn-green" type="button" onclick="Change_pw_Swal(this)">저장</button>
                </p>
            </form>

        </div>
    </div>
</div>
</body>
</html>