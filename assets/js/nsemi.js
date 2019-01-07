var $previewer;
var $thumbnails;
var $upload;
var request = {
    dimension: {
        single: true,
        multiple: false
    }
};



$(document).ready(function () {
    init();
    handleEvents();
});

function init() {
    $upload = $('#upload, #data').val('');
    $previewer = $('#previewer');
    $thumbnails = $('#thumbnails');

    $('#iactions button').prop('disabled', true);
}

function handleEvents() {
    $upload.on('change', function (event) {
        readURL(this);
        enableActions();
    });

    $('#ia-resize').on('click', function (event) {
        event.preventDefault();
        $('#id-resize').dialog({
            height: "auto",
            modal: true,
            buttons: {
                Resize: function(event) {
                    event.preventDefault();
                    requestResize();
                    $('#id-resize').dialog("close");
                },
                Cancel: function() {
                    $('#id-resize').dialog("close");
                }
            },
            close: function () {
                $('#id-resize').dialog("close");
            }
        });
    });
    
    $('#ia-thumbnail').on('click', function (event) {
        event.preventDefault();
        $('#id-thumbnail').dialog();
    });
    $('#ia-convert').on('click', function (event) {
        event.preventDefault();
        $('#id-convert').dialog();
    });
    
    $('#btn-details').on('click', function(event){
        event.preventDefault();
        $('#thumbnails .card-body').toggle();
    });
    
    $('#by-filename, #by-width, #by-height, #by-size, #by-filter').on('click', function(event){
        var $this = $(this);
        $this.parent().find('.active').removeClass('active');
        $this.addClass('active');
        sortImagesBy($this.attr('id'));
    });
    
    $(document).on('click', '#single-dimension-radio', function(event) {
        $('#multiple-dimensions-radio').next().hide();
        $('#single-dimension-radio').next().show();
        request.dimension.single = true;
        request.dimension.multiple = false;
    });
    
    $(document).on('click', '#multiple-dimensions-radio', function(event) {
        $('#single-dimension-radio').next().hide();
        $('#multiple-dimensions-radio').next().show();
        request.dimension.single = false;
        request.dimension.multiple = true;
    });
}

function readURL(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            $('#previewer img').attr('src', e.target.result);
        }

        reader.readAsDataURL(input.files[0]);
    }
}

function enableActions() {
    $('button:disabled').prop('disabled', false);
}

function requestResize() {
    prepareThumbnails(width, height);
    if(request.dimension.single) {
        var data   = $('#previewer img').attr('src');
        var width  = parseInt($('#single-dimensions .width').val());
        var height = parseInt($('#single-dimensions .height').val());
        var name = $('#upload').val();
        var filter = $('#select-filter').val();
        resize(width, height, data, name, filter, false);
    }
    else if(request.dimension.multiple) {
        var data   = $('#previewer img').attr('src');
        var width  = parseInt($('#multiple-dimensions .width').val());
        var height = parseInt($('#multiple-dimensions .height').val());
        var name = $('#upload').val();
        var filter = $('#select-filter').val();
        resize(width, height, data, name, filter, true);
    }
}

function prepareThumbnails(width, height) {
    $('#thumbnails').empty();
}

function resize(width, height, data, name, filter, multiple) {
    //alert('Implement ajax call / MVC Implementation');
    $.ajax({
        url: 'assets/php/resize_image.php',
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
        success: function(result){
            console.log(result);
            $('#iplayer').show();
            addImageCards(result);
        },
        error: function() {}
    })
}

function addImageCards(images) {
    $.each(images, function(key, image){
        addNewImageCard(image);
    });
    
}

function addNewImageCard(image) {
    var width = parseInt(image.width);
    var height = parseInt(image.height);
    
    var $card = $('<div class="card small shadow d-inline-block mt-2">')
        .css({width: '' + (width + 1)});
    
    var $cardHeader = $('<div class="card-header bg-transparent p-0"/>');
    var $cardImage = $('<img class="card-image  rounded p-0"/>')
        .attr('src', image.src)
        .appendTo($cardHeader);

    var $cardBody = $('<div class="card-body">');
    
    var $filename = createImageDetailLine('Filename', image.name);
    var $size = createImageDetailLine('Size', image.size.toFixed(2) + ' KB');
    var $dimensions = createImageDetailLine('Dimensions', width + ' x ' + height);
    var $filter = createImageDetailLine('Filter', image.filter);
    var $time = createImageDetailLine('Time', image.time.toFixed(3) + ' ms');
    
    var $cardTitle = $('<div class="card-title clearfix"/>')
        .append($filename)
        .appendTo($cardBody);
    
    var $cardText = $('<div class="card-text clearfix"/>')
        .append($dimensions)
        .append($filter)
        .append($size)
        .append($time)
        .appendTo($cardBody);
    
    $card.append($cardHeader).append($cardBody);
    $('#thumbnails').append($card);

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
    var $images = $('.card');
    
    switch(criteria) {
        case 'by-filename':
            $images.sort(function(a, b) {
                var afilename = $(a).find('.filename').text();
                var bfilename = $(b).find('.filename').text();
                return afilename.localeCompare(bfilename);
            });
            break;
        case 'by-width':
            $images.sort(function(a, b) {
                var awidth = parseInt($(a).find('.dimensions').text().split('x')[0].trim());
                var bwidth = parseInt($(b).find('.dimensions').text().split('x')[0].trim());
                console.log(awidth + ' <= ' + bwidth);
                return (awidth <= bwidth) ? -1: 1 ;
            });
            break;            
        case 'by-height':
            $images.sort(function(a, b) {
                var aheight = parseInt($(a).find('.dimensions').text().split('x')[1].trim());
                var bheight = parseInt($(b).find('.dimensions').text().split('x')[1].trim());
                return (aheight <= bheight) ? -1: 1 ;
            });
            break;            
        case 'by-size':
            $images.sort(function(a, b) {
                var asize = parseInt($(a).find('.size').text().replace('KB', '').trim());
                var bsize = parseInt($(b).find('.size').text().replace('KB', '').trim());
                return (asize <= bsize) ? -1: 1 ;
            });
            break;            
        case 'by-filter':
            $images.sort(function(a, b) {
                var afilter = $(a).find('.filter').text();
                var bfilter = $(b).find('.filter').text();
                return afilter.localeCompare(bfilter);
            });
            break;
        case 'by-time':
            $images.sort(function(a, b) {
                var atime = parseInt($(a).find('.time').text().replace('ms', '').trim());
                var btime = parseInt($(b).find('.time').text().replace('ms', '').trim());
                return (atime <= btime) ? -1: 1 ;
            });
            break;            
        default: break;
    }
    
    $images.appendTo('#thumbnails');
}