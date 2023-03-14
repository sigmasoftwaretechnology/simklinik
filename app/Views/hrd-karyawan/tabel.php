<?php
helper('klinik_helper');
?>
<div class="card">
    <div class="card-body table-responsive p-3">
        <div class="row">
            <div class="col-5">
                <table class="table table-head-fixed table-hover text-nowrap table-sm text-nowrap table-bordered">
                    <thead>
                        <tr>
                            <th>NIK</th>
                            <th>Nama</th>
                            <th>Unit</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if(count($karyawan) > 0):?>
                        <?php foreach($karyawan as $data):?>
                        <tr>
                        <td class="align-middle"><?php echo $data->nik;?></td>
                        <td class="align-middle"><?php echo $data->gelar_depan." ".$data->nama." ".$data->gelar_belakang;?></td>
                        <td class="align-middle"><?php echo $data->unit;?></td>
						<td class="text-center">
							<button type="button" id="update-<?=$data->_id?>" data-href="<?=base_url()?>/hrd/karyawan/ubah?id=<?=$data->_id?>" data-toggle="modal" data-target="#modal-form-baru" class="btn btn-outline-info btn-flat btn-xs"><i class="fa fa-edit"></i> Edit</button>
							<button type="button" class="btn btn-outline-danger btn-flat btn-xs" data-toggle="modal"
								href="#modal-delete" data-id="<?php echo $data->_id;?>">
								<i class="fa fa-folder-open"></i>&nbsp Hapus
							</button>
						</td>
                        </tr>
                        <?php endforeach;?>
                        <?php endif;?>
                    </tbody>
                </table>

            </div>
        </div>
    </div>
    <!-- /.card-body -->
</div>
<!-- /.card -->