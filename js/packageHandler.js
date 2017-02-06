$(document).ready(function() {
    $(function() {
        loading();
        $("#packageHandler").submit();
    });

    $("#sendAdress").click(function() {
        var zipcode = $("input[name='zipcode']").val();
        var housenumber = $("input[name='housenumber']").val();

        var zipRegex = /^[1-9][0-9]{3} ?(?!sa|sd|ss)[a-z]{2}$/i;

        if (!zipRegex.test(zipcode)) {
            $(".zip.error").text('Geen geldige postcode ingevoerd.');
        } else {
            $(".zip.error").text('');
        }
        if (!$.isNumeric(housenumber)) {
            $(".hn.error").text('Geen geldig huisnummer ingevoerd.');
        } else {
            $(".hn.error").text('');
        }
        loading();
        $("#packageHandler").submit();
    });

    $(".check").children().each(function() {
        $(this).change(function() {
            loading();
            $("#packageHandler").submit();
        });
    });

    function loading() {
        $("#packageHandler").css("pointer-events", "none");
        $("#packageWrapper").html('<div class="loadingscreen"></div>');
    }

    $(document).on('submit', '#packageHandler', function(e) {
        e.preventDefault();


        $.ajax({
            type: 'POST',
            url: '//dev.allesin1vergelijken.eu/includes/ajaxData.php',
            data: $('#packageHandler').serialize(),
            success: function(result) {
                $("#packageWrapper").html(result);

                $(".package").each(function() {
                    var package = $(this);
                    var opened = false;
                    var offsetLeft = package.find(".package-title").offset().left - package.find(".package-wrapper").offset().left;

                    package.find(".more-info").width(package.width() - offsetLeft);

                    package.find(".show-more").click(function() {
                        if (opened) {
                            $(package).animate({
                                height: 100
                            }, 300);
                            $(this).html('Meer info <i class="fa fa-angle-down" aria-hidden="true"></i></i>');
                            opened = false;
                        } else {
                            $(package).animate({
                                height: package.find(".left").height() + 50
                            }, 300);
                            $(this).html('Minder info <i class="fa fa-angle-up" aria-hidden="true"></i></i>');
                            opened = true;
                        }
                    });
                });
                $("#packageHandler").animate({
                    opacity: 1
                }, 200);
                $("#packageHandler").css("pointer-events", "auto");
            }
        });
    });
});
