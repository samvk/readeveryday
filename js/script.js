/* Generated by Babel */
/* jshint esversion: 6 */
/* global $, document, Image, window, setTimeout, setInterval, clearInterval */

"use strict";

$(document).ready(function () {
    "use strict";

    /****** nav--list hamburger slideToggle() ******/

    $(".nav--hamburger").click(function () {
        $(".nav--list").stop().slideToggle(350);
    });

    $(".nav--logo, .nav--list li").click(function () {
        if (window.matchMedia("(max-width: 767px)").matches) {
            $(".nav--list").stop().delay(550).slideUp(500);
        }
    });

    /************** Nav autoscroller **************/

    $.fn.scrollTo = function () {
        return this.each(function () {
            //Both "html" and "body" required for browser compatibility
            $("html, body").stop().animate({
                scrollTop: $(this).offset().top
            }, 1500, "easeInOutQuart");
        });
    };

    $(".autoscroll").click(function (e) {
        e.preventDefault();
        var anchor = $(this).attr("href");
        $(anchor).scrollTo();
    });

    /********* Navbar-related scrolling functions *********/

    $(window).scroll(function () {
        var windowTopLine = $(window).scrollTop();

        /*********** Nav size change on scroll ***********/
        if (windowTopLine > 150) {
            $("nav").addClass("is-small");
        } else {
            $("nav").removeClass("is-small");
        }

        /*********** Nav section highlighting ************/
        $("body>section").each(function () {
            var sectionTopLine = $(this).offset().top - 65;
            var sectionBottomLine = $(this).offset().top + $(this).innerHeight() - 65;
            var thisSectionID = "#" + $(this).attr("id");

            var $myNavAnchor = $("[href=\"" + thisSectionID + "\"]");

            //If the object is  visible       
            if (sectionTopLine < windowTopLine && windowTopLine < sectionBottomLine) {
                $myNavAnchor.addClass("highlighted");
            } else {
                $myNavAnchor.removeClass("highlighted");
            }
        });
    });

    /*********** Contact form placeholder text ***********/

    $(":input").focus(function () {
        $(this).siblings(".input--placeholder").addClass("focused").addClass("loud");
    }).blur(function () {
        $(this).siblings(".input--placeholder").removeClass("loud");
    });
});