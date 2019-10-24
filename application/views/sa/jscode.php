<script type="text/javascript">


<?php
//================================================= H O M E =================================================
if ($page=="home")  
{
	//	Agar saat home tidak ke universal
}
//================================================= Tahun Akademik =================================================
else if($page=='ak_thn_ak') 
{
?>
    $(document).ready(function() {
        $('#dttb').DataTable( {
            "processing": true,
            "serverSide": true,
            "scrollX": true,              
            "ajax": {
                "url"  : "<?php echo base_url();?>sa/<?php echo $page;?>/data",  //ganti controller
                "type" : "POST"
            },
            "columns": [                       //sesuaikan Field yang ditampilkan. Harus persis tabel mysql
                      { "data": "id_thn_ak" },
                      { "data": "nama_thn_ak" },
                      { "data": "catatan" },
                      { "data": "aktif" },
                      { "data": "lastaccess" }
            ],            
            select: 'single',
            dom: 'Blfrtip',
            "order": [[0, 'desc']] ,            
            "buttons": [
                {
                    text: "<i class='fa fa-plus'></i> Tambah",
                    className: "btnTambah",
                    init: function(api, node, config) {
                        $(node).removeClass('btn-default')
                    },
                    action: function ( e, dt, node, config ) {
                        location.href = '<?php echo base_url('sa/'.$page.'/tambah'); ?>'; //ganti controller
                    }
                },
                {
                    text: "<i class='fa fa-pencil'></i> Edit",
                    className: "btnEdit",
                    extend: "selected",
                    action: function ( e, dt, node, config ) {
                        data = dt.rows( { selected: true } ).data()[0]['id_thn_ak'];  //[Modif Disini]
                        // alert(JSON.stringify(data));
                        location.href = '<?php echo base_url('sa/'.$page.'/edit/'); ?>'+data; //ganti controller
                    }
                },
                {
                    text: "<i class='fa fa-trash'></i> Hapus",
                    className: "btnHapus",
                    extend: "selected",
                    action: function ( e, dt, node, config ) {
                        data = dt.rows( { selected: true } ).data()[0];  
                        swal({
                          title: "Yakin ?",
                          text: "Yakin akan menghapus = "+data['nama_thn_ak'],     //[Modif Disini]
                          icon: "warning",
                          buttons: true,
                          dangerMode: true,
                        })
                        .then((willDelete) => {
                          if (willDelete) {                     //ganti controller dibawah ini
                            location.href = '<?php echo base_url('sa/'.$page.'/hapus/'); ?>'+data['id_thn_ak']; //[Modif Disini]
                          } 
                        });
                    }
                },
                {
                    text: "<i class='fa fa-refresh'></i> Reload",
                    className: "btnReload",
                    init: function(api, node, config) {
                        $(node).removeClass('btn-default')
                    },
                    action: function ( e, dt, node, config ) {
                        dt.ajax.reload();
                    }
                }
            ],    
        });
        $(".dt-buttons").addClass("rapikan_tb_dtgrid");     
        $(".btnTambah").removeClass("dt-button").addClass("btn btn-primary btn-sm");
        $(".btnEdit").removeClass("dt-button").addClass("btn btn-warning btn-sm");
        $(".btnHapus").removeClass("dt-button").addClass("btn btn-danger btn-sm");
        $(".btnReload").removeClass("dt-button").addClass("btn btn-success btn-sm");
    });
<?php
}


