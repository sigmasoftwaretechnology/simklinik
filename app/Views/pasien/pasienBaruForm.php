<div class="modal-header">
    <?php echo isset($data["id"]) ? "Ubah Pasien" : "Tambah Pasien"	?>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
<?php if(isset($data["id"])):?>
<form method="POST" id="frmPasien" action="<?php echo base_url();?>/rekam-medis/pasien/ubah?id=<?=$data["id"]?>"
    class="form-horizontal">
    <?php else:?>
    <form method="POST" id="frmPasien" action="<?php echo base_url();?>/rekam-medis/pasien/tambah"
        class="form-horizontal">
        <?php endif;?>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <fieldset class="border p-2">
                        <legend style="width:inherit;font-size: 20px;" class="mb-0">Informasi Pasien</legend>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group mb-1">
                                    <label class="mb-0">No RM</label>
                                    <input type="text" class="form-control form-control-sm col-4" name="no_rm"
                                        value="">
                                </div>
                                <div class="form-group mb-1">
                                    <label class="mb-0" for="exampleInputNama">Nama</label>
                                    <input type="text" class="form-control form-control-sm col-12" name="nama"
                                        value="<?php echo isset($data["nama"]) ? $data["nama"] : ""?>">
                                    <div id="error-nama" class="invalid-feedback"></div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group mb-1">
                                            <label class="mb-0" for="exampleInputNama">No BPJS</label>
                                            <input type="text" class="form-control form-control-sm col-12"
                                                name="no_bpjs"
                                                value="<?php echo isset($data["no_bpjs"]) ? $data["no_bpjs"] : ""?>">
                                            <div id="error-no_bpjs" class="invalid-feedback"></div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group mb-1">
                                            <label class="mb-0" for="exampleInputNama">No KTP</label>
                                            <input type="text" class="form-control form-control-sm col-12" name="no_ktp"
                                                value="<?php echo isset($data["no_ktp"]) ? $data["no_ktp"] : ""?>">
                                            <div id="error-no_ktp" class="invalid-feedback"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group mb-1">
                                            <label class="mb-0" for="exampleInputNama">Telp</label>
                                            <input type="text" class="form-control form-control-sm col-12" name="telp"
                                                value="<?php echo isset($data["telp"]) ? $data["telp"] : ""?>">
                                            <div id="error-telp" class="invalid-feedback"></div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group mb-1">
                                            <label class="mb-0" for="exampleInputNama">Tanggal Lahir</label>
                                            <input type="text" class="form-control form-control-sm col-12"
                                                name="tgl_lahir"
                                                value="<?php echo isset($data["tgl_lahir"]) ? date("d/m/Y",strtotime($data["tgl_lahir"])) : ""?>">
                                            <div id="error-tgl_lahir" class="invalid-feedback"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group mb-1">
                                    <label class="mb-0" for="exampleInputNama">Alamat</label>
                                    <textarea class="form-control form-control-sm col-12"
                                        name="alamat"><?php echo isset($data["alamat"]) ? $data["alamat"] : ""?></textarea>
                                    <div id="error-alamat" class="invalid-feedback"></div>
                                </div>
                                <div class="form-group">
                                    <label class="mb-0" for="exampleInputNama">Jenis Kelamin</label>
                                    <select class="form-control form-control-sm col-4" name="jk">
                                        <option name="Laki Laki">Laki Laki</laki>
                                        <option name="Perempuan">Perempuan</laki>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </fieldset>
                </div>
                <div class="col-md-6">
                    <div class="row">
                        <div class="col-md-12">
                            <fieldset class="border p-2">
                                <legend style="width:inherit;font-size: 20px;" class="mb-0">Aspek Sosial</legend>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="mb-0" for="exampleInputNama">Agama</label>
                                            <select class="form-control form-control-sm col-12" id="agama" name="agama">
                                                <option value="">- Pilih Agama -</option>
                                                <option value="Islam">Islam</option>
                                                <option value="Katolik">Katolik</option>
                                                <option value="Protestan">Protestan</option>
                                                <option value="Hindu">Hindu</option>
                                                <option value="Budha">Budha</option>
                                                <option value="Konghuchu">Konghuchu</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="mb-0">Pekerjaan</label>
                                            <input type="text" class="form-control form-control-sm col-12"
                                                name="pekerjaan"
                                                value="<?php echo isset($data["pekerjaan"]) ? $data["pekerjaan"] : ""?>">
                                            <div id="error-pekerjaan" class="invalid-feedback"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="mb-0" for="exampleInputNama">Pendidikan</label>
                                            <select class="form-control form-control-sm col-12" id="pendidikan"
                                                name="pendidikan">
                                                <option value="">- Pilih Pendidikan -</option>
                                                <option value="SD">SD</option>
                                                <option value="SMP">SMP</option>
                                                <option value="SMA">SMA</option>
                                                <option value="Diploma">Diploma</option>
                                                <option value="Sarjana">Sarjana</option>
                                                <option value="Tidak Sekolah">Tidak Sekolah</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="mb-0">Status</label>
                                            <select class="form-control form-control-sm col-12" id="status_perkawinan"
                                                name="status_perkawinan">
                                                <option value="">- Pilih Status -</option>
                                                <option value="Belum Kawin">Belum Kawin</option>
                                                <option value="Kawin">Kawin</option>
                                                <option value="Cerai">Cerai</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </fieldset>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <fieldset class="border p-2">
                                <legend style="width:inherit;font-size: 20px;" class="mb-0">Pendaftaran</legend>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="mb-0" for="exampleInputNama">Tanggal Daftar</label>
											<input type="text" class="form-control form-control-sm col-4 filterTanggal" name="tanggal" value="<?=date("d-m-Y")?>">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="mb-0" for="exampleInputNama">Poli Tujuan</label>
                                            <input type="hidden" id="dpjp" name="dpjp" value="">
                                            <select class="form-control form-control-sm" id="poli" name="poli">
                                                <option value="">- Pilih Poli -</option>
                                                <?php foreach($poli as $dtPoli):?>
                                                <option value="<?=$dtPoli->nama?>" data-dokter="<?=$dtPoli->dokter?>"
                                                    data-kode="<?=$dtPoli->kode?>"><?=$dtPoli->nama?> -
                                                    <?=$dtPoli->dokter?>
                                                </option>
                                                <?php endforeach;?>
                                            </select>
											<div id="error-poli" class="invalid-feedback"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="mb-0" for="exampleInputNama">Tipe Daftar</label>
                                            <select class="form-control form-control-sm col-12" id="tipe_daftar"
                                                name="tipe_daftar">
                                                <option value="Umum">Umum</option>
                                                <option value="BPJS">BPJS</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </fieldset>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mt-2">
                <div class="col-md-6">
                    <button type="submit" class="btn btn-block btn-outline-primary btn-xs">Simpan</button>
                </div>
            </div>
        </div>
    </form>