 

             <div class="row clearfix">
                <!-- Task Info -->
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <div >
                        <div class="header">
                            <h4>PENGATURAN JAM MASUK DAN KELUAR</h4> 
                            <div class="hide pull-right">
                                <input type="text" id="durasi"><button class="btn bg-teal" onclick="generate_jam()">GENERATE</button>
                            </div>
                            
                        </div>
                        <div class="body">
                            <div class="col-md-12 card">
                              <B>JADWAL HARI SENIN</B>
                           <!----->
			 <?php
			 $data_jam="";
			 $this->db->order_by("id","asc");
			 $this->db->where("sts","1");
			 $data=$this->db->get("tr_jam_ajar")->result();
			 $no=1;
			 foreach($data as $data)
			 {  $id=$data->id;
			     $data_jam.="<tr>
			     <td><input id='jam".$id."'  type='text' value='".$data->urut."' size='5' onchange='save_jam(`jam".$id."`,`urut`,`$id`)'></td>
			     <td><input id='mulai".$id."'  type='text' value='".$data->jam_mulai."' size='5' onchange='save_jam(`mulai".$id."`,`jam_mulai`,`$id`)'></td>
			     <td><input id='akhir".$id."'  type='text' value='".$data->jam_akhir."' size='5' onchange='save_jam(`akhir".$id."`,`jam_akhir`,`$id`)'></td>
			     <td><input id='kegiatan".$id."'  type='text' value='".$data->kegiatan."' size='45' onchange='save_jam(`kegiatan".$id."`,`kegiatan`,`$id`)'></td>
			     </tr>";
			 }
			 ?>
			 <table class="entry">
			     <tr>
			         <td>JAM KE</td>
			          <td>WAKTU MULAI</td>
			           <td>WAKTU AKHIR</td>
			            <td>KEGIATAN</td>
			              
			     </tr>
			     <?php echo $data_jam;?>
			 </table><br>
			 </div>
                           <!----->
                           
                           
                           
              <div class="col-md-12 card">
                           <!----->
                        <b> JADWAL  HARI SELASA s.d KAMI</b>
			 <?php
			 $data_jam="";
			 $this->db->order_by("id","asc");
			 $this->db->where("sts","0");
			 $data=$this->db->get("tr_jam_ajar")->result();
			 $no=1;
			 foreach($data as $data)
			 {  $id=$data->id;
			     $data_jam.="<tr>
			     <td><input id='jam".$id."'  type='text' value='".$data->urut."' size='5' onchange='save_jam(`jam".$id."`,`urut`,`$id`)'></td>
			     <td><input id='mulai".$id."'  type='text' value='".$data->jam_mulai."' size='5' onchange='save_jam(`mulai".$id."`,`jam_mulai`,`$id`)'></td>
			     <td><input id='akhir".$id."'  type='text' value='".$data->jam_akhir."' size='5' onchange='save_jam(`akhir".$id."`,`jam_akhir`,`$id`)'></td>
			     <td><input id='kegiatan".$id."'  type='text' value='".$data->kegiatan."' size='45' onchange='save_jam(`kegiatan".$id."`,`kegiatan`,`$id`)'></td>
			     </tr>";
			 }
			 ?>
			 <table class="entry">
			     <tr>
			         <td>JAM KE</td>
			          <td>WAKTU MULAI</td>
			           <td>WAKTU AKHIR</td>
			            <td>KEGIATAN</td>
			              
			     </tr>
			     <?php echo $data_jam;?>
			 </table>
			 <br>
			 </div>              
             
                      <div class="col-md-12 card">
                               <b>JADWAL HARI JUM'AT </b>
                           <!----->
			 <?php
			 $data_jam="";
			 $this->db->order_by("id","asc");
			 $this->db->where("sts","2");
			 $data=$this->db->get("tr_jam_ajar")->result();
			 $no=1;
			 foreach($data as $data)
			 {  $id=$data->id;
			     $data_jam.="<tr>
			     <td><input id='jam".$id."'  type='text' value='".$data->urut."' size='5' onchange='save_jam(`jam".$id."`,`urut`,`$id`)'></td>
			     <td><input id='mulai".$id."'  type='text' value='".$data->jam_mulai."' size='5' onchange='save_jam(`mulai".$id."`,`jam_mulai`,`$id`)'></td>
			     <td><input id='akhir".$id."'  type='text' value='".$data->jam_akhir."' size='5' onchange='save_jam(`akhir".$id."`,`jam_akhir`,`$id`)'></td>
			     <td><input id='kegiatan".$id."'  type='text' value='".$data->kegiatan."' size='45' onchange='save_jam(`kegiatan".$id."`,`kegiatan`,`$id`)'></td>
			     </tr>";
			 }
			 ?>
			 <table class="entry">
			     <tr>
			         <td>JAM KE</td>
			          <td>WAKTU MULAI</td>
			           <td>WAKTU AKHIR</td>
			            <td>KEGIATAN</td>
			              
			     </tr>
			     <?php echo $data_jam;?>
			 </table>
			 <br>
			 </div>
                           <!----->        
                           
                           
                            
                           
                           
                           
                        </div>
                        
                         
                    </div>
                </div>
                <!-- #END# Task Info -->
				
 
  
	
 
 
<script>
 
 
 function save_jam(isi,field,id)
	 {	 
	     var isi=$("#"+isi).val();
		 $.ajax({
		 url:"<?php echo base_url()?>pengaturan/save_jam",
		 data: "id="+id+"&isi="+isi+"&field="+field,
		 method:"POST",
		 success: function(data)
            {	 
				 notif_success("<span class='sadow white'><div class='demo-google-material-icon'> <i class='material-icons'>done_all</i> <span class='icon-name'>Tersimpan!</span>");
            }
		});

	 }
	function generate_jam()
	{
	  var isi=$("#"+isi).val();
		 $.ajax({
		 url:"<?php echo base_url()?>pengaturan/save_jam",
		 data: "id="+id+"&isi="+isi+"&field="+field,
		 method:"POST",
		 success: function(data)
            {	 
				 notif_success("<span class='sadow white'><div class='demo-google-material-icon'> <i class='material-icons'>done_all</i> <span class='icon-name'>Tersimpan!</span>");
            }
		});  
	}
	   
</script>


 