//================================================= K E L A S  =================================================
else if($page=='ak_kelas') 
{
?>
    $(document).ready(function() {
        $('#dttb').DataTable( {
            "processing": true,
            "serverSide": true,
            "ajax": {
                "url"  : "<?php echo base_url();?>sa/<?php echo $page;?>/data",
                "type" : "POST"
            },
            "columns": [
                      { "data": "id_kelas" },
                      { "data": "id_thn_ak" },
                      { "data": "nama_prodi" },
                      { "data": "smt" },
                      { "data": "nama_kelas" },
                      { "data": "alias" },
                      { "data": "nama_program_kelas" },
                      { "data": "ket" }
            ],            
            select: 'single',
            dom: 'Blfrtip',
            "order": [[0, 'desc']] ,            
            "buttons": [
                {
                    text: "<i class='fa fa-plus'></i> Tambah",
                    className: "btnTambah",
                    init: function(api, node, config) {
                        $(node).removeClass('btn-default')
                    },
                    action: function ( e, dt, node, config ) {
                        location.href = '<?php echo base_url('sa/'.$page.'/tambah'); ?>';
                    }
                },
                {
                    text: "<i class='fa fa-pencil'></i> Edit",
                    className: "btnEdit",
                    extend: "selected",
                    action: function ( e, dt, node, config ) {
                        data = dt.rows( { selected: true } ).data()[0]['id_kelas'];  //[Modif Disini]
                        // alert(JSON.stringify(data));
                        location.href = '<?php echo base_url('sa/'.$page.'/edit/'); ?>'+data;
                    }
                },
                {
                    text: "<i class='fa fa-trash'></i> Hapus",
                    className: "btnHapus",
                    extend: "selected",
                    action: function ( e, dt, node, config ) {
                        data = dt.rows( { selected: true } ).data()[0];  
                        swal({
                          title: "Yakin ?",
                          text: "Yakin akan menghapus = "+data['nama_kelas'],     //[Modif Disini]
                          icon: "warning",
                          buttons: true,
                          dangerMode: true,
                        })
                        .then((willDelete) => {
                          if (willDelete) {
                            location.href = '<?php echo base_url('sa/'.$page.'/hapus/'); ?>'+data['id_kelas']; //[Modif Disini]
                          } 
                        });
                    }
                },
                {
                    text: "<i class='fa fa-refresh'></i> Reload",
                    className: "btnReload",
                    init: function(api, node, config) {
                        $(node).removeClass('btn-default')
                    },
                    action: function ( e, dt, node, config ) {
                        dt.ajax.reload();
                    }
                }
            ],    
        });
        $(".dt-buttons").addClass("rapikan_tb_dtgrid");     
        $(".btnTambah").removeClass("dt-button").addClass("btn btn-primary btn-sm");
        $(".btnEdit").removeClass("dt-button").addClass("btn btn-warning btn-sm");
        $(".btnHapus").removeClass("dt-button").addClass("btn btn-danger btn-sm");
        $(".btnReload").removeClass("dt-button").addClass("btn btn-success btn-sm");
    });

<?php
}

