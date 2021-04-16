<div class="row clearfix">
               
                <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                    <div class="info-box bg-teal hover-expand-effect">
                        <div class="icon">
                            <i class="material-icons">account_balance_wallet</i>
                        </div>
                        <div class="content">
                            <div class="text">TOTAL GROUP KELAS</div>
                            <div class="number count-to" data-from="0" data-to="257" data-speed="1000" data-fresh-interval="20">  <?php echo number_format($this->mdl->jmlGroup(),0,",",".");?></div>
                        </div>
                    </div>
                </div>
              
                <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                    <div class="info-box bg-light-green hover-expand-effect">
                        <div class="icon">
                            <i class="material-icons">account_balance_wallet</i>
                        </div>
                        <div class="content">
                            <div class="text">TOTAL ANGGOTA</div>
                            <div class="number count-to" data-from="0" data-to="1225" data-speed="1000" data-fresh-interval="20">  <?php echo number_format($this->mdl->jmlAnggota(),0,",",".");?></div>
                        </div>
                    </div>
                </div>
             <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                    <div class="info-box bg-blue hover-expand-effect">
                        <div class="icon">
                            <i class="material-icons">account_balance_wallet</i>
                        </div>
                        <div class="content">
                            <div class="text">TOTAL PERTEMUAN</div>
                            <div class="number count-to" data-from="0" data-to="1225" data-speed="1000" data-fresh-interval="20">  <?php echo number_format($this->mdl->jmlPertemuan(),0,",",".");?></div>
                        </div>
                    </div>
                </div>
           
 
						
	  
						
						
						
	<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <div class="card">
                       
                        <div class="body">
                            <div class="table-responsive">
                                <table class="table table-hover dashboard-task-infos">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>  GROUP KELAS</th>
                                            <th>JUMLAH ANGGOTA</th>
                                            </tr>
                                    </thead>
                                    <tbody>
									<?php
									$data=$this->db->get_where("eskul_group",array("id_eskul"=>$this->mdl->ids()))->result();$no=1;
									foreach($data as $val){?>
                                        <tr>
                                            <td><?php echo $no++;?></td>
                                            <td><?php echo $val->nama;?></td>
                                            <td>  <?php echo number_format($this->mdl->jmlAnggota($val->id),0,",",".");?></td>
                                             
                                        </tr>
									<?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>	




				
                </div>					
						
						
						
 