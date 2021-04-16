  
	   
	   
<div class="row clearfix" style="margin-top:-20px">
                <!-- Task Info -->
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" id="area_formhonor">
				       
                    <div class="card">
					     
                        <div class="header col-md-12">	
						<span class="col-md-3 col-xs-12">
						  <input type="text" onchange="loadTable()" value="<?php echo $this->tanggal->kurangTgl(30) . " - " . date("d/m/Y") ?>" class="form-control" id="reportrange" name="reportrange" style="cursor:pointer;height:30px; right:0">
                         </span> 
						 <span class="col-md-3  col-xs-12">
						  <select name="grafik"  onchange="loadTable()" style="height:30px;" class='cursor form-control' required='required' >
                            <option value="tdetail">Tabel - Detail</option>
                            <option value="th">Tabel - Perhari</option>
                            <option value="tm">Tabel - Perminggu</option>
                            <option value="tb">Tabel - Perbulan</option>
                            <option value="tt">Tabel - Pertahun</option>

                            <option value="gdetail">Grafik - Detail</option>
                            <option value="gh">Grafik - Perhari</option>
                            <option value="gm">Grafik - Perminggu</option>
                            <option value="gb">Grafik - Perbulan</option>
                            <option value="gt">Grafik - Pertahun</option>
                        </select>
						   </span> 

						   <span class="col-md-3  col-xs-12">
						  <select name="tipe"  onchange="loadTable()" style="height:30px;" class='cursor form-control'  >
                            <option value="all">== Semua Pengeluaran ==</option>
                            <option value="0">Input Langsung</option>
							<option value="1">BPJS</option>  
                            <option value="2">Pembayaran Siswa</option>
                            
                             </select>
						   </span>  
						
						<span class="col-xs-12 col-md-3">
						<div class="btn-group pull-right" role="group"  > 
                                    <button type="button" class="btn bg-grey waves-effect" onclick="exportData()">DOWNLOAD</button>                                 
                                    <button type="button" class="btn bg-teal waves-effect" onclick="addPengeluaran()">TAMBAH</button>
                                </div>
								
								 
						 </span>
						 
                        </div>
						<div class="body">	 <div class="clearfix">&nbsp;</div>
						<div class="table-responsive" id="area_lod"><br>
                                
						</div>
			</div>
  </div>
  </div>
  </div>
  
   <script>
    function loadTable()
    {	var grafik=$("[name='grafik']").val();
    	var tanggal=$("[name='reportrange']").val();
    	var tipe=$("[name='tipe']").val();
        $.ajax({
            url: "<?php echo base_url(); ?>catatan_keuangan/getTablePemasukan",
            type: "POST",
            data: {grafik:grafik,tanggal:tanggal,tipe:tipe},
            success: function (data)
            {
                $("#area_lod").html(data);
            }});
    }

			 $(".select").selectpicker();
   </script>
  
  <script>
			function hapus_data(id,nama){
		     alertify.confirm("<center><span class='col-pink'> "+nama+"</span><br> Hapus ? </center>",function(){
				 
			$.ajax({
			url:"<?php echo base_url()?>catatan_keuangan/hapusPemasukan",
			data:"id="+id,
			type: "POST",
			dataType: "JSON",
			success: function(data)
					{	   
						 reload_table();
					}
			});
		   
		   })
	  };
 </script>
 
  
  
  
  
         
	 
 <script>
 function resset()
 {
	// var nisawal=$("#nis").val();
	 $("#formhonor")[0].reset();
	 
	//  $("#nis").val(nisawal);
 }
 function reload_table()
 {
	 getAction();
						$("#input").hide();
						$("#tarik").hide();
						$("#ket_tarik").html("");
	 
 }
 function getAction()
 {	 
    dataTable.ajax.reload(null,false);	
 }
 
 
 
  </script>
 
 
 
  
 <script>
 
function edit_data(id,nama,nominal,tgl,ket)
{
	$("#mdl_editformsimpan").modal("show");
	$("#ketEdit").val(ket);
	$("#tglEdit").val(tgl);
 	$("#nominalEdit").val(nominal);
	 $("#titleEdit").html(nama);
	 $("[name='id_edit']").val(id);
}

 </script> 
  
  
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
		 "searching": true,
		  
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
            "url": "<?php echo site_url('keu_staff/getSimpanan');?>",
            "type": "POST",
			"data": function ( data ) {
						
				 
						  
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
          "targets": [ 0,-1 ], //last column
          "orderable": false, //set not orderable
        },
        ],
	
      }); 
	</script>
	
	
	
