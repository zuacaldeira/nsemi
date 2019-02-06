var $form_one = null;
var $form_many = null;
var $form_crop_thumbnail = null;
var $form_crop_thumbnail_many = null;
var $form_convert = null;

var t_start = null;
var t_end = null;
var status_interval = null;

var transformations = null;

var original = {
    name: null,
    src: null
}

$(document).ready(function () {
    //handleScrollEvent();
    handleImageGiven();
    handleFormEvents();
    handleTransformationEvents();
});

function handleImageGiven() {
    var pData = $('#previewer').data('name');
    if (pData != '') {
        updateBodyImage();
        showResizeOneForm();
        enableActions();
    }
}

function handleFormEvents() {
    $('#btn-resize, #btn-resize-many, #btn-crop-thumbnail, #btn-crop-thumbnail-many, #btn-convert').on('click', function (event) {
        event.preventDefault();
        $(this).parent().find('.active').removeClass('active');
        $(this).addClass('active');
    });

    $('#btn-resize').on('click', function (event) {
        event.preventDefault();
        showResizeOneForm();
    });

    $('#btn-resize-many').on('click', function (event) {
        event.preventDefault();
        showResizeManyForm();
    });

    $('#btn-crop-thumbnail').on('click', function (event) {
        event.preventDefault();
        showCropThumbnailForm();
    });
    $('#btn-crop-thumbnail-many').on('click', function (event) {
        event.preventDefault();
        showCropThumbnailManyForm();
    });
    $('#btn-convert').on('click', function (event) {
        event.preventDefault();
        showConvertForm();
    });

    $('#forms').on('click', '#do-resize-one', function (event) {
        event.preventDefault();
        requestResize(false);
        disableActions();
    });
    $('#forms').on('click', '#do-resize-many', function (event) {
        event.preventDefault();
        requestResize(true);
        disableActions();
    });
    $('#forms').on('click', '#do-crop-thumbnail', function (event) {
        event.preventDefault();
        requestCropThumbnail(false);
        disableActions();
    });
    $('#forms').on('click', '#do-crop-thumbnail-many', function (event) {
        event.preventDefault();
        requestCropThumbnail(true);
        disableActions();
    });
    $('#forms').on('click', '#do-convert', function (event) {
        event.preventDefault();
        requestConvert();
        disableActions();
    });
    
    var hasName = $('#previewer').data('name').length > 0;
    if (hasName) {
        $('#btn-resize').click();
    }


}


function handleTransformationEvents() {
    $('#by-filename, #by-width, #by-height, #by-size, #by-filter').on('click', function (event) {
        event.preventDefault();
        var $this = $(this);
        $this.parent().find('.active').removeClass('active');
        $this.addClass('active');
        sortImagesBy($this.attr('id'));
    });
    
    $('#expand, #compress').on('click', function (event) {
        event.preventDefault();
        var $this = $(this);
        $this.parent().find('.active').removeClass('active');
        $this.addClass('active');
        $('.single-image').toggleClass('tools-thumb');
        $('#expand, #compress').toggle();
    });
    $('#btn-details-show, #btn-details-hide').on('click', function (event) {
        event.preventDefault();
        var $this = $(this);
        $this.parent().find('.active').removeClass('active');
        $this.addClass('active');
        $('#btn-details-show, #btn-details-hide').toggle();
        $('#thumbnails .details').toggle(1000);
    });
    
    

    $(document).on('_preview_upload', function (event) {
        $('#s-transform').show();
        $('#btn-resize').click();
        updateBodyImage();
    });

    $('#download-all').on('click', function (event) {
        event.preventDefault();
        var zip = new JSZip();
        zip.file("Hello.txt", "Hello World\n");

        var img = zip.folder("images");

        var name = getImageName();
        if (name.includes('.')) {
            name = getOriginalNameNoExt();
        }

        if (name.includes('fakepath')) {
            name = $('#data').val().split('\\')[2].replace('.jpg', '');
        }

        $.each(transformations, function (key, value) {
            var i = value;
            img.file(i.name, i.src.split('base64,')[1], {
                base64: true
            });
            console.log('Added file', i.name);
            //console.log('Original', getOriginalName());
        });
        zip.generateAsync({
                type: "blob"
            })
            .then(function (content) {
                // see FileSaver.js
                saveAs(
                    content, name + '_v' + (+new Date()) + ".zip");
            });
    });
}

