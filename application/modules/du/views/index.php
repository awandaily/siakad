  <?php
  $profil=$this->dm->dataProfile();
  $kondisi	=	$this->session->userdata("kondisi");
  $idprov	=	$this->session->userdata("idprov");
  $idkab	=	$this->session->userdata("idkab");
  $idkec	=	$this->session->userdata("idkec");
  $kondisi	=	$this->session->userdata("kondisi");
  $level	=	$this->session->userdata("level");
  ?>
  
 
		
<div class="row clearfix">
<div class="col-md-12 col-lg-12 col-xs-12 pull-right"  >
		 <div class="btn-group pull-right">
		 <?php if($level!='pimpinan'){?>
                                    <button type="button" onclick="add()" class="btn bg-teal waves-effect">Tambah</button> 
		 <?php } ?>							
                    <!--                <button type="button" onclick="download()" class="btn bg-teal dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                       Download 
                                    </button>-->
                                     
                                </div>
								
			 
			
			
		</div>	
		<hr>
	<div class="col-md-3 col-lg-3 col-xs-12"  >
		  	 <?php
									    $array_prov="";
									 	 $ref_type = $this->db->query("SELECT * FROM tr_kondisibangunan ")->result();
                                         $array_prov["0"] = "=== Pilih Status Kondisi===";
                                        foreach ($ref_type as $val) {
                                            $array_prov[$val->id] =  $val->nama;
                                        }
										$array_prov["null"] =  "Tidak diketahui";
                                        $data = $array_prov;
                                        echo form_dropdown('kondisi', $data, $kondisi, 'class="form-control" onchange="updateValue()" ');
										?>
	  
		</div> 
 
  
		
		<div class="col-md-3 col-lg-3 col-xs-12  "  >
	 	<?php 
		$array_prov="";
		                                $ref_type = $this->db->query("SELECT distinct(idprov) as idprov,nama_prov FROM tm_wilayah order by nama_prov asc ")->result();
                                        $array_prov["0"] = "=== Pilih Provinsi ===";
                                        foreach ($ref_type as $val) {
                                            $array_prov[$val->idprov] =  $val->nama_prov;
                                        }
                                        $data = $array_prov;
                                       echo form_dropdown('kode_provinsi', $data, $idprov, 'class="form-control selectKab" id="selectProvArea"   ');
									?>
	
		</div> 
		 <div class="col-md-3 col-lg-3 col-xs-12 "  >
		<span id="kabArea"> 
	 	 <?php
									    $array_prov="";
									    $array_prov["0"] = "=== Pilih Kab/Kota===";
                                        $data = $array_prov;
                                        echo form_dropdown('kode_kabupaten', $data,  $idkec , 'class="form-control onchange="reloadTable()" id="kabArea" ');
		 ?>
	 	</span>
		</div> 
  
 
		 <div class="col-md-3 col-lg-3 col-xs-12 " >
		<span id="kecArea">
	 	 <?php
									    $array_prov="";
									    $array_prov["0"] = "=== Pilih Kec===";
                                        $data = $array_prov;
                                        echo form_dropdown('kode_kecamatan', $data,  $idkec , 'class="form-control onchange="reloadTable()" ');
		 ?>
	 	</span>
		</div> 
		
		
                            
                                
	 <div class="clearfix"></div>
	 
	    					<div class="card" style="margin-top:10px">   
                        <div class="body">
                            <div class="table-responsive">
                               <table id='table' class="tabel black table-striped table-bordered table-hover dataTable" style="font-size:12px;width:100%">
								<thead style="background-color:#8BC34A;color:white" class='sadow'>			
									<th class='thead' axis="string" width='15px'>No</th>
									<th class='thead' axis="date">Jenjang </th>
									<th class='thead' axis="date">Nama Madrasah </th>
									<th class='thead' axis="date">Provinsi </th>
									<th class='thead' axis="date">Kabupaten </th>
									<th class='thead' axis="date">Kecamatan </th>
									<th class='thead' axis="date">No.telp  </th>
							 
							 		<th>&nbsp;</th>
									 
								</thead>
							</table>
							</div>						
						</div>						
					</div>		
 </div>	
 
  <link href="<?php echo base_url();?>plug/datatables/css/dataTables.bootstrap.css" rel="stylesheet">
  <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/buttons/1.5.1/js/dataTables.buttons.min.js"></script>
  <script src="<?php echo base_url()?>plug/datatables/js/jquery.dataTables.min.js"></script> 
  <script src="https://cdn.datatables.net/buttons/1.5.1/js/buttons.flash.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.32/pdfmake.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.32/vfs_fonts.js"></script>
  <script src="https://cdn.datatables.net/buttons/1.5.1/js/buttons.html5.min.js"></script>
  <script src="https://cdn.datatables.net/buttons/1.5.1/js/buttons.print.min.js"></script>
  <script src="<?php echo base_url()?>plug/datatables/js/dataTables.bootstrap.js"></script>
 
 







  <script type="text/javascript">
      var save_method; //for save method string
    var table;
    $(document).ready(function() {
      table = $('#table').DataTable({ 
        "processing": true, 
        "serverSide": true, 
        "ajax": {
            "url": "<?php echo site_url('du/ajax_open');?>?idkab=<?php echo $idkab;?>&idprov=<?php echo $idprov;?>&idkec=<?php echo $idkec;?>&kondisi=<?php echo $kondisi;?>",
            "type": "POST",
		 
        },
		 	"language": {
						   "oPaginate": {
							"sFirst": "Halaman Pertama",
							"sLast": "Halaman Terakhir",
							 "sNext": "Selanjutnya",
							 "sPrevious": "Sebelumnya"
							 },
					 
						 "sInfoEmpty": "Tidak ada data yang di tampilkan",
						 
						   "sLengthMenu": " &nbsp;&nbsp;&nbsp;Menampilkan Jumlah   _MENU_ Data"
				    },

		 "responsive": true,
		 "searching": true,
		 "lengthMenu":
		 [[15, 50,100,200,300,500,1000, 800000000], 
		 [15, 50,100,200,300,500,1000,"All"]],
		 dom: 'Blfrtip',
		buttons: [
           // 'copy', 'csv', 'excel', 'pdf', 'print'
			{
                        extend: 'copy',
                        exportOptions: {
                    columns: [ 0, 1, 2,3,4,5,6 ]
                }
                    },
			 {
					extend: 'excel',
                        exportOptions: {
                    columns: [ 0, 1, 2,3,4,5,6 ]
                }
                    },
					
					{
					extend: 'pdf',
                        exportOptions: {
                    columns: [ 0, 1, 2,3,4,5,6 ]
                }
                    },{
					extend: 'print',
                        exportOptions: {
                    columns: [ 0, 1, 2,3,4,5,6 ]
                }
                    },
        ],
		
        //Set column definition initialisation properties.
        "columnDefs": [
        { 
          "targets": [ 0,-1,-2,-3 ], //last column
          "orderable": false, //set not orderable
        },
        ],

      });
    }); 
  </script>	
   
		
					
 		

 
  <script type="text/javascript">
	var save_method; //for save method string
    function reload_table()
    {
      table.ajax.reload(null,false); //reload datatable ajax 
    }
	
	function updateValue()
	{
		 var idkec=$("[name='kode_kecamatan']").val();
		 var idkab=$("[name='kode_kabupaten']").val();
		 var kondisi=$("[name='kondisi']").val();
		 var idprov=$("[name='kode_provinsi']").val();
		 $.ajax({
         url : "<?php echo base_url();?>du/saveSession/",
         type: "GET",
		 data: "idkab="+idkab+"&idprov="+idprov+"&idkec="+idkec+"&kondisi="+kondisi,
         success: function(data)
         {	  
			reload_table();
		 }
		});
	}
	function pilih(id)
	{
	$.ajax({
		url:"<?php echo base_url();?>admin/dropdownHak/"+id,
		type: "POST",
		data:"",
		 success: function(data)
				{
				$('#pilih').html(data);
				}
		});
	}
	
	 
	function add()
	{
	 save_method="add";
	 $('#formSubmit')[0].reset(); // reset form on modals
	 $("[name='kode_kabupaten']").val(0); // reset form on modals
	 $("[name='kode_kecamatan']").val(0); // reset form on modals
	 $("[name='f[username]']").attr("required", "true");
	 $("[name='password']").attr("required", "true");
	 $("[name='f[kode_provinsi]']").attr("required", "true");
	 $("[name='kode_kabupaten']").attr("required", "true");
	 $("[name='kode_kecamatan']").attr("required", "true");
	$("#msg").html("");
	$('#modaleditan').modal('show'); 
	}  
	function edit(id)
    {
	  $("[name='password']").prop("required", false);
	save_method="update";
	$("#msg").html("");
      $('#formSubmit')[0].reset(); // reset form on modals
	  //Ajax Load data from ajax
      $.ajax({
        url : "<?php echo base_url();?>du/ajax_edit/" + id,
        type: "GET",
        dataType: "JSON",
        success: function(data)
        {	 
		 
		    $('[name="id"]').val(data.id_admin);
             
            $('[name="f[telp]"]').val(data.telp);
            $('[name="f[status]"]').val(data.status);
            $('[name="f[kepala_nama]"]').val(data.kepala_nama);
            $('[name="f[jenjang]"]').val(data.jenjang);
            $('[name="f[nsm]"]').val(data.nsm);
            $('[name="f[npsn]"]').val(data.npsn);
          //  $('[name="f[lat]"]').val(data.lat);
           // $('[name="f[long]"]').val(data.long);
            $('[name="f[kd_diversifikasi]"]').val(data.kd_diversifikasi);
		 
            $('[name="f[status_akreditasi]').val(data.status_akreditasi);
		 
            $('[name="f[username]"]').val(data.username);
            $('[name="f[nama_madrasah]"]').val(data.nama_madrasah);
            $('[name="f[kode_provinsi]"]').val(data.kode_provinsi);
				 getkab22(data.kode_provinsi,data.kode_kabupaten);
			     getkec22(data.kode_kabupaten,data.kode_provinsi,data.kode_kecamatan);
                 $('#modaleditan').modal('show'); // show bootstrap modal when complete loaded
                 $('.modal-title').html('<b>Data Detail</b>'); // Set title to Bootstrap modal title  
        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error get data from ajax');
        }
    });
	
    }
  </script>		
 <script>
  function getkab22(idprov,val)
			 	 {  
										$.ajax({
										url:"<?php echo base_url();?>home/getKab2/"+val,
										type: "POST",
										data: "idprov="+idprov,
										success: function(data)
												{	
													$("#kabArea2").html(data);
										 
												}
										});			
									 };
									   function getkec22(idkab,idprov,val)
									 {
										 
										$.ajax({
										url:"<?php echo base_url();?>home/getKec2/"+val,
										type: "POST",
										data: "idkab="+idkab+"&idprov="+idprov,
										success: function(data)
												{	
													$("#kecArea2").html(data);
													  
												}
										});		
									 };
									 
									 function getkec23()
									 {
										 var idprov=$("[name='f[kode_provinsi]']").val();
										 var idkab=$("[name='f[kode_kabupaten]']").val();
										$.ajax({
										url:"<?php echo base_url();?>home/getKec2/",
										type: "POST",
										data: "idkab="+idkab+"&idprov="+idprov,
										success: function(data)
												{	
													$("#kecArea2").html(data);
													  
												}
										});		
									 };
									 
 </script>
 <script>
		 			
									 
									 function getkec2()
									 {
										 updateValue();
										 var idkab=$("[name='kode_kabupaten']").val();
										 var idprov= $("[name='kode_provinsi']").val();
									 
										$.ajax({
										url:"<?php echo base_url();?>home/getKec2/",
										type: "POST",
										data: "idkab="+idkab+"&idprov="+idprov,
										success: function(data)
												{	
													$("#kecArea").html(data);
													  
												}
										});		
										// table.ajax.reload(null,false);
									 };
									  
									 
  </script>
   
