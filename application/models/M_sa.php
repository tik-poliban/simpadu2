<?php
class M_sa extends CI_model{

//=========================================  Datagrid Tahun Akademik =====================================
	function ak_thn_ak_data()	//sa.php
	{
	//--------- Ambil nama kolom --------- [coding here]
		$fields = "id_thn_ak, nama_thn_ak, catatan, if(aktif='Y','Ya','Tidak') as aktif, lastaccess";
	//--------- Siapkan Parameter dari datatables ---------
		$draw = intval($this->input->post("draw"));
		$start = intval($this->input->post("start"));
		$length = intval($this->input->post("length"));
		$order = $this->input->post("order");
		$cari = $this->input->post("search");
	//--------- Cek kolom mana yg di urut dan asc/desc -----
		$col =$order[0]['column'];
		$dir= $order[0]['dir'];

	//--------- Ambil nama field dari daftar POST columns dttables
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
		// print_r($output);die();
		return $output;
	}

	function ak_thn_ak_tambah()
	{
		$data=$this->input->post(null,TRUE);
		$data['lastaccess']=date("Y-m-d H:i:s");
		return $this->db->insert('siap_thn_ak', $data);
	}	

	function ak_thn_ak_edit()
	{
		$data=$this->input->post(null,TRUE);
		$data['lastaccess']=date("Y-m-d H:i:s");
		return $this->db->update('siap_thn_ak', $data, array('id_thn_ak' => $data['id_thn_ak']));
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
		  foreach($dt_kolom as $k){
			if($k['searchable']=='true'){ //cek kalo searchable
				switch($k['data']){		//beberapa field ambigius, so sesuaikan [coding here]
					// case 'id_kelas' : $nmf="k.id_kelas";break;
					default: $nmf=$k['data'];
				}
				$this->db->or_like($nmf, $cari['value'],'both',false);
			}
		  }
		}
		$this->db->order_by($dt_kolom[$col]['data'],$dir);  //03 order by

		$this->db->from('siap_kelas k');                   //04 Form.. left join
		$this->db->join('kol_prodi p','p.id_prodi = k.id_prodi','left');
		$this->db->join('siap_program_kelas pk','pk.id_program_kelas = k.id_program_kelas','left');

		$q = $this->db->limit($length,$start)->get_where(); //05 Execute

		$list=$q->result_array(); //06 Hasil

	//--------- Query jumlah filter untuk paging -----
		$this->db->select("COUNT(*) as num");	//01 Select

		if(!empty($cari['value'])) {    //02 Where
		  foreach($dt_kolom as $k){
			if($k['searchable']=='true'){ //cek kalo searchable
				switch($k['data']){		//beberapa field ambigius, so sesuaikan  [coding here]
					// case 'id_kelas' : $nmf="k.id_kelas";break;
					default: $nmf=$k['data'];
				}
				$this->db->or_like($nmf, $cari['value'],'both',false);
			}
		  }
		}

		$this->db->from('siap_kelas k');                   //04 Form.. left join
		$this->db->join('kol_prodi p','p.id_prodi = k.id_prodi','left');
		$this->db->join('siap_program_kelas pk','pk.id_program_kelas = k.id_program_kelas','left');

