$(document).ready(function () {

    /* scroll */

    $("a[href^='#']").click(function () {
        var _href = $(this).attr("href");
        $("html, body").animate({
            scrollTop: $(_href).offset().top + "px"
        });
        return false;
    });

    /* timer */


    function update() {
        var Now = new Date(),
            Finish = new Date();
        Finish.setHours(23);
        Finish.setMinutes(59);
        Finish.setSeconds(59);
        if (Now.getHours() === 23 && Now.getMinutes() === 59 && Now.getSeconds === 59) {
            Finish.setDate(Finish.getDate() + 1);
        }
        var sec = Math.floor((Finish.getTime() - Now.getTime()) / 1000);
        var hrs = Math.floor(sec / 3600);
        sec -= hrs * 3600;
        var min = Math.floor(sec / 60);
        sec -= min * 60;
        $(".timer .hours").text(pad(hrs));
        $(".timer .minutes").text(pad(min));
        $(".timer .seconds").text(pad(sec));
        setTimeout(update, 200);
    }

    function pad(s) {
        return ('00' + s).substr(-2)
    }
    update();

    /* sliders */

    $('.reviews_slider').slick({
        dots: false,
        infinite: true,
        speed: 500,
        fade: false,
        cssEase: 'linear'
    });
    $('.reviews').slick({
        dots: false,
        infinite: true,
        speed: 200,
        fade: false,
        cssEase: 'linear'
    });


    /* sending form */
    $(function () {
        $('#order_form').submit(function (e) {
            var $form = $(this);
            $form.find('button').attr('disabled', true).addClass('disabled');
            $.ajax({
                type: $form.attr('method'),
                url: $form.attr('action'),
                data: $form.serialize()
            }).done(function () {
                console.log('success');
                window.location.href = "thanks.html";
            }).fail(function () {
                console.log('fail');
                $form.find('button').attr('disabled', false).removeClass('disabled');
            });
            //отмена действия по умолчанию для кнопки submit
            e.preventDefault();
        });
    });

    /* global modal */
    var globalModal = $('.global-modal');
    $(".btn-green-flat-trigger").on("click", function (e) {
        e.preventDefault();
        $(globalModal).toggleClass('global-modal-show');
    });
    $(".overlay").on("click", function () {
        $(globalModal).toggleClass('global-modal-show');
    });
    $(".global-modal_close").on("click", function () {
        $(globalModal).toggleClass('global-modal-show');
    });
    $(".mobile-close").on("click", function () {
        $(globalModal).toggleClass('global-modal-show');
    });
});
