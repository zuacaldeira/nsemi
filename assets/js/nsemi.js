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
            close: function () {
                form[0].reset();
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
