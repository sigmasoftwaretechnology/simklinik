<div class="modal-header">
    <?php echo isset($data["_id"]) ? "Ubah Obat" : "Tambah Obat"?>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
<?php if(isset($data["_id"])):?>
<form method="POST" id="frmTindakan" action="<?php echo base_url();?>/farmasi/obat/ubah?id=<?=$data["_id"]?>"
    class="form-horizontal">
    <?php else:?>
    <form method="POST" id="frmTindakan" action="<?php echo base_url();?>/farmasi/obat/tambah" class="form-horizontal">
        <?php endif;?>
        <div class="card-body p-3">
            <div class="row mb-2">
                <div class="col-md-6">
                    <fieldset class="border p-2">
                        <legend style="width:inherit;font-size: 20px;" class="mb-0">Data Obat</legend>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group mb-1">
                                    <label class="mb-0">Kode/Barcode</label>
                                    <input type="text" class="form-control form-control-sm col-5" name="kode"
                                        value="<?php echo isset($data["kode"]) ? $data["kode"] : ""?>" autofocus>
                                    <div id="error-kode" class="invalid-feedback"></div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group mb-1" id="baru">
                                    <label class="mb-0">Nama Obat</label>
                                    <input type="text" class="form-control form-control-sm col-7" name="nama"
                                        value="<?php echo isset($data["nama"]) ? $data["nama"] : ""?>">
                                    <div id="error-nama" class="invalid-feedback"></div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group mb-1">
                                    <label class="mb-0">Supplier</label>
                                    <select class="form-control form-control-sm col-8" id="supplier" name="supplier">
                                        <?php foreach($dataSupplier as $dtSupplier):?>
                                        <?php
									$selected="";
									if(isset($data["supplier"])){
										if($dtSupplier->nama ==  $data["supplier"]){
											$selected = "selected";
										}
									}							
									?>
                                        <option <?=$selected?> value="<?=$dtSupplier->nama?>"><?=$dtSupplier->nama?>
                                        </option>
                                        <?php endforeach;?>
                                    </select>
                                    <div id="error-supplier" class="invalid-feedback"></div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group mb-1">
                                    <label class="mb-0">Satuan Terkecil</label>
                                    <input type="text" class="form-control form-control-sm" name="satuan"
                                        value="<?php echo isset($data["satuan"]) ? $data["satuan"] : ""?>">
                                    <div id="error-satuan" class="invalid-feedback"></div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group mb-1">
                                    <label class="mb-0">Harga</label>
                                    <input type="text" class="form-control form-control-sm " name="harga"
                                        value="<?php echo isset($data["harga"]) ? $data["harga"] : ""?>">
                                    <div id="error-harga" class="invalid-feedback"></div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group mb-1">
                                    <label class="mb-0">Harga Pokok</label>
                                    <input type="text" class="form-control form-control-sm" name="harga_pokok"
                                        value="<?php echo isset($data["harga_pokok"]) ? $data["harga_pokok"] : ""?>">
                                    <div id="error-harga_pokok" class="invalid-feedback"></div>
                                </div>
                            </div>
                        </div>
                    </fieldset>
                </div>
                <div class="col-md-6">
                    <fieldset class="border p-2">
                        <legend style="width:inherit;font-size: 20px;" class="mb-0">Data Batch</legend>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group mb-1">
                                    <label class="mb-0">No Batch</label>
                                    <input type="text" class="form-control form-control-sm" id="nobatch" value="">
                                    <div id="error-nobatch" class="invalid-feedback"></div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group mb-1">
                                    <label class="mb-0">Expired</label>
                                    <input type="text" class="form-control form-control-sm" id="expired" value="">
                                    <div id="error-expired" class="invalid-feedback"></div>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group mb-1">
                                    <label class="mb-0">Stok</label>
                                    <input type="text" class="form-control form-control-sm" id="stok" value="">
                                    <div id="error-stok" class="invalid-feedback"></div>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group mb-1">
                                    <label class="mb-0">&nbsp;</label>
                                    <button id="addBatch" type="button"
                                        class="btn btn-outline-danger btn-block btn-xs"><i
                                            class="fa fa-plus"></i></button>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-10">
                                <table class="table table-sm table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Batch</th>
                                            <th>Expired</th>
                                            <th>Stok</th>
                                            <th style="width: 40px">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody id="body-batch">
									<?php if(isset($data["batch"])):?>
										<?php $i=1;foreach($data["batch"] as $dtBatch):?>
											<tr>
											<td><input type='hidden' name='batch[<?php echo $i?>]' value='<?php echo $dtBatch["batch"]?>'/><?php echo $dtBatch["batch"]?></td>
											<td><input type='hidden' name='expired[<?php echo $i?>]' value='<?php echo $dtBatch["expired"]?>'/><?php echo $dtBatch["expired"]?></td>
											<td><input type='hidden' name='stok[<?php echo $i?>]' value='<?php echo $dtBatch["stok"]?>'/><?php echo $dtBatch["stok"]?></td>
											<td class='text-center'><a class='text-danger' onclick='delTr(this)'><i class='fa fa-trash'></i></a></td>
											</tr>
										<?php $i++;endforeach;?>
									<?php endif;?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </fieldset>
                </div>
            </div>
            <div class="row">
                <div class="col-3">
                </div>
                <div class="col-5">
                    <button type="submit" class="btn btn-block btn-outline-primary btn-xs">Simpan</button>
                </div>
            </div>
        </div>
    </form>