<script>
									 $("#selectProvArea").change(function()
									 {
										 var idprov=$("[name='kode_provinsi']").val();
										$.ajax({
										url:"<?php echo base_url();?>home/getKab2/",
										type: "POST",
										data: "idprov="+idprov,
										success: function(data)
												{	
													$("#kabArea").html(data);
										
													 getkec2();
												}
										});		
									 });
									 
									function selectProv()
									 {
										 var idprov=$("[name='f[kode_provinsi]']").val();
										$.ajax({
										url:"<?php echo base_url();?>home/getKab22/",
										type: "POST",
										data: "idprov="+idprov,
										success: function(data)
												{	
													$("#kabArea2").html(data);
										
													 getkec23();
												}
										});		
									 };
									 
									 
									 
									 
									 
									 
function simpan(){
    var id=$("#Hak").val();
	if(save_method=="update")
	{
	var link='<?php echo base_url("du/update"); ?>/'+id; 
	}else{
	var link='<?php echo base_url("du/insert"); ?>/'; 	
	}
	$('#msg').html('<img src="<?php echo base_url();?>plug/img/load.gif"/> Loading...');
    $.ajax({
	 url:link,
     data: $('#formSubmit').serialize(),
	 method:"POST",
	 dataType: "JSON",
     success: function(data)
            {
				if(data==true){
				$('#msg').html('<font color="green"><i class="fa fa-check-circle fa-fw fa-lg"></i> Berhasil disimpan.</font>');
				$('#modaleditan').modal('hide');
               reload_table();
			}else{
				 $('#msg').html('<font color="red"><i class="fa fa-warning fa-fw fa-lg"></i>Silahkan cari username/password lain!</font>');
			}
			
            }
    });     
};

