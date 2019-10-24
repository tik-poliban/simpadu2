<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kep extends CI_Controller {
  public function __construct()
  {
          parent::__construct();
          $this->login_kah();	//Memastikan hanya yang sudah login dapat akses fungsi ini
          $this->load->model('m_kep');
  }

  function login_kah()
  {
      if ( $this->session->has_userdata('id_user') && $this->session->userdata('id_level')==62 )
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
     echo json_encode($this->m_kep->surat_masuk_data()); //coding di model Full Mode. 
    
    else if($mode=='hapus'){
      $id   = $this->uri->segment(4, 0);
      if($this->m_umum->hapus_data('keu_surat_undangan','id_surat_undangan',$id) )    // tabel, primary field, id
        redirect(base_url('kep/surat_masuk'));     
      else
        die("Ada masalah HAPUS Data");
    }
    else{
      $this->form_validation->set_rules('no_surat','Nomor Surat','required');
      $this->form_validation->set_rules('tgl_surat','Tgl Surat','required');
      $this->form_validation->set_rules('perihal','Perihal Surat','required');
      $this->form_validation->set_rules('dari','Dari','required');
      $this->form_validation->set_rules('kepada','Kepada','required');
      $this->form_validation->set_rules('deskripsi','Deskripsi','required');

    //--------------------- TAMBAH -----------------------------
      if($mode=='tambah'){  
        $data['page'] =  $data['page']."_tambah"; //jadi ak_thn_ak_tambah

        if ($this->form_validation->run() === FALSE){
          $this->tampil($data);
        }
        else
        {
          // if($this->m_umum->tambah_data('keu_surat_undangan')) 
          if($this->m_kep->surat_masuk_tambah()) 
            redirect(base_url('kep/surat_masuk'));
          else
          {
            $data['pesan']  = "Ada Masalah penambahan Data. Hubungi Admin";
            $data['mode']   = "modal-warning";
            $data['page']   = base_url('kep/surat_masuk');
            $this->t_modal($data);
          }
        }
      }
    //--------------------- EDIT -----------------------------      
      if($mode=='edit'){    
        $data['page'] =  $data['page']."_edit"; //jadi ak_thn_ak_edit
        $data['id']   = $this->uri->segment(4, 0);
        $data['d']    = $this->m_umum->ambil_data('keu_surat_undangan','id_surat_undangan',$data['id']);
        $data['d']['tgl_surat']=date_format(new DateTime($data['d']['tgl_surat']),"d-m-Y");
        $data['old_nama_file'] = $data['d']['nama_file']; // Tambahan Roffa

  
        if ($this->form_validation->run() === FALSE){
          $this->tampil($data);
        }else{
          if($this->m_kep->surat_masuk_edit()) 
            redirect(base_url('kep/surat_masuk'));
          else
            $data['pesan']  = "Ada Masalah Update Data. Hubungi Admin";
            $data['mode']   = "modal-warning";
            $data['page']   = base_url('kep/surat_masuk');
            $this->t_modal($data);
        }
      } 
      //--------------------- HAPUS FILE -----------------------------  
      //--------------------- Edit by Roffa --------------------------    
      if ($mode == 'hapus_file') {
        $data['page'] =  $data['page'] . "_edit"; //jadi ak_thn_ak_edit
        $data['id']   = $this->uri->segment(4, 0);
        $data['d']    = $this->m_umum->ambil_data('keu_surat_undangan', 'id_surat_undangan', $data['id']);

        if ($this->m_kep->surat_masuk_hapus_file($data['id']))
          redirect(base_url('kep/surat_masuk/edit/' . $data['id']));
        else
          $data['pesan']  = "Ada Masalah Update Data. Hubungi Admin";
        $data['mode']   = "modal-warning";
        $data['page']   = base_url('kep/surat_masuk');
        $this->t_modal($data);
      }

    //--------------------- CETAK -----------------------------      
      if($mode=='cetak'){    
        $data['id']   = $this->uri->segment(4, 0);
        $data['d']    = $this->m_umum->ambil_data('keu_surat_undangan','id_surat_undangan',$data['id']);
  
        $this->cetak($data);
        }     
    }

  }


//=============================== S U R A T  T U G A S ===============================
  function surat_tugas($mode = 'view'){  // MODE 3Crud: Contoh Datatable JOIN yang ada ambigiusnya, ada if elsenya.
    $data['page']  = "surat_tugas"; 
    if($mode=='view')
      $this->tampil($data);

    else if($mode=='data')
     echo json_encode($this->m_kep->surat_tugas_data());  
    
    else if($mode=='hapus'){      //------------------ HAPUS ----------------------      
      $id   = $this->uri->segment(4, 0);
      if($this->m_umum->hapus_data('keu_surat_tugas','id_surat_tugas',$id) )    // tabel, primary field, id
        redirect(base_url('kep/surat_tugas'));     
      else
        die("Ada masalah HAPUS Data");
    }

    else if($mode=='cetak'){        //--------------------- CETAK -----------------------------
      $data['page'] = "surat_tugas";
      $data['id']   = $this->uri->segment(4, 0);
      //ambil data surat tugasnya
      $data['d']    = $this->m_umum->ambil_data('keu_surat_tugas','id_surat_tugas',$data['id']);
      //ambil data pesertanya 
      $data['pengikut']    = $this->m_kep->surat_tugas_peserta_cetak($data['id']);
      $this->cetak($data);
    }

    else{
      $data['surat_m']=$this->m_umum->ambil_data_dropdown("keu_surat_undangan","DX","id_surat_undangan","no_surat");
      $data['kota_asal']=$this->m_umum->ambil_data_dropdown("kol_provinsi","XA","id_prov","nama_prov");
      $data['kota_tujuan']=$this->m_umum->ambil_data_dropdown("kol_provinsi","XA","id_prov","nama_prov");
      $this->form_validation->set_rules('no_surat_tugas','Nomor Surat Tugas','required');    

    //--------------------- TAMBAH -----------------------------
      if($mode=='tambah'){  
        $data['page'] =  $data['page']."_tambah"; //jadi surat_tugas_tambah
        
        if ($this->form_validation->run() === FALSE){
          $this->tampil($data);
        }
        else
        {
          if($this->m_kep->surat_tugas_tambah()) 
            redirect(base_url('kep/surat_tugas'));
          else
          {
            $data['pesan']  = "Ada Masalah penambahan Data. Hubungi Admin";
            $data['mode']   = "modal-warning";
            $data['page']   = base_url('kep/surat_tugas');
            $this->t_modal($data);
          }
        }
      }
    //--------------------- EDIT -----------------------------      
      if($mode=='edit'){    
        $data['page'] =  $data['page']."_edit"; //jadi surat_tugas_edit
        $data['id']   = $this->uri->segment(4, 0);
        $data['d']    = $this->m_umum->ambil_data('keu_surat_tugas','id_surat_tugas',$data['id']);
        $data['old_nama_file'] = $data['d']['nama_file']; // Tambahan Roffa

        // print_r($data['d']);
        if ($this->form_validation->run() === FALSE){
          $this->tampil($data);
        }else{
          if($this->m_kep->surat_tugas_edit()) 
            redirect(base_url('kep/surat_tugas'));
          else
            $data['pesan']  = "Ada Masalah Update Data. Hubungi Admin";
            $data['mode']   = "modal-warning";
            $data['page']   = base_url('kep/surat_tugas');
            $this->t_modal($data);
        }
      }
      //--------------------- HAPUS FILE -----------------------------  
      //--------------------- Edit by Roffa --------------------------    
      if ($mode == 'hapus_file') {
        $data['page'] =  $data['page'] . "_edit"; //jadi ak_thn_ak_edit
        $data['id']   = $this->uri->segment(4, 0);
        $data['d']    = $this->m_umum->ambil_data('keu_surat_tugas', 'id_surat_tugas', $data['id']);

        if ($this->m_kep->surat_tugas_hapus_file($data['id']))
          redirect(base_url('kep/surat_tugas/edit/' . $data['id']));
        else
          $data['pesan']  = "Ada Masalah Update Data. Hubungi Admin";
        $data['mode']   = "modal-warning";
        $data['page']   = base_url('kep/surat_masuk');
        $this->t_modal($data);
      }

    }
  }

//=============================== SURAT TUGAS PENGIKUT ===============================
  //keu_surat_tugas -> menampilkan surat tugas, yang dijadikan referensi oleh
  //keu_pengikut -> berisi anggota (id_pengikut) yang berangkat berdasarkan surat tugas id_surat_tugas
  function surat_tugas_pengikut($mode = 'view',$id_surat_tugas,$id_pengikut=NULL){   
    $data['page'] = "surat_tugas_pengikut"; 
    $data['id_surat_tugas']   = $id_surat_tugas;
    $data['d']    = $this->m_umum->ambil_data('keu_surat_tugas','id_surat_tugas',$id_surat_tugas);
    $data['d']['tgl_surat_tugas']=date_format(new DateTime($data['d']['tgl_surat_tugas']),"d-m-Y");

    if($mode=='view')       //tampilkan data surat tugas dan datatables pengikut yang berangkat
      $this->tampil($data);

    else if($mode=='data')
     echo json_encode($this->m_kep->surat_tugas_pengikut_data($id_surat_tugas)); //Model. tampilkan datagrid yg memiliki id_surat_tugas yg sama. 
    
    else if($mode=='hapus'){      //------------------ HAPUS ----------------------      
      if($this->m_umum->hapus_data('keu_pengikut','id_pengikut',$id_pengikut) ){  // tabel, primary field, id
        redirect(base_url('kep/surat_tugas_pengikut/view/').$id_surat_tugas);
      }
      else
        die("Ada masalah HAPUS Data");
    }
    else
    {  
      $this->form_validation->set_rules('nama_pengikut','Nama Pengikut','required');    
      
      if($mode=='tambah'){ 
        if ($this->form_validation->run() === FALSE){
          $this->tampil($data);
        }
        else
        {
          if($this->m_kep->surat_tugas_pengikut_tambah())
            redirect(base_url('kep/surat_tugas_pengikut/view/'.$id_surat_tugas));
          else
          {
            $data['pesan']  = "Ada Masalah penambahan Data. Hubungi Admin";
            $data['mode']   = "modal-warning";
            $data['page']   = base_url('kep/surat_tugas');
            $this->t_modal($data);
          }
        }         
      }
      else if($mode=='edit'){    
        $data['page'] =  $data['page']."_edit"; 
        $data['p']    = $this->m_umum->ambil_data('keu_pengikut','id_pengikut',$id_pengikut);
        if ($this->form_validation->run() === FALSE){
          $this->tampil($data);
        }else{
          if($this->m_kep->surat_tugas_pengikut_edit())
            redirect(base_url('kep/surat_tugas_pengikut/view/'.$data['id'])); 
          else
            $data['pesan']  = "Ada Masalah Update Data. Hubungi Admin";
            $data['mode']   = "modal-warning";
            $data['page']   = base_url('kep/surat_masuk');
            $this->t_modal($data);
        }
      }
    }                
  }

  // function surat_tugas_pengikut($mode,$id)
  // {
  //   if($mode=='data'){
  //    echo json_encode($this->m_kep->surat_tugas_pengikut_data($id)); //coding di model Full Mode. 
  //   }

  // }
  function peg_mhs_cari_data(){
    $id=$this->input->get('query');
    $hasil=array();
    $data=$this->m_kep->cari_peg_mhs_data($id);
    $hasil['suggestions']=$data;
    echo json_encode($hasil);
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
    $this->load->view("kep/header",$data); //Cukup Sekali kirim, semua view dapat $data
    $this->load->view("kep/isi");
    $this->load->view("kep/jsload");
    $this->load->view("kep/jscode");
  }  

  function t_modal($data)  //Load View Tampil Default tanpa Datatables
  {
    $this->load->view("kep/header",$data); //Cukup Sekali kirim, semua view dapat $data
    $this->load->view("kep/pesan");
    $this->load->view("kep/jsload");
    $this->load->view("kep/jspesan");
  }   

  function cetak($data)  //Load View Tampil Default tanpa Datatables
  {
    $this->load->view("kep/c_isi",$data); //Cukup Sekali kirim, semua view dapat $data
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

