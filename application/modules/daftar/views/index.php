
<script src="<?php echo base_url()?>plug/blokui.js"></script>
	<script src="<?php echo base_url()?>new/js/angular.js"></script>
 	<script src="<?php echo base_url()?>new/js/proses.js"></script>
    <link href="<?php echo base_url()?>static/js/alertify/css/alertify.css" rel="stylesheet">
   
 
  
<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />



								 <div style="color:black;background:#ffffff;" id="panel-5268-0-1-0"   >
									<div class="textwidget">
								 	<div class="col-md-12">	   <h4>Silahkan untuk mengisi form pendaftaran di bawah ini dengan lengkap :</h4><br> </div>
									   <div class="screen-reader-response"></div>
									   <form action="#" id="formpendaftaran">
										  <div class="row">
											 <input id="id" name="id" type="hidden">
									 	<div class="col-md-12">		 
											 <div class="col-xs-12 col-md-4">
											 <span>Nama Lengkap (tanpa gelar)<span class="wpcf7-form-control-wrap your-name"><input style='color:black' type="text"  name="nama" size="40" id="nama" class="wpcf7-form-control wpcf7-text wpcf7-validates-as-required" aria-required="true" aria-invalid="false" placeholder="Nama Lengkap" /></span></span>
											 </div>
											 <div class="col-xs-12 col-md-4">
												<span>
												   Jenis Kelamin
												   <span class="wpcf7-form-control-wrap the-time">
													  <select style='color:black' name="jk" id="jk" class="wpcf7-form-control wpcf7-select wpcf7-validates-as-required" aria-required="true" aria-invalid="false">
													     <option value="">=== Pilih Jenis Kelamin ===</option>
														 <option value="l">Laki-laki</option>
														 <option value="p">Perempuan</option>
													  </select>
												   </span>
												</span>
											 </div>
											 <div class="col-xs-12 col-md-4">
											 <span>Tempat Tugas/Tempat bekerja saat ini<span class="wpcf7-form-control-wrap your-address"><input style='color:black' type="text" name="tempat_tugas" 
											 size="40" id="tempat_tugas" class="wpcf7-form-control wpcf7-text wpcf7-validates-as-required" 
											 aria-required="true" aria-invalid="false" placeholder="Kosongkan jika belum bekerja"   /></span></span>
											 </div>
									</div>		 
											 
										 	<div class="col-md-12">	 
											 <div class="col-xs-12 col-md-4">
											 <span>Email<span class="wpcf7-form-control-wrap your-email"><input style='color:black' type="email" name="email" size="40" id="email" class="wpcf7-form-control wpcf7-text wpcf7-email wpcf7-validates-as-required wpcf7-validates-as-email" aria-required="true" aria-invalid="false" placeholder="Email" /></span></span>
											 </div>
											 
											 <div class="col-xs-12 col-md-4">
											 <span>Nomor HP<span class="wpcf7-form-control-wrap your-phone"><input style='color:black' type="tel" name="hp" size="40" id="hp" class="wpcf7-form-control wpcf7-text wpcf7-tel wpcf7-validates-as-required wpcf7-validates-as-tel" aria-required="true" aria-invalid="false" placeholder="Nomor HP" /></span></span>
											 </div>
											 
										
											 <div class="col-xs-12 col-md-4">
											 <span>Tempat Lahir<span class="wpcf7-form-control-wrap "><input style='color:black' type="text" name="tempat_lahir" size="40" id="tempat_lahir" class="wpcf7-form-control wpcf7-text wpcf7-validates-as-required" aria-required="true" aria-invalid="false" placeholder="Tempat Lahir" /></span></span>
											 </div>
											</div> 
											 
									 	<div class="col-md-12">
											 <div class="col-xs-12 col-md-4">
											 <span>Tanggal Lahir<span class="wpcf7-form-control-wrap the-date"><input style='color:black' type="text" name="tgl_lahir" id="tgl_lahir" class="wpcf7-form-control wpcf7-date wpcf7-validates-as-date" aria-invalid="false" /></span></span>
											 </div>
											 
											 <script>
											     $('#tgl_lahir').daterangepicker({
                                                        "singleDatePicker": true,
                                                        "showDropdowns": true,
                                                        "autoApply": true,
                                                       
                                                        "endDate": "<?php echo date('d/m/1990')?>",
                                                       "maxDate":'<?php echo date('d/m')?>/2000',
                                                       locale: {
                                                            format: 'DD/MM/YYYY'
                                                        }
                                                    }, function(start, end, label) {
                             console.log('New date range selected: ' + start.format('DD-MM-YYYY') + ' to ' + end.format('DD-MM-YYYY') + ' (predefined range: ' + label + ')');
                                                    });
											 </script>
											 
											 <div class="col-xs-12 col-md-4">
												<span>
												   MAN IC Peminatan
												   <span class="wpcf7-form-control-wrap">
													  <select style='color:black' name="madrasah_peminatan" id="madrasah_peminatan" class=" wpcf7-select wpcf7-validates-as-required" aria-required="true" aria-invalid="false">
													     <option value="">=== PIlih MAN IC Peminatan ===</option>
												<?php 
												$this->db->where("level",15);
												$this->db->where("tampil",1);
												$this->db->order_by("owner");
												$db=$this->db->get("admin")->result();
												foreach($db as $db)
												{
												 echo "<option value=".$db->id_admin.">".$db->owner."</option>";  
												}
												?>
													  </select>
												   </span>
												</span>
											 </div>
											 
											 <div class="col-xs-12 col-md-4">
												<span>
												   Posisi Peminatan
												   <span class="wpcf7-form-control-wrap">
													  <select style='color:black' name="posisi_peminatan" id="posisi_peminatan" class="wpcf7-form-control wpcf7-select wpcf7-validates-as-required" aria-required="true" aria-invalid="false">
													     <option value="">=== Pilih Posisi Peminatan ===</option>
														 	<?php 
										 
												$this->db->order_by("nama");
												$db=$this->db->get("tr_kategory")->result();
												foreach($db as $db)
												{
												 echo "<option value=".$db->id.">".$db->nama."</option>";  
												}
												?>
													  </select>
												   </span>
												</span>
											 </div>
											</div> 
											 
											 <div class="col-md-12">
    											  <div class="col-xs-12 col-md-4">
    											 <span>Username ( jangan gunakan spasi )<span class="wpcf7-form-control-wrap your-email"><input style='color:black' type="text" name="username" size="40" id="username" class="wpcf7-form-control wpcf7-text wpcf7-validates-as-required" aria-required="true" aria-invalid="false" placeholder="Username" /></span></span>
    											 </div>
    											 
    											 <div class="col-xs-12 col-md-4">
    											 <span>Password<span class="wpcf7-form-control-wrap your-email"><input style='color:black' type="password" name="password" size="40" id="password" class="wpcf7-form-control wpcf7-text wpcf7-validates-as-required" aria-required="true" aria-invalid="false" placeholder="Password" /></span></span>
    											 </div>
    											 
    											 <div class="col-xs-12 col-md-4">
    											 <span>Ulangi Password<span class="wpcf7-form-control-wrap your-email"><input style='color:black' type="password" name="retpass" size="40" id="retpass" class="wpcf7-form-control wpcf7-text wpcf7-validates-as-required" aria-required="true" aria-invalid="false" placeholder="Ulangi Password" /></span></span>
    											 </div>
											 </div>
											  
										  </div>
										   <div class="col-md-12">
										  <div class="row">
											 <div class="col-xs-12 col-md-12">
											  <button type="button" onclick="save_peserta()" class="wpcf7-form-control btn btn-primary"><i class="fa fa-save"></i> Daftar</button>
											  <div class="msg pull-left"></div>
											  <br><br><br><br>
											 </div>
										  </div>
                                         </div>
									   </form>
									</div>
								 </div>
						


