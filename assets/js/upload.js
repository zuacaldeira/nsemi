var $upload = null;

$(document).ready(function(){
    $upload = $('#data');
    $upload.on('change', function(event) {
        readURL(this);
        enableActions();
    });
});

function readURL(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function(e) {
            $('#previewer img').attr('src', e.target.result);
        }

        reader.readAsDataURL(input.files[0]);
    }
}

function enableActions() {
    $('button:disabled').prop('disabled', false);
    $('input:disabled').prop('disabled', false);
}

function disableActions() {
    $('button:disabled').prop('disabled', true);
    $('input:disabled').prop('disabled', true);
}

