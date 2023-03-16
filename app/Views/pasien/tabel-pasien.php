<div class="card">
	  <div class="card-body table-responsive p-2" style="height: 900px;">
		<table class="table table-head-fixed table-hover text-nowrap table-sm text-nowrap table-bordered">
		  <thead>
			<tr>
			  <th style="width:3%">No</th>
				<th align="center" style="width:5%"></th>
			  <th>No RM</th>
			  <th>No BPJS</th>
			  <th>Nama</th>
			  <th>Alamat</th>
			  <th>Telp</th>
			</tr>
		  </thead>
		  <tbody>
			<?php $no=1;foreach($row as $data):?>
			<tr>
			<td class="align-middle"><?=$no?></td>
			<td class="text-center">
				<a id="update-<?=$data->id?>" data-href="<?=base_url()?>/pasien/ubah?id=<?=$data->id?>" data-toggle="modal" data-target="#modal-form-pasien"><img src="<?php echo base_url(); ?>/assets/img/icon/edit.png"></a>
				<a data-toggle="modal"
				href="#modal-delete"
				data-id="<?=$data->id?>"><img src="<?php echo base_url(); ?>/assets/img/icon/delete.png"></a>	
				<a href="<?=base_url()?>/pasien/cetak-kartu?id=<?=$data->id?>" target="_blank"><img src="<?php echo base_url(); ?>/assets/img/icon/printer.png"></a>		  				
			  </td>
			  <td class="align-middle"><?=$data->no_rm?></td>
			  <td class="align-middle"><?=$data->no_bpjs?></td>
			  <td class="align-middle"><?=$data->nama?></td>
			  <td class="align-middle"><?=$data->alamat?></td>
			  <td class="align-middle"><?=$data->telp?></td>
			</tr>
			<?php $no++;endforeach;?>
		  </tbody>
		</table>
	  </div>
	  <!-- /.card-body -->
	</div>
	<!-- /.card -->