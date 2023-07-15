$("[data-countdown]").each(function () {
    var n = $(this),
        s = $(this).data("countdown");
    n.countdown(s, function (n) {
        $(this).html(
            n.strftime(
                '<div class="coming-box">%D <span>Hari</span></div> <div class="coming-box">%H <span>Jam</span></div> <div class="coming-box">%M <span>Menit</span></div> <div class="coming-box">%S <span>Detik</span></div> '
            )
        );
    });
});
