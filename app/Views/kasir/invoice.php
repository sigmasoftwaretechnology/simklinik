<html>
	<head>
		<style>
			table {
			  font-family: arial, sans-serif;
			  border-collapse: collapse;
			  width: 100%;
			}

			td, th {
			  border: 1px solid #000000;
			  text-align: center;
			  height: 20px;
			  margin: 8px;
			}

		</style>
	</head>
	<body>
		<p>
		<i style="font-size:16pt; color:'#dddddd'">Klinik Melbod</i><br>
		Jl. Dr. Cipto Mangunkusumo, Nurmanan, Keniten, Kec. Ponorogo, Kabupaten Ponorogo
		</p>
		<hr>
		<div style="font-size:16pt; color:'#dddddd';text-align:center"><i>Invoice</i></div>
		<table style="width: 100%;border-collapse: collapse; border: none;" border="0" cellpadding="0" cellspacing="0">
			<tbody>
			<tr style="border: none;">
				<td style="width: 40%;text-align:left;border: none;"><p style="font-family: 'Times New Roman', Times, serif;font-size:10pt;margin-bottom: 0px;margin-top: 0px">No RM: <?= $data->no_rm?></p></td>
				<td  style="border: none;"></td>
				<td style="width: 40%;text-align:left;border: none;"><p style="font-family: 'Times New Roman', Times, serif;font-size:10pt;margin-bottom: 0px;margin-top: 0px">Transaksi No : <?= $data->no_reg?></p></td>
			</tr>
			<tr style="border: none;">
				<td style="width: 30%;text-align:left;border: none;"><p style="font-family: 'Times New Roman', Times, serif;font-size:10pt;margin-bottom: 0px;margin-top: 0px">Nama Pasien: <?= $data->nama?></p></td>
				<td  style="border: none;"></td>
				<td style="width: 30%;text-align:left;border: none;"><p style="font-family: 'Times New Roman', Times, serif;font-size:10pt;margin-bottom: 0px;margin-top: 0px">Tanggal : <?= $data->tanggal?></p></td>
			</tr>
			</tbody>
		</table>
		<br/>
		<table cellpadding="1" style="font-family: 'Times New Roman', Times, serif;font-size:10pt" >
			<tr>
				<th><strong>Tindakan</strong></th>
				<th><strong>Tarif</strong></th>
			</tr>
			<?php 
			if(isset($data->assessment->tindakan)):
			$totTindakan = 0;
			foreach($data->assessment->tindakan as $tindakan):
			$totTindakan = $totTindakan+$tindakan->tarif_tindakan;
			?>
			<tr>
				<td><?=$tindakan->nama_tindakan?></td>
				<td style="text-align:right"><?="Rp " . number_format($tindakan->tarif_tindakan,2,',','.')?></td>
			</tr>
			<?php 
			endforeach;
			?>
			<tr>
				<td>Total</td>
				<td style="text-align:right"><?="Rp " . number_format($totTindakan,2,',','.')?></td>
			</tr>

			<?php
			endif;
			?>
		</table>
		<br/>
		<table cellpadding="1" style="font-family: 'Times New Roman', Times, serif;font-size:10pt" >
			<tr>
				<th><strong>Obat</strong></th>
				<th><strong>Harga</strong></th>
			</tr>
			<?php 
			if(isset($data->resep_obat)):
			$totObat = 0;
			foreach($data->resep_obat as $resepObat):
			$totObat = $totObat+$resepObat->harga;
			?>
			<tr>
				<td><?=$resepObat->nama_obat?></td>
				<td style="text-align:right"><?="Rp " . number_format($resepObat->harga,2,',','.')?></td>
			</tr>
			<?php 
			endforeach;
			?>
			<tr>
				<td>Total</td>
				<td style="text-align:right"><?="Rp " . number_format($totObat,2,',','.')?></td>
			</tr>
			<?php
			endif;
			?>
		</table>
		<div style="color:'#dddddd';"><i>Total pembayaran : <?="Rp " . number_format($totTindakan+$totObat,2,',','.')?></i></div>
	</body>
</html>