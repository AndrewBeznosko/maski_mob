$(document).ready(function(){
    $('a[href^="#"]').click(function (){
        var elementClick = $(this).attr("href");
        var destination = $(elementClick).offset().top;
        jQuery("html:not(:animated), body:not(:animated)").animate({scrollTop: destination}, 800);
        return false;
    })
    now = new Date();
    var perem = (24-now.getHours())*3600;
    $(".el-timer").attr("data-timer", perem);
    $(".el-timer").TimeCircles({
        "animation": "smooth",
        "bg_width": 0.5,
        "fg_width": 0.03,
        "circle_bg_color": "#f3f5f7",
        "time": {
            "Days": {
                "text": "Days",
                "color": "#f8e174",
                "show": false
            },
            "Hours": {
                "text": "часов",
                "color": "#f8e174",
                "show": true
            },
            "Minutes": {
                "text": "минут",
                "color": "#f8e174",
                "show": true
            },
            "Seconds": {
                "text": "секунд",
                "color": "#f8e174",
                "show": true
            }
        }
    });
});