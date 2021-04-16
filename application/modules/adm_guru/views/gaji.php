  <?php $token=date("His")?>

		 
		 
	 
	
	<div class="row clearfix" >	
		
 	 <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card" id="blockarea"  >
                        
                        <div class="bodyd" style="min-height:200px;padding:10px">
						<!---------------------->
					 		  
						<div class="table-responsive" id="area_lod">
                               <table id='table' class="tabel black table-bordered  table-hover dataTable" style="font-size:12px;width:100%">
								<thead  class='sadow bg-teal'>			
				 
									<th class='thead' >  PERIODE </th>
								 
									<th class='thead' >TOTAL </th>
								 	<th class='thead' >TGL DITERIMA</th>
									<th class='thead' >RINCIAN </th>
									
								</thead>
							</table>
							</div>			
                     		<!---------------------->
						 
                           </div>
						   <div class="row">&nbsp;</div><br>
						</div>
         </div>
	
 </div>
	 <script>
	   
	  
	  var  dataTable = $('#table').DataTable({ 
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
						"sInfo": "",
						 "sInfoEmpty": "",
						   "sZeroRecords": "Data tidak tersedia",
						  "lengthMenu": "Tampil _MENU_ Baris",  
				    },
					 
					 
        "serverSide": true, //Feature control DataTables' server-side processing mode.
		 "responsive": false,
		 "searching": false,
		 
	  dom: 'Blfrtip',
		buttons: [
           // 'copy', 'csv', 'excel', 'pdf', 'print'
			 
		/* {
					extend: 'excel',
                        exportOptions: {
                      columns:[ 0,1]
                },text:'Export Excell',
							
                    },*/
					
					  
        ],
        
        // Load data for the table's content from an Ajax source
        "ajax": {
            "url": "<?php echo site_url('adm_guru/getDataGaji');?>",
            "type": "POST",
			"data": function ( data ) {
						
						  data.periode= $("[name='periode']").val();
						  data.id_guru= "<?php echo $this->mdl->idu()?>";
						  data.status= $("[name='status']").val();						  
		 },
		   beforeSend: function() {
               loading("area_lod");
            },
			complete: function() {
              unblock('area_lod'); 
            },
			
        },

        //Set column definition initialisation properties.
        "columnDefs": [
        { 
          "targets": [ 0,-1,-2,-3 ], //last column
          "orderable": false, //set not orderable
        },
        ],
	
      });
     	  
	 
	 
	 
	</script>
	
						
						
						
<script>
var link="<?php echo base_url()?>";
 
function ubah(id,sts,nama)
{	  
if(sts==1)
{
	var teks="Penyerahan gaji untuk <br> <span class='col-pink font-bold'>"+nama+"</span> <br> Dan akan dicatat sebagai data pengeluaran ditanggal <br> <span class='col-pink font-bold'> <?php echo date('d-m-Y')?> </span>";
}else{
var teks="Pembatalan penyerahan gaji ini akan menghapus data pengeluaran<br>Lanjutkan ?";
}
 alertify.confirm("<center> "+teks+"</center>",function(){
    $.ajax({
	 url:link+"penggajian/ubahStatus",
     data:"id="+id+"&sts="+sts,
	 method:"POST",
     success: function(data)
            {
				table_reload();
            }
    });   
 });
}
 
</script>						
						
			    
<script>
 
 function table_reload()
 {
	  dataTable.ajax.reload(null,false);	
 }
  function rincian(id,periode,guru,nama)
  {
	   $(".modal-title").html("Rincian "+nama);
	   $("#mdl_rincian").modal("show");
	   $.ajax({
	 url:link+"adm_guru/struk",
     data:"id="+id+"&periode="+periode+"&id_guru="+guru,
	 method:"get",
     success: function(data)
            {
				 $("#rincian").html(data);
            }
    });   
  }
  
</script>		

  						
	<div  class="modal fade in" id="mdl_rincian" tabindex="-1" role="dialog">
                <div class="modal-dialog" id="area_modal_edit" role="document">
				
	<form action="javascript:submitForm('modal_add')" id="modal_add" url="<?php echo base_url()?>catatan_keuangan/insert" method="post" enctype="multipart/form-data">
                    <div class="modal-content">  
                        <div class="modal-header">
						 <button type="button" class="close" 
                   data-dismiss="modal">
                       <span aria-hidden="true">&times;</span>
                       <span class="sr-only">Close</span>
                </button>
                            <h4 class="modal-title col-teal"></h4>
							 
                        </div>
                        <div class="modal-body">
                       	  
					   	 <div id="rincian" > 
							  
						</div> 
                       <div class="modal-footer">
						<span id="msg" class="pull-left"></span>
                            
                        </div>

				</div>
				</div>
					 
       		
				</form></div>
				
   </div>
	
	