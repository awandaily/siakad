<?php $con = new konfig();
$this->m_reff->counter();
?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w==" crossorigin="anonymous" />
  <title>Sign in and Signup</title>

  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/login/style.css" />
</head>

<body>
  <div class="container">
    <div class="forms-container">
      <div class="signin-signup">
        <form id="formlogin" action="javascript:login()" class="sign-in-form">
          <h2 class="title">Sign In</h2>
          <div class="input-field">
            <i class="fas fa-user"></i>
            <input type="text" name="username" placeholder="Username" />
          </div>
          <div class="input-field">
            <i class="fas fa-lock"></i>
            <input type="password" name="password" placeholder="Password" />
          </div>
          <input type="submit" class="btn solid" value="Login" />
          <p class="social-text" id="msg">Or Sigin With social Media</p>
          <div class="social-media">
            <a href="#" class="social-icon">
              <i class="fab fa-facebook-f"></i>
            </a>
            <a href="#" class="social-icon">
              <i class="fab fa-twitter"></i>
            </a>
            <a href="#" class="social-icon">
              <i class="fab fa-google"></i>
            </a>
            <a href="#" class="social-icon">
              <i class="fab fa-linkedin-in"></i>
            </a>
          </div>
        </form>
        <form action="#" class="sign-up-form">
          <h2 class="title">Sign Up</h2>
          <div class="input-field">
            <i class="fas fa-user"></i>
            <input type="text" placeholder="Username" />
          </div>
          <div class="input-field">
            <i class="fas fa-envelope"></i>
            <input type="email" placeholder="Email" />
          </div>
          <div class="input-field">
            <i class="fas fa-lock"></i>
            <input type="password" placeholder="Password" />
          </div>
          <input type="submit" class="btn solid" value="Daftar" />
          <p class="social-text">Or Sign Up With social Media</p>
          <div class="social-media">
            <a href="#" class="social-icon">
              <i class="fab fa-facebook-f"></i>
            </a>
            <a href="#" class="social-icon">
              <i class="fab fa-twitter"></i>
            </a>
            <a href="#" class="social-icon">
              <i class="fab fa-google"></i>
            </a>
          </div>
        </form>
      </div>
    </div>

    <div class="panels-container">
      <div class="panel left-panel">
        <div class="content">
          <h3>New Here?</h3>
          <p>
            Lorem ipsum dolor sit amet consectetur adipisicing elit.
            Repudiandae, sapiente!
          </p>
          <button class="btn transparent" id="sign-up-button">Sign Up</button>
        </div>
        <img src="<?php echo base_url(); ?>assets/login/img/register.svg" alt="log" class="image" />
      </div>
      <div class="panel right-panel">
        <div class="content">
          <h3>One of Us?</h3>
          <p>
            Lorem ipsum dolor sit amet consectetur adipisicing elit.
            Repudiandae, sapiente!
          </p>
          <button class="btn transparent" id="sign-in-button">Sign In</button>
        </div>
        <img src="<?php echo base_url(); ?>assets/login/img/log.svg" alt="log" class="image" />
      </div>
    </div>
  </div>
  <script src="<?php echo base_url(); ?>assets/login/app.js"></script>
</body>

</html>

<!-- Jquery Core Js -->
<script src="<?php echo base_url() ?>assets/jquery/jquery.min.js"></script>
<script>
  function login() {
    $('#msg').html("<img src='<?php echo base_url(); ?>plug/img/load.gif'> Please wait...");
    $.ajax({
      url: "<?php echo base_url(); ?>login/cekLogin",
      type: "POST",
      data: $('#formlogin').serialize(),
      dataType: "JSON",
      success: function(data) {

        //if success close modal and reload ajax table
        if (data["upass"] == false) {
          $('#msg').html("<i class='col-red'></i> Username/Password Salah!");
          return false;
        }

        if (data["captca"] == false) {
          $('#msg').html("<i class='fa fa-warning'></i> Nomor yang anda masukan tidak sama");
          return false;
        }


        if (data["validasi"] == true) {
          $('#msg').html('<i class="material-icons col-green">done_all</i> <span style="font-size:12px;position:absolute;margin-top:4px"> &nbsp;Berhasil !! Mohon tunggu....</span>');

          window.location.href = "<?php echo base_url(); ?>" + data["direct"];
        } else {
          window.location.href = "<?php echo base_url(); ?>login/logout";
        }




      },
      error: function(jqXHR, textStatus, errorThrown) {
        alert('Try Again!');
      }
    });

  }
</script>