 
                <div class="row clearfix">
                <!-- Task Info -->
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <div class="card">
                        <div class="header">
                            <h2>DATA REFERENSI TAHUN AJARAN</h2>
                           <button onclick="add()" type="button" class="btn-top btn pull-right bg-teal waves-effect">
                                    <i class="material-icons">create</i>
                                   Tambah
                           </button>
								
                        </div>
                       
                           <!----->
				 <div class="card">
                        <div class="body">
                            <div class="table-responsive">
                               <table id='table' class="tabel black table-bordered  table-hover dataTable" style="font-size:12px;width:100%">
								<thead  class='sadow bg-blue'>			
									<th class='thead' axis="string" width='15px'>&nbsp;NO</th>
									<th class='thead' >TAHUN AJARAN </th>
									<th class='thead' >AKTIFASI </th>
									<th class='thead' >TGL  PENERIMAAN SISWA BARU </th>
									<th class='thead' >TGL    RAPOT SMS GANJIL </th>
									<th class='thead' >TGL    RAPOT SMS GENAP </th>
									<th class='thead' >TITI MANGSA SURAT KELULUSAN</th>
									<th class='thead' >NO SURAT KELULUSAN</th>
									<th class='thead' >NAMA KEPSEK </th>
									<th class='thead' >TTD KEPSEK</th>
								  
								</thead>
							</table>
							</div>						
						</div>						
					</div>	
                           <!----->
                    
                    </div>
                </div>
                <!-- #END# Task Info -->
				
 
  <script type="text/javascript">
  	  
	  
      var save_method; //for save method string
    var table;
   // $(document).ready(function() {
      table = $('#table').DataTable({ 
	 
        "processing": true, //Feature control the processing indicator.
        "serverSide": true, //Feature control DataTables' server-side processing mode.
        
        // Load data for the table's content from an Ajax source
        "ajax": {
            "url": "<?php echo site_url('pengaturan/data/tr_tahun_ajaran');?>",
            "type": "POST",
		 
        },

        //Set column definition initialisation properties.
        "columnDefs": [
        { 
          "targets": [ 0,-1,-2  ], //last column
          "orderable": false, //set not orderable
        },
        ],
	
      });
    //}); 
	function reload_table()
	{
		 table.ajax.reload();
	};
	</script>
	
	
	
	
	
