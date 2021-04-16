

<!DOCTYPE html>
<html lang="en-US" prefix="og: https://ogp.me/ns#">
   <meta http-equiv="content-type" content="text/html;charset=UTF-8" />
   <head>
      <?php echo $this->load->view("blog/head");?>
   </head>
   <body class="page-template page-template-template-front-fullslider page-template-template-front-fullslider-php page page-id-6593 siteorigin-panels siteorigin-panels-before-js header-transparent">
      <div class="layout-boxed">
         <header class="header header-transparent">
			<?php echo $this->load->view("blog/topbar");?>
            <div id="myHeader" class="navigation-wrapper">
               <div class="container">
                  <div class="navigation" aria-label="Main Menu">
                     <div class="navbar-header">
                        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                        <span class="navbar-toggle-text">MENU</span>
                        <span class="navbar-toggle-icon">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        </span>
                        </button>
                        <a href="<?php echo base_url()?>" class="navbar-brand logopublik">
                        <img src="<?php echo base_url()?>plug/img/logonew.png"/>
                        </a>
                     </div>
                     <nav id="navbar" class="collapse navbar-collapse">
                        <?php echo $this->load->view("blog/menu");?>
                     </nav>
                  </div>
               </div>
            </div>
            <div class="sticky-offset"></div>
         </header>
         <div class="jumbotron carousel slide carousel-touch carousel-slide" id="jumbotron-fullwidth" data-ride="carousel" data-interval="6000" data-pause="false">
            <div class="carousel-inner">
               <?php echo $this->load->view("blog/slider");?>
            </div>
         </div>

         <div class="content">
            <div class="container" >
				<?php $this->load->view($konten)?>
            </div>
         </div>

      <?php echo $this->load->view('blog/footer')?>
      </div><!-- end layout boxed wrapper -->
	  <?php echo $this->load->view('blog/foot')?>
   </body>
</html>


