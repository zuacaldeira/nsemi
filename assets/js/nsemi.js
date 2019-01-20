var COOKIES = 'cookies-accepted';
$(document).ready(function() {
    if(!hasSessionData(COOKIES)) {
        addCookiesAcceptanceElement();
    }
    
    $('#nav-home, #nav-gallery, #nav-tools, #nav-news').on('click', function(event){
        sessionStorage.setItem('nav', $(this).attr('id'));
    });
    
    if(hasSessionData('nav')) {
        $('header nav .active').removeClass('active');
        $('#' + sessionStorage.getItem('nav')).addClass('active border-bottom border-secondary');
    }
});

function hasSessionData(key) {
    return sessionStorage.getItem(key) != null;
}

function addCookiesAcceptanceElement() {
    var $accept = $('<button class="btn btn-sm btn-primary ml-2"/>')
        .text('Accept')
        .on('click', function(event) {
            event.preventDefault();
            sessionStorage.setItem(COOKIES, true);
            $('.cookies').fadeOut(1000);
            setTimeout(function() {
                $('.cookies').remove();
            }, 1000);
        });
    var $element = $('<div class="cookies"/>')
        .html('This website uses cookies to ensure you get the best experience on our website. Read Our <a href="home/policy">Privacy Policy</a>')
        .addClass('fixed-top bg-light text-center py-3 shadow')
        .append($accept)
        .prependTo('body');    
}


