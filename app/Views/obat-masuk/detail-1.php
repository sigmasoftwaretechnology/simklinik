<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
	<div class="card-body">
		<div class="row">
			<div class="col-12">
				<div class="card card-outline card-success">
					<div class="card-header">
						<h3 class="card-title">Input Obat</h3>
					</div>
					<div class="card-body">
						<div class="row">
							<div class="col-9">
							  <div class="form-group">
								<label class="mb-0">Cari Obat</label>
									<select class="form-control form-control-sm" id="cari-obat">
									</select>
								<input type="hidden" id="nama-obat">
								<input type="hidden" id="harga-obat">
								<input type="hidden" id="stok-obat">
							  </div>
							</div>
							<div class="col-2">
							  <div class="form-group">
								<label class="mb-0">Jumlah</label>
								<input type="text" id="jumlah" class="form-control form-control-sm" placeholder="Jumlah" autocomplete="off">
							  </div>
							</div>
							<div class="col-1 form-inline">
								<div class="form-group">
									<button type="button" id="masuk-resep" class="btn btn-outline-info btn-flat btn-xs"><i class="fa fa-plus"></i></button>	
								</div>
							</div>
						</div>
						<div class="row d-none">
							<div class="col-6">
							  <div class="form-group">
								<label class="mb-0">Frekuensi</label>
								<input type="text" id="kali_sehari" value="-" class="form-control form-control-sm rounded-0" placeholder="Frequensi Pemakaian" autocomplete="off">
							  </div>
							</div>
							<div class="col-3">
								<div class="form-group">
									<label class="mb-0">Waktu</label>
									<select class="custom-select  form-control-sm rounded-0" id="waktu_minum">
									  <option value="">pilih waktu</option>
									  <option selected value="sesudah makan">sesudah makan</option>
									  <option value="sebelum makan">sebelum makan</option>
									  <option value="saat makan">saat makan</option>
									  <option value="sebelum makan">sebelum makan</option>
									</select>
								</div>
							</div>
						</div>
						<form class="form-horizontal" id="frm-resep" action="<?php echo base_url();?>/farmasi/resep/update-resep-bebas" method="POST"> 
							<div class="row">
								<div class="col-12">
									<input type="hidden" name="no_trx" value="<?=$dataRegis->no_transaksi?>">
									<table class="table table-sm table-hover table-bordered table-head-fixed text-nowrap mb-0">
									  <thead>
										<tr>
										  <th>Nama Obat</th>
										  <th>Qty</th>
										  <th>Harga</th>
										  <th>Total</th>
										  <th class="d-none">Aturan Pakai</th>
										  <th class="text-center" width="10%">Aksi</th>
										</tr>
									  </thead>
									  <tbody id="body-resep">
										<?php if(isset($dataRegis->resep_obat )):?>
										<?php $i=1;foreach($dataRegis->resep_obat as $obat):?>
									  	<tr>
										<td>
											<input type="hidden" name="id_obat[<?=$i?>]" value="<?=$obat->id_obat?>">
											<input type="hidden" name="nama_obat[<?=$i?>]" value="<?=$obat->nama_obat?>">
											<input type="hidden" name="harga_obat[<?=$i?>]" value="<?=$obat->harga?>">
											<input type="hidden" name="jumlah_obat[<?=$i?>]" value="<?=$obat->jumlah?>">
											<?=$obat->nama_obat?>
										</td>
										<td><?=$obat->jumlah?></td>
										<td style="text-align:right"><?="Rp " . number_format($obat->harga,0,',','.')?></td>
										<td style="text-align:right"><?="Rp " . number_format($obat->harga*$obat->jumlah,0,',','.')?></td>
										<td class="d-none">
											<input type="hidden" name="kali[<?=$i?>]" value="<?=$obat->kali?>"><input type="hidden" name="waktu_minum[<?=$i?>]" value="<?=$obat->waktu_minum?>"><?=$obat->kali?> x sehari <?=$obat->waktu_minum?>
										</td>
										<td>
										<button type="button" onclick="delTr(this)" class="btn  btn-outline-danger btn-xs">Hapus</button>
										</td>
										</tr>
										<?php $i++;endforeach;?>
									  <?php endif;?>
									  </tbody>
									</table>
								</div>
								<div class="col-12">
									<h6>Grand total = <span id="gtt"><?="Rp " . number_format($dataRegis->total_bayar,0,',','.')?></span></h6>
									<input type="hidden" id="total-bayar" name="total_bayar" value="<?=$dataRegis->total_bayar?>">
								</div>
							</div>
							<div class="row form-group mt-0">
								<label class="col-2">Jumlah Bayar</label>
								<div class="col-4"><input type="text" id="jumlah_bayar" name="jumlah_bayar" value="<?=$dataRegis->jumlah_bayar?>" class="form-control form-control-sm" placeholder="Jumlah Bayar" autocomplete="off"></div>
							</div>
							<div class="row">
								<div class="col-12">
									<div style="color:'#dddddd';"><i>Kembali : Rp <span id="kembali-rupiah"><?="Rp " . number_format(($dataRegis->jumlah_bayar-$dataRegis->total_bayar),0,',','.')?></span><input type="hidden" id="kembali"></i></div>
								</div>
							</div>
							<div class="row" id="btn-grup">
								<div class="col-6">
								<button type="button" id="simpan-resep" class="btn btn-block btn-outline-success btn-xs">Update Resep</button>
								</div>
							</div>
						</form>		
					</div>
				</div>
			</div>

		</div>
	</div>
