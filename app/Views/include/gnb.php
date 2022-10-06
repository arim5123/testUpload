<?php
    $var = uri_string();
?>
<script type="text/JavaScript">
    window.onload = function(){
        var url = "<?=$var?>"
        if(url.includes("sub01") === true){
            document.getElementById("main_btn_01").src = "/images/common/gnb01_on.png";
        }else if(url.includes("sub02") === true){
            document.getElementById("main_btn_02").src = "/images/common/gnb02_on.png";
        }else if(url.includes("sub03") === true){
            document.getElementById("main_btn_03").src = "/images/common/gnb03_on.png";
        }else{
            document.getElementById("main_btn_04").src = "/images/common/gnb04_on.png";
        }
    }
</script>

<nav class="btn">
    <ul>
        <a href="/sub/sub01"><li><img id="main_btn_01" src="/images/common/gnb01.png" /></li></a>
        <a href="/sub/sub02"><li><img id="main_btn_02" src="/images/common/gnb02.png" /></li></a>
        <a href="/sub/sub03"><li><img id="main_btn_03" src="/images/common/gnb03.png" /></li></a>
        <a href="/sub/sub04"><li><img id="main_btn_04" src="/images/common/gnb04.png" /></li></a>
    </ul>
</nav>

<footer>
    <a href="/">
        <span><img src="/images/common/logo.png" /></span>
    </a>
</footer>