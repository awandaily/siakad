 <!-- main-content opened -->
 <!-- breadcrumb -->
 <div class="breadcrumb-header justify-content-between">
     <div>
         <h4 class="content-title mb-2"></h4>
         <nav aria-label="breadcrumb">
             <ol class="breadcrumb">
                <BR>
             </ol>
         </nav>
     </div>

 </div>




 <?php
    $id = $this->mdl->idu();
    $pesan = $this->db->query("select * from data_pesan where id_guru='" . $id . "' and sts_baca=0")->result();
    $no = 0;
    $isi = "";
    foreach ($pesan as $pesan) {
        $no = 1;

        $isi .= "<div style='border:black solid 1px;padding:10px' id='id$pesan->id'>
    <div class='col-teal'><b>$pesan->judul</b></div>
    <div style='text-align:justify'>$pesan->pesan</div>
    <div><i class='col-deep-orange' style='font-size:12px'>Dikirim oleh :$pesan->pengirim</i></div>
    <div><i class='col-blue-grey' style='font-size:11px'>" . $this->tanggal->hariLengkap(substr($pesan->_ctime, 0, 10), "/") . " " . substr($pesan->_ctime, 10, 10) . " </i></div>
    <button class='btn bg-pink btn-block' onclick='hapus_pesan($pesan->id)'>Hapus pesan ini </button>
    </div><div class='col-md-12 clearfix'><br></div>
    ";
    }
    if ($no == 1) { ?>
     <script>
         setTimeout(function() {
             showing();
         }, 1000);
     </script>

 <?php }
    ?>

 <script>
     function hapus_pesan(id) {
         alertify.confirm("<center>Hapus ?</center>", function() {
             $.post("<?php echo base_url() ?>gdashboard/hapus_pesan", {
                 id: id
             }, function() {
                 $("#modalGrafik").modal("hide");
             })
         })
     }

     function showing() {
         $("#modalGrafik").modal({
             backdrop: 'static',
             keyboard: false
         });
         $("#myModalLabel").html("PESAN MASUK");
         $("#isiGrafik").html(`<?php echo $isi; ?>`);
     }
 </script>




 <?php $token = date("His") ?>


 <div class="main-content-body">
					<div class="row row-sm">
						<div class="col-xl-4 col-lg-6 col-md-6 col-sm-12">
							<div class="card overflow-hidden project-card">
								<div class="card-body">
									<div class="d-flex">
										<div class="my-auto">
											<svg enable-background="new 0 0 469.682 469.682" version="1.1"  class="mr-4 ht-60 wd-60 my-auto primary" viewBox="0 0 469.68 469.68" xml:space="preserve" xmlns="http://www.w3.org/2000/svg">
                                            path d="m347.97 57.503h-39.706v-17.763c0-5.747-6.269-8.359-12.016-8.359h-30.824c-7.314-20.898-25.6-31.347-46.498-31.347-20.668-0.777-39.467 11.896-46.498 31.347h-30.302c-5.747 0-11.494 2.612-11.494 8.359v17.763h-39.707c-23.53 0.251-42.78 18.813-43.886 42.318v299.36c0 22.988 20.898 39.706 43.886 39.706h257.04c22.988 0 43.886-16.718 43.886-39.706v-299.36c-1.106-23.506-20.356-42.068-43.886-42.319zm-196.44-5.224h28.735c5.016-0.612 9.045-4.428 9.927-9.404 3.094-13.474 14.915-23.146 28.735-23.51 13.692 0.415 25.335 10.117 28.212 23.51 0.937 5.148 5.232 9.013 10.449 9.404h29.78v41.796h-135.84v-41.796zm219.43 346.91c0 11.494-11.494 18.808-22.988 18.808h-257.04c-11.494 0-22.988-7.314-22.988-18.808v-299.36c1.066-11.964 10.978-21.201 22.988-21.42h39.706v26.645c0.552 5.854 5.622 10.233 11.494 9.927h154.12c5.98 0.327 11.209-3.992 12.016-9.927v-26.646h39.706c12.009 0.22 21.922 9.456 22.988 21.42v299.36z"/>
												<path d="m179.22 233.57c-3.919-4.131-10.425-4.364-14.629-0.522l-33.437 31.869-14.106-14.629c-3.919-4.131-10.425-4.363-14.629-0.522-4.047 4.24-4.047 10.911 0 15.151l21.42 21.943c1.854 2.076 4.532 3.224 7.314 3.135 2.756-0.039 5.385-1.166 7.314-3.135l40.751-38.661c4.04-3.706 4.31-9.986 0.603-14.025-0.19-0.211-0.391-0.412-0.601-0.604z"/>
												<path d="m329.16 256.03h-120.16c-5.771 0-10.449 4.678-10.449 10.449s4.678 10.449 10.449 10.449h120.16c5.771 0 10.449-4.678 10.449-10.449s-4.678-10.449-10.449-10.449z"/>
												<path d="m179.22 149.98c-3.919-4.131-10.425-4.364-14.629-0.522l-33.437 31.869-14.106-14.629c-3.919-4.131-10.425-4.364-14.629-0.522-4.047 4.24-4.047 10.911 0 15.151l21.42 21.943c1.854 2.076 4.532 3.224 7.314 3.135 2.756-0.039 5.385-1.166 7.314-3.135l40.751-38.661c4.04-3.706 4.31-9.986 0.603-14.025-0.19-0.211-0.391-0.412-0.601-0.604z"/>
												<path d="m329.16 172.44h-120.16c-5.771 0-10.449 4.678-10.449 10.449s4.678 10.449 10.449 10.449h120.16c5.771 0 10.449-4.678 10.449-10.449s-4.678-10.449-10.449-10.449z"/>
												<path d="m179.22 317.16c-3.919-4.131-10.425-4.363-14.629-0.522l-33.437 31.869-14.106-14.629c-3.919-4.131-10.425-4.363-14.629-0.522-4.047 4.24-4.047 10.911 0 15.151l21.42 21.943c1.854 2.076 4.532 3.224 7.314 3.135 2.756-0.039 5.385-1.166 7.314-3.135l40.751-38.661c4.04-3.706 4.31-9.986 0.603-14.025-0.19-0.21-0.391-0.411-0.601-0.604z"/>
												<path d="m329.16 339.63h-120.16c-5.771 0-10.449 4.678-10.449 10.449s4.678 10.449 10.449 10.449h120.16c5.771 0 10.449-4.678 10.449-10.449s-4.678-10.449-10.449-10.449z"/>
											
											</svg>
										</div>
										<div class="project-content">
											<h5>TOTAL KELAS MENGAJAR</h5>
											<ul>
												<li>
                                               <h3 class=" text-primary"> <?php echo $this->m_guru->totalKelasMengajar($this->m_guru->idu()) ?></h3>
													
												</li>

											</ul>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="col-xl-4 col-lg-6 col-md-6 col-sm-12">
							<div class="card  overflow-hidden project-card">
								<div class="card-body">
									<div class="d-flex">
										<div class="my-auto">
											<svg enable-background="new 0 0 438.891 438.891" class="mr-4 ht-60 wd-60 my-auto danger" version="1.1" viewBox="0 0 438.89 438.89" xml:space="preserve" xmlns="http://www.w3.org/2000/svg">
											<path d="m374.1 385.52c71.682-74.715 69.224-193.39-5.492-265.08-34.974-33.554-81.584-52.26-130.05-52.193-103.54-0.144-187.59 83.676-187.74 187.22-0.067 48.467 18.639 95.077 52.193 130.05l-48.777 65.024c-5.655 7.541-4.127 18.238 3.413 23.893s18.238 4.127 23.893-3.413l47.275-63.044c65.4 47.651 154.08 47.651 219.48 0l47.275 63.044c5.655 7.541 16.353 9.069 23.893 3.413 7.541-5.655 9.069-16.353 3.413-23.893l-48.775-65.024zm-135.54 24.064c-84.792-0.094-153.51-68.808-153.6-153.6 0-84.831 68.769-153.6 153.6-153.6s153.6 68.769 153.6 153.6-68.769 153.6-153.6 153.6z"/>
												<path d="m145.29 24.984c-33.742-32.902-87.767-32.221-120.67 1.521-32.314 33.139-32.318 85.997-8e-3 119.14 6.665 6.663 17.468 6.663 24.132 0l96.546-96.529c6.663-6.665 6.663-17.468 0-24.133zm-106.55 82.398c-12.186-25.516-1.38-56.08 24.136-68.267 13.955-6.665 30.175-6.665 44.131 0l-68.267 68.267z"/>
												<path d="m452.49 24.984c-33.323-33.313-87.339-33.313-120.66 0-6.663 6.665-6.663 17.468 0 24.132l96.529 96.529c6.665 6.663 17.468 6.663 24.132 0 33.313-33.322 33.313-87.338 0-120.66zm-14.08 82.449-68.301-68.301c19.632-9.021 42.79-5.041 58.283 10.018 15.356 15.341 19.371 38.696 10.018 58.283z"/>
												<path d="m238.56 136.52c-9.426 0-17.067 7.641-17.067 17.067v96.717l-47.787 63.71c-5.655 7.541-4.127 18.238 3.413 23.893s18.238 4.127 23.893-3.413l51.2-68.267c2.216-2.954 3.413-6.547 3.413-10.24v-102.4c1e-3 -9.426-7.64-17.067-17.065-17.067z"/>
                                            </svg>
										</div>
										<div class="project-content">
											<h5>JAM MENGAJAR</h5>
											<ul>
												<li>
                                               <h3 class=" text-primary"><?php echo $this->m_guru->totalJamMengajarPerMinggu($this->m_guru->idu()) ?> Jam / Minggu</h3>
													
												</li>

											</ul>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="col-xl-4 col-lg-6 col-md-6 col-sm-12">
							<div class="card overflow-hidden project-card">
								<div class="card-body">
									<div class="d-flex">
										<div class="my-auto">
											<svg enable-background="new 0 0 477.849 477.849" class="mr-4 ht-60 wd-60 my-auto success" version="1.1" viewBox="0 0 477.85 477.85" xml:space="preserve" xmlns="http://www.w3.org/2000/svg">
                                            <path d="m374.1 385.52c71.682-74.715 69.224-193.39-5.492-265.08-34.974-33.554-81.584-52.26-130.05-52.193-103.54-0.144-187.59 83.676-187.74 187.22-0.067 48.467 18.639 95.077 52.193 130.05l-48.777 65.024c-5.655 7.541-4.127 18.238 3.413 23.893s18.238 4.127 23.893-3.413l47.275-63.044c65.4 47.651 154.08 47.651 219.48 0l47.275 63.044c5.655 7.541 16.353 9.069 23.893 3.413 7.541-5.655 9.069-16.353 3.413-23.893l-48.775-65.024zm-135.54 24.064c-84.792-0.094-153.51-68.808-153.6-153.6 0-84.831 68.769-153.6 153.6-153.6s153.6 68.769 153.6 153.6-68.769 153.6-153.6 153.6z"/>
												<path d="m145.29 24.984c-33.742-32.902-87.767-32.221-120.67 1.521-32.314 33.139-32.318 85.997-8e-3 119.14 6.665 6.663 17.468 6.663 24.132 0l96.546-96.529c6.663-6.665 6.663-17.468 0-24.133zm-106.55 82.398c-12.186-25.516-1.38-56.08 24.136-68.267 13.955-6.665 30.175-6.665 44.131 0l-68.267 68.267z"/>
												<path d="m452.49 24.984c-33.323-33.313-87.339-33.313-120.66 0-6.663 6.665-6.663 17.468 0 24.132l96.529 96.529c6.665 6.663 17.468 6.663 24.132 0 33.313-33.322 33.313-87.338 0-120.66zm-14.08 82.449-68.301-68.301c19.632-9.021 42.79-5.041 58.283 10.018 15.356 15.341 19.371 38.696 10.018 58.283z"/>
												<path d="m238.56 136.52c-9.426 0-17.067 7.641-17.067 17.067v96.717l-47.787 63.71c-5.655 7.541-4.127 18.238 3.413 23.893s18.238 4.127 23.893-3.413l51.2-68.267c2.216-2.954 3.413-6.547 3.413-10.24v-102.4c1e-3 -9.426-7.64-17.067-17.065-17.067z"/>
                                            </svg>
										</div>
										<div class="project-content">
											<h6>TOTAL JAM MENGAJAR</h6>
											<ul>
												<li>
                                                <h3 class=" text-primary"> <?php echo $this->m_guru->totalJamMengajar($this->m_guru->idu()) ?> Jam</h3>
												</li>
											</ul>
										</div>
									</div>
								</div>
							</div>
						</div>

                        <div class="row row-sm main-content-app mb-4">
					<div class="col-xl-4 col-lg-5">
						<div class="card">
							<div class="main-content-left main-content-left-chat">
								<nav class="nav main-nav-line main-nav-line-chat">
									<a class="nav-link active" data-toggle="tab" href="">Pengumuman</a> <a class="nav-link" data-toggle="tab" href="">Pengaduan</a> <a class="nav-link" data-toggle="tab" href="">Info</a>
								</nav>
							
								<div class="main-chat-list" id="ChatList">
									<div class="media new">
										<div class="main-img-user online">
											<img alt="" src="https://laravel.spruko.com/azira/horizontal_light/assets/img/faces/5.jpg"> <span>2</span>
										</div>
										<div class="media-body">
											<div class="media-contact-name">
												<span>Socrates Itumay</span> <span>2 hours</span>
											</div>
											<p>Assalamualaikum wr.wb, Mulai hari ini,silahkan ibu/bapak guru untuk memberikan materi/tugas, dengan pembelajaran online, disesuaikan dengan jadwal masing2, semoga kita dalam keadaan sehat walafiat, aamiin,terima kasih</p>
										</div>
									</div>
									<div class="media new">
										<div class="main-img-user">
											<img alt="" src="https://laravel.spruko.com/azira/horizontal_light/assets/img/faces/6.jpg"> <span>1</span>
										</div>
										<div class="media-body">
											<div class="media-contact-name">
												<span>Dexter dela Cruz</span> <span>3 hours</span>
											</div>
											<p>Maec enas tempus, tellus eget con dime ntum rhoncus, sem quam</p>
										</div>
									</div>
									<div class="media selected">
										<div class="main-img-user online"><img alt="" src="https://laravel.spruko.com/azira/horizontal_light/assets/img/faces/9.jpg"></div>
										<div class="media-body">
											<div class="media-contact-name">
												<span>Reynante Labares</span> <span>10 hours</span>
											</div>
											<p>Nam quam nunc, bl ndit vel aecenas et ante tincid</p>
										</div>
									</div>
									
									<div class="media new">
										<div class="main-img-user">
											<img alt="" src="https://laravel.spruko.com/azira/horizontal_light/assets/img/faces/7.jpg"> <span>1</span>
										</div>
										<div class="media-body">
											<div class="media-contact-name">
												<span>Ariana Monino</span> <span>3 days</span>
											</div>
											<p>Maece nas tempus, tellus eget cond imentum rhoncus, sem quam</p>
										</div>
									</div>
									
									
									
									<div class="media border-bottom-0">
										<div class="main-img-user"><img alt="" src="https://laravel.spruko.com/azira/horizontal_light/assets/img/faces/6.jpg"></div>
										<div class="media-body">
											<div class="media-contact-name">
												<span>Samuel Lerin</span> <span>7 days</span>
											</div>
											<p>Nam quam nunc, blandit vel aecenas et ante tincid</p>
										</div>
									</div>
								</div><!-- main-chat-list -->
							</div>
						</div>
					</div>


 <div class="main-content-body">
     <div class="body">
         <?php
            $idu = $this->m_guru->idu();
            $dataMapelAjar = $this->m_guru->mapelAjar($idu);
            $i = 0;
            foreach ($dataMapelAjar as $val) {
                if ($i == 0) {
                    $color = "bg-teal";
                    $i++;
                } elseif ($i == 1) {
                    $color = "bg-pink";
                    $i++;
                } elseif ($i == 2) {
                    $color = "bg-green";
                    $i++;
                } elseif ($i == 3) {
                    $color = "bg-blue";
                    $i++;
                } elseif ($i == 4) {
                    $color = "bg-orange";
                    $i++;
                } elseif ($i == 5) {
                    $color = "bg-red";
                    $i++;
                } elseif ($i == 6) {
                    $color = "bg-lime";
                    $i++;
                } elseif ($i == 7) {
                    $color = "bg-brown";
                    $i++;
                } elseif ($i == 8) {
                    $color = "bg-blue-grey";
                    $i++;
                } elseif ($i == 9) {
                    $color = "bg-blue-amber";
                    $i++;
                } else {
                    $i = 0;
                }

                $jmlPertemuanPerMapelPerKelas = $this->m_guru->jmlValidPerMapelPerKelas($idu, $val->id_mapel, $val->id_kelas);
                $totalJamMengajar = $this->m_guru->totalJamMengajarPerKelasMapel($idu, $val->id);
                $persentase = str_replace(",", ".", $this->m_reff->persentase($jmlPertemuanPerMapelPerKelas, $totalJamMengajar));
            ?><span>
                 <b> PROGRESS MENGAJAR : <?php echo $this->m_reff->goField("v_kelas", "nama", "where id='" . $val->id_kelas . "'"); ?> - <?php echo $this->m_reff->goField("tr_mapel", "nama", "where id='" . $val->id_mapel . "'"); ?>
                 </b> <b class="pull-right"><?php echo $jmlPertemuanPerMapelPerKelas; ?> / <?php echo $totalJamMengajar; ?> Jam</b>

             </span>
             <div class="progress">
                 <div class="progress-bar <?php echo $color; ?> progress-bar-striped active" role="progressbar" aria-valuenow="78" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $persentase; ?>%">
                     <?php echo $persentase; ?> %
                 </div>
             </div>
         <?php } ?>
     </div>

