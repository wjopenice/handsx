$(function () {

    //addPanel();

    //点击打开左侧面板
    $(document).on("click",'#slideBtn',function(){
        $(this).addClass("close-panel").removeClass("open-panel");
        $(".page").append('<div class="pageOver close-panel hide"></div>');
        $(".pageOver").show();
    });

    //关闭左侧面板
    $(document).on("click",'.pageOver',function(){
        $("#slideBtn").addClass("open-panel").removeClass("close-panel");
        $(this).remove();
    });

    //点击链接
    $(document).on("click",".subSlide",function(){
        $(this).addClass("slideHoverBg").siblings().removeClass("slideHoverBg");
    });

    //点击展开收缩
    $(document).on("click",'.subSlide',function(){
        if($(this).parents(".subSlideBox").find(".innerSlideBoxWrap").hasClass("hide")){
            $(this).parents(".subSlideBox").find(".innerSlideBoxWrap").removeClass("hide");
            $(this).parents(".subSlideBox").siblings().find(".innerSlideBoxWrap").addClass("hide");
            $(this).find(".upNext").removeClass("upNext").addClass("downNext");
        }else{
            $(this).parents(".subSlideBox").find(".innerSlideBoxWrap").addClass("hide");
            $(this).find(".downNext").removeClass("downNext").addClass("upNext");
        }
    });

});

