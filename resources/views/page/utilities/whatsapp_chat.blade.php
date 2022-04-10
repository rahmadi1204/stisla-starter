<div>
    <div class="alert alert-success alert-dismissible show fade d-none" id="alert-success">
        <div class="alert-body">
            <button class="close" data-dismiss="alert">
                <span>&times;</span>
            </button>
            <p><i class="fa fa-check"></i> Pesan Terkirim</p>
        </div>
    </div>

    <div class="alert alert-danger alert-dismissible show fade d-none" id="alert-danger">
        <div class="alert-body">
            <button class="close" data-dismiss="alert">
                <span>&times;</span>
            </button>
            <p><i class="fa fa-window-close"></i> Pesan Gagal Terkirim</p>
        </div>
    </div>

    <form method="post" class="needs-validation" novalidate="">
        @csrf
        <div class="card">
            <div class="card-header">
                <h4>Kirim Pesan</h4>
            </div>
            <div class="card-body pb-0">
                <div class="form-group">
                    <label>Nomor Tujuan</label>
                    <input type="text" name="receiver" class="form-control phone-number" id="receiver"
                        value="081217739049" required>
                    <div class="invalid-feedback">
                        Masukan Nomor Tujuan
                    </div>
                </div>
                <div class="form-group">
                    <label>Pesan</label>
                    <textarea class="form-control" name="message" id="message"></textarea>
                </div>
            </div>
            <div class="card-footer pt-0">
                <button class="btn btn-primary" id="btn-send">Kirim</button>
            </div>
        </div>
    </form>
</div>
