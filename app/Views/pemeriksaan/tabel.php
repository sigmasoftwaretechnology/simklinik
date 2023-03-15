<?php
helper('klinik_helper');
?>
<div class="card">
	  <div class="card-body table-responsive p-0" style="height: 900px;">
		<table class="table table-head-fixed table-hover text-nowrap table-sm text-nowrap table-bordered">
		  <thead>
			<tr>
			<th>No</th>
			<!--<th>No Registrasi</th>-->
			  <th>Tanggal</th>
			  <th>Nama</th>
			  <th>Alamat</th>
			  <th>Umur</th>
			  <th>Poli</th>
			  <th>Antrian</th>
			  <!--<th>Status</th>-->
			  <th>Perawat</th>
			  <th>Dokter</th>
			  <th class="text-center">Aksi</th>
			</tr>
		  </thead>
		  <tbody>
		  <?php $no=1;foreach($row as $data):?>
			<tr>
			<td class="align-middle"><?=$no?></td>
			  <!--<td class="align-middle"><?=$data->no_reg?></td>-->
			  <td class="align-middle"><?=$data->tanggal?></td>
			  <td class="align-middle"><?=$data->nama?></td>
			  <td class="align-middle"><?=$data->alamat?></td>
			  <td class="align-middle">
			  	<?php 
				$umur = hitung_umur($data->tgl_lahir);
				echo $umur["tahun"]." th ".$umur["bulan"]." bl ".$umur["hari"]." hr";
				?>
			  </td>
				<td class="align-middle"><?=$data->poli?></td>
			  <td class="align-middle"><?=$data->antrian?></td>
			  <!--<td class="align-middle"><?=$data->status?></td>-->
			  <td class="align-middle"><?=$data->perawat?></td>
			  <td class="align-middle"><?=$data->dokter?></td>

			  <td class="text-center">
					<a type="button" class="btn btn-outline-danger btn-flat btn-xs" href="<?php echo base_url();?>/rekam-medis/pemeriksaan?q=<?=$data->id?>"  id="periksa-px" ><img src="<?php echo base_url(); ?>/assets/img/icon/doctor.png"></a>
					<a id="panggil" type="button" 
					data-no_reg="<?=$data->no_reg?>" 
					data-nomor="<?=$data->antrian?>" 
					data-suara="<?php echo str_replace(' ', '', strtolower($data->poli));?>"
					data-poli="<?=$data->poli?>" class="btn btn-outline-danger btn-flat btn-xs"><img src="<?php echo base_url(); ?>/assets/img/icon/mic.png"></button>					
			  </td>
			</tr>
			<?php $no++;endforeach;?>
		  </tbody>
		</table>
	  </div>
	  <!-- /.card-body -->
	</div>
	<!-- /.card -->