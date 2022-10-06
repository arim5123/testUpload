<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>안덕초등학교</title>
    <link href="/css/style.css" rel="stylesheet" type="text/css">
</head>
<body>
<div id="Wrap">
    <?php $no = 0; foreach ($intro_info as $intro) : $no++;?>
        <a href="/index_main"><img class="mySlides" src="/img/intro/<?=$intro['file_name']?>" width="2160px" height="3840px"/></a>
    <?php endforeach; ?>
</div>
</body>
</html>
<script>
    var myIndex = 0;
    var time = <?=$intro_set['time']?>;
    carousel();

    function carousel() {
        var i;
        var x = document.getElementsByClassName("mySlides");
        for (i = 0; i < x.length; i++) {
            x[i].style.display = "none";
        }
        myIndex++;
        if (myIndex > x.length) {
            myIndex = 1;
        }
        x[myIndex-1].style.display = "block";
        setTimeout(carousel, time*1000); // 1 seconds = 1000
    }

</script>
<script src="/bootstrap/js/jquery.min.js"></script>