//================================================= Range Nilai =================================================
else if($page=='ak_range') 
{
?>
    $(document).ready(function() {
        $('#dttb').DataTable( {
            "processing": true,
            "serverSide": true,
            "scrollX": true,              
            "ajax": {
                "url"  : "<?php echo base_url();?>sa/<?php echo $page;?>/data",  //ganti controller
                "type" : "POST"
            },
            "columns": [                       //sesuaikan Field yang ditampilkan. Harus persis tabel mysql
                      { "data": "id_angka_huruf" },
                      { "data": "id_thn_ak" },
                      { "data": "nilai" },
                      { "data": "huruf" }
            ],            
            select: 'single',
            dom: 'Blfrtip',
            "order": [[1, 'desc']] ,            
            "buttons": [
                {
                    text: "<i class='fa fa-plus'></i> Tambah",
                    className: "btnTambah",
                    init: function(api, node, config) {
                        $(node).removeClass('btn-default')
                    },
                    action: function ( e, dt, node, config ) {
                        location.href = '<?php echo base_url('sa/'.$page.'/tambah'); ?>'; //ganti controller
                    }
                },
                {
                    text: "<i class='fa fa-pencil'></i> Edit",
                    className: "btnEdit",
                    extend: "selected",
                    action: function ( e, dt, node, config ) {
                        data = dt.rows( { selected: true } ).data()[0]['id_angka_huruf'];  //[Modif Disini]
                        // alert(JSON.stringify(data));
                        location.href = '<?php echo base_url('sa/'.$page.'/edit/'); ?>'+data; //ganti controller
                    }
                },
                {
                    text: "<i class='fa fa-trash'></i> Hapus",
                    className: "btnHapus",
                    extend: "selected",
                    action: function ( e, dt, node, config ) {
                        data = dt.rows( { selected: true } ).data()[0];  
                        swal({
                          title: "Yakin ?",
                          text: "Yakin akan menghapus = "+data['nilai'],     //[Modif Disini]
                          icon: "warning",
                          buttons: true,
                          dangerMode: true,
                        })
                        .then((willDelete) => {
                          if (willDelete) {                     //ganti controller dibawah ini
                            location.href = '<?php echo base_url('sa/'.$page.'/hapus/'); ?>'+data['id_angka_huruf']; //[Modif Disini]
                          } 
                        });
                    }
                },
                {
                    text: "<i class='fa fa-refresh'></i> Reload",
                    className: "btnReload",
                    init: function(api, node, config) {
                        $(node).removeClass('btn-default')
                    },
                    action: function ( e, dt, node, config ) {
                        dt.ajax.reload();
                    }
                }
            ],    
        });
        $(".dt-buttons").addClass("rapikan_tb_dtgrid");     
        $(".btnTambah").removeClass("dt-button").addClass("btn btn-primary btn-sm");
        $(".btnEdit").removeClass("dt-button").addClass("btn btn-warning btn-sm");
        $(".btnHapus").removeClass("dt-button").addClass("btn btn-danger btn-sm");
        $(".btnReload").removeClass("dt-button").addClass("btn btn-success btn-sm");
    });
<?php
}

//============================================= REGISTRASI ==============================================
else if($page=='ak_registrasi') 
{
?>
    $(document).ready(function() {
        $('#dttb').DataTable( {
            "processing": true,
            "serverSide": true,
            "scrollX": true,              
            "ajax": {
                "url"  : "<?php echo base_url();?>sa/<?php echo $page;?>/data",  //ganti controller
                "type" : "POST"
            },
            "columns": [                       //sesuaikan Field yang ditampilkan. Harus persis tabel mysql
                      { "data": "id_registrasi_mhs" },
                      { "data": "id_thn_ak" },
                      { "data": "nama_prodi" },
                      { "data": "smt" },
                      { "data": "nama_kelas" },
                      { "data": "nim" },
                      { "data": "status_spp" },
                      { "data": "jumlah" },
                      { "data": "status_mhs" }
            ],            
            select: 'single',
            dom: 'Blfrtip',
            "order": [[0, 'desc']] ,            
            "buttons": [
                {
                    text: "<i class='fa fa-plus'></i> Tambah",
                    className: "btnTambah",
                    init: function(api, node, config) {
                        $(node).removeClass('btn-default')
                    },
                    action: function ( e, dt, node, config ) {
                        location.href = '<?php echo base_url('sa/'.$page.'/tambah'); ?>'; //ganti controller
                    }
                },
                {
                    text: "<i class='fa fa-pencil'></i> Edit",
                    className: "btnEdit",
                    extend: "selected",
                    action: function ( e, dt, node, config ) {
                        data = dt.rows( { selected: true } ).data()[0]['id_registrasi_mhs'];  //[Modif Disini]
                        // alert(JSON.stringify(data));
                        location.href = '<?php echo base_url('sa/'.$page.'/edit/'); ?>'+data; //ganti controller
                    }
                },
                {
                    text: "<i class='fa fa-trash'></i> Hapus",
                    className: "btnHapus",
                    extend: "selected",
                    action: function ( e, dt, node, config ) {
                        data = dt.rows( { selected: true } ).data()[0];  
                        swal({
                          title: "Yakin ?",
                          text: "Yakin akan menghapus = "+data['id_registrasi_mhs'],     //[Modif Disini]
                          icon: "warning",
                          buttons: true,
                          dangerMode: true,
                        })
                        .then((willDelete) => {
                          if (willDelete) {                     //ganti controller dibawah ini
                            location.href = '<?php echo base_url('sa/'.$page.'/hapus/'); ?>'+data['id_registrasi_mhs']; //[Modif Disini]
                          } 
                        });
                    }
                },
                {
                    text: "<i class='fa fa-refresh'></i> Reload",
                    className: "btnReload",
                    init: function(api, node, config) {
                        $(node).removeClass('btn-default')
                    },
                    action: function ( e, dt, node, config ) {
                        dt.ajax.reload();
                    }
                }
            ],    
        });
        $(".dt-buttons").addClass("rapikan_tb_dtgrid");     
        $(".btnTambah").removeClass("dt-button").addClass("btn btn-primary btn-sm");
        $(".btnEdit").removeClass("dt-button").addClass("btn btn-warning btn-sm");
        $(".btnHapus").removeClass("dt-button").addClass("btn btn-danger btn-sm");
        $(".btnReload").removeClass("dt-button").addClass("btn btn-success btn-sm");
    });
<?php
}

