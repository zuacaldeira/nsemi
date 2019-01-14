var image_data = null;
var $previewer = null;

$(document).ready(function() {
    $previewer = $('#previewer');
    
    if($previewer.data('name') != null) {
        updateImage($previewer);
    }
    
    $('#previewer img').on('load', function(event) {
        updateImage($previewer);
        $('.resize-options').show(1000);
    });

    $(window).on('resize', function(event) {
        updateImage($previewer);
    })
});

function updateImage($wrapper) {
    var image_width = getImageWidth($wrapper);
    var image_height = getImageHeight($wrapper);
    var image_ratio = image_width / image_height;

    if ($wrapper.find('img')) {
        $wrapper.find('img').hide();
    }
    
    var width = $wrapper.innerWidth();
    var height = width / image_ratio;

    $wrapper.css({
        width: width,
        height: height,
        background: 'url(' + getImageData($wrapper) + ')',
        backgroundRepeat: 'no-repeat',
        backgroundSize: 'cover'
    });
    
    $(document).trigger('_preview_upload');
}

function getImageData($wrapper) {
    image_data = $wrapper.find('img').attr('src');
    return image_data;
}

function getImageWidth($wrapper) {
    return $wrapper.find('img').innerWidth();
}

function getImageHeight($wrapper) {
    return $wrapper.find('img').innerHeight();
}
