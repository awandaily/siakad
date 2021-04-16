<style>
.bg{
	background-image:url(<?php echo base_url();?>plug/img/green.png) ;
	
}
.trs{
	background-image:url(<?php echo base_url();?>plug/img/white.png);
}
td{
	padding-left:3px;
}
</style>
	<?php
	if($grafik=="tdetail" or $grafik=="th")
	{
	$title="Tanggal";	
	}elseif($grafik=="tm")
	{
	$title="Minggu";
	}elseif($grafik=="tb")
	{
	$title="Bulan";
	}else
	{
	$title="Tahun";
	}?>
					<div class="widget-content" >
						<form action="#"  method="post" id="area_lod">
							<table id='table' class="tabel black table-bordered  table-striped table-hover dataTable" style="font-size:12px;width:100%">
										<thead  class='sadow bg-blue'>
											<th class='thead' axis="string" width='15px'>No</th> 
											<th class='thead' axis="date" width='170px'>&nbsp;<i class="icon-calendar"></i> <?php echo $title; ?></th>
											
											
											
											<th class='thead' width='110px'>&nbsp;<i class="icon-shopping-cart  "></i>   Pemasukan</th>
											<th class='thead' width='110px'>&nbsp;<i class="icon-shopping-cart  "></i>   Pengeluaran</th>
											 
 
											<?php if($grafik=="tdetail"){?>
												<th width='110px'>&nbsp;<i class="icon-bookmark "></i> Keterangan</th>
											<?php } ?>
										</thead>
							</table>
						</form>
					</div>				
									
   

 
 
  
  
  
<script type="text/javascript">
    var save_method; //for save method string
    var table;
   
		
      table = $('#table').DataTable({ 
        
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
						   "sZeroRecords": "Data tidak tersedia",
						  "lengthMenu": "Tampil _MENU_ Baris",  
				    },
        "serverSide": true, //Feature control DataTables' server-side processing mode.
		 "responsive": true,
		 "searching": false,
        // Load data for the table's content from an Ajax source
		
		
		
		  dom: 'Blfrtip',
		buttons: [
           // 'copy', 'csv', 'excel', 'pdf', 'print'
			 
			 {
					extend: 'excel',
                        exportOptions: {
                    <?php
							if($grafik=="tdetail")
							{?>
                     columns:[ 0,1,2,3,4]
							<?php }else{?>
							  columns:[ 0,1,2,3]
							<?php } ?>
                },text:'Export Excell',
							
                    },
					
					{
					extend: 'pdf',
                        exportOptions: {
                    <?php
							if($grafik=="tdetail")
							{?>
                     columns:[ 0,1,2,3,4]
							<?php }else{?>
							  columns:[ 0,1,2,3]
							<?php } ?>
                },text:' Export Pdf',
							
                    }  
					
        ],
		
		
		
		
        "ajax": {
            "url": "<?php echo base_url();?>catatan_keuangan/getListRekap?grafik=<?php echo $grafik; ?>&tanggal=<?php echo $tanggal; ?>&tipe=",
            "type": "POST",
        }, beforeSend: function() {
               loading("area_lod");
            },
			complete: function() {
              unblock('area_lod');
            },

        //Set column definition initialisation properties.
        "columnDefs": [
        { 
          "targets": [ 0,-1,-2], //last column
          "orderable": false, //set not orderable
        },
        ],

      });
  
	var save_method="";
   

  
    function reload_table()
    {
      table.ajax.reload(null,false); //reload datatable ajax 
    }

   
    function hapusOrder(id)
    {
      if(confirm('Hapus data transaksi '+id+' ?'))
      {
        // ajax delete data to database
          $.ajax({
            url : "<?php echo base_url();?>transaksi/hapusOrder/"+id,
            type: "POST",
            dataType: "JSON",
            success: function(data)
            {
               //if success reload ajax table
               reload_table();
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                alert('Error adding / update data');
            }
        });
         
      }
    }

  </script>
