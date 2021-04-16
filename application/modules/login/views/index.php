<?php $con=new konfig(); 
 $this->m_reff->counter();
?>

<style type="text/css">
@font-face {
  font-family: 'Oswald';
  font-style: normal;
  font-weight: 450;
  font-display: swap;
  src: url(<?php echo base_url()?>assets/css/font.woff2) format('woff2');
}
    .body-bg{
      
   
     
    }
    .login-page{
      background: transparent !important;
    }
    .img-me{
      width: 70px;
      line-height: 110px;
      margin-top: 20px;
    }
    .img-wa{
      width: 110px;
      height: 110px;
      background-color:rgba(255, 255, 255, 0.8);
      border-radius: 100%;
    }

    .login-judul{
      font-size:25px;
      color:white;
      font-family: Oswald;
      -webkit-text-stroke-width: 0.2px;
      -webkit-text-stroke-color: black;
    }
    .inp-me{
      background: transparent;
     
    }
    .input-group .form-line{
       border-color:#009688;
    }
    .login-page{
      max-width: 400px;
    }

</style>
<body class="body-bg" style=" background: url(<?php echo base_url() ?>file_upload/img/<?php echo $this->m_reff->tm_pengaturan(11);?>)  fixed;
background-size: cover;">
<div class="login-box login-page  ">
    <div class="logo col-orange ">
        <center>
            <h1 class='img-wa'>
              <img src="<?php echo base_url();?>file_upload/img/<?php echo $this->m_reff->tm_pengaturan(10);?>" class="img-me">
            </h1>
            <p class='sadow login-judul col-yellowl'> <?php echo $this->m_reff->tm_pengaturan(7);?></p>
        </center>
    </div>
       <div class="card " style='max-width:94%;margin-left:10px;background-color:rgba(255, 255, 255, 0.8);'>
        <div class="body">
            
                <form id="formlogin" method="POST" action="javascript:login()">
                    <div class="msg col-deep-orange">Sign in to start your session</div>
                   <div class="input-group">
                    <span class="input-group-addon">
                            <i class="material-icons" style="color:#009688">person</i>
                        </span>
                    <div class="form-line">
                        <input type="text" class="form-control inp-me" name="username" placeholder="Username" required autofocus>
                    </div>
                </div>
                <div class="input-group">
                    <span class="input-group-addon">
                            <i class="material-icons" style="color:#009688">lock</i>
                        </span>
                    <div class="form-line">
                        <input type="password" class="form-control inp-me" name="password" placeholder="Password" required>
                    </div>
                </div>

                    
                    
                    <div class="row">
                        <div id="msg" class="col-xs-12 p-t-5">
                        
                        </div>
                         
                        
                        <div class="col-xs-12">
                            <button class="btn btn-block bg-indigo waves-effect" type="submit">
                            
                                    <i class="material-icons">verified_user</i>
                                    <span>MASUK </span>
                                
                            </button>
                        </div>
                    </div>
                    <div class="row m-t-15 m-b--20" style="margin-top:-30px">
                        
                        <div class="col-xs-12" onclick="forgot()">
                        <center>    <a href="#" class=" col-pink">Lupa Password ?</a> </center>
                        </div>
                    <!--    <div class="col-xs-12 col-md-12   col-pink">
                            <a href="<?php echo base_url()?>login_ortu" class='col-pink'><u>AKSES ORANG TUA SISWA SILAHKAN KLIK DISINI</u></a>
                        </div>-->
                    </div>
                </form>
            </div>
        </div> 
  <div style="display: block;padding: 5px; ">
      <center><a target="_blank" href='<?php echo base_url()?>buku'><label class='sadow' style="color:white;line-height: 5px;">Powered by SIMASTER </label></a></center>
    </div>
    </div>
    
</body>

<?php
	$mobile=$this->m_reff->mobile();
	if($mobile)
	{?> <br><br> 
	<a href="<?php echo base_url();?>tutupapp" class='col-white sadow' style="bottom:0"><center> close</center></a>
	<?php } ?>
 
 <link href="<?php echo base_url()?>static/js/alertify/css/alertify.css" rel="stylesheet">
 <script>
  
  
 function login()
{

$('#msg').html("<img src='<?php echo base_url();?>plug/img/load.gif'> Please wait...");
	$.ajax({
	url:"<?php echo base_url();?>login/cekLogin",
	type: "POST",
    data: $('#formlogin').serialize(),
	dataType: "JSON",
	 success: function(data)
            {
			
               //if success close modal and reload ajax table
			   if(data["upass"]==false){
                  $('#msg').html("<i class='col-red'></i> Username/Password Salah!"); return false;
               }
               
               if(data["captca"]==false){
                 $('#msg').html("<i class='fa fa-warning'></i> Nomor yang anda masukan tidak sama");  return false;
               }
               
			   
			   if(data["validasi"]==true){
				$('#msg').html('<i class="material-icons col-green">done_all</i> <span style="font-size:12px;position:absolute;margin-top:4px"> &nbsp;Berhasil !! Mohon tunggu....</span>'); 
				 
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

 
    
   function forgot(){
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
                
                
                 <Center>   <p><b>Silahkan masukan No.Hp anda !!</b></p></center>
                
                 <div class="row clearfix">
                                    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-2 form-control-label">
                                     No.HP
                                    </div>
                                    <div class="col-lg-10 col-md-10 col-sm-8 col-xs-10">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <input type="text" id="email_address_2" class="form-control" name='uhp' >
                                            </div>
                                        </div>
                                    </div>
                                </div>
               <center>   <button class="waves-effect btn bg-indigo" onclick="resset()" > <i class="material-icons">autorenew</i> Kirim Password </button>  
               <p id="umsg" class='col-pink' style='font-size:14px'></p><br>
			   <a style='font-size:14px;margin-left:-70px;' href="https://api.whatsapp.com/send?phone=<?php echo $this->m_reff->pengaturan(10);?>&text=Halo Admin, saya mengalami kendala untuk login!" >
			   <i class="material-icons" style='font-size:16px'>help_outline</i> <span style='position:absolute;margin-top:-2px'>Help desk</span></a>
               </center>
         
                
                
            </div>
       </div>        
            <!-- Modal Footer -->
            
    <script>
        function resset()
        {
            
             var hp=$("[name='uhp']").val();
            
             if(hp=="")
             {
                  $('#umsg').html("Silahkan isi Nomor hp!");
                  return false;
             }
             $('#umsg').html("<img src='<?php echo base_url();?>plug/img/load.gif'> Please wait...");
        	$.ajax({
        	url:"<?php echo base_url();?>login/resset",
        	type: "POST",
        	data:"&hp="+hp,
        	 success: function(data)
            {
                $("#umsg").html(data);
            }});
        }
    </script>     

 
            