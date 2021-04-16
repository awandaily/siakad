  
                <div class="row clearfix">
                <!-- Task Info -->
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <div class="card">
                        <div class="header">
                            <h2>DATA REFERENSI SEMESTER</h2>
                           
								
                        </div>
                       
                           <!----->
				 <div class="card">
                        <div class="body">
                            <div class="table-responsive">
                               <table id='table' class="tabel black table-bordered  table-hover dataTable" style="font-size:12px;width:100%">
								<thead  class='sadow bg-blue'>			
									<th class='thead' axis="string" width='15px'>&nbsp;NO</th>
									<th class='thead' >SEMESTER </th>
									<th class='thead' >AKTIFASI </th>
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
            "url": "<?php echo site_url('pengaturan/data/tr_semester');?>",
            "type": "POST",
		 
        },

        //Set column definition initialisation properties.
        "columnDefs": [
        { 
          "targets": [ 0,-1,-2], //last column
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
{
	alertify.confirm("<center>Jika pergantian tahun ajaran pastikan anda sudah memilih tahun ajaran sebelum memilih semester dan ini menyebabkan akun semua guru diresset, yakin akan meresset ? </b> </center>",function(){
	var url="<?php echo base_url();?>pengaturan/setSmsAktif";
			 $.post(url,{id:id},function(data){
			//	  sudah(id);
				  reload_table();
			  });
	  });

}
function sudah(id)
{
	 
		    $.post("<?php echo base_url()?>master/buka_akun_all/",{id:id},function(){
			  reload_table();
		      });
		   
}
 
</script>
	 

	 