<script> 
$('#tglEdit').daterangepicker({
	//maxDate: new Date(),
    "singleDatePicker": true,
    "showDropdowns": true,
    "dateLimit": {
        "days": 7
    },
	  "autoApply": false,
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
   
});

 
$('#tgl').daterangepicker({
	//maxDate: new Date(),
    "singleDatePicker": true,
    "showDropdowns": true,
    "dateLimit": {
        "days": 7
    },
	  "autoApply": false,
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
   
});
 
                            var start = moment().subtract(30, 'days');
                            var end = moment(); 
                            $("#reportrange").daterangepicker({
                                startDate: start,
                                endDate: end,
                                ranges: {
                                    'Hari ini': [moment(), moment()],
                                    'Kemarin': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                                    '7 hari terakhir': [moment().subtract(6, 'days'), moment()],
                                    '30 hari terakhir': [moment().subtract(30, 'days'), moment()],
                                    'Bulan ini': [moment().startOf('month'), moment().endOf('month')],
                                    'Bulan kemarin': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
                                }, "locale": {
                                    "format": "DD/MM/YYYY",
                                    "separator": " - ",
                                    "applyLabel": "Apply",
                                    "cancelLabel": "Cancel",
                                    "fromLabel": "From",
                                    "toLabel": "To",
                                    "customRangeLabel": "Custom",
                                    "weekLabel": "W",
                                    "firstDay": 1
                                },
                            }, loadTable());

                            

                     
</script>
<script>
function exportData()
{
		var grafik=$("[name='grafik']").val();
    	var tanggal=$("[name='reportrange']").val();
    	var tipe=$("[name='tipe']").val();
		window.location.href="<?php echo base_url()?>catatan_keuangan/exportDataPemasukan?grafik="+grafik+"&tanggal="+tanggal+"&tipe="+tipe;
}
function addPengeluaran()
{
	$("#modal_add").attr("url","<?php echo base_url()?>catatan_keuangan/insertPemasukan");
	$("#modal_add")[0].reset();
	$(".modal-title").html("Tambah data pemasukan");
	$("#mdl_modal_add").modal("show");
}
function edit_data(id,nama,nominal,tgl,ket)
{
		$("#modal_add").attr("url","<?php echo base_url()?>catatan_keuangan/updatePemasukan");
	$(".modal-title").html("Edit data pemasukan");
	$("#mdl_modal_add").modal("show");
	$("[name='id']").val(id);
	$("[name='f[nama]']").val(nama);
	$("[name='nominal']").val(nominal);
	$("[name='tgl']").val(tgl);
	$("[name='f[ket]']").val(ket);
	 
}
</script>

 
	<div  class="modal fade in" id="mdl_modal_add" tabindex="-1" role="dialog">
                <div class="modal-dialog" id="area_modal_edit" role="document">
				
	<form action="javascript:submitForm('modal_add')" id="modal_add" url="<?php echo base_url()?>catatan_keuangan/insertPemasukan" method="post" enctype="multipart/form-data">
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
                       	  
					   	 <div  > 
							<input name="id"   type="hidden">
 	 
  
								<div class="row clearfix">
                                    <div class="col-lg-4 col-md-4  form-control-label">
                                        <label for="email_address_2" class="col-black">Nama Pemasukan</label>
                                    </div>
                                    <div class="col-lg-7 col-md-7  ">
                                        <div class="form-group">
                                            <div class="form-line" id="data_mapel">
                                         <input  class="form-control" name="f[nama]"  id="nama" type="text" required>
                                            </div>
                                        </div>
                                    </div>
                                </div>
								 
								 <div class="row clearfix">
                                    <div class="col-lg-4 col-md-4  form-control-label">
                                        <label for="email_address_2" class="col-black"> Jumlah/Nominal  </label>
                                    </div>
                                    <div class="col-lg-7 col-md-7  ">
                                        <div class="form-group">
                                            <div class="form-line" id="data_mapel">
                                         <input  class="form-control" name="nominal"  id="nominal" type="text" required onkeydown="return numbersonly(this, event)">
                                            </div>
                                        </div>
                                    </div>
                                </div>
								  <div class="row clearfix">
                                    <div class="col-lg-4 col-md-4  form-control-label">
                                        <label for="email_address_2" class="col-black"> Tanggal  </label>
                                    </div>
                                    <div class="col-lg-7 col-md-7  ">
                                        <div class="form-group">
                                            <div class="form-line" id="data_mapel">
                                         <input  class="form-control" name="tgl"  id="tgl" type="text" required onkeydown="return numbersonly(this, event)">
                                            </div>
                                        </div>
                                    </div>
                                </div>
								  <div class="row clearfix">
                                    <div class="col-lg-4 col-md-4  form-control-label">
                                        <label for="email_address_2" class="col-black"> Keterangan  </label>
                                    </div>
                                    <div class="col-lg-7 col-md-7  ">
                                        <div class="form-group">
                                            <div class="form-line" id="data_mapel">
                                         <textarea  class="form-control" name="f[ket]" ></textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
								
						 
                 </div>
								
						 
 
                       <div class="modal-footer">
						<span id="msg" class="pull-left"></span>
                            <div class="btn-group" role="group" aria-label="Default button group">
                                      
                                        
                                         <button id="submit" class="btn bg-teal waves-effect" onclick="submitForm('modal_add')"><i class="material-icons">save</i> SIMPAN</button>
                                    </div>
                             
                        </div>

				</div>
				</div>
					 
       		
				</form></div>
				
   </div>
	
	
	