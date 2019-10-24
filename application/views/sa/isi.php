<?php
// General Datatables CRUD Daftarkan disini
$isi=array();


//=================================== H O M E ================================================
if ($page=="home")
{
?> 
  <section class="content-header">
    <h1>
      Super Administrator<small>selamat datang kembali</small>
    </h1>
  </section>

  <section class="content">         <!-- Main content -->
    <div class="box">               <!-- Default box -->
      <div class="box-header with-border">
        <h3 class="box-title">Dasboard SIMRS</h3>
        <div class="box-tools pull-right">
          <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
              <i class="fa fa-minus"></i></button>
          <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
              <i class="fa fa-times"></i></button>
        </div>
      </div>

      <div class="box-body">  
        <div class="row">
          <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-aqua">
              <div class="inner">
                <h3><?php echo number_format("$jlm_mhs",0,",","."); ?></h3>
                <p>Jumlah Mahasiswa</p>
              </div>
              <div class="icon">
                <i class="ion ion-calendar"></i>
              </div>
              <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-green">
              <div class="inner">
                <h3><?php echo number_format("$jlm_pegawai",0,",","."); ?></h3>
                <p>Jumlah Pegawai</p>
              </div>
              <div class="icon">
                <i class="ion ion-stats-bars"></i>
              </div>
              <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-yellow">
              <div class="inner">
                <h3><?php echo number_format("$jlm_kelas",0,",","."); ?></h3>
                <p>Jumah Kelas</p>
              </div>
              <div class="icon">
                <i class="ion ion-person-add"></i>
              </div>
              <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-red">
              <div class="inner">
                <h3><?php echo $jlm_user; ?></h3>
                <p>Jumlah User</p>
              </div>
              <div class="icon">
                <i class="ion ion-pie-graph"></i>
              </div>
              <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
            </div>
          </div>    <!-- ./col -->
        </div>      <!-- ROW -->


      </div>    <!-- /.box-body -->

      <div class="box-footer">

      </div>    <!-- /.box-footer-->

    </div>      <!-- Default box -->
  </section>    <!-- /.content -->

<?php
}

//=========================================================================================
//======================================== A K A D E M I K ================================
//======================================== Tahun akademik =================================
else if ($page=="ak_thn_ak") 
{
?>
  <section class="content-header">
    <h1>Data Tahun Akademik</h1>
  </section>
  <section class="content">
    <div class="box">
      <div class="box-body">
        <table id="dttb" width="100%" class="table table-bordered table-striped table-hover">
          <thead>
            <tr>
              <th>Id Thn Akademik</th>
              <th>Nama Tahun Akademik</th>
              <th>Catatan</th>
              <th>Aktif</th>
              <th>lastaccess</th>
           </tr>
          </thead>
          <tbody>
          </tbody>
        </table> 
      </div>  <!-- box-body -->
    </div>    <!-- box -->
  </section>
<?php 
}
//------------------------------------- TAMBAH Tahun Akademik  ---------------------------------
else if ($page=="ak_thn_ak_tambah")
{
?> 
  <section class="content-header">
    <h1>TAMBAH TAHUN AKADEMIK</h1>
  </section>
  <section class="content">
    <div class="box">
      <form method=POST action="<?php echo base_url('sa/ak_thn_ak/tambah');?>"  class="form-horizontal">         
        <div class="box-body">
          <row>
            <div class="col-md-12">
              <?php
              input_text('id_thn_ak','Masukkan ID Tahun Akademik','contoh 20191'); 
              input_text('nama_thn_ak','Masukkan Nama Tahun Ak','contoh 2019-2020 Ganjil'); 
              input_text('catatan','Catatan','Tambahkan Catatan bila perlu'); 
              // radio  nama var,  Caption, isi array
              input_radio('aktif','Aktif',$statusaktif);
              ?>
            </div>
          </row>
        </div>  <!-- box-body -->
        <div class="box-footer">
          <a href="<?php echo base_url('sa/ak_thn_ak'); ?>" class="btn btn-default">Cancel</a>
          <button type="submit" class="btn btn-info pull-right" data-toggle="modal" data-target="#modal-default" >Simpan</button>

        </div>         
      </form>
    </div>    <!-- box -->
  </section>
<?php 
}

