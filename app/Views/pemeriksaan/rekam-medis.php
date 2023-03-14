<?php if(isset($data[0])):?>
<table style="width: 100%;" border="1" cellpadding="0" cellspacing="0">
<tbody>
<tr>
<td colspan="2" align="center"><p style="font-family: 'Arial','Times New Roman', Times, serif;font-size:20pt;margin-bottom: 5px;margin-top: 5px">Medical Record</p></td>
</tr>
<tr>
	<td colspan="2" style="padding:5px">
		<p style="font-family: 'Arial','Times New Roman', Times, serif;font-size:16pt;margin-bottom: 0px;margin-top: 5px">Identitas Pasien</p>
		<table style="width: 100%;" border="0" cellpadding="0" cellspacing="0">
			<tbody>
			<tr>
				<td><p style="font-family: 'Arial','Times New Roman', Times, serif;font-size:10pt;margin-bottom: 0px;margin-top: 0px">No RM : &nbsp;<?= $data[0]->no_rm?></p></td>
				<td><p style="font-family: 'Arial','Times New Roman', Times, serif;font-size:10pt;margin-bottom: 0px;margin-top: 0px">No Registrasi : &nbsp;<?= $data[0]->no_reg?></p></td>
			</tr>
			<tr>
				<td><p style="font-family: 'Arial','Times New Roman', Times, serif;font-size:10pt;margin-bottom: 0px;margin-top: 0px">No BPJS : &nbsp;<?= $row->no_bpjs?></p></td>
				<td><p style="font-family: 'Arial','Times New Roman', Times, serif;font-size:10pt;margin-bottom: 0px;margin-top: 0px">Tanggal Periksa : &nbsp;<?= $data[0]->tanggal?></p></td>
			</tr>
			<tr>
				<td><p style="font-family: 'Arial','Times New Roman', Times, serif;font-size:10pt;margin-bottom: 0px;margin-top: 0px">Nama Pasien : &nbsp;<?= $data[0]->nama?> (<?= $data[0]->umur?>)</p></td>
				<td></td>
			</tr>
			<tr>
				<td><p style="font-family: 'Arial','Times New Roman', Times, serif;font-size:10pt;margin-bottom: 0px;margin-top: 0px">Alamat Pasien : &nbsp;<?= $data[0]->alamat_pasien?></p></td>
				<td></td>
			</tr>
			</tbody>
		</table>
	</td>
</tr>
<tr>
	<td style="padding:5px" width="20%"><p style="font-family: 'Arial','Times New Roman', Times, serif;font-size:10pt;margin-bottom: 0px;margin-top: 0px">Subjectif</p></td>
	<td style="padding:5px">
	<p style="font-family: 'Arial','Times New Roman', Times, serif;font-size:10pt;margin-bottom: 0px;margin-top: 0px"><?= $data[0]->subject?></p>
	</td>
</tr>
<tr>
	<td style="padding:5px"><p style="font-family: 'Arial','Times New Roman', Times, serif;font-size:10pt;margin-bottom: 0px;margin-top: 0px">Objectif</p></td>
	<td style="padding:5px">
	<table style="width: 100%;" border="0" cellpadding="0" cellspacing="0">
		<tr>
			<td colspan="3"><p style="font-family: 'Arial','Times New Roman', Times, serif;font-size:10pt;margin-bottom: 0px;margin-top: 0px">K/U: <?=$data[0]->object->ku?></p></td>
		</tr>
		<tr>
			<td><p style="font-family: 'Arial','Times New Roman', Times, serif;font-size:10pt;margin-bottom: 0px;margin-top: 0px">T(mm/Hg): <?=$data[0]->object->t?></p></td>
			<td><p style="font-family: 'Arial','Times New Roman', Times, serif;font-size:10pt;margin-bottom: 0px;margin-top: 0px">N(x/mnt): <?=$data[0]->object->n?></p></td>
			<td><p style="font-family: 'Arial','Times New Roman', Times, serif;font-size:10pt;margin-bottom: 0px;margin-top: 0px"><code><sup>*</sup></code>S(<sup>o</sup>C): <?=$data[0]->object->s?></p></td>
		</tr>
		<tr>
			<td><p style="font-family: 'Arial','Times New Roman', Times, serif;font-size:10pt;margin-bottom: 0px;margin-top: 0px">RR(x/mnt): <?=$data[0]->object->rr?></p></td>
			<td><p style="font-family: 'Arial','Times New Roman', Times, serif;font-size:10pt;margin-bottom: 0px;margin-top: 0px">BB(kg): <?=$data[0]->object->bb?></p></td>
			<td><p style="font-family: 'Arial','Times New Roman', Times, serif;font-size:10pt;margin-bottom: 0px;margin-top: 0px">TB(cm): <?=$data[0]->object->tb?></p></td>
		</tr>
	</table>
	</td>
