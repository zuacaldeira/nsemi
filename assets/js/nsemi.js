var $previewer;
var $thumbnails;
var $upload;



$(document).ready(function() {
    init();
    handleEvents();
});

function init() {
    $upload = $('#upload');
    $previewer = $('#previewer');
    $thumbnails = $('#thumbnails');
}

function handleEvents() {
    $upload.on('change', function(event) {
        readURL(this);
    });
}

function readURL(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            $('#previewer').css({
                background: "url('" + e.target.result + "')"
            });
        }

        reader.readAsDataURL(input.files[0]);
    }
}
