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
                <h5 style="font-weight: 600">대기화면(인트로)</h5>
            </header>
            <table class="table">
                <thead>
                <tr>
                    <th width="5%">No</th>
                    <th width="10%">출력순서</th>
                    <th width="20%">미리보기</th>
                    <th style="text-align: left;">제목</th>
                    <th width="10%"></th>
                </tr>
                </thead>
                <tbody>
                <?php if(count($intro_info) == 0) { ?>
                    <tr>
                        <td colspan="5">게시물을 등록해 주세요.</td>
                    </tr>
                <?php }else{
                    $no = 0;
                    foreach ($intro_info as $intro) : $no++;?>
                    <tr>
                        <td><?=$no?></td>
                        <td>
                            <select id="order" name="order[]" onchange="myFunction(this.value)" >
                                <?php for($i=1; $i <= count($intro_info); $i++) { ?>
                                    <option <?php if($intro['d_order'] == $i) {?> selected <?php } ?> value="<?=$intro['num']?>_<?=$i?>_<?=$intro['d_order']?>"><?=$i?></option>
                                <?php } ?>
                            </select>
                        </td>
                        <td><img src="/img/intro/<?=$intro['file_name']?>" style="max-width: 100px; max-height: 120px"/></td>
                        <td style="text-align: left;"><?=$intro['title']?></td>
                        <td><a href="javascript:DeleteFunction_Swal(<?=$intro['num']?>);"><button type="button" class="btn btn-outline-danger">삭제</button></a></td>
                    </tr>
                <?php endforeach; }?>
                </tbody>
            </table>
            <div style="text-align: center; width: 100%;">
                <a href="/admin/intro/create"><button type="button" class="btn btn-green">추가</button></a>
            </div>
        </div>

    </div>
</div>
</body>
</html>

