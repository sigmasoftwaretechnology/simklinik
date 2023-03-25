<?php foreach($dtAntrian as $key => $antrian):?>
<div class="row">
	<div class="col-md-12">
		<div class="small-box text-center"  style="background-color: #d47674;">
			<div class="inner">
				<h1><?php echo $antrian->poli?></h1>
					<h1 style="font-size:6rem"><?php echo $antrian->no_antrian;?></h1>
			</div>
			<!--<a class="small-box-footer"><?php echo $antrian->dpjp;?></a> -->
		</div>
	</div>
</div>
<?php endforeach;?>