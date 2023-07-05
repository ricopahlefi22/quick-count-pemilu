<div id="formModal" class="modal fade" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false"
    aria-labelledby="myModalLabel1" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title mt-0" id="modalTitle"></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="form" action="voters/store" method="POST" enctype="multipart/form-data">
                @csrf
                <input id="id" type="hidden" name="id">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-12 col-lg-4">
                            <div class="mb-2">
                                <input id="hiddenPhoto" type="hidden" name="hidden_photo">
                                <label for="photo" class="form-label">Foto</label>
                                <input id="photo" type="file" name="photo">
                            </div>
                            <div class="mb-2">
                                <input id="hiddenKTP" type="hidden" name="hidden_ktp">
                                <label for="ktp" class="form-label">Gambar KTP</label>
                                <input id="ktp" type="file" name="ktp">
                            </div>
                        </div>
                        <div class="col-12 col-lg-8 mb-2">
                            <div class="row">
                                <div class="col-12 col-lg-6 mb-2">
                                    <label title="Wajib Diisi" for="name" class="form-label">
                                        Nama<span class="text-danger">*</span>
                                    </label>
                                    <input id="name" name="name" type="text" class="form-control"
                                        placeholder="Nama Lengkap">
                                    <span id="nameError" class="invalid-feedback"></span>
                                </div>
                                <div class="col-12 col-lg-6 mb-2">
                                    <label for="idNumber" class="form-label">
                                        NIK<span class="text-danger">*</span>
                                    </label>
                                    <input id="idNumber" name="id_number" class="form-control"
                                        placeholder="Nomor Induk Kependudukan"
                                        data-inputmask='"mask": "9999 9999 9999 9999"' data-mask>
                                    <span id="idNumberError" class="invalid-feedback"></span>
                                </div>
                                <div class="col-12 col-lg-6 mb-2">
                                    <label for="familyCardNumber" class="form-label">No. KK</label>
                                    <input id="familyCardNumber" name="family_card_number" class="form-control"
                                        placeholder="Nomor Kartu Keluarga"
                                        data-inputmask='"mask": "9999 9999 9999 9999"' data-mask>
                                    <span id="familyCardNumberError" class="invalid-feedback"></span>
                                </div>
                                <div class="col-12 col-lg-6 mb-2">
                                    <label for="phoneNumber" class="form-label">No. Handphone</label>
                                    <input id="phoneNumber" type="tel"
                                        onkeypress='return event.charCode >= 48 && event.charCode <= 57'
                                        name="phone_number" class="form-control"
                                        placeholder="Nomor Handphone (Format : 08xxxxxxxxx)">
                                    <span id="phoneNumberError" class="invalid-feedback"></span>
                                </div>
                                <div class="col-12 col-lg-12 mb-2">
                                    <div class="row">
                                        <div class="col-8">
                                            <label title="Wajib Diisi" for="address" class="form-label">
                                                Alamat<span class="text-danger">*</span>
                                            </label>
                                            <input id="address" name="address" type="text" class="form-control"
                                                placeholder="Jalan/Dukuh">
                                            <span id="addressError" class="invalid-feedback"></span>
                                        </div>
                                        <div class="col-2">
                                            <label title="Wajib Diisi" for="rt" class="form-label">
                                                RT<span class="text-danger">*</span>
                                            </label>
                                            <input id="rt" name="rt" type="text" class="form-control"
                                                placeholder="RT" data-inputmask='"mask": "999"' data-mask>
                                            <span id="rtError" class="invalid-feedback"></span>
                                        </div>
                                        <div class="col-2">
                                            <label title="Wajib Diisi" for="rw" class="form-label">
                                                RW<span class="text-danger">*</span>
                                            </label>
                                            <input id="rw" name="rw" type="text" class="form-control"
                                                placeholder="RW" data-inputmask='"mask": "999"' data-mask>
                                            <span id="rwError" class="invalid-feedback"></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-lg-6 mb-2">
                                    <label for="birthplace" class="form-label">Tempat Lahir</label>
                                    <input id="birthplace" name="birthplace" type="text" class="form-control"
                                        placeholder="Tempat Lahir (Nama Kota)">
                                </div>
                                <div class="col-12 col-lg-6 mb-2">
                                    <label for="birthday" class="form-label">Tanggal Lahir</label>
                                    <input id="birthday" name="birthday" type="date" class="form-control">
                                </div>
                                <div class="col-12 col-lg-6 mb-2">
                                    <label for="districtId" class="form-label">Kecamatan<span
                                            class="text-danger">*</span> <span id="districtError"
                                            class="text-danger"></span></label>
                                    <select name="district_id" id="districtId" class="form-control">
                                        <option value="" selected hidden disabled>*PILIH KECAMATAN</option>
                                        @foreach ($districts as $district)
                                            <option value="{{ $district->id }}">{{ $district->name }}</option>
                                        @endforeach
                                    </select>
                                    <span id="districtIdError" class="invalid-feedback"></span>
                                </div>
                                <div class="col-12 col-lg-6 mb-2">
                                    <label for="villageId" class="form-label">Kelurahan / Desa<span
                                            class="text-danger">*</span> <span id="villageError"
                                            class="text-danger"></span></label>
                                    <select name="village_id" id="villageId" class="form-control">
                                        <option value="" selected hidden disabled>
                                            *PILIH KECAMATAN DAHULU
                                        </option>
                                    </select>
                                    <span id="villageIdError" class="invalid-feedback"></span>
                                </div>
                                <div class="col-12 col-lg-6 mb-2">
                                    <label title="Wajib Diisi" for="gender" class="form-label">Jenis
                                        Kelamin</label>
                                    <div class="form-group row">
                                        <div class="col-12">
                                            <div class="form-check">
                                                <input id="male" class="form-check-input" value="L"
                                                    type="radio" name="gender">
                                                <label for="male" class="form-check-label">Laki-Laki</label>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-check">
                                                <input id="female" class="form-check-input" value="P"
                                                    type="radio" name="gender">
                                                <label for="female" class="form-check-label">Perempuan</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-lg-6 mb-2">
                                    <label for="votingPlaceId" class="form-label">TPS
                                        <span id="votingPlaceError" class="text-danger"></span></label>
                                    <select name="voting_place_id" id="votingPlaceId" class="form-control">
                                        <option id="votingPlaceOption" value="" selected hidden disabled>
                                            *PILIH KELURAHAN/DESA DAHULU
                                        </option>
                                    </select>
                                </div>
                                <div class="col-12 col-lg-6 mb-2">
                                    <label title="Wajib Diisi" for="marital_status" class="form-label">Status
                                        Perkawinan</label>
                                    <div class="form-group row">
                                        <div class="col-12">
                                            <div class="form-check">
                                                <input id="bMaritalStatus" class="form-check-input" value="B"
                                                    type="radio" name="marital_status">
                                                <label for="bMaritalStatus" class="form-check-label">Belum
                                                    Kawin</label>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-check">
                                                <input id="sMaritalStatus" class="form-check-input" value="S"
                                                    type="radio" name="marital_status">
                                                <label for="sMaritalStatus" class="form-check-label">Sudah
                                                    Kawin</label>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-check">
                                                <input id="pMaritalStatus" class="form-check-input" value="P"
                                                    type="radio" name="marital_status">
                                                <label for="pMaritalStatus" class="form-check-label">Pernah
                                                    Kawin</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-lg-6 mb-2">
                                    <label for="note" class="form-label">Catatan
                                        <span id="noteError" class="text-danger"></span></label>
                                    <textarea name="note" id="note" rows="5" class="form-control"></textarea>
                                </div>
                            </div>
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
