<button class="btn-warning pull-right" onclick="exportData()">  <i class="fa fa-upload"></i> Export</button>

<div class="row">
    <div class="col-lg-12"> 

</div>
</div>
 



	 
<div id="listing"></div>
 <?php echo $this->load->view("js/tabel.phtml");?>
 <script>
 getListing();
 function getListing()
	{	
	$("#listing").html("<img src='<?php echo base_url();?>plug/img/load.gif'> Please wait...");
		$.ajax({
		url:"<?php echo base_url();?>data_master/getDriver",
		type: "POST",
		data: $('#form').serialize(),
		success: function(data)
				{	
				$("#listing").html(data);
				},
		});	
	}

 </script>
 
 <!-- Bootstrap modal -->
  <div class="modal fade" id="modalDetail" role="dialog">
  <div class="modal-dialog modal-lg">
<div class="modal-content" >
      <div class="modal-body form">
<section class="content">
  <div class="row">
    <div class="col-lg-12 dataDetail">
		<!------------------------->
		<!------------------------->
    </div>
  </div>   <!-- /.row -->
</section><!-- /.content -->
  </div>
   </div><!-- /.modal-content -->
      </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
  <!-- End Bootstrap modal -->
  



 <script>
  function saveAdd()
	{	
	if(method=="edit")
	{
		var url="<?php echo base_url();?>data_property/update";
	}else{
		var url="<?php echo base_url();?>data_property/insert";
	}
		$(".load").html("<img src='<?php echo base_url();?>plug/img/load.gif'> Please wait...");
		$.ajax({
		url:url,
		type: "POST",
		data: $('#formAgen').serialize(),
	//	dataType: "JSON",
		success: function(data)
				{
				if(data==false){ alert("Gagal! Agen sudah ada pada database"); $(".load").html(""); $("[name='group']").focus(); return false;}
				$(".load").html('<font color="green"><i class="fa fa-check-circle fa-fw fa-lg"></i> Berhasil di simpan</font>');
				table.ajax.reload(null,false);
				$("#formAgen")[0].reset();
				//$(".load").html("");
				if(method=="edit")
				{
					$("#modalAdd").modal("hide");
					$(".load").html('');
				}
				},
				
		});
	}
	
	 function hapus(id)
	  {
	    var tanya=window.confirm("Delete ?");
		if(tanya==false){ return false;};
	  	$.ajax({
		url:"<?php echo base_url();?>data_property/hapus/"+id,
		type: "POST",
		data:"id="+id,
		success: function(data)
				{
				table.ajax.reload(null,false); //reload datatable ajax 
				},
			});
	  }

</script>	



<script>
function exportData()
{
	window.location.href="<?php echo base_url()?>data_property/export_selling";
}

</script>






 <!-- Bootstrap modal -->
  <div class="modal fade" id="modalImport" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
     
      <div class="modal-body form">
<section class="content">
  <div class="row">
    <div class="col-lg-12">
	<div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title black"><i class="fa fa-download"></i> Import Data  <span class='namaGroup'></span></h4>
      </div>
      <!-- general form elements -->
      <div class="box box-primary black">	   <br>
        Silahkan <a href='<?php echo base_url();?>data_property/downloadFormat'><i class="fa fa-file-excel-o"></i> download format</a> sebelum upload.
          <div class="box-body">                      
            <form role="form" name="uploadfilexl" id="uploadfilexl" action="javascript:void();" method="post" enctype="multipart/form-data">
                <div class="form-group">
                  <input id="userfile"  name="userfile" type="file" class="form-control">
                  <input  name="idGroup" type="hidden">
                </div>				
                <button type="submit" onclick="javascript:simpanfile();" class="btn btn-primary pull-right">
                    <span class="fa fa-upload"></span>&nbsp;Upload
                </button>
                <div class="form-group">
                    <div class="msg"></div>
                    <div class="hasil"></div>
                </div>
            </form>
          </div><!-- /.box-body -->
      </div><!-- /.box -->
    </div>
  </div>   <!-- /.row -->
</section><!-- /.content -->
          </div>
        </div><!-- /.modal-content -->
      </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
  <!-- End Bootstrap modal -->
  
   <?php echo $this->load->view("js/form.phtml"); ?>
  <script type="text/javascript">
