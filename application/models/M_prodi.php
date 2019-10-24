<?php
class M_prodi extends CI_model{
//=========================  Modul Umum  ============================
	function thn_ak_aktif()
	{
		$d=$this->db->get_where('siap_thn_ak', array('aktif'=>'Y'))->row_array();
		return $d['id_thn_ak'];
	}


//=========================================  Datagrid Tahun Akademik =====================================
	function ak_thn_ak_data()	//sa.php
	{
		$fields = "id_thn_ak, nama_thn_ak, catatan, if(aktif='Y','Ya','Tidak') as aktif, lastaccess";

		$draw = intval($this->input->post("draw"));
		$start = intval($this->input->post("start"));
		$length = intval($this->input->post("length"));
		$order = $this->input->post("order");
		$cari = $this->input->post("search");
		$col =$order[0]['column'];
		$dir= $order[0]['dir'];

		$dt_kolom=$this->input->post("columns");

	//--------- Mulai Query UTAMA ---------------------------
		$this->db->select($fields);  //01 Select

		if(!empty($cari['value'])) {    //02 Where
		  foreach($dt_kolom as $k){
			if($k['searchable']=='true'){ //cek kalo searchable
				switch($k['data']){		//beberapa field ambigius, so sesuaikan [coding here]
					// case 'RM' : $nmf="pd.RM";break;
					default: $nmf=$k['data'];
				}
				$this->db->or_like($nmf, $cari['value'],'both',false);
			}
		  }
		}
		$this->db->order_by($dt_kolom[$col]['data'],$dir);  //03 order by

		$this->db->from('siap_thn_ak');                   //04 Form.. left join

		$q = $this->db->limit($length,$start)->get_where(); //05 Execute

		$list=$q->result_array(); //06 Hasil

	//--------- Query jumlah filter untuk paging -----
		$this->db->select("COUNT(*) as num");	//01 Select

		if(!empty($cari['value'])) {    //02 Where
		  foreach($dt_kolom as $k){
			if($k['searchable']=='true'){ //cek kalo searchable
				switch($k['data']){		//beberapa field ambigius, so sesuaikan  [coding here]
					// case 'RM' : $nmf="pd.RM";break;
					default: $nmf=$k['data'];
				}
				$this->db->or_like($nmf, $cari['value'],'both',false);
			}
		  }
		}

		$this->db->from('siap_thn_ak');                   //04 Form.. left join

		$q = $this->db->get_where(); //04 Execute
		$jml_filter = $q->row()->num; //05 Hasil
	//--------- Query jumlah All data paling banyak -----
		$jml = $this->m_umum->jumlah_record_tabel('siap_thn_ak');		//[coding here] ganti tabel utamanya
				
		$output = array(
			"draw" => $draw,
				"recordsTotal" => $jml,
				"recordsFiltered" => $jml_filter,
				"data" => $list
		);
		return $output;
	}


//=========================================  Datagrid KELAS =====================================
	function kelas_data()	//sa.php
	{
	//--------- Ambil nama kolom --------- [coding here]
		$fields = "k.id_kelas,k.id_thn_ak,k.id_prodi,p.nama_prodi,k.smt,k.nama_kelas,k.alias,pk.nama_program_kelas,k.ket";

		$draw = intval($this->input->post("draw"));
		$start = intval($this->input->post("start"));
		$length = intval($this->input->post("length"));
		$order = $this->input->post("order");
		$cari = $this->input->post("search");
		$col =$order[0]['column'];
		$dir= $order[0]['dir'];
		$dt_kolom=$this->input->post("columns");

	//--------- Mulai Query UTAMA ---------------------------
		$this->db->select($fields);  //01 Select

		if(!empty($cari['value'])) {    //02 Where
		$this->db->group_start(); // Open bracket			
		  foreach($dt_kolom as $k){
			if($k['searchable']=='true'){ //cek kalo searchable
				switch($k['data']){		//beberapa field ambigius, so sesuaikan [coding here]
					// case 'id_kelas' : $nmf="k.id_kelas";break;
					default: $nmf=$k['data'];
				}
				$this->db->or_like($nmf, $cari['value'],'both',false);
			}
		  }
		$this->db->group_end(); // Close bracket					  
		}
		$this->db->order_by($dt_kolom[$col]['data'],$dir);  //03 order by

		$this->db->from('siap_kelas k');                   //04 Form.. left join
		$this->db->join('kol_prodi p','p.id_prodi = k.id_prodi','left');
		$this->db->join('siap_program_kelas pk','pk.id_program_kelas = k.id_program_kelas','left');
		$this->db->where('k.id_prodi',$this->session->userdata('id_level'));

		$q = $this->db->limit($length,$start)->get_where(); //05 Execute

		$list=$q->result_array(); //06 Hasil
		// echo $this->db->last_query();die();
	//--------- Query jumlah filter untuk paging -----
		$this->db->select("COUNT(*) as num");	//01 Select
		$this->db->group_start(); // Open bracket			
		  foreach($dt_kolom as $k){
			if($k['searchable']=='true'){ //cek kalo searchable
				switch($k['data']){		//beberapa field ambigius, so sesuaikan [coding here]
					// case 'id_kelas' : $nmf="k.id_kelas";break;
					default: $nmf=$k['data'];
				}
				$this->db->or_like($nmf, $cari['value'],'both',false);
			}
		  }
		$this->db->group_end(); // Close bracket

		if(!empty($cari['value'])) {    //02 Where
		}

		$this->db->from('siap_kelas k');                   //04 Form.. left join
		$this->db->join('kol_prodi p','p.id_prodi = k.id_prodi','left');
		$this->db->join('siap_program_kelas pk','pk.id_program_kelas = k.id_program_kelas','left');
		$this->db->where('k.id_prodi',$this->session->userdata('id_level'));

		$q = $this->db->get_where(); //04 Execute
		$jml_filter = $q->row()->num; //05 Hasil
	//--------- Query jumlah All data paling banyak -----
		//[coding here] ganti tabel utamanya. Hati2. Ini contoh yang ada filternya
		$jml = $this->m_umum->jumlah_record_filter('siap_kelas',array('id_prodi'=>$this->session->userdata('id_level')));	

		$output = array(
			"draw" => $draw,
				"recordsTotal" => $jml,
				"recordsFiltered" => $jml_filter,
				"data" => $list
		);
		// print_r($output);die();
		return $output;
	}

//=========================================  Datagrid Range Nilai =====================================
	function ak_range_data()	//sa.php
	{
	//--------- Ambil nama kolom --------- [coding here]
		$fields = "id_angka_huruf,id_thn_ak,nilai,huruf";

		$draw = intval($this->input->post("draw"));
		$start = intval($this->input->post("start"));
		$length = intval($this->input->post("length"));
		$order = $this->input->post("order");
		$cari = $this->input->post("search");
		$col =$order[0]['column'];
		$dir= $order[0]['dir'];

		$dt_kolom=$this->input->post("columns");

		$this->db->select($fields);  //01 Select

		if(!empty($cari['value'])) {    //02 Where
		  foreach($dt_kolom as $k){
			if($k['searchable']=='true'){ //cek kalo searchable
				switch($k['data']){		//beberapa field ambigius, so sesuaikan [coding here]
					// case 'RM' : $nmf="pd.RM";break;
					default: $nmf=$k['data'];
				}
				$this->db->or_like($nmf, $cari['value'],'both',false);
			}
		  }
		}
		$this->db->order_by($dt_kolom[$col]['data'],$dir);  //03 order by

		$this->db->from('siap_angka_huruf');                   //04 Form.. left join

		$q = $this->db->limit($length,$start)->get_where(); //05 Execute

		$list=$q->result_array(); //06 Hasil

	//--------- Query jumlah filter untuk paging -----
		$this->db->select("COUNT(*) as num");	//01 Select

		if(!empty($cari['value'])) {    //02 Where
		  foreach($dt_kolom as $k){
			if($k['searchable']=='true'){ //cek kalo searchable
				switch($k['data']){		//beberapa field ambigius, so sesuaikan  [coding here]
					// case 'RM' : $nmf="pd.RM";break;
					default: $nmf=$k['data'];
				}
				$this->db->or_like($nmf, $cari['value'],'both',false);
			}
		  }
		}

		$this->db->from('siap_angka_huruf');                   //04 Form.. left join

		$q = $this->db->get_where(); //04 Execute
		$jml_filter = $q->row()->num; //05 Hasil
	//--------- Query jumlah All data paling banyak -----
		$jml = $this->m_umum->jumlah_record_tabel('siap_angka_huruf');		//[coding here] ganti tabel utamanya
				
		$output = array(
			"draw" => $draw,
				"recordsTotal" => $jml,
				"recordsFiltered" => $jml_filter,
				"data" => $list
		);
		// print_r($output);die();
		return $output;
	}





}	
?>

