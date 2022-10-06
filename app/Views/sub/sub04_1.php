<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>안덕초등학교</title>
    <link href="/css/style.css" rel="stylesheet" type="text/css">
    <script src="/bootstrap/js/jquery.min.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>

        function img_none(){
            Swal.fire({title : '해당 이미지는 확대가 불가합니다.', icon: 'info'});
        }

        function detail_popup(num){
            $.ajax({
                type: "post",
                url : '/sub/sub04/graduate_view/'+num,
                data : {info : "info"},
                async : true,
                /*dataType: "JSON",*/
                success: function(result)
                {
                    if(result['status'] == 'success') {
                        console.log(result);
                        Swal.fire({
                            html : result['html'],
                            width: 2000,
                            backdrop: `rgba(35,33,33,0.8)`,
                            background : 'rgb(255,255,255)',
                            showCloseButton: false,
                            showConfirmButton: false
                        });
                    }else {
                        Swal.fire({title : '다시 시도해주세요.', icon: 'error'});
                    }
                },
            });
        }
    </script>
</head>
<body>
<div id="Wrap" class="sub">

    <?php echo view('\include\header'); ?>

    <section>
        <h2 class="sub_title">졸업생 앨범</h2>
        <div class="container_area">
            <?php echo view('\include\homeback'); ?>
                <ul class="gallery">
                    <?php foreach ($post_list as $ntc) : ?>
                        <li>
                            <?php if($ntc['num'] < 10){ ?>
                                <a href="javascript:img_none();">
                                    <img src="/img/gallery/graduate/<?=$ntc['file_name']?>" />
                                    <span><?=$ntc['title'];?>회</span>
                                </a>
                            <?php }else{ ?>
                                <a href="javascript:detail_popup(<?=$ntc['num']?>);">
                                    <img src="/img/gallery/graduate/<?=$ntc['file_name']?>" />
                                    <span><?=$ntc['title'];?>회</span>
                                </a>
                            <?php } ?>
                        </li>
                    <?php endforeach; ?>
                </ul>
            <div class="page" style="text-align: center;">
                <?php if($pager) :?>
                    <?= $pager->links() ?>
                <?php endif ?>
            </div>
        </div>
    </section>

    <?php echo view('\include\gnb'); ?>

</div>
</body>
</html>
