<style>
.card {
  box-shadow: 0 14px 28px rgba(0,0,0,0.25), 0 10px 10px rgba(0,0,0,0.22);
  font-family: 'Trebuchet MS', sans-serif;
  position: relative;
  height: 200px;
  margin: 20px auto;
  width: 350px;
  background-image: url(<?php echo base_url('assets/img/background-kartu.png');?>);
  background-size: 350px 200px;
}
.card p{
	padding:0px;
    margin-left: 10px;
	margin-top:0px;
	margin-bottom:3px;
	font-size:12px;
}
#title{
	margin-top:10px;
	font-size:25px;
}
#address{
	font-size:11px;
}
#rm{
	margin-top:30px;
	font-weight:bold;
}
#nama{
	font-weight:bold;
}
#foot{
	font-weight:bold;
	color:#dc3545;
	margin-top:30px;
}
@media print {
	@page {
        margin-top: 0px;
        margin-bottom: 0px;
    }
    body {
        padding-top: 0px;
        padding-bottom: 0px ;
		-webkit-print-color-adjust: exact;
    }
}
</style>
<body>
	<div class="card back">
		<p id="title">Klinik Melbod</p>
		<p id="address">Jl. Dr. Cipto Mangunkusumo, Kabupaten Ponorogo</p>
		<p id="rm"><?=$data["no_rm"]?></p>
		<p id="nama"><?=$data["nama"]?></p>
		<p><?=$data["alamat"]?></p>
		<?php
		if($data["jk"] == "Perempuan"){
			$jk = "P";
		}
		else{
			$jk = "L";
		}
		?>
		<p><?=$jk?>/<?php echo date("d-m-Y",strtotime($data["tgl_lahir"]));?></p>
		<p id="foot">Harap kartu dibawa setiap berobat</p>
	</div>
</body>
<script>
  window.addEventListener("load", window.print());
</script>