<?php $sts=$this->m_reff->goField("tm_peserta","sts","where id='".$this->session->userdata("id")."'");	
if($sts==0)
{?>
    


<style>
.upload{
border:#DCDCDC dashed 1px;k
}
label{
color:black;}
</style>
<?php $data=$this->mdl->dataProfile();?> 
              <!-- Validation Stats -->
             
                
                    				
 
		  

<script>
$( document ).ready(function() {
     getkab(pil=null);
         getmapel();
});
                                 
									function getkab()
									 {
										var idprov=$("#selectProv").val();
										$.ajax({
										url:"<?php echo base_url();?>welcome/getKab/<?php echo $data->idkab?>",
										type: "POST",
										data: "idprov="+idprov,
										success: function(data)
												{	
													$("#kab").html(data);
												    getkec();
												}
										});	
									 
									 };
									 
									 function getkec()
									 {
									 
										 var idkab=$("#selectKab").val();
										  var idprov=$("#selectProv").val();
										$.ajax({
										url:"<?php echo base_url();?>welcome/getKec/<?php echo $data->idkec?>",
										type: "POST",
										data: "idkab="+idkab+"&idprov="+idprov,
										success: function(data)
												{	
													$("#kec").html(data);
												  getkel(pil=null);
												}
										});	
									
									 };
									 
									 
									  function getkel()
									 {
									 
									 
										   var idkec=$("#selectKec").val();
										$.ajax({
										url:"<?php echo base_url();?>welcome/getKel/<?php echo $data->idkel?>",
										type: "POST",
										data: "idkec="+idkec,
										success: function(data)
												{	
													$("#kel").html(data);
												  
												}
										});	
									
									 };

									 
									 
									 
									 
									 
 function readURL(input) {

  if (input.files && input.files[0]) {
    var reader = new FileReader();

    reader.onload = function(e) {
      $('#blah').attr('src', e.target.result);
      $('.image img').attr('src', e.target.result);
    }

    reader.readAsDataURL(input.files[0]);
  }
}

$("#imgInp").change(function() {
  readURL(this);
});
</script>








 



<form id="f_formSubmit" action="javascript:save_profile('formSubmit')" method="post" url="<?php echo base_url("data_profile/update");?>">
<div class="row clearfix" >
       
                
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card" >
                        <div class="header">
                            <h2>
                                BIODATA
                            </h2>
                            
                        </div>
                        <div class="body">

	            <?php $jkl=$jkp=""; if($data->jk=="l"){ $jkl="checked";}else{ $jkp="checked";}?>
                                    <p> 
                                       <table class="table table-striped" style='color:black'>
                                      <tr><td>No.Registrasi</td><td>:</td><td><?php echo $data->reg?></td></tr>       
									   <tr><td>Nama Lengkap</td><td>:</td><td><input class="form-control" value="<?php echo $data->nama;?>" type="text" name="f[nama]"></input></td></tr>
									   <tr><td>Jenis Kelamin</td><td>:</td><td>
									       	<div class=" form-float" style="margin-left:-20px">
                                   
								 <span style="margin-left:14px">
									<input name="f[jk]" type="radio" id="radio_1" value="l" <?php echo $jkl;?> />
									<label for="radio_1">laki-laki</label>
									<input name="f[jk]" type="radio" id="radio_2" value="p" <?php echo $jkp;?>/>
									<label for="radio_2">Perempuan</label>
								 </span>
							    </div>
								
									       
									       </td></tr>
									   <tr><td>Hp</td><td>:</td><td>  <input type="text" class="form-control" name="f[hp]" value="<?php echo $data->hp;?>" required></td></tr>
									   <tr><td>E-mail</td><td>:</td><td> <input type="text" class="form-control" name="f[email]" value="<?php echo $data->email;?>" required></td></tr>
									    <tr><td>Pendidikan terakhir</td><td>:</td><td>	<?php
										$kategory[""]="=== pilih ===";
								 
									//	$this->db->order_by("nama");
										$di=$this->db->get("tr_ijazah")->result();
										foreach($di as $val)
										{
											$kategory[$val->id]=$val->nama;
										}
											$default=$kategory;
										 
										echo form_dropdown("f[ijazah]",$default,$data->ijazah,'class="form-control" required ');
										?></td></tr>
									     <tr><td>Jurusan</td><td>:</td><td> <input type="text" class="form-control" name="f[jurusan]" value="<?php echo $data->jurusan;?>" required></td></tr>
									      <tr><td>Nama Perguruan Tinggi</td><td>:</td><td> <input type="text" class="form-control" name="f[pt]" value="<?php echo $data->pt;?>" required></td></tr>
									   <tr><td>Tempat Lahir</td><td>:</td><td>  <input type="text" class="form-control" name="f[tempat_lahir]" value="<?php echo $data->tempat_lahir;?>" required></td></tr>
									   <tr><td>Tanggal Lahir</td><td>:</td><td> <input type="text" id="tgl_lahir" class="form-control" name="tgl_lahir" value="<?php echo $this->tanggal->ind($data->tgl_lahir,"/");?>" required></td></tr>
									   <tr><td>Provinsi</td><td>:</td><td>
									   
									   
                                    
                              			<?php
                              			$kategory="";
										$kategory[""]="=== pilih ===";
								 
										$this->db->order_by("nama");
										$data_penulis=$this->db->get("provinsi")->result();
										foreach($data_penulis as $val)
										{
											$kategory[$val->id_prov]=$val->nama;
										}
											$default=$kategory;
										 
										echo form_dropdown("f[idprov]",$default,$data->idprov,'class="form-control" required id="selectProv" onchange="getkab()"');
										?>
                                   
                             
									   </td></tr>
									   <tr><td>Kab/Kota</td><td>:</td><td>  <div id="kab"> <select class="form-control"><option>=== Pilih ===</option></select></div></td></tr>
									   <tr><td>Kecamatan</td><td>:</td><td> 
									   <div  id="kec">
							            <select class="form-control"><option>=== Pilih ===</option></select>
                                        </div></td></tr>
									   <tr><td>Keluruhan</td><td>:</td><td> <div id="kel">  <select class="form-control"><option>=== Pilih ===</option></select>  </div></td></tr>
									   <tr><td>Alamat</td><td>:</td><td>   <textarea type="text" class="form-control" name="f[alamat_peserta]"  required><?php echo $data->alamat_peserta;?></textarea></td></tr>
									  </table>
                                    </p>
                        </div>
                      </div>
                </div>  
   
     	 <script>
											     $('#tgl_lahir').daterangepicker({
                                                        "singleDatePicker": true,
                                                        "showDropdowns": true,
                                                        "autoApply": true,
                                                           "startDate": "<?php echo $this->tanggal->ind($data->tgl_lahir,"/");?>",
                                                        "endDate": "<?php echo date('d/m/Y')?>",
                                                       "maxDate":'<?php echo date('d/m/Y')?>',
                                                       locale: {
                                                            format: 'DD/MM/YYYY'
                                                        }
                                                    }, function(start, end, label) {
                             console.log('New date range selected: ' + start.format('DD-MM-YYYY') + ' to ' + end.format('DD-MM-YYYY') + ' (predefined range: ' + label + ')');
                                                    });
											 </script>
     
     
      <div   >
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card" >
                        <div class="header">
                            <h2>
                                TEMPAT TUGAS
                            </h2>
                            
                        </div>
                        <div class="body">


                                   <p>
                                       <table class="table table-striped" style='color:black'>
									   <tr><td>Tempat Tugas / tempat saat ini bekerja</td><td>:</td><td> <input type="text" placeholder="kosongkan jika belum bekerja" class="form-control" name="f[tempat_tugas]" value="<?php echo $data->tempat_tugas;?>"  ></td></tr>
									   <tr><td>Alamat Tempat Tugas</td><td>:</td><td><textarea   placeholder="kosongkan jika belum bekerja"  name="f[alamat_tempat_tugas]" class="form-control"><?php echo $data->alamat_tempat_tugas;?></textarea></td></tr>
									   <tr><td>Jabatan Saat ini</td><td>:</td><td>	<?php
										$kategory="";
										$kategory[""]="=== pilih ===";
										$data_penulis=$this->db->get("tr_jabatan")->result();
										foreach($data_penulis as $val)
										{
											$kategory[$val->id]=$val->nama;
										}
											$default=$kategory;
										 
										echo form_dropdown("f[jabatan]",$default,$data->jabatan,'class="form-control"   onchange="getmapel()"');
										?></td></tr>
									   <tr id="mapelampu"><td>Mapel Yang Diampu</td><td>:</td><td>
									   
									   
									    <script>
                              
                               function getmapel()
                               {
                                   var jb=$("[name='f[jabatan]']").val();
                                   if(jb=="2")
                                   {
                                       $("#mapelampu").show();
                                   }else{
                                        $("#mapelampu").hide();
                                   }
                               }
                           </script>
                           
                            
                              			<?php
										$kategory="";
										$kategory[""]="=== pilih ===";
										$this->db->order_by("nama","ASC");
										$datamapel=$this->db->get("tr_mapel")->result();
										foreach($datamapel as $val)
										{
											$kategory[$val->id]=$val->nama;
										}
											$default=$kategory;
										 
										echo form_dropdown("f[mapel_yg_diampu]",$default,$data->mapel_yg_diampu,'class="form-control" ');
										?>
                                
                          
									   
									   
									   
									   </td></tr>
									   </table>
                                    </p>
                        </div>
                      </div>
                </div>  
     </div>  
     
       <div   >
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card" >
                        <div class="header">
                            <h2>
                               PEMINATAN
                            </h2>
                            
                        </div>
                        <div class="body">


                                   <p>
                                       <table class="table table-striped" style='color:black'>
									   <tr><td>Madrasah Peminatan</td><td>:</td><td><?php
										$kategory="";
										$kategory[""]="=== pilih ===";
										$this->db->where("level",15);
											$this->db->where("tampil",1);
										$data_penulis=$this->db->get("admin")->result();
										foreach($data_penulis as $val)
										{
											$kategory[$val->id_admin]=$val->owner;
										}
											$default=$kategory;
										 
										echo form_dropdown("f[madrasah_peminatan]",$default,$data->madrasah_peminatan,'class="form-control" required');
										?></td></tr>
										
										
										
									   <tr><td>Posisi Peminatan</td><td>:</td><td>	<?php
										$kategory="";
										$kategory[""]="=== pilih ===";
										$data_penulis=$this->db->get("tr_kategory")->result();
										foreach($data_penulis as $val)
										{
											$kategory[$val->id]=$val->nama;
										}
											$default=$kategory;
										 
										echo form_dropdown("f[posisi_peminatan]",$default,$data->posisi_peminatan,'class="form-control" required  onchange="mapelampuPeminatan()" ');
										?></td></tr>
									 
									 
									 
									 
							  <tr id="mapelampuPeminatan"><td>Mapel Peminatan</td><td>:</td><td>		 
									 
							  <script>
                                  mapelampuPeminatan();
                               function mapelampuPeminatan()
                               {
                                   var jb=$("[name='f[posisi_peminatan]']").val();
                                   if(jb=="2")
                                   {
                                       $("#mapelampuPeminatan").show();
                                        $("#id_mapel_peminatan").prop('required',true);
                                   }else{
                                        $("#mapelampuPeminatan").hide();
                                        $("#id_mapel_peminatan").prop('required',false);
                                   }
                               }
                           </script>
                           
                            
                              			<?php
										$kategory="";
										$kategory[""]="=== pilih ===";
											$this->db->order_by("nama","ASC");
											$this->db->where("sts!=","1");
										$datamapel=$this->db->get("tr_mapel")->result();
										foreach($datamapel as $val)
										{
											$kategory[$val->id]=$val->nama;
										}
											$default=$kategory;
										 
										echo form_dropdown("f[id_mapel_peminatan]",$default,$data->id_mapel_peminatan,'class="form-control" id="id_mapel_peminatan" ');
										?>
                                
									 
									</td></tr> 
									 
									 
									 
									 
									 
									  </table>
									 
                                    </p>
                                   
                        </div>
                      </div>
                </div>  
     </div>  
     </div>  
                                    



	<div class="form-group col-md-12 form-float">
                                     
                                        <button onclick="save_profile('formSubmit')"  class="waves-effect waves-block btn btn-block btn-primary"  ><i class="material-icons">save</i> Simpan Perubahan Data</button>
                                    <span class="pull-right" id="msg"></span>
                                    
                                </div>




</form>




<br><br>
<br><br>































<?php }else{
$data=$this->db->get_where("tm_peserta",array("id"=>$this->session->userdata("id")))->row();
?>


  <div class="row clearfix" >
      
                 <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                     <div class="card">
                        <div class="body  bg-pink">
                          Anda telah menyelesaikan pendaftaran dan selama proses verifikasi anda tidak dapat merubahnya.
                        </div>
                    </div>
                </div>
                
                
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card" >
                        <div class="header">
                            <h2>
                                BIODATA
                            </h2>
                            
                        </div>
                        <div class="body">


                                    <p>
                                       <table class="table table-striped" style='color:black'>
                                        <tr><td>No.Registrasi</td><td>:</td><td><?php echo $data->reg?></td></tr>
									    
									   <tr><td>Nama Lengkap</td><td>:</td><td><?php echo $data->nama?></td></tr>
									   <tr><td>Jenis Kelamin</td><td>:</td><td><?php echo $this->m_reff->goField("tr_jk","nama","where id='".$data->jk."'");?></td></tr>
									   <tr><td>Hp</td><td>:</td><td><?php echo $data->hp?></td></tr>
									   <tr><td>E-mail</td><td>:</td><td><?php echo $data->email?></td></tr>
									    <tr><td>Pendidikan terakhir</td><td>:</td><td><?php echo  $this->m_reff->goField("tr_ijazah","nama","where id='".$data->ijazah."'");?></td></tr>
									     <tr><td>Jurusan</td><td>:</td><td><?php echo $data->jurusan?></td></tr>
									      <tr><td>Nama Perguruan Tinggi</td><td>:</td><td><?php echo $data->pt?></td></tr>
									   <tr><td>T/T/L</td><td>:</td><td><?php echo $data->tempat_lahir?>, <?php echo $this->tanggal->ind($data->tgl_lahir,"/");?></td></tr>
									   <tr><td>Provinsi</td><td>:</td><td><?php echo $this->m_reff->goField("provinsi","nama","where id_prov='".$data->idprov."'");?></td></tr>
									   <tr><td>Kab/Kota</td><td>:</td><td><?php echo $this->m_reff->goField("kabupaten","nama","where  id_prov='".$data->idprov."' AND id_kab='".$data->idkab."' ");?></td></tr>
									   <tr><td>Kecamatan</td><td>:</td><td><?php echo $this->m_reff->goField("kecamatan","nama","where  id_kab='".$data->idkab."' and id_kec='".$data->idkec."'  ");?></td></tr>
									   <tr><td>Keluruhan</td><td>:</td><td><?php echo $this->m_reff->goField("kelurahan","nama","where  id_kec='".$data->idkec."' and id_kel='".$data->idkel."' ");?></td></tr>
									   <tr><td>Alamat</td><td>:</td><td><?php echo $data->alamat_peserta;?></td></tr>
									  </table>
                                    </p>
                        </div>
                      </div>
                </div>  
     </div>  
     
     
     
      <div class="row clearfix" >
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card" >
                        <div class="header">
                            <h2>
                                TEMPAT TUGAS
                            </h2>
                            
                        </div>
                        <div class="body">


                                   <p>
                                         <table class="table table-striped" style='color:black'>
									   <tr><td>Tempat Tugas</td><td>:</td><td><?php echo $data->tempat_tugas?></td></tr>
									  <tr><td>Alamat Tempat Tugas</td><td>:</td><td><?php echo $data->alamat_tempat_tugas;?></td></tr>
									   <tr><td>Jabatan</td><td>:</td><td><?php echo $this->m_reff->goField("tr_kategory","nama","where id='".$data->jabatan."'")?></td></tr>
									  
									 <?php if($data->jabatan==2){?>
									  <tr><td>Mapel Yang Diampu</td><td>:</td><td>
									      <?php echo $this->m_reff->goField("tr_mapel","nama","where id='".$data->mapel_yg_diampu."'");?>
									      </td></tr>
									  <?php } ?>
									  
									    </table>
                                    </p>
                        </div>
                      </div>
                </div>  
     </div>  
     
       <div class="row clearfix" >
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card" >
                        <div class="header">
                            <h2>
                               PENGAJUAN
                            </h2>
                            
                        </div>
                        <div class="body">


                                   <p>
                                       <table class="table table-striped" style='color:black'>
									   <tr><td>Madrasah Peminatan</td><td>:</td><td><?php echo $this->m_reff->goField("admin","owner","where id_admin='".$data->madrasah_peminatan."'")?></td></tr>
									   <tr><td>Posisi Peminatan</td><td>:</td><td><?php echo $this->m_reff->goField("tr_kategory","nama","where id='".$data->posisi_peminatan."'")?></td></tr>
									 <?php
									 if($data->posisi_peminatan==2){?>
									  <tr><td>Mapel Peminatan</td><td>:</td><td>
									      <?php echo $this->m_reff->goField("tr_mapel","nama","where id='".$data->id_mapel_peminatan."'");?>
									      </td></tr>
									  <?php } ?>
									  </table>
                                    </p>
                        </div>
                      </div>
                </div>  
     </div>  
                                    
                                    
                                    
<?php } ?>                                    
 