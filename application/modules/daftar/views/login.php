<?php
    $site_key = '6LfB0FQUAAAAABBPln58TZq83wpYk66VHa4xNKL-';  
    $secret_key = '6LfB0FQUAAAAAKacaSP7Fl-ruBCobH4S9EgsDMNU'; 
?>
 
<style> 
#rc-imageselect {transform:scale(0.83);-webkit-transform:scale(0.83);transform-origin:0 0;-webkit-transform-origin:0 0;}  
 </style>
   	 	<article class="post-5268 page type-page status-publish hentry">
				<center>
						<div id="pl-5268"  class="panel-layout" style="max-width:400px">
						<div id="pg-5268-0"  class=" " >
						<div id="pgc-5268-0-0"  class="panel-grid-cell" >
						<div id="panel-5268-0-0-0" class="so-panel widget widget_black-studio-tinymce widget_black_studio_tinymce panel-first-child" data-index="0" ><div class="content-box panel-widget-style panel-widget-style-for-5268-0-0-0" >
						<h3 class="widget-title"><span class="light">Silahkan </span> Login </h3>
						<span id="msg"></span>
						<div class="textwidget">
						<p>
						<form id="formlogin" action="javascript:login()">
						<div class="col-xs-12 col-md-12">
						<span> <span class="wpcf7-form-control-wrap your-name">
						<input type="text" required name="username" value="" size="40" class="wpcf7-form-control wpcf7-text wpcf7-validates-as-required" aria-required="true" aria-invalid="false" placeholder="Username" />
						</span></span>
						</div>
						
						<div class="col-xs-12 col-md-12" style="margin-top:-20px">
						<span> <span class="wpcf7-form-control-wrap your-name">
						<input type="password" required name="password" value="" size="40" class="wpcf7-form-control wpcf7-text wpcf7-validates-as-required" aria-required="true" aria-invalid="false" placeholder="Password" />
						</span></span>
						</div>
						
				<!--		<div class="col-xs-12 col-md-12" style="margin-top:-13px">
						<div id="rc-imageselect" class="g-recaptcha" data-sitekey="<?php echo $site_key; ?>"  > </div>
						</div>-->
						
							<div class="col-xs-12 col-md-12" style="margin-top:-13px">
							    						<div class="input-group" style='padding-bottom:5px'>
                                                        <span class="input-group-addon">
                                                        <img src="<?php echo base_url()?>daftar/captcha" style="margin-left:3px;min-width:54px">
                                                        </span>
                                                        <input type="text" class="form-control" required name="captcha" style="min-height:40px" placeholder="Tulis nomor disamping">
                                                        </div>
							</div>
							
							

						
						
						<center>
						<button style="padding:10px;width:90%;background-color:green"><span style="margin-top:-10px">Login</span></button>
						</center>
						</form>
						</p>
						 <center><a href="javascript:forgot()" style="font-size:17px">Lupa Password?</a></center>
 
</div></div></div>

 </div> </div> </div>	</center>
			</article>
<script src='https://www.google.com/recaptcha/api.js'></script>	
  <link href="<?php echo base_url()?>static/js/alertify/css/alertify.css" rel="stylesheet">
 <script>
 function login()
{

$('#msg').html("<img src='<?php echo base_url();?>plug/img/load.gif'> Please wait...");
	$.ajax({
	url:"<?php echo base_url();?>daftar/cekLogin",
	type: "POST",
    data: $('#formlogin').serialize(),
	dataType: "JSON",
	 success: function(data)
            {
			
               //if success close modal and reload ajax table
			   if(data["upass"]==false){
                  $('#msg').html("<i class='fa fa-warning'></i> Username/Password Salah!"); return false;
               }
               
               if(data["captca"]==false){
                 $('#msg').html("<i class='fa fa-warning'></i> Nomor yang anda masukan tidak sama");  return false;
               }
               
			   
			   if(data["validasi"]==true){
			 	    $('#msg').html("<img src='<?php echo base_url();?>plug/img/load.gif'> Success!"); 
				    window.location.href="<?php echo base_url();?>"+data["direct"]; 
			   }else{
			        window.location.href="<?php echo base_url();?>login/logout"; 
			   }
			   
	 		    
			   
			   
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                alert('Try Again!');
            }
	});
 
}

 
    
   function forgot(id=null,artikel=null){
		 alertify.genericDialog || alertify.dialog('genericDialog',function(){
    return {
        main:function(content){
            this.setContent(content);
        },
        setup:function(){
            return {
                focus:{
                    element:function(){
                        return this.elements.body.querySelector(this.get('selector'));
                    },
                    select:true
                },
                options:{
                    basic:true,
                    maximizable:false,
                    resizable:false,
                    padding:false
                }
            };
        },
        settings:{
            selector:undefined
        }
    };
});
//force focusing password box
alertify.genericDialog ($('#loginForm')[0]).set('selector', 'input[type="password"]');
	  };
 
</script>

 	<script src="<?php echo base_url()?>static/js/alertify/alertify.js"></script>
 	
 	
 	
 	<div style="display:none">
<div class="modal-body" id="loginForm">
                
                
                    <h4>Resset Password</h4>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Email</label>
                      <input type="email" name='uemail' class="form-control"
                      id="exampleInputEmail1" placeholder="Enter email"/>
                  </div>
                  <div class="form-group">
                    <label for="exampleInputPassword1">Hp</label>
                      <input type="text" name='uhp' class="form-control"
                          id="exampleInputPassword1" placeholder="Nomor Hp"/>
                  </div>
               <center>   <button style="padding:10px;width:90%;background-color:green" onclick="resset()" > <i class="fa fa-refresh"></i> Resset </button>  
               <p id="umsg"></p>
               </center>
         
                
                
            </div>
       </div>        
            <!-- Modal Footer -->
            
    <script>
        function resset()
        {
            var email=$("[name='uemail']").val();
             var hp=$("[name='uhp']").val();
            
             if(email=="" || hp=="")
             {
                  $('#umsg').html("Silahkan isi email dan hp!");
                  return false;
             }
             $('#umsg').html("<img src='<?php echo base_url();?>plug/img/load.gif'> Please wait...");
        	$.ajax({
        	url:"<?php echo base_url();?>daftar/resset",
        	type: "POST",
        	data:"uemail="+email+"&hp="+hp,
        	 success: function(data)
            {
                $("#umsg").html(data);
            }});
        }
    </script>        
            