//================================================= Kurikulum =================================================
else if($page=='ak_kurikulum') 
{
?>
    $(document).ready(function() {
        $('#dttb').DataTable( {
            "processing": true,
            "serverSide": true,
            "scrollX": true,              
            "ajax": {
                "url"  : "<?php echo base_url();?>sa/<?php echo $page;?>/data",  //ganti controller
                "type" : "POST"
            },
            "columns": [                       //sesuaikan Field yang ditampilkan. Harus persis tabel mysql
                      { "data": "id_kurikulum" },
                      { "data": "nama_mk" },
                      { "data": "id_thn_ak" },
                      { "data": "nama_prodi" }
            ],            
            select: 'single',
            dom: 'Blfrtip',
            "order": [[1, 'desc']] ,            
            "buttons": [
                {
                    text: "<i class='fa fa-plus'></i> Tambah",
                    className: "btnTambah",
                    init: function(api, node, config) {
                        $(node).removeClass('btn-default')
                    },
                    action: function ( e, dt, node, config ) {
                        location.href = '<?php echo base_url('sa/'.$page.'/tambah'); ?>'; //ganti controller
                    }
                },
                {
                    text: "<i class='fa fa-pencil'></i> Edit",
                    className: "btnEdit",
                    extend: "selected",
                    action: function ( e, dt, node, config ) {
                        data = dt.rows( { selected: true } ).data()[0]['id_kurikulum'];  //[Modif Disini]
                        // alert(JSON.stringify(data));
                        location.href = '<?php echo base_url('sa/'.$page.'/edit/'); ?>'+data; //ganti controller
                    }
                },
                {
                    text: "<i class='fa fa-trash'></i> Hapus",
                    className: "btnHapus",
                    extend: "selected",
                    action: function ( e, dt, node, config ) {
                        data = dt.rows( { selected: true } ).data()[0];  
                        swal({
                          title: "Yakin ?",
                          text: "Yakin akan menghapus = "+data['id_kurikulum'],     //[Modif Disini]
                          icon: "warning",
                          buttons: true,
                          dangerMode: true,
                        })
                        .then((willDelete) => {
                          if (willDelete) {                     //ganti controller dibawah ini
                            location.href = '<?php echo base_url('sa/'.$page.'/hapus/'); ?>'+data['id_kurikulum']; //[Modif Disini]
                          } 
                        });
                    }
                },
                {
                    text: "<i class='fa fa-refresh'></i> Reload",
                    className: "btnReload",
                    init: function(api, node, config) {
                        $(node).removeClass('btn-default')
                    },
                    action: function ( e, dt, node, config ) {
                        dt.ajax.reload();
                    }
                }
            ],    
        });
        $(".dt-buttons").addClass("rapikan_tb_dtgrid");     
        $(".btnTambah").removeClass("dt-button").addClass("btn btn-primary btn-sm");
        $(".btnEdit").removeClass("dt-button").addClass("btn btn-warning btn-sm");
        $(".btnHapus").removeClass("dt-button").addClass("btn btn-danger btn-sm");
        $(".btnReload").removeClass("dt-button").addClass("btn btn-success btn-sm");
    });
<?php
}

