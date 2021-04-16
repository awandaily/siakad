<div class="row clearfix">
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
	 	<div class="card" >
            <div class="header" style="padding: 10px;">
            	<div class="row">
                    <div class="col-sm-6">
                        <h2 style="padding-top: 10px;">DATA PEMINJAMAN SAYA</h2>
                    </div>
                </div>
            </div>

            <div class="body">

                <div class="row clearfix">
                    <div class="col-md-12">
                        <div class="table-responsive" id="area_lod">
                            <table class="entry col-md-12" style="width: 100%" id="table">
                                <thead>
                                    <tr>
                                        <th class='thead' axis="string" width='15px'>&nbsp;NO</th>  
                                        <th class='thead' >TANGGAL PINJAM </th> 
                                        <th class='thead' >TANGGAL KEMBALI </th> 
                                        <th class='thead' >MASA PINJAM </th>  
                                        <th class='thead' >BUKU </th> 
                                        <th class='thead' >STATUS</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
            	</div>
            </div>
	</div>
</div>

<script type="text/javascript">
    var  dataTable = $('#table').DataTable({ 
        "fixedHeader": true,
        "paging": true,
        "processing": false, //Feature control the processing indicator.
        "language": {
                     "sSearch": "Pencarian",
                     "processing": ' <span class="sr-only dataTables_processing">Loading...</span> <br><b style="color:black;background:white">Proses menampilkan data<br> Mohon Menunggu..</b>',
                          "oPaginate": {
                            "sFirst": "Hal Pertama",
                            "sLast": "Hal Terakhir",
                             "sNext": "Selanjutnya",
                             "sPrevious": "Sebelumnya"
                             },
                    "sInfo": "Total :  _TOTAL_ , Halaman (_START_ - _END_)",
                    "sInfoEmpty": "Tidak ada data yang di tampilkan",
                    "sZeroRecords": "<center>Data tidak tersedia</center>",
                    "lengthMenu": "Tampil _MENU_ Baris",  
        },       
        "serverSide": true, //Feature control DataTables' server-side processing mode.
        "responsive": false,
        "searching": false,
        "lengthMenu":
            [[10 , 30,50,100,200,300,400,500], 
            [10 , 30,50,100,200,300,400,500]],
        /* 
        dom: 'Blfrtip',
        buttons: [
           // 'copy', 'csv', 'excel', 'pdf', 'print' 
        {
            extend: 'excel',
            exportOptions: {
                columns:[ 0,1,2,3,4,5,6]
            },
            text:'Download Excell',
                        
        },
                    
     
                    
        ],*/
        "ajax": {
            "url": "<?php echo site_url('perpustakaan/data_peminjaman');?>",
            "type": "POST",
            "data": function ( data ) {         
              data.id_kategori = $('#fkategori').val();   
              data.id_rak = $('#frak').val();
              data.nama_buku = $('#fnama').val();
              data.kode_buku = $('#fkode').val();                           
            },
            beforeSend: function() {
               loading("area_lod");
            },
            complete: function() {
              unblock('area_lod');
            },
            
        },

    });

    function reload_table(){
        dataTable.ajax.reload(null, false);
    }
</script>