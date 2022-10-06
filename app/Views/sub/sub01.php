<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>경찰청</title>
    <link href="/css/style.css" rel="stylesheet" type="text/css">
    <script src="/assets/js/common.js"></script>
    <link href="/bootstrap/css/styles.css" rel="stylesheet" />
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        ul li.on { color: #fc3e47; }
        a {text-decoration: none; color:#000;}
        p { margin: 0px; }
        .table tr td { vertical-align:middle; text-align:center; border-right: 1px solid #dee2e6; }
        .table tr td.div { border-right: 1px solid #858686; }
        .table tr td.none { border-right: 0px; background: #efefef }
        .table tr td:last-child { border-right: 0px; }
        .table tr td.long_txt { text-align: left; padding-left: 30px; }
    </style>
</head>

<body>
<div id="Wrap" class="main">
    <div style="position:relative; float:left; width: 250px; height: 900px; border-right: 1px solid red;">
        <ul style="list-style: none;">
            <?php foreach ($post_list as $ntc) : ?>
                <a href="/sub/sub01/view/<?=$ntc['d_order']?>"><li <?php if($this_depart == $ntc['depart']){ ?> class="on" <?php } ?>><?=$ntc['depart']?></li></a>
            <?php endforeach; ?>
        </ul>
    </div>

    <div style="position:relative; float:left; width: 1600px; height: auto;">

        <span style="font-size: 25px; font-weight: bold;"><?=$title?></span>

        <div style="position:relative; float:left; width: 1600px; height: 170px; margin: 10px; border: 1px solid blue;">

            <?php for($i=0; $i<count($post_query); $i++) { ?>
                <div id="3_<?=$i?>" style="position:relative; float:left; width: 200px; height: 100px; margin: 10px; border: 1px solid yellow;">
                    <span><?=$team_arr[$i]?></span>
                </div>
                <?php for($j=0; $j<count($post_query[$i]); $j++) { ?>

                    <?php if($post_query[$i][$j]['rank'] == "치안감" && $post_query[$i][$j]['team'] == $team_arr[$i]){ ?>
                        <div style="position:relative; float:left; width: 200px; height: 100px; margin: 10px; border: 1px solid yellow;">
                            <img src="/증명사진/<?=$post_query[$i][$j]['id']?>.jpg" width="50px"/>
                            <p><?=$post_query[$i][$j]['name']?>(<?=$post_query[$i][$j]['rank']?>)</p>
                            <p><?=$post_query[$i][$j]['birthday']?></p>
                            <p><?=$post_query[$i][$j]['n_day']?></p>
                            <p><?=$post_query[$i][$j]['apm']?></p>
                        </div>
                    <?php } ?>

                    <?php if($post_query[$i][$j]['team'] == null){
                        $val = "3_".$j; ?>
                        <script>
                            $(document).ready(function(<?=$val?>){
                                var arr_num = val.split('_');
                                var i_val = arr_num[1];
                                var div_val = "3_";
                                var id_name = div_val+i_val;
                                console.log(id_name);
                                document.getElementById(id_name).style.display = "none";
                            }
                        </script>
                    <?php } ?>

                <?php } ?>
            <?php } ?>

        </div>
    </div>
<script src="/bootstrap/js/jquery.min.js"></script>
<script>
    function DetailSwal(id){
        $.ajax({
            type: "post",
            url : '/sub/sub01/detail/'+id,
            data : {info : "info"},
            async : true,
            /*dataType: "JSON",*/
            success: function(result)
            {
                if(result['status'] == 'success') {
                    Swal.fire({
                        html : result['html'],
                        width: 1500,
                        /*imageUrl : '/management_img/'+src,*/
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

    function open(){
        var con = document.getElementById("open");
        con.style.display = 'block';
    }

    function close(){
        var con = document.getElementById("open");
        con.style.display = 'none';
    }

</script>
</div>
</body>
</html>
