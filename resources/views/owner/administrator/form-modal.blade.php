<div class="modal fade" id="formModal" tabindex="-1" role="dialog" aria-labelledby="formModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div id="modalHeader" class="modal-header">
                <h4 class="modal-title fs-5" id="modalTitle"></h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="form" action="administrators/store" method="POST" enctype="multipart/form-data">
                <input type="hidden" id="id" name="id">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-12 col-md-5">
                            <div class="mb-2">
                                <label for="title" class="form-label">Foto</label>
                                <input id="hiddenPhoto" type="hidden" name="hidden_photo">
                                <input id="photo" type="file" class="dropify" name="photo"
                                    data-allowed-file-extensions="jpeg jpg png" data-max-file-size="1000K">
                            </div>
                        </div>
                        <div class="col-12 col-md-7">
                            <div class="mb-2">
                                <label for="name" class="form-label">Nama<strong class="text-danger">*</strong>
                                </label>
                                <input type="text" class="form-control" id="name" name="name"
                                    placeholder="Nama Lengkap">
                                <span id="nameError" class="invalid-feedback"></span>
                            </div>
                            <div class="mb-2">
                                <label for="email" class="form-label">Email<strong class="text-danger">*</strong>
                                </label>
                                <input type="text" class="form-control" id="email" name="email"
                                    placeholder="Email">
                                <span id="emailError" class="invalid-feedback"></span>
                            </div>
                            <div class="mb-2">
                                <label for="phoneNumber" class="form-label">No. Handphone<strong
                                        class="text-danger">*</strong>
                                </label>
                                <input type="text" class="form-control" id="phoneNumber" name="phone_number"
                                    placeholder="Nomor Handphone">
                                <span id="phoneNumberError" class="invalid-feedback"></span>
                            </div>
                            <div class="mb-2">
                                <label for="level" class="form-label">Level<strong class="text-danger">*</strong>
                                </label>
                                <select name="level" id="level" class="form-control">
                                    <option value="">*PILIH LEVEL</option>
                                    <option value="0">Administrator</option>
                                    <option value="1">Super Admin</option>
                                </select>
                                <span id="levelError" class="invalid-feedback"></span>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-secondary waves-effect" data-bs-dismiss="modal">Tutup</button>
                    <button id="button" type="submit" class="btn btn-dark">Tambah</button>
                </div>
            </form>
        </div>
    </div>
</div>
