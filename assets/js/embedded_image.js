function updateImagesSrc() {
    $.each($('img'), function (key, value) {
        var oldSrc = $(this).data('src');
        var $this = $(this);
        var w = $this.innerWidth();
        var h = $this.innerHeight();

        alert(oldSrc + ' - ' + w);
        
        if (!oldSrc.includes('http')) {
            $.ajax({
                url: getDomain() + '/assets/php/resize_one.php',
                data: {
                    name: oldSrc,
                    width: w,
                    height: h,
                    from_db: true
                },
                success: function(result) {
                    $this.attr('src', result[0].src);
                },
                error: function() {
                    alert('Error loading image...');
                }
            }); 
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

    return domain;
}