//================================================= Perkuliahan =================================================
else if($page=='ak_kuliah') 
{
?>
    $(document).ready(function() {
        $('#dttb').DataTable( {
            "processing": true,
            "serverSide": true,
            "scrollX": true,              
            "ajax": {
                "url"  : "<?php echo base_url();?>sa/<?php echo $page;?>/data",  //ganti controller
                "type" : "POST"
            },
            "columns": [                       //sesuaikan Field yang ditampilkan. Harus persis tabel mysql
                      { "data": "id_perkuliahan" },
                      { "data": "nama_kelas" },
                      { "data": "nama_mk" },
                      { "data": "nama_pegawai" },
                      { "data": "nama_ruang" },
                      { "data": "pembagi" }
            ],            
            select: 'single',
            dom: 'Blfrtip',
            "order": [[0, 'desc']] ,            
            "buttons": [
                {
                    text: "<i class='fa fa-plus'></i> Tambah",
                    className: "btnTambah",
                    init: function(api, node, config) {
                        $(node).removeClass('btn-default')
                    },
                    action: function ( e, dt, node, config ) {
                        location.href = '<?php echo base_url('sa/'.$page.'/tambah'); ?>'; //ganti controller
                    }
                },
                {
                    text: "<i class='fa fa-pencil'></i> Edit",
                    className: "btnEdit",
                    extend: "selected",
                    action: function ( e, dt, node, config ) {
                        data = dt.rows( { selected: true } ).data()[0]['id_perkuliahan'];  //[Modif Disini]
                        // alert(JSON.stringify(data));
                        location.href = '<?php echo base_url('sa/'.$page.'/edit/'); ?>'+data; //ganti controller
                    }
                },
                {
                    text: "<i class='fa fa-trash'></i> Hapus",
                    className: "btnHapus",
                    extend: "selected",
                    action: function ( e, dt, node, config ) {
                        data = dt.rows( { selected: true } ).data()[0];  
                        swal({
                          title: "Yakin ?",
                          text: "Yakin akan menghapus = "+data['id_perkuliahan'],     //[Modif Disini]
                          icon: "warning",
                          buttons: true,
                          dangerMode: true,
                        })
                        .then((willDelete) => {
                          if (willDelete) {                     //ganti controller dibawah ini
                            location.href = '<?php echo base_url('sa/'.$page.'/hapus/'); ?>'+data['id_perkuliahan']; //[Modif Disini]
                          } 
                        });
                    }
                },
                {
                    text: "<i class='fa fa-refresh'></i> Reload",
                    className: "btnReload",
                    init: function(api, node, config) {
                        $(node).removeClass('btn-default')
                    },
                    action: function ( e, dt, node, config ) {
                        dt.ajax.reload();
                    }
                }
            ],    
        });
        $(".dt-buttons").addClass("rapikan_tb_dtgrid");     
        $(".btnTambah").removeClass("dt-button").addClass("btn btn-primary btn-sm");
        $(".btnEdit").removeClass("dt-button").addClass("btn btn-warning btn-sm");
        $(".btnHapus").removeClass("dt-button").addClass("btn btn-danger btn-sm");
        $(".btnReload").removeClass("dt-button").addClass("btn btn-success btn-sm");
    });
<?php
}


