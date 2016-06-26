/*jshint esversion: 6*/
/*global $, document, Image, window, setTimeout, setInterval, clearInterval*/

$("#contact-form").submit(submitForm);

function submitForm(e) {
    e.preventDefault();

    let $form = $(this);
    let formAction = $form.attr("action");

    $.post(formAction,
        $form.serialize(), (response) => {
        $(".contact-form--submit, .input--placeholder").fadeTo(300, 0, () => {
                $(".contact-form--submit").replaceWith(response);
                $form.trigger("reset").find(":input").prop("disabled", true).addClass("form--disabled");
            });
        });
}