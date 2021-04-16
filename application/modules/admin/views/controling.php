<?php $con=new konfig(); $dp=$con->dataProfile($this->session->userdata("id")); ?> 
<script src="<?php echo base_url()?>plug/js/jquery-2.2.1.min.js"></script>
<script src="<?php echo base_url();?>plug/jqueryform/jquery.form.js"></script>

<div class="row" id="user-profile">
<div class="col-lg-12 col-md-12 col-sm-12" >
<div class="main-box clearfix">
<header class="main-box-header clearfix"><center>
<h2><b>CONTROLING</b></h2></center>
</header>
<div class="main-box-body clearfix" id="controking">
 

</div>
</div>
</div>
<script>
setInterval(function(){ getData("<?php echo base_url()?>admin/getControling"); }, 3000);
</script>