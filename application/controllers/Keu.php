<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Keu extends CI_Controller {
  public function __construct()
  {
          parent::__construct();
          $this->login_kah();	//Memastikan hanya yang sudah login dapat akses fungsi ini
          $this->load->model('m_keu');
  }

  function login_kah()
  {
      if ( $this->session->has_userdata('id_user') && $this->session->userdata('id_level')==66 )
          return TRUE; 
      else
          redirect(base_url('logout'));    
  }
  function index(){
    $data['page']="home";
    $data['jlm_surat_masuk']=$this->m_umum->jumlah_record_tabel('keu_surat_undangan');
    $data['jlm_surat_tugas']=$this->m_umum->jumlah_record_tabel('keu_surat_tugas');
    $this->tampil($data); 
  }


//=============================== S U R A T  M A S U K ===============================
  function surat_masuk($mode = 'view'){  // MODE 3Crud: Contoh Datatable JOIN yang ada ambigiusnya, ada if elsenya.
    $data['page']  = "surat_masuk"; 
    if($mode=='view')
      $this->tampil($data);

    else if($mode=='data')
     echo json_encode($this->m_keu->surat_masuk_data()); //coding di model Full Mode. 
    
  }


//=============================== S U R A T  T U G A S ===============================
  function surat_tugas($mode = 'view'){  // MODE 3Crud: Contoh Datatable JOIN yang ada ambigiusnya, ada if elsenya.
    $data['page']  = "surat_tugas"; 
    if($mode=='view')
      $this->tampil($data);

    else if($mode=='data')
     echo json_encode($this->m_keu->surat_tugas_data()); //coding di model Full Mode. 

    else if($mode=='pengikut'){
      $data['page']  = "pengikut"; 
      $id   = $this->uri->segment(4, 0);
      $data['dt'] = $this->m_keu->pengikut_jaldis_data($id);
      $this->load->view("keu/isi",$data);
      
    }
    
	else{
                                                        // nm tabel, order, primary, text
      $data['jenis']=$this->m_umum->ambil_data_dropdown("jenis_surat","XA","id_jenis","nama_surat");
	     $this->form_validation->set_rules('jenis','jenis','callback_pd_cek');
    
      if($mode=='edit'){
        $data['page'] =  $data['page']."_edit"; //jadi user_tambah
        $data['id']   = $this->uri->segment(4, 0);
        $d    = $this->m_umum->ambil_data('keu_surat_tugas','id_surat_tugas',$data['id']);
        
        $data['id_surat_tugas'] = set_value('id_surat_tugas',$d["id_surat_tugas"]);
        $data['id_jenis'] = set_value('id_jenis',$d["id_jenis"]);

        if ($this->form_validation->run() === FALSE){
          $this->tampil($data);
        }else{
          if($this->m_umum->edit_data('keu_surat_tugas')) 
            redirect(base_url('keu/surat_tugas'));
          else
            echo "<script> alert('Ada Masalah Penambahan Data. Hubungi Admin'); </script>";
        }
      }
    }
    
  }
//=============================== S U R A T  F U L L ===============================
  function proses_jaldis($mode = 'view'){  // MODE 3Crud: Contoh Datatable JOIN yang ada ambigiusnya, ada if elsenya.
    $data['page']  = "proses_jaldis"; 
    if($mode=='view')
      $this->tampil($data);

    else if($mode=='data')
     echo json_encode($this->m_keu->proses_jaldis_data()); //coding di model Full Mode. 

    else if($mode=='cetak_rincianbiaya')
    {
        $data['page'] = 'cetak_rincianbiaya';
        $id           = $this->uri->segment(4, 0);
        $data['d']    = $this->m_keu->cetak_rincian_data($id);
        // print_r($data);die();
        $this->cetak($data);
    }    
    else if($mode=='cetak_sppd_depan')
    {
        $data['page'] = 'cetak_sppd_depan';
        $id           = $this->uri->segment(4, 0);
        $data['d']    = $this->m_keu->cetak_rincian_data($id);
        // print_r($data);die();
        $this->cetak($data);
    }    
    else if($mode=='cetak_sppd_belakang')
    {
        $data['page'] = 'cetak_sppd_belakang';
        $id           = $this->uri->segment(4, 0);
        $data['d']    = $this->m_keu->cetak_rincian_data($id);
        // print_r($data);die();
        $this->cetak($data);
    }
    else if($mode=='cetak_biaya_riil')
    {
        $data['page'] = 'cetak_biaya_riil';
        $id           = $this->uri->segment(4, 0);
        $data['d']    = $this->m_keu->cetak_rincian_data($id);
        // print_r($data);die();
        $this->cetak($data);
    }
    
    else{
                                                          // nm tabel, order, primary, text
      $data['jenis']=$this->m_umum->ambil_data_dropdown("jenis_surat","XA","id_jenis","nama_surat");
  	  $this->form_validation->set_rules('jenis','jenis','callback_pd_cek');
      
        if($mode=='edit'){

          $data['page'] =  $data['page']."_edit"; //jadi user_tambah
          $id   = $this->uri->segment(4, 0);
          $data['d']    = $this->m_umum->ambil_data('keu_pengikut','id_pengikut',$id);

          // print_r($data['d']);
          $data['jml_hari']= $this->m_keu->hitung_jumlah_hari($id);
          $data['uangharian']=$this->hitung_uangharian($data['d']['id_pengikut']);
          $data['uang_transport1']=$this->hitung_transport1($data['d']['id_pengikut']);
          $data['uang_transport3']=$this->hitung_transport3($data['d']['id_pengikut']);
        // $data['uangpenginapan']=$this->hitung_uangpenginapan($data['d']['id_pengikut']);

// print_r($data); 
// echo $uangharian;
        if ($this->form_validation->run() === FALSE){
          $this->tampil($data);
        }else{
          if($this->m_umum->edit_data('keu_pengikut')) 
            redirect(base_url('keu/proses_jaldis'));
          else
            echo "<script> alert('Ada Masalah Penambahan Data. Hubungi Admin'); </script>";
        }
      }
    }
  }

 
//--------------------- Function ----------------------------- 

   function hitung_uangharian($id_pengikut)
   {
	   $d = $this->m_keu->ambil_data_uangharian($id_pengikut);
	   $tujuan=$d[0]['id_kota_tujuan'];
	   echo $tujuan;
	   $t = $this->m_umum->ambil_data('kol_biaya_perjadin','id_prov',$tujuan);
	   // echo "tes";

	   // print_r($t);die();
	   
	   if ($d[0]['id_kota_tujuan']==63)
		   $uangharian=$t['uh_dk'];
	   else 
		   $uangharian=$t['uh_lk'];
	   return $uangharian;
	   
   }
   function hitung_transport1($id_pengikut)
   {
	   $d = $this->m_keu->ambil_data_transport1($id_pengikut);
	   // echo "<pre>";
	   // print_r($d);
	   // echo "</pre>";
	   $asal=$d[0]['id_kota_asal'];
	   echo $asal;
	   $t = $this->m_umum->ambil_data('kol_biaya_perjadin','id_prov',$asal);
	   // echo "tes";

	   // print_r($t);die();
	   
	   $uang_transport1=$t['taksi_pp'];
	   return $uang_transport1;
	   
   }
   function hitung_transport3($id_pengikut)
   {
	   $d = $this->m_keu->ambil_data_transport3($id_pengikut);
	   // echo "<pre>";
	   // print_r($d);
	   // echo "</pre>";
	   $tujuan=$d[0]['id_kota_tujuan'];
	   echo $tujuan;
	   $t = $this->m_umum->ambil_data('kol_biaya_perjadin','id_prov',$tujuan);
	   // echo "tes";

	   // print_r($t);die();
	   
	   $uang_transport3=$t['taksi_pp'];
	   return $uang_transport3;
	   
   }
   function hitung_uangpenginapan($id_pengikut)
   {
	   $d = $this->m_keu->ambil_data_uangpenginapan($id_pengikut);
	   // echo "<pre>";
	   // print_r($d);
	   // echo "</pre>";
	   $tujuan=$d[0]['id_kota_tujuan'];
	   echo $tujuan;
	   $t = $this->m_umum->ambil_data('kol_biaya_perjadin','id_prov',$tujuan);
	   // echo "tes";

	   // print_r($t);die();
	   
	   if ($d[0]['golongan']==2)
		   $uangpenginapan=$t['hotel_gol2'];
	   else if ($d[0]['golongan']==3)
		   $uangpenginapan=$t['hotel_gol3'];
	   else 
		   $uangpenginapan=$t['hotel_gol4'];
	   return $uangpenginapan;
	   
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
    $this->load->view("keu/header",$data); //Cukup Sekali kirim, semua view dapat $data
    $this->load->view("keu/isi");
    $this->load->view("keu/jsload");
    $this->load->view("keu/jscode");
  }  

  function t_modal($data)  //Load View Tampil Default tanpa Datatables
  {
    $this->load->view("keu/header",$data); //Cukup Sekali kirim, semua view dapat $data
    $this->load->view("keu/pesan");
    $this->load->view("keu/jsload");
    $this->load->view("keu/jspesan");
  }   

  function cetak($data)  //Load View Tampil Default tanpa Datatables
  {
    $this->load->view("keu/c_isi",$data); //Cukup Sekali kirim, semua view dapat $data
  }  
/*
  function cetak_sppd_depan($data)  //Load View Tampil Default tanpa Datatables
  {
    $this->load->view("keu/c_isi_sppd_depan",$data); //Cukup Sekali kirim, semua view dapat $data
  }  
     
  function cetak_sppd_belakang($data)  //Load View Tampil Default tanpa Datatables
  {
    $this->load->view("keu/c_isi_sppd_belakang",$data); //Cukup Sekali kirim, semua view dapat $data
  }    
  function cetak_biaya_riil($data)  //Load View Tampil Default tanpa Datatables
  {
    $this->load->view("keu/c_isi_biaya_riil",$data); //Cukup Sekali kirim, semua view dapat $data
  } 
  */
 }
  //--------------------- END  crud ---------------------------------


