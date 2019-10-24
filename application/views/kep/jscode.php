<script type="text/javascript">

$('.date').datepicker({
    format: 'dd-mm-yyyy',
    autoclose: true
});

CKEDITOR.replace( 'ckeditor' );

<?php
//================================================= H O M E =================================================
if ($page=="home")  
{
	//	Agar saat home tidak ke universal
}
//================================================= Surat Masuk =================================================
else if($page=='surat_masuk') 
{
?>

    $(document).ready(function() {
        $('#dttb').DataTable( {
            "processing": true,
            "serverSide": true,
            "scrollX": true,            
            "ajax": {
                "url"  : "<?php echo base_url();?>kep/<?php echo $page;?>/data",  //ganti controller
                "type" : "POST"
            },
            "columns": [                       //sesuaikan Field yang ditampilkan. Harus persis tabel mysql
                      { "data": "id_surat_undangan" },
                      { "data": "no_surat" },
                      { "data": "tgl_surat" },
                      { "data": "perihal" },
                      { "data": "dari" },
                      { "data": "kepada" },
                      { "data": "nama_file", 
                         "fnCreatedCell": function (nTd, sData, oData, iRow, iCol) {
                            if(sData!=null){
                                $(nTd).html("<a href='<?php echo base_url('assets/dokumen/surat_undangan/');?>"+oData.nama_file+"' target='_blank'>"+oData.nama_file+"</a>");
                               }
                            else
                               $(nTd).html("-");
                            }
                      }
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
                        location.href = '<?php echo base_url('kep/'.$page.'/tambah'); ?>'; //ganti controller
                    }
                },
                {
                    text: "<i class='fa fa-pencil'></i> Edit",
                    className: "btnEdit",
                    extend: "selected",
                    action: function ( e, dt, node, config ) {
                        data = dt.rows( { selected: true } ).data()[0]['id_surat_undangan'];  //[Modif Disini]
                        // alert(JSON.stringify(data));
                        location.href = '<?php echo base_url('kep/'.$page.'/edit/'); ?>'+data; //ganti controller
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
                          text: "Yakin akan menghapus = "+data['no_surat'],     //[Modif Disini]
                          icon: "warning",
                          buttons: true,
                          dangerMode: true,
                        })
                        .then((willDelete) => {
                          if (willDelete) {                     //ganti controller dibawah ini
                            location.href = '<?php echo base_url('kep/'.$page.'/hapus/'); ?>'+data['id_surat_undangan']; //[Modif Disini]
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
                },
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


//================================================= Surat Tugas =================================================
else if($page=='surat_tugas') 
{
?>
    function format ( d ) {        // `d` is the original data object for the row
      return '<table class="table table-striped text-muted style="padding-left:50px; ">'+
        '<tr><td>Kota Asal:</td><td>'+d.kt_asal+'</td></tr>'+
        '<tr><td>Kota Tujuan:</td><td>'+d.kt_tujuan+'</td></tr>'+
        '<tr><td>kegiatan:</td><td>'+d.kegiatan+'</td></tr>'+
        '<tr><td>Tembusan:</td><td>'+d.tembusan+'</td></tr>'+
        '</table>';
    }

    $(document).ready(function() {
        var table = $('#dttb').DataTable( {
            "processing": true,
            "serverSide": true,
            "scrollX": true,            
            "ajax": {
                "url"  : "<?php echo base_url();?>kep/<?php echo $page;?>/data",  //ganti controller
                "type" : "POST"
            },
            "columns": [                       //sesuaikan Field yang ditampilkan. Harus persis tabel mysql
                    {
                        "className":      'details-control',
                        "orderable":      false,
                        "data":           null,
                        "defaultContent": ''
                    },           
                      { "data": "id_surat_tugas" },
                      { "data": "no_surat" },
                      { "data": "no_surat_tugas" },
                      { "data": "tgl_surat_tugas" },
                      { "data": "tempat" },
                      { "data": "tgl_awal" },
                      { "data": "tgl_akhir" },
                      { "data": "kota_asal" },
                      { "data": "kota_tujuan" },
                      { "data": "id_ttd" },
                      { "data": "nama_file", 
                         "fnCreatedCell": function (nTd, sData, oData, iRow, iCol) {
                            if(sData!=null){
                                $(nTd).html("<a href='<?php echo base_url('assets/dokumen/surat_tugas/');?>"+oData.nama_file+"' target='_blank'>"+oData.nama_file+"</a>");
                               }
                            else
                               $(nTd).html("-");
                            }
                      }
                      
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
                        location.href = '<?php echo base_url('kep/'.$page.'/tambah'); ?>'; //ganti controller
                    }
                },
                {
                    text: "<i class='fa fa-pencil'></i> Pelaksana Perjadin",
                    className: "btnPeserta",
                    extend: "selected",
                    action: function ( e, dt, node, config ) {
                        data = dt.rows( { selected: true } ).data()[0]['id_surat_tugas'];  //[Modif Disini]
                        // alert(JSON.stringify(data));
                        location.href = '<?php echo base_url('kep/'.$page.'_pengikut/view/'); ?>'+data; //ganti controller
                    }
                },
                {
                    text: "<i class='fa fa-pencil'></i> Edit",
                    className: "btnEdit",
                    extend: "selected",
                    action: function ( e, dt, node, config ) {
                        data = dt.rows( { selected: true } ).data()[0]['id_surat_tugas'];  //[Modif Disini]
                        // alert(JSON.stringify(data));
                        location.href = '<?php echo base_url('kep/'.$page.'/edit/'); ?>'+data; //ganti controller
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
                          text: "Yakin akan menghapus = "+data['no_surat_tugas'],     //[Modif Disini]
                          icon: "warning",
                          buttons: true,
                          dangerMode: true,
                        })
                        .then((willDelete) => {
                          if (willDelete) {                     //ganti controller dibawah ini
                            location.href = '<?php echo base_url('kep/'.$page.'/hapus/'); ?>'+data['id_surat_tugas']; //[Modif Disini]
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
                },
                {
                    text: "<i class='fa fa-print'></i> Cetak",
                    className: "btnCetak",
                    extend: "selected",
                    action: function ( e, dt, node, config ) {
                        data = dt.rows( { selected: true } ).data()[0]['id_surat_tugas'];  //[Modif Disini]
                        // alert(JSON.stringify(data));
                        location.href = '<?php echo base_url('kep/'.$page.'/cetak/'); ?>'+data; //ganti controller
                    }
                },
            ],    
        });
        $(".dt-buttons").addClass("rapikan_tb_dtgrid");     
        $(".btnTambah").removeClass("dt-button").addClass("btn btn-primary btn-sm");
        $(".btnPeserta").removeClass("dt-button").addClass("btn btn-primary btn-sm");
        $(".btnEdit").removeClass("dt-button").addClass("btn btn-warning btn-sm");
        $(".btnHapus").removeClass("dt-button").addClass("btn btn-danger btn-sm");
        $(".btnReload").removeClass("dt-button").addClass("btn btn-success btn-sm");
        $(".btnCetak").removeClass("dt-button").addClass("btn btn-info btn-sm");

        // Add event listener for opening and closing details
        $('#dttb').on('click', 'td.details-control', function () {
            var tr = $(this).closest('tr');
            var row = table.row( tr );
     
            if ( row.child.isShown() ) {
                // This row is already open - close it
                row.child.hide();
                tr.removeClass('shown');
            }
            else {
                // Open this row
                row.child( format(row.data()) ).show();
                tr.addClass('shown');
            }
        } );

    });
<?php
}

//========================================= Surat Tugas PENGIKUT =================================================
else if($page=='surat_tugas_pengikut')
{
?>

    $(document).ready(function() {
      // alert("page <?php echo $id_surat_tugas;?>");
        var table = $('#dttb').DataTable( {
            "processing": true,
            "serverSide": true,
            "scrollX": true,
            "searching": false,            
            "ajax": {
                "url"  : "<?php echo base_url();?>kep/surat_tugas_pengikut/data/<?php echo $id_surat_tugas;?>",  //ganti controller
                "type" : "POST"
            },
            "columns": [                       //sesuaikan Field yang ditampilkan. Harus persis tabel mysql
                      { "data": "id_pengikut" },
                      { "data": "label_id" },
                      { "data": "id" },
                      { "data": "nama_pengikut" },
                      { "data": "pangkat_gol" },
                      {
                        "targets": -1,
                        "data": null,
                        "defaultContent": "<button id='edit'>Edit</button>"
                      },
                      {
                        "targets": -1,
                        "data": null,
                        "defaultContent": "<button id='hapus'>Hapus</button>"
                      }
                    ],            
        });

    $('#dttb tbody').on( 'click', '#edit', function () {  //prosedur EDIT data id_pengikut (bukan id_surat_tugas)
        var data = table.row( $(this).parents('tr') ).data();
        // alert( "data = "+ data.id_pengikut);
        // alert(JSON.stringify(data));
        window.location = "<?php echo base_url('kep/surat_tugas_pengikut/edit/');?>"+data.id_surat_tugas+'/'+data.id_pengikut;
    } );
    $('#dttb tbody').on( 'click', '#hapus', function () {     
        var data = table.row( $(this).parents('tr') ).data();
          swal({
            title: "Yakin ?",
            text: "Yakin akan menghapus = "+data.nama_pengikut+" ?",     //[Modif Disini]
            icon: "warning",
            buttons: true,
            dangerMode: true,
          })
          .then((willDelete) => {
            if (willDelete) {                     //ganti controller dibawah ini
              location.href = "<?php echo base_url('kep/surat_tugas_pengikut/hapus/');?>"+data.id_surat_tugas+'/'+data.id_pengikut; //[Modif Disini]
            } 
          });
    } );

        $('#nama_pengikut').autocomplete({
            minChars : '1',
            type: 'GET',
            serviceUrl: '<?php echo base_url();?>kep/peg_mhs_cari_data',
            dataType: 'json',
            onSelect: function (data) {
                // alert('test = '+JSON.stringify(data));
                document.getElementById("nama_pengikut").value = data.nama_pengikut;
                $('#label_id').val(data.label_id);
                $('#id').val(data.data);
            }
        });

    });
<?php
}

//========================================= EDIT Surat Tugas PENGIKUT =================================================
else if($page=='surat_tugas_pengikut_edit')
{
?>

    $(document).ready(function() {
      // alert("page <?php echo $id_surat_tugas;?>");
        var table = $('#dttb').DataTable( {
            "processing": true,
            "serverSide": true,
            "scrollX": true,
            "searching": false,            
            "ajax": {
                "url"  : "<?php echo base_url('kep/surat_tugas_pengikut/data/').$id_surat_tugas;?>",
                "type" : "POST"
            },
            "columns": [                       //sesuaikan Field yang ditampilkan. Harus persis tabel mysql
                      { "data": "id_pengikut" },
                      { "data": "label_id" },
                      { "data": "id" },
                      { "data": "nama_pengikut" },
                      { "data": "pangkat_gol" },
                      {
                        "targets": -1,
                        "data": null,
                        "defaultContent": "<button id='edit'>Edit</button>"
                      },
                      {
                        "targets": -1,
                        "data": null,
                        "defaultContent": "<button id='hapus'>Hapus</button>"
                      }
                    ],            
        });

    $('#dttb tbody').on( 'click', '#edit', function () {  //prosedur EDIT data id_pengikut (bukan id_surat_tugas)
        var data = table.row( $(this).parents('tr') ).data();
        // alert( "data = "+ data.id_pengikut);
        // alert(JSON.stringify(data));
        window.location = "<?php echo base_url('kep/surat_tugas_pengikut/edit/');?>"+data.id_surat_tugas+'/'+data.id_pengikut;
    } );
    $('#dttb tbody').on( 'click', '#hapus', function () {     
        var data = table.row( $(this).parents('tr') ).data();
          swal({
            title: "Yakin ?",
            text: "Yakin akan menghapus = "+data.nama_pengikut+" ?",     //[Modif Disini]
            icon: "warning",
            buttons: true,
            dangerMode: true,
          })
          .then((willDelete) => {
            if (willDelete) {                     //ganti controller dibawah ini
              location.href = "<?php echo base_url('kep/surat_tugas_pengikut/hapus/');?>"+data.id_surat_tugas+'/'+data.id_pengikut; //[Modif Disini]
            } 
          });
    } );

        $('#nama_pengikut').autocomplete({
            minChars : '1',
            type: 'GET',
            serviceUrl: '<?php echo base_url();?>kep/peg_mhs_cari_data',
            dataType: 'json',
            onSelect: function (data) {
                // alert('test = '+JSON.stringify(data));
                document.getElementById("nama_pengikut").value = data.nama_pengikut;
                $('#label_id').val(data.label_id);
                $('#id').val(data.data);
            }
        });

    });
<?php
}

?>

</script>