//------------------------------------- EDIT Tahun Akademik  ---------------------------------
else if ($page=="ak_thn_ak_edit")
{
?> 
  <section class="content-header">
    <h1>EDIT DATA TAHUN AKADEMIK </h1>
  </section>
  <section class="content">
    <div class="box">
      <form method=POST action="<?php echo base_url('sa/ak_thn_ak/edit/').$id;?>"  class="form-horizontal">         
        <div class="box-body">
          <row>
            <div class="col-md-12">
              <?php
              input_text('id_thn_ak','Masukkan ID Tahun Akademik','contoh 20191',$d['id_thn_ak'],'r'); 
              input_text('nama_thn_ak','Masukkan Nama Tahun Ak','contoh 2019-2020 Ganjil',$d['nama_thn_ak']); 
              input_text('catatan','Catatan','Tambahkan Catatan bila perlu',$d['catatan']); 
              // radio  nama var,  Caption, isi array
              input_radio('aktif','Aktif',$statusaktif,$d['aktif']);
              ?>
            </div>
          </row>
        </div>  <!-- box-body -->
        <div class="box-footer">
          <a href="<?php echo base_url('sa/ak_thn_ak'); ?>" class="btn btn-default">Cancel</a>
          <button type="submit" class="btn btn-info pull-right">Simpan</button>
        </div>         
      </form>
    </div>    <!-- box -->
  </section>

<?php
}

//======================================== K E L A S  ========================================
else if ($page=="ak_kelas") 
{
?>
 <section class="content-header">
    <h1>Data Kelas</h1>
  </section>
  <section class="content">
    <div class="box">
      <div class="box-body">
        <table id="dttb" width="100%" class="table table-bordered table-striped table-hover">
          <thead>
            <tr>
              <th>id kelas</th>
              <th>id thn ak</th>
              <th>nama prodi</th>
              <th>smt</th>
              <th>nama kelas</th>
              <th>alias kelas</th>
              <th>program kelas</th>
              <th>ket</th>
            </tr>
          </thead>
          <tbody>
          </tbody>
        </table> 
      </div>  <!-- box-body -->
    </div>    <!-- box -->
  </section>
<?php
}
//---------------------------------------- Kelas Tambah ---------------------------------
else if ($page=="ak_kelas_tambah") 
{
?>

  <section class="content-header"><h1>Tambah kelas </h1></section>
  <section class="content">
    <div class="box box-info">
      
      <form method=POST action="<?php echo base_url('sa/ak_kelas/tambah');?>"  class="form-horizontal">
        <div class="box-body">
          <div class="row">
            <div class="col-md-12">

              <?php
               input_pd("id_thn_ak","Pilih Tahun Ak",$thn_ak); 
               input_pd("id_prodi","Pilih Prodi",$prodi);
               input_text("smt","Semester","Masukkan Semester");              
               input_text("nama_kelas","Nama Kelas","Masukkan Nama Kelas");             
               input_text("alias","Alias Kelas","Masukkan Alias Kelas");           
               input_pd("id_program_kelas","Pilih Program Kelas",$program_kelas); 
               input_text("ket","Keterangan","Masukkan Keterangan");           
              ?>
        
            </div>
            </div>
          </div>
            <!-- /.box-body -->
        <div class="box-footer">
          <a href="<?php echo base_url('sa/ak_kelas'); ?>" class="btn btn-default">Cancel</a>
          <button type="submit" class="btn btn-default">Cancel</button>
          <button type="submit" class="btn btn-info pull-right">Simpan</button>
        </div>
        <!-- /.box-footer -->
      </form>
    </div>
  </section>
<?php 
}

//---------------------------------------- Kelas Edit ---------------------------------
else if ($page=="ak_kelas_edit") 
{
?>

  <section class="content-header"><h1>Edit Jurusan </h1></section>
  <section class="content">
    <div class="box box-info">
      <form method=POST action="<?php echo base_url('sa/ak_kelas/edit');?>"  class="form-horizontal">
        <div class="box-body">
          <div class="row">
            <div class="col-md-12">
              <?php
               input_text('id_kelas','Id Kelas','',$d['id_kelas'],'r');              
               input_pd('id_thn_ak','Pilih Tahun Ak',$thn_ak,$d['id_thn_ak']); 
               input_pd('id_prodi','Pilih Prodi',$prodi,$d['id_prodi']);
               input_text('smt','Semester','Masukkan Semester',$d['smt']);              
               input_text('nama_kelas','Nama Kelas','Masukkan Nama Kelas',$d['nama_kelas']);             
               input_text('alias','Alias Kelas','Masukkan Alias Kelas',$d['alias']);           
               input_pd('id_program_kelas','Pilih Program Kelas',$program_kelas,$d['id_program_kelas']); 
               input_text('ket','Keterangan','Masukkan Keterangan',$d['ket']);  
            ?>
            </div>
            </div>
          </div>
            <!-- /.box-body -->
        <div class="box-footer">
          <a href="<?php echo base_url('sa/ak_kelas'); ?>" class="btn btn-default">Cancel</a>
          <button type="submit" class="btn btn-info pull-right">Simpan</button>
        </div>
        <!-- /.box-footer -->
      </form>
    </div>
  </section>
<?php 
}

