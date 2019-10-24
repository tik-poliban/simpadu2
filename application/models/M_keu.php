<?php
class M_keu extends CI_model{
//=========================  Modul Umum  ============================

//=========================================  Datagrid Surat Masuk =====================================
	function surat_masuk_data()	
	{
	//--------- Ambil nama kolom --------- [coding here]
		$fields = "id_surat_undangan,no_surat,DATE_FORMAT(tgl_surat, '%d-%m-%Y')as tgl_surat ,
		perihal,dari,kepada, nama_file";
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

		$this->db->from('keu_surat_undangan');                   //04 Form.. left join

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

		$this->db->from('keu_surat_undangan');                   //04 Form.. left join

		$q = $this->db->get_where(); //04 Execute
		$jml_filter = $q->row()->num; //05 Hasil
	//--------- Query jumlah All data paling banyak -----
		$jml = $this->m_umum->jumlah_record_tabel('keu_surat_undangan');		//[coding here] ganti tabel utamanya
				
		$output = array(
			"draw" => $draw,
				"recordsTotal" => $jml,
				"recordsFiltered" => $jml_filter,
				"data" => $list
		);
		// print_r($output);die();
		return $output;
	}

	
//=========================================  Datagrid Surat Tugas =====================================
	function surat_tugas_data()	
	{
	//--------- Ambil nama kolom --------- [coding here]
		$fields = "st.id_surat_tugas,su.no_surat,st.no_surat_tugas,DATE_FORMAT(st.tgl_surat_tugas, '%d-%m-%Y')as tgl_surat_tugas,st.kegiatan,st.tempat,DATE_FORMAT(st.tgl_awal, '%d-%m-%Y')as tgl_awal,DATE_FORMAT(st.tgl_akhir, '%d-%m-%Y')as tgl_akhir,p1.nama_prov as kota_asal,p2.nama_prov as kota_tujuan,st.id_ttd,st.tembusan,
			st.kt_tujuan, st.kt_asal,
			case when st.id_jenis=1 then 'Full'
				 when st.id_jenis=2 then 'Fullboard'
				 else '-'
			end as jenis,
			st.nama_file 
			";
	//--------- Siapkan Parameter dari datatables ---------
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

		$this->db->from('keu_surat_tugas st');                   //04 Form.. left join
		$this->db->join('keu_surat_undangan su','su.id_surat_undangan = st.id_surat_undangan','left');
		$this->db->join('kol_provinsi p1','p1.id_prov = st.id_kota_asal','left');
		$this->db->join('kol_provinsi p2','p2.id_prov = st.id_kota_tujuan','left');
		
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

		$this->db->from('keu_surat_tugas st');                   //04 Form.. left join
		$this->db->join('keu_surat_undangan su','su.id_surat_undangan = st.id_surat_undangan','left');
		$this->db->join('kol_provinsi p1','p1.id_prov = st.id_kota_asal','left');
		$this->db->join('kol_provinsi p2','p2.id_prov = st.id_kota_tujuan','left');
		
		$q = $this->db->get_where(); //04 Execute
		$jml_filter = $q->row()->num; //05 Hasil
	//--------- Query jumlah All data paling banyak -----
		$jml = $this->m_umum->jumlah_record_tabel('keu_surat_tugas');		//[coding here] ganti tabel utamanya
				
		$output = array(
			"draw" => $draw,
				"recordsTotal" => $jml,
				"recordsFiltered" => $jml_filter,
				"data" => $list
		);
		return $output;
	}

