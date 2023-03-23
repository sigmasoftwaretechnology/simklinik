<div class="modal-header">
    <?php echo isset($data["_id"]) ? "Ubah Pengguna" : "Tambah Pengguna"?>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
<?php if(isset($data["_id"])):?>
<form method="POST" id="frm" action="<?php echo base_url();?>/setting/pengguna/ubah?id=<?=$data["_id"]?>"
    class="form-horizontal">
    <?php else:?>
    <form method="POST" id="frm" action="<?php echo base_url();?>/setting/pengguna/tambah" class="form-horizontal">
        <?php endif;?>
        <div class="card-body p-3">
            <div class="row mb-2">
                <div class="col-md-4">
                    <fieldset class="border p-2">
                        <legend style="width:inherit;font-size: 20px;" class="mb-0">Informasi Pengguna</legend>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group mb-1">
                                    <label class="mb-0">Karyawan</label>
                                    <select class="form-control form-control-sm col-5" id="karyawan" name="karyawan">
                                        <?php foreach($dataKaryawan as $dtKaryawan):?>
                                        <?php
									$selected="";
									if(isset($data["nama_karyawan"])){
										if($dtKaryawan->nama ==  $data["nama_karyawan"]){
											$selected = "selected";
										}
									}							
									?>
                                        <option <?=$selected?> value="<?=$dtKaryawan->nama?>">
                                            <?=$dtKaryawan->gelar_depan?> <?=$dtKaryawan->nama?>
                                            <?=$dtKaryawan->gelar_belakang?></option>
                                        <?php endforeach;?>
                                    </select>
                                    <div id="error-karyawan" class="invalid-feedback"></div>
                                </div>
                                <div class="form-group mb-1">
                                    <label class="mb-0">Username</label>
                                    <input type="text" autocomplete="off" class="form-control form-control-sm col-5"
                                        name="nama_pengguna"
                                        value="<?php echo isset($data["nama_pengguna"]) ? $data["nama_pengguna"] : ""?>">
                                    <div id="error-nama_pengguna" class="invalid-feedback"></div>
                                </div>
                                <div class="form-group mb-1">
                                    <label class="mb-0">Password</label>
                                    <input type="text" autocomplete="off" class="form-control form-control-sm col-7"
                                        name="password" value="">
                                    <div id="error-password" class="invalid-feedback"></div>
                                </div>
                            </div>
                        </div>
                </div>
                <div class="col-md-8">
                    <fieldset class="border p-2">
                        <legend style="width:inherit;font-size: 20px;" class="mb-0">Setting Menu</legend>
                        <div class="row">
                            <div class="col-6">
                                <ul>
                                    <li>
                                        <div class="custom-control custom-checkbox">
                                            <input class="custom-control-input" type="checkbox" id="rekamMedis"
                                                name="menu[]" value="rekam-medis" <?php echo in_array("rekam-medis", $hakAkses) ? "checked" : ""?>>
                                            <label for="rekamMedis" class="custom-control-label">Rekam Medis</label>
                                        </div>
                                    </li>
                                    <ul>
                                        <li>
                                            <div class="custom-control custom-checkbox">
                                                <input class="custom-control-input child" type="checkbox"
                                                    id="rekamMedisPendaftaran" data-parent="rekamMedis" <?php echo in_array("rekam-medis/pendaftaran", $hakAkses) ? "checked" : ""?> name="menu[]"
                                                    value="rekam-medis/pendaftaran">
                                                <label for="rekamMedisPendaftaran"
                                                    class="custom-control-label">Pendaftaran</label>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="custom-control custom-checkbox">
                                                <input class="custom-control-input child" type="checkbox"
                                                    id="rekamMedisPemeriksaan" data-parent="rekamMedis" name="menu[]" <?php echo in_array("rekam-medis/pasien-registrasi", $hakAkses) ? "checked" : ""?>
                                                    value="rekam-medis/pasien-registrasi">
                                                <label for="rekamMedisPemeriksaan"
                                                    class="custom-control-label">Pemeriksaan</label>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="custom-control custom-checkbox">
                                                <input class="custom-control-input child" type="checkbox"
                                                    id="rekamMedisPasien" data-parent="rekamMedis" name="menu[]" <?php echo in_array("rekam-medis/pasien", $hakAkses) ? "checked" : ""?>
                                                    value="rekam-medis/pasien">
                                                <label for="rekamMedisPasien"
                                                    class="custom-control-label">Pasien</label>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="custom-control custom-checkbox">
                                                <input class="custom-control-input child" type="checkbox"
                                                    id="kartuPasien" data-parent="rekamMedis" name="menu[]" <?php echo in_array("pasien/cetak-kartu", $hakAkses) ? "checked" : ""?>
                                                    value="pasien/cetak-kartu">
                                                <label for="kartuPasien"
                                                    class="custom-control-label">Cetak Kartu Pasien</label>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="custom-control custom-checkbox">
                                                <input class="custom-control-input child" type="checkbox"
                                                    id="rekamMedisTindakan" data-parent="rekamMedis" name="menu[]" <?php echo in_array("rekam-medis/tindakan", $hakAkses) ? "checked" : ""?>
                                                    value="rekam-medis/tindakan">
                                                <label for="rekamMedisTindakan"
                                                    class="custom-control-label">Tindakan</label>
                                            </div>
                                        </li>
                                    </ul>
                                    <li>
                                        <div class="custom-control custom-checkbox">
                                            <input class="custom-control-input" type="checkbox" id="farmasi" <?php echo in_array("farmasi", $hakAkses) ? "checked" : ""?>
                                                name="menu[]" value="farmasi">
                                            <label for="farmasi" class="custom-control-label">Farmasi</label>
                                        </div>
                                    </li>
                                    <ul>
                                        <li>
                                            <div class="custom-control custom-checkbox">
                                                <input class="custom-control-input child" type="checkbox"
                                                    id="farmasiPenerimaan" name="menu[]" data-parent="farmasi" id="farmasi" <?php echo in_array("farmasi/obat-masuk", $hakAkses) ? "checked" : ""?> value="farmasi/obat-masuk">
                                                <label for="farmasiPenerimaan" class="custom-control-label">Penerimaan
                                                    Obat</label>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="custom-control custom-checkbox">
                                                <input class="custom-control-input child" type="checkbox"
                                                    id="farmasiMasterObat" name="menu[]" data-parent="farmasi" <?php echo in_array("farmasi/obat", $hakAkses) ? "checked" : ""?> 
													value="farmasi/obat">
                                                <label for="farmasiMasterObat" class="custom-control-label">Master
                                                    Obat</label>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="custom-control custom-checkbox">
                                                <input class="custom-control-input child" type="checkbox"
                                                    id="farmasiInputResep" name="menu[]" data-parent="farmasi" <?php echo in_array("farmasi/resep", $hakAkses) ? "checked" : ""?> 
													 value="farmasi/resep">
                                                <label for="farmasiInputResep" class="custom-control-label">Input Resep</label>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="custom-control custom-checkbox">
                                                <input class="custom-control-input child" data-parent="farmasi" type="checkbox"
                                                    id="farmasiInputResepBebas" name="menu[]" <?php echo in_array("farmasi/resep-bebas", $hakAkses) ? "checked" : ""?>
                                                    value="farmasi/resep-bebas">
                                                <label for="farmasiInputResepBebas" class="custom-control-label">Input Resep Bebas</label>
                                            </div>
                                        </li>
                                    </ul>
                                    <li>
                                        <div class="custom-control custom-checkbox">
                                            <input class="custom-control-input" type="checkbox" id="keuangan"
                                                name="menu[]" <?php echo in_array("keuangan", $hakAkses) ? "checked" : ""?> value="keuangan">
                                            <label for="keuangan" class="custom-control-label">Keuangan</label>
                                        </div>
                                    </li>
                                    <ul>
                                        <li>
                                            <div class="custom-control custom-checkbox">
                                                <input class="custom-control-input child" data-parent="keuangan"  type="checkbox" id="keuanganKasir"
                                                    name="menu[]" <?php echo in_array("keuangan/kasir", $hakAkses) ? "checked" : ""?> value="keuangan/kasir">
                                                <label for="keuanganKasir" class="custom-control-label">Kasir</label>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="custom-control custom-checkbox">
                                                <input class="custom-control-input child" data-parent="keuangan" type="checkbox" id="keuanganLaporan"
                                                    name="menu[]" <?php echo in_array("keuangan/laporan-keuangan", $hakAkses) ? "checked" : ""?> value="keuangan/laporan">
                                                <label for="keuanganLaporan" class="custom-control-label">Laporan
                                                    Keuangan</label>
                                            </div>
                                        </li>
                                    </ul>

                                </ul>
                            </div>
                            <div class="col-6">
                                <ul>
                                    <li>
                                        <div class="custom-control custom-checkbox">
                                            <input class="custom-control-input" type="checkbox" id="setting"
                                                name="menu[]"  <?php echo in_array("setting", $hakAkses) ? "checked" : ""?>  value="setting">
                                            <label for="setting" class="custom-control-label">Setting</label>
                                        </div>
                                    </li>
                                    <ul>
                                        <li>
                                            <div class="custom-control custom-checkbox">
                                                <input class="custom-control-input child" data-parent="setting" type="checkbox" id="settingBukaErm"
                                                    name="menu[]" <?php echo in_array("setting/buka-erm", $hakAkses) ? "checked" : ""?> value="setting/buka-erm">
                                                <label for="settingBukaErm" class="custom-control-label">Buka
                                                    ERM</label>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="custom-control custom-checkbox">
                                                <input class="custom-control-input child" data-parent="setting" type="checkbox"
                                                    id="settingInformasi" name="menu[]" <?php echo in_array("setting/informasi", $hakAkses) ? "checked" : ""?> value="setting/informasi">
                                                <label for="settingInformasi"
                                                    class="custom-control-label">Informasi</label>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="custom-control custom-checkbox">
                                                <input class="custom-control-input child" data-parent="setting" type="checkbox" id="settingPoli"
                                                    name="menu[]" <?php echo in_array("setting/poli", $hakAkses) ? "checked" : ""?> value="setting/poli">
                                                <label for="settingPoli" class="custom-control-label">Poli</label>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="custom-control custom-checkbox">
                                                <input class="custom-control-input child" data-parent="setting" type="checkbox" id="settingUnit"
                                                    name="menu[]" <?php echo in_array("setting/unit", $hakAkses) ? "checked" : ""?> value="setting/">
                                                <label for="settingUnit" class="custom-control-label">Unit Kerja</label>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="custom-control custom-checkbox">
                                                <input class="custom-control-input child" data-parent="setting" type="checkbox" id="settingPengguna"
                                                    name="menu[]" <?php echo in_array("setting/pengguna", $hakAkses) ? "checked" : ""?> value="setting/pengguna">
                                                <label for="settingPengguna"
                                                    class="custom-control-label">Pengguna</label>
                                            </div>
                                        </li>
                                    </ul>
                                    <li>
                                        <div class="custom-control custom-checkbox">
                                            <input class="custom-control-input" type="checkbox" id="hrd" name="menu[]" <?php echo in_array("hrd", $hakAkses) ? "checked" : ""?>
                                                value="hrd">
                                            <label for="hrd" class="custom-control-label">HRD</label>
                                        </div>
                                    </li>
                                    <ul>
                                        <li>
                                            <div class="custom-control custom-checkbox">
                                                <input class="custom-control-input child" data-parent="hrd" type="checkbox" id="hrdKaryawan"
                                                    name="menu[]" <?php echo in_array("hrd/karyawan", $hakAkses) ? "checked" : ""?> value="hrd/karyawan">
                                                <label for="hrdKaryawan" class="custom-control-label">Karyawan</label>
                                            </div>
                                        </li>
                                    </ul>
                                </ul>
                            </div>
                        </div>

                </div>
            </div>
            <div class="row">
                <div class="col-3">
                </div>
                <div class="col-5">
                    <button type="submit" class="btn btn-block btn-danger btn-xs"><img src="<?php echo base_url(); ?>/assets/img/icon/save.png"> Simpan</button>
                </div>
            </div>
        </div>
        <!-- /.card-body -->
    </form>