//======================================== RANGE NILAI ================================
else if ($page=="ak_range") 
{
?>
  <section class="content-header">
    <h1>Data Range Nilai</h1>
  </section>
  <section class="content">
    <div class="box">
      <div class="box-body">
        <table id="dttb" width="100%" class="table table-bordered table-striped table-hover">
          <thead>
            <tr>
              <th>Id Angka Huruf</th>
              <th>Id Tahun Akademik</th>
              <th>Nilai</th>
              <th>Huruf</th>
           </tr>
          </thead>
          <tbody>
          </tbody>
        </table> 
      </div>  <!-- box-body -->
    </div>    <!-- box -->
  </section>
<?php 
}
//------------------------------------- TAMBAH Range Nilai   ---------------------------------
else if ($page=="ak_range_tambah")
{
?> 
  <section class="content-header">
    <h1>TAMBAH RANGE NILAI</h1>
  </section>
  <section class="content">
    <div class="box">
      <form method=POST action="<?php echo base_url('sa/ak_range/tambah');?>"  class="form-horizontal">         
        <div class="box-body">
          <row>
            <div class="col-md-12">
              <?php
              input_pd("id_thn_ak","Pilih Tahun Ak",$thn_ak); 
              input_text('nilai','Masukkan Nilai Range','Contoh 80.53 (koma menggunakan titik)'); 
              input_text('huruf','Masukkan Huruf Range','Contoh A ');
              ?>
            </div>
          </row>
        </div>  <!-- box-body -->
        <div class="box-footer">
          <a href="<?php echo base_url('sa/ak_range'); ?>" class="btn btn-default">Cancel</a>
          <button type="submit" class="btn btn-info pull-right" data-toggle="modal" data-target="#modal-default" >Simpan</button>

        </div>         
      </form>
    </div>    <!-- box -->
  </section>
<?php 
}
//------------------------------------- EDIT Range Nilai  ---------------------------------
else if ($page=="ak_range_edit")
{
?> 
  <section class="content-header">
    <h1>EDIT DATA RANGE NILAI  </h1>
  </section>
  <section class="content">
    <div class="box">
      <form method=POST action="<?php echo base_url('sa/ak_range/edit/').$id;?>"  class="form-horizontal">         
        <div class="box-body">
          <row>
            <div class="col-md-12">
              <?php
              input_text('id_angka_huruf','Range','',$d['id_angka_huruf']); 
              input_pd("id_thn_ak","Pilih Tahun Ak",$thn_ak,$d['id_thn_ak']); 
              input_text('nilai','Masukkan Nilai Range','Contoh 80.53 (koma menggunakan titik)',$d['nilai']); 
              input_text('huruf','Masukkan Huruf Range','Contoh A ',$d['huruf']); 
              ?>
            </div>
          </row>
        </div>  <!-- box-body -->
        <div class="box-footer">
          <a href="<?php echo base_url('sa/ak_range'); ?>" class="btn btn-default">Cancel</a>
          <button type="submit" class="btn btn-info pull-right">Simpan</button>
        </div>         
      </form>
    </div>    <!-- box -->
  </section>
<?php
}

