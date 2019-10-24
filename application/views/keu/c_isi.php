<HTML>
<HEAD>
	<link href='<?php echo base_url('assets/css/printer.css');?>' rel='stylesheet' type='text/css'>
</HEAD>
<BODY onLoad="javascript:window.print()">
<?php

//=================================== Surat Full ================================================
if ($page=="cetak_rincianbiaya")
{
?> 
	<table class="cetak_judul" align="center">
		<tr><td td rowspan="4"><img src="<?php echo base_url('assets/imgs/logo_poliban.png');?>" width="70px"></td>
			<td align="center"><strong>KEMENTERIAN RISET, TEKNOLOGI, DAN PENDIDIKAN TINGGI<strong></td></tr>
			<td align="center"><strong>POLITEKNIK NEGERI BANJARMASIN<strong></td></tr>
		<tr><td align="center">Jl.Brigjen Hasan Basri Kampus UNLAM - Banjarmasin Kodepos: 70123</td></tr>
		<tr><td align="center">Telp: 0511-3305052, email: poliban@poliban.ac.id</td></tr>
	</table>
	<hr>	
	<table class=cetak align="center" >
		<tr><td align="center"><b><u>RINCIAN PERJALANAN DINAS</u></b></td></tr>
	</table>
	<table>
		<tr><td align="left"><b>Lampiran ST No. </td><td>: <?php echo $d['no_surat_tugas']?></b></td></tr>
		<tr><td align="left"><b>Tanggal </td><td>: <?php echo $d['tgl_surat']?></b></td></tr>
	</table>
	<table class="isi" border=1>
        <tr>
            <th width= 5%>NO</th>
            <th width= 65% colspan=2>RINCIAN BIAYA</th>
            <th width= 15%>JUMLAH (RP)</th>
            <th width= 15%>KETERANGAN</th>
        </tr>
        <tr>
            <td>1</td>
            <td style="border-right:0px;">Uang Harian</td>
            <td style="border-left:0px;">: <?php echo $d['jml_hari_harian']?> x Rp.<?php echo number_format($d['uang_harian'],0,',','.').",-"?></td>
            <td align="right"><?php echo number_format(($d['jml_hari_harian']*$d['uang_harian']),0,',','.').",-"?></td>
            <td></td>
        </tr>
		<tr>
            <td>2</td>
            <td style="border-right:0px;">Transport</td>
            <td style="border-left:0px;">:</td>
            <td></td>
            <td></td>
        </tr>
		<tr>
            <td></td>
            <td style="border-right:0px;">Tiket</td>
            <td style="border-left:0px;">: <?php echo $d['kota_asal']?>-<?php echo $d['kota_tujuan']?>(PP)</td>
            <td align="right"><?php echo number_format($d['transport_1'],0,',','.').",-"?></td>
            <td></td>
        </tr>
		<tr>
            <td></td>
            <td style="border-right:0px;"></td>
            <td style="border-left:0px;">: Tempat Kedudukan - Bandara(PP)</td>
            <td align="right"><?php echo number_format($d['transport_2'],0,',','.').",-"?></td>
            <td></td>
        </tr>
		<tr>
            <td></td>
            <td style="border-right:0px;"></td>
            <td style="border-left:0px;">: Bandara - Tujuan(PP)</td>
            <td align="right"><?php echo number_format($d['transport_3'],0,',','.').",-"?></td>
            <td></td>
        </tr>
		<tr>
            <td>3</td>
            <td style="border-right:0px;">Penginapan</td>
            <td style="border-left:0px;">:</td>
            <td></td>
            <td></td>
        </tr>
		<tr>
            <td></td>
            <td style="border-right:0px;">Hotel</td>
            <td style="border-left:0px;">: <?php echo $d['jml_hari_penginapan']?> x Rp.<?php echo number_format($d['penginapan'],0,',','.').",-"?></td>
            <td align="right"><?php echo number_format(($d['jml_hari_penginapan']*$d['penginapan']),0,',','.').",-"?></td>
            <td></td>
        </tr>
		<tr>
            <td class="foot"></td>
            <td class="foot" align="center" colspan=2>JUMLAH</td>
            <td class="foot" align="right"><?php echo number_format((($d['jml_hari_harian']*$d['uang_harian'])+$d['transport_1']+$d['transport_2']+$d['transport_3']+($d['jml_hari_penginapan']*$d['penginapan'])),0,',','.').",-"?></td>
            <td class="foot"></td>
        </tr>
		<tr>
            <td class="foot" colspan=5 align="center"><i>Terbilang</i>    : &nbsp;&nbsp;&nbsp;&nbsp;<b>Satu Juta Dua Ratus Ribu Rupiah</b></td>
        </tr>
    </table>
	<br>
	<table width="100%">
		<tr>
			<td width="40%"></td>
			<td width="20%"></td>
			<td width="40%">Banjarmasin, <?php echo $d['tgl_sekarang']?></td>
		</tr>
		<tr>
			<td width="40%">Telah dibayar sejumlah</td>
			<td width="20%"></td>
			<td width="40%">Telah menerima jumlah uang sebesar</td>
		</tr>
		<tr>
			<td width="40%"><?php echo number_format((($d['jml_hari_harian']*$d['uang_harian'])+$d['transport_1']+$d['transport_2']+$d['transport_3']+($d['jml_hari_penginapan']*$d['penginapan'])),0,',','.').",-"?></td>
			<td width="20%"></td>
			<td width="40%"><?php echo number_format((($d['jml_hari_harian']*$d['uang_harian'])+$d['transport_1']+$d['transport_2']+$d['transport_3']+($d['jml_hari_penginapan']*$d['penginapan'])),0,',','.').",-"?></td>
		</tr>
		<tr>
			<td width="40%">Bendahara Pengeluaran,</td>
			<td width="20%"></td>
			<td width="40%">Yang Menerima,</td>
		</tr>
		<tr>
			<td width="40%"><br><br><br></td>
			<td width="20%"></td>
			<td width="40%"></td>
		</tr>
		<tr>
			<td width="40%"><u>Muhammad Murtadlo, SE</u></td>
			<td width="20%"></td>
			<td width="40%"><u><?php echo $d['nama_pengikut']?></u></td>
		</tr>
		<tr>
			<td width="40%">NIP. 198101282002121002</td>
			<td width="20%"></td>
			<td width="40%">NIP. <?php echo $d['nip']?></td>
		</tr>
	</table>
	<hr>
	<table class=cetak align="center" >
		<tr><td align="center"><b><u>PERHITUNGAN SPD RAMPUNG</u></b></td></tr>
	</table>
	<table width="100%">
        <tr>
            <td>Ditetapkan sejumlah</td>
            <td>:</td>
            <td align="right">Rp.<?php echo number_format((($d['jml_hari_harian']*$d['uang_harian'])+$d['transport_1']+$d['transport_2']+$d['transport_3']+($d['jml_hari_penginapan']*$d['penginapan'])),0,',','.').",-"?></td>
        </tr>
        <tr>
            <td>Yang telah dibayar semula</td>
            <td>:</td>
            <td></td>
        </tr>
		<tr>
            <td>Sisa kurang</td>
            <td>:</td>
            <td align="right">Rp.<?php echo number_format((($d['jml_hari_harian']*$d['uang_harian'])+$d['transport_1']+$d['transport_2']+$d['transport_3']+($d['jml_hari_penginapan']*$d['penginapan'])),0,',','.').",-"?></td>
        </tr>
    </table>
	<table width="100%">
		<tr>
            <td width="70%"></td>
            <td width="30%">a.n. Kuasa Pengguna Anggaran</td>
        </tr>
		<tr>
            <td width="70%"></td>
            <td width="30%">Pejabat Pembuat Komitmen,</td>
        </tr>
		<tr>
            <td width="70%"></td>
            <td width="30%"><br><br><br></td>
        </tr>
		<tr>
            <td width="70%"></td>
            <td width="30%"><u>H. Akbar Ela Heka, ST,MT</u></td>
        </tr>
		<tr>
            <td width="70%"></td>
            <td width="30%">NIP. 197507212003121002</td>
        </tr>
	</table>
<?php
}


