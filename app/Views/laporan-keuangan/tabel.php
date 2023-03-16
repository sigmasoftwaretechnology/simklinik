<div class="card">	  
	<div class="card-body p-2">
		<table class="table table-hover table-sm table-bordered">
						  <thead>
							<tr>
							  <th>Tanggal</th>
							  <th>Registrasi</th>
							  <th>Dokter</th>
							  <th>Perawat</th>
							  <th>Input Resep</th>
							  <th>Tindakan</th>
							  <th>Obat</th>
							  <th>Total Pendapatan</th>
							</tr>
						  </thead>
						  <tbody id="content">
							<?php foreach($listAssessment as $dtRes):?>
							<tr>
							<td><?=$dtRes->tanggal?></td>
							<td><?=$dtRes->no_reg?></td>
							<td><?php 
							if(isset($dtRes->dokter)){
								echo $dtRes->dokter;
							}
							?></td>
							<td><?php 
							if(isset($dtRes->perawat)){
								echo $dtRes->perawat;
							}
							?></td>
							<td><?php 
							if(isset($dtRes->input_resep_obat)){
								echo $dtRes->input_resep_obat;
							}
							?></td>
							<td class="text-right">
								<?php if(isset($dtRes->assessment->tindakan)):?>
									<?php 
									$totTindakan = 0;
									foreach($dtRes->assessment->tindakan as $dtTindakan){
										$totTindakan = $totTindakan + $dtTindakan->tarif_tindakan;										
									}
									echo "Rp ".number_format($totTindakan, 0, ',', '.');
									?>
								<?php endif;?>
							</td>
							<td class="text-right">
								<?php $totObat = 0;if(isset($dtRes->resep_obat)):?>
									<?php 
									foreach($dtRes->resep_obat as $dtObat){
										$gtObat = $dtObat->harga*$dtObat->jumlah;
										$totObat = $totObat + $gtObat;										
									}
									echo "Rp ".number_format($totObat, 0, ',', '.');
									?>
								<?php endif;?>
							</td>					
							<td class="text-right">
									<?="Rp ".number_format($totTindakan+$totObat, 0, ',', '.')?>
							</td>							
							</tr>
							<?php endforeach;?>
						  </tbody>
						</table>
	  <!-- /.card-body -->
	</div>
</div>
	<!-- /.card -->