//======================================== REGISTRASI ================================
else if ($page=="ak_registrasi") 
{
?>
  <section class="content-header">
    <h1>Data Registrasi beserta Peserta Kelas</h1>
  </section>
  <section class="content">
    <div class="box">
      <div class="box-body">
        <table id="dttb" width="100%" class="table table-bordered table-striped table-hover">
          <thead>
            <tr>
              <th>id Reg</th>
              <th>id thn ak</th>
              <th>nama prodi</th>
              <th>smt</th>
              <th>nama kelas</th>
              <th>nim</th>
              <th>status spp</th>
              <th>jumlah spp</th>
              <th>status mhs</th>
            </tr>
          </thead>
          <tbody>
          </tbody>
        </table> 
      </div>  <!-- box-body -->
    </div>    <!-- box -->
  </section>
<?php 
}
//------------------------------------- TAMBAH  Registrasi   ---------------------------------
else if ($page=="ak_registrasi_tambah")
{
?> 
  <section class="content-header">
    <h1>REGISTRASI MAHASISWA</h1>
  </section>
  <section class="content">
    <div class="box">
      <form method=POST action="<?php echo base_url('sa/ak_registrasi/tambah');?>"  class="form-horizontal">         
        <div class="box-body">
          <row>
            <div class="col-md-12">
              <?php
               input_pd("id_thn_ak","Pilih Tahun Ak",$thn_ak); 
               input_pd("id_prodi","Pilih Prodi",$prodi);
               input_text("smt","Semester","Masukkan Semester");              
               input_text("nama_kelas","Nama Kelas","Masukkan Nama Kelas");             
               input_pd("nim","Pilih nim",$nim_reges);          
               input_pd("id_status_spp","Pilih Status SPP",$status_spp); 
               input_pd("id_kategori_spp","Pilih Kategori SPP",$kategori); 
               input_pd("id_status_aktifitas_mhs","Pilih Status Mhs",$status);  
         
              ?>
            </div>
          </row>
        </div>  <!-- box-body -->
        <div class="box-footer">
          <a href="<?php echo base_url('sa/ak_registrasi'); ?>" class="btn btn-default">Cancel</a>
          <button type="submit" class="btn btn-info pull-right" data-toggle="modal" data-target="#modal-default" >Simpan</button>

        </div>         
      </form>
    </div>    <!-- box -->
  </section>
<?php 
}
//------------------------------------- EDIT Registrasi  ---------------------------------
else if ($page=="ak_registrasi_edit")
{
?> 
  <section class="content-header">
    <h1>EDIT DATA REGESTRASI  </h1>
  </section>
  <section class="content">
    <div class="box">
      <form method=POST action="<?php echo base_url('sa/ak_registrasi/edit/').$id;?>"  class="form-horizontal">         
        <div class="box-body">
          <row>
            <div class="col-md-12">
              <?php
               input_text('id_registrasi_mhs','Id Reges','',$d['id_registrasi_mhs'],'r');              
               input_pd("id_thn_ak","Pilih Tahun Ak",$thn_ak,$d['id_thn_ak']); 
               input_pd("id_prodi","Pilih Prodi",$prodi,$d['id_prodi']);
               input_text("smt","Semester","Masukkan Semester",$d['smt']);              
               input_text("nama_kelas","Nama Kelas","Masukkan Nama Kelas",$d['nama_kelas']);             
               input_pd("nim","Pilih Prodi",$nim_reges,$d['nim']);          
               input_pd("id_status_spp","Pilih Status SPP",$status_spp,$d['id_status_spp']); 
               input_pd("id_kategori_spp","Pilih Kategori SPP",$kategori,$d['id_kategori_spp']); 
               input_pd("id_status_aktifitas_mhs","Pilih Status Mhs",$status,$d['id_status_aktifitas_mhs']);  
        ?>
            </div>
          </row>
        </div>  <!-- box-body -->
        <div class="box-footer">
          <a href="<?php echo base_url('sa/ak_registrasi'); ?>" class="btn btn-default">Cancel</a>
          <button type="submit" class="btn btn-info pull-right">Simpan</button>
        </div>         
      </form>
    </div>    <!-- box -->
  </section>

<?php
}

//======================================== Kurikulum ========================================
else if ($page=="ak_kurikulum") 
{
?>
  <section class="content-header">
    <h1>Data Kurikulum</h1>
  </section>
  <section class="content">
    <div class="box">
      <div class="box-body">
        <table id="dttb" width="100%" class="table table-bordered table-striped table-hover">
          <thead>
            <tr>
              <th>Id Kurikulum</th>
              <th>Nama MK</th>
              <th>Id Thn Ak</th>
              <th>Prodi</th>
            </tr>
          </thead>
          <tbody>
          </tbody>
        </table> 
      </div>  <!-- box-body -->
    </div>    <!-- box -->
  </section>
<?php 
}
//------------------------------------- TAMBAH  Kurikulum   ---------------------------------
else if ($page=="ak_kurikulum_tambah")
{
?> 
  <section class="content-header">
    <h1>Tambah Kurikulum</h1>
  </section>
  <section class="content">
    <div class="box">
      <form method=POST action="<?php echo base_url('sa/ak_kurikulum/tambah');?>"  class="form-horizontal">         
        <div class="box-body">
          <row>
            <div class="col-md-12">
              <?php
               input_pd("id_mk","Pilih MataKuliah",$mk); 
               input_pd("id_thn_ak","Pilih Tahun Ak",$thn_ak); 
               
              ?>
            </div>
          </row>
        </div>  <!-- box-body -->
        <div class="box-footer">
          <a href="<?php echo base_url('sa/ak_kurikulum'); ?>" class="btn btn-default">Cancel</a>
          <button type="submit" class="btn btn-info pull-right" data-toggle="modal" data-target="#modal-default" >Simpan</button>

        </div>         
      </form>
    </div>    <!-- box -->
  </section>
<?php 
}
//------------------------------------- EDIT Kurikulum  ---------------------------------
else if ($page=="ak_kurikulum_edit")
{
?> 
  <section class="content-header">
    <h1>EDIT DATA KURIKULUM  </h1>
  </section>
  <section class="content">
    <div class="box">
      <form method=POST action="<?php echo base_url('sa/ak_kurikulum/edit/').$id;?>"  class="form-horizontal">         
        <div class="box-body">
          <row>
            <div class="col-md-12">
              <?php
               input_text('id_kurikulum','Id Kurikulum','',$d['id_kurikulum'],'r');              
               input_pd("id_mk","Pilih MataKuliah",$mk,$d['id_mk']); 
               input_pd("id_thn_ak","Pilih Tahun Ak",$thn_ak,$d['id_thn_ak']); 
               ?>
            </div>
          </row>
        </div>  <!-- box-body -->
        <div class="box-footer">
          <a href="<?php echo base_url('sa/ak_kurikulum'); ?>" class="btn btn-default">Cancel</a>
          <button type="submit" class="btn btn-info pull-right">Simpan</button>
        </div>         
      </form>
    </div>    <!-- box -->
  </section>
<?php
}

