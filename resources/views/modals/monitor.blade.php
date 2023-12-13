<div id="monitorModal" class="modal fade" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false"
    aria-labelledby="myModalLabel1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title mt-0" id="modalTitle"></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="form" action="{{ url('monitors/store') }}" method="POST">
                @csrf
                <input id="id" type="hidden" name="id">
                <div class="modal-body">
                    <div class="mb-2">
                        <label for="voterId" class="form-label">TPS<span class="text-danger">*</span></label>
                        <select id="votingPlaceId" name="voting_place_id" class="form-control"
                            style="width: 100%;"></select>
                    </div>
                    <div class="mb-2">
                        <label for="voterId" class="form-label">Pemantau<span class="text-danger">*</span></label>
                        <select id="voterId" name="voter_id" class="form-control" style="width: 100%;"
                            disabled></select>
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-secondary waves-effect" data-bs-dismiss="modal">Tutup</button>
                    <button id="button" type="submit" class="btn btn-primary waves-effect waves-light"
                        disabled>Simpan</button>
                </div>
            </form>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
