
 <input type="hidden" name="id" value="<?php echo $id=$this->input->post("id");?>">
 <?php
 $get=$this->db->get_where("keu_tr_biaya_tetap",array("id"=>$id))->row();
 ?>
								 <div class="row clearfix">
									<div class="col-lg-5 col-md-5  form-control-label">
                                        <label for="email_address_2" class="col-black">KODE TAGIHAN</label>
                                    </div>
                                    <div class="col-lg-6 col-md-6  ">
                                        <div class="form-group">
                                            <div class="form-line"  >
                                         <input type="text" required class="form-control" name='kode' value="<?php echo $get->kode;?>">
                                            </div>
                                        </div>
                                    </div>
                                </div>
								<div class="row clearfix">
									<div class="col-lg-5 col-md-5  form-control-label">
                                        <label for="email_address_2" class="col-black">NAMA TAGIHAN</label>
                                    </div>
                                    <div class="col-lg-6 col-md-6  ">
                                        <div class="form-group">
                                            <div class="form-line"  >
                                         <input type="text" required class="form-control" name='f[nama_biaya]'  value="<?php echo $get->nama_biaya;?>">
                                            </div>
                                        </div>
                                    </div>
                                </div>	
								<div class="row clearfix">
									<div class="col-lg-5 col-md-5  form-control-label">
                                        <label for="email_address_2" class="col-black">NOMINAL TAGIHAN</label>
                                    </div>
                                    <div class="col-lg-6 col-md-6  ">
                                        <div class="form-group">
                                            <div class="form-line"  >
                                         <input type="text" required class="form-control" name='nominal' onkeydown="return numbersonly(this, event);"   value="<?php echo number_format($get->biaya,0,",",".");?>">
                                            </div>
                                        </div>
                                    </div>
                                </div>
								
								  <div class="row clearfix">
                                    <div class="col-lg-5 col-md-5  form-control-label">
                                        <label for="email_address_2" class="col-black">JENIS PERULANGAN TAGIHAN</label>
                                    </div>
                                    <div class="col-lg-6 col-md-6  ">
                                        <div class="form-group">
                                            <div class="form-line">
                                      
										<?php
										$kelipatan[1]="Hanya Sekali";
										$kelipatan[36]="Setiap Bulan dari awal masuk sd lulus";
										$kelipatan[6]="Setiap Semester dari awal masuk hingga lulus";
										$kelipatan[4]="Setiap Semester dari awal masuk hingga tingkat XI (sebelas)";
										echo form_dropdown("kelipatan",$kelipatan,$get->kelipatan,"class='form-control' id='fkel' onclick='setPerulangan2()'  ");
										?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
								<script>
								function setPerulangan2()
								{
									var per=$('#fkel').val();
									if(per=="36" || per=="6" || per=="4")
									{
										$("#bln_penagihan2").val("07");
										$("#tingkat2").val("1");
									}
								}
								</script>
								
							   <div class="row clearfix">
                                    <div class="col-lg-5 col-md-5  form-control-label">
                                        <label for="email_address_2" class="col-black">DITAGIH PADA BULAN</label>
                                    </div>
                                    <div class="col-lg-6 col-md-6  ">
                                        <div class="form-group">
                                            <div class="form-line">
                                     
										
										<?php
										$bln_penagihan['01']="[01] JANUARI (Awal semester Genap)";
										$bln_penagihan['02']="[02] FEBRUARI";
										$bln_penagihan['03']="[03] MARET";
										$bln_penagihan['04']="[04] APRIL";
										$bln_penagihan['05']="[05] MEI";
										$bln_penagihan['06']="[06] JUNI";
										$bln_penagihan['07']="[07] JULI";
										$bln_penagihan['08']="[08] AGUSTUS";
										$bln_penagihan['09']="[09] SEPTEMBER";
										$bln_penagihan['10']="[10] OKTOBER";
										$bln_penagihan['11']="[11] NOVEMBER";
										$bln_penagihan['12']="[12] DESEMBER";
										 
										echo form_dropdown("f[bln_penagihan]",$bln_penagihan,$get->bln_penagihan,"class='form-control' id='bln_penagihan2'  ");
										?>
                                            </div>
                                        </div>
                                    </div>
                                </div>

								
								
							  <div class="row clearfix">
                                    <div class="col-lg-5 col-md-5  form-control-label">
                                        <label for="email_address_2" class="col-black">TAGIHAN UNTUK TINGKAT</label>
                                    </div>
                                    <div class="col-lg-6 col-md-6  ">
                                        <div class="form-group">
                                            <div class="form-line">
                                       

										<?php
										$tk[1]="Tingka X (Sepuluh)";
										$tk[2]="Tingka XI (Sebelas)";
										$tk[3]="Tingka XII (Dua belas)";
										 
										echo form_dropdown("id_tk",$tk,$get->id_tk,"class='form-control' id='tingkat2'  ");
										?>										
                                            </div>
                                        </div>
                                    </div>
                                </div>

							 
								
								<div class="row clearfix">
                                    <div class="col-lg-5 col-md-5  form-control-label">
                                        <label for="email_address_2" class="col-black">TAGIHAN UNTUK JURUSAN</label>
                                    </div>
                                    <div class="col-lg-6 col-md-6  ">
                                        <div class="form-group">
                                            <div class="form-line" id="data_mapel">
                                         
										<?php
										$id_jurusan="";
										$dbs=$this->db->get("tr_jurusan")->result();
										$id_jurusan[]="Semua Jurusan";
										foreach($dbs as $val)
										{
											$id_jurusan[$val->id]=$val->alias;
										}?>
										 
										<?php 
										echo form_dropdown("id_jurusan",$id_jurusan,$get->id_jurusan,"class='form-control' id='id_jurusan'  ");
										?>		
                                            </div>
                                        </div>
                                    </div>
                                </div>
								
								
   
  
					 
 
                      