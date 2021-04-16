 <?php $cek=$this->mdl->cektahap(3);
 if(!$cek){
 echo "<div class='card'><center><h4> <br>TAHAP 3 BELUM SELESAI !! </h4> Mohon untuk menyelesaikan tahap 3 terlebih dahulu.</center></div>";
 return false;
 }
  
  $cek=$this->mdl->cektahap(4);
 if(!$cek){ ?>
 <center style="margin-top:-20px">
 <a href="javascript:selesai('<?php echo base_url()?>guru_instal/beres/4')"   type="button" class="btn bg-green waves-effect sadow"> <b>JIKA TAHAPAN INI SUDAH SELESAI MOHON KLIK DISINI </b></a>
   </center>  
	<br>
 <?php  } ?>    
<script>
 function selesai(url){
		   alertify.confirm("<center> Yakin tahap ini sudah selesai ? <br> Setelah ini anda tidak dapat merubah kembali ditahap ini. </center>",function(){
		   $.post(url,function(){
			  window.location.href="<?php echo base_url()?>guru_instal/tahap5";
		      })
		   })
	  };
	   
 </script>          


<div class="card">
                        <div class="body bg-green">
                  <b>        
					INFORMASI<br>
					 <table>
					 <tr>
					 <td>Total Kelas mengajar </td><td width='50px'>:</td><td><?php echo $this->mdl->jmlKelasAjar()?></td>
					 </tr> <tr>
					 <td>Total Jam Mengajar </td><td width='50px'>:</td><td><?php echo $this->mdl->jmlJamMengajar()?> Jam / Minggu</td>
					 </tr>
					 </table>
</b>
						  </div>
                    </div>



   
								
                <div class="row clearfix">
                <!-- Task Info -->
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <div class="card">
                        <div class="header">
                            <h2>LANGKAH 4 :: Penjadwalan</h2>
							  <?php  
  
  $cek=$this->mdl->cektahap(4);
 if($cek){ ?>
                           <div style="margin-top:-5px" class="col-md-4 col-xs-12 pull-right"  >
							   <button onclick="copy()" type="button" class="btn-top btn btn-block pull-right bg-pink sadows waves-effect sadow">
										<i class="material-icons">autorenew</i>
									   Copy dari semester sebelumnya
							   </button>
									
							</div> 
 <?php } ?>
                        </div>
                       <script>
 function copy(){
	 var url="<?php echo base_url()?>guru_instal/copas_tahap4";
		   alertify.confirm("<center>Anda akan  mengcopy penjadwalan semester sebelumnya ke semester saat ini ? </center>",function(){
		   $.post(url,function(data){
			   if(data=="false")
			   {
				   notif("Data untuk semester sekarang telah diisi... Anda tidak dapat mengkopinya");
				   return false;
			   }
				reload_table();
		      })
		   })
	  };
	   
 </script> 
                           <!----->
				 <div class="card">
                        <div class="body">
                            <div class="table-responsive">
                               <table id='table' class="tabel black table-bordered  table-hover dataTable" style="font-size:12px;width:100%">
								<thead  class='sadow bg-teal'>			
									<th class='thead' axis="string" width='15px'>&nbsp;NO</th>
									<th class='thead' >KELAS</th>
									<th class='thead' >MATA PELAJARAN</th>
									<th class='thead' >JML JAM / MINGGU</th>
									 
								 	<th class='thead'  > JADWAL</th>
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
  	  function hapus(id,akun){
		   alertify.confirm("<center>Hapus  <br> <span class='font-bold col-pink'>`"+akun+"`</span> <br> ?</center>",function(){
		   $.post("<?php echo site_url("guru_instal/hapus_kelas"); ?>",{id:id},function(){
			   reload_table();
		      })
		   })
	  };
	  
	
	  
      var save_method; //for save method string
    var table;
   // $(document).ready(function() {
      table = $('#table').DataTable({ 
		"paging":   false,
        "ordering": false,
        "info":     false,
        "search":     false,
		"bFilter": false,
        "processing": true, //Feature control the processing indicator.
        "serverSide": true, //Feature control DataTables' server-side processing mode.
        
        // Load data for the table's content from an Ajax source
        "ajax": {
            "url": "<?php echo site_url('guru_instal/penjadwalan');?>",
            "type": "POST",
		 
        },

        //Set column definition initialisation properties.
        "columnDefs": [
        { 
          "targets": [ 0,-1,-2,-3 ], //last column
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
function jadwal(id,title)
{    $("#jadual").html("Loading....");
	$("#mdl_modal_artikel").modal( );
	$("#modal_artikel")[0].reset();
	$(".titles").html(title);
	 $.post("<?php echo site_url("guru_instal/getJadual"); ?>" ,{id:id},function(data){
			  $("#jadual").html(data);
	 }); 
}
</script>
	 

	
 <div class="modal fade" id="mdl_modal_artikel" tabindex="-1" role="dialog">
                <div class="modal-dialog modal-lg" id="area_modal_artikel" role="document">
				
	<form  action="javascript:submitForm('modal_artikel')" id="modal_artikel" url="<?php echo base_url()?>guru_instal/insert_kelas"   method="post" enctype="multipart/form-data">
                    <div class="modal-content"> <span  title="tutup"  data-dismiss="modal" class="    pull-right waves-effect"><i class="material-icons">cancel</i> </span>
                        <div class="modal-header">
                            <h4 class="modal-title col-teal" id="defaultModalLabel">Tentukan Penjadwalan Mapel <span class="titles"></span> </h4>
							 
                        </div>
                        <div class="modal-body">
                       	  
					   	 <div id="jadual"></div>
									
							 
 
                      

				</div>
				</div>
					 
       		
				</div>
				</form>
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

 function edit(id,nama)
	 {	 
		 			
			 	$("[name='id']").val(id);
			 	$("[name='id_']").val(id);
			 	$("[name='f[nama]']").val(nama);
				$("#modal_artikel").modal({backdrop: 'static',drugged:true, keyboard: false});
				$("form").attr('url',"<?php echo base_url()?>guru_instal/update/tr_kategory");
	 }
	 
    //CKEditor
   
</script>







 
	
 
						
						
						
						
						
						
						
 