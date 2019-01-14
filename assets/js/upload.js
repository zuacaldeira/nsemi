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
            alert('Changed -> ' + $('#previewer'));
            $('#previewer img').attr('src', e.target.result);
        }

        reader.readAsDataURL(input.files[0]);
    }
}

function enableActions() {
    $('button:disabled').prop('disabled', false);
}



