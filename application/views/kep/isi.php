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
      Admin Kepegawaian<small>Selamat datang kembali</small>
    </h1>
  </section>

  <section class="content">         <!-- Main content -->
    <div class="box">               <!-- Default box -->
      <div class="box-header with-border">
        <h3 class="box-title">Dasboard Kepegawaian</h3>
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
              <a href="<?php echo base_url('kep/surat_masuk');?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
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
              <a href="<?php echo base_url('kep/surat_tugas');?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
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
//------------------------------------- TAMBAH  ---------------------------------
else if ($page=="surat_masuk_tambah")
{
?> 
  <section class="content-header">
    <h1>TAMBAH SURAT MASUK</h1>
  </section>
  <section class="content">
    <div class="box">
      <?php echo form_open_multipart(base_url('kep/surat_masuk/tambah'), 'class="form-horizontal"'); ?>
         
        <div class="box-body">
          <row>
            <div class="col-md-12">
              <?php
              input_text('no_surat','Nomor Surat','Masukkan Nomor Surat'); 
              input_date('tgl_surat','Tanggal Surat','Masukkan Tanggal Surat'); 
              input_textarea('perihal','Perihal','Masukkan Perihal'); 
              input_text('dari','Dari','Dari'); 
              input_text('kepada','Kepada','Kepada'); 
              input_textarea('deskripsi','Deskripsi','Deskripsi'); 
              input_file('nama_file', "File Undangan (Format jpg/PDF, maks 5Mb)");
                ?>
            </div>
          </row>
        </div>  <!-- box-body -->
        <div class="box-footer">
          <a href="<?php echo base_url('kep/surat_masuk'); ?>" class="btn btn-default">Cancel</a>
          <button type="submit" class="btn btn-info pull-right" data-toggle="modal" data-target="#modal-default" >Simpan</button>

        </div>         
      </form>
    </div>    <!-- box -->
  </section>
<?php 
}

