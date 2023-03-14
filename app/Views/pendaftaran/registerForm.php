<div class="modal-header">
    Tambah Registrasi
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>

<form method="POST" id="frm" action="<?php echo base_url();?>/rekam-medis/pendaftaran/tambah" class="form-horizontal">
    <div class="card-body">
        <div class="form-group mb-2">
            <label class="mb-0">No Registrasi</label>
            <input type="text" class="form-control form-control-sm col-5" name="no_reg" readonly
                value="<?='RE-'.time()?>">
        </div>
        <div class="form-group mb-2">
            <label class="mb-0">Tanggal Daftar</label>
            <input type="text" class="form-control form-control-sm col-3 filterTanggal" name="tanggal" value="<?=date("d-m-Y")?>">
        </div>
        <div class="form-group mb-2">
            <label for="exampleInputNama" class="mb-0">Nama</label>
            <select class="form-control form-control-sm" id="nama-pasien" name="no_rm">
            </select>
            <div id="error-no_rm" class="invalid-feedback"></div>
        </div>
        <div class="form-group mb-2">
            <label for="exampleInputPoli" class="mb-0">Poli</label>
            <input type="hidden" id="dpjp" name="dpjp" value="">
            <select class="form-control form-control-sm" id="poli" name="poli">
                <option value="">- Pilih Poli -</option>
                <?php foreach($poli as $dtPoli):?>
                <option value="<?=$dtPoli->nama?>" data-dokter="<?=$dtPoli->dokter?>" data-kode="<?=$dtPoli->kode?>">
                    <?=$dtPoli->nama?> - <?=$dtPoli->dokter?></option>
                <?php endforeach;?>
            </select>
            <div id="error-poli" class="invalid-feedback"></div>
        </div>
        <div class="form-group mb-2">
            <label class="mb-0" for="exampleInputNama">Tipe Daftar</label>
            <select class="form-control form-control-sm col-12" id="tipe_daftar" name="tipe_daftar">
                <option value="Umum">Umum</option>
                <option value="BPJS">BPJS</option>
            </select>
        </div>
        <button type="submit" class="btn btn-block btn-outline-primary btn-xs">Simpan</button>

    </div>
</form>