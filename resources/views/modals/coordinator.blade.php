<div id="coordinatorModal" class="modal fade" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Pilih Koordinator</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="coordinatorForm" method="POST">
                <input id="idCoordinator" type="hidden" name="id">
                <div class="modal-body">
                    <select id="coordinatorId" name="coordinator_id" class="form-control" style="width: 100%"></select>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                    <button id="coordinatorButton" type="submit" class="btn btn-primary" disabled>Lanjutkan</button>
                </div>
            </form>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