//------------------------------------- EDIT ---------------------------------
else if ($page=="surat_masuk_edit")
{
?> 
  <section class="content-header">
    <h1>EDIT DATA SURAT MASUK </h1>
  </section>
  <section class="content">
    <div class="box">
      <?php echo form_open_multipart(base_url('kep/surat_masuk/edit/') . $id, 'class="form-horizontal"'); ?>
      <?php echo form_hidden('old_nama_file', $old_nama_file) ?>         
        <div class="box-body">
          <row>
            <div class="col-md-12">
              <?php
              input_text('id_surat_undangan','Id Surat','',$d['id_surat_undangan'],'r'); 
              input_text('no_surat','Nomor Surat','Masukkan Nomor Surat',$d['no_surat']); 
              input_date('tgl_surat','Tanggal Surat','MAsukkan Tanggal Surat',$d['tgl_surat']); 
              input_textarea('perihal','Perihal','Masukkan Perihal',$d['perihal']); 
              input_text('dari','Dari','Dari',$d['dari']); 
              input_text('kepada','Kepada','Kepada',$d['kepada']); 
              input_textarea('deskripsi','Deskripsi','Deskripsi',$d['deskripsi']); 
              input_file("nama_file", "File Undangan (Format jpg/PDF, maks 5Mb)", $d['nama_file'], base_url('kep/surat_masuk/hapus_file/' . $d['id_surat_undangan']));              
              ?>
            </div>
          </row>
        </div>  <!-- box-body -->
        <div class="box-footer">
          <a href="<?php echo base_url('kep/surat_masuk'); ?>" class="btn btn-default">Cancel</a>
          <button type="submit" class="btn btn-info pull-right">Simpan</button>
        </div>         
      </form>
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
              <th>Id Ttd</th>
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
//------------------------------------- TAMBAH   ---------------------------------
else if ($page=="surat_tugas_tambah")
{
?> 
  <section class="content-header">
    <h1>TAMBAH SURAT TUGAS</h1>
  </section>
  <section class="content">
    <div class="box">
      <form method=POST action="<?php echo base_url('kep/surat_tugas/tambah');?>"  class="form-horizontal"
        enctype="multipart/form-data">         
        <div class="box-body">
          <row>
            <div class="col-md-12">
              <?php
              input_pd("id_surat_undangan","Pilih Surat Undangan",$surat_m,'def'); 
              input_text('no_surat_tugas','Nomor Surat Tugas','Masukkan Nomor Surat'); 
              input_date('tgl_surat_tugas','Tanggal Surat Tugas','Masukkan Tanggal Surat'); 
              input_text('tempat','Tempat','Tempat'); 
              input_date('tgl_awal','Tanggal Awal','Masukkan Tanggal Awal'); 
              input_date('tgl_akhir','Tanggal Akhir','Masukkan Tanggal Akhir'); 
              input_pd("id_kota_asal","Pilih Kota Asal",$kota_asal,'def'); 
              input_text('kt_asal','Kota Asal','Nama Tempat Kota Asal'); 
              input_pd("id_kota_tujuan","Pilih Kota Tujuan",$kota_tujuan,'def'); 
              input_text('kt_tujuan','Kota tujuan','Nama Tempat Kota Tujuan'); 
              input_text('id_ttd','ID TDD','ID TDD'); 
              input_textarea('kegiatan','Kegiatan','Masukkan Kegiatan'); 
              input_textarea('tembusan','Tembusan','Tembusan'); 
              input_file('nama_file', "File Tugas  (Format jpg/PDF, maks 5Mb)");              
              ?>
            </div>
          </row>
        </div>  <!-- box-body -->
        <div class="box-footer">
          <a href="<?php echo base_url('kep/surat_tugas'); ?>" class="btn btn-default">Cancel</a>
          <button type="submit" class="btn btn-info pull-right" data-toggle="modal" data-target="#modal-default" >Simpan</button>

        </div>         
      </form>
    </div>    <!-- box -->
  </section>
<?php 
}

//------------------------------------- EDIT  ---------------------------------
else if ($page=="surat_tugas_edit")
{
?> 
  <section class="content-header">
    <h1>EDIT DATA SURAT MASUK </h1>
  </section>
  <section class="content">
    <div class="box">
      <form method=POST action="<?php echo base_url('kep/surat_tugas/edit/').$id;?>"  class="form-horizontal"
        enctype="multipart/form-data">         
        <div class="box-body">
          <row>
            <div class="col-md-12">
              <?php
              input_text('id_surat_tugas','Id Surat','',$d['id_surat_tugas'],'r'); 
              input_pd('id_surat_undangan','Id Surat',$surat_m,$d['id_surat_undangan']); 
              input_text('no_surat_tugas','Nomor Surat','Masukkan Nomor Surat',$d['no_surat_tugas']); 
              input_date('tgl_surat_tugas','Tanggal Surat','Masukkan Tanggal Surat',$d['tgl_surat_tugas']); 
              input_text('tempat','Tempat','Tempat',$d['tempat']);
              input_date('tgl_awal','Tanggal Awal','Masukkan Tanggal Awal',$d['tgl_awal']); 
              input_date('tgl_akhir','Tanggal Akhir','Masukkan Tanggal Akhir',$d['tgl_akhir']); 
              input_pd("id_kota_asal","Pilih Kota Asal",$kota_asal,$d['id_kota_asal']); 
              input_text('kt_asal','Kota Asal','Nama Tempat Kota Asal',$d['kt_asal']); 
              input_pd("id_kota_tujuan","Pilih Kota Tujuan",$kota_tujuan,$d['id_kota_tujuan']); 
              input_text('kt_tujuan','Kota Tujuan','Nama Tempat Kota tujuan',$d['kt_tujuan']); 
              input_text('id_ttd','ID TDD','ID TDD',$d['id_ttd']); 
              input_textarea('kegiatan','Kegiatan','Masukkan Kegiatan',$d['kegiatan']); 
              input_textarea('tembusan','Tembusan','Tembusan',$d['tembusan']); 
              input_file("nama_file", "File Undangan (Format jpg/PDF, maks 5Mb)", $d['nama_file'], base_url('kep/surat_tugas/hapus_file/' . $d['id_surat_tugas']));                            
              ?>
            </div>
          </row>
        </div>  <!-- box-body -->
        <div class="box-footer">
          <a href="<?php echo base_url('kep/surat_masuk'); ?>" class="btn btn-default">Cancel</a>
          <button type="submit" class="btn btn-info pull-right">Simpan</button>
        </div>         
      </form>
    </div>    <!-- box -->
  </section>
<?php
}
//---------------------------------- PENAMBAHAN PENGIKUT   ---------------------------------
else if ($page=="surat_tugas_pengikut")
{
?> 
  <section class="content">
    <div class="box">
      <div class="box-header with-border">
        <h3 class="box-title">Data Penambahan Pengikut Perjalanan Dinas</h3>

        <div class="box-tools pull-right">
          <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                  title="Collapse">
            <i class="fa fa-minus"></i></button>
          <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
            <i class="fa fa-times"></i></button>
        </div>
      </div>

      <div class="box-body">
        <row>
          <div class="col-sm-3">
            <dl class="dl-horizontal">
              <dt>Surat Tugas</dt>
              <dd><?php echo $d['no_surat_tugas']?></dd>
              <dt>Tanggal</dt>
              <dd><?php echo $d['tgl_surat_tugas']?></dd>
            </dl>
          </div>  
          <div class="col-sm-9">
            <dl class="dl-horizontal">            
              <dt>Tempat</dt>
              <dd><?php echo $d['tempat']?></dd>
              <dt>Kagiatan</dt>
              <dd><?php echo $d['kegiatan']?></dd>
            </dl>
          </div>
        </dl>
        </row>
     </div>
    </div>  
    <form method="POST" action="<?php echo base_url('kep/surat_tugas_pengikut/tambah/').$id_surat_tugas;?>"  class="form-horizontal ">         
    <div class="box">
      <div class="box-body">
            <input type="hidden" name="id_surat_tugas" value="<?php echo $id_surat_tugas?>" >
              <?php input_text('nama_pengikut','Nama Pelaksana Perjadin','Ketikkan Nama');
              input_text('label_id','Kode','');
              input_text('id','id',''); 
              input_text('pangkat_gol','Pangkat Gol',''); 
              ?>
     </div>
        <div class="box-footer">
          <a href="<?php echo base_url('kep/surat_tugas'); ?>" class="btn btn-default">Cancel</a>
          <button type="submit" class="btn btn-info pull-right" data-toggle="modal" data-target="#modal-default" >Tambah</button>
        </div>         

    </div>  
    </form>

    <div class="box">
      <div class="box-body">
        <table id="dttb" width="100%" class="table table-bordered table-striped table-hover">
          <thead>
            <tr>
              <th>Id</th>
              <th>Kode</th>
              <th>Nik/Nim</th>
              <th>Nama</th>
              <th>Pangkat/Gol</th>
              <th>Aksi</th>
              <th>Aksi</th>
           </tr>
          </thead>
          <tbody>
          </tbody>
        </table> 
      </div>  <!-- box-body -->
    </div>    <!-- box -->
  </section>
  <style type="text/css">
    .autocomplete-suggestions { border: 1px solid #999; background: #FFF; overflow: auto; }
    .autocomplete-suggestion { padding: 2px 5px; white-space: nowrap; overflow: hidden; }
    .autocomplete-selected { background: #F0F0F0; }
    .autocomplete-suggestions strong { font-weight: normal; color: #3399FF; }
    .autocomplete-group { padding: 2px 5px; }
    .autocomplete-group strong { display: block; border-bottom: 1px solid #000; }  
  </style>

<?php 
}

//---------------------------------- PENAMBAHAN PENGIKUT   ---------------------------------
else if ($page=="surat_tugas_pengikut_edit")
{
?> 
  <section class="content">
    <div class="box">
      <div class="box-header with-border">
        <h3 class="box-title">EDIT Data Penambahan Pengikut Perjalanan Dinas</h3>

        <div class="box-tools pull-right">
          <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                  title="Collapse">
            <i class="fa fa-minus"></i></button>
          <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
            <i class="fa fa-times"></i></button>
        </div>
      </div>

      <div class="box-body">
        <row>
          <div class="col-sm-3">
            <dl class="dl-horizontal">
              <dt>Surat Tugas</dt>
              <dd><?php echo $d['no_surat_tugas']?></dd>
              <dt>Tanggal</dt>
              <dd><?php echo $d['tgl_surat_tugas']?></dd>
            </dl>
          </div>  
          <div class="col-sm-9">
            <dl class="dl-horizontal">            
              <dt>Tempat</dt>
              <dd><?php echo $d['tempat']?></dd>
              <dt>Kagiatan</dt>
              <dd><?php echo $d['kegiatan']?></dd>
            </dl>
          </div>
        </dl>
        </row>
     </div>
    </div>  

    <form method="POST" action="<?php echo base_url('kep/surat_tugas_pengikut/edit/').$id_surat_tugas."/".$p['id_pengikut'];?>"  class="form-horizontal ">         
    <div class="box">
      <div class="box-body">
            <input type="hidden" name="id_surat_tugas" value="<?php echo $id_surat_tugas?>" >
              <?php input_text('nama_pengikut','Nama Pengikut','Ketikkan Nama',$p['nama_pengikut']);
              input_text('label_id','Kode','',$p['label_id']);
              input_text('id','id','',$p['id']); 
              input_text('pangkat_gol','Pangkat Gol','',$p['pangkat_gol']); 
              ?>
     </div>
        <div class="box-footer">
          <a href="<?php echo base_url('kep/surat_tugas'); ?>" class="btn btn-default">Cancel</a>
          <button type="submit" class="btn btn-info pull-right" data-toggle="modal" data-target="#modal-default" >Tambah</button>
        </div>         

    </div>  
    </form>

    <div class="box">
      <div class="box-body">
        <table id="dttb" width="100%" class="table table-bordered table-striped table-hover">
          <thead>
            <tr>
              <th>Kode</th>
              <th>Nik/Nim</th>
              <th>Nama</th>
              <th>Pangkat/Gol</th>
              <th>Aksi</th>
           </tr>
          </thead>
          <tbody>
          </tbody>
        </table> 
      </div>  <!-- box-body -->
    </div>    <!-- box -->
  </section>
  <style type="text/css">
    .autocomplete-suggestions { border: 1px solid #999; background: #FFF; overflow: auto; }
    .autocomplete-suggestion { padding: 2px 5px; white-space: nowrap; overflow: hidden; }
    .autocomplete-selected { background: #F0F0F0; }
    .autocomplete-suggestions strong { font-weight: normal; color: #3399FF; }
    .autocomplete-group { padding: 2px 5px; }
    .autocomplete-group strong { display: block; border-bottom: 1px solid #000; }  
  </style>

<?php 
}


?>