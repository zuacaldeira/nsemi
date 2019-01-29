var video_list = null;
var videoDataUrl = null;

$(document).ready(function(){
    console.log('Hello Video Player User!');
    configureUploadButton();
    loadVideos();
});

function configureUploadButton() {
    var $button = $('#upload-button').show();
    var $li = $('<li id="#upload" class="nav-item"/>').append($button).show();
    $('#actions').prepend($li);
    

    /*$button.on('click', function(event) {
       appendVideoFormular(); 
    });*/
}



function saveVideo() {
    var title = getTitle();
    var description = getDescription();
    var video = videoDataUrl;
    alert(video);
}

function readURL(input) {
    console.log(input[0].files[0]);
    if (input[0].files && input[0].files[0]) {
        var reader = new FileReader();
        reader.readAsDataURL(input[0].files[0]);
        reader.onload = function(e) {
            videoDataUrl =  e.target.result;
        }
    }
}


function getTitle() {
    return $('#title').val();
}

function getDescription() {
    return $('#description').val();
}

function getVideo() {
    return $('#video').val();
}

function loadVideos() {
    loadVideoList();
}

function loadVideoList() {
    $.ajax({
        url: 'assets/php/get_video_list.php',
        sucess: function(result) {
            alert('success: ' + result);
            initVideoList(result);
        },
        error: function() {
            alert('error');
        }
    });
}

function initVideoList() {
    console.log('Initiating First Video...');
}