function simpanfile(){
    var userfile=$('#userfile').val();
    $('#uploadfilexl').ajaxForm({
     url:'<?php echo base_url();?>data_property/importData/',
     type: 'post',
     data:{"userfile":userfile},
     beforeSend: function() {
        var percentVal = 'Mengupload 0%';
        $('.msg').html(percentVal);
     },
     uploadProgress: function(event, position, total, percentComplete) {
        var percentVal = 'Mengupload ' + percentComplete + '%';
        $('.msg').html(percentVal);
     },
     beforeSubmit: function() {
      $('.hasil').html("<img src='<?php echo base_url();?>plug/img/load.gif'> Silahkan Tunggu ... ");
     },
     complete: function(xhr) {
        $('.msg').html('');
     }, 
     success: function(resp) {
        $('.hasil').html(resp);
		table.ajax.reload(null,false);
		$("#uploadfilexl")[0].reset();
     },
    });     
};
</script>   



<script src="<?php echo base_url() ?>plug/boostrap/js/select2.min.js"></script>
 <script>
                                   
                                      //nice select boxes
                                      $('#sertifikat').select2();
                                      $('#provinsi').select2();
                                      $('#kabupaten').select2();
                                      $('#hadap').select2();
                                      //$('#sewa').select2();
                                      $('#agen').select2();
                                      $('#owner').select2();
                                      $('#sel2').select2();
    </script>
 <script>
        $("#provinsi").change(function () {
            var prov = $("#provinsi").val();
            $.ajax({
                type: "POST",
                dataType: "html",
                url: "<?php echo base_url() ?>data_property/ajaxGetKab2",
                data: "prov=" + prov,
                success: function (data) {
                    $(".dataKab").html(data);
                }
            });

        });

	function loadkab(){
            var prov = "32";
            $.ajax({
                type: "POST",
                dataType: "html",
                url: "<?php echo base_url() ?>data_property/ajaxGetKab",
                data: "def=3273&prov=" + prov,
                success: function (data) {
                    $(".dataKab").html(data);
                }
            });

        };
    </script>
	 <script>
        $('input.typeahead').typeahead({
            source: function (query, process) {
                var kab = $("#kabupaten").val();
                return $.get('<?php echo base_url() ?>data_property/getKomplek/' + kab, {query: query}, function (data) {
                    console.log(data);
                    data = $.parseJSON(data);
                    return process(data);
                });
            }
        });
    </script>
	
	<script>

	var f=jQuery.noConflict();
function detail(id)
{
			f("#modalDetail").modal("show");
	  f('.dataDetail').html("<img src='<?php echo base_url();?>plug/img/load.gif'> Mohon Tunggu ... ");
	            f.ajax({
                type: "POST",
                dataType: "html",
                url: "<?php echo base_url() ?>data_property/getDataDetail",
                data: "id=" + id,
                success: function (data) {
			
                    f(".dataDetail").html(data);
                }
            });
	
}
function importData()
{
	 f('.msg').html('');
	  f('.hasil').html('');
	f("#modalImport").modal("show");
}
function goSewa(id)
{
	f("#modalSewa").modal("show");
	  f('#kontenSewa').html("<img src='<?php echo base_url();?>plug/img/load.gif'> Mohon Tunggu ... ");
	            f.ajax({
                type: "POST",
                dataType: "html",
                url: "<?php echo base_url() ?>data_property/getFormSewa/"+id,
                success: function (data) {
		              f("#kontenSewa").html(data);
                }
            });
}
function goJual(id)
{
	f("#modalJual").modal("show");
	  f('#kontenJual').html("<img src='<?php echo base_url();?>plug/img/load.gif'> Mohon Tunggu ... ");
	            f.ajax({
                type: "POST",
                dataType: "html",
                url: "<?php echo base_url() ?>data_property/getFormJual/"+id,
                success: function (data) {
		              f("#kontenJual").html(data);
		              }
            });
}
	</script>
	
  
  
  
  
	
 <!-- Bootstrap modal -->
  <div class="modal fade" id="modalJual" role="dialog">
  <div class="modal-dialog">
 
<div class="modal-content">
     
      <div class="modal-body form">
   
<section class="content">
  <div class="row">
    <div class="col-lg-12">
	
	<div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title black"><i class="fa fa-plus-circle"></i><span class='title'> Sales Form</span></h4>
      </div>
	<br>
<div id="kontenJual">
</div>


    </div>
  </div>   <!-- /.row -->

</section><!-- /.content -->
  </div>
   </div><!-- /.modal-content -->
		

      </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
  <!-- End Bootstrap modal -->
  


	
	
	
	
 <!-- Bootstrap modal -->
  <div class="modal fade" id="modalSewa" role="dialog">
  <div class="modal-dialog">
 
