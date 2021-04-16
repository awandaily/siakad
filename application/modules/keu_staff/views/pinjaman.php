  <div class="row clearfix" style="margin-top:-20px">
                <!-- Task Info -->
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" id="area_formhonor">
				<form class="form-horizontal" id="formhonor"  action="javascript:submitForm('formhonor')"   url="<?php echo base_url()?>keu_staff/input_pinjaman"  method="post" >
                     
                    <div class="card">
					     
                        <div class="header">
						  <h2>INPUT PINJAMAN</h2>
                           <small>Penagihan pinjaman ini akan disertakan secara otomatis pada saat penggajian. </small>
                        </div>
						 
                      
                       
                             <div class="body" >
							  <div class="row clearfix">
                                    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                        <label for="password_2"> Peminjam</label>
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
                                
								 
								
									 
                                 
							 
								<div class="row clearfix"  >
                                    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                        <label for="password_2">Tanggal Pinjam </label>
                                    </div>
                                    <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                        <div class="form-group">
                                            <div class="form-line"  >
                                                <input required type="text" id="tgl" autocomplete="off" name="tgl" class="form-control"  >
                                            </div>
                                        </div>
                                    </div>
                                </div>
								
								<div class="row clearfix"  >
                                    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                        <label for="password_2">Jumlah Pinjaman </label>
                                    </div>
                                    <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                        <div class="form-group">
                                            <div class="form-line"  >
                                                <input required type="text" name="jumlah_pinjaman" class="form-control"  onkeydown="return numbersonly(this, event);">
                                            </div>
                                        </div>
                                    </div>
                                </div>

								<div class="row clearfix"  >
                                    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                        <label for="password_2">Jumlah Cicilan </label>
                                    </div>
                                    <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                        <div class="form-group">
                                            <div class="form-line"  >
                                                <input required type="text" name="jumlah_cicilan" class="form-control"  onkeydown="return numbersonly(this, event);">
                                            </div>
                                        </div>
                                    </div>
                                </div>
								
									<div class="hide row clearfix"  >
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
					     
                        <div class="header">
						  <h2>DATA PINJAMAN</h2>
               
                        </div>
						<div class="body">	 
						<div class="table-responsive" id="area_lod">
                               <table id='table' class="tabel black table-bordered  table-hover dataTable" style="font-size:12px;width:100%">
								<thead  class='sadow bg-blue'>			
									<th class='thead' axis="string" width='15px'>&nbsp;NO</th>
									<th class='thead' >TANGGAL PINJAMAN</th>
									<th class='thead' >NAMA PEMINJAM</th>
									<th class='thead' >JUMLAH PINJAMAN </th>
									<th class='thead' >JUMLAH CICILAN </th>
								 
								<!--	<th class='thead' >KETERANGAN</th>					-->				 
									<th class='thead' > HAPUS </th>
								</thead>
							</table>	
			</div>
			</div>
  </div>
  </div>
  </div>
  
   <script>
			 $(".select").selectpicker();
			 </script>
  
  <script>
			function hapus_data(id,nama){
		     alertify.confirm("<center><span class='col-pink'> "+nama+"</span><br> Hapus ? </center>",function(){
				 
			$.ajax({
			url:"<?php echo base_url()?>keu_staff/hapusPinjaman",
			data:"code="+id,
			type: "POST",
			dataType: "JSON",
			success: function(data)
					{	  
						 
						 
						berhasil_disimpan();
						 getAction();
					 
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
 function pilihNama()
{	
var a =	 $("#getNamaS").hide(); 
var id_kelas=$("[name='id_kelas']").val();
if(!id_kelas || id_kelas==0)
{
	a.hide();
	return false;
}
a.show();


    $.ajax({
	 url:"<?php echo base_url();?>keu_staff/getNamaSiswaForInput",
     data:"id="+id_kelas,
	 method:"POST",
     success: function(data)
            {
			
				 $("#getNama").html(data);	
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
	 
	 
 }
 function getAction()
 {	 
   dataTable.ajax.reload(null,false);	
 }
 
 function kelasLoad()
 {
	
	 var id=$("#id_kelas").val();
	 $.post("<?php echo site_url("keu_staff/getNamaSiswa"); ?>",{id:id},function(data){
		$("#getNama").html(data);
	 });
 }
 function getNIS()
 {
	
	 var id=$("#nis").val();
	 if(id==null)
	 {
		  notif("Input NIS/NISN");
			 return false;
	 }
	 $.post("<?php echo site_url("keu_staff/getNamaSiswaByNis"); ?>",{id:id},function(data){
		 if(data=="no")
		 {
			 $("[name='nama']").val(0);
			 notif("Tidak ditemukan!");
			 return false;
		 }
	 
		$("#getNama").html(data);
	 });
 }
  </script>
  <script>
  
function detailTagihan(id,nama_biaya)
{	loading("area_loding");
	$("#defaultModal").modal("show");
	 var nama=$("[name='nama']").val();
	 $.post("<?php echo site_url("keu_staff/detailTagihan"); ?>",{id:id,nama:nama},function(data){
		$("#isitagihan").html(data);
		$("#defaultModalLabel").html(nama_biaya);
		unblock("area_loding");
	 });
}
 </script>  
 
 
 
 
 <script>
  
function tampilkan(nama_biaya,id)
{	 
	$("#defaultModal").modal("show");
	 $("#defaultModalLabel2").html(nama_biaya);
	 $.post("<?php echo site_url("keu_staff/lihatDataHonor"); ?>",{id:id},function(data){
		$("#isitagihan").html(data); 
	 });
}

function edit_pinjaman(id,nominal,nama)
{	 
	$("#defaultModaltagihan").modal("show");
	$("[name='nama_tagihan']").val(nama);
	$("[name='nominal_tagihan']").val(nominal);
	$("[name='id_tagihan']").val(id);
	 $("#defaultModalLabel3").html(nama);
	 $("#defaultlabel").html(nama);
	 
}

function edit_cicilan(id,nominal,nama)
{	 
	$("#defaultModalcicilan").modal("show");
	$("[name='nama_cicilan']").val(nama);
	$("[name='nominal_cicilan']").val(nominal);
	$("[name='id_cicilan']").val(id);
	 $("#defaultModalLabelCicilan").html(nama);
	 $("#defaultlabelcicilan").html(nama);
	 
}

function edit_nama(id,nama)
{	 
	$("#defaultModalnama").modal("show");
	$("[name='nama_tagihan_edit']").val(nama);
 	$("[name='id_tagihan_edit']").val(id);
	 $("#defaultModalLabel4").html(nama);
	 $("#defaultlabelnama").html(nama);
	 
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
 function simpan_ubah_nama()
{	loading("defaultModalnama");
var id=$("[name='id_tagihan_edit']").val();
var nama=$("[name='nama_tagihan_edit']").val();
	$.post("<?php echo site_url("keu_staff/updateNama"); ?>",{id:id,nama:nama},function(data){
		$("#defaultModalnama").modal("hide");
		berhasil_disimpan();
		unblock("defaultModalnama");
		getAction();
		
	 });
}
 </script> 
 
 <div   class="modal fade in" id="defaultModalnama" tabindex="-1" role="dialog">
                <div class="modal-dialog  " role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title col-teal"  > EDIT NAMA TAGIHAN</h4>
                        </div>
                        <div class="modal-body col-black"  >
						<br>
                            	<div class="col-md-12 col-lg-12" style="margin-top:-35px">
                                    <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 form-control-label">
                                        <label  >  Nama Kegiatan </label>
                                    </div>
                                    <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
                                        <div class="form-group ">
                                             
											 
                                                <input type="text"  name="nama_tagihan_edit" class="form-control form_pembayaran">
												  
												<input type="hidden" name="id_tagihan_edit"> 
										  
                                        </div>
											
                                    </div>
									 
							 </div>
                        </div>
                        <div class="modal-footer">
                            <div class="btn-group" role="group">
                                    <button type="button" class="btn bg-grey waves-effect" data-dismiss="modal">TUTUP</button>
                                    <button type="button" class="btn bg-teal waves-effect" onclick="simpan_ubah_nama()">SIMPAN</button>
                              
                                </div>
						   </div>
                    </div>
                </div>
            </div> 
 
 <div   class="modal fade in" id="defaultModaltagihan" tabindex="-1" role="dialog">
                <div class="modal-dialog  " role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title col-teal" >EDIT JUMLAH PINJAMAN</h4>
                        </div>
                        <div class="modal-body col-black"  >
						<br>
                            	<div class="col-md-12 col-lg-12" style="margin-top:-35px">
                                    <div class="col-lg-5 col-md-5 col-sm-12 col-xs-12 form-control-label">
                                        <label id="defaultlabel" >   </label>
                                    </div>
                                    <div class="col-lg-7 col-md-7 col-sm-12 col-xs-12">
                                        <div class="form-group ">
                                             
											 
                                                <input type="text"  name="nominal_tagihan" class="form-control form_pembayaran" 
												placeholder="Input Nominal Bayar"   onkeydown="return numbersonly(this, event);">
												<input type="hidden" name="id_tagihan"> 
										  
                                        </div>
											
                                    </div>
									 
							 </div>
                        </div>
                        <div class="modal-footer">
                            <div class="btn-group" role="group">
                                    <button type="button" class="btn bg-grey waves-effect" data-dismiss="modal">TUTUP</button>
                                    <button type="button" class="btn bg-teal waves-effect" onclick="simpan_ubah_nominal()">SIMPAN</button>
                              
                                </div>
						   </div>
                    </div>
                </div>
            </div> 
 
 <div   class="modal fade in" id="defaultModal" tabindex="-1" role="dialog">
                <div class="modal-dialog  " role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title col-teal" id="defaultModalLabel2"></h4>
                        </div>
                        <div class="modal-body col-black" id="isitagihan">
                            
                        </div>
                        <div class="modal-footer">
                            
                            <button type="button" class="btn btn-link waves-effect" data-dismiss="modal">TUTUP</button>
                        </div>
                    </div>
                </div>
            </div>
  
 <div   class="modal fade in" id="defaultModalcicilan" tabindex="-1" role="dialog">
                <div class="modal-dialog  " role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title col-teal" >EDIT JUMLAH CICILAN</h4>
                        </div>
                        <div class="modal-body col-black"  >
						<br>
                            	<div class="col-md-12 col-lg-12" style="margin-top:-35px">
                                    <div class="col-lg-5 col-md-5 col-sm-12 col-xs-12 form-control-label">
                                        <label id="defaultlabelcicilan" >   </label>
                                    </div>
                                    <div class="col-lg-7 col-md-7 col-sm-12 col-xs-12">
                                        <div class="form-group ">
                                             
											 
                                                <input type="text"  name="nominal_cicilan" class="form-control form_pembayaran" 
												placeholder="Input Nominal Cicilan"   onkeydown="return numbersonly(this, event);">
												<input type="hidden" name="id_cicilan"> 
										  
                                        </div>
											
                                    </div>
									 
							 </div>
                        </div>
                        <div class="modal-footer">
                            <div class="btn-group" role="group">
                                    <button type="button" class="btn bg-grey waves-effect" data-dismiss="modal">TUTUP</button>
                                    <button type="button" class="btn bg-teal waves-effect" onclick="simpan_ubah_cicilan()">SIMPAN</button>
                              
                                </div>
						   </div>
                    </div>
                </div>
            </div> 
 
 <div   class="modal fade in" id="defaultModal" tabindex="-1" role="dialog">
                <div class="modal-dialog  " role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title col-teal" id="defaultModalLabel2"></h4>
                        </div>
                        <div class="modal-body col-black" id="isitagihan">
                            
                        </div>
                        <div class="modal-footer">
                            
                            <button type="button" class="btn btn-link waves-effect" data-dismiss="modal">TUTUP</button>
                        </div>
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
            "url": "<?php echo site_url('keu_staff/getPinjaman');?>",
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

  
 </script>