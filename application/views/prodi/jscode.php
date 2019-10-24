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
                "url"  : "<?php echo base_url();?>prodi/<?php echo $page;?>/data",  //ganti controller
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
            "order": [[0, 'desc']]
        });
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
                "url"  : "<?php echo base_url();?>prodi/<?php echo $page;?>/data",
                "type" : "POST"
            },
            "columns": [
                      { "data": "id_kelas" },
                      { "data": "id_thn_ak" },
                      { "data": "nama_prodi", "searchable":false, "orderable":false },
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
                        location.href = '<?php echo base_url('prodi/'.$page.'/tambah'); ?>';
                    }
                },
                {
                    text: "<i class='fa fa-pencil'></i> Edit",
                    className: "btnEdit",
                    extend: "selected",
                    action: function ( e, dt, node, config ) {
                        data = dt.rows( { selected: true } ).data()[0]['id_kelas'];  //[Modif Disini]
                        // alert(JSON.stringify(data));
                        location.href = '<?php echo base_url('prodi/'.$page.'/edit/'); ?>'+data;
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
                            location.href = '<?php echo base_url('prodi/'.$page.'/hapus/'); ?>'+data['id_kelas']; //[Modif Disini]
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
        $('#id_thn_ak').change(function(){
            var id = document.getElementById("id_thn_ak").value;
            table.search(id).draw();
        });
        var table = $('#dttb').DataTable( {
            "processing": true,
            "serverSide": true,
            "scrollX": true,              
            "ajax": {
                "url"  : "<?php echo base_url();?>prodi/<?php echo $page;?>/data",  //ganti controller
                "type" : "POST"
            },
            "columns": [                       //sesuaikan Field yang ditampilkan. Harus persis tabel mysql
                      { "data": "id_angka_huruf", "searchable" : false },
                      { "data": "id_thn_ak"},
                      { "data": "nilai", "searchable" : false },
                      { "data": "huruf", "searchable" : false }
            ],            
            select: 'single',
            "order": [[0, 'desc']] ,            
        });

    });
<?php
}



?>

</script>
