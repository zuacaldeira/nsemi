function updateImagesSrc() {
    $.each($('img'), function (key, value) {
        var oldSrc = $(this).attr('src');
        if (!oldSrc.includes('http')) {
            $(this).attr('src', getDomain() + oldSrc);
        }
    });
}

function getDomain() {
    var domain = null;

    var origin = window.location.origin;
    var pathname = window.location.pathname;

    if (pathname.includes('websites/nsemi')) {
        domain = origin + '/websites/nsemi';
    } else {
        domain = origin;
    }

    alert(domain);
    return domain;
}
