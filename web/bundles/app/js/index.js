$(document).ready(function() {

    $(".navbar-nav li a").add(".btn-anim").on('click', function(e) {
        e.preventDefault();

        $.get($(this).attr('href')).done(function(data) {
            var content = $('.content');
            var newContent = $(data).find('.content');

            content.stop().hide("slide", { direction: "right" }, 500, function() {
                content.replaceWith(newContent);
                newContent.stop().show("slide", { direction: "left" }, 500);
            });
            newContent.stop().hide();

            // content.replaceWith(newContent);
            // newContent.fadeIn('slow');
            // newContent.show("slide", { direction: "left" }, 1000);

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