<?php
class M_umum extends CI_model{
//=========================  Modul Umum  ============================
	function cek_login()	//Login.php
	{
		$username=$this->input->post('username');
		$password=md5($this->input->post('password'));
		$query=$this->db->get_where('user', array('username'=>$username, 'password'=>$password));
		return $query->row_array();
	}

    //Jumlah total record dari sebuah tabel
	function jumlah_record_tabel($tabel)	//sa.php
	{
		$query = $this->db->select("COUNT(*) as num")->get($tabel);
	    $result = $query->row();
	    if(isset($result)) 
	    	return $result->num;
	    return 0;
	}
	//Jumlah total record dari sebuah tabel dengan if tertentu
	
    function jumlah_record_filter($tabel,$kondisi)    //igd.php untuk menampilkan jumlah antrian di igd saja
    {
        $this->db->where($kondisi);
        $query = $this->db->select("COUNT(*) as num")->get_where($tabel);
        $result = $query->row();
		//echo $this->db->last_query();die();
        if(isset($result)) 
            return $result->num;
        return 0;
    }
    //Menampilkan jumlah record terfilter untuk keperluan datatable
    function jumlah_record_tabel_filter($tabel,$columns_valid, $cari)   //dibawah
    {
        if(!empty($cari)) {
            foreach($columns_valid as $d) 
                $this->db->or_like($d, $cari,'both',false);             
        }   
        $query = $this->db->select("COUNT(*) as num")->get_where($tabel);
        $result = $query->row();
        if(isset($result)) 
            return $result->num;
        return 0;
    }

	//ambil seluruh data tabel. Jika id ada isi-> ambil satu data saja. $kolom=primary untuk $id
	function ambil_data($tabel, $kolom = FALSE, $id = FALSE)		//header.php
	{
		if($id === FALSE)
		{
			$q = $this->db->get($tabel);
			return $q->result_array();
		}
		$q = $this->db->get_where($tabel,array($kolom=>$id));
		return $q->row_array();				
	}

    function tambah_data($tabel)    //Terpakai. Insert Data Universal
	{
		$data=$this->input->post(null,TRUE);
		$this->db->insert($tabel, $data);
		return $this->db->insert_id();	// return berupa id terakhir	
	}	
	function edit_data($tabel)		//Update Data. Post Array. Primary harus di awal field.
	{						
		$this->db->trans_start();		// untuk cek sukses update tidak							
		$data=$this->input->post(null,TRUE);  	
		$primary=array_slice($data,0,1);	
		array_shift($data);		
	    $this->db->where($primary);
	    $this->db->update($tabel, $data);

	    $this->db->trans_complete();	// untuk cek sukses update tidak
		
		if ($this->db->trans_status() === FALSE)  // untuk cek sukses update tidak
        {
            $this->db->error;
		    // return(FALSE);
        }
		else 
		    return(TRUE);		    
	}
	
	function hapus_data($tabel,$kolom,$id)  //terpakai
	{
		$this->db->delete($tabel,array($kolom => $id));
		if (!$this->db->affected_rows()) 
		    return(FALSE);
		else 
		    return(TRUE);			
	}

    function ambil_data_session_prodi() //digunakan controller Prodi.php
    {   
        //ambil thn ak aktif
        $dt=$this->db->get_where('siap_thn_ak', array('aktif'=>'Y'))->row_array();
        $data['thn_ak_aktif'] = $dt['id_thn_ak'];
        //ambil nama prodi
        $dt = $this->db->get_where('kol_prodi',array('id_prodi'=>$this->session->userdata('id_level')))->row_array();
        $data['nama_prodi'] = $dt['nama_prodi'];
        $data['jenjang'] = $dt['jenjang'];
        return $data;
    }

	//Ambil data untuk dropdown. tabel, primary, text. 
    //jika order tidak di isi. No order. xx, ax
    //Jika ditulis tabel saja, maka field 1 adalah primary, dan field ke 2 adalah isinya.
    //Jika ditulis val, maka hrs berisi primary field, dan text adalah field yg akan ditampilkan
    public function ambil_data_dropdown($tabel,$order='XX',$val=FALSE,$text=FALSE) {           //sa.php
        if(!$val){   //field tabelnya hanya 2. Tidak bisa fitur diatas
            $query = $this->db->get($tabel)->result_array();
            $fields = $this->db->list_fields($tabel);
            foreach ($fields as $field)
                $dt[] = $field;
            array_unshift($query, array($dt[0] => "pildef", $dt[1] => "Silahkan Pilih")); //pildef (pilihan default) = Silahkan Pilih
            $q = array_column($query, $dt[1], $dt[0]);
        }
        else{ //filed tabel lebih dari 2
            switch($order){
                case 'AX': $this->db->order_by($val,'ASC');break;
                case 'DX': $this->db->order_by($val,'DESC');break;
                case 'XA': $this->db->order_by($text,'ASC');break;
                case 'XD': $this->db->order_by($text,'DESC');break;
            }
            $this->db->select($val.',CONCAT("[",'.$val.',"] ",'.$text.') as txt');
            $query = $this->db->get($tabel)->result_array();
            // echo $this->db->last_query();die();
            array_unshift($query, array($val => "pildef", 'txt' => "Silahkan Pilih")); //pildef (pilihan default) = Silahkan Pilih            
            $q = array_column($query, 'txt', $val);
        }
        return $q;
    }

//	======================== MODEL UNTUK DATATABLE : VIEW ONLY ==================================
    function ambil_datatable($data) {   //sa.php
        $draw = intval($this->input->post("draw"));
        $start = intval($this->input->post("start"));
        $length = intval($this->input->post("length"));
        $order = $this->input->post("order");
        $cari = $this->input->post("search");

        $col = $order['0']['column'];
        $dir = $order['0']['dir'];
        $orderby = $data['kolom'][$col];
        $this->db->order_by($orderby, $dir);
        
        if(!empty($cari)) {
            foreach($data['kolom'] as $d) 
                $this->db->or_like($d, $cari['value'],'both',false);
        }       
        $list = $this->db->limit($length,$start)->get($data['tabel']);

        $dt = array();
        foreach ($list->result_array() as $d) {
            $dt1 = array();
            foreach ($data['kolom'] as $d1)
                $dt1[] = $d[$d1];
            $dt[] = $dt1;
        }
        $jml = $this->jumlah_record_tabel($data['tabel']);
        $jml_filter = $this->jumlah_record_tabel_filter($data['tabel'], $data['kolom'], $cari['value']);
        $output = array(
            "draw" => $draw,
            "recordsTotal" => $jml,
            "recordsFiltered" => $jml_filter,
            "data" => $dt
        );
        echo json_encode($output);
        exit();
    }	
}
?>


