<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
<section class="content">
    <div class="container-fluid">
		<div class="card">	  
			<div class="card-body p-0">
				<div class="row">
					<div class="col-12">
						<table class="table table-hover table-sm table-bordered">
						  <thead>
							<tr>
							  <th>Tanggal</th>
							  <th>Registrasi</th>
							  <th>Dokter</th>
							  <th>Pendapatan</th>
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
							<td>a</td>
							</tr>
							<?php endforeach;?>
						  </tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
