<HTML>
<HEAD>
	<link href='<?php echo base_url('assets/css/printer.css');?>' rel='stylesheet' type='text/css'>
</HEAD>
<BODY onLoad="javascript:window.print()">
<?php

//=================================== Surat Tugas ================================================
if ($page=="surat_tugas")
{
?> 
	<table class="cetak_judul" align="center">
		<tr><td td rowspan="4"><img src="<?php echo base_url('assets/imgs/logo_poliban.png');?>" width="70px"</td>
			<td align="center"><strong>KEMENTERIAN RISET, TEKNOLOGI, DAN PENDIDIKAN TINGGI<strong></td></tr>
			<td align="center"><strong>POLITEKNIK NEGERI BANJARMASIN<strong></td></tr>
		<tr><td align="center">Jl.Brigjen Hasan Basri Kampus UNLAM - Banjarmasin Kodepos: 70123</td></tr>
		<tr><td align="center">Telp: 0511-3305052, email: poliban@poliban.ac.id</td></tr>
	</table>
	<hr>	
	<table class=cetak align="center">
		<tr><td align="center"><b><u>S U R A T  T U G A S</u></b></td></tr>
		<tr><td align="center"><b>nomor : <?php echo $d['no_surat_tugas']?></b></td></tr>
		<tr><td>
			Wakil Direktur II Bidang Umum dan Keuangan Politeknik Negeri Banjarmasin dengan ini menugaskan:
			</td></tr>

			<?php 
			$i=1;
			foreach($pengikut as $p) { 
			?>

			<tr>
				<td>
					<table class=cetak align="center">
						<tr>
							<td valign="top"><?php echo $i; ?></td>
							<td>Nama<br>NIP<br>Pangkat/Golongan<br>Jabatan<br>Unit Kerja
							</td>
							<td><b><?php 
								echo $p['nama_pengikut']."<br>"; 
								echo $p['id']."<br>"; 
								echo $p['pangkat_gol']."<br>"; 
								echo $p['jabatan']."<br>"; 
								echo "Politeknik Negeri Banjarmasin"; 

							?></b></td>
						</tr>
					</table>
				</td>
			</tr>
			
			<?php 
			$i++;
			} 
			?>

		<tr><td>
			<?php echo $d['kegiatan']?>
			</td></tr>
		<tr><td>
			Demikian surat tugas ini dibuat, untuk dapat dilaksanakan sebagaimana mestinya.
			</td></tr>
	</table>
	<table>
		<tr><td width="30%">
			Tembusan:
		</td>
			<td width="30%"></td>
			<td>
				Banjarmasin, <?php echo $d['tgl_surat_tugas']?><br>
				WADIR II<br><br><br><br>

				Joni Riadi<br>
				NIP. 19660412 198903 1 003
			</td>
	</table>
<?php
}
?>