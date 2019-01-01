var $previewer;
var $thumbnails;
var $upload;



$(document).ready(function () {
    init();
    handleEvents();
});

function init() {
    $upload = $('#upload').val('');
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
    var data   = $('#previewer img').attr('src');
    var width  = parseInt($('#id-resize .width').val());
    var height = parseInt($('#id-resize .height').val());
    var name = $('#upload').val();
    prepareThumbnails(width, height);
    resize(width, height, data, name);
}

function prepareThumbnails(width, height) {
}

function resize(width, height, data, name) {
    //alert('Implement ajax call / MVC Implementation');
    $.ajax({
        url: 'assets/php/resize_image.php',
        method: 'POST',
        data: {
            width: width,
            height: height,
            name: name,
            data: data
        },
        success: function(result){
            $('#thumbnails').append(
                $('<img />').attr('src', result.url)
            );
        },
        error: function() {}
    })
}
