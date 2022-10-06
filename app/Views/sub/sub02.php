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
        <h2 class="sub_title">학교현황</h2>
        <div class="container_area">
            <?php echo view('\include\homeback'); ?>
            <img src="/img/count/<?=$file_name?>"/>
        </div>
    </section>

    <?php echo view('\include\gnb'); ?>

</div>
</body>
</html>
