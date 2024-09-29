$(function() {
    $("#mainArea").load("restrictedBranches.html"); //set standart page

    $('#menu li').each(function(index) {
        $(this).on('click', function() {       
            loadHTML($(this).attr('href'))
        });
    });
})

function loadHTML(href) {
    $("#mainArea").load(href);
}