  
 <div class="row clearfix">
             
				  <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <div class="card">
                        
                        <div class="body" id="ngeblok">
						
					
							
                        </div>
                        </div>
                        </div>
                        </div>
				
				 
 </div>
  <script type="text/javascript">
  	function batalkan(){
			 
		    alertify.confirm("<center> Batalkan ? </center>",function(){
		  
			loading();
			$.ajax({
			url:"<?php echo base_url();?>pd/batalkan",
			type: "POST",
			success: function(data)
					{	  
						load();
						unblock();
					} 
					 
			});
		   
		   })
	  };
	</script>	
 <script>
 load();
// var refreshIntervalId = setInterval(function(){  load(); }, 10000);

 function load()
 {
	 $.post("<?php echo site_url("pd/load"); ?>",{},function(data){
			     $("#ngeblok").html(data);
		      }) 
 }
 </script>
 
 <script>
 function unblok(id_guru,id_kelas,id_jadwal,id_jam,jam_blok)
 {
	  loading();
	  $.post("<?php echo site_url("pd/unblok"); ?>",{jam_blok:jam_blok,id_guru:id_guru,id_kelas:id_kelas,id_jadwal:id_jadwal,id_jam:id_jam},function(data){
			       $.unblockUI();
				    load();
		      })
 };

 function absenkan(id_guru,id_kelas,id_jadwal,id_jam,jam_blok,mapel)
 {
	  loading();
	  $.post("<?php echo site_url("pd/absenkan"); ?>",{mapel:mapel,jam_blok:jam_blok,id_guru:id_guru,id_kelas:id_kelas,id_jadwal:id_jadwal,id_jam:id_jam},function(data){
			       $.unblockUI();
				    load();
		      })
 };

 function blok(id_guru,id_kelas,id_jadwal,id_jam,jam_blok)
 {
	  loading();
	  $.post("<?php echo site_url("pd/blok"); ?>",{jam_blok:jam_blok,id_guru:id_guru,id_kelas:id_kelas,id_jadwal:id_jadwal,id_jam:id_jam},function(data){
			       $.unblockUI();
				    load();
		      })
 };
 
 
 
 </script>
 
  