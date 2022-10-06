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
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="/assets/js/common.js"></script>
    <link rel="stylesheet" href="https://rawgit.com/enyo/dropzone/master/dist/dropzone.css" />
    <script src="/assets/js/dropzone.min.js"></script>
</head>
<body
<div class="d-flex" id="wrapper">
    <?php echo view('\admin\include\nav_menu'); ?>
    <div id="page-content-wrapper">
        <?php echo view('\admin\include\top'); ?>
        <div class="container" style="margin-top: 50px">
            <form class="form-inline" method="POST" enctype="multipart/form-data">
                <h3>인트로 등록</h3>
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
                            <td><input type="text" id="title" name="title" value="" class="form-control form-control" /></td>
                        </tr>
                        <tr>
                            <td>첨부파일</td>
                            <td style="color: #888888">
                                <div id="dropzone" class="dropzone"></div>
                                최적합 사이즈(가로*세로) : px * px
                            </td>
                        </tr>
                    </tbody>
                </table>
                <p style="text-align:center">
                    <a href="/admin/intro"><button type="button" class="btn btn-danger">취소</button></a> &nbsp;
                    <button id="btn-upload-file" class="btn btn-primary" type="button">등록</button>
                </p>
            </form>
        </div>
        <script>
            Dropzone.options.dropzone = {
                url: '/admin/intro/intro_upload',
                autoProcessQueue: false,   // 자동업로드 여부 (true일 경우, 바로 업로드 되어지며, false일 경우, 서버에는 올라가지 않은 상태임 processQueue() 호출시 올라간다.)
                maxFiles: 1,               // 업로드 파일수
                maxFilesize: 50,           // 최대업로드용량 : 50MB
                parallelUploads: 50,       // 동시파일업로드 수(이걸 지정한 수 만큼 여러파일을 한번에 컨트롤러에 넘긴다.)
                addRemoveLinks: true,      // 삭제버튼 표시 여부
                dictRemoveFile: '삭제',     // 삭제버튼 표시 텍스트
                uploadMultiple: false,     // 다중업로드 기능
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
                        if(Dropzone.forElement('#dropzone').files.length > 1){
                            Swal.fire({
                                icon: 'error',
                                title: "한장의 이미지만 등록 가능합니다.",
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
                success:function(file, response){
                    console.log("값 : " + response.success);
                    if(response.success == 1){
                        Swal.fire({title : '등록되었습니다.', icon: 'success'}).then((result) => { location.replace('/admin/intro'); });
                    }else{
                        Swal.fire({title : '작업이 완료되지 않았습니다.', text:'다시 확인해주세요.', icon: 'error'}).then((result) => { location.replace('/admin/intro'); });
                    }
                }
            };
        </script>
    </div>
</div>
</body>
</html>
