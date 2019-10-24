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
  <link rel="stylesheet" href="<?php echo base_url();?>assets/admin_lte/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.standalone.css">

    <!-- DataTables -->
    <link rel="stylesheet" href="<?php echo base_url();?>assets/datatables/datatables.min.css">
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
  <!-- ============================= LOGO GANTI SESUAI LOGIN ========================== -->
      <a href="<?php echo base_url();?>kep/" class="logo">
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
        <!-- ============================= GANTI SESUAI LOGIN ========================== -->
          <p>Admin Kepegawaian</p>
        <!-- --------------------------------------------------------------------------- -->
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>
      <div class="user-panel">
        <a><?php echo $page;?></a>
      </div>
      <!-- sidebar menu: : style can be found in sidebar.less -->

      <!-- Mulai sebuah Blok Menu -->
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header">MENU UTAMA</li>
        
        <li class="<?php cek_aktif($page,'home');?>">
          <a href="<?php echo base_url('kep');?>">
            <i class="fa fa-dashboard"></i> <span>Dashboard</span>
          </a>
        </li>
        <li class="<?php cek_aktif($page,'surat_masuk');?>">
          <a href="<?php echo base_url('kep/surat_masuk');?>">
            <i class="fa fa-files-o"></i> <span>Surat Masuk</span>
          </a>
        </li>
		    <li class="<?php cek_aktif($page,'surat_tugas');?>">
          <a href="<?php echo base_url('kep/surat_tugas');?>">
            <i class="fa fa-list-alt"></i> <span>Surat Tugas</span>
          </a>
        </li>

        <!-- --------------- end menu --------------- -->
      </ul>



      </ul>


    </section>
    <!-- /.sidebar -->
  </aside>

    <!-- =============================================== -->

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
