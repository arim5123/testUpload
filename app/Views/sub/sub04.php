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
        <h2 class="sub_title">갤러리</h2>
        <div class="container_area">
            <?php echo view('\include\homeback'); ?>
            <div class="colgroup">
                <p class="sub04_btn"><img src="/images/sub/sub04_btn.png" usemap="#Map" />
                    <map name="Map">
                        <area shape="rect" coords="445,538,1208,823"  href="/sub/sub04/graduate" alt="졸업생 앨범">
                        <area shape="rect" coords="449,927,1207,1220" href="/sub/sub04/history" alt="역사관">
                    </map>
                </p>
            </div>
    </section>

    <?php echo view('\include\gnb'); ?>

</body>
</html>
