var columns = [
    {
        data: "voting_place",
        name: "voting_place",
    },
    {
        data: "district",
        name: "district",
    },
    {
        data: "file",
        name: "file",
        class: "text-center",
    },
    {
        data: "action",
        name: "action",
        orderable: false,
        searchable: false,
        class: "text-center",
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
