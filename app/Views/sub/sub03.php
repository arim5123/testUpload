<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>안덕초등학교</title>
    <link href="/css/style.css" rel="stylesheet" type="text/css">
</head>
<body>
<div id="Wrap" class="sub">

    <?php echo view('\include\header'); ?>

    <section>
        <h2 class="sub_title">알림마당</h2>
        <div class="container_area">
            <?php echo view('\include\homeback'); ?>
            <?php if($post_list != null){ $i = 0; ?>
                <ul class="gallery">
                    <?php foreach ($post_list as $ntc) : ?>
                        <li>
                            <a href="/sub/sub03/view/<?=$ntc['num']?>">
                                <img src="/img/notice/<?=$files_array[$i]['file_name']?>" />
                                <span><?=$ntc['title'];?></span>
                            </a>
                        </li>
                    <?php $i++; endforeach; ?>
                </ul>

            <?php }else{ ?>
                <span class="none">등록 된 공지사항이 없습니다.</span>
            <?php } ?>
            <div class="page" style="text-align: center; ">
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
