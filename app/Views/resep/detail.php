<div class="modal-header">
    Detail Resep
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
<div class="card-body">
    <div class="row">
        <div class="col-3">
            <div class="card card-outline card-success">
                <div class="card-header">
                    <h3 class="card-title">View Resep</h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-12">
                            <h3 class="proassets-username text-center mb-0" id="nama_pasien"><?=$dataRegis->nama?></h3>
                            <p class="text-muted text-center mb-0" id="no_reg"><?=$dataRegis->no_reg?></p>
                            <p class="text-muted text-center mb-0" id="rm_pasien"><?=$dataRegis->no_rm?></p>
                            <p class="text-muted text-center mb-0" id="umur_pasien"><?=$dataRegis->umur?></p>
                        </div>
                        <div class="col-12">
                            <?=$dataRegis->plant->resep?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-9">
            <div class="card card-outline card-success">
                <div class="card-header">
                    <h3 class="card-title">Input Resep</h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-5">
                            <div class="form-group">
                                <label class="mb-0">Cari Obat</label>
                                <select class="form-control form-control-sm" id="cari-obat">
                                </select>
                                <input type="hidden" id="nama-obat">
                                <input type="hidden" id="harga-obat">
                                <input type="hidden" id="stok-obat">
                                <input type="hidden" id="batch-obat">
                            </div>
                        </div>
						<div class="col-4">
                        <label class="mb-0">Stok</label>
						<h4 id="view-stok"></h4>
						</div>
                        <div class="col-2">
                            <div class="form-group">
                                <label class="mb-0">Jumlah</label>
                                <input type="text" id="jumlah" class="form-control form-control-sm" placeholder="Jumlah"
                                    autocomplete="off">
                            </div>
                        </div>
                        <div class="col-1 form-inline">
                            <div class="form-group">
                                <button type="button" id="masuk-resep" class="btn btn-outline-info btn-flat btn-xs"><i
                                        class="fa fa-plus"></i></button>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label class="mb-0">Frekuensi</label>
                                <input type="text" id="kali_sehari" value="-"
                                    class="form-control form-control-sm rounded-0" placeholder="Frequensi Pemakaian"
                                    autocomplete="off">
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="form-group">
                                <label class="mb-0">Waktu</label>
                                <select class="form-control form-control-sm rounded-0" id="waktu_minum">
                                    <option value="">pilih waktu</option>
                                    <option selected value="sesudah makan">sesudah makan</option>
                                    <option value="sebelum makan">sebelum makan</option>
                                    <option value="saat makan">saat makan</option>
                                    <option value="sebelum makan">sebelum makan</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <form class="form-horizontal" id="frm-resep"
                        action="<?php echo base_url();?>/farmasi/resep/save-resep" method="POST">
                        <div class="row">
                            <div class="col-12">
                                <table class="table table-sm table-hover table-bordered table-head-fixed text-nowrap">
                                    <thead>
                                        <tr>
                                            <th>Nama Obat</th>
                                            <th>Qty</th>
                                            <th>Harga</th>
                                            <th>Total</th>
                                            <th class="d-none">Aturan Pakai</th>
                                            <th class="text-center">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody id="body-resep">
                                        <?php if(isset($dataRegis->resep_obat )):?>
                                        <?php $i=1;foreach($dataRegis->resep_obat as $obat):?>
                                        <tr>
                                            <td>
                                                <input type="hidden" name="id_obat[<?=$i?>]"
                                                    value="<?=$obat->id_obat?>">
                                                <input type="hidden" name="nama_obat[<?=$i?>]"
                                                    value="<?=$obat->nama_obat?>">
                                                <input type="hidden" name="batch_obat[<?=$i?>]"
                                                    value="<?=$obat->batch_obat?>">
                                                <input type="hidden" name="harga_obat[<?=$i?>]"
                                                    value="<?=$obat->harga?>">
                                                <input type="hidden" name="jumlah_obat[<?=$i?>]"
                                                    value="<?=$obat->jumlah?>">
                                                <?=$obat->nama_obat?>
                                            </td>
                                            <td><?=$obat->jumlah?></td>
                                            <td style="text-align:right">
                                                <?="Rp " . number_format($obat->harga,2,',','.')?></td>
                                            <td style="text-align:right">
                                                <?="Rp " . number_format($obat->harga*$obat->jumlah,2,',','.')?></td>
                                            <td class="d-none">
                                                <input type="hidden" name="kali[<?=$i?>]"
                                                    value="<?=$obat->kali?>"><input type="hidden"
                                                    name="waktu_minum[<?=$i?>]"
                                                    value="<?=$obat->waktu_minum?>"><?=$obat->kali?> x sehari
                                                <?=$obat->waktu_minum?>
                                            </td>
                                            <td class='text-center'>
                                                <a type="button" onclick="delTr(this)"
                                                    class="text-danger"><i class='fa fa-trash'></i></a>
                                            </td>
                                        </tr>
                                        <?php $i++;endforeach;?>
                                        <?php endif;?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="row" id="btn-grup">
                            <?php if(isset($dataRegis->resep_obat)):?>
                            <?php if(!isset($dataRegis->lunas) || $dataRegis->lunas == ""):?>
                            <div class="col-6">
                                <button type="button" id="simpan-resep"
                                    class="btn btn-block btn-outline-success btn-xs">Update Resep</button>
                            </div>
                            <?php endif;?>
                            <div class="col-4">
								<a href="<?php echo base_url();?>/farmasi/resep/cetak-label?reg=<?=$dataRegis->no_reg?>" target="_blank" type="button" id="cetak-label" class="btn btn-block btn-outline-danger btn-xs">Label</a>
								</div>
                            <?php else:?>
                            <div class="col-6">
                                <button type="button" id="simpan-resep"
                                    class="btn btn-block btn-outline-primary btn-xs">Simpan Resep</button>
                            </div>
                            <?php endif;?>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>