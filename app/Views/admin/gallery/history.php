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
                <h5 style="font-weight: 600">갤러리 ▶ 역사관</h5>
            </header>

            <div class="sub_class">
                <div class="in_header">
                    <h5>역사관</h5>
                </div>
                <table class="table table-hover">
                    <thead>
                    <tr>
                        <th width="10%">순서</th>
                        <th width="20%">(역사)년도</th>
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
                        $url = $_SERVER['REQUEST_URI'];
                        $array = explode("=", $_SERVER['QUERY_STRING']);
                        if($array[0] != null){
                            if($array[1] > 1){
                                $no = 0 + (($array[1]-1)*10);
                            }else{
                                $no = 0;
                            }
                        }else{
                            $no = 0;
                        }
                        foreach ($post_list as $ntc) : $no++; ?>
                            <tr>
                                <td><?=$no?></td>
                                <td><?=$ntc['title'];?></td>
                                <td>
                                    <?php for($i=0; $i<count($files_array); $i++){ if( $ntc['post_id'] == $files_array[$i]['post_id'] ){ ?>
                                        <img src="/img/gallery/history/<?=$files_array[$i]['file_name']?>" style="width:100px; height: 100px;"/>
                                    <?php } }?>
                                </td>
                                <td>
                                    <a href="/admin/gallery/history_modify/<?=$ntc['num']?>"><button type="button" class="btn btn-outline-warning">수정</button></a>
                                    <a href="javascript:Gallery_History_Delete_Swal(<?=$ntc['num']?>);"><button type="button" class="btn btn-outline-danger">삭제</button></a>
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
                <a href="/admin/gallery/history_create"><button type="button" class="btn btn-green">추가</button></a>
            </div>
        </div>
    </div>
</div>
</body>
</html>