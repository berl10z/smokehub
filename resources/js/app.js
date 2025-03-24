import './bootstrap';
import './jquery-3.6.0.min'

$(document).ready(function () {
    function closeMenu() {
        $("#mobile-menu")
            .addClass("-translate-y-full")
            .removeClass("translate-y-0");
        $("#burger-btn").removeClass("menu-open");
        $("#burger-btn")
            .find(".burger-line")
            .removeClass(
                "rotate-45 translate-y-1.5 opacity-0 -rotate-45 -translate-y-1.5"
            );
    }

    $("#burger-btn, #close-btn").click(function () {
        $("#mobile-menu").toggleClass("-translate-y-full translate-y-0");
        $("#burger-btn").toggleClass("menu-open");

        // Анимация крестика
        $("#burger-btn")
            .find(".burger-line")
            .eq(0)
            .toggleClass("rotate-45 translate-y-1.5");
        $("#burger-btn").find(".burger-line").eq(1).toggleClass("opacity-0");
        $("#burger-btn")
            .find(".burger-line")
            .eq(2)
            .toggleClass("-rotate-45 -translate-y-1.5");
    });

    $(window).resize(function () {
        if ($(window).width() >= 768) {
            closeMenu();
        }
    });
});
