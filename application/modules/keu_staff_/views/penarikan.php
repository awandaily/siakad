  <div class="row clearfix" style="margin-top:-20px" id="tarik">
                <!-- Task Info -->
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" id="area_formtabung">
				       
                    <div class="card  ">
					     
                        <div class="header">
						<button class='pull-right' onclick="javascript:tutup()">X</button>
						  <h2 class="col-indigo">DATA PENGAMBILAN TABUNGAN</h2>
                       
                        </div>
						 
                      
                       <form class="form-horizontal" id="formtabung"  action="javascript:submitForm('formtabung')"   url="<?php echo base_url()?>keu_staff/tarik_simpanan"  method="post" >
              
                             <div class="body " >
							  <div class="row clearfix">
                                    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                        <label for="password_2"> Penabung</label>
                                    </div>
                                    <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                        <div class="form-group">
                                            <div class="form-line"  >
                                            	  <select required data-selected-text-format="count" class="select form-control show-tick" data-actions-box="true" name="id_guru"
												  id="id_guru_tarik" data-live-search="true" onchange="getNominal()"  >
												<option> ==== Pilih ==== </option>
										 
										 	<?php  
												 $this->db->order_by("nama","ASC");
												   $dbs=$this->db->get_where("data_pegawai")->result();
												   foreach($dbs as $vals){
													   echo "<option select value='".$vals->id."'>".$vals->nama."</option>";
												   } 
										   ?>	
										   
									  
											</select>
                                            </div>
                                        </div>
                                    </div>
                                </div> 
								
                         
                                 <div class="row clearfix">
                                    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                        <label for="password_2"> Jenis Simpanan</label>
                                    </div>
                                    <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                        <div class="form-group">
                                            <div class="form-line"  >
                                            	  <select required   class="select form-control show-tick" data-actions-box="true" name="sts"
												  id="sts_tarik" data-live-search="true"  onchange="getNominal()" >
												<option value=""> ==== Pilih ==== </option>
										 
										 	<?php  
												 $this->db->order_by("nama","ASC");
												   $dbs=$this->db->get("keu_tr_stssimpanan")->result();
												   foreach($dbs as $vals){
													   echo "<option select value='".$vals->id."'>".$vals->nama."</option>";
												   } 
										   ?>	
										   
									  
											</select>
                                            </div>
                                        </div>
                                    </div>
                                </div> 
								 
								
									 
                                 
							 
								<div class="row clearfix"  >
                                    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                        <label for="password_2">Tanggal  </label>
                                    </div>
                                    <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                        <div class="form-group">
                                            <div class="form-line"  >
                                                <input required type="text" id="tgl2" name="tgl" autocomplete="off" class="form-control"  >
                                            </div>
                                        </div>
                                    </div>
                                </div>
								
								<div class="row clearfix"  >
                                    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                        <label for="password_2">Jumlah Tabungan   </label>
                                    </div>
                                    <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                        <div class="form-group">
                                            <div class="form-line"  >
                                                <input required  onkeyup="amankan()"   style="font-weight:bold" type="text" id="jumlah_tarik" name="jumlah" class="col-pink form-control"  onkeydown="return numbersonly(this, event);">
                                            </div>
										<b>	<span id="ket_tarik" class="col-pink"></span></b>
                                        </div>
                                    </div>
                                </div>

							 
							<!--	
									<div class="  row clearfix"  >
                                    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                        <label for="password_2">Keterangan </label>
                                    </div>
                                    <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                        <div class="form-group">
                                            <div class="form-line"  >
                                                <textarea name="ket" class="form-control"  ></textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
						  --->
				<center>		  <button class="btn bg-indigo" onclick="submitForm('formtabung')"><i class="material-icons">save</i> SIMPAN </button>			</center>
                           <!----->
                        </div></form>
                    </div>
					 
					
					 
					  
                </div>
       </div>  <div class="row clearfix" style="margin-top:-20px" id="input">
                <!-- Task Info -->
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" id="area_formhonor">
				       
                    <div class="card">
					     
                        <div class="header">
						<button class='pull-right' onclick="javascript:tutup()">X</button>
						  <h2>INPUT SIMPANAN</h2>
                       
                        </div>
						 
                      
                       <form class="form-horizontal" id="formhonor"  action="javascript:submitForm('formhonor')"   url="<?php echo base_url()?>keu_staff/input_simpanan"  method="post" >
              
                             <div class="body" >
							  <div class="row clearfix">
                                    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                        <label for="password_2"> Penabung</label>
                                    </div>
                                    <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                        <div class="form-group">
                                            <div class="form-line"  >
                                            	  <select required data-selected-text-format="count" class="select form-control show-tick" data-actions-box="true" name="id_guru"    id="id_guru" data-live-search="true"   >
												<option> ==== Pilih ==== </option>
										 
										 	<?php 
										  
										 
											 
												 $this->db->order_by("nama","ASC");
												   $dbs=$this->db->get_where("data_pegawai")->result();
												   foreach($dbs as $vals){
													   echo "<option select value='".$vals->id."'>".$vals->nama."</option>";
												   }
												  
											 
										 
										   ?>	
										   
									  
											</select>
                                            </div>
                                        </div>
                                    </div>
                                </div> 
                                
								 <div class="row clearfix">
                                    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                        <label for="password_2"> Jenis Simpanan</label>
                                    </div>
                                    <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                        <div class="form-group">
                                            <div class="form-line"  >
                                            	  <select required   class="select form-control show-tick" data-actions-box="true" name="sts"
												  id="id_guru_tarik" data-live-search="true"   >
												<option value=""> ==== Pilih ==== </option>
										 
										 	<?php  
												 $this->db->order_by("nama","ASC");
												   $dbs=$this->db->get_where("keu_tr_stssimpanan" )->result();
												   foreach($dbs as $vals){
													   echo "<option select value='".$vals->id."'>".$vals->nama."</option>";
												   } 
										   ?>	
										   
									  
											</select>
                                            </div>
                                        </div>
                                    </div>
                                </div> 
								
									 
                                 
							 
								<div class="row clearfix"  >
                                    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                        <label for="password_2">Tanggal  </label>
                                    </div>
                                    <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                        <div class="form-group">
                                            <div class="form-line"  >
                                                <input required type="text" autocomplete="off" id="tgl" name="tgl" class="form-control"  >
                                            </div>
                                        </div>
                                    </div>
                                </div>
								
								<div class="row clearfix"  >
                                    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                        <label for="password_2">Jumlah   </label>
                                    </div>
                                    <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                        <div class="form-group">
                                            <div class="form-line"  >
                                                <input required type="text" name="jumlah" class="form-control"  onkeydown="return numbersonly(this, event);">
                                            </div>
                                        </div>
                                    </div>
                                </div>

							 
								
									<div class="  row clearfix"  >
                                    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                        <label for="password_2">Keterangan </label>
                                    </div>
                                    <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                        <div class="form-group">
                                            <div class="form-line"  >
                                                <textarea name="ket" class="form-control"  ></textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
						  
				<center>		  <button class="btn bg-teal" onclick="submitForm('formhonor')"><i class="material-icons">save</i> SIMPAN </button>			</center>
                           <!----->
                        </div></form>
                    </div>
					 
					
					 
					  
                </div>
       </div>
	   
	   
	   