<div class="modal-content">
     
      <div class="modal-body form">
   
<section class="content">
  <div class="row">
    <div class="col-lg-12">
	
	<div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title black"><i class="fa fa-plus-circle"></i><span class='title'> Transaction Form</span></h4>
      </div>
	<br>
<div id="kontenSewa">
</div>


    </div>
  </div>   <!-- /.row -->

</section><!-- /.content -->
  </div>
   </div><!-- /.modal-content -->
		

      </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
  <!-- End Bootstrap modal -->
  
  
  
  <script>
  
	var f=jQuery.noConflict();
	
  function editselling(id)
{  
	f("#modalSewa").modal("show");
	  f('#kontenSewa').html("<img src='<?php echo base_url();?>plug/img/load.gif'> Mohon Tunggu ... ");
	            f.ajax({
                type: "POST",
                dataType: "html",
                url: "<?php echo base_url() ?>data_property/getListingEditSewa/"+id,
                success: function (data) {
		              f("#kontenSewa").html(data);
                }
            });
}
function editJulling(id)
{
	f("#modalJual").modal("show");
	  f('#kontenJual').html("<img src='<?php echo base_url();?>plug/img/load.gif'> Mohon Tunggu ... ");
	            f.ajax({
                type: "POST",
                dataType: "html",
                url: "<?php echo base_url() ?>data_property/getListingEditJual/"+id,
                success: function (data) {
		              f("#kontenJual").html(data);
		              }
            });
}

 function closemodal(data)
{
	f("#"+data).modal("hide");
}
	</script>
	
  
  
  
  
	
 <!-- Bootstrap modal -->
  <div class="modal fade" id="modalJual" role="dialog">
  <div class="modal-dialog">
 
<div class="modal-content">
     
      <div class="modal-body form">
   
<section class="content">
  <div class="row">
    <div class="col-lg-12">
	
	<div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title black"><i class="fa fa-plus-circle"></i><span class='title'> Sales Form</span></h4>
      </div>
	<br>
<div id="kontenJual">
</div>


    </div>
  </div>   <!-- /.row -->

</section><!-- /.content -->
  </div>
   </div><!-- /.modal-content -->
		

      </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
  <!-- End Bootstrap modal -->
  


	
	
	
	
 <!-- Bootstrap modal  
  <div class="modal fade" id="modalSewa" role="dialog">
  <div class="modal-dialog">
 
<div class="modal-content">
     
      <div class="modal-body form">
   
<section class="content">
  <div class="row">
    <div class="col-lg-12">
	
	<div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title black"><i class="fa fa-plus-circle"></i><span class='title'> Transaksi Sewa</span></h4>
      </div>
	<br>
<div id="kontenSewa">
</div>


    </div>
  </div>   <!-- /.row  
</section><!-- /.content - 
  </div>
   </div><!-- /.modal-content  
		

      </div><!-- /.modal-dialog  
    </div><!-- /.modal -->
  <!-- End Bootstrap modal -->
  
  
  
  
  
 <div class="modal fade" id="modalDetailVendor" role="dialog" >
  <div class="modal-dialog modal-lg">

<div class="modal-content" >
<div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title black"><i class="fa fa-info-circle"></i> Information Detail</h4>
      </div>
	  <!----------------------------------------------->
	 <div id="kontenDetailVendor"></div>
	  <!----------------------------------------------->
</div>	  
</div>	  
</div>	    

 <div class="modal fade" id="modalDetailBuyer" role="dialog" >
  <div class="modal-dialog modal-lg">

<div class="modal-content" >
<div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title black"><i class="fa fa-info-circle"></i> Information Detail</h4>
      </div>
	  <!----------------------------------------------->
	 <div id="kontenDetailBuyer"></div>
	  <!----------------------------------------------->
</div>	  
</div>	  
</div>	  

  <script>
//var f=jQuery.noConflict();
	 function detailVendor(id)
	  {
	//	getAkun();
		  f("#modalDetailVendor").modal("show");
			 	f.ajax({
				url:"<?php echo base_url();?>data_owner/getDetail/"+id,
				success: function(data)
						{			
						f("#kontenDetailVendor").html(data);
				},
			});
		 
		
	  }
</script> 

<script>
	 function detailBuyer(id)
	  {
		  f("#modalDetailBuyer").modal("show");
			 	f.ajax({
					url:"<?php echo base_url();?>costumer/getDetail/"+id,
				success: function(data)
						{			
						f("#kontenDetailBuyer").html(data);
				},
			});
		 
		
	  }
</script>

