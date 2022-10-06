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
    <link rel="stylesheet" href="https://rawgit.com/enyo/dropzone/master/dist/dropzone.css" />
    <script src="/assets/js/dropzone.min.js"></script>
    <script>

    </script>
</head>
<body>
<div class="d-flex" id="wrapper">

    <?php echo view('\admin\include\nav_menu'); ?>

    <div id="page-content-wrapper">

        <?php echo view('\admin\include\top'); ?>

        <div class="container" style="margin-top: 50px">

            <header id="header">
                <h5 style="font-weight: 600">알림마당</h5>
            </header>

            <form id="board_notice" class="form-inline" name="fname" method="POST">
                <h3>알림마당 등록</h3>
                <table class="intro">
                    <thead>
                    <tr>
                        <th width="10%"></th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td>제목</td>
                        <td><input type="text" id="title" name="title" class="form-control-file border" style="width: 100%;"/></td>
                    </tr>
                    <tr>
                        <td>첨부파일<br>(다중이미지)</td>
                        <td>
                            <div id="dropzone" class="dropzone"></div>
                            최적합 사이즈(가로*세로) : px * px
                        </td>
                    </tr>
                </table>
                <p style="text-align:center">
                    <a href="/admin/board/notice"><button type="button" class="btn btn-danger">취소</button></a> &nbsp;
                    <button id="btn-upload-file" class="btn btn-primary" type="button">등록</button>
                </p>
            </form>
        </div>
        <script>

            Dropzone.options.dropzone = {
                url: '/admin/notice/upload',
                autoProcessQueue: false,   // 자동업로드 여부 (true일 경우, 바로 업로드 되어지며, false일 경우, 서버에는 올라가지 않은 상태임 processQueue() 호출시 올라간다.)
                maxFiles: 50,               // 업로드 파일수
                maxFilesize: 50,           // 최대업로드용량 : 50MB
                parallelUploads: 50,       // 동시파일업로드 수(이걸 지정한 수 만큼 여러파일을 한번에 컨트롤러에 넘긴다.)
                addRemoveLinks: true,      // 삭제버튼 표시 여부
                dictRemoveFile: '삭제',     // 삭제버튼 표시 텍스트
                uploadMultiple: true,     // 다중업로드 기능
                init: function () {
                    var submitButton = document.querySelector("#btn-upload-file");
                    var myDropzone = this; //closure

                    submitButton.addEventListener("click", function () {
                        if($('#title').val().trim()==''){
                            Swal.fire({
                                icon: 'error',
                                title: '제목을 입력하세요',
                            });
                            return;
                        }
                        if(Dropzone.forElement('#dropzone').files.length == 0){
                            Swal.fire({
                                icon: 'error',
                                title: "이미지를 등록해주세요.",
                            });
                            return;
                        }
                        let title = $('#title').val();
                        myDropzone.processQueue();
                    });
                    myDropzone.on('success', function () {
                        myDropzone.removeAllFiles();
                        $('#title').val("");
                    });
                },
                sending: function (file, xhr, formData) {
                    formData.append("title", $('#title').val());
                },
                complete:function(rs){
                    console.log(rs);
                    if(rs['status'] == "success"){
                        Swal.fire({title : '등록되었습니다.', icon: 'success'}).then((result) => { location.replace('/admin/notice'); });
                    }else{
                        Swal.fire({title : '작업이 완료되지 않았습니다.', text:'다시 확인해주세요.', icon: 'error'}).then((result) => { location.replace('/admin/notice'); });
                    }
                }
            };
        </script>
    </div>
</div>
</body>
</html>