		$q = $this->db->get_where(); //04 Execute
		$jml_filter = $q->row()->num; //05 Hasil
	//--------- Query jumlah All data paling banyak -----
		$jml = $this->m_umum->jumlah_record_tabel('siap_kelas');		//[coding here] ganti tabel utamanya
				
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

//=========================================  Datagrid Registrasi =====================================
	function ak_registrasi_data()	//sa.php
	{
	//--------- Ambil nama kolom --------- [coding here]
		$fields = "r.id_registrasi_mhs,r.id_thn_ak,p.nama_prodi,r.smt,r.nama_kelas,r.nim,sp.ket as status_spp,k.jumlah,am.nama_status_aktifitas_mhs as status_mhs";

	//--------- Siapkan Parameter dari datatables ---------
		$draw = intval($this->input->post("draw"));
		$start = intval($this->input->post("start"));
		$length = intval($this->input->post("length"));
		$order = $this->input->post("order");
		$cari = $this->input->post("search");
	//--------- Cek kolom mana yg di urut dan asc/desc -----
		$col =$order[0]['column'];
		$dir= $order[0]['dir'];

	//--------- Ambil nama field dari daftar POST columns dttables
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

		$this->db->from('siap_registrasi_mhs r');                   //04 Form.. left join
		$this->db->join('siap_thn_ak tk','tk.id_thn_ak = r.id_thn_ak','left');
		$this->db->join('kol_prodi p','p.id_prodi = r.id_prodi','left');
		$this->db->join('siap_kategori_spp k','k.id_kategori_spp = r.id_kategori_spp','left');
		$this->db->join('siap_status_spp sp','sp.id_status_spp = r.id_status_spp','left');
		$this->db->join('siap_status_aktifitas_mhs am','am.id_status_aktifitas_mhs = r.id_status_aktifitas_mhs','left');

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

		$this->db->from('siap_registrasi_mhs r');                   //04 Form.. left join
		$this->db->join('siap_thn_ak tk','tk.id_thn_ak = r.id_thn_ak','left');
		$this->db->join('kol_prodi p','p.id_prodi = r.id_prodi','left');
		$this->db->join('siap_kategori_spp k','k.id_kategori_spp = r.id_kategori_spp','left');
		$this->db->join('siap_status_spp sp','sp.id_status_spp = r.id_status_spp','left');
		$this->db->join('siap_status_aktifitas_mhs am','am.id_status_aktifitas_mhs = r.id_status_aktifitas_mhs','left');

		$q = $this->db->get_where(); //04 Execute
		$jml_filter = $q->row()->num; //05 Hasil
	//--------- Query jumlah All data paling banyak -----
		$jml = $this->m_umum->jumlah_record_tabel('siap_registrasi_mhs');		//[coding here] ganti tabel utamanya
				
		$output = array(
			"draw" => $draw,
				"recordsTotal" => $jml,
				"recordsFiltered" => $jml_filter,
				"data" => $list
		);
		// print_r($output);die();
		return $output;
	}

//=========================================  Datagrid Kurikulum =====================================
	function ak_kurikulum_data()	//sa.php
	{
	//--------- Ambil nama kolom --------- [coding here]
		$fields = "k.id_kurikulum,mk.nama_mk,k.id_thn_ak,p.nama_prodi";

	//--------- Siapkan Parameter dari datatables ---------
		$draw = intval($this->input->post("draw"));
		$start = intval($this->input->post("start"));
		$length = intval($this->input->post("length"));
		$order = $this->input->post("order");
		$cari = $this->input->post("search");
	//--------- Cek kolom mana yg di urut dan asc/desc -----
		$col =$order[0]['column'];
		$dir= $order[0]['dir'];

	//--------- Ambil nama field dari daftar POST columns dttables
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

		$this->db->from('siap_kurikulum k');                   //04 Form.. left join
		$this->db->join('siap_mk mk','mk.id_mk = k.id_mk','left');
		$this->db->join('siap_thn_ak tk','tk.id_thn_ak = k.id_thn_ak','left');
		$this->db->join('kol_prodi p','p.id_prodi = mk.id_prodi','left');
		
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

		$this->db->from('siap_kurikulum k');                   //04 Form.. left join
		$this->db->join('siap_mk mk','mk.id_mk = k.id_mk','left');
		$this->db->join('siap_thn_ak tk','tk.id_thn_ak = k.id_thn_ak','left');
		$this->db->join('kol_prodi p','p.id_prodi = mk.id_prodi','left');
		
		$q = $this->db->get_where(); //04 Execute
		$jml_filter = $q->row()->num; //05 Hasil
	//--------- Query jumlah All data paling banyak -----
		$jml = $this->m_umum->jumlah_record_tabel('siap_kurikulum');		//[coding here] ganti tabel utamanya
				
		$output = array(
			"draw" => $draw,
				"recordsTotal" => $jml,
				"recordsFiltered" => $jml_filter,
				"data" => $list
		);
		// print_r($output);die();
		return $output;
	}

//=========================================  Datagrid Perkuliahan =====================================
	function ak_kuliah_data()	//sa.php
	{
	//--------- Ambil nama kolom --------- [coding here]
		$fields = "pk.id_perkuliahan,k.nama_kelas,mk.nama_mk,pg.nama_pegawai,r.nama_ruang,pk.pembagi";

	//--------- Siapkan Parameter dari datatables ---------
		$draw = intval($this->input->post("draw"));
		$start = intval($this->input->post("start"));
		$length = intval($this->input->post("length"));
		$order = $this->input->post("order");
		$cari = $this->input->post("search");
	//--------- Cek kolom mana yg di urut dan asc/desc -----
		$col =$order[0]['column'];
		$dir= $order[0]['dir'];

	//--------- Ambil nama field dari daftar POST columns dttables
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

		$this->db->from('siap_perkuliahan pk');                   //04 Form.. left join
		$this->db->join('siap_kelas k','k.id_kelas = pk.id_kelas','left');
		$this->db->join('siap_kurikulum kr','kr.id_kurikulum = pk.id_kurikulum','left');
		$this->db->join('siap_mk mk','mk.id_mk = kr.id_mk','left');
		$this->db->join('simpeg_pegawai pg','pg.id_pegawai = pk.id_pegawai','left');
		$this->db->join('siap_ruang r','r.id_ruang = pk.id_ruang','left');
		
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

		$this->db->from('siap_perkuliahan pk');                   //04 Form.. left join
		$this->db->join('siap_kelas k','k.id_kelas = pk.id_kelas','left');
		$this->db->join('siap_kurikulum kr','kr.id_kurikulum = pk.id_kurikulum','left');
		$this->db->join('siap_mk mk','mk.id_mk = kr.id_mk','left');
		$this->db->join('simpeg_pegawai pg','pg.id_pegawai = pk.id_pegawai','left');
		$this->db->join('siap_ruang r','r.id_ruang = pk.id_ruang','left');
		
		$q = $this->db->get_where(); //04 Execute
		$jml_filter = $q->row()->num; //05 Hasil
	//--------- Query jumlah All data paling banyak -----
		$jml = $this->m_umum->jumlah_record_tabel('siap_perkuliahan');		//[coding here] ganti tabel utamanya
				
		$output = array(
			"draw" => $draw,
				"recordsTotal" => $jml,
				"recordsFiltered" => $jml_filter,
				"data" => $list
		);
		// print_r($output);die();
		return $output;
	}




//=========================================  Datagrid USER =====================================
	function user_data()	//sa.php
	{
	//--------- Ambil nama kolom --------- [coding here]
		$fields = "u.id_user, u.id_level as level, u.username,u.ref_user,p.nama_pegawai, u.ket";
	//--------- Siapkan Parameter dari datatables ---------
		$draw = intval($this->input->post("draw"));
		$start = intval($this->input->post("start"));
		$length = intval($this->input->post("length"));
		$order = $this->input->post("order");
		$cari = $this->input->post("search");
	//--------- Cek kolom mana yg di urut dan asc/desc -----
		$col =$order[0]['column'];
		$dir= $order[0]['dir'];

	//--------- Ambil nama field dari daftar POST columns dttables
		$dt_kolom=$this->input->post("columns");

	//--------- Mulai Query UTAMA ---------------------------
		$this->db->select($fields);  //01 Select
		// $this->db->where('ref_user','2');
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

		$this->db->from('user u');                   //04 Form.. left join
		$this->db->join('simpeg_pegawai p',  'p.id_pegawai = u.ref_user','left');

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

		$this->db->from('user u');                   //04 Form.. left join
		$this->db->join('simpeg_pegawai p',  'p.id_pegawai = u.ref_user','left');

		$q = $this->db->get_where(); //04 Execute
		$jml_filter = $q->row()->num; //05 Hasil
	//--------- Query jumlah All data paling banyak -----
		$jml = $this->m_umum->jumlah_record_tabel('user');		//[coding here] ganti tabel utamanya
				
		$output = array(
			"draw" => $draw,
				"recordsTotal" => $jml,
				"recordsFiltered" => $jml_filter,
				"data" => $list
		);
		// print_r($output);die();
		return $output;
	
	}