//=================================== SPPD DEPAN ================================================
else if ($page=="cetak_sppd_depan")
{
?> 
  <table width="100%" style="border: solid 0px black; text-align: center;">
                     <tr>
                        <td><u><H3>SURAT PERJALANAN DINAS</H3></u></td>
                    </tr>
                </table>
                <table cellpadding="1"  width="100%" border="1" style="border-collapse: collapse;">
                    <tr style="border-top:1px solid black;">
                        <td width="3%" style="padding-left:5px;padding-bottom:5px;" >1.</td>
                        <td width="47%" style="padding-left:5px;padding-bottom:5px;" >Pejabat yang memberi perintah</td>
                        <td width="50%" style="padding-left:5px;padding-bottom:5px;" >Pejabat Pembuat Komitmen Politeknik Negeri Banjarmasin</td>
                    </tr>
                    <tr>
                        <td width="3%" style="padding-left:5px;padding-bottom:5px;"  rowspan="2">2.</td>
                        <td width="47%" style="padding-left:5px;padding-bottom:5px;" >Nama Pegawai yang diperintah</td>
                        <td width="50%" style="padding-left:5px;padding-bottom:5px;" ><b><?php echo $d['nama_pengikut']?></b></td>
                    </tr>
                    <tr>
                        <td width="47%" style="padding-left:5px;padding-bottom:5px;" >NIP</td>
                        <td width="50%" style="padding-left:5px;padding-bottom:5px;" >NIP. <?php echo $d['nip']?></td>
                    </tr>
                    <tr>
                        <td width="3%"  style="padding-left:5px;padding-bottom:5px;"  rowspan="2">3.</td>
                        <td width="47%" style="padding-left:5px;padding-bottom:5px;" >a. Pangkat/Gol</td>
                        <td width="50%" style="padding-left:5px;padding-bottom:5px;" ><?php echo $d['pangkat_gol']?>)</td>
                    </tr>
                    <tr>
                        <td width="47%" style="padding-left:5px;padding-bottom:5px;" >b. Jabatan</td>
                        <td width="50%" style="padding-left:5px;padding-bottom:5px;" ><?php echo $d['jabatan']?></td>
                    </tr>
                    <tr>
                        <td width="3%"  style="padding-left:5px;padding-bottom:5px;" >4.</td>
                        <td width="47%" style="padding-left:5px;padding-bottom:5px;" >Maksud perjalanan dinas</td>
                        <td width="50%" style="padding-left:5px;padding-bottom:5px;" ><?php echo $d['kegiatan']?></td>
                    </tr>
                    <tr>
                        <td width="3%"  style="padding-left:5px;padding-bottom:5px;" >5.</td>
                        <td width="47%" style="padding-left:5px;padding-bottom:5px;" >Alat angkut yang digunakan</td>
                        <td width="50%" style="padding-left:5px;padding-bottom:5px;" ><?php echo $d['angkutan']?></td>
                    </tr>
                    <tr>
                        <td width="3%"  style="padding-left:5px;padding-bottom:5px;"  rowspan="2">6.</td>
                        <td width="47%" style="padding-left:5px;padding-bottom:5px;" >a. Tempat Berangkat</td>
                        <td width="50%" style="padding-left:5px;padding-bottom:5px;" ><?php echo $d['kota_asal']?></td>
                    </tr>
                    <tr>
                        <td width="47%" style="padding-left:5px;padding-bottom:5px;" >b. Tempat Tujuan</td>
                        <td width="50%" style="padding-left:5px;padding-bottom:5px;" ><?php echo $d['kota_tujuan']?></td>
                    </tr>
                    <tr>
                        <td width="3%"  style="padding-left:5px;padding-bottom:5px;"  rowspan="3">7.</td>
                        <td width="47%" style="padding-left:5px;padding-bottom:5px;" >a. Lama Perjalanan Dinas</td>
                        <td width="50%" style="padding-left:5px;padding-bottom:5px;" ><?php echo $d['jml_hari_harian']?> Hari</td>
                    </tr>
                    <tr>
                        <td width="47%" style="padding-left:5px;padding-bottom:5px;" >b. Tanggal Berangkat</td>
                        <td width="50%" style="padding-left:5px;padding-bottom:5px;" ><?php echo $d['tgl_berangkat']?></td>
                    </tr>
                    <tr>
                        <td width="47%" style="padding-left:5px;padding-bottom:5px;" >c. Tanggal Kembali</td>
                        <td width="50%" style="padding-left:5px;padding-bottom:5px;" ><?php echo $d['tgl_kembali']?></td>
                    </tr>
                    
                    <tr>
                        <td width="3%"  style="padding-left:5px;padding-bottom:5px;"  rowspan="5">8.</td>
                        <td width="47%" style="padding-left:5px;padding-bottom:5px;" >Pembebanan Anggaran</td>
                        <td width="50%">&nbsp;</td>
                    </tr>
                    <tr>
                        <td width="47%" style="padding-left:5px;padding-bottom:5px;" >a. SKPD</td>
                        <td width="50%" style="padding-left:5px;padding-bottom:5px;" >.......</td>
                    </tr>
                    <tr>
                        <td width="47%" style="padding-left:5px;padding-bottom:5px;" >b. PROGRAM</td>
                        <td width="50%" style="padding-left:5px;padding-bottom:5px;" >.......</td>
                    </tr>
                    <tr>
                        <td width="47%" style="padding-left:5px;padding-bottom:5px;" >c. KEGIATAN</td>
                        <td width="50%" style="padding-left:5px;padding-bottom:5px;" >........</td>
                    </tr>
                    <tr>
                        <td width="47%" style="padding-left:5px;padding-bottom:5px;" >d. KODE REKENING</td>
                        <td width="50%" style="padding-left:5px;padding-bottom:5px;" >........</td>
                    </tr>
                    <tr>
                        <td width="3%"  style="padding-left:5px;padding-bottom:5px;" >9.</td>
                        <td width="47%" style="padding-left:5px;padding-bottom:5px;" >Keterangan Lain-Lain</td>
                        <td width="50%">&nbsp;</td>
                    </tr>
                </table>    
                <table style="undefined;table-layout: fixed; width: 700px">
