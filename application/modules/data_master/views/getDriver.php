 <div class="main-box clearfix" >
			<div class="main-box-body clearfix ">
			<div class="table-responsive">
			<span style='position:absolute;margin-top:48px;z-index:222' class="cursor btnhapus">
			<a href="#" onclick="hapusAll()"><i class='fa fa-trash'></i> Delete</a>
			</span>
			<form action="#" name="delcheck" id="delcheck" class="form-horizontal" method="post">
			<table id='table' class="tabel black table-striped table-bordered table-hover dataTable" width="100%">
						<thead style="font-size:13px">			
							<th class='thead' axis="date" width='5px'><input type="checkbox" id="checkbox-1" class="pilihsemua" value="ya" /></th>
						<th class="color-blue-dark b">NO</th>
						<th class="color-blue-dark b">POTO</th>
						<th class="color-blue-dark b">NAMA</th>
						<th class="color-blue-dark b">HP</th>
						<th class="color-blue-dark b">WA</th>
						<th class="color-blue-dark b">DRIVER AREA</th>
						<th class="color-blue-dark b">STS DRIVER</th>
						<th class="color-blue-dark b">TGL AKTIFITAS</th>
						<th class="color-blue-dark b">OMZET</th>
						<th class="color-blue-dark b">AKTIFASI</th>
						<th style='min-width:130px'>&nbsp;</th>
						</thead>
			</table></form>
		</div>
	   </div>
     </div>
	   <script src="<?php echo base_url()?>plug/js/jquery-2.2.1.min.js"></script>
	  <link href="<?php echo base_url();?>/plug/datatables/css/dataTables.bootstrap.css" rel="stylesheet">

  <script src="<?php echo base_url()?>plug/datatables/js/jquery.dataTables.min.js"></script>
  <script src="<?php echo base_url()?>plug/datatables/js/dataTables.bootstrap.js"></script>			
 
  <script>
  function hapusAll()
	{	
		var con=window.confirm("Delete selected ?");
		if(con==false){ return false; };
		$.ajax({
		url:"<?php echo base_url();?>data_property/HapusAllSelling",
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
            "url": "<?php echo site_url('data_master/ajax_driver/'.$filter.'')?>",
            "type": "POST",
        },
		
        //Set column definition initialisation properties.
        "columnDefs": [
        { 
		    "targets": [ 0,1,2,3,4,5,6,7,8,9,10], //last column
          "orderable": false, //set not orderable
        },
        ],

      });

	  function hapusSelling(id)
	  {
	    var tanya=window.confirm("Delete ?");
		if(tanya==false){ return false;};
	  	$.ajax({
		url:"<?php echo base_url();?>data_property/hapusSelling/"+id,
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
	  function editSelling(data)
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
  
  