<div class="modal fade" id="deleteMemberModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-danger text-white">
                <h5 class="modal-title">Keluarkan Dari Koordinator</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="deleteMemberForm" method="POST">
                <input id="idDeleteMember" type="hidden" name="id">
                <div class="modal-body bg-danger text-white">
                    Yakin ingin mengeluarkan <span class="fw-bold name-coordinator"></span>?
                </div>
                <div class="modal-footer bg-danger text-white">
                    <button type="button" class="btn btn-default" data-bs-dismiss="modal">Tutup</button>
                    <button id="deleteMemberButton" type="submit" class="btn btn-dark">Lanjutkan</button>
                </div>
            </form>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
