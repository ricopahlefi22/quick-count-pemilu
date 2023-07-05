<div class="modal fade" id="otpModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">One Time Password</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="otpForm" method="POST">
                <input id="token" type="hidden" name="token">
                <div class="modal-body">
                    <div class="mb-3">
                        <input type="number" name="otp" class="form-control" id="otp"
                            placeholder="Masukkan Kode OTP">
                        <span id="otpError" class="invalid-feedback"></span>
                    </div>
                </div>
                <div class="modal-footer">
                    <button id="otpButton" type="submit" class="btn btn-primary" disabled>Lanjutkan</button>
                </div>
            </form>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
