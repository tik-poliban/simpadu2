<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <link rel="icon" href="<?php echo base_url();?>assets/imgs/favicon.ico">
  <title>Simpadu | POLIBAN</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="<?php echo base_url();?>assets/admin_lte/bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?php echo base_url();?>assets/admin_lte/bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="<?php echo base_url();?>assets/admin_lte/bower_components/Ionicons/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo base_url();?>assets/admin_lte/dist/css/AdminLTE.min.css">
  <link rel="stylesheet" href="<?php echo base_url();?>assets/admin_lte/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.standalone.css">
    <!-- DataTables -->
    <link rel="stylesheet" href="<?php echo base_url();?>assets/datatables/dataTables.min.css">
    <link rel="stylesheet" href="<?php echo base_url();?>assets/datatables/Buttons-1.5.6/css/buttons.dataTables.min.css">

  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <!-- <link rel="stylesheet" href="<?php echo base_url();?>assets/admin_lte/dist/css/skins/_all-skins.min.css"> -->
  <link rel="stylesheet" href="<?php echo base_url();?>assets/admin_lte/dist/css/skins/skin-blue.min.css">  <!-- Ganti skin ganti css ini dan di body -->
  <link rel="stylesheet" href="<?php echo base_url();?>assets/css/sa.css">
  
  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>


<body class="hold-transition skin-blue sidebar-mini"> <!-- Sesuaikan css skin diatas -->

  <!-- Site wrapper -->
  <div class="wrapper">

  <header class="main-header">
    <!-- Logo -->
      <a href="<?php echo base_url();?>sa/" class="logo">
        <!-- mini logo for sidebar mini 50x50 pixels -->
        <span class="logo-mini"><b>S</b>iP</span>
        <!-- logo for regular state and mobile devices -->
        <span class="logo-lg"><b>SIMPADU</b> Poliban</span>
      </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </a>

      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <!-- User Account: style can be found in dropdown.less -->
          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <?php
              //--------------- Menampilkan foto Icon dan nama di kanan atas -------------------
                // $pegawai=$this->m_umum->ambil_data('simpeg_pegawai','id_pegawai',$_SESSION['ref_user']);
                $pegawai=$this->m_umum->ambil_data('simpeg_pegawai','id_pegawai',$_SESSION['ref_user']);
                $cek_file=FCPATH.'assets/foto/peg/thumb/'.$pegawai['id_pegawai'].'.jpg';
                if(file_exists($cek_file))
                  $url_file=base_url().'assets/foto/peg/thumb/'.$pegawai['id_pegawai'].'.jpg';
                else
                  $url_file=base_url().'assets/foto/peg/no_foto.jpg';
              ?>
              <img src="<?php echo $url_file; ?>" class="user-image" alt="User Image">
              <span class="hidden-xs">
                <?php
                    echo $pegawai['nama_pegawai'];
                ?>
              </span>
            </a>
            <ul class="dropdown-menu">
              <!--    Menampilkan foto dan nama di kanan Saat dropdown  -->
              <li class="user-header">
                <img src="<?php echo $url_file; ?>" class="img-circle" alt="User Image">
                <p><?php echo $pegawai['nama_pegawai']; ?>
                </p>
              </li>

              <!-- Menu Footer-->
              <li class="user-footer">
                <div class="pull-left">
                  <a href="#" class="btn btn-default btn-flat">Profile</a>
                </div>
                <div class="pull-right">
                  <a href="<?php echo base_url('logout');?>" class="btn btn-default btn-flat">Sign out</a>
                </div>
              </li>
            </ul>
          </li>

        </ul>
      </div>
    </nav>
  </header>

    <!-- ================================================================================= -->
  
<?php 
//=================== Coding Aktifkan Menu saat terpilih ==================
function cek_aktif($page,$alamat) //Untuk Aktikfan ROOT menu dan Sub Menu
{
  $status=FALSE;
  if (is_array($alamat)){
    foreach ($alamat as $d) {
      if( ($page==$d) || ($page==$d.'_tambah') || ($page==$d.'_edit') ) 
        $status=TRUE; 
    }
  }
  else{
    if( ($page==$alamat) || ($page==$alamat.'_tambah') || ($page==$alamat.'_edit') ) 
      $status=TRUE; 
  }
  if($status) 
    echo "active";
  else
    echo "" ;
}

?>
    <!-- Left side column. contains the sidebar -->

  <!-- Left side column. contains the sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="<?php echo base_url(); ?>/assets/imgs/logo_poliban.png" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p>Admin Prodi</p>
          <p><?php echo $this->session->userdata('nama_prodi');?></p>          
        </div>
      </div>
      <div class="user-panel">
        <a><?php echo $page;?></a>
      </div>
      <!-- sidebar menu: : style can be found in sidebar.less -->

      <!-- ================== Mulai sebuah Blok Menu ==================  -->
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header">MENU UTAMA</li>
        
        <li class="<?php cek_aktif($page,'home');?>">
          <a href="<?php echo base_url('prodi');?>">
            <i class="fa fa-dashboard"></i> <span>Dashboard</span>
          </a>
        </li>

        <!-- --------------- Akademik --------------- -->
        <li class="treeview 
          <?php cek_aktif($page,array('ak_thn_ak','ak_kelas','ak_range','ak_registrasi','ak_kurikulum','ak_kuliah')); ?>
        ">
          <a href="#">
            <i class="fa fa-pencil"></i> <span>Akademik</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li class="<?php cek_aktif($page,'ak_thn_ak');?>"><a href="<?php echo base_url('prodi/ak_thn_ak');?>"><i class="fa fa-square-o"></i>Tahun Akademik</a></li>
            <li class="<?php cek_aktif($page,'ak_kelas');?>"><a href="<?php echo base_url('prodi/ak_kelas');?>"><i class="fa fa-square-o"></i>Kelas</a></li>
            <li class="<?php cek_aktif($page,'ak_range');?>"><a href="<?php echo base_url('prodi/ak_range');?>"><i class="fa fa-square-o"></i>Range Nilai</a></li>
            <li class="<?php cek_aktif($page,'ak_registrasi');?>"><a href="<?php echo base_url('prodi/ak_registrasi');?>"><i class="fa fa-square-o"></i>Registrasi</a></li>
            <li class="<?php cek_aktif($page,'ak_kurikulum');?>"><a href="<?php echo base_url('prodi/ak_kurikulum');?>"><i class="fa fa-square-o"></i>Kurikulum</a></li>
            <li class="<?php cek_aktif($page,'ak_kuliah');?>"><a href="<?php echo base_url('prodi/ak_kuliah');?>"><i class="fa fa-square-o"></i>Perkuliahan</a></li>

          </ul>
        </li>

        <!-- --------------- end menu --------------- -->
      </ul>

    </section>
    <!-- /.sidebar -->
  </aside>

    <!-- =============================================== -->

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