<script>

	function save_peserta()
    {
		var nama = $('#nama').val();
	 
		var email = $('#email').val();
		var hp = $('#hp').val();
		var username = $('#username').val();
		var password = $('#password').val();
		var retpass = $('#retpass').val();
		var tempat_lahir = $('#tempat_lahir').val();
		var tgl_lahir = $('#tgl_lahir').val();
		var jk = $('#jk').val();
		var madrasah_peminatan = $('#madrasah_peminatan').val();
		var posisi_peminatan = $('#posisi_peminatan').val();

			if (nama==''  || email=='' || hp=='' || username=='' || password=='' || retpass=='' || tempat_lahir=='' || tgl_lahir=='' || jk=='' || madrasah_peminatan=='' || posisi_peminatan=='')
			{
			
			 
				alertify.set('notifier','position', 'center-right');
            	 alertify.error("<font color='white'>Pastikan form terisi dengan lengkap</font>");
				return false;
			}
			else if(password!=retpass)
			{
			 
					alertify.set('notifier','position', 'center-right');
            	 alertify.error("<font color='white'>Password tidak sama</font>");
				return false;
			}
			else
			{
				savedata();
			}
    }
	
	function savedata(){
    	loading();
		$.ajax({
		url : "<?php echo base_url();?>daftar/add_data",
		type: "POST",
		data: $('#formpendaftaran').serialize(),
		dataType: "JSON",
		success: function(data)
		{
			if(data==true){
				var msg="<font color='white'>Pendaftaran Berhasil, sesat lagi anda akan diarahkan ke halaman login!</font>";
				notif_success(msg);
			
				$.unblockUI();
				
				setTimeout(function(){ 	window.location.href = '<?php echo base_url();?>daftar/login';  }, 3000);
				
			}else if(data=="upas"){
				alertify.set('notifier','position', 'center-right');
            	 alertify.error("<font color='white'>Maaf! silahkan cari username/password lain...</font>");
            	 $.unblockUI();
			}else if(data=="email"){
				 alertify.set('notifier','position', 'center-right');
            	 alertify.error("<font color='white'>Maaf! silahkan cari email lain...</font>");
            	 $.unblockUI();
			}else if(data=="hp"){
				alertify.set('notifier','position', 'center-right');
            	 alertify.error("<font color='white'>Maaf! silahkan cari no.hp lain...</font>");
            	 $.unblockUI();
			}
			$('.msg').html('');
		},
		error: function(jqXHR, textStatus, errorThrown){ alert("Gagal memproses"); $('.msg').html('');	$.unblockUI();}   
		});
		return false;
	}


</script>
 	<script src="<?php echo base_url()?>static/js/alertify/alertify.js"></script>