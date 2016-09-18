/*jshint esversion: 6*/
/*global $, document, Image, window, setTimeout, setInterval, clearInterval*/

$.fn.submitForm = function(success) {    
    this.submit( e => {
        e.preventDefault();
        const url = this.attr("action");
        $.post(url, this.serialize(), success);
    });
};