<div class="row clearfix" style="margin-top:-20px">
                <!-- Task Info -->
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" id="area_formhonor">
				       
                    <div class="card">
					     
                        <div class="header">	<div class="btn-group pull-right" role="group"  >
                                  
                                    
                                    <button type="button" class="bg-indigo btn   waves-effect" onclick="tarik()">PENGAMBILAN</button>
                                </div>
						  <h2>DATA PENGAMBILAN TABUNGAN</h2>
						
                        </div>
						<div class="body">	 
						<div class="table-responsive" id="area_lod">
                               <table id='table' class="tabel black table-bordered  table-striped table-hover dataTable" style="font-size:12px;width:100%">
								<thead  class='sadow bg-blue'>			
									<th class='thead' axis="string" width='15px'>&nbsp;NO</th>
									<th class='thead' >NAMA</th>
									<th class='thead' >TANGGAL </th> 
								 
									<th class='thead' >KATEGORY</th>
									<th class='thead' >NOMINAL </th> 
								
							  	  
									<th class='thead' width="120px"> HAPUS </th>
								</thead>
							</table>	
			</div>
			</div>
  </div>
  </div>
  </div>
  
   <script>
   function input()
   {
	    $("#input").show();
	    $("#tarik").hide();
   } function tarik()
   {
	    $("#input").hide();
	    $("#tarik").show();
   }
   function tutup()
   {
	    $("#input").hide();
	    $("#tarik").hide();
   }
   $("#input").hide();
   $("#tarik").hide();
			 $(".select").selectpicker();
   </script>
  
  <script>
			function hapus_data(id,nama){
		     alertify.confirm("<center><span class='col-pink'> "+nama+"</span><br> Hapus ? </center>",function(){
				 
			$.ajax({
			url:"<?php echo base_url()?>keu_staff/hapusSimpanan",
			data:"code="+id,
			type: "POST",
			dataType: "JSON",
			success: function(data)
					{	   
						berhasil_disimpan();
						 getAction();
						$("#input").hide();
						$("#tarik").hide();
						$("#ket_tarik").html("");
					}
			});
		   
		   })
	  };
 </script>
 
  <script>
			function hapusHonor(nama,id,no,code){
		     alertify.confirm("<center><span class='col-pink'> "+nama+"</span><br> Hapus ? </center>",function(){
				 
			$.ajax({
			url:"<?php echo base_url()?>keu_staff/hapusHonorSatuan",
			data:"code="+code+"&id_guru="+id,
			type: "POST",
			dataType: "JSON",
			success: function(data)
					{	  
						 
						 
						$("#table"+no).hide();
						berhasil_disimpan();
						 getAction();
						 
					}
			});
		   
		   })
	  };
 </script>
  
  
  
  
                <!-- #END# Task Info -->
		 <script>
		 	 $("#getNamaS").hide();
  var jumlahTabungan=0;
  var bil=0;
 function amankan()
 {
	 var jmltarik=$("#jumlah_tarik").val();
	 var myStr = jmltarik;
	 var jmltarik = myStr.replace(/\./g,'');
	 if(jmltarik>jumlahTabungan)
	 {
		 notif("Maaf jumlah pengambilan lebih besar dari pada jumlah simpanan");
		 $("#jumlah_tarik").val(bil);
	 }
 }

	 function getNominal()
	 {		var id=$("#id_guru_tarik").val();
	 		var sts=$("#sts_tarik").val();
			if(!sts){	$("#jumlah_tarik").val("");
					    $("#ket_tarik").html("");	return false;		}
			$.ajax({
			url:"<?php echo base_url();?>keu_staff/getNominal",
			data:"id="+id+"&sts="+sts,
			type: "POST",
			dataType: "JSON",
			success: function(data)
					{	  
					var myStr = data["nominal"];
					jTabungan = myStr.replace(/\./g,'');
					jumlahTabungan=Number(jTabungan);
					bil =myStr;
				$("#jumlah_tarik").val(data["nominal"]);
				$("#ket_tarik").html(data["baca"]);
		      }
			});
	 }
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
 function simpan_ubah_cicilan()
{	loading("defaultModalcicilan");
var id=$("[name='id_cicilan']").val();
var nominal=$("[name='nominal_cicilan']").val();
	$.post("<?php echo site_url("keu_staff/updateCicilan"); ?>",{id:id,nominal:nominal},function(data){
		$("#defaultModalcicilan").modal("hide");
		berhasil_disimpan();
		unblock("defaultModalLabelCicilan");
		getAction();
		
	 });
}
 </script>   
 <script>
 function simpan_ubah_nominal()
{	loading("defaultModaltagihan");
var id=$("[name='id_tagihan']").val();
var nominal=$("[name='nominal_tagihan']").val();
	$.post("<?php echo site_url("keu_staff/updatePinjaman"); ?>",{id:id,nominal:nominal},function(data){
		$("#defaultModaltagihan").modal("hide");
		berhasil_disimpan();
			unblock("defaultModaltagihan");
		getAction();
	
	 });
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
 
 <div   class="modal fade in" id="mdl_editformsimpan" tabindex="-1" role="dialog">
                <div class="modal-dialog  " role="document" id="area_editformsimpan">
				 <form class="form-horizontal" id="editformsimpan"  action="javascript:submitForm('editformsimpan')"   url="<?php echo base_url()?>keu_staff/update_penarikan"  method="post" >
              
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title col-teal" id="titleEdit" > EDIT DATA  </h4>
                        </div>
						
                        <div class="modal-body col-black"   >
					 
                            	<div class="col-md-12 col-lg-12"  >
                                    <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12 form-control-label">
                                        <label  >  Tanggal  </label>
                                    </div>
                                    <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12">
                                        <div class="form-group ">
                                              
                                                <input type="text" id="tglEdit"  name="tgl" class="form-control form_pembayaran">
												  
												<input type="hidden" name="id_edit"> 
										  
                                        </div>
											
                                    </div>
									 
							 </div>
							 
							 <div class="col-md-12 col-lg-12"  >
                                    <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12 form-control-label">
                                        <label  >  Nominal  </label>
                                    </div>
                                    <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12">
                                        <div class="form-group "> 
                                                <input type="text"  onkeydown="return numbersonly(this, event);" id="nominalEdit" name="nominal" class="form-control form_pembayaran"> 
                                        </div> 
                                    </div> 
							 </div>
					<!--		 <div class="col-md-12 col-lg-12"  >
                                    <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12 form-control-label">
                                        <label  >  Keterangan  </label>
                                    </div>
                                    <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12">
                                        <div class="form-group "> 
                                        
												<textarea name="ket" id="ketEdit" class="form-control"></textarea>
                                        </div> 
                                    </div> 
							 </div>
							 -->
							 
							 
                        </div>
					 
						 
						 
						 
					 
						<br>
						 
						<br>
						<br>
                        <div class="modal-footer" >
                            <div class="btn-group" role="group" style="margin-right:40px">
                                    <button type="button" class="hide btn bg-grey waves-effect" data-dismiss="modal">TUTUP</button>
                                    <button   class="btn bg-teal waves-effect" onclick="submitForm('editformsimpan')">SIMPAN</button>
                              
                                </div>
						   </div>
						   
                    </div>
					</form>
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
            "url": "<?php echo site_url('keu_staff/getPengambilan');?>",
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

  
 
$('#tgl2').daterangepicker({
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

  
 </script>
  