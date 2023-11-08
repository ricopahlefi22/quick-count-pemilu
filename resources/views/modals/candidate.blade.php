<div id="candidateModal" class="modal fade" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false"
    aria-labelledby="myModalLabel1" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title mt-0" id="modalTitle"></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="form" action="{{ url('candidates/store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <input id="id" type="hidden" name="id">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-12 col-lg-3">
                            <div class="mb-2">
                                <input id="hiddenPhoto" type="hidden" name="hidden_photo">
                                <label for="photo" class="form-label">Foto</label>
                                <input id="photo" type="file" name="photo">
                            </div>
                        </div>
                        <div class="col-12 col-lg-9 row">
                            <div class="col-12 col-md-6 mb-2">
                                <label for="number" class="form-label">
                                    Nomor Urut<span class="text-danger">*</span>
                                </label>
                                <input id="number" name="number" type="number" class="form-control"
                                    placeholder="Nomor Urut">
                                <span id="numberError" class="invalid-feedback"></span>
                            </div>
                            <div class="col-12 col-md-6 mb-2">
                                <label for="name" class="form-label">
                                    Nama<span class="text-danger">*</span>
                                </label>
                                <input id="name" name="name" type="text" class="form-control"
                                    placeholder="Nama Lengkap">
                                <span id="nameError" class="invalid-feedback"></span>
                            </div>
                            <div class="col-12 col-md-6 mb-2">
                                <label for="gender" class="form-label">
                                    Jenis Kelamin<span class="text-danger">*</span>
                                    <span id="genderError" class="text-danger font-size-12"></span>
                                </label>
                                <div class="form-group row">
                                    <div class="col-12">
                                        <div class="form-check">
                                            <input id="male" class="form-check-input" value="Laki-Laki"
                                                type="radio" name="gender">
                                            <label for="male" class="form-check-label">Laki-Laki</label>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-check">
                                            <input id="female" class="form-check-input" value="Perempuan"
                                                type="radio" name="gender">
                                            <label for="female" class="form-check-label">Perempuan</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-md-6 mb-2">
                                <label for="city" class="form-label">
                                    Kota<span class="text-danger">*</span>
                                </label>
                                <input id="city" name="city" type="text" class="form-control"
                                    placeholder="Kota Tempat Tinggal">
                                <span id="cityError" class="invalid-feedback"></span>
                            </div>
                            @if (Route::current()->uri == 'candidates')
                                <div class="col-12 col-md-6 mb-2">
                                    <label for="partyId" class="my-2">Partai<span
                                            class="text-danger">*</span></label>
                                    <select id="partyId" name="party_id" class="form-control" style="width: 100%;">
                                        <option value="" disabled selected hidden>*PILIH PARTAI</option>
                                        @foreach ($parties as $party)
                                            <option value="{{ $party->id }}">
                                                {{ $party->name }}</option>
                                        @endforeach
                                    </select>
                                    <span id="partyIdError" class="invalid-feedback"></span>
                                </div>
                            @else
                                <input type="hidden" name="party_id" value="{{ $party->id }}">
                            @endif
                        </div>
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-secondary waves-effect"
                        data-bs-dismiss="modal">Tutup</button>
                    <button id="button" type="submit"
                        class="btn btn-primary waves-effect waves-light">Simpan</button>
                </div>
            </form>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
