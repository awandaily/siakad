 <?php $token=date("His");
 
 $datalibur=$this->db->query("select * from tm_jadwal_libur where start<='".date('Y-m-d')."' and end>='".date('Y-m-d')."' ")->row();
$namaLibur=isset($datalibur->nama)?($datalibur->nama):"";
if($namaLibur)
{
	echo "<div class='card'><br><center> Hari ini KBM diliburkan<br> <i class='col-deep-orange'> ".$namaLibur." </i></center></div>";
				return false;
}


 ?>
 
                       <div class="col-md-12"   >
							<div class="form-group"> 
                                            
                                               <input  type="text" id="pilihtgl"  value="<?php echo date("d/m/Y");?>" name="tgl" class="form-control cursor">
                                           
                                        </div>
                            </div>  
 
                <div class="row clearfix">
                <!-- Task Info -->
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <div class="card" id="load">
                     
                           <!----->
				 <div class="card">
                        <div class="body">
                            <div class="table-responsive">
							
 <span style='color:black;position:fixed;margin-top:-65px;z-index:222' class="cursor btnhapus">
	<button class="waves-effect btn bg-pink" onclick="liburkan()">NON-AKTIFKAN KBM</button>
</span>
<form action="#" name="delcheck" id="delcheck" class="form-horizontal" method="post">
                               <table id='table' class="tabel black table-bordered table-striped table-hover dataTable" style=" width:100%">
								<thead  class='sadow bg-teal'>			
									<th class='thead col-white'   width='5px'>
  
									<input type="checkbox" id="md_checkbox"  value="ya" class="pilihsemua filled-in chk-col-red"   />
									<label for="md_checkbox" class="col-white"><b> </b></label>
						 
									</th>	
								 
									<th class='thead' >NAMA GURU</th>
									<th class='thead' >FINGERPRINT</th>
									   
								</thead>
							</table>
 </form>
							</div>						
						</div>						
					</div>	
                           <!----->
                    
                    </div>
                </div>
                <!-- #END# Task Info -->
				
  <script>
 $('select').selectpicker();
 </script>
  <script type="text/javascript">
  	  function liburkan(){
			$("#dlm").val("");
		    alertify.confirm("<center>Jam mulai di off<input class='form-control' value='<?php echo $this->m_reff->jam_aktif(); ?>' type='number' id='jamke'>  <textarea placeholder='Tulis Keterangan...' class='form-control' id='dlm'></textarea> </center>",function(){
		    var nilai=$("#dlm").val();
		    var jamof=$("#jamke").val();
		    var tgl=$("#pilihtgl").val();
			loading("load");
			$.ajax({
			url:"<?php echo base_url();?>pd/setNonAktif?ket="+nilai+"&jamof="+jamof+"&tgl="+tgl,
			type: "POST",
			data: $('#delcheck').serialize(),
			success: function(data)
					{	  
						reload_table();
						unblock("load");
					},
					error: function (jqXHR, textStatus, errorThrown)
					{
						alert('Try Again!');
					}
			});
		   
		   })
	  };
	  
	
	  
      var save_method; //for save method string
    var table;
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
						"sInfo": "Total :  _TOTAL_ , Halaman (_START_ - _END_)",
						 "sInfoEmpty": "Tidak ada data yang di tampilkan",
						   "sZeroRecords": "Data tidak tersedia",
						  "lengthMenu": "Tampil _MENU_ Baris",  
				    },
					 
					 
        "serverSide": true, //Feature control DataTables' server-side processing mode.
		 "responsive": true,
		 "searching": true,
		 "lengthMenu":
		 [[200,100,50,30,10,5], 
		 [200,100,50,30,10,5], ], 
	  dom: 'Blfrtip',
		buttons: [
           // 'copy', 'csv', 'excel', 'pdf', 'print'
			 
			 {
					extend: 'excel',
                        exportOptions: {
                      columns:[ 0,1,2 ]
                },text:' Excell',
							
                    },
					 
					{extend: 'colvis',
                        exportOptions: {
                  columns:[ 0,1,2 ]
                },text:' Kolom',
							
                    },
					 
					
        ],
        
        // Load data for the table's content from an Ajax source
        "ajax": {
            "url": "<?php echo site_url('pd/getDataguru');?>",
            "type": "POST",
			"data": function ( data ) {
			  data.id_kelas= $('#fkelas').val(); 
			  data.jurusan= $('#fid_jurusan').val(); 
			  data.tgl= $('#pilihtgl').val(); 
			  
		 },
		   beforeSend: function() {
               loading("load");
            },
			complete: function() {
              unblock('load');
            },
			
        },

        //Set column definition initialisation properties.
        "columnDefs": [
        { 
          "targets": [ 0,-1,-2 ], //last column
          "orderable": false, //set not orderable
        },
        ],
	
      });
	function reload_table()
	{
		 dataTable.ajax.reload(null,false);	
	};
	 $(document).on('change', '.fkelas<?php echo $token;?>,.fidjenis<?php echo $token;?>,.fke_bp<?php echo $token;?>', function (event, messages) {			   
        reload_table();		 
		});
		function fingerkan(noid)
		{
			$.get("<?php echo base_url()?>pd/fingerkan?noid="+noid, function(data, status){
			reload_table();
			});
		}
	</script>
	
	
	
	
	
<script>
$(".btnhapus").hide();
  	$(".pilihsemua").click(function(){
	
		if($(".pilihsemua").val()=="ya") {
		$(".pilih").prop("checked", "checked");
		$(".pilihsemua").val("no");
		  $(".btnhapus").show();
		} else {
		$(".pilih").removeAttr("checked");
		$(".pilihsemua").val("ya");
		  $(".btnhapus").hide();
		}
	
	});
	
	function pilcek(){
		$(".btnhapus").show();
		$(".pilihsemua").removeAttr("checked");
		$(".pilihsemua").val("ya");
		 
	};
  
</script>
	 

	 			
<script> 
$('#pilihtgl').daterangepicker({
	//maxDate: new Date(),
    "singleDatePicker": true,
    "showDropdowns": true,
    "dateLimit": {
        "days": 7
    },
	  "autoApply": true,
	  "drops": "down",
    "locale": {
		    
        "format": "DD/MM/YYYY",
        "separator": " - ",
        "applyLabel": "Apply",
        "cancelLabel": "Cancel",
        "fromLabel": "From",
        "toLabel": "To",
        "customRangeLabel": "Custom",
        "weekLabel": "W",
        "daysOfWeek": [
            "M",
            "S",
            "S",
            "R",
            "K",
            "J",
            "S"
        ],
        "monthNames": [
            "Januari",
            "Februari",
            "Maret",
            "April",
            "Mei",
            "Juni",
            "Juli",
            "Augustus",
            "September",
            "Oktober",
            "November",
            "Desember"
        ],
        "firstDay": 1
    },
    "showCustomRangeLabel": false,
    "startDate": "<?php echo date("d/m/Y")?>",
   
},
function cb() {      
setTimeout(function(){ reload_table(); }, 300); 
		
    });

 
 </script>   