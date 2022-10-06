<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>안덕초등학교</title>
    <link href="/css/style.css" rel="stylesheet" type="text/css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.6.4/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper/swiper-bundle.min.css" />
    <style>
        .swiper-pagination-bullet { display: inline-block !important; width: 35px; height: 35px; background: rgba(0, 0, 0, 0.42); margin: 0 10px !important; }
        .swiper-pagination-bullet-active { background: #00AE68; }
        :root{
            --swiper-navigation-size : 150px !important;
            --swiper-theme-color : #00AE68 !important;
        }
        ::-webkit-scrollbar-track {
            background: none !important;
        }
        ::-webkit-scrollbar-thumb {
            background: none !important;
        }
    </style>
</head>
<body>
<div id="Wrap" class="sub">

    <?php echo view('\include\header'); ?>

    <section>
        <h2 class="sub_title">알림마당</h2>
        <div class="container_area">
            <?php echo view('\include\homeback'); ?>
            <div class="sub03_span">
                <div class="size_ctrl">
                    <span class="sub_sp"><?=$title?></span>
                </div>
            </div>
            <div class="swiper-container" style="width: 100%; height: 100%; overflow: hidden;">
                <div class="swiper-wrapper" style="width: 100%; height: 95%;">
                    <?php foreach ($file_val as $file) :?>
                        <div class="swiper-slide" style="text-align:center;">
                            <img src="/img/notice/<?=$file['file_name']?>" style="max-width:1600px; max-height: 1915px;"/>
                        </div>
                    <?php endforeach; ?>
                </div>
                <div class="swiper-pagination"></div>
                <div class="swiper-button-next"></div>
                <div class="swiper-button-prev"></div>
            </div>
            <script src="https://unpkg.com/swiper/swiper-bundle.js"></script>
            <script>
                var mySwiper = new Swiper('.swiper-container', {
                    slidesPerView: 1, //슬라이드를 한번에 1개를 보여준다
                    spaceBetween: 10, //슬라이드간 padding 값 30px 씩 떨어뜨려줌
                    loop: false, //loop 를 true 로 할경우 무한반복 슬라이드 false 로 할경우 슬라이드의 끝에서 더보여지지 않음
                    pagination: {
                        el: ".swiper-pagination",
                        clickable: true,
                    },
                    navigation: {
                        nextEl: ".swiper-button-next",
                        prevEl: ".swiper-button-prev",
                    },
                });
            </script>
        </div>
    </section>

    <?php echo view('\include\gnb'); ?>

</div>
</body>
</html>
