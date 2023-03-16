<?php foreach($dtAntrian as $key => $antrian):?>
<div class="row">
	<div class="col-lg-12 col-12">
		<div class="small-box bg-red text-center">
			<div class="inner">
				<h1><?php echo $antrian->poli?></h1>
					<h1 style="font-size:6rem"><?php echo $antrian->no_antrian;?></h1>
			</div>
			<!--<a class="small-box-footer"><?php echo $antrian->dpjp;?></a> -->
		</div>
	</div>
</div>
<?php endforeach;?>