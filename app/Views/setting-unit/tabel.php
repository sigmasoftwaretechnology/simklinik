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
                            <th>Nama</th>
                            <th>Parent Unit</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if(count($unit) > 0):?>
                        <?php foreach($unit as $data):?>
                        <tr>
                        <td class="align-middle"><?php echo $data->nama;?></td>
                        <td class="align-middle"><?php echo $data->parent;?></td>
                            <td class="text-center">
                                <a data-toggle="modal"
                                    href="#modal-delete" data-id="<?php echo $data->_id;?>">
                                    <img src="<?php echo base_url(); ?>/assets/img/icon/delete.png">
                                </a>
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