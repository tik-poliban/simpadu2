<?php
// General Datatables CRUD Daftarkan disini
$isi=array();


//=================================== H O M E ================================================
if ($page=="home")
{
?> 
  <section class="content-header">
    <h1>
      <!-- ============================= GANTI SESUAI LOGIN ========================== -->
      Admin Keuangan<small>Selamat datang kembali</small>
    </h1>
  </section>

  <section class="content">         <!-- Main content -->
    <div class="box">               <!-- Default box -->
      <div class="box-header with-border">
        <h3 class="box-title">Dasboard Keuangan</h3>
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
                <h3><?php echo number_format("$jlm_surat_masuk",0,",","."); ?></h3>
                <p>Jumlah Surat Masuk</p>
              </div>
              <div class="icon">
                <i class="ion ion-calendar"></i>
              </div>
              <a href="<?php echo base_url('keu/surat_masuk');?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-red">
              <div class="inner">
                <h3><?php echo number_format("$jlm_surat_tugas",0,",","."); ?></h3>
                <p>Jumlah Surat Tugas</p>
              </div>
              <div class="icon">
                <i class="ion ion-stats-bars"></i>
              </div>
              <a href="<?php echo base_url('keu/surat_tugas');?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
            </div>
          </div>
        </div>      <!-- ROW -->

      </div>    <!-- /.box-body -->

      <div class="box-footer">

      </div>    <!-- /.box-footer-->

    </div>      <!-- Default box -->
  </section>    <!-- /.content -->


<?php
}

//=============================== S U R A T  M A S U K ===============================
//------------------------------------------------------------------------------------
else if ($page=="surat_masuk") 
{
?>
  <section class="content-header">
    <h1>Data Surat Masuk</h1>
  </section>
  <section class="content">
    <div class="box">
      <div class="box-body">
        <table id="dttb" width="100%" class="table table-bordered table-striped table-hover">
          <thead>
            <tr>
              <th>Id</th>
              <th>Nomor Surat</th>
              <th>Tanggal</th>
              <th>Perihal</th>
              <th>Pengirim</th>
              <th>Penerima</th>
              <th>Nama File</th>              
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
//=============================== S U R A T  T U G A S ===============================
//------------------------------------------------------------------------------------
else if ($page=="surat_tugas") 
{
?>
  <section class="content-header">
    <h1>Data Surat Tugas</h1>
  </section>
  <section class="content">
    <div class="box">
      <div class="box-body">
        <table id="dttb" width="100%" class="table table-bordered table-striped table-hover">
          <thead>
            <tr>
              <th></th>              
              <th>Id</th>
              <th>Surat Undangan</th>
              <th>Nomor Surat Tugas</th>
              <th>Tgl Surat Tugas</th>
              <th>Tempat</th>
              <th>Tgl Awal</th>
              <th>Tgl Akhir</th>
              <th>Kota Asal</th>
              <th>Kota Tujuan</th>
              <th>Jenis</th>
              <th>Nama File</th>              
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
else if ($page=="surat_tugas_edit") 
{
?>

  <section class="content-header"><h1>Proses Jenis Surat Tugas </h1></section>
  <section class="content">
    <div class="box box-info">
      <form method=POST action="<?php echo base_url('keu/surat_tugas/edit');?>"  class="form-horizontal">
        <div class="box-body">
          <div class="row">
            <div class="col-md-12">

              <?php input_text("id_surat_tugas","Id Surat Tugas","",$id_surat_tugas,"readonly"); 

              ?>              
               <?php input_pd("id_jenis","Pilih Jenis Surat",$jenis,$id_jenis); ?>
              
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
else if ($page=="pengikut") 
{
?>
  <table class="table">
    <tr><th>label</th><th>NIK/NIM</th><th>Nama</th><th>Pangkat/Gol</th></tr>
    <?php foreach ($dt as $d) { ?>
      <tr> 
        <td> <?php echo $d['no'];?></td>   
        <td> <?php echo $d['label_id'];?></td>   
        <td> <?php echo $d['id'];?></td>   
        <td> <?php echo $d['nama_pengikut'];?></td>   
        <td> <?php echo $d['pangkat_gol'];?></td>   
      </tr>
    <?php } ?>
  </table>
<?php
}


//=============================== PROSES PERJALANAN DINAS ===============================
//------------------------------------------------------------------------------------
else if ($page=="proses_jaldis") 
{
?>
  <section class="content-header">
    <h1>Proses Perjalanan Dinas</h1>
  </section>
  <section class="content">
    <div class="box">
      <div class="box-body">
        <table id="dttb" width="100%" class="table table-bordered table-striped table-hover">
          <thead>
            <tr>
              <th>Id</th>   
              <th>Jenis Surat</th>   
              <th>No Surat Tugas</th>
              <th>Nama Pengikut</th>
              <th>Pangkat</th>
              <th>Jml Hari</th>
              <th>Jml Uang Harian</th>
              <th>Transport 1</th>
              <th>Transport 2</th>
              <th>Transport 3</th>
              <th>Jml Hari Penginapan</th>
              <th>Uang Penginapan</th>
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
else if ($page=="proses_jaldis_edit") 
{
?>

  <section class="content-header"><h1>Proses Jenis Surat Tugas </h1></section>
  <section class="content">
    <div class="box box-info">
      <form method=POST action="<?php echo base_url('keu/proses_jaldis/edit');?>"  class="form-horizontal">
        <div class="box-body">
          <div class="row">
            <div class="col-md-12">

        <?php input_text("id_pengikut","Id Pengikut","",$d['id_pengikut'],"readonly"); ?>              
        <?php input_text("nama_pengikut","Nama Pengikut","",$d['nama_pengikut'],"readonly"); ?>              
        <?php input_text("pangkat_gol","Pangkat Golongan","",$d['pangkat_gol'],"readonly"); ?>              
        <?php input_number("jml_hari_harian","Jumlah Hari","Masukkan Jumlah Hari",$jml_hari); ?>              
			  <?php input_text("uang_harian","Uang Harian","Masukkan Uang Harian",$uangharian,"readonly"); ?>              
			  <?php input_text("transport_1","Transport 1","Masukkan Uang Transport 1",$uang_transport1,"readonly"); ?>              
			  <?php input_text("transport_2","Transport 2","Masukkan Uang Transport 2",$d['transport_2']); ?>              
			  <?php input_text("transport_3","Transport 3","Masukkan Uang Transport 3",$uang_transport3,"readonly"); ?>              
			  <?php input_number("jml_hari_penginapan","Jumlah Hari Menginap","Masukkan Jumlah Hari Menginap",$d['jml_hari_penginapan']); ?>              
			  <?php input_text("penginapan","Uang Penginapan","Masukkan Uang Penginapan",'0',"readonly"); ?>
              
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
//================================= MODAL ==========================
?>
<div class="modal fade" id="modal-default">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">INFO</h4>
      </div>
      <div class="modal-body">
        <p>One fine body&hellip;</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
        <!-- <button type="button" class="btn btn-primary">Save changes</button> -->
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>