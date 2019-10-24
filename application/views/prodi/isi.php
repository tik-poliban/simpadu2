<?php
// General Datatables CRUD Daftarkan disini
$isi=array();


//=================================== H O M E ================================================
if ($page=="home")
{
?> 
  <section class="content-header">
    <h1>
      Admin Prodi <?php echo $this->session->userdata('nama_prodi');?>
      <small>selamat datang kembali</small>
    </h1>
  </section>

  <section class="content">         <!-- Main content -->
    <div class="box">               <!-- Default box -->
      <div class="box-header with-border">
        <h3 class="box-title">Dasboard Prodi</h3>
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

//======================================== K E L A S  ========================================
else if ($page=="ak_kelas") 
{
?>
 <section class="content-header">
    <h1>Data Kelas <?php echo $this->session->userdata('nama_prodi');?></h1>
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
  <section class="content-header">
    <h1>Tambah kelas 
    <small><?php echo $this->session->userdata('nama_prodi');?></small>
    </h1>
  </section>
  <section class="content">
    <div class="box box-info">
      
      <form method=POST action="<?php echo base_url('prodi/ak_kelas/tambah');?>"  class="form-horizontal">
        <div class="box-body">
          <div class="row">
            <div class="col-md-12">

            <?php
              echo form_hidden('id_prodi',$this->session->userdata('id_level'));
              input_text('id_thn_ak','Tahun Ak','',$thn_ak_aktif,'r'); 
              input_text("nama_kelas","Nama Kelas","Masukkan Nama Kelas");             
              input_radio('smt','Semester',$semester);              
              input_text("alias","Alias Kelas","Masukkan Alias Kelas");           
              input_pd("id_program_kelas","Pilih Program Kelas",$program_kelas); 
              input_text("ket","Keterangan","Masukkan Keterangan");           
             ?>
        
            </div>
            </div>
          </div>
            <!-- /.box-body -->
        <div class="box-footer">
          <a href="<?php echo base_url('prodi/ak_kelas'); ?>" class="btn btn-default">Cancel</a>
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

  <section class="content-header">
    <h1>Edit Jurusan     
      <small><?php echo $this->session->userdata('nama_prodi');?></small>
    </h1>
  </section>
  <section class="content">
    <div class="box box-info">
      <form method=POST action="<?php echo base_url('prodi/ak_kelas/edit');?>"  class="form-horizontal">
        <div class="box-body">
          <div class="row">
            <div class="col-md-12">
              <?php
              input_text('id_kelas','Id Kelas','',$d['id_kelas'],'r');
              echo form_hidden('id_prodi',$this->session->userdata('id_level'));
              input_pd('id_thn_ak','Pilih Tahun Ak',$thn_ak,$d['id_thn_ak']);
              input_text('nama_kelas','Nama Kelas','Masukkan Nama Kelas',$d['nama_kelas']);             
              input_radio('smt','Semester',$semester,$d['smt']);
              input_text('alias','Alias Kelas','Masukkan Alias Kelas',$d['alias']);           
              input_pd('id_program_kelas','Pilih Program Kelas',$program_kelas,$d['id_program_kelas']); 
              input_text('ket','Keterangan','Masukkan Keterangan',$d['ket']);  
            ?>            
            </div>
          </div>
        </div>
            <!-- /.box-body -->
        <div class="box-footer">
          <a href="<?php echo base_url('prodi/ak_kelas'); ?>" class="btn btn-default">Cancel</a>
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
      <?php
        input_pd('id_thn_ak','Pilih Tahun Ak',$thn_ak);
      ?>
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


?>