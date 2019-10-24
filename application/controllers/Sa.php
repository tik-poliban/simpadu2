<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sa extends CI_Controller 
{
  public function __construct()
  {
          parent::__construct();
          $this->login_kah();	//Memastikan hanya yang sudah login dapat akses fungsi ini
          $this->load->model('m_sa'); //Call model m_sa
  }

  function login_kah()
  {
      if ( $this->session->has_userdata('id_user') && $this->session->userdata('id_level')==99 )
          return TRUE; 
      else
          redirect(base_url('logout'));    
  }

  function index()
  {
    $data['page']="home";
    $data['jlm_mhs']=$this->m_umum->jumlah_record_tabel('siap_mhs');
    $data['jlm_pegawai']=$this->m_umum->jumlah_record_tabel('simpeg_pegawai');
    $data['jlm_kelas']=$this->m_umum->jumlah_record_tabel('siap_kelas');
    $data['jlm_user']=$this->m_umum->jumlah_record_tabel('user');
    $this->tampil($data); 
  }

//======================================================================================================
//=======================================  A K A D E M I K =============================================
//----------------------------------- Tahun Akademik -----------------------------------
  function ak_thn_ak($mode = 'view'){ 
    $data['page']  = "ak_thn_ak"; 
    if($mode=='view')
      $this->tampil($data);

    else if($mode=='data')
     echo json_encode($this->m_sa->ak_thn_ak_data()); //coding di model Full Mode. 
    
    else if($mode=='hapus'){
      $id   = $this->uri->segment(4, 0);
      if($this->m_umum->hapus_data('siap_thn_ak','id_thn_ak',$id) )    // tabel, primary field, id
        redirect(base_url('sa/ak_thn_ak'));     
      else
        die("Ada masalah HAPUS Data");
    }
    else{
      $this->form_validation->set_rules('nama_thn_ak','Nama Tahun Akademik','required');
      $this->form_validation->set_rules('aktif','Pilihan aktif','required');
      $data['statusaktif']=array(
        array('Y','Ya'),
        array('T','Tidak')
      );

    //--------------------- TAMBAH -----------------------------
      if($mode=='tambah'){  
        $data['page'] =  $data['page']."_tambah"; //jadi ak_thn_ak_tambah

        $this->form_validation->set_rules('id_thn_ak','ID Tahun Akademik','required');
        if ($this->form_validation->run() === FALSE){
          $this->tampil($data);
        }
        else
        {
          if($this->m_sa->ak_thn_ak_tambah()) 
            redirect(base_url('sa/ak_thn_ak'));
          else
          {
            $data['pesan']  = "Ada Masalah penambahan Data. Hubungi Admin";
            $data['mode']   = "modal-warning";
            $data['page']   = base_url('sa/ak_thn_ak');
            $this->t_modal($data);
          }
        }
      }
    //--------------------- EDIT -----------------------------      
      if($mode=='edit'){    
        $data['page'] =  $data['page']."_edit"; //jadi ak_thn_ak_edit
        $data['id']   = $this->uri->segment(4, 0);
        $data['d']   = $this->m_umum->ambil_data('siap_thn_ak','id_thn_ak',$data['id']);
  
        //lastaccess disimpan di model;
        if ($this->form_validation->run() === FALSE){
          $this->tampil($data);
        }else{
          if($this->m_sa->ak_thn_ak_edit()) 
            redirect(base_url('sa/ak_thn_ak'));
          else
            $data['pesan']  = "Ada Masalah Update Data. Hubungi Admin";
            $data['mode']   = "modal-warning";
            $data['page']   = base_url('sa/ak_thn_ak');
            $this->t_modal($data);
        }
      }    
    }
  }

//-----------------------------------  KELAS ----------------------------------- 
  function ak_kelas($mode = 'view'){ 
    $data['page']  = "ak_kelas";      //Mode 3. Top Mode. Semua di coding
    if($mode=='view')
        $this->tampil($data);
    else if($mode=='data')
      echo json_encode($this->m_sa->kelas_data()); //coding lah lengkap di model .
    else if($mode=='hapus'){
      $id   = $this->uri->segment(4, 0);
      if($this->m_umum->hapus_data('siap_kelas','id_kelas',$id) )    // tabel, primary field, id
        redirect(base_url('sa/ak_kelas'));     
      else
        die("Ada masalah HAPUS Data");
    }
    else{
                                                        // nm tabel, order, primary, text
      $data['thn_ak']=$this->m_umum->ambil_data_dropdown("siap_thn_ak","XD","id_thn_ak","nama_thn_ak");
      $data['prodi']=$this->m_umum->ambil_data_dropdown("kol_prodi","XA","id_prodi","nama_prodi");
      $data['program_kelas']=$this->m_umum->ambil_data_dropdown("siap_program_kelas","XA","id_program_kelas","nama_program_kelas");
      $this->form_validation->set_rules('id_thn_ak','Nama Tahun Akademik','callback_pd_cek');
      $this->form_validation->set_rules('prodi','Program Studi','callback_pd_cek');
      $this->form_validation->set_rules('smt','Semester','required');
      $this->form_validation->set_rules('nama_kelas','Nama Kelas','required');
      $this->form_validation->set_rules('program_kelas','program_kelas','callback_pd_cek');
    
      if($mode=='tambah'){
        $data['page'] =  $data['page']."_tambah"; //jadi ak_kelas_tambah
        if ($this->form_validation->run() === FALSE){
          $this->tampil($data);
        }else{
          if($this->m_umum->tambah_data('siap_kelas'))
            redirect(base_url('sa/ak_kelas'));
          else
            echo "<script> alert('Ada Masalah Penambahan Data. Hubungi Admin'); </script>";
        }
      }
      if($mode=='edit'){
        $data['page'] =  $data['page']."_edit"; //jadi aka_kelas_edit
        $data['id']   = $this->uri->segment(4, 0);
        $data['d']    = $this->m_umum->ambil_data('siap_kelas','id_kelas',$data['id']);
        
        if ($this->form_validation->run() === FALSE){
          $this->tampil($data);
        }else{
          if($this->m_umum->edit_data('siap_kelas')) 
            redirect(base_url('sa/ak_kelas'));
          else
            echo "<script> alert('Ada Masalah Penambahan Data. Hubungi Admin'); </script>";
        }
      }
    }

  }

//-----------------------------------  Range Nilai ----------------------------------- 
  function ak_range($mode = 'view'){  
    $data['page']  = "ak_range"; 
    if($mode=='view')
      $this->tampil($data);

    else if($mode=='data')
     echo json_encode($this->m_sa->ak_range_data()); //coding di model Full Mode. 
    
    else if($mode=='hapus'){
      $id   = $this->uri->segment(4, 0);
      if($this->m_umum->hapus_data('siap_angka_huruf','id_angka_huruf',$id) )    // tabel, primary field, id
        redirect(base_url('sa/ak_range'));     
      else
        die("Ada masalah HAPUS Data");
    }
    else{
      $this->form_validation->set_rules('nilai','Range Nilai','required');
      $this->form_validation->set_rules('huruf','Huruf Nilai','required');
      $data['thn_ak']=$this->m_umum->ambil_data_dropdown("siap_thn_ak","XD","id_thn_ak","nama_thn_ak");
      $this->form_validation->set_rules('id_thn_ak','Nama Tahun Akademik','callback_pd_cek');
      

    //--------------------- TAMBAH -----------------------------
      if($mode=='tambah'){  
        $data['page'] =  $data['page']."_tambah"; //jadi ak_thn_ak_tambah

        if ($this->form_validation->run() === FALSE){
          $this->tampil($data);
        }
        else
        {
          if($this->m_umum->tambah_data('siap_angka_huruf')) 
            redirect(base_url('sa/ak_range'));
          else
          {
            $data['pesan']  = "Ada Masalah penambahan Data. Hubungi Admin";
            $data['mode']   = "modal-warning";
            $data['page']   = base_url('sa/ak_range');
            $this->t_modal($data);
          }
        }
      }
    //--------------------- EDIT -----------------------------      
      if($mode=='edit'){    
        $data['page'] =  $data['page']."_edit"; //jadi ak_thn_ak_edit
        $data['id']   = $this->uri->segment(4, 0);
        $data['d']   = $this->m_umum->ambil_data('siap_angka_huruf','id_angka_huruf',$data['id']);
  
        //lastaccess disimpan di model;
        if ($this->form_validation->run() === FALSE){
          $this->tampil($data);
        }else{
          if($this->m_umum->edit_data('siap_angka_huruf')) 
            redirect(base_url('sa/ak_range'));
          else
            $data['pesan']  = "Ada Masalah Update Data. Hubungi Admin";
            $data['mode']   = "modal-warning";
            $data['page']   = base_url('sa/ak_range');
            $this->t_modal($data);
        }
      }    
    }
  }
  
//-----------------------------------  Registrasi -----------------------------------
  function ak_registrasi($mode = 'view'){  
    $data['page']  = "ak_registrasi"; 
    $data['dttb']  = "crud";
    if($mode=='view')
      $this->tampil($data);

    else if($mode=='data')
     echo json_encode($this->m_sa->ak_registrasi_data()); //coding di model Full Mode. 
    
    else if($mode=='hapus'){
      $id   = $this->uri->segment(4, 0);
      if($this->m_umum->hapus_data('siap_registrasi_mhs','id_registrasi_mhs',$id) )    // tabel, primary field, id
        redirect(base_url('sa/ak_registrasi'));     
      else
        die("Ada masalah HAPUS Data");
    }
    else{
      $this->form_validation->set_rules('smt','Semester','required');
      $this->form_validation->set_rules('nama_kelas','Nama Kelas','required');
      $data['thn_ak']=$this->m_umum->ambil_data_dropdown("siap_thn_ak","XD","id_thn_ak","nama_thn_ak");
      $data['prodi']=$this->m_umum->ambil_data_dropdown("kol_prodi","XD","id_prodi","nama_prodi");
      $data['nim_reges']=$this->m_umum->ambil_data_dropdown("siap_mhs","XD","nim","id_calon_mhs");
      $data['status_spp']=$this->m_umum->ambil_data_dropdown("siap_status_spp","XD","id_status_spp","ket");
      $data['kategori']=$this->m_umum->ambil_data_dropdown("siap_kategori_spp","XD","id_kategori_spp","jumlah");
      $data['status']=$this->m_umum->ambil_data_dropdown("siap_status_aktifitas_mhs","XD","id_status_aktifitas_mhs","nama_status_aktifitas_mhs");
      $this->form_validation->set_rules('id_thn_ak','Nama Tahun Akademik','callback_pd_cek');
      $this->form_validation->set_rules('id_prodi','Nama Prodi','callback_pd_cek');
      $this->form_validation->set_rules('nim','NIM','callback_pd_cek');
      $this->form_validation->set_rules('id_status_spp','Status SPP','callback_pd_cek');
      $this->form_validation->set_rules('id_kategori_spp','Kategori SPP','callback_pd_cek');
      $this->form_validation->set_rules('id_status_aktifitas_mhs','Status Mhs','callback_pd_cek');
      

    //--------------------- TAMBAH -----------------------------
      if($mode=='tambah'){  
        $data['page'] =  $data['page']."_tambah"; //jadi ak_thn_ak_tambah

        if ($this->form_validation->run() === FALSE){
          $this->tampil($data);
        }
        else
        {
          if($this->m_umum->tambah_data('siap_registrasi_mhs')) 
            redirect(base_url('sa/ak_registrasi'));
          else
          {
            $data['pesan']  = "Ada Masalah penambahan Data. Hubungi Admin";
            $data['mode']   = "modal-warning";
            $data['page']   = base_url('sa/ak_registrasi');
            $this->t_modal($data);
          }
        }
      }
    //--------------------- EDIT -----------------------------      
      if($mode=='edit'){    
        $data['page'] =  $data['page']."_edit"; //jadi ak_thn_ak_edit
        $data['id']   = $this->uri->segment(4, 0);
        $data['d']   = $this->m_umum->ambil_data('siap_registrasi_mhs','id_registrasi_mhs',$data['id']);
  
        //lastaccess disimpan di model;
        if ($this->form_validation->run() === FALSE){
          $this->tampil($data);
        }else{
          if($this->m_umum->edit_data('siap_registrasi_mhs')) 
            redirect(base_url('sa/ak_registrasi'));
          else
            $data['pesan']  = "Ada Masalah Update Data. Hubungi Admin";
            $data['mode']   = "modal-warning";
            $data['page']   = base_url('sa/ak_registrasi');
            $this->t_modal($data);
        }
      }    
    }
  }

//-----------------------------------  KURIKULUM ----------------------------------- 
  function ak_kurikulum($mode = 'view'){  
    $data['page']  = "ak_kurikulum"; 
  $data['dttb']  = "crud";
    if($mode=='view')
      $this->tampil($data);

    else if($mode=='data')
     echo json_encode($this->m_sa->ak_kurikulum_data()); //coding di model Full Mode. 
    
    else if($mode=='hapus'){
      $id   = $this->uri->segment(4, 0);
      if($this->m_umum->hapus_data('siap_kurikulum','id_kurikulum',$id) )    // tabel, primary field, id
        redirect(base_url('sa/ak_kurikulum'));     
      else
        die("Ada masalah HAPUS Data");
    }
    else{
      $data['thn_ak']=$this->m_umum->ambil_data_dropdown("siap_thn_ak","XD","id_thn_ak","nama_thn_ak");
      $data['mk']=$this->m_umum->ambil_data_dropdown("siap_mk","XD","id_mk","nama_mk","kode_mk");
      $this->form_validation->set_rules('id_thn_ak','Nama Tahun Akademik','callback_pd_cek');
      $this->form_validation->set_rules('id_mk','Nama MK','callback_pd_cek');
    

    //--------------------- TAMBAH -----------------------------
      if($mode=='tambah'){  
        $data['page'] =  $data['page']."_tambah"; //jadi ak_thn_ak_tambah

        if ($this->form_validation->run() === FALSE){
          $this->tampil($data);
        }
        else
        {
          if($this->m_umum->tambah_data('siap_kurikulum')) 
            redirect(base_url('sa/ak_kurikulum'));
          else
          {
            $data['pesan']  = "Ada Masalah penambahan Data. Hubungi Admin";
            $data['mode']   = "modal-warning";
            $data['page']   = base_url('sa/ak_kurikulum');
            $this->t_modal($data);
          }
        }
      }
    //--------------------- EDIT -----------------------------      
      if($mode=='edit'){    
        $data['page'] =  $data['page']."_edit"; //jadi ak_thn_ak_edit
        $data['id']   = $this->uri->segment(4, 0);
        $data['d']   = $this->m_umum->ambil_data('siap_kurikulum','id_kurikulum',$data['id']);
  
        //lastaccess disimpan di model;
        if ($this->form_validation->run() === FALSE){
          $this->tampil($data);
        }else{
          if($this->m_umum->edit_data('siap_kurikulum')) 
            redirect(base_url('sa/ak_kurikulum'));
          else
            $data['pesan']  = "Ada Masalah Update Data. Hubungi Admin";
            $data['mode']   = "modal-warning";
            $data['page']   = base_url('sa/ak_kurikulum');
            $this->t_modal($data);
        }
      }    
    }
  }

//----------------------------------- Perkuliahan ----------------------------------- 
  function ak_kuliah($mode = 'view'){ 
    $data['page']  = "ak_kuliah"; 
  $data['dttb']  = "crud";
    if($mode=='view')
      $this->tampil($data);

    else if($mode=='data')
     echo json_encode($this->m_sa->ak_kuliah_data()); //coding di model Full Mode. 
    
    else if($mode=='hapus'){
      $id   = $this->uri->segment(4, 0);
      if($this->m_umum->hapus_data('siap_perkuliahan','id_perkuliahan',$id) )    // tabel, primary field, id
        redirect(base_url('sa/ak_kuliah'));     
      else
        die("Ada masalah HAPUS Data");
    }
    else{
      $data['kelas']=$this->m_umum->ambil_data_dropdown("siap_kelas","XD","id_kelas","nama_kelas");
      $data['kurikulum']=$this->m_umum->ambil_data_dropdown("siap_kurikulum","XD","id_kurikulum","id_mk");
      $data['pengajar']=$this->m_umum->ambil_data_dropdown("simpeg_pegawai","XD","id_pegawai","nama_pegawai");
      $data['ruang']=$this->m_umum->ambil_data_dropdown("siap_ruang","XD","id_ruang","nama_ruang");
      $this->form_validation->set_rules('id_kelas','Nama Kelas','callback_pd_cek');
      $this->form_validation->set_rules('id_kurikulum','Nama Kurikulum','callback_pd_cek');
      $this->form_validation->set_rules('id_pegawai','Nama Pegawai','callback_pd_cek');
      $this->form_validation->set_rules('id_ruang','Nama Ruang','callback_pd_cek');
    $this->form_validation->set_rules('pembagi','Pembagi','required');
      
    //--------------------- TAMBAH -----------------------------
      if($mode=='tambah'){  
        $data['page'] =  $data['page']."_tambah"; //jadi ak_thn_ak_tambah

        if ($this->form_validation->run() === FALSE){
          $this->tampil($data);
        }
        else
        {
          if($this->m_umum->tambah_data('siap_perkuliahan')) 
            redirect(base_url('sa/ak_kuliah'));
          else
          {
            $data['pesan']  = "Ada Masalah penambahan Data. Hubungi Admin";
            $data['mode']   = "modal-warning";
            $data['page']   = base_url('sa/ak_kuliah');
            $this->t_modal($data);
          }
        }
      }
    //--------------------- EDIT -----------------------------      
      if($mode=='edit'){    
        $data['page'] =  $data['page']."_edit"; //jadi ak_thn_ak_edit
        $data['id']   = $this->uri->segment(4, 0);
        $data['d']   = $this->m_umum->ambil_data('siap_perkuliahan','id_perkuliahan',$data['id']);
  
        //lastaccess disimpan di model;
        if ($this->form_validation->run() === FALSE){
          $this->tampil($data);
        }else{
          if($this->m_umum->edit_data('siap_perkuliahan')) 
            redirect(base_url('sa/ak_kuliah'));
          else
            $data['pesan']  = "Ada Masalah Update Data. Hubungi Admin";
            $data['mode']   = "modal-warning";
            $data['page']   = base_url('sa/ak_kuliah');
            $this->t_modal($data);
        }
      }    
    }
  }
  

//====================================== USER ========================================
  function user($mode = 'view'){ 
    $data['page']  = "user";      //Mode 3. Top Mode. Semua di coding
    if($mode=='view')
        $this->tampil($data);
    else if($mode=='data')
      echo json_encode($this->m_sa->user_data()); //coding lahlengkap di model .
    else if($mode=='hapus'){
      $id   = $this->uri->segment(4, 0);
      if($this->m_umum->hapus_data('user','id_user',$id) )    // tabel, primary field, id
        redirect(base_url('sa/user'));     
      else
        die("Ada masalah HAPUS Data");
    }
    else{
                                                        // nm tabel, order, primary, text
      $data['pegawai']=$this->m_umum->ambil_data_dropdown("simpeg_pegawai","XA","id_pegawai","nama_pegawai");
      $data['level']=$this->m_umum->ambil_data_dropdown("user_level","XA","id_level","nama_level");
      $this->form_validation->set_rules('username','username','required');
      $this->form_validation->set_rules('ref_user','ref_user','callback_pd_cek');
      $this->form_validation->set_rules('id_level','id_level','callback_pd_cek');
    
      if($mode=='tambah'){
        $data['page'] =  $data['page']."_tambah"; //jadi user_tambah

        $this->form_validation->set_rules('password','password','trim|required|min_length[5]');
        
        if ($this->form_validation->run() === FALSE){
          $this->tampil($data);
        }else{
          if($this->m_sa->user_tambah()) 
            redirect(base_url('sa/user'));
          else
            echo "<script> alert('Ada Masalah Penambahan Data. Hubungi Admin'); </script>";
        }
      }
      if($mode=='edit'){
        $data['page'] =  $data['page']."_edit"; //jadi user_tambah
        $data['id']   = $this->uri->segment(4, 0);
        $data['d']    = $this->m_umum->ambil_data('user','id_user',$data['id']);
        $data['d']['password']="";
        
        if ($this->form_validation->run() === FALSE){
          $this->tampil($data);
        }else{
          if($this->m_sa->user_edit()) 
            redirect(base_url('sa/user'));
          else
            echo "<script> alert('Ada Masalah Penambahan Data. Hubungi Admin'); </script>";
        }
      }
    }

  }
  function user_level($mode = 'view'){ //MODE 1R:
    $data['page']  = "user_level";
    $data['tabel'] = "user_level";
    $data['dttb']  = "view_only";
    $data['mode']  = $mode;
    $this->g_tampil($data);
  }

  
//========================= M A S T E R   K O L E K S I (Mode 3) =======================
  //-------------------------------- JURUSAN -----------------------------------

  function dm_jurusan($mode = 'view'){ 
    $data['page']  = "dm_jurusan";      //Mode 3. Top Mode. Semua di coding
    if($mode=='view')
        $this->tampil($data);
    else if($mode=='data')
      echo json_encode($this->m_sa->jurusan_data()); //coding lahlengkap di model .
    else if($mode=='hapus'){
      $id   = $this->uri->segment(4, 0);
      if($this->m_umum->hapus_data('kol_jurusan','id_jurusan',$id) )    // tabel, primary field, id
        redirect(base_url('sa/dm_jurusan'));     
      else
        die("Ada masalah HAPUS Data");
    }
    else{
                                                        // nm tabel, order, primary, text
      $data['kajur']=$this->m_umum->ambil_data_dropdown("simpeg_pegawai","XA","id_pegawai","nama_pegawai");
      $data['sekjur']=$this->m_umum->ambil_data_dropdown("simpeg_pegawai","XA","id_pegawai","nama_pegawai");
      $this->form_validation->set_rules('nama_jurusan','nama_jurusan','required');
      $this->form_validation->set_rules('kajur','kajur','callback_pd_cek');
      $this->form_validation->set_rules('sekjur','sekjur','callback_pd_cek');
    
      if($mode=='tambah'){
        $data['page'] =  $data['page']."_tambah"; //jadi user_tambah

        $data['nama_jurusan'] = set_value('nama_jurusan',$this->input->post("nama_jurusan"));
        $data['id_kajur'] = set_value('id_kajur',$this->input->post("id_kajur"));
        $data['id_sekjur'] = set_value('id_sekjur',$this->input->post("id_sekjur"));

        if ($this->form_validation->run() === FALSE){
          $this->tampil($data);
        }else{
          if($this->m_umum->tambah_data('kol_jurusan')) 
            redirect(base_url('sa/dm_jurusan'));
          else
            echo "<script> alert('Ada Masalah Penambahan Data. Hubungi Admin'); </script>";
        }
      }
      if($mode=='edit'){
        $data['page'] =  $data['page']."_edit"; //jadi user_tambah
        $data['id']   = $this->uri->segment(4, 0);
        $d    = $this->m_umum->ambil_data('kol_jurusan','id_jurusan',$data['id']);
        
        $data['id_jurusan'] = set_value('id_jurusan',$d["id_jurusan"]);
        $data['nama_jurusan'] = set_value('nama_jurusan',$d["nama_jurusan"]);
        $data['id_kajur'] = set_value('id_kajur',$d["id_kajur"]);
        $data['id_sekjur'] = set_value('id_sekjur',$d["id_sekjur"]);

        if ($this->form_validation->run() === FALSE){
          $this->tampil($data);
        }else{
          if($this->m_umum->edit_data('kol_jurusan')) 
            redirect(base_url('sa/dm_jurusan'));
          else
            echo "<script> alert('Ada Masalah Penambahan Data. Hubungi Admin'); </script>";
        }
      }
    }

  }

  //-------------------------------- P R O D I -----------------------------------

  function dm_prodi($mode = 'view'){ 
    $data['page']  = "dm_prodi";      //Mode 3. Top Mode. Semua di coding
    if($mode=='view')
        $this->tampil($data);
    else if($mode=='data')
      echo json_encode($this->m_sa->prodi_data()); //coding lahlengkap di model .
    else if($mode=='hapus'){
      $id   = $this->uri->segment(4, 0);
      if($this->m_umum->hapus_data('kol_prodi','id_prodi',$id) )    // tabel, primary field, id
        redirect(base_url('sa/dm_prodi'));     
      else
        die("Ada masalah HAPUS Data");
    }
    else{
                                                        // nm tabel, order, primary, text
      $data['kaprodi']=$this->m_umum->ambil_data_dropdown("simpeg_pegawai","XA","id_pegawai","nama_pegawai");
      $data['jurusan']=$this->m_umum->ambil_data_dropdown("kol_jurusan","XA","id_jurusan","nama_jurusan");
      $this->form_validation->set_rules('kode_prodi','kode_prodi','required');
      $this->form_validation->set_rules('nama_prodi','nama_prodi','required');
      $this->form_validation->set_rules('jenjang','jenjang','required');
      $this->form_validation->set_rules('akreditasi','akreditasi','required');
      $this->form_validation->set_rules('no_sk_dikti','no_sk_dikti','required');
      $this->form_validation->set_rules('tgl_sk_dikti','tgl_sk_dikti','required');
      $this->form_validation->set_rules('no_sk_ban','no_sk_ban','required');
      $this->form_validation->set_rules('kaprodi','kaprodi','callback_pd_cek');
      $this->form_validation->set_rules('jurusan','jurusan','callback_pd_cek');
    
      if($mode=='tambah'){
        $data['page'] =  $data['page']."_tambah"; //jadi user_tambah

        $data['kode_prodi'] = set_value('kode_prodi',$this->input->post("kode_prodi"));
        $data['kode_prodi'] = set_value('kode_prodi',$this->input->post("kode_prodi"));
        $data['kode_prodi'] = set_value('kode_prodi',$this->input->post("kode_prodi"));
        $data['kode_prodi'] = set_value('kode_prodi',$this->input->post("kode_prodi"));
        $data['kode_prodi'] = set_value('kode_prodi',$this->input->post("kode_prodi"));
        $data['kode_prodi'] = set_value('kode_prodi',$this->input->post("kode_prodi"));
        $data['id_kajur'] = set_value('id_kajur',$this->input->post("id_kajur"));
        $data['id_sekjur'] = set_value('id_sekjur',$this->input->post("id_sekjur"));

        if ($this->form_validation->run() === FALSE){
          $this->tampil($data);
        }else{
          if($this->m_umum->tambah_data('kol_jurusan')) 
            redirect(base_url('sa/dm_prodi'));
          else
            echo "<script> alert('Ada Masalah Penambahan Data. Hubungi Admin'); </script>";
        }
      }
      if($mode=='edit'){
        $data['page'] =  $data['page']."_edit"; //jadi user_tambah
        $data['id']   = $this->uri->segment(4, 0);
        $d    = $this->m_umum->ambil_data('kol_jurusan','id_jurusan',$data['id']);
        
        $data['id_jurusan'] = set_value('id_jurusan',$d["id_jurusan"]);
        $data['nama_jurusan'] = set_value('nama_jurusan',$d["nama_jurusan"]);
        $data['id_kajur'] = set_value('id_kajur',$d["id_kajur"]);
        $data['id_sekjur'] = set_value('id_sekjur',$d["id_sekjur"]);

        if ($this->form_validation->run() === FALSE){
          $this->tampil($data);
        }else{
          if($this->m_umum->edit_data('kol_jurusan')) 
            redirect(base_url('sa/dm_prodi'));
          else
            echo "<script> alert('Ada Masalah Penambahan Data. Hubungi Admin'); </script>";
        }
      }
    }

  }

//========================= M A S T E R   D A T A =======================
  function m_jurusan($mode = 'view'){ 
    $data['page']  = "m_jurusan";      
    $data['tabel'] = "kol_jurusan";  
    $data['dttb']  = "crud";
    $data['mode']  = $mode;      
    $this->g_tampil($data);      
  }
  function m_prodi($mode = 'view'){ 
    $data['page']  = "m_prodi";      
    $data['tabel'] = "kol_prodi";  
    $data['dttb']  = "crud";
    $data['mode']  = $mode;      
    $this->g_tampil($data);      
  }
  function m_pegawai($mode = 'view'){ 
    $data['page']  = "m_pegawai";      
    $data['tabel'] = "simpeg_pegawai";  
    $data['dttb']  = "crud";
    $data['mode']  = $mode;      
    $this->g_tampil($data);      
  }
  function m_mhs($mode = 'view'){ 
    $data['page']  = "m_mhs";      
    $data['tabel'] = "siap_mhs";  
    $data['dttb']  = "crud";
    $data['mode']  = $mode;      
    $this->g_tampil($data);      
  }


//========================= M A S T E R   K O L E K S I (Mode 1) =======================
  function m_agama($mode = 'view'){  //MODE 1CRUD: CRUD. Nama function Harus sama dengan page. Tidak perlu coding di isi dan jscode.
    $data['page']  = "m_agama";      //Page-> Di isi.php tidak terpakai. Di jscode.php terpakai (didalam if($dttb=='view_only') )
    $data['tabel'] = "kol_agama";  //Nama tabel.  Posisi field primary harus di paling atas atau paling kiri dan autoIncremen. 
    $data['dttb']  = "crud";     //Mode "view_only" atau "crud". Di isi.php tidak terpakai. Di jscode.php terpakai 
    $data['mode']  = $mode;           //Wajib
    $this->g_tampil($data);           //Wajib
  }
  function m_darah($mode = 'view'){  //MODE 1CRUD: 
    $data['page']  = "m_darah";      
    $data['tabel'] = "kol_darah";  
    $data['dttb']  = "crud";     
    $data['mode']  = $mode;      
    $this->g_tampil($data);      
  }
  function m_pendidikan($mode = 'view'){  //MODE 1CRUD: 
    $data['page']  = "m_pendidikan";      
    $data['tabel'] = "kol_pendidikan";  
    $data['dttb']  = "crud";     
    $data['mode']  = $mode;      
    $this->g_tampil($data);      
  }
  function m_jenis_sekolah($mode = 'view'){  //MODE 1CRUD: 
    $data['page']  = "m_jenis_sekolah";      
    $data['tabel'] = "kol_jenis_sekolah";  
    $data['dttb']  = "crud";     
    $data['mode']  = $mode;      
    $this->g_tampil($data);      
  }
  function m_jk($mode = 'view'){  //MODE 1CRUD: 
    $data['page']  = "m_jk";      
    $data['tabel'] = "kol_jk";  
    $data['dttb']  = "crud";     
    $data['mode']  = $mode;      
    $this->g_tampil($data);      
  }
  function m_jurusan_sekolah($mode = 'view'){  //MODE 1CRUD: 
    $data['page']  = "m_jurusan_sekolah";      
    $data['tabel'] = "kol_jurusan_sekolah";  
    $data['dttb']  = "crud";     
    $data['mode']  = $mode;      
    $this->g_tampil($data);      
  }
  function m_pekerjaan($mode = 'view'){  //MODE 1CRUD: 
    $data['page']  = "m_pekerjaan";      
    $data['tabel'] = "kol_pekerjaan";  
    $data['dttb']  = "crud";     
    $data['mode']  = $mode;      
    $this->g_tampil($data);      
  }
  function m_penghasilan($mode = 'view'){  //MODE 1CRUD: 
    $data['page']  = "m_penghasilan";      
    $data['tabel'] = "kol_penghasilan";  
    $data['dttb']  = "crud";     
    $data['mode']  = $mode;      
    $this->g_tampil($data);      
  }
  function m_status_hidup($mode = 'view'){  //MODE 1CRUD: 
    $data['page']  = "m_status_hidup";      
    $data['tabel'] = "kol_status_hidup";  
    $data['dttb']  = "crud";     
    $data['mode']  = $mode;      
    $this->g_tampil($data);      
  }
  function m_status_keluarga($mode = 'view'){  //MODE 1CRUD: 
    $data['page']  = "m_status_keluarga";      
    $data['tabel'] = "kol_status_keluarga";  
    $data['dttb']  = "crud";     
    $data['mode']  = $mode;      
    $this->g_tampil($data);      
  }
  function m_status_sipil($mode = 'view'){  //MODE 1CRUD: 
    $data['page']  = "m_status_sipil";      
    $data['tabel'] = "kol_status_sipil";  
    $data['dttb']  = "crud";     
    $data['mode']  = $mode;      
    $this->g_tampil($data);      
  }
  function m_thn_ak($mode = 'view'){  //MODE 1CRUD: 
    $data['page']  = "m_thn_ak";      
    $data['tabel'] = "siap_thn_ak";  
    $data['dttb']  = "crud";     
    $data['mode']  = $mode;      
    $this->g_tampil($data);      
  }
  function m_program_kelas($mode = 'view'){  //MODE 1CRUD: 
    $data['page']  = "m_program_kelas";      
    $data['tabel'] = "siap_program_kelas";  
    $data['dttb']  = "crud";     
    $data['mode']  = $mode;      
    $this->g_tampil($data);      
  }


//========================= M A S T E R   W I L A Y A H =======================
  function wilayah_gabung($mode = 'view') //MODE 2R: Contoh VIEW Only dengan JOIN di databales. Coding di isi.php
  {
    $data['page'] = "wilayah_gabung"; //page. Di bagian isi.php dan jscode.php terpakai. Jadi buat coding di isi.php saja.
    $data['dttb'] = "view_only";      //Agar Dapat panggil dttable tanpa menu di jscode (view Only). Cek di bagian akhir jscode.
    if($mode=='view')
      $this->tampil($data);
    else if($mode=='data')
      echo json_encode($this->m_sa->wilayah_gabung()); //load, buat coding manual di Model
  } 

  function provinsi($mode = 'view'){  //MODE 1R: Contoh datatable VIEW only. Nama function Harus sama dengan page
    $data['page']  = "provinsi";      //Page-> Di isi.php tidak terpakai. Di jscode.php terpakai (didalam if($dttb=='view_only') )
    $data['tabel'] = "kol_provinsi";  //Nama tabel.  Posisi field primary harus di paling atas atau paling kiri dan autoIncremen. 
    $data['dttb']  = "view_only";     //Mode "view_only" atau "crud". Di isi.php tidak terpakai. Di jscode.php terpakai 
    $data['mode']  = $mode;           //Wajib
    $this->g_tampil($data);           //Wajib
  }
  function kabupaten($mode = 'view'){ //MODE 1R:
    $data['page']  = "kabupaten";
    $data['tabel'] = "kol_kabupaten";
    $data['dttb']  = "view_only";
    $data['mode']  = $mode;
    $this->g_tampil($data);
  }
  function kecamatan($mode = 'view'){ //MODE 1R:
    $data['page']  = "kecamatan";
    $data['tabel'] = "kol_kecamatan";
    $data['dttb']  = "view_only";
    $data['mode']  = $mode;
    $this->g_tampil($data);
  }
  function kelurahan($mode = 'view'){ //MODE 1R:
    $data['page']  = "kelurahan";
    $data['tabel'] = "kol_kelurahan";
    $data['dttb']  = "view_only";
    $data['mode']  = $mode;
    $this->g_tampil($data);
  }


//===================================================================
//========================= TOOLS ===================================
//===================================================================
  function pd_cek($str)    //Untuk Validasi Pulldown jika tidak dipilih
  {
    if ($str == 'pildef') {
      $this->form_validation->set_message('pd_cek', 'Harus dipilih');
      return FALSE;
    }
    else
      return TRUE;
  }

  function tampil($data)  //Load View Tampil Default tanpa Datatables
  {
    $this->load->view("sa/header",$data); //Cukup Sekali kirim, semua view dapat $data
    $this->load->view("sa/isi");
    $this->load->view("sa/jsload");
    $this->load->view("sa/jscode");
  }  

  function t_modal($data)  //Load View Tampil Default tanpa Datatables
  {
    $this->load->view("aa_coba/header",$data); //Cukup Sekali kirim, semua view dapat $data
    $this->load->view("aa_coba/pesan");
    $this->load->view("aa_coba/jsload");
    $this->load->view("aa_coba/jspesan");
  }    

//--------------------- datagrid crud ---------------------------------
  function g_tampil($data)   //Tampilkab Datatables View Only atau CRUD
  {
    $fields = $this->db->list_fields($data['tabel']);//cari nama field
    foreach ($fields as $field)
      $data['kolom'][]= $field;
    
    if($data['mode']=='view')
      $this->tampil($data);
    else if($data['mode']=='data')
      $this->m_umum->ambil_datatable($data);
    else if($data['mode']=='tambah')
      $this->tambah($data); 
    else if($data['mode']=='edit')
      $this->edit($data); 
    else if($data['mode']=='hapus')
    {
      $id = $this->uri->segment(4, 0);
      if($this->m_umum->hapus_data($data['tabel'],$data['kolom'][0],$id))
        redirect(base_url('sa/'.$data['page']));
    } 
    else
      show_404();
  }

  function tambah($data)
  {
    $data['control']=$data['page'];
    $data['page']="tambah";
    $this->form_validation->set_error_delimiters('<div class="text-yellow">', '</div>');
    $this->form_validation->set_rules($data['kolom'][1], $data['kolom'][1], 'required', array('required' => 'Field  %s harus diisi.'));
    if ($this->form_validation->run() === FALSE)
    {
      $this->tampil($data); //Jangan tertukar dengan g_tampil
    }
    else
    {
      $hasil=$this->m_umum->tambah_data($data['tabel']);
      if($hasil>0)
        redirect(base_url('sa/'.$data['control']));
      else
        echo "<script>
              alert('Gagal Disimpan, Hubungi admin.');
              window.location.href='';
             </script>";           
    }     
  }

  function edit($data)
  {
    $data['id'] = $this->uri->segment(4, 0);
    $data['control']=$data['page'];
    $data['page']="edit";
    $data['d']=$this->m_umum->ambil_data($data['tabel'],$data['kolom'][0],$data['id']);
    $this->form_validation->set_error_delimiters('<div class="text-yellow">', '</div>');
    $this->form_validation->set_rules($data['kolom'][1], $data['kolom'][1], 'required', array('required' => 'Field  %s harus diisi.'));
    if ($this->form_validation->run() === FALSE)
    {
      $this->tampil($data);
    }
    else
    {
      if($this->m_umum->edit_data($data['tabel']) )
        redirect(base_url('sa/'.$data['control']));
      else
        echo "<script>
              alert('Gagal Disimpan, Hubungi admin.');
              window.location.href='';
             </script>";            
    }     
  }
  //--------------------- END  crud ---------------------------------


}

