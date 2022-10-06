<?php ?>
<!DOCTYPE HTML>
<html>
<head>
    <title>모전초등학교_관리자페이지</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
    <link href="/bootstrap/css/styles.css" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <script src="/bootstrap/js/jquery.min.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="/assets/js/common.js"></script>
    <style>
        #POP1 {
            width: 100%;
            text-align: center;
            display: none;
            color: #fc3e47;
            font-weight: bolder;
            font-size: 17px;
            margin-bottom: 35px;
        }
    </style>
</head>
<body>
<div class="container">
    <div class="row justify-content-center" style="margin-top: 60px;">
        <h7>안덕초등학교<br/>관리자페이지</h7>
        <div class="col-xl-6 col-lg-8 col-md-9" style="margin-top: 30px">
            <div class="card o-hidden border-0 shadow-lg my-5">
                <div class="card-body p-0" >
                    <div class="col-lg-12" >
                        <div class="p-5" >
                            <div class="text-center">
                                <h4 class="mb-4">Admin Login Page</h4>
                            </div>
                            <form id="login_info" class="user" method="post" enctype="multipart/form-data">
                                <div class="form-group">
                                    <input type="text" class="form-control form-control-user" name="id" placeholder="ID" >
                                </div>
                                <div class="form-group">
                                    <input type="password" class="form-control form-control-user" name="pw" placeholder="Password" >
                                </div>
                                <div class="form-group_2">
                                    <input type="submit" class="btn btn-primary btn-user btn-block" value="login" style="margin-top: 15px;"><!--onclick="LoginChkFunction(this)"-->
                                </div>
                            </form>
                        </div>
                        <?php if($type == "id_failed"){ ?>
                            <div id="POP1" style="display: block;"><p>아이디가 올바르지 않습니다.</p></div>
                        <?php }elseif ($type == "pw_failed") {?>
                            <div id="POP1" style="display: block;"><p>비밀번호가 올바르지 않습니다.</p></div>
                        <?php }elseif ($type == "all_failed") {?>
                            <div id="POP1" style="display: block;"><p>아이디와 비밀번호를 입력해주세요.</p></div>
                        <?php }else {?>
                            <div id="POP1"></div>
                        <?php }?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>