function showResizeOneForm() {
    var hasName = $('#previewer').data('name').length > 0;
    if (hasName) {
        url = '../assets/php/forms/form_resize_one.php'
    } else {
        url = 'assets/php/forms/form_resize_one.php';
    }

    $form_one = $('<div/>').load(url);
    $('#forms').empty().append($form_one);
}

function showResizeManyForm() {
    var hasName = $('#previewer').data('name').length > 0;
    if (hasName) {
        url = '../assets/php/forms/form_resize_many.php'
    } else {
        url = 'assets/php/forms/form_resize_many.php';
    }
    $form_many = $('<div/>').load(url);
    $('#forms').empty().append($form_many);
}

function showCropThumbnailForm() {
    var hasName = $('#previewer').data('name').length > 0;
    if (hasName) {
        url = '../assets/php/forms/form_crop_thumbnail.php'
    } else {
        url = 'assets/php/forms/form_crop_thumbnail.php';
    }
    $form_crop_thumbnail = $('<div/>').load(url);
    $('#forms').empty().append($form_crop_thumbnail);
}

function showCropThumbnailManyForm() {
    var hasName = $('#previewer').data('name').length > 0;
    if (hasName) {
        url = '../assets/php/forms/form_crop_thumbnail_many.php'
    } else {
        url = 'assets/php/forms/form_crop_thumbnail_many.php';
    }
    $form_crop_thumbnail_many = $('<div/>').load(url);
    $('#forms').empty().append($form_crop_thumbnail_many);
}

function showConvertForm() {
    var hasName = $('#previewer').data('name').length > 0;
    if (hasName) {
        url = '../assets/php/forms/form_convert.php'
    } else {
        url = 'assets/php/forms/form_convert.php';
    }
    $form_convert = $('<div/>').load(url);
    $('#forms').empty().append($form_convert);
}

function requestResize(multiple) {
    var data = $('#previewer img').attr('src');
    var width = parseInt($('form .width').val());
    var height = parseInt($('form .height').val());

    prepareThumbnails(width, height);

    var name = getImageName();
    if (name == '') {
        name = getOriginalName();
    }

    var filter = $('#select-filter').val();
    resize(width, height, data, name, filter, multiple);
}

function getImageName() {
    var name = null;

    if ($('#data').length == 0) {
        name = $('#previewer').data('name');
    } else {
        name = $('#data').val().trim();
    }
    return name;
}

function prepareThumbnails(width, height) {
    $('#thumbnails').empty();
    $('#result').hide();
}

function resize(width, height, data, name, filter, multiple) {
    disableActions();
    startTransformationStatus();

    var url = (multiple) ?
        'assets/php/resize_many.php' :
        'assets/php/resize_one.php';

    if ($('#previewer').data('name') != '') {
        url = '../' + url;
    }

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
            updateTransformations(result);
            endTransformationStatus();
        },
        error: function (xhr, ajaxOptions, thrownError) {
            alert('Error during resize... ' + jQuery.parseJSON( xhr.responseText ));
            endTransformationStatus();
        }
    })
}

function cropThumbnail(width, height, data, name, multiple) {
    disableActions();
    startTransformationStatus();
    var url = (multiple) ?
        'assets/php/crop_thumbnail_many.php' :
        'assets/php/crop_thumbnail.php';

    if ($('#previewer').data('name') != '') {
        url = '../' + url;
    }


    $.ajax({
        url: url,
        method: 'POST',
        dataType: 'json',
        data: {
            width: width,
            height: height,
            name: name,
            data: data,
            multiple: multiple
        },
        success: function (result) {
            updateTransformations(result);
            endTransformationStatus();
        },
        error: function () {
            alert('Error during crop...');
            endTransformationStatus();
        }
    });
}

