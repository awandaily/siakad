
<!DOCTYPE html>
<html lang="en-US" prefix="og: https://ogp.me/ns#">
   <meta http-equiv="content-type" content="text/html;charset=UTF-8" />
   <head>
	<?php echo $this->load->view("blog/head");?>
   </head>
   <body class="page-template page-template-template-front-fullslider page-template-template-front-fullslider-php page page-id-6593 siteorigin-panels siteorigin-panels-before-js header-transparent">
		<div class="layout-boxed">
         <header class="header">
            <?php echo $this->load->view("blog/topbar");?>
            <div id="myHeader" class="navigation-wrapper panelheader">
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
         
			<div class="page-header pageheader" style="text-align: center;">
			   <div class="container">
				  <div class="row">
					 <div class="col-md-12">
						<h1 class="main-title"style="color:#f4f4f4"><?php echo isset($title1)?($title1):''; ?></h1>
						<h3 class="sub-title"style=""><?php echo isset($title2)?($title2):''; ?></h3>
					 </div>
				  </div>
			   </div>
			</div>
			<div class="breadcrumbs">
			   <div class="container">
				  <!-- Breadcrumb NavXT 6.0.4 -->
				  <span property="itemListElement" typeof="ListItem">
					 <a property="item" typeof="WebPage" title="Go to The Landscaper." href="<?php echo base_url()?>" class="home"><span property="name">Home</span></a>
					 <meta property="position" content="1">
				  </span>
				  <span property="itemListElement" typeof="ListItem">
					 <span property="name"><?php echo isset($title1)?($title1):''; ?></span>
					 <meta property="position" content="2">
				  </span>
			   </div>
			</div>
			<div class="content">
			   <div class="container">
					<div class="pagetent">
					<?php $this->load->view($konten)?>
					</div>
			   </div>
			</div>
	  <?php echo $this->load->view('blog/footer')?>
      </div><!-- end layout boxed wrapper -->
	  <?php echo $this->load->view('blog/foot')?>
   </body>
</html>
	
	