//---------------------------------------- Perkuliahan ---------------------------------
else if ($page=="ak_kuliah") 
{
?>
  <section class="content-header">
    <h1>Data Perkuliahan</h1>
  </section>
  <section class="content">
    <div class="box">
      <div class="box-body">
        <table id="dttb" width="100%" class="table table-bordered table-striped table-hover">
          <thead>
            <tr>
              <th>Id Perkuliahan</th>
              <th>Nama Kelas</th>
              <th>Nama MK</th>
              <th>Dosen</th>
              <th>Ruang</th>
              <th>Pembagi</th>
            </tr>
          </thead>
          <tbody>
          </tbody>
        </table> 
      </div>  <!-- box-body -->
    </div>    <!-- box -->
  </section>
<?php 
}

//------------------------------------- TAMBAH  Perkuliahan   ---------------------------------
else if ($page=="ak_kuliah_tambah")
{
?> 
  <section class="content-header">
    <h1>Tambah Perkuliahan</h1>
  </section>
  <section class="content">
    <div class="box">
      <form method=POST action="<?php echo base_url('sa/ak_kuliah/tambah');?>"  class="form-horizontal">         
        <div class="box-body">
          <row>
            <div class="col-md-12">
              <?php
               input_pd("id_kelas","Pilih Kelas",$kelas); 
               input_pd("id_kurikulum","Pilih Kurikulum",$kurikulum); 
               input_pd("id_pegawai","Pilih Pegawai",$pengajar); 
               input_pd("id_ruang","Pilih Ruang",$ruang); 
               input_text("pembagi","Pembagi","Masukkan Jumlah Pertemuan");              
               
              ?>
            </div>
          </row>
        </div>  <!-- box-body -->
        <div class="box-footer">
          <a href="<?php echo base_url('sa/ak_kuliah'); ?>" class="btn btn-default">Cancel</a>
          <button type="submit" class="btn btn-info pull-right" data-toggle="modal" data-target="#modal-default" >Simpan</button>

        </div>         
      </form>
    </div>    <!-- box -->
  </section>
<?php 
}

//------------------------------------- EDIT Perkuliahan  ---------------------------------
else if ($page=="ak_kuliah_edit")
{
?> 
  <section class="content-header">
    <h1>EDIT DATA Perkuliahan  </h1>
  </section>
  <section class="content">
    <div class="box">
      <form method=POST action="<?php echo base_url('sa/ak_kuliah/edit/').$id;?>"  class="form-horizontal">         
        <div class="box-body">
          <row>
            <div class="col-md-12">
              <?php
               input_text('id_perkuliahan','Id Perkuliahan','',$d['id_perkuliahan'],'r');              
               input_pd("id_kelas","Pilih Kelas",$kelas,$d['id_kelas']); 
               input_pd("id_kurikulum","Pilih Kurikulum",$kurikulum,$d['id_kurikulum']); 
               input_pd("id_pegawai","Pilih Pegawai",$pengajar,$d['id_pegawai']); 
               input_pd("id_ruang","Pilih Ruang",$ruang,$d['id_ruang']); 
               input_text("pembagi","Pembagi","Masukkan Jumlah Pertemuan",$d['pembagi']);              
               ?>
            </div>
          </row>
        </div>  <!-- box-body -->
        <div class="box-footer">
          <a href="<?php echo base_url('sa/ak_kuliah'); ?>" class="btn btn-default">Cancel</a>
          <button type="submit" class="btn btn-info pull-right">Simpan</button>
        </div>         
      </form>
    </div>    <!-- box -->
  </section>

<?php
}