//================================================= U S E R =================================================
else if($page=='user') 
{
?>
	$(document).ready(function() {
        $('#dttb').DataTable( {
            "processing": true,
            "serverSide": true,
            "ajax": {
                "url"  : "<?php echo base_url();?>sa/<?php echo $page;?>/data",
                "type" : "POST"
            },
            "columns": [
                      { "data": "id_user" },
                      { "data": "level" },
                      { "data": "username" },
                      { "data": "ref_user" },
                      { "data": "nama_pegawai" },
                      { "data": "ket" }
            ],            
            select: 'single',
            dom: 'Blfrtip',
            "buttons": [
                {
                    text: "<i class='fa fa-plus'></i> Tambah",
                    className: "btnTambah",
                    init: function(api, node, config) {
                        $(node).removeClass('btn-default')
                    },
                    action: function ( e, dt, node, config ) {
                        location.href = '<?php echo base_url('sa/'.$page.'/tambah'); ?>';
                    }
                },
                {
                    text: "<i class='fa fa-pencil'></i> Edit",
                    className: "btnEdit",
                    extend: "selected",
                    action: function ( e, dt, node, config ) {
                        data = dt.rows( { selected: true } ).data()[0]['id_user'];  //[Modif Disini]
                        // alert(JSON.stringify(data));
                        location.href = '<?php echo base_url('sa/'.$page.'/edit/'); ?>'+data;
                    }
                },
                {
                    text: "<i class='fa fa-trash'></i> Hapus",
                    className: "btnHapus",
                    extend: "selected",
                    action: function ( e, dt, node, config ) {
                        data = dt.rows( { selected: true } ).data()[0];  
                        swal({
                          title: "Yakin ?",
                          text: "Yakin akan menghapus = "+data['username'],     //[Modif Disini]
                          icon: "warning",
                          buttons: true,
                          dangerMode: true,
                        })
                        .then((willDelete) => {
                          if (willDelete) {
                            location.href = '<?php echo base_url('sa/'.$page.'/hapus/'); ?>'+data['id_user']; //[Modif Disini]
                          } 
                        });
                    }
                },
                {
                    text: "<i class='fa fa-refresh'></i> Reload",
                    className: "btnReload",
                    init: function(api, node, config) {
                        $(node).removeClass('btn-default')
                    },
                    action: function ( e, dt, node, config ) {
                        dt.ajax.reload();
                    }
                }
            ],    
        });
        $(".dt-buttons").addClass("rapikan_tb_dtgrid");     
        $(".btnTambah").removeClass("dt-button").addClass("btn btn-primary btn-sm");
        $(".btnEdit").removeClass("dt-button").addClass("btn btn-warning btn-sm");
        $(".btnHapus").removeClass("dt-button").addClass("btn btn-danger btn-sm");
        $(".btnReload").removeClass("dt-button").addClass("btn btn-success btn-sm");
    });

<?php
}
//================================================= J U R U S A N  =================================================
else if($page=='dm_jurusan') 
{
?>
	$(document).ready(function() {
        $('#dttb').DataTable( {
            "processing": true,
            "serverSide": true,
            "ajax": {
                "url"  : "<?php echo base_url();?>sa/<?php echo $page;?>/data",
                "type" : "POST"
            },
            "columns": [
                      { "data": "id_jurusan" },
                      { "data": "nama_jurusan" },
                      { "data": "nama_kajur" },
                      { "data": "nama_sekjur" }
            ],            
            select: 'single',
            dom: 'Blfrtip',
            "buttons": [
                {
                    text: "<i class='fa fa-plus'></i> Tambah",
                    className: "btnTambah",
                    init: function(api, node, config) {
                        $(node).removeClass('btn-default')
                    },
                    action: function ( e, dt, node, config ) {
                        location.href = '<?php echo base_url('sa/'.$page.'/tambah'); ?>';
                    }
                },
                {
                    text: "<i class='fa fa-pencil'></i> Edit",
                    className: "btnEdit",
                    extend: "selected",
                    action: function ( e, dt, node, config ) {
                        data = dt.rows( { selected: true } ).data()[0]['id_jurusan'];  //[Modif Disini]
                        // alert(JSON.stringify(data));
                        location.href = '<?php echo base_url('sa/'.$page.'/edit/'); ?>'+data;
                    }
                },
                {
                    text: "<i class='fa fa-trash'></i> Hapus",
                    className: "btnHapus",
                    extend: "selected",
                    action: function ( e, dt, node, config ) {
                        data = dt.rows( { selected: true } ).data()[0];  
                        swal({
                          title: "Yakin ?",
                          text: "Yakin akan menghapus = "+data['nama_jurusan'],     //[Modif Disini]
                          icon: "warning",
                          buttons: true,
                          dangerMode: true,
                        })
                        .then((willDelete) => {
                          if (willDelete) {
                            location.href = '<?php echo base_url('sa/'.$page.'/hapus/'); ?>'+data['id_jurusan']; //[Modif Disini]
                          } 
                        });
                    }
                },
                {
                    text: "<i class='fa fa-refresh'></i> Reload",
                    className: "btnReload",
                    init: function(api, node, config) {
                        $(node).removeClass('btn-default')
                    },
                    action: function ( e, dt, node, config ) {
                        dt.ajax.reload();
                    }
                }
            ],    
        });
        $(".dt-buttons").addClass("rapikan_tb_dtgrid");     
        $(".btnTambah").removeClass("dt-button").addClass("btn btn-primary btn-sm");
        $(".btnEdit").removeClass("dt-button").addClass("btn btn-warning btn-sm");
        $(".btnHapus").removeClass("dt-button").addClass("btn btn-danger btn-sm");
        $(".btnReload").removeClass("dt-button").addClass("btn btn-success btn-sm");
    });

<?php
}
//================================================= P R O D I  =================================================
else if($page=='dm_prodi') 
{
?>
	$(document).ready(function() {
        $('#dttb').DataTable( {
            "processing": true,
            "serverSide": true,
            "ajax": {
                "url"  : "<?php echo base_url();?>sa/<?php echo $page;?>/data",
                "type" : "POST"
            },
            "columns": [
                      { "data": "id_prodi" },
                      { "data": "kode_prodi" },
                      { "data": "nama_jurusan" },
                      { "data": "nama_prodi" },
                      { "data": "nama_kaprodi" },
                      { "data": "jenjang" },
                      { "data": "akreditasi" },
                      { "data": "no_sk_dikti" },
                      { "data": "tgl_sk_dikti" },
                      { "data": "no_sk_ban" }
            ],            
            select: 'single',
            dom: 'Blfrtip',
            "buttons": [
                {
                    text: "<i class='fa fa-plus'></i> Tambah",
                    className: "btnTambah",
                    init: function(api, node, config) {
                        $(node).removeClass('btn-default')
                    },
                    action: function ( e, dt, node, config ) {
                        location.href = '<?php echo base_url('sa/'.$page.'/tambah'); ?>';
                    }
                },
                {
                    text: "<i class='fa fa-pencil'></i> Edit",
                    className: "btnEdit",
                    extend: "selected",
                    action: function ( e, dt, node, config ) {
                        data = dt.rows( { selected: true } ).data()[0]['id_jurusan'];  //[Modif Disini]
                        // alert(JSON.stringify(data));
                        location.href = '<?php echo base_url('sa/'.$page.'/edit/'); ?>'+data;
                    }
                },
                {
                    text: "<i class='fa fa-trash'></i> Hapus",
                    className: "btnHapus",
                    extend: "selected",
                    action: function ( e, dt, node, config ) {
                        data = dt.rows( { selected: true } ).data()[0];  
                        swal({
                          title: "Yakin ?",
                          text: "Yakin akan menghapus = "+data['nama_jurusan'],     //[Modif Disini]
                          icon: "warning",
                          buttons: true,
                          dangerMode: true,
                        })
                        .then((willDelete) => {
                          if (willDelete) {
                            location.href = '<?php echo base_url('sa/'.$page.'/hapus/'); ?>'+data['id_jurusan']; //[Modif Disini]
                          } 
                        });
                    }
                },
                {
                    text: "<i class='fa fa-refresh'></i> Reload",
                    className: "btnReload",
                    init: function(api, node, config) {
                        $(node).removeClass('btn-default')
                    },
                    action: function ( e, dt, node, config ) {
                        dt.ajax.reload();
                    }
                }
            ],    
        });
        $(".dt-buttons").addClass("rapikan_tb_dtgrid");     
        $(".btnTambah").removeClass("dt-button").addClass("btn btn-primary btn-sm");
        $(".btnEdit").removeClass("dt-button").addClass("btn btn-warning btn-sm");
        $(".btnHapus").removeClass("dt-button").addClass("btn btn-danger btn-sm");
        $(".btnReload").removeClass("dt-button").addClass("btn btn-success btn-sm");
    });

<?php
}
//==========================================================================================
//------------------------------- UNIVERSAL VIEW and CRUD DATATABLES -----------------------
else if($dttb=='crud') 
{
?>
  	$(document).ready(function() {
	    $('#dttb').DataTable( {
	        "processing": true,
	        "serverSide": true,
            "scrollX": true,	        
	        "ajax": {
		        "url"  : "<?php echo base_url();?>sa/<?php echo $page;?>/data",
		        "type" : "POST"
	        },
	        select: 'single',
	        dom: 'Blfrtip',
	        "buttons": [
	            {
	                text: "<i class='fa fa-plus'></i> Tambah",
	                className: "btnTambah",
	                init: function(api, node, config) {
	                    $(node).removeClass('btn-default')
	                },
	                action: function ( e, dt, node, config ) {
	                    location.href = '<?php echo base_url('sa/'.$page.'/tambah'); ?>';
	                }
	            },
	            {
	                text: "<i class='fa fa-pencil'></i> Edit",
	                className: "btnEdit",
	                extend: "selected",
	                action: function ( e, dt, node, config ) {
	                    data = dt.rows( { selected: true } ).data()[0][0];
	                	// alert(JSON.stringify(data));
	                    location.href = '<?php echo base_url('sa/'.$page.'/edit/'); ?>'+data;
	                }
	            },
	            {
	                text: "<i class='fa fa-trash'></i> Hapus",
	                className: "btnHapus",
	                extend: "selected",
	                action: function ( e, dt, node, config ) {
	                    data = dt.rows( { selected: true } ).data()[0];
	                    swal({
	                      title: "Yakin ?",
	                      text: "Yakin akan menghapus = "+data[1],
	                      icon: "warning",
	                      buttons: true,
	                      dangerMode: true,
	                    })
	                    .then((willDelete) => {
	                      if (willDelete) {
	                        location.href = '<?php echo base_url('sa/'.$page.'/hapus/'); ?>'+data[0];
	                      } 
	                    });
	                }
	            },
	            {
	                text: "<i class='fa fa-refresh'></i> Reload",
	                className: "btnReload",
	                init: function(api, node, config) {
	                    $(node).removeClass('btn-default')
	                },
	                action: function ( e, dt, node, config ) {
	                    dt.ajax.reload();
	                }
	            }
	        ],    
	    });
		$(".dt-buttons").addClass("rapikan_tb_dtgrid");	    
	    $(".btnTambah").removeClass("dt-button").addClass("btn btn-primary btn-sm");
	    $(".btnEdit").removeClass("dt-button").addClass("btn btn-warning btn-sm");
	    $(".btnHapus").removeClass("dt-button").addClass("btn btn-danger btn-sm");
	    $(".btnReload").removeClass("dt-button").addClass("btn btn-success btn-sm");
  	});
<?php
}

//------------------------------- UNIVERSAL DATATABLES VIEW ONLY -------------------------------
else if($dttb=='view_only')
{
?>	
	  	$(document).ready(function() {
		    $('#dttb').DataTable( {
		        "processing": true,
		        "serverSide": true,
            	"scrollX": true,
		        "ajax": {
			        "url"  : "<?php echo base_url();?>sa/<?php echo $page;?>/data",
			        "type" : "POST"
		        }
		    });
	  	});
<?php
}
?>


</script>
