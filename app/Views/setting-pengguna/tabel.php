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
                            <th>Nama Karyawan</th>
                            <th>Nama Pengguna</th>
                            <th>Password</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if(count($pengguna) > 0):?>
                        <?php foreach($pengguna as $data):?>
                        <tr>
                        <td class="align-middle"><?php echo $data->nama_karyawan;?></td>
                        <td class="align-middle"><?php echo $data->nama_pengguna;?></td>
                        <td class="align-middle">
                            <?php 
                                echo $data->password;
                            ?>
                        </td>
						<td class="text-center">
                        <a id="update-<?=$data->_id?>" data-href="<?=base_url()?>/setting/pengguna/ubah?id=<?=$data->_id?>" data-toggle="modal" href="#modal-form-baru"><i class="fa fa-edit"></i></a>
                        <a data-toggle="modal" href="#modal-delete" data-id="<?php echo $data->_id;?>"><i class="fa fa-trash"></i></a>
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