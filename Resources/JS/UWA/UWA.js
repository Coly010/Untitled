/**
 * Created by Colum on 11/02/2017.
 */

var isMobile = {
    Android: function() {
        return navigator.userAgent.match(/Android/i);
    },
    BlackBerry: function() {
        return navigator.userAgent.match(/BlackBerry/i);
    },
    iOS: function() {
        return navigator.userAgent.match(/iPhone|iPad|iPod/i);
    },
    Opera: function() {
        return navigator.userAgent.match(/Opera Mini/i);
    },
    Windows: function() {
        return navigator.userAgent.match(/IEMobile/i);
    },
    any: function() {
        return (isMobile.Android() || isMobile.BlackBerry() || isMobile.iOS() || isMobile.Opera() || isMobile.Windows());
    }
};

function BootboxConfirm(title, msg, cancelBtn, confirmBtn, callback){
    bootbox.confirm({
        title: title,
        message: msg,
        buttons: {
            confirm: confirmBtn,
            cancel: cancelBtn
        },
        callback: callback
    });
}



$(document).ready(function() {

    if(isMobile.any()){
        // Time to render the view differently

        // Get the menu links
        var menu = $(".uwa-menu .nav-stacked").html();

        // Remove the menu from the screen
        $(".uwa-menu").remove();
        $("nav").remove();

        // Redisplay a mobile friendly menu
        $("#mobile-menu").removeClass("hidden");
        $(".menu-links").append(menu);

        // Handle the menu click

        $(".menu-icon").click(function() {
            console.log("clicked");
            $(".menu-links-container").removeClass("hidden");
            $(".menu-icon").hide();
        });

        $(".fa.fa-times").click(function() {
            $(".menu-links-container").addClass("hidden");
            $(".menu-icon").show();
        });

    }

});