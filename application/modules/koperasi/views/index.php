<div class="row clearfix">
               
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                    <div class="info-box bg-cyan hover-expand-effect">
                        <div class="icon">
                            <i class="material-icons">account_balance_wallet</i>
                        </div>
                        <div class="content">
                            <div class="text">TOTAL PINJAMAN</div>
                            <div class="number count-to" data-from="0" data-to="257" data-speed="1000" data-fresh-interval="20">Rp <?php echo number_format($this->mdl->jmlPinjaman(),0,",",".");?></div>
                        </div>
                    </div>
                </div>
              
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                    <div class="info-box bg-light-green hover-expand-effect">
                        <div class="icon">
                            <i class="material-icons">account_balance_wallet</i>
                        </div>
                        <div class="content">
                            <div class="text">TOTAL SIMPANAN</div>
                            <div class="number count-to" data-from="0" data-to="1225" data-speed="1000" data-fresh-interval="20">Rp <?php echo number_format($this->mdl->jmlSimpanan(),0,",",".");?></div>
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
                                            <th>NAMA SIMPANAN</th>
                                            <th>JUMLAH SIMPANAN</th>
                                            </tr>
                                    </thead>
                                    <tbody>
									<?php
									$data=$this->db->get("keu_tr_stssimpanan")->result();$no=1;
									foreach($data as $val){?>
                                        <tr>
                                            <td><?php echo $no++;?></td>
                                            <td><?php echo $val->nama;?></td>
                                            <td>Rp <?php echo number_format($this->mdl->jmlSimpanan($val->id),0,",",".");?></td>
                                             
                                        </tr>
									<?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>	




				
                </div>					
						
						
						
 