//======================================== U S E R ========================================
else if ($page=="user") 
{
?>
 <section class="content-header">
    <h1>Data User</h1>
  </section>
  <section class="content">
    <div class="box">
      <div class="box-body">
        <table id="dttb" width="100%" class="table table-bordered table-striped table-hover">
          <thead>
            <tr>
              <th>id user</th>
              <th>level</th>
              <th>username</th>
              <th>ref user</th>
              <th>nama</th>
              <th>Ket</th>
            </tr>
          </thead>
          <tbody>
          </tbody>
        </table> 
      </div>  <!-- box-body -->
    </div>    <!-- box -->
  </section>
<?php
}
// ---------------------------------------------------------
else if ($page=="user_tambah") 
{
?>

  <section class="content-header"><h1>Tambah USER admin </h1></section>
  <section class="content">
    <div class="box box-info">
      <?php 
      // echo form_open('sa/user/tambah',' class="form-horizontal" ');
      ?>
      <form method=POST action="<?php echo base_url('sa/user/tambah');?>"  class="form-horizontal">
        <div class="box-body">
          <div class="row">
            <div class="col-md-12">

              <?php input_text("username","Username","username admin"); ?>              
              <?php input_text("password","Password","isikan password"); ?>             
              <?php input_pd("id_level","Pilih Level",$level,$id_level); ?>
              <?php input_pd("ref_user","Pilih User",$pegawai,$ref_user); ?>
              <?php input_text("ket","Keterangan","Input Keterangan"); ?>              

            </div>
            </div>
          </div>
            <!-- /.box-body -->
        <div class="box-footer">
          <button type="submit" class="btn btn-default">Cancel</button>
          <button type="submit" class="btn btn-info pull-right">Simpan</button>
        </div>
        <!-- /.box-footer -->
      </form>
    </div>
  </section>
<?php 
}

// ---------------------------------------------------------
else if ($page=="user_edit") 
{
?>

  <section class="content-header"><h1>Edit USER admin </h1></section>
  <section class="content">
    <div class="box box-info">
      <?php 
      // echo form_open('sa/user/tambah',' class="form-horizontal" ');
      ?>
      <form method=POST action="<?php echo base_url('sa/user/edit');?>"  class="form-horizontal">
        <div class="box-body">
          <div class="row">
            <div class="col-md-12">

              <?php input_text("id_user","Id User","",$d['id_user'],"readonly"); ?>              
              <?php input_text("username","Username","username admin",$d['username']); ?>              
              <?php input_text("password","Password","Jangan di Isi jika tetap",$d['password']); ?>               
              <?php input_pd("id_level","Pilih Level",$level,$d['id_level']); ?>
              <?php input_pd("ref_user","Pilih User",$pegawai,$d['ref_user']); ?>
              <?php input_text("ket","Keterangan","Input Keterangan",$d['ket']); ?>                            

            </div>
            </div>
          </div>
            <!-- /.box-body -->
        <div class="box-footer">
          <button type="submit" class="btn btn-default">Cancel</button>
          <button type="submit" class="btn btn-info pull-right">Simpan</button>
        </div>
        <!-- /.box-footer -->
      </form>
    </div>
  </section>


<?php 
}

//======================================== J U R U S A N  ========================================
else if ($page=="dm_jurusan") 
{
?>
 <section class="content-header">
    <h1>Data Jurusan</h1>
  </section>
  <section class="content">
    <div class="box">
      <div class="box-body">
        <table id="dttb" width="100%" class="table table-bordered table-striped table-hover">
          <thead>
            <tr>
              <th>id jurusan</th>
              <th>nama jurusan </th>
              <th>kajur</th>
              <th>sekjur</th>
            </tr>
          </thead>
          <tbody>
          </tbody>
        </table> 
      </div>  <!-- box-body -->
    </div>    <!-- box -->
  </section>
<?php
}
// ---------------------------------------------------------
else if ($page=="dm_jurusan_tambah") 
{
?>

  <section class="content-header"><h1>Tambah Jurusan </h1></section>
  <section class="content">
    <div class="box box-info">
      
      <form method=POST action="<?php echo base_url('sa/dm_jurusan/tambah');?>"  class="form-horizontal">
        <div class="box-body">
          <div class="row">
            <div class="col-md-12">

              <?php input_text("nama_jurusan","Nama Jurusan","Masukkan Jurusan",$nama_jurusan); ?>              
			  <?php input_pd("id_kajur","Pilih Kajur",$kajur,$id_kajur); ?>
              <?php input_pd("id_sekjur","Pilih Sekjur",$sekjur,$id_sekjur); ?>
              

            </div>
            </div>
          </div>
            <!-- /.box-body -->
        <div class="box-footer">
          <button type="submit" class="btn btn-default">Cancel</button>
          <button type="submit" class="btn btn-info pull-right">Simpan</button>
        </div>
        <!-- /.box-footer -->
      </form>
    </div>
  </section>
<?php 
}