<colgroup>
<col style="width: 220px">
<col style="width: 180px">
<col style="width: 300px">
</colgroup>
  <tr>
  <td align="center">&nbsp;</td>
    <td></td>
    <td align="left">Dikeluarkan &nbsp;&nbsp; : Banjarmasin<br> Pada Tanggal : <?php echo $d['tgl_sekarang']?><br></td>    
  </tr>
  <tr>
    <td align="center">&nbsp;</td>
    <td></td>
    <td align="center">Pejabat Pembuat Komitmen<br><br><br><br></td>
  </tr>
 
  <tr>
    <td align="center"><b>&nbsp;</b></td>
    <td></td>
    <td align="center"><b><b><u style=" padding-bottom:1px;
  text-decoration:none;
  border-bottom:1px solid #000;">H. AKbar</u><br>.....<br>NIP.1234</u>
  </tr>
  
</table>
<?php
}


//=================================== SPPD BELAKANG ================================================
else if ($page=="cetak_sppd_belakang")
{
?> 

<table width="100%" style="border: solid 0px black; text-align: center;">
                    
                    <tr>
                        <td rowspan="5" align="right" width="45%"></td>
                        <td width="18%" align="left"><font size="2pt">Berangkat dari</font></td>
                        <td width="1%"><font size="2pt">:</font></td>
                        <td width="30%" align="left"><font size="2pt"><?php echo $d['kota_asal']?></font></td>
                    </tr>
                    <tr>
                        <td width="18%" align="left"><font size="2pt">(tempat kedudukan)</font></td>
                        <td width="1%"><font size="2pt">:</font></td>
                        <td width="30%" align="left"><font size="2pt"><?php echo $d['kota_asal']?></font></td>
                    </tr>
                    <tr>
                        <td width="18%" align="left"><font size="2pt">Pada Tanggal</font></td>
                        <td width="1%"><font size="2pt">:</font></td>
                        <td width="30%"align="left"><font size="2pt"><?php echo $d['tgl_sekarang']?></font></td>
                    </tr>
                    <tr>
                        <td width="18%" align="left"><font size="2pt">Ke</font></td>
                        <td width="1%"><font size="2pt">:</font></td>
                        <td width="30%" align="left"><font size="2pt"><?php echo $d['kota_tujuan']?></font></td>
                    </tr>
                    <br>
                    
                </table>
                <br>
                <br>
                <table width="100%" rules="all">
                    <tr border='1'>
                    
                    </tr>
                    <tr>
                    <td width="5%">II.</td>
                    <td width="45%">
                    <table width="100%">
                        <tr>
                            <td width="30%">Tiba di</td>
                            <td>:</td>
                            <td width="60%"><?php echo $d['kota_tujuan']?></td>
                        </tr>
                        <tr>
                            <td width="10" >Pada tanggal</td>
                            <td width="2%">:</td>
                            <td width="80"><?php echo $d['tgl_sekarang']?></td>
                        </tr>
                        <tr>
                            <td width="10" ><br>Kepala</td>
                            <td width="2%"><br>:</td>
                            <td width="80"><br>................................................
                            <br><br><br>
                            <br>( <u>............................................</u> )
                            </td>
                        </tr>
                    </table>
                    </td>
                    <td width="55%">
                    <table width="100%">
                    <tr>
                    <td rowspan=4 width="3%"></td>
                    <td width="30%">Berangkat Dari</td>
                    <td>:</td>
                    <td width="60%"><?php echo $d['kota_tujuan']?></td></tr>
                    <tr>
                    <td width="10" >Ke</td>
                        <td width="2%">:</td>
                        <td width="80"><?php echo $d['kota_asal']?></td>
                    </tr>
                    <tr>
                    <td width="10" >Pada Tanggal</td>
                        <td width="2%">:</td>
                        <td width="80"><?php echo $d['tgl_sekarang']?></td>
                    </tr>
                    <tr>
                    <td width="10" >Kepala</td>
                    <td width="2%">:</td>
                    <td width="80">................................................
                    <br><br><br>
                    <br>( <u>............................................</u> )
                    </td>
                    </tr>
                    </table>
                    </td>
                    </tr>
                    
                    <tr>
                    <td width="5%">III.</td>
                    <td width="45%">
                    <table width="100%">
                    <tr>
                    <td width="30%">Tiba di</td>
                    <td>:</td>
                    <td width="60%">................................................</td></tr>
                    <tr>
                    <td width="10" >Pada tanggal</td>
                        <td width="2%">:</td>
                        <td width="80">................................................</td>
                    </tr>
                    <tr>
                    <td width="10" ><br>Kepala</td>
                    <td width="2%"><br>:</td>
                    <td width="80"><br>................................................
                    <br><br><br>
                    <br>( <u>............................................</u> )
                    </td>
                    </tr>
                    </table>
                    </td>
                    <td width="55%">
                    <table width="100%">
                    <tr>
                    <td rowspan=4 width="3%"></td>
                    <td width="30%">Berangkat Dari</td>
                    <td>:</td>
                    <td width="60%">................................................</td></tr>
                    <tr>
                    <td width="10" >Ke</td>
                        <td width="2%">:</td>
                        <td width="80">................................................</td>
                    </tr>
                    <tr>
                    <td width="10" >Pada Tanggal</td>
                        <td width="2%">:</td>
                        <td width="80">................................................</td>
                    </tr>
                    <tr>
                    <td width="10" >Kepala</td>
                    <td width="2%">:</td>
                    <td width="80">................................................
                    <br><br><br>
                    <br>( <u>............................................</u> )
                    </td>
                    </tr>
                    </table>
                    </td>
                    </tr>
                    
                    <tr>
                    <td width="5%">IV.</td>
                    <td width="45%">
                    <table width="100%">
                    <tr>
                    <td width="30%">Tiba di</td>
                    <td>:</td>
                    <td width="60%">................................................</td></tr>
                    <tr>
                    <td width="10" >Pada tanggal</td>
                        <td width="2%">:</td>
                        <td width="80">................................................</td>
                    </tr>
                    <tr>
                    <td width="10" ><br>Kepala</td>
                    <td width="2%"><br>:</td>
                    <td width="80"><br>................................................
                    <br><br><br>
                    <br>( <u>............................................</u> )
                    </td>
                    </tr>
                    </table>
                    </td>
                    <td width="55%">
                    <table width="100%">
                    <tr>
                    <td rowspan=4 width="3%"></td>
                    <td width="30%">Berangkat Dari</td>
                    <td>:</td>
                    <td width="60%">................................................</td></tr>
                    <tr>
                    <td width="10" >Ke</td>
                        <td width="2%">:</td>
                        <td width="80">................................................</td>
                    </tr>
                    <tr>
                    <td width="10" >Pada Tanggal</td>
                        <td width="2%">:</td>
                        <td width="80">................................................</td>
                    </tr>
                    <tr>
                    <td width="10" >Kepala</td>
                    <td width="2%">:</td>
                    <td width="80">................................................
                    <br><br><br>
                    <br>( <u>............................................</u> )
                    </td>
                    </tr>
                    </table>
                    </td>
                    </tr>
                    
                    <tr>
                    <td width="5%">V.</td>
                    <td width="45%">
                    <table width="100%">
                    <tr>
                    <td width="40%">Tiba Kembali tgl</td>
                    <td>:</td>
                    <td width="60%"><?php echo $d['tgl_sekarang']?></td></tr>
                    <tr>
                    <td width="10" >Tempat kedudukan</td>
                        <td width="2%">:</td>
                        <td width="80"><?php echo $d['kota_asal']?></td>
                    </tr>
                    <tr>
                        <td colspan='3' align='center'><br><br><br><br>PENGGUNA ANGGARAN<br><br><br><br><br></td>
                        
                    </tr>
                    <tr>
                        <td colspan='3' align='center'><b><u style=" padding-bottom:2px;
  text-decoration:none;
  border-bottom:1px solid #000;">H.Akbar</u></b></td>                       
                    </tr>
                    <tr>
                        <td colspan='3' align='center'>NIP. 12345</b></td>                       
                    </tr>
                    
                    </table>
                    </td>
                    <td width="55%">
                    <table width="100%">
                    
                    <tr>
                        <td width="3%"></td>
                        <td width="97%" align='justify'>Telah diperiksa dengan keterangan bahwa perjalanan tersebut diatas benar dilakukan atas perintahnya dan semata-mata untuk kepentingan jabatan dalam waktu yang sesingkat-singkatnya</td>
                    </tr>
                    <tr>
                        <td></td>
                        <td align='center'><br><br>PENGGUNA ANGGARAN<br><br><br><br><br></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td align='center'><b><u style=" padding-bottom:2px;
  text-decoration:none;
  border-bottom:1px solid #000;">H. Akbar</u></b></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td align='center'>NIP.124</b></td>
                    </tr>
                    
                    </table>
                    </td>
                    </tr>
                    <tr>
                    <td width="5%">VI.</td>
                    <td><table width="100%" border="0" cellspacing="0" cellpadding="0" rules="rows">
                    
                    <tr>
                        <td colspan='2' align='left'>CATATAN LAIN-LAIN</td>
                    </tr>                   
                </table>
                    </td>
                    <td><table width="100%" border="0" cellspacing="0" cellpadding="0" rules="rows">
                    
                    <tr>
                        <td width="5%"></td>
                        <td colspan='2' align='left'></td>
                    </tr>                   
                </table>
                    </td>
                    </tr>
                    
                    <tr border='1'></tr>
                </table>
                <table width="100%" border="0" cellspacing="0" cellpadding="0" rules="rows">
                    
                    <tr>
                        <td width="5%">VII. </td>
                        <td colspan='2' align='justify'>PERHATIAN <br> Pejabat yang berwenang menerbitkan SPPD, pegawai yang melakukan perjalanan dinas, para pejabat yang mengesahkan tanggal berangkat/tiba serta Bendaharawan bertanggung jawab berdasarkan peraturan-peraturan Keuangan Negara apabila Negara mendapat rugi akibat kesalahan, kealpaannya (angka 8  lampiran Surat Menteri Keuangan tanggal 30 April 1974 No. B-296/MK/1/4/1974)</td>
                    </tr>
                </table>

<?php
}


