$(document).ready(function() {

    $("#navigation li a").on('click', function(e) {
        e.preventDefault();

        $.get($(this).attr('href')).done(function(data) {
            var content = $('.inner.cover');
            var newContent = $(data).find('.inner.cover');

            content.hide();
            newContent.hide();

            content.replaceWith(newContent);
            newContent.fadeIn('slow');

        });
            
    var location = $(this).attr('href');

    window.history.pushState({ myTag: true }, null, location);

    });

    window.addEventListener('load', function() {
      setTimeout(function() {
        window.addEventListener('popstate', function() {
            location.reload();
        });
      }, 0);
    });

});