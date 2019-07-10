$(document).ready(function () {
    // ESC ile modal kapat
    $(document).keydown(function (e) {
        if (e.keyCode === 27) {
            //$("#md_selfInfo").fadeOut(500);
            $(".modal").modal('hide');
        }
    });

    $(".alert").fadeTo(2000, 500).slideUp(500, function () {
        $(".alert").slideUp(500);
    });

    var tab_sinemalar = $('#tab_sinemalar');
    var tab_salonlar = $('#tab_salonlar');
    var tab_seanslar = $('#tab_seanslar');
    var tab_filmler = $('#tab_filmler');
    var tab_gosterimler = $('#tab_gosterimler');

    tab_sinemalar.find('tr').click(function (e) {
        var sinema_id = $(this).attr('sinema_id');
        $.get('service.php?op=getSinema&id=' + sinema_id, function (response, status) {
            var res = JSON.parse(JSON.stringify(response));
            console.log(res);
            if (res && res.status == 'success') {
                var s = res.result;
                $('#frmSinema').append('<input type="hidden" name="sinema[id]" value="' + s.id + '" />');
                $('#txtSinemaAd').val(s.ad);
                $('#txtSinemaYer').val(s.yer);
            } else {
                alertify.error('Hata Oluştu');
                if (res.result)
                    alertify.error(res.result);
            }
        });
    });

    tab_salonlar.find('tr').click(function (e) {
        var salon_id = $(this).attr('sinema_id');
        $.get('service.php?op=getSalon&id=' + salon_id, function (response, status) {
            var res = JSON.parse(JSON.stringify(response));
            console.log(res);
            if (res && res.status == 'success') {
                var s = res.result;
                $('#frmSalon').append('<input type="hidden" name="salon[id]" value="' + s.id + '" />');
                $('#cmbSinemalar').val(s.sinema_id);
                $('#txtSalonAd').val(s.ad);
                $('#txtSalonKapasite').val(s.kapasite);
                $('#txtSalonSesSistemi').val(s.ses_sistemi);
            } else {
                alertify.error('Hata Oluştu');
                if (res.result)
                    alertify.error(res.result);
            }
        });
    });

    tab_seanslar.find('tr').click(function (e) {
        var seans_id = $(this).attr('seans_id');
        $.get('service.php?op=getSeans&id=' + seans_id, function (response, status) {
            var res = JSON.parse(JSON.stringify(response));
            console.log(res);
            if (res && res.status == 'success') {
                var s = res.result;
                $('#frmSeans').append('<input type="hidden" name="seans[id]" value="' + s.id + '" />');
                $('#txtSeansZaman').val(s.zaman);
            } else {
                alertify.error('Hata Oluştu');
                if (res.result)
                    alertify.error(res.result);
            }
        });
    });

    tab_filmler.find('tr').click(function (e) {
        var film_id = $(this).attr('film_id');
        $("#cmbFilmYonetmen").val('');
        $("#cmbFilmOyuncu").val('');
        $.get('service.php?op=getFilm&id=' + film_id, function (response, status) {
            var res = JSON.parse(JSON.stringify(response));
            console.log(res);
            if (res && res.status == 'success') {
                var f = res.result;
                $('#frmFilm').append('<input type="hidden" name="film[id]" value="' + f.id + '" />');
                $('#txtFilmAd').val(f.ad);
                $('#txtFilmYil').val(f.yil);
                $('#txtFilmDil').val(f.dil);
                $('#txtFilmSure').val(f.sure);
                $.each(f.yonetmens, function (i, e) {
                    $("#cmbFilmYonetmen").find("option[value='" + e + "']").prop("selected", true);
                });
                $.each(f.oyuncus, function (i, e) {
                    $("#cmbFilmOyuncu").find("option[value='" + e + "']").prop("selected", true);
                });
            } else {
                alertify.error('Hata Oluştu');
                if (res.result)
                    alertify.error(res.result);
            }
        });
    });

    tab_gosterimler.find('tr').click(function (e) {
        var gosterim_id = $(this).attr('gosterim_id');
        $.get('service.php?op=getGosterim&id=' + gosterim_id, function (response, status) {
            var res = JSON.parse(JSON.stringify(response));
            console.log(res);
            if (res && res.status == 'success') {
                var g = res.result;
                $('#frmGosterim').append('<input type="hidden" name="gosterim[id]" value="' + g.id + '" />');
                $('#cmbGosterimSalon').val(g.salon_id);
                $('#cmbGosterimFilm').val(g.film_id);
                $('#txtGosterimTarih').val(g.tarih);
                $('#cmbGosterimSeans').val(g.seans_id);
                $('#txtGosterimBiletUcret').val(g.bilet);
            } else {
                alertify.error('Hata Oluştu');
                if (res.result)
                    alertify.error(res.result);
            }
        });
    });

});