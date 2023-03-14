<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
<div class="card-body">
    <div class="row">
        <div class="col-12">
            <div class="row">
                <div class="col-12">
				<fieldset class="border p-2">
                        <legend style="width:inherit;font-size: 20px;" class="mb-0">Data Obat</legend>
						<div class="row">
                            <div class="col-md-5">
								<div class="form-group">
									<label class="mb-0">Cari Obat</label>
									<select class="form-control form-control-sm" id="cari-obat">
									</select>
									<input type="hidden" id="id-obat">
									<input type="hidden" id="nama-obat">
									<input type="hidden" id="harga-obat">
								</div>
							</div>
						</div>
					</fieldset>
                </div>
            </div>
			<div class="row">
				<div class="col-md-12">
                    <fieldset class="border p-2">
                        <legend style="width:inherit;font-size: 20px;" class="mb-0">Data Batch</legend>
                        <div class="row">
                            <div class="col-md-2">
                                <div class="form-group mb-1">
                                    <label class="mb-0">No Batch</label>
                                    <input type="text" class="form-control form-control-sm" id="nobatch" value="">
                                    <div id="error-nobatch" class="invalid-feedback"></div>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group mb-1">
                                    <label class="mb-0">Expired</label>
                                    <input type="text" class="form-control form-control-sm" id="expired" value="" maxlength="10">
                                    <div id="error-expired" class="invalid-feedback"></div>
                                </div>
                            </div>
                            <div class="col-md-1">
                                <div class="form-group mb-1">
                                    <label class="mb-0">Jumlah</label>
                                    <input type="text" class="form-control form-control-sm" id="jumlah" value="">
                                    <div id="error-jumlah" class="invalid-feedback"></div>
                                </div>
                            </div>
                            <div class="col-md-1">
                                <div class="form-group mb-1">
                                    <label class="mb-0">&nbsp;</label>
                                    <button id="addBatch" type="button" class="btn btn-outline-danger btn-block btn-xs"><i class="fa fa-plus"></i></button>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-10">
                            </div>
                        </div>
                    </fieldset>
                </div>
			</div>
            <form class="form-horizontal" id="frm-obat" action="<?php echo base_url();?>/farmasi/obat-masuk/tambah"
                method="POST">
                <div class="row">
                    <div class="col-12">
                                <table class="table table-sm table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Nama</th>
                                            <th>Harga</th>
                                            <th>Batch</th>
                                            <th>Expired</th>
                                            <th>Jumlah</th>
                                            <th>Total</th>
                                            <th style="width: 40px">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody id="body-batch">
									</tbody>
                                </table>

                    </div>
													<div class="col-12">
									<h6>Grand total = <span id="gtt">0</span></h6>
									<input type="hidden" id="total-bayar" name="total_bayar" value="0">
								</div>

                </div>
				<div class="row mt-0 mb-0">
								<label class="col-2">Jumlah Bayar</label>
								<div class="col-4"><input type="text" id="jumlah_bayar" name="jumlah_bayar" class="form-control form-control-sm" placeholder="Jumlah Bayar" autocomplete="off"></div>
							</div>
							<div class="row">
								<div class="col-12">
									<div style="color:'#dddddd';"><i>Kembali : Rp <span id="kembali-rupiah">0</span><input type="hidden" name="kembali" id="kembali"></i></div>
								</div>
							</div>
                <div class="row" id="btn-grup">
                    <div class="col-6">
                        <button type="button" id="simpan-resep" class="btn btn-block btn-outline-primary btn-xs">Simpan
                            Transaksi</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>