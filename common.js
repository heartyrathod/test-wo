//sidemenubar

jQuery(function ($) {

    $(".af-trigger").click(function () {
        $(".af-side-menubar,.af-overly").addClass("af-open");
        $("body").addClass("af-side-menubar-open");
    });
    //close drawer
    $(document).on('click', ".af-overly", function (e) {
        setTimeout(function () {
            $(".af-side-menubar,.af-overly").removeClass("af-open");
        }, 50);
        setTimeout(function () {
            $("body").removeClass("af-side-menubar-open");
        }, 400);
    });

});