	function surat_tugas_tambah()
	{
		$data=$this->input->post(null,TRUE);
		
		if (!empty($data['tgl_surat_tugas']))
			$data['tgl_surat_tugas']=date_format(new DateTime($data['tgl_surat_tugas']),"Y-m-d");
		if (!empty($data['tgl_awal']))
			$data['tgl_awal']=date_format(new DateTime($data['tgl_awal']),"Y-m-d");
		if (!empty($data['tgl_akhir']))
			$data['tgl_akhir']=date_format(new DateTime($data['tgl_akhir']),"Y-m-d");
		return $this->db->insert('keu_surat_tugas', $data);
	}

//===============================  Datagrid Surat Tugas PENGIKUT =====================================
	function surat_tugas_pengikut_data($id)	
	{
	//--------- Ambil nama kolom --------- [coding here]
		$fields = "st.label_id, st.id, st.nama_pengikut, st.pangkat_gol";
	//--------- Siapkan Parameter dari datatables ---------
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
		$this->db->where('id_surat_tugas',$id);
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

		$this->db->from('keu_pengikut st');                   //04 Form.. left join
		
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

		$this->db->from('keu_pengikut st');                   //04 Form.. left join
		
		$q = $this->db->get_where(); //04 Execute
		$jml_filter = $q->row()->num; //05 Hasil
	//--------- Query jumlah All data paling banyak -----
		$jml = $this->m_umum->jumlah_record_tabel('keu_pengikut');		//[coding here] ganti tabel utamanya
				
		$output = array(
			"draw" => $draw,
				"recordsTotal" => $jml,
				"recordsFiltered" => $jml_filter,
				"data" => $list
		);
		return $output;
	}


	function pengikut_jaldis_data($id)	
	{
		$query = 'SET @i := 0';
		$this->db->query($query);

		$this->db->select(array('@i:=@i+1 as no','nama_pengikut', 'id', 'label_id, pangkat_gol'),false);
		return $this->db->get_where('keu_pengikut',array('id_surat_tugas'=>$id))->result_array();

	}	
//=========================================  Datagrid Surat Tugas FULL =====================================
	function proses_jaldis_data()	
	{
	//--------- Ambil nama kolom --------- [coding here]
		$fields = "kp.id_pengikut,js.nama_surat,st.no_surat_tugas,kp.nama_pengikut,kp.pangkat_gol,kp.jml_hari_harian,
		kp.uang_harian,kp.transport_1,kp.transport_2,kp.transport_3,kp.jml_hari_penginapan,kp.penginapan";
	//--------- Siapkan Parameter dari datatables ---------
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

		$this->db->from('keu_pengikut kp');                   //04 Form.. left join
		$this->db->join('keu_surat_tugas st','st.id_surat_tugas = kp.id_surat_tugas','left');
		$this->db->join('jenis_surat js','js.id_jenis = st.id_jenis','left');
		
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

		$this->db->from('keu_pengikut kp');                   //04 Form.. left join
		$this->db->join('keu_surat_tugas st','st.id_surat_tugas = kp.id_surat_tugas','left');
		$this->db->join('jenis_surat js','js.id_jenis = st.id_jenis','left');
		
		$q = $this->db->get_where(); //04 Execute
		$jml_filter = $q->row()->num; //05 Hasil
	//--------- Query jumlah All data paling banyak -----
		$jml = $this->m_umum->jumlah_record_tabel('keu_pengikut');		//[coding here] ganti tabel utamanya
				
		$output = array(
			"draw" => $draw,
				"recordsTotal" => $jml,
				"recordsFiltered" => $jml_filter,
				"data" => $list
		);
		return $output;
	}
	function hitung_jumlah_hari($id)
	{
		$this->db->select('id_surat_tugas');
		$d = $this->db->get_where('keu_pengikut',array('id_pengikut'=>$id))->row_array();
		// echo "surat_tugs = ".$d['id_surat_tugas'];

		$this->db->select('DATEDIFF(tgl_akhir,tgl_awal) as j_hari');
		$d = $this->db->get_where('keu_surat_tugas',array('id_surat_tugas'=>$d['id_surat_tugas']))->row_array();
		// echo $this->db->last_query();
		// print_r($d);die();
		return $d['j_hari'];
	}
	function surat_tugas_pengikut_tambah()
	{
		$data=$this->input->post(null,TRUE);
		return $this->db->insert('keu_pengikut', $data);
	}

