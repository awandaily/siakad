
								
						 
									
								 
								<div class="row clearfix">
                                    <div class="col-md-6">
                                        <label for="email_address_2" class="col-black">NAMA MITRA</label><br>
                                        <div class="form-group">
                                            <div class="form-line"  >
                                            <input type="text" class="form-control" required name="f[nama]"></input>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="email_address_2" class="col-black">JENIS KERJASAMA</label><br>
                                        <div class="form-group">
                                            <div class="form-line"  >
                                            <input type="text" class="form-control" name="f[jenis_kerjasama]"></input>
                                            </div>
                                        </div>
                                    </div>
                                    
                                </div>

                                <div class="row clearfix">
                                    <div class="col-md-6">
                                        <label for="email_address_2" class="col-black">PROVINSI </label><br>
                                        <div class="form-group">
                                            <select class="form-control show-tick" id="id_prov" data-live-search="true" onchange="get_kota(this.value)" name="f[id_prov]">
                                                <option value="">=== Pilih ===</option>
                                                <?php
                                                    $provinsi = $this->m_konfig->get_provinsi();
                                                   foreach($provinsi as $val){
                                                       echo "<option value='".$val->id_prov."'>".$val->nama."</option>";
                                                    
                                                   }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6">
                                        <label for="email_address_2" class="col-black">KOTA / KAB. </label><br>
                                        <div class="form-group" id="dtkota">
                                        
                                            <select class="form-control show-tick"  data-live-search="true" name="f[id_kab]">
                                                <option value="">=== Pilih ===</option>
                                                
                                            </select>
                                        </div>
                                    </div>
                                    
                                </div>

                                <div class="row clearfix">

                                    <div class="col-lg-6 col-md-6  ">
                                        <label for="email_address_2" class="col-black">KECAMATAN</label><br>
                                        <div class="form-group" id="dtkec">
                                        
                                            <select class="form-control show-tick"  data-live-search="true" name="f[id_kec]">
                                                <option value="">=== Pilih ===</option>
                                                
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="email_address_2" class="col-black">KELURAHAN</label><br>
                                        <div class="form-group" id="dtkel">
                                        
                                            <select class="form-control show-tick"  data-live-search="true">
                                                <option value="">=== Pilih ===</option>
                                                
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="row clearfix">
                                    <div class="col-lg-12 col-md-12">
                                        <label for="email_address_2" class="col-black">ALAMAT </label><br>
                                        <div class="form-group">
                                            <div class="form-line"  >
                                              <textarea class="form-control" required name="f[lokasi]" placeholder="Masukan jalan, nomor jalan, kode pos, dll"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row clearfix">
                                    <div class="col-md-6">
                                        <label for="email_address_2" class="col-black">BUJUR</label><br>
                                        <div class="form-group">
                                            <div class="form-line"  >
                                            <input type="text" class="form-control"  name="f[longt]"></input>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="email_address_2" class="col-black">LINTANG</label><br>
                                        <div class="form-group">
                                            <div class="form-line"  >
                                            <input type="text" class="form-control"  name="f[latt]"></input>
                                            </div>
                                        </div>
                                    </div>
                                    
                                </div>

                                <div class="row clearfix">
                                    <div class="col-md-6">
                                        <label for="email_address_2" class="col-black">TELP. KANTOR</label><br>
                                        <div class="form-group">
                                            <div class="form-line"  >
                                            <input type="text" class="form-control" required name="f[telp]"></input>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="email_address_2" class="col-black">EMAIL KANTOR</label><br>
                                        <div class="form-group">
                                            <div class="form-line"  >
                                            <input type="email" class="form-control" name="f[email]"></input>
                                            </div>
                                        </div>
                                    </div>
                                    
                                </div>

                                <div class="row clearfix">
                                    <div class="col-md-6">
                                        <label for="email_address_2" class="col-black">WEBSITE</label><br>
                                        <div class="form-group">
                                            <div class="form-line"  >
                                            <input type="text" class="form-control"  name="f[website]"></input>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="email_address_2" class="col-black">FAX</label><br>
                                        <div class="form-group">
                                            <div class="form-line"  >
                                            <input type="text" class="form-control"  name="f[fax]"></input>
                                            </div>
                                        </div>
                                    </div>
                                    
                                </div>

                                <div class="row clearfix">
                                    <div class="col-md-6">
                                        <label for="email_address_2" class="col-black">BIDANG USAHA</label><br>
                                        <div class="form-group">
                                            <div class="form-line"  >
                                            <input type="text" class="form-control"  name="f[bidang_usaha]"></input>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="email_address_2" class="col-black">NAMA CONTACT PERSON</label><br>
                                        <div class="form-group">
                                            <div class="form-line"  >
                                            <input type="text" class="form-control"  name="f[nama_cp]"></input>
                                            </div>
                                        </div>
                                    </div>
                                    
                                </div>

                                <div class="row clearfix">
                                    <div class="col-md-6">
                                        <label for="email_address_2" class="col-black">TELP CONTACT PERSON</label><br>
                                        <div class="form-group">
                                            <div class="form-line"  >
                                            <input type="text" class="form-control"  name="f[telp_cp]"></input>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="email_address_2" class="col-black">JABATAN CONTACT PERSON</label><br>
                                        <div class="form-group">
                                            <div class="form-line"  >
                                            <input type="text" class="form-control"  name="f[jabatan_cp]"></input>
                                            </div>
                                        </div>
                                    </div>
                                    
                                </div>

								<div class="row clearfix">
                                    <div class="col-lg-12 col-md-12">
                                        <label for="email_address_2" class="col-black">KETERANGAN </label><br>
                                        <div class="form-group">
                                            <div class="form-line"  >
                                              <textarea class="form-control"   name="f[ket]"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
									
							
									
<script>
    $('select').selectpicker();
    var tmp_select = "<select class='form-control show-tick'  data-live-search='true'><option value=''>=== Pilih ===</option></select>";

    function get_kota(id){
        $.post("<?php echo site_url("humas/get_kota"); ?>",{idk:id, val:""},function(data){
            $("#dtkota").html(data);
            $("#dtkec").html(tmp_select);
            $("#dtkel").html(tmp_select);
        }); 
    }

    function get_kecamatan(id){
        $.post("<?php echo site_url("humas/get_kecamatan"); ?>",{idk:id, val:""},function(data){
          $("#dtkec").html(data);
          $("#dtkel").html(tmp_select);
        }); 
    }

    function get_kelurahan(id){
        $.post("<?php echo site_url("humas/get_kelurahan"); ?>",{idk:id, val:""},function(data){
          $("#dtkel").html(data);
        }); 
    }
    /*
    function pilsiswa(){
	  var idk=$("[name='f[id_kelas]']").val();
			$.post("<?php echo site_url("catatan/getSiswa"); ?>",{idk:idk},function(data){
			  $("#data_siswa").html(data);
		      }); 
    }*/
</script>

			 