// ---------------------------------------------------------
else if ($page=="dm_jurusan_edit") 
{
?>

  <section class="content-header"><h1>Edit Jurusan </h1></section>
  <section class="content">
    <div class="box box-info">
      <form method=POST action="<?php echo base_url('sa/dm_jurusan/edit');?>"  class="form-horizontal">
        <div class="box-body">
          <div class="row">
            <div class="col-md-12">

              <?php input_text("id_jurusan","Id Jurusan","",$id_jurusan,"readonly"); ?>              
              <?php input_text("nama_jurusan","Nama Jurusan","Masukkan Jurusan",$nama_jurusan); ?>              
			  <?php input_pd("id_kajur","Pilih Kajur",$kajur,$id_kajur); ?>
              <?php input_pd("id_sekjur","Pilih Sekjur",$sekjur,$id_sekjur); ?>
              
            </div>
            </div>
          </div>
            <!-- /.box-body -->
        <div class="box-footer">
          <button type="submit" class="btn btn-default">Cancel</button>
          <button type="submit" class="btn btn-info pull-right">Simpan</button>
        </div>
        <!-- /.box-footer -->
      </form>
    </div>
  </section>


<?php 
}

//======================================== P R O D I  ========================================
else if ($page=="dm_prodi") 
{
?>
 <section class="content-header">
    <h1>Data Prodi</h1>
  </section>
  <section class="content">
    <div class="box">
      <div class="box-body">
        <table id="dttb" width="100%" class="table table-bordered table-striped table-hover">
          <thead>
            <tr>
              <th>id prodi</th>
              <th>kode prodi</th>
              <th>nama jurusan</th>
              <th>nama prodi</th>
              <th>kaprodi</th>
              <th>jenjang</th>
              <th>akreditasi</th>
              <th>no sk dikti</th>
              <th>tgl sk</th>
              <th>no sk ban</th>
            </tr>
          </thead>
          <tbody>
          </tbody>
        </table> 
      </div>  <!-- box-body -->
    </div>    <!-- box -->
  </section>
<?php
}
// ---------------------------------------------------------
else if ($page=="dm_prodi_tambah") 
{
?>

  <section class="content-header"><h1>Tambah Jurusan </h1></section>
  <section class="content">
    <div class="box box-info">
      
      <form method=POST action="<?php echo base_url('sa/jurusan/tambah');?>"  class="form-horizontal">
        <div class="box-body">
          <div class="row">
            <div class="col-md-12">

              <?php input_text("nama_jurusan","Nama Jurusan","Masukkan Jurusan",$nama_jurusan); ?>              
			  <?php input_pd("id_kajur","Pilih Kajur",$kajur,$id_kajur); ?>
              <?php input_pd("id_sekjur","Pilih Sekjur",$sekjur,$id_sekjur); ?>
              

            </div>
            </div>
          </div>
            <!-- /.box-body -->
        <div class="box-footer">
          <button type="submit" class="btn btn-default">Cancel</button>
          <button type="submit" class="btn btn-info pull-right">Simpan</button>
        </div>
        <!-- /.box-footer -->
      </form>
    </div>
  </section>
<?php 
}

// ---------------------------------------------------------
else if ($page=="dm_prodi_edit") 
{
?>

  <section class="content-header"><h1>Edit Jurusan </h1></section>
  <section class="content">
    <div class="box box-info">
      <form method=POST action="<?php echo base_url('sa/jurusan/edit');?>"  class="form-horizontal">
        <div class="box-body">
          <div class="row">
            <div class="col-md-12">

              <?php input_text("id_jurusan","Id Jurusan","",$id_jurusan,"readonly"); ?>              
              <?php input_text("nama_jurusan","Nama Jurusan","Masukkan Jurusan",$nama_jurusan); ?>              
			  <?php input_pd("id_kajur","Pilih Kajur",$kajur,$id_kajur); ?>
              <?php input_pd("id_sekjur","Pilih Sekjur",$sekjur,$id_sekjur); ?>
              
            </div>
            </div>
          </div>
            <!-- /.box-body -->
        <div class="box-footer">
          <button type="submit" class="btn btn-default">Cancel</button>
          <button type="submit" class="btn btn-info pull-right">Simpan</button>
        </div>
        <!-- /.box-footer -->
      </form>
    </div>
  </section>


<?php 
}

	
//======================================== W I L A Y A H ========================================
else if ($page=="wilayah_gabung") 
{
?>
  <section class="content-header">
    <h1>Data Wilayah Indonesia</h1>
  </section>
  <section class="content">
    <div class="box">
      <div class="box-body">
        <table id="dttb" width="100%" class="table table-bordered table-striped table-hover">
          <thead>
            <tr>
              <th>id Kel</th>
              <th>Kelurahan</th>
              <th>Kecamatan</th>
              <th>Kabupaten</th>
              <th>Provinsi</th>
            </tr>
          </thead>
          <tbody>
          </tbody>
        </table> 
      </div>  <!-- box-body -->
    </div>    <!-- box -->
  </section>
<?php
}

