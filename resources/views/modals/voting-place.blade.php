<div id="votingPlaceModal" class="modal fade" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false"
    aria-labelledby="myModalLabel1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title mt-0" id="modalTitle"></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="form" action="{{ url('voting-places/store') }}" method="POST">
                @csrf
                <input id="id" type="hidden" name="id">
                <div class="modal-body">
                    <div class="mb-2">
                        <label for="districtId" class="form-label">
                            Kecamatan<span class="text-danger">*</span>
                        </label>
                        <select id="districtId" name="district_id" class="form-control">
                            <option value="" disabled selected hidden>*PILIH KECAMATAN</option>
                            @foreach ($districts as $district)
                                <option value="{{ $district->id }}">
                                    {{ $district->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-2">
                        <label for="villageId" class="form-label">
                            Kelurahan/Desa<span class="text-danger">*</span>
                        </label>
                        <select id="villageId" name="village_id" class="form-control" style="width: 100%;" disabled>
                            <option value="" disabled selected hidden>*PILIH KECAMATAN DAHULU</option>
                        </select>
                    </div>
                    <div class="mb-2">
                        <label for="name" class="form-label">
                            TPS<span class="text-danger">*</span>
                        </label>
                        <input id="name" name="name" type="text" class="form-control" placeholder="TPS"
                            data-inputmask='"mask": "999"' data-mask>
                        <span id="nameError" class="invalid-feedback"></span>
                    </div>
                    <div class="mb-2">
                        <label for="address" class="form-label">
                            Alamat<span class="text-danger">*</span>
                        </label>
                        <input id="address" name="address" type="text" class="form-control"
                            placeholder="Alamat Tempat Pemungutan Suara">
                        <span id="addressError" class="invalid-feedback"></span>
                    </div>
                    <div class="mb-2">
                        <label for="latitude" class="form-label">
                            Koordinat Peta<span class="text-danger">*</span>
                        </label>
                        <div class="row">
                            <div class="col-12 col-sm-6">
                                <input id="latitude" name="latitude" type="text" class="form-control"
                                    placeholder="Latitude">
                                <span id="latitudeError" class="invalid-feedback"></span>
                            </div>
                            <div class="col-12 col-sm-6">
                                <input id="longitude" name="longitude" type="text" class="form-control"
                                    placeholder="Longitude">
                                <span id="longitudeError" class="invalid-feedback"></span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-secondary waves-effect" data-bs-dismiss="modal">Tutup</button>
                    <button id="button" type="submit"
                        class="btn btn-primary waves-effect waves-light">Simpan</button>
                </div>
            </form>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
