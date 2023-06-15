<div class="modal fade" id="beCoordinatorModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Jadikan Koordinator</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="beCoordinatorForm" method="POST">
                <input id="idBeCoordinator" type="hidden" name="id">
                <div class="modal-body">
                    menjadikan <span class="fw-bold name-coordinator"></span> sebagai koordinator akan mengeluarkannya dari daftar anggota koordinator lain jika ia telah terdaftar. Yakin ingin melanjutkan?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                    <button id="beCoordinatorButton" type="submit" class="btn btn-primary">Lanjutkan</button>
                </div>
            </form>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