// ======================================================================================
// ----------------------------- FORM TAMBAH UNIVERSAL CRUD -----------------------------
// ======================================================================================
else if ($page=="tambah") 
{
?>
  <section class="content-header">
    <h1>Tambah Data  <?php echo ucwords($control); ?></h1>
    <?php 
      for($i=0;$i<sizeof($kolom);$i++)
      {
       $dt[$i]=$kolom[$i];
      }
    ?>
  </section>
  <section class="content">
    <div class="box">
      <div class="box-body">

        <?php echo form_open('sa/'.$control.'/tambah','class="form-horizontal" '); ?>
          <div class="box-body">

          <?php 
          for($i=0;$i<sizeof($kolom);$i++)
            {
              if($i==0){
                $r= "readonly";
              }else{
                $r="";
              }
              echo "<div class='form-group'>
              <label for=". $dt[$i] ." class='col-sm-2 control-label'>". ucwords(str_replace('_',' ',$dt[$i])). "</label>
              <div class='col-sm-10'>
                <input type='text' class='form-control' name=". $dt[$i] ." id=". $dt[$i] ." 
                    placeholder=". ucwords(str_replace('_',' ',$dt[$i])) ." ".$r.">
                ".form_error($dt[$i])."
              </div>
            </div>";
            }
          ?>
          
          </div>
          <div class="box-footer">
            <button type="reset" class="btn btn-default">Reset</button>
            <button type="submit" class="btn btn-info pull-right">Simpan</button>
          </div>
        </form>
      </div>    <!-- Box Body -->
    </div>    <!-- Box -->
  </section>
<?php
}

// ----------------------------- FORM EDIT UNIVERSAL CRUD -----------------------------
else if ($page=="edit") 
{
?>
  <section class="content-header">
    <h1>Edit Data  <?php echo ucwords($control); ?></h1>
    <?php 
      for($i=0;$i<sizeof($kolom);$i++)
      {
       $dt[$i]=$kolom[$i];
      }
    ?>
  </section>
  <section class="content">
    <div class="box">
      <div class="box-body">

        <?php echo form_open('sa/'.$control.'/edit/'.$id.'','class="form-horizontal" '); ?>
          <div class="box-body">

          <?php 
      for($i=0;$i<sizeof($kolom);$i++)
      {
        if($i==0){
          $r= "readonly";
        }else{
          $r="";
        }
           echo" <div class='form-group'>
              <label for=". $dt[$i]." class='col-sm-2 control-label'>".ucwords(str_replace('_',' ',$dt[$i]))."</label>
              <div class='col-sm-10'>
                <input type='text' class='form-control' name=".$dt[$i]." id=".$dt[$i]." 
                    placeholder=". ucwords(str_replace('_',' ',$dt[$i]))."
                    value='".$d[$kolom[$i]]."'  ".$r.">
                ".form_error($dt[$i])."
              </div>
            </div>";
      }?>
          </div>
          <div class="box-footer">
            <button type="reset" class="btn btn-default">Reset</button>
            <button type="submit" class="btn btn-info pull-right">Simpan</button>
          </div>
        </form>
      </div>
    </div>
  </section>
<?php
}

//=======================================================================================
else // General DataTabel Tables for VIEW Only.
//---------------------------------------------------------------------------------------
{
?>
  <section class="content-header">
    <h1>Data <?php echo ucwords(str_replace('_',' ',$page)); ?></h1>
  </section>
  <section class="content">
    <div class="box">
      <div class="box-body">
        <table id="dttb" width="100%" class="table table-bordered table-striped table-hover" >
          <thead>
            <tr>
            <?php
            for($i=0;$i<sizeof($kolom);$i++)
            {
             echo "<th>". ucwords(str_replace('_',' ',$kolom[$i]))."</th>";
            }
            ?>
            </tr>
          </thead>
          <tbody>
          </tbody>
        </table> 
      </div>  <!-- box-body -->
    </div>    <!-- box -->
  </section>
<?php
}

?>

