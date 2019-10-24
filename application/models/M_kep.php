<?php
class M_kep extends CI_model{
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

	function surat_masuk_tambah()
	{
		$data = $this->input->post(null, TRUE);

		$old_nama_file = $this->input->post('old_nama_file', TRUE);

		$config['upload_path'] = './assets/dokumen/surat_undangan';
		$config['upload_url'] = base_url('/assets/dokumen/surat_undangan');
		$config['allowed_types'] = 'pdf|jpg';
		$config['overwrite'] = true;
		$config['max_size'] = 5120;
		$config['file_name'] = 'SU-' . date('YmdHis') . '.pdf';
		$this->load->library('upload', $config);

		if ($this->upload->do_upload('nama_file')) {
			$upload_data = $this->upload->data();
			$nama_file = $upload_data['file_name'];
		} else {
			$nama_file = $old_nama_file;
		}

		unset($data['old_nama_file']);
		$data['nama_file'] = $nama_file;

		if (!empty($data['tgl_surat']))
			$data['tgl_surat'] = date_format(new DateTime($data['tgl_surat']), "Y-m-d");

		return $this->db->insert('keu_surat_undangan', $data);
	}	

	function surat_masuk_edit()
	{
		$data = $this->input->post(null, TRUE);

		$old_nama_file = $data['old_nama_file'];
		unset($data['old_nama_file']);

		$config['upload_path'] = './assets/dokumen/surat_undangan';
		$config['upload_url'] = base_url('/assets/dokumen/surat_undangan');
		$config['allowed_types'] = 'pdf|jpg';
		$config['overwrite'] = true;
		$config['max_size'] = 5120;
		$config['file_name'] = 'SU-' . date('Ymdhis') . '.pdf';
		$this->load->library('upload', $config);

		if ($this->upload->do_upload('nama_file')) {
			$upload_data = $this->upload->data();
			$nama_file = $upload_data['file_name'];
		} else {
			$nama_file = $old_nama_file;
		}

		$data['nama_file'] = $nama_file;

		$data['tgl_surat'] = new DateTime($data['tgl_surat']);
		$data['tgl_surat'] = date_format($data['tgl_surat'], "Y-m-d");
		return $this->db->update('keu_surat_undangan', $data, array('id_surat_undangan' => $data['id_surat_undangan']));

	}
	//------------------------- Edited by Roffa -----------------------------
	function surat_masuk_hapus_file($id)
	{
		$data    = $this->m_umum->ambil_data('keu_surat_undangan', 'id_surat_undangan', $id);

		$nama_file = './assets/dokumen/surat_undangan/' . $data['nama_file'];
		unlink($nama_file);

		$data['nama_file'] = '';
		return $this->db->update('keu_surat_undangan', $data, array('id_surat_undangan' => $data['id_surat_undangan']));
	}
	
//=========================================  Datagrid Surat Tugas =====================================
	function surat_tugas_data()	
	{
	//--------- Ambil nama kolom --------- [coding here]
		$fields = "st.id_surat_tugas,su.no_surat,st.no_surat_tugas,DATE_FORMAT(st.tgl_surat_tugas, '%d-%m-%Y')as tgl_surat_tugas,st.kegiatan,st.tempat,DATE_FORMAT(st.tgl_awal, '%d-%m-%Y')as tgl_awal,DATE_FORMAT(st.tgl_akhir, '%d-%m-%Y')as tgl_akhir,p1.nama_prov as kota_asal,p2.nama_prov as kota_tujuan,st.id_ttd,st.tembusan,
			st.kt_asal, st.kt_tujuan,
			st.nama_file";
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
		
		$old_nama_file = $this->input->post('old_nama_file', TRUE);

		$config['upload_path'] = './assets/dokumen/surat_tugas';
		$config['upload_url'] = base_url('/assets/dokumen/surat_tugas');
		$config['allowed_types'] = 'pdf|jpg';
		$config['overwrite'] = true;
		$config['max_size'] = 5120;
		$config['file_name'] = 'ST-' . date('YmdHis') . '.pdf';
		$this->load->library('upload', $config);

		if ($this->upload->do_upload('nama_file')) {
			$upload_data = $this->upload->data();
			$nama_file = $upload_data['file_name'];
		} else {
			$nama_file = $old_nama_file;
		}

		unset($data['old_nama_file']);
		$data['nama_file'] = $nama_file;

		if (!empty($data['tgl_surat_tugas']))
			$data['tgl_surat_tugas']=date_format(new DateTime($data['tgl_surat_tugas']),"Y-m-d");
		if (!empty($data['tgl_awal']))
			$data['tgl_awal']=date_format(new DateTime($data['tgl_awal']),"Y-m-d");
		if (!empty($data['tgl_akhir']))
			$data['tgl_akhir']=date_format(new DateTime($data['tgl_akhir']),"Y-m-d");
		return $this->db->insert('keu_surat_tugas', $data);
	}

