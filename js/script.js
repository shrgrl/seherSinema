$(document).ready(function () {
    // ESC ile modal kapat
    $(document).keydown(function (e) {
        if (e.keyCode === 27) {
            //$("#md_selfInfo").fadeOut(500);
            $(".modal").modal('hide');
        }
    });

    var sinemalar = $('#sinemalar');
    var filmler = $('#filmler');
    var tarihler = $('#tarihler');

    $.get('service.php?op=sinemalar', function (response, status) {
        var res = JSON.parse(JSON.stringify(response));
        sinemalar.html(res.html);
    });

    $.get('service.php?op=filmler', function (response, status) {
        var res = JSON.parse(JSON.stringify(response));
        filmler.html(res.html);
    });

    $.get('service.php?op=tarihler', function (response, status) {
        var res = JSON.parse(JSON.stringify(response));
        tarihler.html(res.html);
    });

    $('.koltuk').click(function () {
        var koltuk = $(this).attr('koltuk');
        var satir = koltuk / 10;
        var sutun = koltuk % 10;
        if (sutun == 0) sutun = 10;

        var harf = String.fromCharCode(65 + satir);

        if ($(this).attr('secili') != 1) {
            $(this).attr('secili', '1');
            $('#koltuklar').append('<input type="hidden" name="secilen_koltuklar[]" value="' + koltuk + '"><h5 id="' + harf + sutun + '">' + harf + sutun + '</h5>');
            $(this).css('background', '#5cb85c');
        } else {
            $(this).removeAttr('secili');
            $('#koltuklar input[value="' + koltuk + '"]').remove();
            $('#koltuklar h5#' + harf + sutun).remove();
            $(this).css('background', '#fff');
        }

    });
});