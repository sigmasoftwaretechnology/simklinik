 <?php
 
 function penyebut($nilai) {
		$nilai = abs($nilai);
		$huruf = array("", "satu", "dua", "tiga", "empat", "lima", "enam", "tujuh", "delapan", "sembilan", "sepuluh", "sebelas");
		$temp = "";
		if ($nilai < 12) {
			$temp = " ". $huruf[$nilai];
		} else if ($nilai <20) {
			$temp = penyebut($nilai - 10). " belas";
		} else if ($nilai < 100) {
			$temp = penyebut($nilai/10)." puluh". penyebut($nilai % 10);
		} else if ($nilai < 200) {
			$temp = " seratus" . penyebut($nilai - 100);
		} else if ($nilai < 1000) {
			$temp = penyebut($nilai/100) . " ratus" . penyebut($nilai % 100);
		} else if ($nilai < 2000) {
			$temp = " seribu" . penyebut($nilai - 1000);
		} else if ($nilai < 1000000) {
			$temp = penyebut($nilai/1000) . " ribu" . penyebut($nilai % 1000);
		} else if ($nilai < 1000000000) {
			$temp = penyebut($nilai/1000000) . " juta" . penyebut($nilai % 1000000);
		} else if ($nilai < 1000000000000) {
			$temp = penyebut($nilai/1000000000) . " milyar" . penyebut(fmod($nilai,1000000000));
		} else if ($nilai < 1000000000000000) {
			$temp = penyebut($nilai/1000000000000) . " trilyun" . penyebut(fmod($nilai,1000000000000));
		}     
		return $temp;
	}
 
	function terbilang($nilai) {
		if($nilai<0) {
			$hasil = "minus ". trim(penyebut($nilai));
		} else {
			$hasil = trim(penyebut($nilai));
		}     		
		return $hasil;
	}
 ?>
 <style>
 table#info-table td {
    border: none;
    white-space: nowrap;
}

table#info-table td:last-child {
    width: 100%;
}

table#info-table p {
    margin-bottom: 2px;
}

 </style>
 <table width="800" border="0" cellpadding="4" cellspacing="0" style="border: 1px solid #000;">  
  <tr>  
     <td rowspan="7" width="120" style="border-right:1px solid #000;"> </td>  
   <td valign="bottom"></td>  
   <td valign="top" align="right"> Ponorogo, <?=$dataRegis->tanggal?> </td>  
 </tr>  
 <tr>  
   <td width="150" valign="top" > No </td>  
   <td valign="top" > : <?php echo $dataRegis->no_reg;?> </td>  
 </tr>  
 <tr>  
   <td valign="top" > Telah Diterima Dari </td>  
   <td valign="top" > : <?php echo $dataRegis->nama;?> </td>  
 </tr>  
 <tr>  
   <td colspan="2" valign="top" > 
   <table width="100%" border="0" cellpadding="4" cellspacing="0" id="info-table"> 
		<?php $totTindakan=0;foreach($dataRegis->assessment->tindakan as $tindak):?>
		<?php
		 $totTindakan =  $totTindakan+$tindak->tarif_tindakan;
		?>
	   <tr>
		<td valign="top" ><?=$tindak->nama_tindakan?></td>  
		<td valign="top" align="right"><?= number_format($tindak->tarif_tindakan,0,',','.')?></td>  
		<td></td>
	   </tr>
	   <?php endforeach;?>
	   	<tr>
		<td valign="top" >Obat</td>  
		<td valign="top" align="right">
			<?php
			$totObat = 0;
			foreach($dataRegis->resep_obat as $obat){
				$totObat = $totObat+($obat->harga*$obat->jumlah);
			}
			echo  number_format($totObat,0,',','.');
			?>
		</td>  
		<td></td>
	   </tr>
	   	   	<tr>
		<td valign="top" >Total</td>  
		<td valign="top" align="right">
			<?php
			echo  number_format($totObat+$totTindakan,0,',','.');
			?>
		</td>  
		<td></td>
	   </tr>

   </table>
   </td>  
 </tr>  
  <tr>  
   <td colspan="2">Terima kasih sudah berkunjung ke klinik sehati<br/>Semoga sehat selalu</br>Klinik sehati melayani dengan sepenuh hati</td>  
 </tr>  
 </table>  
<script>
  window.addEventListener("load", window.print());
</script>