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
		<i>Klinik Gigi Sehat</i><br>
		Ponorogo, Jawa Timur, Indonesia
		</p>
		<hr>
		<div style="font-size:16pt; color:'#dddddd';text-align:center"><i>Invoice</i></div>
		<table style="width: 100%;border-collapse: collapse; border: none;" border="0" cellpadding="0" cellspacing="0">
			<tbody>
			<tr style="border: none;">
				<td style="width: 40%;text-align:left;border: none;"><p style="font-family: 'Times New Roman', Times, serif;font-size:10pt;margin-bottom: 0px;margin-top: 0px">No RM: <?= $data[0]->no_rm?></p></td>
				<td  style="border: none;"></td>
				<td style="width: 40%;text-align:left;border: none;"><p style="font-family: 'Times New Roman', Times, serif;font-size:10pt;margin-bottom: 0px;margin-top: 0px">Transaksi No : <?= $data[0]->no_reg?></p></td>
			</tr>
			<tr style="border: none;">
				<td style="width: 30%;text-align:left;border: none;"><p style="font-family: 'Times New Roman', Times, serif;font-size:10pt;margin-bottom: 0px;margin-top: 0px">Nama Pasien: <?= $data[0]->nama?></p></td>
				<td  style="border: none;"></td>
				<td style="width: 30%;text-align:left;border: none;"><p style="font-family: 'Times New Roman', Times, serif;font-size:10pt;margin-bottom: 0px;margin-top: 0px">Tanggal : <?= $data[0]->tanggal?></p></td>
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
			if(isset($data[0]->tindakan)):
			foreach($data[0]->tindakan as $tindakan):?>
			<tr>
				<td><?=$tindakan->nama_tindakan?></td>
				<td><?=$tindakan->tarif_tindakan?></td>
			</tr>
			<?php 
			endforeach;
			endif;
			?>
		</table>
	</body>
</html>