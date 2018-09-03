$(document).ready(function () {

    $("textarea").bind("propertychange input", function () {
        $.post("mobile.php", {
            "data": $(this).val(),
            "code": code
        });
    });


    var press = function (x, y) {

        var tox, toy;
        tox = ((x / $(window).width()) * 100);
        toy = ((y / $(window).height()) * 100)

        $.post("mobile.php", {
            "data2": tox,
            "data3": toy,
            "code": code
        });

        $("<div class='bomba'></div>").css("left", tox + "%").css("top", toy + "%").prependTo("body");

    };

    window.addEventListener('touchstart', function (e) {
        e.preventDefault();
        var touch = e.touches[0];
        press(touch.pageX, touch.pageY);
    });

    window.addEventListener('touchmove', function (e) {
        e.preventDefault();
        var touch = e.touches[0];
        press(touch.pageX, touch.pageY);
    });


    $('body').on({
        'click': function (e) {
            press(e.pageX, e.pageY);
        }
    });

});