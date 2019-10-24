<script type="text/javascript">

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
                "url"  : "<?php echo base_url();?>keu/<?php echo $page;?>/data",  //ganti controller
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
                
            ],    
        });
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
        '<tr><td>Kota Tempat Tujuan:</td><td>'+d.kt_tujuan+'</td></tr>'+
        '<tr><td>Penandatangan:</td><td>'+d.id_ttd+'</td></tr>'+
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
                "url"  : "<?php echo base_url();?>keu/<?php echo $page;?>/data",  //ganti controller
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
                      { "data": "jenis" },
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
                    text: "<i class='fa fa-pencil'></i> Proses Full/Fullboard",
                    className: "btnEdit",
                    extend: "selected",
                    action: function ( e, dt, node, config ) {
                        data = dt.rows( { selected: true } ).data()[0]['id_surat_tugas'];  //[Modif Disini]
                        // alert(JSON.stringify(data));
                        location.href = '<?php echo base_url('keu/'.$page.'/edit/'); ?>'+data;
                    }
                },
                {
                    text: "<i class='fa fa-pencil'></i> Pelaksana Perjadin",
                    className: "btnPengikut",
                    extend: "selected",
                    action: function ( e, dt, node, config ) {
                        data = dt.rows( { selected: true } ).data()[0]['id_surat_tugas'];  //[Modif Disini]
                        // alert(JSON.stringify(data));
                        $('.modal-body').load('<?php echo base_url('keu/'.$page.'/pengikut/');?>'+data,function(){
                            $('#modal-default').modal({show:true});
                        });
                    }
                },
            ],    
        });
        $(".dt-buttons").addClass("rapikan_tb_dtgrid");     
        $(".btnEdit").removeClass("dt-button").addClass("btn btn-success btn-sm");
        $(".btnPengikut").removeClass("dt-button").addClass("btn btn-primary btn-sm");
        
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
//================================================= Surat Full =================================================
else if($page=='proses_jaldis') 
{
?>
    $(document).ready(function() {
        $('#dttb').DataTable( {
            "processing": true,
            "serverSide": true,
            "scrollX": true, 
			
            "ajax": {
                "url"  : "<?php echo base_url();?>keu/<?php echo $page;?>/data",
                "type" : "POST"
            },
            "columns": [
                      { "data": "id_pengikut" },
                      { "data": "nama_surat" },
                      { "data": "no_surat_tugas" },
                      { "data": "nama_pengikut" },
                      { "data": "pangkat_gol" },
                      { "data": "jml_hari_harian" },
                      { "data": "uang_harian" },
                      { "data": "transport_1" },
                      { "data": "transport_2" },
                      { "data": "transport_3" },
                      { "data": "jml_hari_penginapan" },
                      { "data": "penginapan" }
            ],            
            select: 'single',
            dom: 'Blfrtip',
            "order": [[0, 'desc']] , 
            "buttons": [
                
                {
                    text: "<i class='fa fa-pencil'></i> Proses",
                    className: "btnProses",
                    extend: "selected",
                    action: function ( e, dt, node, config ) {
                        data = dt.rows( { selected: true } ).data()[0]['id_pengikut'];  //[Modif Disini]
                        // alert(JSON.stringify(data));
                        location.href = '<?php echo base_url('keu/'.$page.'/edit/'); ?>'+data;
                    }
                },
                
				        {
                    text: "<i class='fa fa-print'></i> Cetak Rincian Biaya",
                    className: "btnCetak",
                    extend: "selected",
                    action: function ( e, dt, node, config ) {
                        data = dt.rows( { selected: true } ).data()[0]['id_pengikut'];  //[Modif Disini]
                        // alert(JSON.stringify(data));
                        location.href = '<?php echo base_url('keu/'.$page.'/cetak_rincianbiaya/'); ?>'+data; //ganti controller
                    }
                },

              {
                    text: "<i class='fa fa-print'></i> SPPD Depan",
                    className: "btnSppd",
                    extend: "selected",
                    action: function ( e, dt, node, config ) {
                        data = dt.rows( { selected: true } ).data()[0]['id_pengikut'];  //[Modif Disini]
                        // alert(JSON.stringify(data));
                        location.href = '<?php echo base_url('keu/'.$page.'/cetak_sppd_depan/'); ?>'+data; //ganti controller
                    }
                },
                {
                    text: "<i class='fa fa-print'></i> SPPD belakang",
                    className: "btnSppd",
                    extend: "selected",
                    action: function ( e, dt, node, config ) {
                        data = dt.rows( { selected: true } ).data()[0]['id_pengikut'];  //[Modif Disini]
                        // alert(JSON.stringify(data));
                        location.href = '<?php echo base_url('keu/'.$page.'/cetak_sppd_belakang/'); ?>'+data; //ganti controller
                    }
                },
                {
                    text: "<i class='fa fa-print'></i> Biaya riil",
                    className: "btnRiil",
                    extend: "selected",
                    action: function ( e, dt, node, config ) {
                        data = dt.rows( { selected: true } ).data()[0]['id_pengikut'];  //[Modif Disini]
                        // alert(JSON.stringify(data));
                        location.href = '<?php echo base_url('keu/'.$page.'/cetak_biaya_riil/'); ?>'+data; //ganti controller
                    }
                },
            ],    
        });
        $(".dt-buttons").addClass("rapikan_tb_dtgrid");     
        $(".btnCetak").removeClass("dt-button").addClass("btn btn-info btn-sm");
		$(".btnProses").removeClass("dt-button").addClass("btn btn-danger btn-sm");
        $(".btnSppd").removeClass("dt-button").addClass("btn btn-success btn-sm");
        $(".btnRiil").removeClass("dt-button").addClass("btn btn-warning btn-sm");
    });

    
<?php
}
?>

</script>
