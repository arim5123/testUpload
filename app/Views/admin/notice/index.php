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

            <div class="sub_class">
                <div class="in_header">
                    <h5>알림마당</h5>
                </div>
                <table class="table table-hover">
                    <thead>
                    <tr>
                        <th width="10%">순서</th>
                        <th width="20%">제목</th>
                        <th>등록 이미지</th>
                        <th width="12%"></th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php if($post_list == null){ ?>
                        <tr>
                            <td colspan="4"><span class="none">게시글을 등록해 주세요.</span></td>
                        </tr>
                    <?php }else{
                        foreach ($post_list as $ntc) : ?>
                            <tr>
                                <td>
                                    <select id="order" name="order[]" onchange="Notice_myFunction(this.value)" >
                                        <?php for($o=1; $o <= count($p_val); $o++) { ?>
                                            <option <?php if($ntc['d_order'] == $o) {?> selected <?php } ?> value="<?=$ntc['num']?>_<?=$o?>_<?=$ntc['d_order']?>"><?=$o?></option>
                                        <?php } ?>
                                    </select>
                                </td>
                                <td><?=$ntc['title'];?></td>
                                <td>
                                    <?php for($i=0; $i<count($files_array); $i++){ if( $ntc['post_id'] == $files_array[$i]['post_id'] ){ ?>
                                        <img src="/img/notice/<?=$files_array[$i]['file_name']?>" />
                                    <?php } }?>
                                </td>
                                <td>
                                    <a href="/admin/notice/modify/<?=$ntc['num']?>"><button type="button" class="btn btn-outline-warning">수정</button></a>
                                    <a href="javascript:Notice_Delete_Swal(<?=$ntc['num']?>);"><button type="button" class="btn btn-outline-danger">삭제</button></a>
                                </td>
                            </tr>
                        <?php endforeach; } ?>
                    </tbody>
                </table>
                <div class="page_css" style="text-align: center; margin-top:50px;">
                    <?php if($pager) :?>
                        <?= $pager->links() ?>
                    <?php endif ?>
                </div>
            </div>
            <div style="text-align: center; width: 100%; margin-bottom: 50px;">
                <a href="/admin/notice/create"><button type="button" class="btn btn-green">추가</button></a>
            </div>
        </div>
    </div>
</div>
</body>
</html>