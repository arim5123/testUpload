var eventLinkArray = new Array();
$(document).ready(function(){
    jQuery.easing.def = "easeOutExpo";

    // initalize event carousel (no support IE)
    var totalCarousel = $(".scrollerBox li").length;
    var currentEvent = 0;
    var TimeMilliseconds = new Date();
    var clickHandler = false;

    $(".scrollerBox").css("width", ($(".slideBoxWrap").width()*totalCarousel)+"px");
    $(".scrollerBox li").css("width", $(".slideBoxWrap").width()+"px");

    if ((navigator.appName).indexOf("Microsoft")!=-1) {
        $(".scrollBtn").click(function() {
            selectNumber(this.id, true);
        });
        $("#0").css("color", "#000000");
    } else {
        var iscroll = new iScroll("carouselWrapper", {
            snap: true,
            momentum: false,
            hScrollbar: false,
            vScrollbar: false,
            lockDirection: false,
            onScrollEnd: function() {
                $("#indicator li").each(function(i, node) {
                    if(i === iscroll.currPageX) {
                        $(node).addClass("active");
                    } else {
                        $(node).removeClass("active");
                    }
                });

                selectNumber(iscroll.currPageX, false);
                clickHandler = false;
            },
            onScrollMove: function(e) {
                clickHandler = false;
            },
            onTouchStart: function(e) {
                clickHandler = true;
                $("#carouselWrapper").mousemove(function() {
                    clickHandler = false;
                });
            },
            onTouchEnd: function(e) {
                if (clickHandler == true && (e.type == "mouseup" || e.type == "touchend")) {
                    linkToEvent();
                }
                $("#carouselWrapper").mousemove(null);
            }
        });

        function linkToEvent() {
            var TimeMillisecondsClick = new Date();
            if (TimeMillisecondsClick.getTime() > TimeMilliseconds.getTime() + 500 ) {
                TimeMilliseconds = new Date();

                if (eventLinkArray[currentEvent] != "") {
                    location.href=eventLinkArray[currentEvent];
                }
            }
        }

        $(".scrollBtn").click(function() {
            iscroll.scrollToPage(this.id);
        });
        iscroll.scrollToPage(0);
    }

    function selectNumber(newValue, motionFlag) {
        if (currentEvent != newValue) {
            currentEvent = Number(newValue);
            var targetPosition = (currentEvent*-768);

            $(".sliderNav a").each(function(i, node) {
                if (i == newValue) {
                    $("#"+i).css("color", "#0a0d42");
                } else {
                    $("#"+i).css("color", "#B4B4B4");
                }
            });
            if (motionFlag == true) {
                $(".scrollerBox").animate( { left:targetPosition+"px" }, 500);
            }
        }
    }
    selectNumber(0, true);
});