	function user_tambah()	//sa.php
	{
		$data=$this->input->post(null,TRUE);
		$data['password']=md5($data['password']);
		$this->db->insert('user', $data);
		return $this->db->insert_id();	// return berupa id terakhir
	}

	function user_edit()
	{
		$data=$this->input->post(null,TRUE);
		if(empty($data['password'])){		//kalo password kosong, ambil, tulis lagi.
			$this->db->select("password");
			$q = $this->db->get_where("user",array("id_user"=>$data['id_user']));
			$row = $q->row_array();
			$data['password']=$row['password'];
		}
		else
			$data['password']=md5($data['password']);

		return $this->db->update('user', $data, array('id_user' => $data['id_user']));
	}
	

//=========================================  Datagrid JURUSAN =====================================
	function jurusan_data()	//sa.php
	{
	//--------- Ambil nama kolom --------- [coding here]
		$fields = "j.id_jurusan,j.nama_jurusan,p1.nama_pegawai as nama_kajur,p2.nama_pegawai as nama_sekjur";
	//--------- Siapkan Parameter dari datatables ---------
		$draw = intval($this->input->post("draw"));
		$start = intval($this->input->post("start"));
		$length = intval($this->input->post("length"));
		$order = $this->input->post("order");
		$cari = $this->input->post("search");
	//--------- Cek kolom mana yg di urut dan asc/desc -----
		$col =$order[0]['column'];
		$dir= $order[0]['dir'];

	//--------- Ambil nama field dari daftar POST columns dttables
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

		$this->db->from('kol_jurusan j');                   //04 Form.. left join
		$this->db->join('simpeg_pegawai p1',  'p1.id_pegawai = j.id_kajur','left');
		$this->db->join('simpeg_pegawai p2',  'p2.id_pegawai = j.id_sekjur','left');

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

		$this->db->from('kol_jurusan j');                   //04 Form.. left join
		$this->db->join('simpeg_pegawai p1',  'p1.id_pegawai = j.id_kajur','left');
		$this->db->join('simpeg_pegawai p2',  'p2.id_pegawai = j.id_sekjur','left');


		$q = $this->db->get_where(); //04 Execute
		$jml_filter = $q->row()->num; //05 Hasil
	//--------- Query jumlah All data paling banyak -----
		$jml = $this->m_umum->jumlah_record_tabel('kol_jurusan');		//[coding here] ganti tabel utamanya
				
		$output = array(
			"draw" => $draw,
				"recordsTotal" => $jml,
				"recordsFiltered" => $jml_filter,
				"data" => $list
		);
		// print_r($output);die();
		return $output;
	
	}
	
//=========================================  Datagrid PRODI =====================================
	function prodi_data()	//sa.php
	{
	//--------- Ambil nama kolom --------- [coding here]
		$fields = "p.id_prodi,p.kode_prodi,j.nama_jurusan,p.nama_prodi,pg.nama_pegawai as nama_kaprodi,p.jenjang,p.akreditasi,p.no_sk_dikti,DATE_FORMAT(p.tgl_sk_dikti, '%d/%m/%Y')as tgl_sk_dikti,p.no_sk_ban";
	//--------- Siapkan Parameter dari datatables ---------
		$draw = intval($this->input->post("draw"));
		$start = intval($this->input->post("start"));
		$length = intval($this->input->post("length"));
		$order = $this->input->post("order");
		$cari = $this->input->post("search");
	//--------- Cek kolom mana yg di urut dan asc/desc -----
		$col =$order[0]['column'];
		$dir= $order[0]['dir'];

	//--------- Ambil nama field dari daftar POST columns dttables
		$dt_kolom=$this->input->post("columns");

	//--------- Mulai Query UTAMA ---------------------------
		$this->db->select($fields);  //01 Select
		$this->db->where('p.id_prodi <>','8');
		$this->db->where('p.id_prodi <>','18');
		$this->db->where('p.id_prodi <>','0');
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

		$this->db->from('kol_prodi p');                   //04 Form.. left join
		$this->db->join('kol_jurusan j',  'j.id_jurusan = p.id_jurusan','left');
		$this->db->join('simpeg_pegawai pg',  'pg.id_pegawai = p.id_kaprodi','left');

		$q = $this->db->limit($length,$start)->get_where(); //05 Execute

		$list=$q->result_array(); //06 Hasil

	//--------- Query jumlah filter untuk paging -----
		$this->db->select("COUNT(*) as num");	//01 Select
		
		$this->db->where('p.id_prodi <>','8');
		$this->db->where('p.id_prodi <>','18');
		$this->db->where('p.id_prodi <>','0');
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

		$this->db->from('kol_prodi p');                   //04 Form.. left join
		$this->db->join('kol_jurusan j',  'j.id_jurusan = p.id_jurusan','left');
		$this->db->join('simpeg_pegawai pg',  'pg.id_pegawai = p.id_kaprodi','left');

		
		$q = $this->db->get_where(); //04 Execute
		$jml_filter = $q->row()->num; //05 Hasil
	//--------- Query jumlah All data paling banyak -----
		
		$filter = "id_prodi NOT IN (8,18,0)";
		$jml = $this->m_umum->jumlah_record_filter('kol_prodi',$filter);		//[coding here] ganti tabel utamanya
				
		$output = array(
			"draw" => $draw,
				"recordsTotal" => $jml,
				"recordsFiltered" => $jml_filter,
				"data" => $list
		);
		// print_r($output);die();
		return $output;
	
	}

//=========================================  Datagrid Wilayah =========================================
	function wilayah_gabung()	//dipakai sa.php  Contoh model datagrid mode 2. Cukup coding di:
	{
		$nama_f=array('id_kel','nama_kel','nama_kec','nama_kab','nama_prov');	//01. select Coding disini
		// POST proses
		$draw = intval($this->input->post("draw"));
    	$start = intval($this->input->post("start"));
    	$length = intval($this->input->post("length"));
      	$order = $this->input->post("order");
      	$cari = $this->input->post("search");

		// Cek kolom mana yg di urut dan asc/desc
        $col = $order['0']['column'];
        $dir = $order['0']['dir'];
        $orderby = $nama_f[$col];


        // ---------------- Query utama Hasilkan Data ------------------------
		$this->db->start_cache();		// start simpan perintah db
	    $this->db->from('kol_kelurahan');										//02. From dan Join coding disini
	    $this->db->join('kol_kecamatan', 'kol_kecamatan.id_kec=kol_kelurahan.id_kec');
	    $this->db->join('kol_kabupaten', 'kol_kabupaten.id_kab=kol_kecamatan.id_kab');
	    $this->db->join('kol_provinsi',  'kol_provinsi.id_prov=kol_kabupaten.id_prov');

      	if($order !=null) {
            $this->db->order_by($orderby, $dir);
    	}
		
        if(!empty($cari['value'])) {
            foreach($nama_f as $d) 
	            $this->db->or_like($d, $cari['value'],'both',false);	            
        }		

		$this->db->stop_cache();	// Stop simpan perintah db
	    $this->db->select($nama_f);
        $list = $this->db->limit($length,$start)->get();
	    
	    $dt = array();
	    foreach($list->result_array() as $d) {
	      $dt1= array();
	      foreach($nama_f as $d1) 
	        $dt1[]=$d[$d1];
	      $dt[] = $dt1; 
	    }
		// Total data
	    $jml = $this->m_umum->jumlah_record_tabel('kol_kelurahan');		//03. Ganti nama tabel. Selesai. 

		// ---------------- Query Hasilkan Jumlah terfilter ------------------------
		
		$this->db->select("COUNT(*) as num");	//select sebelum cache masih tersimpan

		$query = $this->db->get_where();
		$result = $query->row();
		$jml_filter=$result->num;

        $output = array(
	       "draw" => $draw,
	         "recordsTotal" => $jml,
	         "recordsFiltered" => $jml_filter,
	         "data" => $dt
      	);
      	return $output;
	}

}	
?>

