$(document).ready(function() {
    handleVideoForm();
});


function validateForm() {
    console.log('Validating form...');
    
    var validTitle = $('#title').val() != null && 
                     $('#title').val() != '' ;
    
    var validDescription = $('#description').val() != null &&
                           $('#description').val() != '' ;
    
    var nfiles = $('#video').val();
    
    var validVideo = nfiles != '';
    
    if(!validTitle) {
        $('#title-group .error').text('Title is required.');
    }
    else {
        $('#title-group .error').text('');
    }
    
    if(!validDescription) {
        $('#description-group .error').text('Description is required.');
    }
    else {
        $('#description-group .error').text('');
    }
    
    if(!validVideo) {
        $('#video-group .error').text('Video is required.');
    }
    else {
        $('#video-group .error').text('');
    }
    
    if(validTitle && validDescription && validVideo) {
        $('#save').prop('disabled', false);
    }
}

function handleVideoForm() {
    $(document).on('change', 'input', function(e){
        e.preventDefault();
        validateForm();
    });

    $(document).on('change', 'input#video', function(e){
        e.preventDefault();
        readURL($(this));
        validateForm();
    });
    
    
    validateForm();
}

function readURL(input) {
    if (input[0].files && input[0].files[0]) {
        var reader = new FileReader();

        reader.onloadend = function(e) {
            alert(e.target.result);
            $source = $('<source/>').attr('src', e.target.result);
            $('#vpreviewer video').append($source);
        }

        reader.readAsDataURL(input[0].files[0]);
    }
}