	function cari_peg_mhs_data($id)
	{   
		$this->db->select("id_pegawai as data, nama_pegawai as value, nip_baru");
        $this->db->or_like("nama_pegawai", $id);
        $this->db->limit('50,0');
        return $this->db->get_where('simpeg_pegawai')->result_array();
    }
	function ambil_data_uangharian($id)
	{
		$this->db->select("sp.id_pengikut,st.id_kota_tujuan");
        $this->db->where('sp.id_pengikut',$id);
		$this->db->from('keu_pengikut sp'); 
		$this->db->join('keu_surat_tugas st','st.id_surat_tugas = sp.id_surat_tugas','left');
		$q = $this->db->get_where(); //05 Execute
	// print_r($q->result_array());die();
		return $q->result_array(); //06 Hasil
	}
	function ambil_data_transport1($id)
	{
		$this->db->select("sp.id_pengikut,st.id_kota_asal");
        $this->db->where('sp.id_pengikut',$id);
		$this->db->from('keu_pengikut sp'); 
		$this->db->join('keu_surat_tugas st','st.id_surat_tugas = sp.id_surat_tugas','left');
		$q = $this->db->get_where(); //05 Execute
	// print_r($q->result_array());die();
		return $q->result_array(); //06 Hasil
	}
	function ambil_data_transport3($id)
	{
		$this->db->select("sp.id_pengikut,st.id_kota_tujuan");
        $this->db->where('sp.id_pengikut',$id);
		$this->db->from('keu_pengikut sp'); 
		$this->db->join('keu_surat_tugas st','st.id_surat_tugas = sp.id_surat_tugas','left');
		$q = $this->db->get_where(); //05 Execute
	// print_r($q->result_array());die();
		return $q->result_array(); //06 Hasil
	}
	function ambil_data_uangpenginapan($id)
	{
		$this->db->select("sp.id_pengikut,st.id_kota_tujuan,sp.golongan");
        $this->db->where('sp.id_pengikut',$id);
		$this->db->from('keu_pengikut sp'); 
		$this->db->join('keu_surat_tugas st','st.id_surat_tugas = sp.id_surat_tugas','left');
		$q = $this->db->get_where(); //05 Execute
	// print_r($q->result_array());die();
		return $q->result_array(); //06 Hasil
	}
	function cetak_rincian_data($id)
	{
		$this->db->select("sp.nama_pengikut,sp.pangkat_gol,sp.jabatan,st.kegiatan,st.angkutan,sp.id as nip,DATE_FORMAT(now(), '%d-%m-%Y') as tgl_sekarang,pr1.nama_prov as kota_asal,pr2.nama_prov as kota_tujuan,sp.jml_hari_penginapan,sp.penginapan,sp.transport_1,sp.transport_2,sp.transport_3,sp.jml_hari_harian,sp.uang_harian,sp.id_pengikut,st.id_kota_tujuan,st.no_surat_tugas,DATE_FORMAT(st.tgl_surat_tugas, '%d-%m-%Y')as tgl_surat,DATE_FORMAT(st.tgl_awal, '%d-%m-%Y')as tgl_berangkat,,DATE_FORMAT(st.tgl_akhir, '%d-%m-%Y')as tgl_kembali");
        $this->db->where('sp.id_pengikut',$id);
		$this->db->from('keu_pengikut sp'); 
		$this->db->join('keu_surat_tugas st','st.id_surat_tugas = sp.id_surat_tugas','left');
		$this->db->join('kol_provinsi pr1','pr1.id_prov = st.id_kota_asal','left');
		$this->db->join('kol_provinsi pr2','pr2.id_prov = st.id_kota_tujuan','left');
		return $this->db->get_where()->row_array(); //05 Execute
	}
}	
?>