<script>
function setAktif(id)
{	 alertify.confirm("<center>Ini menyebabkan akun semua guru diresset, yakin akan meresset ? </b> </center>",function(){
		  
	var url="<?php echo base_url();?>pengaturan/setTahunAktif";
			 $.post(url,{id:id},function(data){
				  sudah(id);
			  });
			  });
	  reload_table();
}
function sudah(id)
{
	 
		    $.post("<?php echo base_url()?>master/buka_akun_all/",{id:id},function(){
			  reload_table();
		      });
		   
}
function add()
{
	$("#modal_artikel").modal({backdrop: 'static',drugged:true, keyboard: false});
	$("#f_modal_artikel")[0].reset();
	$("form").attr('url',"<?php echo base_url()?>pengaturan/insert");
 
}
</script>
	 

	
 <div class="modal fade" id="modal_artikel" tabindex="-1" role="dialog">
                <div class="modal-dialog  " role="document">
				
	<form  action="javascript:saveModal('modal_artikel')" id="f_modal_artikel" url="<?php echo base_url()?>pengaturan/insert"   method="post" enctype="multipart/form-data">
                    <div class="modal-content"> <span  title="tutup"  data-dismiss="modal" class="    pull-right waves-effect"><i class="material-icons">cancel</i> </span>
                        <div class="modal-header">
                            <h4 class="modal-title col-indigo" id="defaultModalLabel">Data Referensi </h4>
							 
                        </div>
                        <div class="modal-body">
                       	  
					  
                         <input type="hidden" readonly name="id_" >
                                   
							 
								 <label class="form-label" style="margin-top:-5px">TAHUN AJARAN</label>
								<div class="form-groups form-float">
                                    <div class="form-line focused success">
									
                                        <input type="text" class="form-control" name="f[nama]"    >
                                       
                                    </div>
                                </div>	
								<br>
								 <label class="form-label" style="margin-top:-5px">TGL PENERIMAAN SISWA BARU</label>
								<div class="form-groups form-float">
								
                                    </div>
                                    <div class="form-line focused success">
                                        <input type="text" class="form-control" id="tgl_penerimaan" name="f[tgl_penerimaan]"    >
                                       
                                </div>
							 
								<br>
								 <label class="form-label" style="margin-top:-5px">TGL CETAK RAPOT SEMESTER GANJIL</label>
								<div class="form-groups form-float">
								
                                    </div>
                                    <div class="form-line focused success">
                                        <input type="text" class="form-control" id="tgl1" name="f[tgl_cetak_raport]"    >
                                       
                                </div>
									 
		                    	 <br>
								 <label class="form-label" style="margin-top:-5px">TGL CETAK RAPOT SEMESTER GENAP</label>
								<div class="form-groups form-float">
								
                                    </div>
                                    <div class="form-line focused success">
                                        <input type="text" class="form-control" id="tgl2" name="f[tgl_cetak_raport_gnp]"    >
                                       
                                </div> <br>
                                 <label class="form-label" style="margin-top:-5px">NO SURAT KELULUSAN</label>
								<div class="form-groups form-float">
								
                                    </div>
                                    <div class="form-line focused success">
                                        <input type="text" class="form-control" id="no_surat_un" name="f[no_surat_un]"    >
                                       
                                </div> <br>
                                 <label class="form-label" style="margin-top:-5px">TITI MANGSA SURAT KELULUSAN</label>
								<div class="form-groups form-float">
								
                                    </div>
                                    <div class="form-line focused success">
                                        <input type="text" class="form-control" id="tgl_cetak_un" name="f[tgl_cetak_un]"    >
                                       
                                </div> <br>
                                
                                
                                
                                
								 <label class="form-label" style="margin-top:-5px">NAMA KEPALA SEKOLAH</label>
								<div class="form-groups form-float">
								
                                    </div>
                                    <div class="form-line focused success">
                                        <input type="text" class="form-control" id="nama_kepsek" name="f[nama_kepsek]"    >
                                       
                                </div>  
                               <br>
								 <label class="form-label" style="margin-top:-5px">TTD KEPSEK</label>
								<div class="form-groups form-float">
								
                                    </div>
                                    <div class="form-line focused success">
                                        <input type="file" class="form-control" id="ttd" name="ttd_kepsek"    >
                                       
                                </div>
									 
			   </div>
					 
 
                       <div class="modal-footer">
						<span id="msg" class='pull-left'></span>
                            <div class="btn-group" role="group" aria-label="Default button group">
                                      
                                        <button  title="tutup"  data-dismiss="modal" class="btn bg-teal  waves-effect"><i class="material-icons">cancel</i> </button>
                                         <button  id="submit" class="btn bg-teal waves-effect" onclick="saveModal('modal_artikel')" ><i class="material-icons">save</i> SIMPAN</button>
                                    </div>
                             
                        </div>

				</div>
				</div>
					 
       		
				</div>
				</form>
         </div><!-- /.modal-dialog -->
       
  
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

  $("#set_artikel").hide();
 function publikasi()
 {
	 var p=$("[name='f[sts]']").val();
 if(p=="1"){ $("#set_artikel").show(); }else{ $("#set_artikel").hide(); }
 }
 </script>
 
<script>
 function readURL(input) {

  if (input.files && input.files[0]) {
    var reader = new FileReader();

    reader.onload = function(e) {
      $('#blah').attr('src', e.target.result);
     }

    reader.readAsDataURL(input.files[0]);
  }
}

$("#imgInp").change(function() {
  readURL(this);
});

 function edit(id,nama,tgl1,tgl2,kepsek,tgl_cetak_un,no_surat_un,tgl_penerimaan)
	 {	 
		 				 $("#tgl_penerimaan").val(tgl_penerimaan);
			 	$("#tgl1").val(tgl1);
			 	$("#tgl2").val(tgl2);
			 	$("#nama_kepsek").val(kepsek);
			 	$("[name='id']").val(id);
			 	$("[name='id_']").val(id);
			 	$("[name='f[nama]']").val(nama);
			 	$("[name='f[no_surat_un]']").val(no_surat_un);
			 	$("[name='f[tgl_cetak_un]']").val(tgl_cetak_un);
				$("#modal_artikel").modal({backdrop: 'static',drugged:true, keyboard: false});
				$("form").attr('url',"<?php echo base_url()?>pengaturan/update_thn/tr_tahun_ajaran");
	 }
	 
   
	
</script>







 