//=================================== SPPD BELAKANG ================================================
else if ($page=="cetak_biaya_riil")
{
?> 
<table class="cetak_judul" align="center">
        <tr><td td rowspan="4"><img src="<?php echo base_url('assets/imgs/logo_poliban.png');?>" width="70px"></td>
            <td align="center"><strong>KEMENTERIAN RISET, TEKNOLOGI, DAN PENDIDIKAN TINGGI<strong></td></tr>
            <td align="center"><strong>POLITEKNIK NEGERI BANJARMASIN<strong></td></tr>
        <tr><td align="center">Jl.Brigjen Hasan Basri Kampus UNLAM - Banjarmasin Kodepos: 70123</td></tr>
        <tr><td align="center">Telp: 0511-3305052, email: poliban@poliban.ac.id</td></tr>
    </table>
    <hr>    
    <table width="100%" style="border: solid 0px black;">
                    
                     <tr>
                        <td align="center" colspan="4"><center><b><u><H3>DAFTAR PENGELUARAN RIIL</H3></u></b></center></td>
                    </tr>
                    <tr>
                        <td colspan="4"><br><br><br><br>Yang bertanda tangan dibawah ini :</td>
                    </tr>
                    <tr>
                        <td width="50px"></td>
                        <td width="100px">Nama</td>
                        <td width="15px">:</td>
                        <td><?php echo $d['nama_pengikut']?></td>
                    </tr>
                    <tr>
                        <td width="50px"></td>
                        <td width="100px">NIP</td>
                        <td width="15px">:</td>
                        <td><?php echo $d['nip']?></td>
                    </tr>
                    <tr>
                        <td width="50px"></td>
                        <td width="100px">Jabatan</td>
                        <td width="15px">:</td>
                        <td><?php echo $d['jabatan']?></td>
                    </tr>
                    <tr>
                        <td colspan="4"><br>Berdasarkan Surat Perintah Perjalanan Dinas (SPPD) Nomor : <?php echo $d['no_surat_tugas']?> tanggal <?php echo $d['tgl_surat']?> dengan ini kami menyatakan dengans sesungguhnya bahwa:</td>
                    </tr>
                    <tr>
                        <td colspan="4">1. Biaya transport pejabat/pegawai dan/atau biaya penginapan di bawah ini yang tidak dapat diperoleh bukti -bukti pengeluarannya, meliputi :</td>
                    </tr>
                    <tr>
                        <td colspan="4"><br>
                            <table style="border-collapse: collapse;" width="100%" >
                                <tr>
                                    <td width="5%" align="center" style="border: 1px solid black;">No.</td>
                                    <td width="65%" align="center" style="border: 1px solid black;">Uraian</td>
                                    <td width="35%" align="center" style="border: 1px solid black;">Jumlah</td>
                                </tr>
                                <tr>
                                    <td width="5%" align="center" style="border: 1px solid black;">1</td>
                                    <td width="65%" align="center" style="border: 1px solid black;">2</td>
                                    <td width="35%" align="center" style="border: 1px solid black;">3</td>
                                </tr>
                                
                                <tr>
                                    <td width="5%" align="center" style="border-left: 1px solid black;border-right: 1px solid black;">1.</td>
                                    <td width="65%" align="center" style="border-right: 1px solid black;" >Transport Taxi</td>
                                    <td width="35%" align="center" style="border-right: 1px solid black;"></td>
                                </tr>
                                
                                <tr>
                                    <td width="5%" align="center" style="border-left: 1px solid black; border-right: 1px solid black;">&nbsp;</td>
                                    <td width="65%" align="center" style="border-right: 1px solid black;">Tempat Kedudukan - Bandara(PP)</td>
                                    <td width="35%" align="center" style="border-right: 1px solid black;"><?php echo number_format($d['transport_2'],0,',','.').",-"?></td>
                                </tr>
                                <tr>
                                    <td width="5%" align="center" style="border-left: 1px solid black; border-right: 1px solid black;">&nbsp;</td>
                                    <td width="65%" align="center" style="border-right: 1px solid black;">Bandara - Tujuan(PP)</td>
                                    <td width="35%" align="center" style="border-right: 1px solid black;"><?php echo number_format($d['transport_3'],0,',','.').",-"?></td>
                                </tr>
                                <tr>
                                    <td width="5%" align="center" style="border: 1px solid black;">&nbsp;</td>
                                    <td width="65%" align="center" style="border: 1px solid black;">Total</td>
                                    <td width="35%" align="center" style="border: 1px solid black;">Rp.<?php echo number_format((($d['jml_hari_harian']*$d['uang_harian'])+$d['transport_1']+$d['transport_2']+$d['transport_3']+($d['jml_hari_penginapan']*$d['penginapan'])),0,',','.').",-"?></td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="4">2. Jumlah uang tersebut pada angka 1 diatas, benar-benar dikeluarkan untuk pelaksanaan Perjalanan Dinas dimaksud dan apabila dikemudian hari terdapat kelebihan atas pembayaran, kami bersedia untuk menyetor kelebihan tersebut ke Kas Daerah</td>
                    </tr>
                    <tr><td colspan="4"><br>Demikian pernyataan ini kami buat dengan sebenarnya, untuk dipergunakan sebagaimana mestinya.</td></tr>
                </table>
                <table width="100%">
                    <tr>
                        <td width="50%" style="padding-left: 20px">
                            Mengetahui / Menyetujui
                        </td>
                        <td width="50%" align="right" style="padding-right: 80px">
                            Banjarmasin,&nbsp; &nbsp;&nbsp; <?php echo $d['tgl_sekarang']?>
                        </td>
                    </tr>
                    <tr>
                        <td width="50%" style="padding-left: 20px">
                            Pejabat Pembuat Komitmen
                        </td>
                        <td width="50%" align="center">
                            
                        </td>
                    </tr>
                    <tr>
                        <td width="50%" style="padding-left: 20px">
                            <br><br><br><b><u style=" padding-bottom:2px;
  text-decoration:none;
  border-bottom:1px solid #000;"></u></b>
                        </td>
                        <td width="50%" align="center" ><br><br><br>
                            <b><u style=" padding-bottom:2px;
  text-decoration:none;
  border-bottom:1px solid #000;"><?php echo $d['nama_pengikut']?></u></b>
                        </td>
                    </tr>
                    <tr>
                        <td width="50%" style=" padding-left: 20px">
                            <b>NIP.123</b>
                        </td>
                        <td width="50%" align="center" >
                            NIP.<?php echo $d['nip']?>
                        </td>
                    </tr>

                </table>

<?php
}
?>