</tr>
<tr>
	<td style="padding:5px"><p style="font-family: 'Arial','Times New Roman', Times, serif;font-size:10pt;margin-bottom: 0px;margin-top: 0px">Assessment</p></td>
	<td style="padding:5px">
		<table style="width: 50%;" style="font-family: 'Arial','Times New Roman', Times, serif;font-size:10pt;"  border="1" cellpadding="0" cellspacing="0">
			<thead>
				<tr>
				  <th width="10%">No</th>
				  <th width="90%">Nama ICD 10</th>
				</tr>
			</thead>
			  <tbody>
					<?php $no=1;foreach($data[0]->assessment->icdx as $icdx):?>
						<tr>
						<td><p style="font-family: 'Arial','Times New Roman', Times, serif;font-size:10pt;margin-bottom: 3px;margin-top: 0px;margin-left: 5px"><?=$no?></p></td>
						<td><p style="font-family: 'Arial','Times New Roman', Times, serif;font-size:10pt;margin-bottom: 3px;margin-top: 0px;margin-left: 5px"><?=$icdx->nama_icdx?></p></td>
						</tr>
					<?php $no++;endforeach;?>
			  </tbody>
		</table>
		<br/>
		<table style="width: 50%;" style="font-family: 'Arial','Times New Roman', Times, serif;font-size:10pt"  border="1" cellpadding="0" cellspacing="0">
			<thead>
				<tr>
				  <th width="10%">No</th>
				  <th width="90%">Tindakan</th>
				</tr>
			</thead>
			  <tbody>
					<?php $no=1;foreach($data[0]->assessment->tindakan as $tindakan):?>
						<tr>
						<td><p style="font-family: 'Arial', Times, serif;font-size:10pt;margin-bottom: 3px;margin-top: 0px;margin-left: 5px"><?=$no?></p></td>
						<td><p style="font-family: 'Arial', Times, serif;font-size:10pt;margin-bottom: 3px;margin-top: 0px;margin-left: 5px"><?=$tindakan->nama_tindakan?></p></td>
						</tr>
					<?php $no++;endforeach;?>
			  </tbody>
		</table>
	</td>
</tr>
<tr>
	<td style="padding:5px"><p style="font-family: 'Arial','Times New Roman', Times, serif;font-size:10pt;margin-bottom: 0px;margin-top: 0px">Plant</p></td>
	<td style="padding:5px">
		<table style="width: 100%;" border="0" cellpadding="0" cellspacing="0">
			<tr>
				<td colspan="3"><p style="font-family: 'Arial','Times New Roman', Times, serif;font-size:10pt;margin-bottom: 0px;margin-top: 0px">Resep: <?=$data[0]->plant->resep?></p></td>
			</tr>
		</table>
	</td>
</tr>
</tbody>
</table>
<?php else:?>
<table style="width: 100%;" border="1" cellpadding="0" cellspacing="0">
	<tbody>
	<tr>
	<td colspan="2" align="center"><p style="font-family: 'Arial','Times New Roman', Times, serif;font-size:20pt;margin-bottom: 5px;margin-top: 5px">Medical Record</p></td>
	</tr>
	<tr>
	<td colspan="2" align="center"><p style="font-family: 'Arial','Times New Roman', Times, serif;font-size:10pt;margin-bottom: 5px;margin-top: 5px">Data tidak ditemukan</p></td>
	</tr>
	</tbody>
</table>
<?php endif;?>