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
					<a type="button" href="<?php echo base_url();?>/rekam-medis/pemeriksaan?q=<?=$data->id?>"  id="periksa-px" class="btn text-center btn-outline-info btn-flat btn-xs"><i class="fa fa-user-md"></i>&nbsp;Pemeriksaan</a>
					<button id="panggil" type="button" 
					data-no_reg="<?=$data->no_reg?>" 
					data-nomor="<?=$data->antrian?>" 
					data-suara="<?php echo str_replace(' ', '', strtolower($data->poli));?>"
					data-poli="<?=$data->poli?>" class="btn btn-outline-success btn-xs"><i class="fa fa-microphone"></i> Panggil</button>					
			  </td>
			</tr>
			<?php $no++;endforeach;?>
		  </tbody>
		</table>
	  </div>
	  <!-- /.card-body -->
	</div>
	<!-- /.card -->