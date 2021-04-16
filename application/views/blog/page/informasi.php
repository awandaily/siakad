
	<script src="//netdna.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
		<div class="col-md-12" >
			<h3 class="widget-title">
			   <span class="light">Page</span> Informasi 
			</h3>
		</div>
		<div class="col-md-12" >
			<style>
			.with-nav-tabs.panel-primary .nav-tabs > li > a,
			.with-nav-tabs.panel-primary .nav-tabs > li > a:hover,
			.with-nav-tabs.panel-primary .nav-tabs > li > a:focus {
				color: #333333;
			}
			.with-nav-tabs.panel-primary .nav-tabs > .open > a,
			.with-nav-tabs.panel-primary .nav-tabs > .open > a:hover,
			.with-nav-tabs.panel-primary .nav-tabs > .open > a:focus,
			.with-nav-tabs.panel-primary .nav-tabs > li > a:hover,
			.with-nav-tabs.panel-primary .nav-tabs > li > a:focus {
				color: #fff;
				background-color: #3071a9;
				border-color: transparent;
			}
			.with-nav-tabs.panel-primary .nav-tabs > li.active > a,
			.with-nav-tabs.panel-primary .nav-tabs > li.active > a:hover,
			.with-nav-tabs.panel-primary .nav-tabs > li.active > a:focus {
				color: #428bca;
				background-color: #fff;
				border-color: #428bca;
				border-bottom-color: transparent;
			}
			.with-nav-tabs.panel-primary .nav-tabs > li.dropdown .dropdown-menu {
				background-color: #428bca;
				border-color: #3071a9;
			}
			.with-nav-tabs.panel-primary .nav-tabs > li.dropdown .dropdown-menu > li > a {
				color: #fff;   
			}
			.with-nav-tabs.panel-primary .nav-tabs > li.dropdown .dropdown-menu > li > a:hover,
			.with-nav-tabs.panel-primary .nav-tabs > li.dropdown .dropdown-menu > li > a:focus {
				background-color: #3071a9;
			}
			.with-nav-tabs.panel-primary .nav-tabs > li.dropdown .dropdown-menu > .active > a,
			.with-nav-tabs.panel-primary .nav-tabs > li.dropdown .dropdown-menu > .active > a:hover,
			.with-nav-tabs.panel-primary .nav-tabs > li.dropdown .dropdown-menu > .active > a:focus {
				background-color: #4a9fe9;
			}
			</style>
			<div class="panel with-nav-tabs panel-primary">
                <div class="panel-heading">
                        <ul class="nav nav-tabs">
                            <li class="active"><a href="#tab1primary" data-toggle="tab">Primary 1</a></li>
                            <li><a href="#tab2primary" data-toggle="tab">Primary 2</a></li>
                            <li><a href="#tab3primary" data-toggle="tab">Primary 3</a></li>
                            <li class="dropdown">
                                <a href="#" data-toggle="dropdown">Dropdown <span class="caret"></span></a>
                                <ul class="dropdown-menu" role="menu">
                                    <li><a href="#tab4primary" data-toggle="tab">Primary 4</a></li>
                                    <li><a href="#tab5primary" data-toggle="tab">Primary 5</a></li>
                                </ul>
                            </li>
                        </ul>
                </div>
                <div class="panel-body">
                    <div class="tab-content" style="padding:10px;">
                        <div class="tab-pane fade in active" id="tab1primary">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's 
						 standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make 
						 a type specimen book. It has survived not only five centuries</div>
                        <div class="tab-pane fade" id="tab2primary">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's 
						 standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make 
						 a type specimen book. It has survived not only five centuries</div>
                        <div class="tab-pane fade" id="tab3primary">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's 
						 standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make 
						 a type specimen book. It has survived not only five centuries</div>
                        <div class="tab-pane fade" id="tab4primary">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's 
						 standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make 
						 a type specimen book. It has survived not only five centuries</div>
                        <div class="tab-pane fade" id="tab5primary">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's 
						 standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make 
						 a type specimen book. It has survived not only five centuries</div>
                    </div>
                </div>
            </div>
			<br><br>
				
			<style>
			.nav-sidebar-tabs { 
				width: 100%;
				height:400px;
				padding: 30px 0; 
				border-right: 1px solid #ddd;
			}
			.nav-sidebar-tabs a {
				color: #333;
				-webkit-transition: all 0.08s linear;
				-moz-transition: all 0.08s linear;
				-o-transition: all 0.08s linear;
				transition: all 0.08s linear;
			}
			.nav-sidebar-tabs .active a { 
				background-color: #4687bf; 
				color: #fff; 
			}
			.nav-sidebar-tabs .active a:hover {
				background-color: #E50000;   
			}
			.container-tab .text-style
			{
			  text-align: justify;
			  line-height: 23px;
			  margin: 0 13px 0 0;
			  font-size: 14px;
			  color:#545454;
			}
			.text-style h2{color:#4687bf;}
			</style>
			
			<div class="container-tab">
				<div class="col-sm-2">
				<nav class="nav-sidebar-tabs">
					<ul class="nav tabs">
					  <li class="active"><a href="#tab1" data-toggle="tab">Informasi satu</a></li>
					  <li class=""><a href="#tab2" data-toggle="tab">Informasi dua</a></li>
					  <li class=""><a href="#tab3" data-toggle="tab">Informasi tiga</a></li>                               
					</ul>
				</nav>
				</div>
				<!-- tab content -->
				<div class="tab-content">
					<div class="tab-pane active text-style" id="tab1">
					  <h2>Informasi Satu</h2>
					   <p>
						 Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's 
						 standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make 
						 a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining 
						 essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, 
						 and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.  
					   </p>
						<p>
						 Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's 
						 standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make 
						 a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining 
						 essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, 
						 and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.  
					   </p>
					</div>
					<div class="tab-pane text-style" id="tab2">
					  <h2>Informasi Dua</h2>
					   <p>Dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt 
						ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo 
						dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. 
						Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore 
						et dolore magna aliquyam erat, sed diam voluptua.</p>
						<p>Dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt 
						ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo 
						dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. 
						Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore 
						et dolore magna aliquyam erat, sed diam voluptua.</p>
					</div>
					<div class="tab-pane text-style" id="tab3">
					  <h2>Informasi Tiga</h2>
					  <p>Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. Duis autem vel eum 
						iriure dolor in hendrerit in vulputate velit esse molestie consequat, vel illum dolore eu feugiat nulla 
						facilisis at vero eros et accumsan et iusto odio dignissim qui blandit praesent luptatum zzril delenit 
						augue duis dolore te feugait nulla facilisi. Lorem ipsum dolor sit amet,</p>
						<p>Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. Duis autem vel eum 
						iriure dolor in hendrerit in vulputate velit esse molestie consequat, vel illum dolore eu feugiat nulla 
						facilisis at vero eros et accumsan et iusto odio dignissim qui blandit praesent luptatum zzril delenit 
						augue duis dolore te feugait nulla facilisi. Lorem ipsum dolor sit amet,</p>
					  </div>
					</div>
				</div>
			</div>
			<br><br>
			

		</div>
	
