<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Prodi extends CI_Controller {
  public function __construct()
  {
          parent::__construct();
          $this->login_kah();	//Memastikan hanya yang sudah login dapat akses fungsi ini
          $this->load->model('m_prodi');
  }

  function login_kah()
  {
    // print_r($this->session->userdata());die();
      if ( $this->session->has_userdata('id_user') && $this->session->userdata('id_level')>0 && $this->session->userdata('id_level')<19 )
          return TRUE; 
      else
          redirect(base_url('logout'));    
  }
  function index(){
    $data['page']="home";
    $data['jlm_mhs']=$this->m_umum->jumlah_record_tabel('siap_mhs');
    $data['jlm_pegawai']=$this->m_umum->jumlah_record_tabel('simpeg_pegawai');
    $data['jlm_kelas']=$this->m_umum->jumlah_record_tabel('siap_kelas');
    $data['jlm_user']=$this->m_umum->jumlah_record_tabel('user');
    $this->tampil($data); 
  }


//=======================================  A K A D E M I K =============================================
//----------------------------------- Tahun Akademik -----------------------------------
  function ak_thn_ak($mode = 'view'){ 
    $data['page']  = "ak_thn_ak"; 
    if($mode=='view')
      $this->tampil($data);

    else if($mode=='data')
     echo json_encode($this->m_prodi->ak_thn_ak_data()); //coding di model Full Mode. 
  }

//-----------------------------------  KELAS ----------------------------------- 
  function ak_kelas($mode = 'view'){ 
    $data['page']  = "ak_kelas";      //Mode 3. Top Mode. Semua di coding
    if($mode=='view')
        $this->tampil($data);
    else if($mode=='data')
      echo json_encode($this->m_prodi->kelas_data()); //coding lah lengkap di model .
    else if($mode=='hapus'){
      $id   = $this->uri->segment(4, 0);
      if($this->m_umum->hapus_data('siap_kelas','id_kelas',$id) )    // tabel, primary field, id
        redirect(base_url('prodi/ak_kelas'));     
      else
        die("Ada masalah HAPUS Data");
    }
    else{
      $data['program_kelas']=$this->m_umum->ambil_data_dropdown("siap_program_kelas","XA","id_program_kelas","nama_program_kelas");
      $this->form_validation->set_rules('id_thn_ak','Nama Tahun Akademik','callback_pd_cek');
      $this->form_validation->set_rules('prodi','Program Studi','callback_pd_cek');
      $this->form_validation->set_rules('smt','Semester','required');
      $this->form_validation->set_rules('nama_kelas','Nama Kelas','required');
      $this->form_validation->set_rules('alias','Alias','required|max_length[5]');
      $this->form_validation->set_rules('id_program_kelas','program_kelas','callback_pd_cek');
      if ($this->session->userdata('jenjang')=='D3') {
        $data['semester']=array(
                array('1','Satu'),  
                array('2','Dua'),  
                array('3','Tiga'),  
                array('4','Empat'),  
                array('5','Lima'),  
                array('6','Enam')
              );
      }
      else {
        $data['semester']=array(
                array('1','Satu'),  
                array('2','Dua'),  
                array('3','Tiga'),  
                array('4','Empat'),  
                array('5','Lima'),  
                array('6','Enam'),  
                array('7','tujuh'),  
                array('8','Delapan')
              );
      }
    
      if($mode=='tambah'){
        $data['page'] =  $data['page']."_tambah"; //jadi ak_kelas_tambah
        $data['thn_ak_aktif']=$this->session->userdata('thn_ak_aktif');
        if ($this->form_validation->run() === FALSE){
          $this->tampil($data);
        }else{
          if($this->m_umum->tambah_data('siap_kelas'))
            redirect(base_url('prodi/ak_kelas'));
          else
            echo "<script> alert('Ada Masalah Penambahan Data. Hubungi Admin'); </script>";
        }
      }
      if($mode=='edit'){
        $data['page'] =  $data['page']."_edit"; //jadi aka_kelas_edit
        $data['id']   = $this->uri->segment(4, 0);
        $data['thn_ak']=$this->m_umum->ambil_data_dropdown("siap_thn_ak","DX","id_thn_ak","nama_thn_ak");
        $data['d']    = $this->m_umum->ambil_data('siap_kelas','id_kelas',$data['id']);
        
        if ($this->form_validation->run() === FALSE){
          $this->tampil($data);
        }else{
          if($this->m_umum->edit_data('siap_kelas')) 
            redirect(base_url('prodi/ak_kelas'));
          else
            echo "<script> alert('Ada Masalah Penambahan Data. Hubungi Admin'); </script>";
        }
      }
    }

  }

//-----------------------------------  Range Nilai ----------------------------------- 
  function ak_range($mode = 'view'){  
    $data['page']  = "ak_range"; 
    if($mode=='view'){
      $data['thn_ak']=$this->m_umum->ambil_data_dropdown("siap_thn_ak","DX","id_thn_ak","nama_thn_ak");
      $this->tampil($data);
    }

    else if($mode=='data')
     echo json_encode($this->m_prodi->ak_range_data()); 
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
    $this->load->view("prodi/header",$data); //Cukup Sekali kirim, semua view dapat $data
    $this->load->view("prodi/isi");
    $this->load->view("prodi/jsload");
    $this->load->view("prodi/jscode");
  }  

  function t_modal($data)  //Load View Tampil Default tanpa Datatables
  {
    $this->load->view("prodi/header",$data); //Cukup Sekali kirim, semua view dapat $data
    $this->load->view("prodi/pesan");
    $this->load->view("prodi/jsload");
    $this->load->view("prodi/jspesan");
  }    


}
