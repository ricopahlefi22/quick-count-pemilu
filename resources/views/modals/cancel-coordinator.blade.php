<div class="modal fade" id="cancelCoordinatorModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-danger text-white">
                <h5 class="modal-title" id="staticBackdropLabel">Batalkan Koordinator</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="cancelCoordinatorForm" method="POST">
                <input id="idCancelCoordinator" type="hidden" name="id">
                <div class="modal-body bg-danger text-white">
                    membatalkan <span class="fw-bold name-coordinator"></span> sebagai koordinator akan membatalkan anggota-anggotanya juga. Yakin ingin melanjutkan?
                </div>
                <div class="modal-footer bg-danger text-white">
                    <button type="button" class="btn btn-default" data-bs-dismiss="modal">Tutup</button>
                    <button id="cancelCoordinatorButton" type="submit" class="btn btn-dark">Lanjutkan</button>
                </div>
            </form>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
