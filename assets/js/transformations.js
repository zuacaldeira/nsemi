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
    if(pData != '') {
        showResizeOneForm();
        enableActions();
    }
}

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
    $('#btn-resize, #btn-resize-many, #btn-crop-thumbnail, #btn-crop-thumbnail-many, #btn-convert').on('click', function(event){
        event.preventDefault();
        $(this).parent().find('.active').removeClass('active');
        $(this).addClass('active');
    });
    
    $('#btn-resize').on('click', function (event) {
        event.preventDefault();
        showResizeOneForm();
        enableActions();
    });

    $('#btn-resize-many').on('click', function (event) {
        event.preventDefault();
        showResizeManyForm();
        enableActions();
    });

    $('#btn-crop-thumbnail').on('click', function (event) {
        event.preventDefault();
        showCropThumbnailForm();
        enableActions();
    });
    $('#btn-crop-thumbnail-many').on('click', function (event) {
        event.preventDefault();
        showCropThumbnailManyForm();
        enableActions();
    });
    $('#btn-convert').on('click', function (event) {
        event.preventDefault();
        showConvertForm();
        enableActions();
    });

    $('#forms').on('click', '#do-resize-one', function (event) {
        event.preventDefault();
        requestResize(false);
    });
    $('#forms').on('click', '#do-resize-many', function (event) {
        event.preventDefault();
        requestResize(true);
    });
    $('#forms').on('click', '#do-crop-thumbnail', function (event) {
        event.preventDefault();
        requestCropThumbnail(false);
    });
    $('#forms').on('click', '#do-crop-thumbnail-many', function (event) {
        event.preventDefault();
        requestCropThumbnail(true);
    });
    $('#forms').on('click', '#do-convert', function (event) {
        event.preventDefault();
        requestConvert();
    });

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
        showResizeOneForm();
        enableActions();
        
        var name = $('#data').val().replace("C:\\fakepath\\", '');
        name = name.split('.')[0];
        $('#previewer').data('name', name);
    });

    $('#download-all').on('click', function (event) {
        event.preventDefault();
        var zip = new JSZip();
        zip.file("Hello.txt", "Hello World\n");
        
        var img = zip.folder("images");
        
        var name = $('#previewer').data('name');
        
        $.each(transformations, function(key, value){
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
                    content, name + '_v' + (+ new Date()) + ".zip");
            });
    });
}

function showResizeOneForm() {
    if($('#previewer').data('name') != '') {
        url = '../assets/php/forms/form_resize_one.php'
    }
    else {
        url = 'assets/php/forms/form_resize_one.php';
    }
    
    if($form_one == null) {
        $form_one = $('<div/>').load(url);
    }
    $('#forms').empty().append($form_one);
}

function showResizeManyForm() {
    if($form_many == null) {
        $form_many = $('<div/>').load('assets/php/forms/form_resize_many.php');
        
    }
    $('#forms').empty().append($form_many);
}

function showCropThumbnailForm() {
    if($form_crop_thumbnail == null) {
        $form_crop_thumbnail = $('<div/>').load('assets/php/forms/form_crop_thumbnail.php');
        
    }
    $('#forms').empty().append($form_crop_thumbnail);
}

function showCropThumbnailManyForm() {
    if($form_crop_thumbnail_many == null) {
        $form_crop_thumbnail_many = $('<div/>').load('assets/php/forms/form_crop_thumbnail_many.php');
        
    }
    $('#forms').empty().append($form_crop_thumbnail_many);
}

function showConvertForm() {
    if($form_convert == null) {
        $form_convert = $('<div/>').load('assets/php/forms/form_convert.php');
        
    }
    $('#forms').empty().append($form_convert);
}

function requestResize(multiple) {
    var data = $('#previewer img').attr('src');
    var width = parseInt($('form .width').val());
    var height = parseInt($('form .height').val());

    prepareThumbnails(width, height);
    
    var name = getImageName();
    if(name == '') {
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
}

function resize(width, height, data, name, filter, multiple) {
    disableActions();
    startTransformationStatus();
    
    var url = (multiple) ?
        'assets/php/resize_many.php' :
        'assets/php/resize_one.php';

    if($('#previewer').data('name') != '') {
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
        error: function () {
            alert('Error during resize...');
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
    addImageCards(result);
    enableActions();
    $('#s-player').show();
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

    var $wrapper = $('<div class="single-image small m-0 p-0 mb-1 mx-auto" />');

    var $filename = createImageDetailLine('Filename', image.name);
    var $size = createImageDetailLine('Size', getImageSize(image) + ' KB');
    var $dimensions = createImageDetailLine('Dimensions', width + ' x ' + height);
    var $filter = createImageDetailLine('Filter', image.filter);
    var $time = createImageDetailLine('Time', getImageProcessingTime(image) + ' ms');

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

function getImageSize(image) {
    if(image.size) {
        return image.size.toFixed(2);
    }
    
    else return '?';
}

function getImageProcessingTime(image) {
    if(image.time) {
        return image.time.toFixed(3);
    }    
    else return '?';
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
    return $('#previewer').data('name') || $('#data').data('name');
}

function getOriginalNameNoExt() {
    return ($('#previewer').data('name') || $('#data').data('name')).split('.')[0];
}

function startTransformationStatus(){
    t_start = new Date();
    startStatusUpdate();
}

function startStatusUpdate() {
    status_interval = setInterval(function() {
        updateStatus();
    }, 100);
}

function updateStatus() {
    t_end = new Date();
    var diff = ((t_end.getTime() - t_start.getTime())/1000).toFixed(2);
    $('#transformations-status .elapsed-time').text(diff + ' s');    
}

function endTransformationStatus(){
    updateStatus();
    stopStatusUpdate();
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
    alert(format);
    
    convertImage(data, name, format);
}