 <?php $database=$this->db->get_where("tr_mitra",array("id"=>$this->input->post("id")))->row();  ?>		

<input type="hidden" name="id" value="<?php echo $database->id;?>"> 

							 



				

									

								 

							    <div class="row clearfix">

                                    <div class="col-md-6">
                                        <label for="email_address_2" class="col-black">NAMA MITRA</label><br>
                                        <div class="form-group">
                                            <div class="form-line"  >
                                            <input type="text" class="form-control" required name="f[nama]" value="<?php echo $database->nama;?>"></input>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="email_address_2" class="col-black">JENIS KERJASAMA</label><br>
                                        <div class="form-group">
                                            <div class="form-line"  >
                                            <input type="text" class="form-control" name="f[jenis_kerjasama]" value="<?php echo $database->jenis_kerjasama ?>"></input>
                                            </div>
                                        </div>
                                    </div>

                                </div>

							     <div class="row clearfix">
                                    <div class="col-lg-6 col-md-6  ">
                                        <label for="email_address_2" class="col-black">PROVINSI </label><br>
                                        <div class="form-group">
                                            <select class="form-control show-tick" id="id_prov" data-live-search="true" onchange="get_kota(this.value)" name="f[id_prov]">
                                                <option value="">=== Pilih ===</option>
                                                <?php

                                                    $provinsi = $this->m_konfig->get_provinsi();

                                                   foreach($provinsi as $val){

                                                       if ($val->id_prov == $database->id_prov) {

                                                           echo "<option value='".$val->id_prov."' selected>".$val->nama."</option>";

                                                       }

                                                       else{

                                                            echo "<option value='".$val->id_prov."'>".$val->nama."</option>";

                                                       }

                                                       

                                                    

                                                   }

                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="email_address_2" class="col-black">KOTA / KAB. </label><br>
                                        <div class="form-group" id="edtkota">
                                            <select class="form-control show-tick"  data-live-search="true" name="f[id_kota]">
                                                <option value="">=== Pilih ===</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="row clearfix">
                                    <div class="col-lg-6 col-md-6">
                                        <label for="email_address_2" class="col-black">KECAMATAN</label><br>
                                        <div class="form-group" id="edtkec">
                                            <select class="form-control show-tick"  data-live-search="true" name="f[id_kecamatan]">
                                                <option value="">=== Pilih ===</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="email_address_2" class="col-black">KELURAHAN</label><br>
                                        <div class="form-group" id="edtkel">
                                            <select class="form-control show-tick"  data-live-search="true">
                                                <option value="">=== Pilih ===</option>   
                                            </select>
                                        </div>
                                    </div>
                                </div>
   

								<div class="row clearfix">
                                    <div class="col-lg-12 col-md-12  ">
                                        <label for="email_address_2" class="col-black">ALAMAT </label><br>
                                        <div class="form-group">
                                            <div class="form-line"  >
											  <textarea class="form-control" required name="f[lokasi]"><?php echo $database->lokasi;?></textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row clearfix">
                                    <div class="col-md-6">
                                        <label for="email_address_2" class="col-black">BUJUR</label><br>
                                        <div class="form-group">
                                            <div class="form-line"  >
                                            <input type="text" class="form-control"  name="f[longt]" value="<?php echo $database->longt; ?>"></input>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="email_address_2" class="col-black">LINTANG</label><br>
                                        <div class="form-group">
                                            <div class="form-line"  >
                                            <input type="text" class="form-control"  name="f[latt]" value="<?php echo $database->latt; ?>"></input>
                                            </div>
                                        </div>
                                    </div>
                                    
                                </div>

                                <div class="row clearfix">
                                    <div class="col-md-6">
                                        <label for="email_address_2" class="col-black">TELP. KANTOR</label><br>
                                        <div class="form-group">
                                            <div class="form-line"  >
                                            <input type="text" class="form-control" required name="f[telp]" value="<?php echo $database->telp; ?>"></input>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="email_address_2" class="col-black">EMAIL KANTOR</label><br>
                                        <div class="form-group">
                                            <div class="form-line"  >
                                            <input type="email" class="form-control" name="f[email]"  value="<?php echo $database->email; ?>"></input>
                                            </div>
                                        </div>
                                    </div>
                                    
                                </div>

                                <div class="row clearfix">
                                    <div class="col-md-6">
                                        <label for="email_address_2" class="col-black">WEBSITE</label><br>
                                        <div class="form-group">
                                            <div class="form-line"  >
                                            <input type="text" class="form-control"  name="f[website]" value="<?php echo $database->website; ?>"></input>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="email_address_2" class="col-black">FAX</label><br>
                                        <div class="form-group">
                                            <div class="form-line"  >
                                            <input type="text" class="form-control"  name="f[fax]" value="<?php echo $database->fax; ?>"></input>
                                            </div>
                                        </div>
                                    </div>
                                    
                                </div>

                                <div class="row clearfix">
                                    <div class="col-md-6">
                                        <label for="email_address_2" class="col-black">BIDANG USAHA</label><br>
                                        <div class="form-group">
                                            <div class="form-line"  >
                                            <input type="text" class="form-control"  name="f[bidang_usaha]" value="<?php echo $database->bidang_usaha; ?>"></input>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="email_address_2" class="col-black">NAMA CONTACT PERSON</label><br>
                                        <div class="form-group">
                                            <div class="form-line"  >
                                            <input type="text" class="form-control"  name="f[nama_cp]" value="<?php echo $database->nama_cp; ?>"></input>
                                            </div>
                                        </div>
                                    </div>
                                    
                                </div>

                                <div class="row clearfix">
                                    <div class="col-md-6">
                                        <label for="email_address_2" class="col-black">TELP CONTACT PERSON</label><br>
                                        <div class="form-group">
                                            <div class="form-line"  >
                                            <input type="text" class="form-control"  name="f[telp_cp]" value="<?php echo $database->telp_cp; ?>"></input>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="email_address_2" class="col-black">JABATAN CONTACT PERSON</label><br>
                                        <div class="form-group">
                                            <div class="form-line"  >
                                            <input type="text" class="form-control"  name="f[jabatan_cp]" value="<?php echo $database->jabatan_cp; ?>"></input>
                                            </div>
                                        </div>
                                    </div>
                                    
                                </div>

								<div class="row clearfix">
                                    <div class="col-lg-12 col-md-12  ">
                                        <label for="email_address_2" class="col-black">KETERANGAN </label><br>
                                        <div class="form-group">
                                            <div class="form-line"  >
											  <textarea class="form-control"   name="f[ket]"><?php echo $database->ket;?></textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>

												  

                                 

                               

								 

									

		 							

 <script>

    $('select').selectpicker();

    var tmp_select = "<select class='form-control show-tick'  data-live-search='true'><option value=''>=== Pilih ===</option></select>";



    edit_kota("<?php echo $database->id_prov ?>");

    edit_kecamatan("<?php echo $database->id_kab ?>");

    edit_kelurahan("<?php echo $database->id_kec ?>");



    function edit_kota(id){

        $.post("<?php echo site_url("humas/get_kota"); ?>",{idk:id, val:"<?php echo $database->id_kab;?>"},function(data){

            $("#edtkota").html(data);

        }); 

    }



    function edit_kecamatan(id){

        $.post("<?php echo site_url("humas/get_kecamatan"); ?>",{idk:id, val:"<?php echo $database->id_kec;?>"},function(data){

          $("#edtkec").html(data);

        }); 

    }



    function edit_kelurahan(id){

        $.post("<?php echo site_url("humas/get_kelurahan"); ?>",{idk:id, val:"<?php echo $database->id_kel;?>"},function(data){

          $("#edtkel").html(data);

        }); 

    }



    function get_kota(id){

        $.post("<?php echo site_url("humas/get_kota"); ?>",{idk:id, val:""},function(data){

            $("#edtkota").html(data);

            $("#edtkec").html(tmp_select);

            $("#edtkel").html(tmp_select);

        }); 

    }



    function get_kecamatan(id){

        $.post("<?php echo site_url("humas/get_kecamatan"); ?>",{idk:id, val:""},function(data){

          $("#edtkec").html(data);

          $("#edtkel").html(tmp_select);

        }); 

    }



    function get_kelurahan(id){

        $.post("<?php echo site_url("humas/get_kelurahan"); ?>",{idk:id, val:""},function(data){

          $("#edtkel").html(data);

        }); 

    }

 </script>

			 