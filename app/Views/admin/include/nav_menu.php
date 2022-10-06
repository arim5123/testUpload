<style>
    @import url('//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.min.css');

    .sidebar {
        width: 20rem;
        height: 100%;
        background: #ffffff;
        position: absolute;
        -webkit-transition: all 0.3s ease-in-out;
        -moz-transition: all 0.3s ease-in-out;
        -o-transition: all 0.3s ease-in-out;
        -ms-transition: all 0.3s ease-in-out;
        transition: all 0.3s ease-in-out;
        z-index: 100;
    }
    .sidebar #leftside-navigation ul,
    .sidebar #leftside-navigation ul ul {
        margin: -2px 0 0;
        padding: 0;
    }
    .sidebar #leftside-navigation ul li {
        list-style-type: none;
        border-bottom: 1px dashed #eeeff1;
    }
    .sidebar #leftside-navigation ul li.active > a {
        color: #1abc9c;
    }
    .sidebar #leftside-navigation ul li.active ul {
        display: block;
    }
    .sidebar #leftside-navigation ul li a {
        color: #3d4449;
        text-decoration: none;
        display: block;
        padding: 18px 0 18px 25px;
        outline: 0;
        -webkit-transition: all 200ms ease-in;
        -moz-transition: all 200ms ease-in;
        -o-transition: all 200ms ease-in;
        -ms-transition: all 200ms ease-in;
        transition: all 200ms ease-in;
    }
    .sidebar #leftside-navigation ul li a:hover {
        color: #1abc9c;
    }
    .sidebar #leftside-navigation ul li a span {
        display: inline-block;
    }
    .sidebar #leftside-navigation ul li a i {
        width: 20px;
    }
    .sidebar #leftside-navigation ul li a i .fa-angle-left,
    .sidebar #leftside-navigation ul li a i .fa-angle-right {
        padding-top: 3px;
    }
    .sidebar #leftside-navigation ul ul {
        display: none;
    }
    .sidebar #leftside-navigation ul ul li {
        background: #23313f;
        margin-bottom: 0;
        margin-left: 0;
        margin-right: 0;
        border-bottom: none;
    }
    .sidebar #leftside-navigation ul ul li a {
        font-size: 14px;
        padding-top: 13px;
        padding-bottom: 13px;
        color: #aeb2b7;
    }

    ul.admin_info { height: 130px; list-style: none; margin: 0; padding: 0; }
    ul.admin_info li { width: 50%;  float: left; }
    ul.admin_info li.admin_img { width: 100%; }
    ul.admin_info li.admin_name { width: 100%; margin-bottom: 5px; }
    ul.admin_info li a { color: #787676; font-size: 15px; }
</style>

<div class="border-end bg-white" id="sidebar-wrapper">

    <div class="sidebar-heading border-bottom bg-white"><img src="/img/logo.png" height="40px"></div>

    <div class="sidebar-heading">
        <ul class="admin_info">
            <li class="admin_img"><img src="/img/admin.jpg" width="55px"></li>
            <li class="admin_name"><?=$my_id?>님</li>
            <li><a class="nav-link" href="/admin/login/logout">LogOut</a></li>
            <li><a class="nav-link" href="/admin/login/info">관리자정보</a></li>
        </ul>
    </div>

    <div class="list-group list-group-flush" >
        <div class="side_bar_v1">
            <!-- code here -->
            <aside class="sidebar">
                <div id="leftside-navigation" class="nano">
                    <ul class="nano-content">
                        <li class="admin"><a href="/admin/main" id="main"><i class="fa fa-home"></i><span>미리보기</span></a></li>
                        <li class="admin sub-menu">
                            <a href="javascript:void(0);" id="intro"><i class="fa fa-file-text-o"></i><span>대기화면(인트로)</span><i class="arrow fa fa-angle-right pull-right"></i></a>
                            <ul id="intro_ul">
                                <li><a href="/admin/intro">목록</a></li>
                                <li><a href="/admin/intro/setting">환경설정</a></li>
                            </ul>
                        </li>
                        <li class="admin sub-menu">
                            <a href="javascript:void(0);" id="school"><i class="fa fa-info"></i><span>학교안내</span><i class="arrow fa fa-angle-right pull-right"></i></a>
                            <ul id="school_ul">
                                <li><a href="/admin/school/msg">학교장인사말</a></li>
                                <li><a href="/admin/school/history">학교연혁</a></li>
                                <li><a href="/admin/school/info">학교소개</a></li>
                                <li><a href="/admin/school/song">교가</a></li>
                            </ul>
                        </li>
                        <li class="admin"><a href="/admin/count" id="main"><i class="fa fa-bar-chart-o"></i><span>학교현황</span></a></li>
                        <li class="admin"><a href="/admin/notice" id="main"><i class="fa fa-calendar-o"></i><span>알림마당</span></a></li>
                        <li class="admin sub-menu">
                            <a href="javascript:void(0);" id="gallery"><i class="fa fa-picture-o"></i><span>갤러리</span><i class="arrow fa fa-angle-right pull-right"></i></a>
                            <ul id="gallery_ul">
                                <li><a href="/admin/gallery/graduate">졸업생 앨범</a></li>
                                <li><a href="/admin/gallery/history">역사관</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </aside>

        </div>
    </div>
</div>
<script src="/bootstrap/js/jquery.min.js"></script>
<script>
    $( document ).ready( function() {
        url = window.location.href;
        if(url.includes('intro') == true){
            var con = document.getElementById("intro_ul");
            con.style.display = "block";
        }else if (url.includes('school') == true) {
            var con = document.getElementById("school_ul");
            con.style.display = "block";
        }else if(url.includes('info') == true){
            var con = document.getElementById("info_ul");
            con.style.display = "block";
        }else if(url.includes('notice') == true){
            var con = document.getElementById("notice_ul");
            con.style.display = "block";
        }else if(url.includes('gallery') == true){
            var con = document.getElementById("gallery_ul");
            con.style.display = "block";
        }else{
            $("#main").trigger("click");
        }
    });
    $("#leftside-navigation .sub-menu > a").click(function (e) {
        $("#leftside-navigation ul ul").slideUp(),
        $(this).next().is(":visible") || $(this).next().slideDown(),
            e.stopPropagation();
    })

    $("#close-sidebar").click(function() {
        $(".side_bar_v1").removeClass("toggled");
    });
    $("#show-sidebar").click(function() {
        $(".side_bar_v1").addClass("toggled");
    });

</script>

