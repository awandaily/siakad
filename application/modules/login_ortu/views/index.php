<?php $con=new konfig(); ?>


<body class="login-page">
    <div class="login-box login-page">
        <div class="logo col-orange">
            <a href="javascript:void(0);"><b> SMK BK SUBANG</b></a>
            <small>SISTEM INFORMASI AKADEMIK</small>
        </div>
        <div class="card">
            <div class="body">
                <form id="formlogin" method="POST" action="javascript:login()">
                    <div class="msg col-orange">Selamat datang !!</div>
                    <div class="input-group">
                        <span class="input-group-addon">
                            <i class="material-icons">person</i>
                        </span>
                        <div class="form-line">
                            <input type="text" class="form-control" name="username" placeholder="Username" required autofocus>
                        </div>
                    </div>
                    <div class="input-group">
                        <span class="input-group-addon">
                            <i class="material-icons">lock</i>
                        </span>
                        <div class="form-line">
                            <input type="password" class="form-control" name="password" placeholder="Password" required>
                        </div>
                    </div>

				 
                         
							    						 
						 
                  
					
					
                    <div class="row">
                        <div id="msg" class="col-xs-8 p-t-5">
                            
                        </div>
                        <div class="col-xs-4">
                            <button class="btn btn-block bg-indigo waves-effect" type="submit">
							
                                    <i class="material-icons">verified_user</i>
                                    <span>LOGIN</span>
                                
							</button>
                        </div>
                    </div>
                    <div class="row m-t-15 m-b--20" style="margin-top:-30px">
                        
                        <div class="col-xs-6 align-right col-pink">
                            <a href="#">Lupa Password?</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>


 
 <link href="<?php echo base_url()?>static/js/alertify/css/alertify.css" rel="stylesheet">
 <script>
 function login()
{

$('#msg').html("<img src='<?php echo base_url();?>plug/img/load.gif'> Please wait...");
	$.ajax({
	url:"<?php echo base_url();?>login_ortu/cekLogin",
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
			 	    $('#msg').html("<img src='<?php echo base_url();?>plug/img/load.gif'> Success!"); 
				    window.location.href="<?php echo base_url();?>"+data["direct"]; 
			   }else{
			        window.location.href="<?php echo base_url();?>login_ortu/logout"; 
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
        	url:"<?php echo base_url();?>login_ortu/resset",
        	type: "POST",
        	data:"uemail="+email+"&hp="+hp,
        	 success: function(data)
            {
                $("#umsg").html(data);
            }});
        }
    </script>        
            