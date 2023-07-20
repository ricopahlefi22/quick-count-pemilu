$(document).ready(function () {
    var columns = [
        {
            data: "name",
            name: "name",
            class: "font-weight-bold",
        },
        {
            data: "id_number",
            name: "id_number",
            class: "font-weight-bold",
        },
        {
            data: "voting_place",
            name: "voting_place",
        },
        {
            data: "village",
            name: "village",
        },
    ];

    var oLanguage = {
        sSearch: "Pencarian",
        sInfoEmpty: "Data Belum Tersedia",
        sInfo: "Menampilkan _PAGE_ dari _PAGES_ halaman",
        sEmptyTable: "Data Belum Tersedia",
        sLengthMenu: "Tampilkan _MENU_ Baris",
        sZeroRecords: "Data Tidak Ditemukan",
        sProcessing: "Sedang Memproses...",
        oPaginate: {
            sFirst: "Pertama",
            sPrevious: "Sebelumnya",
            sNext: "Selanjutnya",
            sLast: "Terakhir",
        },
    };

    var table = $("#table").DataTable({
        stateSave: true,
        serverSide: true,
        processing: true,
        deferRender: true,
        select: true,
        autoWidth: false,
        responsive: true,
        ajax: document.URL,
        columns: columns,
        oLanguage: oLanguage,
    });
});
