  <div class="row clearfix" style="margin-top:-20px">
                <!-- Task Info -->
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" id="area_formbayar">
				<form class="form-horizontal" id="formbayar"  action="javascript:submitForm('formbayar')"   url="<?php echo base_url()?>datasi/input_tagihan"  method="post" >
                     
                    <div class="card">
					     
                        <div class="header">
						  <h2>INPUT TAGIHAN SISWA</h2>
                           <small>Merupakan tagihan untuk siswa yang sifatnya tambahan. </small>
                        </div>
						 
                      
                       
                             <div class="body" id="area_lod">
							  <div class="row clearfix">
                                    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                        <label for="password_2"> Pilih Tingkat </label>
                                    </div>
                                    <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                        <div class="form-group">
                                            <div class="form-line"  >
                                                <select class="form-control show-tick" name="id_tk"  onchange="pilihJurusan()" >
												<option value='0'>=== Semua Tingkatan ===</option>
												<option value='1'>Tingkat X (Sepuluh)</option>
												<option value='2'>Tingkat XI (Sebelas)</option>
												<option value='3'>Tingkat XII (Dua belas)</option>
												</select>
                                            </div>
                                        </div>
                                    </div>
                                </div> 
                                <div class="row clearfix">
                                    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                        <label for="email_address_2">Pilih Jurusan</label>
                                    </div>
                                    <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                        <div class="form-group">
                                            <div class="form-line">
                                              
											  
											  <select class="form-control show-tick"  data-live-search="true"    id="jurusan" name="id_jurusan"   onchange="pilihJurusan()">
                                       
											<option value="0">=== Semua Jurusan ===</option>
										 	<?php 
										   $db=$this->db->get("tr_jurusan")->result(); 
												   foreach($db as $vals){
													   echo "<option value='".$vals->id."'>".$vals->alias."</option>";
												   } 
										   ?>
									  
											</select>
											   
                                            </div>
                                        </div>
                                    </div>
                                </div>
								 
								
									<div   id="isiJurusan">	</div>
                                 
								
								<div class="row clearfix" id="getNamaS">
                                    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                        <label for="password_2">Pilih Siswa </label>
                                    </div>
                                    <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                        <div class="form-group">
                                            <div class="form-line" id="getNama">
                                                
                                            </div>
                                        </div>
                                    </div>
                                </div>
								
								<div class="row clearfix"  >
                                    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                        <label for="password_2">Nama Tagihan </label>
                                    </div>
                                    <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                        <div class="form-group">
                                            <div class="form-line"  >
                                                <input required type="text" name="nama_tagihan" class="form-control"  >
                                            </div>
                                        </div>
                                    </div>
                                </div>
								
								<div class="row clearfix"  >
                                    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                        <label for="password_2">Jumlah Tagihan </label>
                                    </div>
                                    <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                        <div class="form-group">
                                            <div class="form-line"  >
                                                <input required type="text" name="tagihan" class="form-control"  onkeydown="return numbersonly(this, event);">
                                            </div>
                                        </div>
                                    </div>
                                </div>
						  
				<center>		  <button class="btn bg-teal" onclick="submitForm('formbayar')"><i class="material-icons">save</i> SIMPAN </button>			</center>
                           <!----->
                        </div>
                    </div>
					 
					
					 
					  </form>
                </div>
       </div>
	   
	   
	   
