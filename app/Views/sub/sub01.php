<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>안덕초등학교</title>
    <link href="/css/style.css" rel="stylesheet" type="text/css">
</head>
<script type="text/JavaScript">

    function setImg(num){
        var element01 = document.getElementById('active01');
        var element02 = document.getElementById('active02');
        var element03 = document.getElementById('active03');
        var element04 = document.getElementById('active04');

        element01.classList.remove('active');
        element02.classList.remove('active');
        element03.classList.remove('active');
        element04.classList.remove('active');

        if(num === 1){
            document.getElementById("title_obj").innerHTML = "인사말";
            document.getElementById("img_obj").src = "/img/school/msg/<?=$file_name_01?>";
            element01.classList.add('active');
        }else if(num === 2){
            document.getElementById("title_obj").innerHTML = "학교연혁";
            document.getElementById("img_obj").src = "/img/school/history/<?=$file_name_02?>";
            element02.classList.add('active');
        }else if(num === 3){
            document.getElementById("title_obj").innerHTML = "학교소개";
            document.getElementById("img_obj").src = "/img/school/info/<?=$file_name_03?>";
            <?php $menu_gnb3 = "active"; ?>
            element03.classList.add('active');
        }else{
            document.getElementById("title_obj").innerHTML = "교가";
            document.getElementById("img_obj").src = "/img/school/song/<?=$file_name_04?>";
            <?php $menu_gnb4 = "active"; ?>
            element04.classList.add('active');
        }
    }

</script>

<body>
<div id="Wrap" class="sub">

    <?php echo view('\include\header'); ?>

    <section>
        <h2 id="title_obj" class="sub_title">인사말</h2>
        <div class="container_area">
            <?php echo view('\include\homeback'); ?>
            <div class="colgroup">
                <img id="img_obj" src="/img/school/msg/<?=$file_name_01?>"/>
            </div>
            <div class="sub_tab">
                <a id="active01" href="javascript:setImg(1);" class="active">인사말</a>
                <a id="active02" href="javascript:setImg(2);" class="">학교연혁</a>
                <a id="active03" href="javascript:setImg(3);" class="">학교소개</a>
                <a id="active04" href="javascript:setImg(4);" class="">교가</a>
            </div>
        </div>
    </section>

    <?php echo view('\include\gnb'); ?>

</div>
</body>
</html>
