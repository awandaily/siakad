 <?php $token=date("His");
 if($this->m_reff->mobile())
 {
	 $css='style="margin-top:-80px"';
 }else{
	 $css='style="margin-top:-20px"';
 }
 ?>
 
 
 
                   <div class="row clearfix" <?php echo $css;?>>
                <!-- Task Info -->
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <div class="card">
                         <div class="header row">
                         <div class="col-md-10 " style="padding-bottom:15px" >     <h2 style='font-size:16px'><b>DATA BURSA KERJA</b></h2> </div>
						  <div class="col-md-2 col-xs-12"  align="center" style="margin-top:20px"> 
							   <button onclick="add()" type="button" class="btn-top pull-right btn btn-block bg-teal waves-effect">
										<i class="material-icons">create</i>
									   Tambah Data
							   </button>
									
							</div>
							 
							 
                        </div>
                        <div class="body">
                           <!----->
				 <div class="card">
                        <div class="body">
                            <div class="table-responsive">
                               <table id='table' class="tabel black table-bordered  table-hover dataTable" style="font-size:12px;width:100%">
								<thead  class='sadow bg-blue'>			
									<th class='thead' axis="string" width='15px'>&nbsp;NO</th>
									<th class='thead' >FILE </th>
									<th class='thead' >TANGGAL KADALUARSA</th>
									<th width="80px">OPSI</th>
								</thead>
							</table>
							</div>						
						</div>						
					</div>	
                           <!----->
                        </div>
                    </div>
                </div>
                <!-- #END# Task Info -->
				
 
  <script type="text/javascript">
   
$('#demo').daterangepicker({
    "singleDatePicker": true,
    "showDropdowns": true,
    "autoApply": true,
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
		 "Minggu",
            "Sen",
            "Sel",
            "Rab",
            "Kam",
            "Jum",
            "Sab",
           
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
 
}, function(start, end, label) {
  console.log('New date range selected: ' + start.format('YYYY-MM-DD') + ' to ' + end.format('YYYY-MM-DD') + ' (predefined range: ' + label + ')');
});

  	  function hapus(id,artikel){
		   alertify.confirm("<center>Hapus  ?</center>",function(){
		   $.post("<?php echo site_url("humas/hapus_bursa"); ?>",{id:id},function(){
			   reload_table();
		      })
		   })
	  };
	  
	
	  
      var save_method; //for save method string
    var table;
   // $(document).ready(function() {
      table = $('#table').DataTable({ 
	 "searching": false,
        "processing": true, //Feature control the processing indicator.
        "serverSide": true, //Feature control DataTables' server-side processing mode.
        
        // Load data for the table's content from an Ajax source
        "ajax": {
            "url": "<?php echo site_url('humas/data_bursa');?>",
            "type": "POST",
		 
        },

        //Set column definition initialisation properties.
        "columnDefs": [
        { 
          "targets": [ 0,-1,-2,-3], //last column
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
function add()
{
	$("#mdl_modal_artikel").modal( );
	$("#defaultModalLabel").html("Tambah Data");
		$("[name='aksi_edit']").val("");
		 $("[name='file']").prop('required',true);
}

function edit(id,tgl)
{
	$("#mdl_modal_artikel").modal( );
	$("#defaultModalLabel").html("Edi Data");
	$("[name='batas']").val(tgl);
	$("[name='id']").val(id);
	$("[name='aksi_edit']").val("true");
	 $("[name='file']").prop('required',false);
}

</script>
	 

	
 <div class="modal fade" id="mdl_modal_artikel" tabindex="-1" role="dialog">
                <div class="modal-dialog modal-md" role="document">
				
	<form  action="javascript:submitForm('modal_artikel')" id="modal_artikel" url="<?php echo base_url()?>humas/save_bursa"  class="form-horizontal" method="post" enctype="multipart/form-data">
                    <div class="modal-content"> <span  title="tutup"  data-dismiss="modal" class="    pull-right waves-effect"><i class="material-icons">cancel</i> </span>
                        <div class="modal-header">
                            <h4 class="modal-title col-teal" id="defaultModalLabel">Tambah Baru </h4>
							 
                        </div>
                        <div class="modal-body">
                       	   
				 
	 <input type="hidden" name="id">
	 <input type="hidden" name="aksi_edit" value="">
	<div class="col-md-12 col-lg-12 col-sm-12 col-xs-12">
								<div class="row clearfix">
                                   
                                    <div class="col-lg-12 col-md-12" style="margin-left:12px">
                                        <div class="form-group">
                                            <div class="form-line col-black"><center> Tanggal Kadaluarsa
                                                <input readonly required style="border:#A9A9A9 solid 1px" type="text" name="batas" id="demo" class="cursor  form-control " required placeholder="">
                                           </center> </div>
                                        </div>
                                    </div>
                                </div><br>
								
								<div class="row clearfix">
                                   
                                    <div class="col-lg-12 col-md-12" style="margin-left:12px">
                                        <div class="form-group">
                                            <div class="form-line col-black"><center> Cari File (Gambar/Pdf)
                                              <input type='file'   accept=".JPG,.jpg,.png,.pdf,.PDF" name="file" id="imgInp" class="form-control upload"  />
                                           </center> </div>
                                        </div>
                                    </div>
                                </div><br>
								
								 
									<div class="row clearfix">
                                   
                                    <div class="col-lg-12 col-md-12" style="margin-left:-2px">
                                        <button  class="btn bg-teal waves-effect btn-block" onclick="submitForm('modal_artikel')" ><i class="material-icons">save</i> SIMPAN</button>
                                    </div>
                                </div><br>
								
								 
								
								
		 		 
							 
								 
                                   
								 
									 
   </div>

<div class="clearfix"></div>
                      

				</div>
					  
       		
				</div>
				</form>
         </div><!-- /.modal-dialog -->
         </div><!-- /.modal-dialog -->
  
 <script>
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

   
	 
	
	  
	 
</script>


 