<div class="row clearfix" style="margin-top:-20px">
                <!-- Task Info -->
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" id="area_formbayar">
				       
                    <div class="card">
					     
                        <div class="header">
						  <h2>DATA TAGIHAN SISWA</h2>
                      
                        </div>
						<div class="body">	 
						<div class="table-responsive" id="area_lod">
                               <table id='table' class="tabel black table-bordered  table-hover dataTable" style="font-size:12px;width:100%">
								<thead  class='sadow bg-blue'>			
									<th class='thead' axis="string" width='15px'>&nbsp;NO</th>
									<th class='thead' >KODE</th>
									<th class='thead' >TANGGAL INPUT</th>
									<th class='thead' >NAMA TAGIHAN</th>
									<th class='thead' >JUMLAH TAGIHAN </th>
									<th class='thead' >TINGKAT</th>
									<th class='thead' >JURUSAN</th>
									<th class='thead' >KELAS</th>
									<th class='thead' >SISWA</th>
									<th class='thead' > HAPUS </th>
								</thead>
							</table>	
			</div>
			</div>
  </div>
  </div>
  </div>
  
  
  
  <script>
			function hapus_data(id,nama){
		     alertify.confirm("<center><span class='col-pink'> "+nama+"</span><br> Hapus ? </center>",function(){
				 
			$.ajax({
			url:"<?php echo base_url()?>datasi/hapusTagihanTambahan",
			data:"id_tagihan="+id,
			type: "POST",
			dataType: "JSON",
			success: function(data)
					{	  
						if(data=="bayar")
						{
							notif("Gagal menghapus karena terdapat siswa yang sudah melakukan pembayaran");
						}else{
						 
						berhasil_disimpan();
						 getAction();
						} 
					}
			});
		   
		   })
	  };
 </script>
 
  <script>
			function hapusTagihan(nama,id,tagihan){
		     alertify.confirm("<center><span class='col-pink'> "+nama+"</span><br> Hapus ? </center>",function(){
				 
			$.ajax({
			url:"<?php echo base_url()?>datasi/hapusTagihanSiswaSatuan",
			data:"id_tagihan="+tagihan+"&id_siswa="+id,
			type: "POST",
			dataType: "JSON",
			success: function(data)
					{	  
						if(data=="bayar")
						{
							notif("Gagal menghapus karena siswa tersebut sudah melakukan pembayaran");
						}else{
						$("#table"+id).hide();
						berhasil_disimpan();
						 getAction();
						} 
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
	 url:"<?php echo base_url();?>datasi/getNamaSiswaForInput",
     data:"id="+id_kelas,
	 method:"POST",
     success: function(data)
            {
			
				 $("#getNama").html(data);	
            }
    });   
}

		 pilihJurusan();
	 function pilihJurusan()
	 {		var id=$("[name='id_jurusan']").val();
	 		var idt=$("[name='id_tk']").val();
		   $.post("<?php echo base_url();?>datasi/getKelasperJurusan",{jurusan:id,tingkat:idt},function(data){
				$("#isiJurusan").html(data);
		      });
	 }
	 </script>
	 
 <script>
 function resset()
 {
	// var nisawal=$("#nis").val();
	 $("#formbayar")[0].reset();
	 
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
	 $.post("<?php echo site_url("datasi/getNamaSiswa"); ?>",{id:id},function(data){
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
	 $.post("<?php echo site_url("datasi/getNamaSiswaByNis"); ?>",{id:id},function(data){
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
	 $.post("<?php echo site_url("datasi/detailTagihan"); ?>",{id:id,nama:nama},function(data){
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
	 $.post("<?php echo site_url("datasi/lihatDataSiswa"); ?>",{id:id},function(data){
		$("#isitagihan").html(data); 
	 });
}

function edit_tagihan(id,nominal,nama)
{	 
	$("#defaultModaltagihan").modal("show");
	$("[name='nama_tagihan']").val(nama);
	$("[name='nominal_tagihan']").val(nominal);
	$("[name='id_tagihan']").val(id);
	 $("#defaultModalLabel3").html(nama);
	 $("#defaultlabel").html(nama);
	 
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
 function simpan_ubah_nominal()
{	loading("defaultModaltagihan");
var id=$("[name='id_tagihan']").val();
var nominal=$("[name='nominal_tagihan']").val();
	$.post("<?php echo site_url("datasi/updateNominalTagihan"); ?>",{id:id,nominal:nominal},function(data){
		$("#defaultModaltagihan").modal("hide");
		berhasil_disimpan();
		getAction();
		unblock("defaultModaltagihan");
	 });
}
 </script>  
 <script>
 function simpan_ubah_nama()
{	loading("defaultModalnama");
var id=$("[name='id_tagihan_edit']").val();
var nama=$("[name='nama_tagihan_edit']").val();
	$.post("<?php echo site_url("datasi/updateNamaTagihan"); ?>",{id:id,nama:nama},function(data){
		$("#defaultModalnama").modal("hide");
		berhasil_disimpan();
		getAction();
		unblock("defaultModalnama");
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
                                        <label  >  Nama Tagihan </label>
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
                            <h4 class="modal-title col-teal" >EDIT JUMLAH TAGIHAN</h4>
                        </div>
                        <div class="modal-body col-black"  >
						<br>
                            	<div class="col-md-12 col-lg-12" style="margin-top:-35px">
                                    <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 form-control-label">
                                        <label id="defaultlabel" >   </label>
                                    </div>
                                    <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
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
            "url": "<?php echo site_url('datasi/getTagihanTambahan');?>",
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