function download()
{
window.location.href="<?php echo base_url()?>du/download/?idkab=<?php echo $idkab;?>&idprov=<?php echo $idprov;?>&idkec=<?php echo $idkec;?>&kondisi=<?php echo $kondisi;?>";
}
												 </script>


 
				
 
 <div class="modal fade" id="modaleditan" tabindex="-1" role="dialog">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="defaultModalLabel">Tambah </h4>
                        </div>
                        <div class="modal-body">
                       	  	<div class="modal-body">
				
	<form  action="javascript:simpan()" id="formSubmit" class="form-horizontal" method="post" enctype="multipart/form-data">
	<div class="col-md-6 col-lg-6 col-sm-12 col-xs-12">
	<input type="hidden" name="id" id="id">
	
   <div class="form-group">
	 
		<div class="col-md-12">
		<?php 
									 
		                                $ref_type = $this->db->query("SELECT * FROM tm_wilayah GROUP BY nama_prov order by nama_prov asc")->result();
                                        $array_prov="";
                                        $array_prov[""] = "=== Pilih Provinsi ===";
                                        foreach ($ref_type as $val) {
                                            $array_prov[$val->idprov] =  $val->nama_prov;
                                        }
                                        $data = $array_prov;
                                        echo form_dropdown('f[kode_provinsi]', $data,  "", 'class="form-control  selectKab" 
										onchange="selectProv()" ');
									?>
		</div>
	</div> 
<br/>
	<div class="form-group">
 
		<div class="col-md-12 ">
		<span  id="kabArea2">
		 <?php
											 $array_prov="";
									                $array_prov[""] = "=== Pilih Kab/Kota===";
                                       
                                        $data = $array_prov;
                                        echo form_dropdown('f[kode_kabupaten]', $data,"", 'class="form-control selectKab" id="selectKecArea" 
										  ');
										?>
		</span>								
		</div>
</div><br/>
	<div class="form-group">
 
		<div class="col-md-12 form-group-select2" >
		<span id="kecArea2">
		 <?php
											 $array_prov="";
									                $array_prov[""] = "=== Pilih Kec ===";
                                       
                                        $data = $array_prov;
                                        echo form_dropdown('f[kode_kecamatan]', $data,"", 'class="form-control selectKec" ');
										?>
		</span>								
		</div>
</div><br/>
	<div class="form-group">
	 
		<div class="col-md-12 form-group-select2">
		<?php
		 $dtt="";
		 $dtt[""]="=== Pilih Jenjang === ";
		 foreach ($this->du->getIcon() as $val) {
		 $dtt[$val->id] = $val->nama;
         }
         $dt = $dtt;
         echo form_dropdown('f[jenjang]', $dt, "", ' id="icon" class="form-control" style="width:100%"  ');   
		?>
		</div>
</div>
<br/>
	<div class="form-group">
	 
		<div class="col-md-12 form-group-select2">
		<?php
	 	$dtt="";
		 $dtt[""]="=== Pilih Status === ";
		 $dtt["Swasta"] = "Swasta";
		 $dtt["Negeri"] = "Negeri";
        
         $dt = $dtt;
         echo form_dropdown('f[status]', $dt, "", ' id="icon" class="form-control" style="width:100%"  ');   
		?>
		</div>
</div>
<br>

<div class="form-group" id="idvers">
		<div class="col-lg-12 form-group-select2">
		<?php
		 $dtt="";
		 $dtt[""]="=== Pilih Diversifikasi ===";
		 foreach ($this->du->getDiversifikasi() as $val) {
		 $dtt[$val->id] = $val->nama;
         }
         $dt = $dtt;
         echo form_dropdown('f[kd_diversifikasi]', $dt, "", ' id="icon" class="form-control" style="width:100%"  ');   
		?>
		</div>
</div><br>
<div class="form-group" id="idvers">
		<div class="col-lg-12 form-group-select2">
		<?php
		 $dtt="";
		 $dtt[""]="=== Pilih Akreditasi ===";
		 $dtt["A"] = "A";
		 $dtt["B"] = "B";
		 $dtt["C"] = "C";
		 $dtt["D"] = "D";
		 $dtt["Belum"] = "Belum";
         $dt = $dtt;
         echo form_dropdown('f[status_akreditasi]', $dt, "", ' id="status_akreditasi" class="form-control" style="width:100%"  ');   
		?>
		</div>
</div>

	</div> 
	<div class="col-md-6 col-lg-6 col-sm-12 col-xs-12">
		
									<div class="form-group form-float">
                                        <div class="form-line focused">
                                            <input type="text"  required class="form-control" name='f[nama_madrasah]' >
                                             <label class="form-label">Nama Madrasah</label>
                                        </div>
                                    </div><br> 
									<div class="form-group form-float">
                                        <div class="form-line focused">
                                            <input type="text"   class="form-control" name='f[kepala_nama]' >
                                             <label class="form-label">Nama Kepala Madrasah</label>
                                        </div>
                                    </div><br> 
									<div class="form-group form-float">
                                        <div class="form-line focused">
                                            <input type="text"  class="form-control" name='f[telp]' >
                                             <label class="form-label">Telephone</label>
                                        </div>
                                    </div><br>
									<div class="form-group form-float">
                                        <div class="form-line focused">
                                            <input type="text"   class="form-control" name='f[nsm]' >
                                             <label class="form-label">NSM</label>
                                        </div>
                                    </div><br> 
									<div class="form-group form-float">
                                        <div class="form-line focused">
                                            <input type="text"  class="form-control" name='f[npsn]' >
                                             <label class="form-label">NPSN</label>
                                        </div>
                                    </div><br> 
									
									    
									<br>
									<div class="form-group form-float">
                                        <div class="form-line focused">
                                            <input type="text" required class="form-control" name='f[username]' >
                                             <label class="form-label">Username</label>
                                        </div>
                                    </div>
									<br>
									<div class="form-group form-float">
                                        <div class="form-line">
                                            <input type="text" class="form-control" name='password'>
                                            <label class="form-label">Password</label>
                                        </div>
                                    </div>
									<br>
 
   </div>

<div class="clearfix"></div>
                        <div class="modal-footer">
						<span id="msg" class='pull-left'></span>
                            <div class="btn-group" role="group" aria-label="Default button group">
                                      
                                        <button type="button"   data-dismiss="modal" class="btn bg-teal  waves-effect">TUTUP</button>
                                           <button  class="btn bg-teal waves-effect"  >SIMPAN</button>
                                    </div>
                             
                        </div>
       
</form>
				</div>
				</div>
						
				</div>
         </div><!-- /.modal-dialog -->
         </div><!-- /.modal-dialog -->
  
  <!-- End Bootstrap modal -->
  
  <script>
   function deleted(id)
    {
      if(confirm('Are you sure delete this data?'))
      {
        // ajax delete data to database
          $.ajax({
            url:"<?php echo base_url();?>du/deleted_UG/"+id,
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