	function surat_tugas_edit()
	{
		$data=$this->input->post(null,TRUE);

		$old_nama_file = $data['old_nama_file'];
		unset($data['old_nama_file']);

		$config['upload_path'] = './assets/dokumen/surat_tugas';
		$config['upload_url'] = base_url('/assets/dokumen/surat_tugas');
		$config['allowed_types'] = 'pdf|jpg';
		$config['overwrite'] = true;
		$config['max_size'] = 5120;
		$config['file_name'] = 'ST-' . date('Ymdhis') . '.pdf';
		$this->load->library('upload', $config);

		if ($this->upload->do_upload('nama_file')) {
			$upload_data = $this->upload->data();
			$nama_file = $upload_data['file_name'];
		} else {
			$nama_file = $old_nama_file;
		}

		$data['nama_file'] = $nama_file;

		return $this->db->update('keu_surat_tugas', $data, array('id_surat_tugas' => $data['id_surat_tugas']));
	}

	//------------------------- Edited by Roffa -----------------------------
	function surat_tugas_hapus_file($id)
	{
		$data    = $this->m_umum->ambil_data('keu_surat_tugas', 'id_surat_tugas', $id);

		$nama_file = './assets/dokumen/surat_tugas/' . $data['nama_file'];
		unlink($nama_file);

		$data['nama_file'] = '';
		return $this->db->update('keu_surat_tugas', $data, array('id_surat_tugas' => $data['id_surat_tugas']));
	}

//===============================  Datagrid Surat Tugas PENGIKUT =====================================
	function surat_tugas_pengikut_data($id)	
	{
	//--------- Ambil nama kolom --------- [coding here]
		$fields = "st.id_pengikut, st.label_id, st.id, st.nama_pengikut, st.pangkat_gol, st.id_pengikut, st.id_surat_tugas";
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

	function surat_tugas_pengikut_tambah()
	{
		$data=$this->input->post(null,TRUE);
		return $this->db->insert('keu_pengikut', $data);
	}

	function cari_peg_mhs_data($id)
	{   
		$q=$this->db->query("
select nip_baru as data, concat('[',nip_baru,'] ',nama_pegawai) as value, 
nama_pegawai as nama_pengikut, nama_status_pegawai ,'NIP' as label_id
from simpeg_pegawai
left join simpeg_status_pegawai on simpeg_status_pegawai.id_status_pegawai=simpeg_pegawai.id_status_pegawai
where nama_pegawai like \"%".$id."%\"
union 
select NIM, concat('[',nim,'] ',nama_mhs), nama_mhs, 'mahasiswa', 'nim'
from siap_mhs
where nama_mhs like \"%".$id."%\"
order by 2 asc
limit 0,50");
		return $q->result_array();

		// $this->db->select("select nip_baru as id, nama_pegawai as nama, nama_status_pegawai ,'nip' as label");
		// $this->db->select("id_pegawai as data, nama_pegawai as value, nip_baru");
  //       $this->db->or_like("nama_pegawai", $id);
  //       $this->db->limit('50,0');
        // return $this->db->get_where('simpeg_pegawai')->result_array();
    }

    function surat_tugas_peserta_cetak($id)
    {
    	$this->db->where('id_surat_tugas',$id);
    	return $this->db->get_where("keu_pengikut")->result_array();
    }
}	

?>