<?php $state = date("A"); ?>
<script src="/bootstrap/js/jquery.min.js"></script>
<script type="text/JavaScript">

    function setData(){
        var aa = new Date();
        var year = aa.getFullYear(); //2022
        var month = aa.getMonth()+1; //8
        var date = aa.getDate(); //21
        if(month < 10){
            month = String("0")+String(month);
        }
        if(date < 10){
            date = String("0")+String(date);
        }
        var data = year + ". " + month + ". " + date;
        document.getElementById("date").innerHTML = data;
        console.log(data);
    }
    function timer() {
        $.ajax({
            type: "POST",
            url: "/admin/main/time_val",
            dataType: 'text',
            success : function(time_val) {
                var cnt = time_val * 60;
                console.log(cnt);
                setInterval(function() {
                    document.getElementById("Wrap").onclick = function() {
                        cnt = time_val * 60;
                    }
                    if( cnt == 0 ) {
                        clearInterval();
                        location.href = "/";
                    }
                    else { cnt--; }
                }, 1000);
            }
        });
    }
    function setClock(){
        var dateInfo = new Date();
        var hour = modifyNumber(dateInfo.getHours());
        var min = modifyNumber(dateInfo.getMinutes());
        document.getElementById("time").innerHTML = hour + ":" + min + "<span><?=$state?></span>";
    }
    function modifyNumber(time){
        if(parseInt(time)<10){
            return "0"+ time;
        } else return time;
    }


    $(document).ready(function(){
        console.log("들어옴");
        timer();
        setClock();
        setData();
        setInterval(setClock,1000); //1초마다 setClock 함수 실행
    })

</script>

<header>
    <div class="today_area">
        <p id="date" class="date"></p>
        <p id="time" class="time"></p>
    </div>
</header>