function convertImage(data, name, format) {
    disableActions();
    startTransformationStatus();
    var url = 'assets/php/convert_image.php';
    if ($('#previewer').data('name') != '') {
        url = '../' + url;
    }

    $.ajax({
        url: url,
        method: 'POST',
        dataType: 'json',
        data: {
            name: name,
            data: data,
            format: format
        },
        success: function (result) {
            updateTransformations(result);
            endTransformationStatus();
        },
        error: function () {
            alert('Error during conversion...');
            endTransformationStatus();
        }
    });
}

function updateTransformations(result) {
    console.log(result);
    transformations = result;
    $('#result').show();

    addImageCards(result);
    enableActions();
    
    $('#result').css({
        width: $('#thumbnails').innerWidth()
    });
    $('html, body').animate({
        scrollTop: $('#result').offset().top
    }, 1000);
    $('#download-all span').text(transformations.length);
}

function addImageCards(images) {
    $.each(images, function (key, image) {
        addNewImageCard(image);
    });
    
}

function addNewImageCard(image) {
    var width = parseInt(image.width);
    var height = parseInt(image.height);

    var alpha = $('#thumbnails').innerWidth() - 8;
    var factor = alpha / width;
    var beta = factor * height;
    
    var usedHeight = (width > alpha) ? beta : height;
    var usedWidth = (width > alpha) ? alpha : width;
    
    var $wrapper = $('<div class="single-image image-wrapper shadow d-inline-block">')
        .attr('data-width', width)
        .attr('data-height', height)
        .attr('data-factor', factor)
        .attr('title', 
              'name '  + image.name + ' | ' + 
              'width '  + width + 'px' + ' | ' + 
              'heigth ' + height + 'px' + ' | ' + 
              'factor ' + ((width > alpha) ? factor : 0) + ' | ' + 
              'filter '   + image.filter 
             )
        .css({
            width: usedWidth,
            height: usedHeight,
            margin: '1px'
        });
    
    
    var $img = $('<img/>')
        .attr('src', image.src)
        .css('height', usedHeight)
        .css('width', usedWidth);

    var $filename = createImageDetailLine('Filename', image.name);
    var $size = createImageDetailLine('Size', getImageSize(image) + ' KB');
    var $dimensions = createImageDetailLine('Dimensions', width + ' x ' + height);
    var $filter = createImageDetailLine('Filter', image.filter);
    var $time = createImageDetailLine('Time', getImageProcessingTime(image) + ' ms');

    var $details = $('<div class="details p-1 text-light small w-100" />');
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

    $wrapper.append($img).append($details);
    $('#thumbnails').append($wrapper);

}

function getImageSize(image) {
    if (image.size) {
        return image.size.toFixed(2);
    } else return '?';
}

function getImageProcessingTime(image) {
    if (image.time) {
        return image.time.toFixed(3);
    } else return '?';
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
    return $('#previewer').data('name') || $('#data').val().trim();
}

function getOriginalNameNoExt() {
    return getOriginalName().split('.')[0];
}

function startTransformationStatus() {
    t_start = new Date();
    startStatusUpdate();
}

function startStatusUpdate() {
    status_interval = setInterval(function () {
        updateStatus();
    }, 100);
}

function updateStatus() {
    t_end = new Date();
    var diff = ((t_end.getTime() - t_start.getTime()) / 1000).toFixed(2);
    $('#transformations-status .elapsed-time').text(diff + ' s');
}

function endTransformationStatus() {
    updateStatus();
    stopStatusUpdate();
    enableActions();
}

function stopStatusUpdate() {
    clearInterval(status_interval);
}


function requestCropThumbnail(multiple) {
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
    cropThumbnail(width, height, data, name, multiple);
}

function requestConvert() {
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

    var format = $('#iformat').val();

    convertImage(data, name, format);
}
