

<?php 
$level=$this->session->userdata("level");
?>
 <a href="<?php echo base_url()?>data_property/export/<?php echo $filter;?>" class="sadow05 pull-right" style="margin-top:20px;color:black" >  <i class="fa fa-upload"></i> Export Data Property</a>
 <div class="clearfix"></div>
 <div class="main-box clearfix" >
			<div class="main-box-body clearfix ">
			<div class="table-responsive">
 
			<span style='position:absolute;margin-top:48px;z-index:222' class="cursor btnhapus">
			<a href="#" onclick="hapusAll()"><i class='fa fa-trash'></i> Hapus Terpilih</a>
			</span>
			
			<form action="#" name="delcheck" id="delcheck" class="form-horizontal" method="post">
	<?php		if($level=="dm") {?>
	
	 	<table id='table' class="tabel black table-striped table-bordered table-hover dataTable" width="100%">
						<thead style="font-size:13px">			
							<th class='thead' axis="date" width='5px'><input type="checkbox" id="checkbox-1" class="pilihsemua" value="ya" /></th>
						<!--	<th class='thead' axis="string" width='15px'>No</th> -->
							<th class='thead' axis="date" width='20px'>ID LISTING</th>
							<th class='thead' >TYPE</th>
						 
							<th class='thead' axis="string" >PRICE</th>
							<th class='thead' axis="string" >LOCATION </th>
							<th class='thead' axis="string" >DISTRIC </th>				
						 
							<th class='thead' axis="string" width='110px'>MEMBER</th>
							<th class='thead' axis="string" width='50px'>IMAGES</th>
							<th class='thead' axis="string" width='50px'>STATUS</th>
	 
							<th width='90px'>&nbsp;</th>
						</thead>
			</table>
	<?php }else{?>
	<table id='table' class="tabel black table-striped table-bordered table-hover dataTable" width="100%">
						<thead style="font-size:13px">			
							<th class='thead' axis="date" width='5px'><input type="checkbox" id="checkbox-1" class="pilihsemua" value="ya" /></th>
						<!--	<th class='thead' axis="string" width='15px'>No</th> -->
							<th class='thead' axis="date" width='20px'>ID LISTING</th>
							<th class='thead' >TYPE</th>
						 
							<th class='thead' axis="string" >PRICE</th>
							<th class='thead' axis="string" >LOCATION </th>
							<th class='thead' axis="string" >DISTRIC </th>				
							<th class='thead' axis="string" width='50px' id="owner">VENDOR</th>
							<th class='thead' axis="string" width='110px'>MEMBER</th>
							<th class='thead' axis="string" width='50px'>IMAGES</th>
							<th class='thead' axis="string" width='50px'>STATUS</th>
	 
							<th width='90px'>&nbsp;</th>
						</thead>
			</table>

	<?php } ?> 
			
			
			
			
		
			</form>
		</div>
	   </div>
     </div>
	 
	 <?php echo $this->load->view("js/tabel.phtml");?>
	 
  <script>
  
  function hapusAll()
	{	
		var con=window.confirm("hapus data terpilih ?");
		if(con==false){ return false; };
		$.ajax({
		url:"<?php echo base_url();?>data_property/HapusAll",
		type: "POST",
		data: $('#delcheck').serialize(),
	//	dataType: "JSON",
		success: function(data)
				{	 $(".btnhapus").hide();
					$(".pilihsemua").removeAttr("checked");
					$(".pilihsemua").val("ya");
					table.ajax.reload(null,false); //reload datatable ajax 
				},
				error: function (jqXHR, textStatus, errorThrown)
				{
					alert('Try Again!');
				}
		});
	
	
	}
  
  
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
  
  
  
		var table;
		table = $('#table').DataTable({ 
        "processing": true, //Feature control the processing indicator.
        "serverSide": true, //Feature control DataTables' server-side processing mode.
        
        // Load data for the table's content from an Ajax source
        "ajax": {
            "url": "<?php echo site_url('data_property/ajax_property/'.$filter.'')?>",
            "type": "POST",
        },
		
        //Set column definition initialisation properties.
        "columnDefs": [
        { 
		    "targets": [ 0,1,2,3,4,5,6,7,8,9], //last column
          "orderable": false, //set not orderable
        },
        ],

      });

	  function hapus(id)
	  {
	    var tanya=window.confirm("Hapus ?");
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
	  var method;
	  function add()
	  {
				method="add";
				$("#modalAdd").modal("show");
				$(".title").html(" Tambah Data Agen");
	  }
	  function edit(data)
	  {
		  method="edit";
		  var isi=data.split("::");
		  $("#modalAdd").modal("show");
		  $(".title").html(" Edit Data Agen");
		  $("[name='nama']").val(isi[2]);
		  $("[name='hp']").val(isi[3]);
		  $("[name='email']").val(isi[4]);
		  $("[name='alamat']").val(isi[5]);
		  $("[name='id_agen']").val(isi[0]);
		 
	  }
	  
  </script>
  
  