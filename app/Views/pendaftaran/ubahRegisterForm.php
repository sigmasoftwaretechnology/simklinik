<div class="modal-header">
    Tambah Registrasi
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>

<form method="POST" id="frm" action="<?php echo base_url();?>/rekam-medis/pendaftaran/ubah" class="form-horizontal">
    <div class="card-body">
        <div class="form-group mb-2">
            <label class="mb-0">Tanggal Daftar</label>
            <input type="text" class="form-control form-control-sm col-3 filterTanggal" name="tanggal" value="<?php echo isset($data->tanggal) ? date("d-m-Y",strtotime($data->tanggal)) : ""?>">
        </div>
        <div class="form-group mb-2">
            <label for="exampleInputNama" class="mb-0">Nama</label>
            <input type="hidden" name="id" value="<?php echo isset($data->id) ? $data->id : ""?>">
            <input type="hidden" name="no_reg" value="<?php echo isset($data->no_reg) ? $data->no_reg : ""?>">
            <input type="hidden" name="no_rm" value="<?php echo isset($data->no_rm) ? $data->no_rm : ""?>">
            <input type="text" readonly class="form-control form-control-sm col-8" name="nama_pasien" value="<?php echo isset($data->nama) ? $data->nama : ""?>">
        </div>
        <div class="form-group mb-2">
            <label for="exampleInputPoli" class="mb-0">Poli</label>
            <input type="hidden" id="dpjp" name="dpjp" value="<?php echo isset($data->dpjp) ? $data->dpjp : ""?>">
            <select class="form-control form-control-sm" id="poli" name="poli">
                <option value="">- Pilih Poli -</option>
                <?php foreach($poli as $dtPoli):?>
                    <?php
                    $selected="";
                    if($data->poli == $dtPoli->nama){
                        $selected = "selected";
                    }
                    ?>
                <option <?=$selected ?> value="<?=$dtPoli->nama?>" data-dokter="<?=$dtPoli->dokter?>" data-kode="<?=$dtPoli->kode?>">
                    <?=$dtPoli->nama?> - <?=$dtPoli->dokter?></option>
                <?php endforeach;?>
            </select>
            <div id="error-poli" class="invalid-feedback"></div>
        </div>
        <div class="form-group mb-2">
            <label class="mb-0" for="exampleInputNama">Tipe Daftar</label>
            <select class="form-control form-control-sm col-12" id="tipe_daftar" name="tipe_daftar">
                <option <?php echo $data->tipe =="Umum" ? "selected" : ""?> value="Umum">Umum</option>
                <option <?php echo $data->tipe =="BPJS" ? "selected" : ""?>  value="BPJS">BPJS</option>
            </select>
        </div>
        <button type="submit" class="btn btn-block btn-outline-primary btn-xs">Simpan</button>

    </div>
</form>