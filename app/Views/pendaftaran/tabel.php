<?php
helper('klinik_helper');
?>
<div class="card">
	  <div class="card-body table-responsive p-0" style="height: 700px;">
		<table class="table table-head-fixed table-hover text-nowrap table-sm text-nowrap table-bordered">
		  <thead>
			<tr>
				<th>No</th>
						  <th class="text-center">Aksi</th>
				<th>No Registrasi</th>
			  <th>Tanggal Datang</th>
			  <th>No RM</th>
			  <th>Nama</th>
			  <th>Alamat</th>
			  <th>Umur</th>
			  <th>Poli</th>
			  <th>Antrian</th>
			  <th>Status</th>
			</tr>
		  </thead>
		  <tbody>
			<?php $i=1;foreach($row as $data):?>
			<tr>
				<td class="align-middle"><?=$i?></td>
				<td class="text-center">
			  		<a id="update-<?=$data->id?>" data-href="<?=base_url()?>/rekam-medis/pendaftaran/ubah?id=<?=$data->id?>" data-toggle="modal" data-target="#modal-form-update"><img src="<?php echo base_url(); ?>/assets/img/icon/edit.png"></i></button>
					<a target="_blank" href="<?php echo base_url();?>/rekam-medis/pendaftaran/cetak-antrian?q=<?=$data->id?>"><img src="<?php echo base_url(); ?>/assets/img/icon/printer.png"></a>
					<a data-toggle="modal" href="#modal-delete" data-id="<?=$data->id?>">
						<img src="<?php echo base_url(); ?>/assets/img/icon/delete.png">
					</a>
			  </td>
				<td class="align-middle"><?=$data->no_reg?></td>
				<td class="align-middle"><?=$data->tanggal?></td>
				<td class="align-middle"><?=$data->no_rm2?></td>
				<td class="align-middle"><?=$data->nama?></td>
				<td class="align-middle"><?=$data->alamat?></td>
				<td class="align-middle">
			  	<?php 
				$umur = hitung_umur($data->tgl_lahir);
				echo $umur["tahun"]." th";
				?>
			  </td>
				<td class="align-middle"><?=$data->poli?></td>
			  <td class="align-middle"><?=$data->antrian?></td>
			  <td class="align-middle"><?=$data->status?></td>
			</tr>
			<?php $i++;endforeach;?>
		  </tbody>
		</table>
	  </div>
	  <!-- /.card-body -->
	</div>
	<!-- /.card -->