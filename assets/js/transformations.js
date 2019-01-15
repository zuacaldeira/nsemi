var transformations = null;

var original = {
    name: null,
    src: null
}

$(document).ready(function () {
    handleScrollEvent();
    handleFormEvents();
    handleTransformationEvents();    
});

function handleScrollEvent() {
    $(document).on('scroll', function(event){
        event.preventDefault();
        var $header = $('header');
        var top = $header.offset().top;
        if(top > 0) {
            $header.css({
                background: 'rgba(0,0,0,' + top/100 + ')',
            });
        }
        else {
            $header.css({
                color: 'blue'
            });
        }
    });
}

function handleFormEvents() {
    $('#btn-resize').on('click', function (event) {
        showResizeOneForm();
    });

    $('#btn-resize-many').on('click', function (event) {
        showResizeManyForm();
    });

    $('#forms').on('click', '#do-resize-one', function (event) {
        event.preventDefault();
        requestResize(false);
    });
    $('#forms').on('click', '#do-resize-many', function (event) {
        event.preventDefault();
        requestResize(true);
    });

    showResizeOneForm();

}

function handleTransformationEvents() {
    $('#btn-details').on('click', function (event) {
        event.preventDefault();
        $('#thumbnails .details').toggle(1000);
    });

    $('#by-filename, #by-width, #by-height, #by-size, #by-filter').on('click', function (event) {
        event.preventDefault();
        var $this = $(this);
        $this.parent().find('.active').removeClass('active');
        $this.addClass('active');
        sortImagesBy($this.attr('id'));
    });

    $(document).on('_preview_upload', function (event) {
        $('#s-transform').show();
        
    });

    $('#download-all').on('click', function (event) {
        event.preventDefault();
        
        var zip = new JSZip();
        zip.file("Hello.txt", "Hello World\n");
        
        var img = zip.folder("images");
        
        $.each(transformations, function(key, value){
            var i = value;
            img.file(i.name, i.src.split('base64,')[1], {
                base64: true
            });
        });
        zip.generateAsync({
                type: "blob"
            })
            .then(function (content) {
                // see FileSaver.js
                saveAs(content, "nsemi_" + (+ new Date()) + ".zip");
            });
    });
}

function showResizeOneForm() {
    $('#forms').load('assets/php/forms/form_resize_one.php');
}

function showResizeManyForm() {
    $('#forms').load('assets/php/forms/form_resize_many.php');
}

function requestResize(multiple) {
    var data = $('#previewer img').attr('src');
    var width = parseInt($('form .width').val());
    var height = parseInt($('form .height').val());

    prepareThumbnails(width, height);

    var name = null;
    if ($('#data').length == 0) {
        name = $('#previewer').data('name');
    } else {
        name = $('#data').val().trim();
    }

    var filter = $('#select-filter').val();
    resize(width, height, data, name, filter, multiple);
}

function prepareThumbnails(width, height) {
    $('#thumbnails').empty();
}

function resize(width, height, data, name, filter, multiple) {
    var url = (multiple) ?
        'assets/php/resize_many.php' :
        'assets/php/resize_one.php';
    $.ajax({
        url: url,
        method: 'POST',
        dataType: 'json',
        data: {
            width: width,
            height: height,
            name: name,
            filters: filter,
            multiple: multiple,
            data: data
        },
        success: function (result) {
            transformations = result;
            addImageCards(result);
            $('#s-player').show();
            $('#result').css({
                width: $('#thumbnails').innerWidth()
            });
             $('html, body').animate({
                 scrollTop: $('#result').offset().top
             }, 1000);
            $('#download-all span').text(transformations.length);
        },
        error: function () {
            alert('Error during resize...');
        }
    })
}

function addImageCards(images) {
    $.each(images, function (key, image) {
        addNewImageCard(image);
    });

}

function addNewImageCard(image) {
    var width = parseInt(image.width);
    var height = parseInt(image.height);

    var $wrapper = $('<div class="single-image small m-0 p-0 mb-1 mx-auto" />');

    var $filename = createImageDetailLine('Filename', image.name);
    var $size = createImageDetailLine('Size', image.size.toFixed(2) + ' KB');
    var $dimensions = createImageDetailLine('Dimensions', width + ' x ' + height);
    var $filter = createImageDetailLine('Filter', image.filter);
    var $time = createImageDetailLine('Time', image.time.toFixed(3) + ' ms');

    var $details = $('<div class="details p-1 text-light" />');
    $details
        .append($filename)
        .append($dimensions)
        .append($filter)
        .append($size)
        .append($time)
        .hover(
            function () {
                $(this).addClass('hoverin');
            },
            function () {
                $(this).removeClass('hoverin');
            }
        ).on('click', function (event) {
            $(this).toggleClass('selected');
        });

    $wrapper.css({
        width: width,
        height: height,
        backgroundImage: 'url(' + image.src + ')',
        backgroundRepeat: 'no-repeat',
        backgroundPosition: 'cover'
    });

    $details.css({
        width: width,
    });


    $wrapper.append($details);
    $('#thumbnails').append($wrapper);

}

function createImageDetailLine(label, data) {
    var $line = $('<div class="clearfix"/>');
    var $left = $('<span class="float-left"/>').text(label).appendTo($line);
    var $right = $('<span class="float-right text-truncated"/>')
        .addClass(label.toLowerCase())
        .text(data).appendTo($line);
    return $line;
}

function sortImagesBy(criteria) {
    var $images = $('.single-image');

    switch (criteria) {
        case 'by-filename':
            $images.sort(function (a, b) {
                var afilename = $(a).find('.filename').text();
                var bfilename = $(b).find('.filename').text();
                return afilename.localeCompare(bfilename);
            });
            break;
        case 'by-width':
            $images.sort(function (a, b) {
                var awidth = parseInt($(a).find('.dimensions').text().split('x')[0].trim());
                var bwidth = parseInt($(b).find('.dimensions').text().split('x')[0].trim());
                console.log(awidth + ' <= ' + bwidth);
                return (awidth <= bwidth) ? -1 : 1;
            });
            break;
        case 'by-height':
            $images.sort(function (a, b) {
                var aheight = parseInt($(a).find('.dimensions').text().split('x')[1].trim());
                var bheight = parseInt($(b).find('.dimensions').text().split('x')[1].trim());
                return (aheight <= bheight) ? -1 : 1;
            });
            break;
        case 'by-size':
            $images.sort(function (a, b) {
                var asize = parseInt($(a).find('.size').text().replace('KB', '').trim());
                var bsize = parseInt($(b).find('.size').text().replace('KB', '').trim());
                return (asize <= bsize) ? -1 : 1;
            });
            break;
        case 'by-filter':
            $images.sort(function (a, b) {
                var afilter = $(a).find('.filter').text();
                var bfilter = $(b).find('.filter').text();
                return afilter.localeCompare(bfilter);
            });
            break;
        case 'by-time':
            $images.sort(function (a, b) {
                var atime = parseInt($(a).find('.time').text().replace('ms', '').trim());
                var btime = parseInt($(b).find('.time').text().replace('ms', '').trim());
                return (atime <= btime) ? -1 : 1;
            });
            break;
        default:
            break;
    }

    $images.appendTo('#thumbnails');
}

function getOriginalName() {
    return $('#previewer').data('name');
}

function getOriginalNameNoExt() {
    return $('#previewer').data('name').split('.')[0];
}
