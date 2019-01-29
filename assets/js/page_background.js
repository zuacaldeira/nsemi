$(document).ready(function () {
    var page = getPage();
    if (page == 'Gallery') {
        $('body').addClass('gallery', 3000);
    }
    else if (page == 'Tools') {
        $('body').addClass('tools', 3000);
    }
    else if (page == 'Documentation') {
        $('body').addClass('documentation', 3000);
    }
    else {
        $('body').addClass('home', 5000);
    }


});

function getPage() {
    if (location.href.includes('home')) {
        return 'Home';
    }
    if (location.href.includes('gallery')) {
        return 'Gallery';
    }
    if (location.href.includes('tools')) {
        return 'Tools';
    }
    if (location.href.includes('vguides')) {
        return 'Documentation';
    }
}
