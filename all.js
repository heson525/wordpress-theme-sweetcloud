jQuery(document).ready(function($) {
//图片预览
  $('.imageImg').hover(function(){
                $(".imageContent", this).stop().animate({top:'0px'},{queue:false,duration:300});
        }, function() {
                $(".imageContent", this).stop().animate({top:'180px'},{queue:false,duration:300});
        });
		
//end
    $('.article-header h2 a').click(function() {
        $(this).text('努力载入中...');
        window.location = $(this).attr('href');
    });
    $('#articleBridge a').hover(function() {
        $(this).stop().animate({
            'left': '5px'
        },
        'fast');
    },
    function() {
        $(this).stop().animate({
            'left': '0px'
        },
        'fast');
    });
    $('.postlist .article-title a').hover(function() {
        $(this).stop().animate({
            'left': '5px'
        },
        'fast');
    },
    function() {
        $(this).stop().animate({
            'left': '0px'
        },
        'fast');
    });
    $(function() {
        $('img').hover(function() {
            $(this).fadeTo("fast", 0.5);
        },
        function() {
            $(this).fadeTo("fast", 1);
        });
    });
    function scrollBox() {
        var first = $('#scrollbox ul li:first');
        var width = -(first.outerWidth(true)) + 'px';
        $('#scrollbox ul').animate({
            left: width
        },
        {
            duration: 600,
            complete: function() {
                $('#scrollbox ul').append(first).css("left", "0");
            }
        });
    }
    $(document).ready(function() {
        myScroll = setInterval(scrollBox, 1500);
        $('#scrollbox').hover(function() {
            clearInterval(myScroll);
        },
        function() {
            myScroll = setInterval(scrollBox, 1500);
        });
    }); $(function() {
        var $sidebar = $("#searchbox"),
        $window = $(window),
        offset = $sidebar.offset(),
        topPadding = 20;
        $window.scroll(function() {
            if ($window.scrollTop() > offset.top) {
                $sidebar.stop().animate({
                    marginTop: $window.scrollTop() - offset.top + topPadding
                });
            } else {
                $sidebar.stop().animate({
                    marginTop: 0
                });
            }
        });
    });
    $('#cebian h3').bind('mouseover', 
    function() {
        $('#cebian h3').next().hide('slow');
        $(this).next().css('display', 'block');
    });
    $('#cebian .mod_nr').hover(function() {},
    function() {
        $(this).hide(300);
    });
    var tooltips_h1,
    tooltips_h2,
    tooltips_top,
    tooltips_w1,
    tooltips_w2,
    tooltips_left;
    function calc_pos(e) {
        if ($('#tooltip').length > 0) {
            tooltips_h1 = parseInt(document.documentElement.clientHeight + document.documentElement.scrollTop);
            tooltips_h2 = parseInt($('#tooltip').get(0).offsetHeight + parseInt(e.pageY + 20));
            tooltips_top = (tooltips_h1 < tooltips_h2) ? parseInt(parseInt(e.pageY + 20) - ($('#tooltip').get(0).offsetHeight + 10)) : parseInt(e.pageY + 20);
            tooltips_w1 = parseInt(document.documentElement.clientWidth + document.documentElement.scrollLeft);
            tooltips_w2 = parseInt($('#tooltip').get(0).offsetWidth + parseInt(e.pageX + 10));
            tooltips_left = (tooltips_w1 < tooltips_w2) ? parseInt(parseInt(e.pageX + 10) - ($('#tooltip').get(0).offsetWidth + 10)) : parseInt(e.pageX + 10)
        }
    }
    $("a").mouseover(function(e) {
        this.myTitle = this.title;
        this.myHref = this.href;
        this.myHref = (this.myHref.length > 30 ? this.myHref.toString().substring(0, 30) + "...": this.myHref);
        this.title = "";
        var tooltip = "<div id='tooltip'><p>" + this.myTitle + "<em>" + this.myHref + "</em>" + "</p></div>";
        $('body').append(tooltip);
        calc_pos(e);
        $('#tooltip').css({
            "opacity": "0.8",
            "top": tooltips_top + "px",
            "left": tooltips_left + "px"
        }).show('fast');
    }).mouseout(function() {
        this.title = this.myTitle;
        $('#tooltip').remove();
    }).mousemove(function(e) {
        calc_pos(e);
        $('#tooltip').css({
            "top": tooltips_top + "px",
            "left": tooltips_left + "px"
        });
    });
    $("li.comment").mouseover(function() {
        $(this).children(".reply").show();
    }); $("li.comment").mouseout(function() {
        $(this).children(".reply").hide();
    }); $body = (window.opera) ? (document.compatMode === "CSS1Compat" ? $('html') : $('body')) : $('html,body');
    $('#gotop').click(function() {
        $body.animate({
            scrollTop: $('#wrapper').offset().top
        },
        1000);
        return false;});
		
		
		$("#pageHeader").mousedown(function(){location.href="/"})
});
function togglecebian(n) {
    if (n === 0) {
        $('#cebian').hide('slow');
        $('#cebian2').show('slow');
    } else {
        $('#cebian').show('slow');
        $('#cebian2').hide('slow');
    }
}
var scrollSpeed = 70;
var current = 0;
var ht = 0;
var direction = 'h';
function bgscroll() {
    current += 1;
    ht += 1;
    $('.clouds').css("backgroundPosition", (direction === 'h') ? current + "px " + ht + "px": ht + "px " + current + "px");
}
setInterval("bgscroll()", scrollSpeed);