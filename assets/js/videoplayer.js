var video_list = null;
var videoDataUrl = null;

$(document).ready(function(){
    console.log('Hello Video Player User!');
    configureUploadButton();
    configureVideoList();
});

function configureUploadButton() {
    var $button = $('#upload-button').show();
    var $li = $('<li id="#upload" class="nav-item"/>').append($button).show();
    $('#actions').prepend($li);
    

    /*$button.on('click', function(event) {
       appendVideoFormular(); 
    });*/
}

function configureVideoList() {
    $('.vlist li').on('click', function(){
        $('.vlist li.active').removeClass('active');
        $(this).addClass('active');
        var datasrc = $(this).data('src');
        var h = $('.vplayer').innerHeight();
        var $iframe = $('<iframe frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen class="mx-auto my-auto"/>');
        $iframe.attr('src', datasrc)
            .attr('width', '100%')
            .attr('height', h);
        
        $('.vplayer').empty().append($iframe);
    });
    
    $('.vlist li a').on('click', function(event){
        event.preventDefault();
    });
                        
    $('.vlist li.active').click();
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

function loadVideos() {
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

