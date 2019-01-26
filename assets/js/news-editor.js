var $editor = null;
var article = {
    title: null,
    abstract: null,
    sections: [],
    sidenotes: [],
    footnotes: []
}

$(document).ready(function(){
    loadEditor();
    updateImagesSrc();
});

function loadEditor() {
    $editor = $('<div class="editor text-center d-block mx-auto sticky-top"/>');
    $editor.css({
        background: 'rgba(155, 155, 255, .95)'
    });
    
    var $addTitleButton = createTitleButton();
    var $addAbstractButton = createAbstractButton();
    var $addSectionButton = createSectionButton();
    var $addParagraphButton = createParagraphButton();
    var $addImageButton = createImageButton();
    var $addVideoButton = createVideoButton();
    var $addSidenoteButton = createSidenoteButton();
    var $addFootnoteButton = createFootnoteButton();
    
    $editor
        .append($addTitleButton)
        .append($addAbstractButton)
        .append($addSectionButton)
        .append($addParagraphButton)
        .append($addImageButton)
        .append($addVideoButton)
        .append($addSidenoteButton)
        .append($addFootnoteButton);
    
    $('main').prepend($editor);
    $('.content').richText();
    $('.content').on('change', function(event){        
        updateImagesSrc();
    });
}

/*function updateImagesSrc() {
    $.each($('img'), function(key, value){
        var oldSrc = $(this).attr('src');
        if(!oldSrc.includes('http')) {
            $(this).attr('src', getDomain() + oldSrc);
        }
    });
}*/

function createTitleButton() {
    return $('<button />')
        .addClass('btn btn-sm')
        .text('+ Title')
        .on('click', function(event){ addTitle(); });
}

function createAbstractButton() {
    return $('<button />')
        .addClass('btn btn-sm')
        .text('+ Abstract');
}
function createSectionButton() {
    return $('<button />')
        .addClass('btn btn-sm')
        .text('+ Section');
}
function createParagraphButton() {
    return $('<button />')
        .addClass('btn btn-sm')
        .text('+ Paragraph');
}
function createImageButton() {
    return $('<button />')
        .addClass('btn btn-sm')
        .text('+ Image');
}
function createVideoButton() {
    return $('<button />')
        .addClass('btn btn-sm')
        .text('+ Video');
}
function createSidenoteButton() {
    return $('<button />')
        .addClass('btn btn-sm')
        .text('+ Sidenote');
}
function createFootnoteButton() {
    return $('<button />')
        .addClass('btn btn-sm')
        .text('+ Footnote');
}

function addTitle() {
    var $titleWrapper = $('<h2 class="display-2 text-dark"/>');
    var $titleInput = $('<input id="article-title" type="text" plaholder="A title for my article..."/>');
    

    $titleInput.on('change', function(event){
        event.preventDefault();
    });
    
    getForm().prepend($titleWrapper.append($titleInput));
    $titleInput.focus();
}
function getCurrentArticle() {
    return $('.news-article');
}
function getForm() {
    return $('.news-article form');
}

