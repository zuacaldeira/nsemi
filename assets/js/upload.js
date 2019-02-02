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
        reader.fileName = input.files[0].name;
        
        reader.onload = function(e) {
            var image = new Image();
            image.src = e.target.result;
            image.onload = function() {
                console.log(this.width);
                console.log(this.height);
                
                $('#previewer img').attr('src', this.src);
                $('#previewer').show();
                $('input#name').val(e.target.fileName);
                $('input#width').val(this.width);
                $('input#height').val(this.height);
            }
        }

        reader.readAsDataURL(input.files[0]);
    }
}

function enableActions() {
    $('button:disabled').prop('disabled', false);
    $('input:disabled').prop('disabled', false);
}

function disableActions() {
    $('aside button').prop('disabled', true);
    $('aside input').prop('disabled', true);
}