<BR>

     <div class="row clearfix">

         <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
             <div class="card" id="blockarea">

                 <div class="bodyd" style="min-height:200px;padding:10px">


                     <div class="col-sm-6" id="bulan">
                         <?php

                            $awal = $this->tanggal->minTgl(10, date('Y-m-d'));
                            $awal = $this->tanggal->eng($awal, "-");
                            $awal = $this->tanggal->ind($awal, "/");

                            ?>
                         <input value="<?php echo $awal; ?> - <?php echo date("d/m/Y"); ?>" id="ftanggal<?php echo $token ?>" readonly class="cursor form-control col-md-12 " type="text">

                     </div>



                     <div class="col-sm-3"></div>
                     <!--  		<div class="col-sm-3">
                                     
                             <button onclick="rekap()" type="button" class="btn btn-block bg-indigo waves-effect">
                                    <i class="material-icons">assignment</i>
                                    <span>Rekap  </span>
                                </button>
                                  
                             
                                    
                                </div> -->
                     <div class="clearfix"> </div>
                     <br>
                     <div class="table-responsive" id="area_lod">
                         <table id='table' class="tabel black table-bordered  table-hover dataTable" style="font-size:12px;width:100%">
                             <thead class='sadow bg-blue'>

                                 <th class='thead'>TANGGAL </th>
                                 <th class='thead'>DATANG</th>
                                 <th class='thead'>PULANG </th>
                                 <th class='thead'>TELAT</th>
                                 <th class='thead'>TOTAL BEKERJA </th>
                             </thead>
                         </table>
                     </div>

                     <!--	 Perhitungan honor berdasarkan status saat ini , besaran honor perjam anda adalah : Rp. <?php echo number_format($this->m_reff->honor($this->mdl->idu(), 0, ",", ".", "")); ?>
                    -->
                 </div>
                 <div class="row">&nbsp;</div><br>
             </div>
         </div>

     </div>
 </div>
 </div>
 </div>

 <script>
     var dataTable = $('#table').DataTable({
         "paging": false,
         "processing": false, //Feature control the processing indicator.
         "language": {
             "sSearch": "Pencarian",
             "processing": ' <span class="sr-only dataTables_processing">Loading...</span> <br><b style="color:black;background:white">Proses menampilkan data<br> Mohon Menunggu..</b>',
             "oPaginate": {
                 "sFirst": "Hal Pertama",
                 "sLast": "Hal Terakhir",
                 "sNext": "Selanjutnya",
                 "sPrevious": "Sebelumnya"
             },
             "sInfo": "",
             "sInfoEmpty": "",
             "sZeroRecords": "Data tidak tersedia",
             "lengthMenu": "Tampil _MENU_ Baris",
         },


         "serverSide": true, //Feature control DataTables' server-side processing mode.
         "responsive": false,
         "searching": false,
         "lengthMenu": [
             [1000],
             [1000]
         ],
         dom: 'Blfrtip',
         buttons: [
             // 'copy', 'csv', 'excel', 'pdf', 'print'

             /* {
					extend: 'excel',
                        exportOptions: {
                      columns:[ 0,1]
                },text:'Export Excell',
							
                    },*/


         ],

         // Load data for the table's content from an Ajax source
         "ajax": {
             "url": "<?php echo site_url('gdashboard/getAbsen'); ?>",
             "type": "POST",
             "data": function(data) {

                 data.tgl = $('#ftanggal<?php echo $token ?>').val();

             },
             beforeSend: function() {
                 loading("area_lod");
             },
             complete: function() {
                 unblock('area_lod');
             },

         },

         //Set column definition initialisation properties.
         "columnDefs": [{
             "targets": [0, -1], //last column
             "orderable": false, //set not orderable
         }, ],

     });


     var x = 0;
     $(document).on('change', '#ftanggal<?php echo $token ?>', function(event, messages) {

         dataTable.ajax.reload(null, false);

     });
 </script>




 <script>
     var link = "<?php echo base_url() ?>";

     function reload() {
         loading("blockarea");
         var bulan = $("[name='bulan']").val();
         var tahun = $("ftanggal").val();
         $.ajax({
             url: link + "gdashboard/getDataAbsen",
             data: "bulan=" + bulan + "&tahun=" + tahun,
             method: "POST",
             success: function(data) {
                 $("#isi").html(data);
                 unblock("blockarea");
             }
         });
     }
 </script>


 <script>
     function rekap() {
         var tahun = $("[name='tahun']").val();
         $("#modalGrafik").modal("show");
         $("#thn").html(tahun);
         $("#isiGrafik").html("<img src='<?php echo base_url() ?>plug/img/load.gif'/> Mohon Tunggu...");
         $.ajax({
             url: link + "gdashboard/getGrafik",
             data: "tahun=" + tahun,
             method: "POST",
             success: function(data) {
                 $("#isiGrafik").html(data);
             }
         });
     }


     function gantiBulan(bulan, tahun) {
         var bulan = $("[name='bulan']").val();
         var tahun = $("[name='tahun']").val();
         $.ajax({
             url: link + "abs/getDataBulan",
             data: "bulan=" + bulan + "&tahun=" + tahun,
             method: "POST",
             success: function(data) {
                 $("#bulan").html(data);
             }
         });

     }
 </script>





 <!-- Modal -->
 <div class="modal fade" id="modalGrafik" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
     <div class="modal-dialog modal-lg  ">
         <div class="modal-content">
             <!-- Modal Header -->
             <div class="modal-header">
                 <button type="button" class="close" data-dismiss="modal">
                     <span aria-hidden="true">&times;</span>
                     <span class="sr-only">Close</span>
                 </button>
                 <h4 class="modal-title col-teal" id="myModalLabel">
                     Rekap Jumlah Jam Mengajar <span id="thnx"></span>
                 </h4>
             </div>

             <!-- Modal Body -->
             <div class="modal-body" id="isiGrafik">

             </div>

             <!-- Modal Footer -->

         </div>
     </div>
 </div>

 <script>
     //Tooltip
     $('[data-toggle="tooltip"]').tooltip({
         container: 'body'
     });

     function getMapel(tgl) {
         $("#modalMapel").modal("show");
         $("#isiMapel").html("<img src='<?php echo base_url() ?>plug/img/load.gif'/> Mohon Tunggu...");
         $.ajax({
             url: link + "gdashboard/getDataMapel",
             data: "tgl=" + tgl,
             method: "POST",
             success: function(data) {
                 $("#isiMapel").html(data);

             }
         });
     }
 </script>


 <!-- Modal -->
 <div class="modal fade" id="modalMapel" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
     <div class="modal-dialog">
         <div class="modal-content">
             <!-- Modal Header -->
             <div class="modal-header">
                 <button type="button" class="close" data-dismiss="modal">
                     <span aria-hidden="true">&times;</span>
                     <span class="sr-only">Close</span>
                 </button>
                 <h4 class="modal-title" id="myModalLabel">
                     Kegiatan Belajar Mengajar
                 </h4>
             </div>

             <!-- Modal Body -->
             <div class="modal-body row" id="isiMapel">
                 <div class="row col-md-12">&nbsp;</div>
             </div>

             <!-- Modal Footer -->

         </div>
     </div>
 </div>










 <script>
     $('#ftanggal<?php echo $token; ?>').daterangepicker({
         "showDropdowns": true,
         ranges: {
             'Hari ini': [moment(), moment()],
             'Kemarin': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
             '10 Hari yang lalu': [moment().subtract(9, 'days'), moment()],
             '30 Hari yang lalu': [moment().subtract(29, 'days'), moment()],
             'Bulan ini': [moment().startOf('month'), moment().endOf('month')],
             'Bulan kemarin': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
         },
         "locale": {
             "format": "DD/MM/YYYY",
             "separator": " - ",
             "applyLabel": "Apply",
             "cancelLabel": "Cancel",
             "fromLabel": "From",
             "toLabel": "To",
             "customRangeLabel": "Custom",
             "weekLabel": "W",
             "daysOfWeek": [
                 "Min",
                 "Sen",
                 "Sel",
                 "Rab",
                 "Kam",
                 "Jum",
                 "Sab",

             ],
             "monthNames": [
                 "Januari",
                 "Februari",
                 "Maret",
                 "April",
                 "Mei",
                 "Juni",
                 "Juli",
                 "Agustus",
                 "September",
                 "Oktober",
                 "November",
                 "Desember"
             ],
             "firstDay": 1
         },
         "startDate": "<?php echo $this->tanggal->minTgl(10, date("Y/m/d")); ?>",
         "endDate": "<?php echo date("d/m/Y"); ?>",
         "opens": "left"
     }, function(start, end, label) {
         console.log('New date range selected: ' + start.format('DD-MM-YYYY') + ' to ' + end.format('DD-MM-YYYY') + ' (predefined range: ' + label + ')');

     });
     $(document).ready(function() {

         $('#ftanggal<?php echo $token; ?>').daterangepicker({
             "showDropdowns": true,
             ranges: {
                 //  'Hari ini': [moment(), moment()],
                 //  'Kemarin': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                 '10 Hari yang lalu': [moment().subtract(9, 'days'), moment()],
                 '30 Hari yang lalu': [moment().subtract(29, 'days'), moment()],
                 'Bulan ini': [moment().startOf('month'), moment().endOf('month')],
                 'Bulan kemarin': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
             },
             "locale": {
                 "format": "DD/MM/YYYY",
                 "separator": " - ",
                 "applyLabel": "Apply",
                 "cancelLabel": "Cancel",
                 "fromLabel": "From",
                 "toLabel": "To",
                 "customRangeLabel": "Custom",
                 "weekLabel": "W",
                 "daysOfWeek": [
                     "Min",
                     "Sen",
                     "Sel",
                     "Rab",
                     "Kam",
                     "Jum",
                     "Sab",

                 ],
                 "monthNames": [
                     "Januari",
                     "Februari",
                     "Maret",
                     "April",
                     "Mei",
                     "Juni",
                     "Juli",
                     "Agustus",
                     "September",
                     "Oktober",
                     "November",
                     "Desember"
                 ],
                 "firstDay": 1
             },
             "startDate": "<?php echo $this->tanggal->minTgl(10, date("Y/m/d")); ?>",
             "endDate": "<?php echo date("d/m/Y"); ?>",
             "opens": "left"
         }, function(start, end, label) {
             console.log('New date range selected: ' + start.format('DD-MM-YYYY') + ' to ' + end.format('DD-MM-YYYY') + ' (predefined range: ' + label + ')');

         });

     });
 </script>