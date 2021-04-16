 <!-- breadcrumb -->
 <div class="breadcrumb-header justify-content-between">
     <div>
         <h4 class="content-title mb-2">Hi, Ini Jadwal</h4>
         <nav aria-label="breadcrumb">
             <ol class="breadcrumb">
                 <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                 <li class="breadcrumb-item active" aria-current="page"> Jadwal</li>
             </ol>
         </nav>
     </div>
     <div class="d-flex my-auto">
         <div class=" d-flex right-page">
             <div class="d-flex justify-content-center mr-5">
                 <div class="">
                     <span class="d-block">
                         <span class="label ">Jadwal Hari ini</span>
                     </span>
                     <span class="value">
                         Kosong
                     </span>
                 </div>

             </div>
             <div class="d-flex justify-content-center">
                 <div class="">
                     <span class="d-block">
                         <span class="label">Jadwal Kelas</span>
                     </span>
                     <span class="value">
                         Kosong
                     </span>
                 </div>

             </div>
         </div>
     </div>
 </div>
 <!-- /breadcrumb -->
 <?php

    $kemarin  = date("Y-m-d", mktime(0, 0, 0, date('m'), date('d') - 1, date('Y')));
    $hari_ini  = $this->db->query('SELECT sum(counter) AS jml FROM counterdb WHERE tanggal="' . date("Y-m-d") . '"')->row();
    $kemarin = $this->db->query('SELECT sum(counter) AS jml FROM counterdb WHERE tanggal="' . $kemarin . '"')->row();
    $sql =  $this->db->query('SELECT sum(counter) as jml FROM counterdb')->row();
    ?>
 <!-- Widgets -->

 <div class="main-content-body ">

     <div class="row row-sm">
         <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
             <div class="card overflow-hidden project-card">
                 <div class="card-body">
                     <div class="d-flex">
                         <div class="my-auto">
                             <svg enable-background="new 0 0 469.682 469.682" version="1.1" class="mr-4 ht-60 wd-60 my-auto primary" viewBox="0 0 469.68 469.68" xml:space="preserve" xmlns="http://www.w3.org/2000/svg">
                                 <path d="m120.41 298.32h87.771c5.771 0 10.449-4.678 10.449-10.449s-4.678-10.449-10.449-10.449h-87.771c-5.771 0-10.449 4.678-10.449 10.449s4.678 10.449 10.449 10.449z" />
                                 <path d="m291.77 319.22h-171.36c-5.771 0-10.449 4.678-10.449 10.449s4.678 10.449 10.449 10.449h171.36c5.771 0 10.449-4.678 10.449-10.449s-4.678-10.449-10.449-10.449z" />
                                 <path d="m291.77 361.01h-171.36c-5.771 0-10.449 4.678-10.449 10.449s4.678 10.449 10.449 10.449h171.36c5.771 0 10.449-4.678 10.449-10.449s-4.678-10.449-10.449-10.449z" />
                                 <path d="m420.29 387.14v-344.82c0-22.987-16.196-42.318-39.183-42.318h-224.65c-22.988 0-44.408 19.331-44.408 42.318v20.376h-18.286c-22.988 0-44.408 17.763-44.408 40.751v345.34c0.68 6.37 4.644 11.919 10.449 14.629 6.009 2.654 13.026 1.416 17.763-3.135l31.869-28.735 38.139 33.959c2.845 2.639 6.569 4.128 10.449 4.18 3.861-0.144 7.554-1.621 10.449-4.18l37.616-33.959 37.616 33.959c5.95 5.322 14.948 5.322 20.898 0l38.139-33.959 31.347 28.735c3.795 4.671 10.374 5.987 15.673 3.135 5.191-2.98 8.232-8.656 7.837-14.629v-74.188l6.269-4.702 31.869 28.735c2.947 2.811 6.901 4.318 10.971 4.18 1.806 0.163 3.62-0.2 5.224-1.045 5.493-2.735 8.793-8.511 8.361-14.629zm-83.591 50.155-24.555-24.033c-5.533-5.656-14.56-5.887-20.376-0.522l-38.139 33.959-37.094-33.959c-6.108-4.89-14.79-4.89-20.898 0l-37.616 33.959-38.139-33.959c-6.589-5.4-16.134-5.178-22.465 0.522l-27.167 24.033v-333.84c0-11.494 12.016-19.853 23.51-19.853h224.65c11.494 0 18.286 8.359 18.286 19.853v333.84zm62.693-61.649-26.122-24.033c-4.18-4.18-5.224-5.224-15.673-3.657v-244.51c1.157-21.321-15.19-39.542-36.51-40.699-0.89-0.048-1.782-0.066-2.673-0.052h-185.47v-20.376c0-11.494 12.016-21.42 23.51-21.42h224.65c11.494 0 18.286 9.927 18.286 21.42v333.32z" />
                                 <path d="m232.21 104.49h-57.47c-11.542 0-20.898 9.356-20.898 20.898v104.49c0 11.542 9.356 20.898 20.898 20.898h57.469c11.542 0 20.898-9.356 20.898-20.898v-104.49c1e-3 -11.542-9.356-20.898-20.897-20.898zm0 123.3h-57.47v-13.584h57.469v13.584zm0-34.482h-57.47v-67.918h57.469v67.918z" />
                             </svg>
                         </div>
                         <div class="project-content">
                             <h6>Total Pengunjung</h6>
                             <ul>
                                 <li class="tx-200px">
                                     <?php echo $sql->jml; ?>
                                 </li>


                             </ul>
                         </div>
                     </div>
                 </div>
             </div>
         </div>
         <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
             <div class="card overflow-hidden project-card">
                 <div class="card-body">
                     <div class="d-flex">
                         <div class="my-auto">
                             <svg enable-background="new 0 0 469.682 469.682" version="1.1" class="mr-4 ht-60 wd-60 my-auto primary" viewBox="0 0 469.68 469.68" xml:space="preserve" xmlns="http://www.w3.org/2000/svg">
                                 <path d="m120.41 298.32h87.771c5.771 0 10.449-4.678 10.449-10.449s-4.678-10.449-10.449-10.449h-87.771c-5.771 0-10.449 4.678-10.449 10.449s4.678 10.449 10.449 10.449z" />
                                 <path d="m291.77 319.22h-171.36c-5.771 0-10.449 4.678-10.449 10.449s4.678 10.449 10.449 10.449h171.36c5.771 0 10.449-4.678 10.449-10.449s-4.678-10.449-10.449-10.449z" />
                                 <path d="m291.77 361.01h-171.36c-5.771 0-10.449 4.678-10.449 10.449s4.678 10.449 10.449 10.449h171.36c5.771 0 10.449-4.678 10.449-10.449s-4.678-10.449-10.449-10.449z" />
                                 <path d="m420.29 387.14v-344.82c0-22.987-16.196-42.318-39.183-42.318h-224.65c-22.988 0-44.408 19.331-44.408 42.318v20.376h-18.286c-22.988 0-44.408 17.763-44.408 40.751v345.34c0.68 6.37 4.644 11.919 10.449 14.629 6.009 2.654 13.026 1.416 17.763-3.135l31.869-28.735 38.139 33.959c2.845 2.639 6.569 4.128 10.449 4.18 3.861-0.144 7.554-1.621 10.449-4.18l37.616-33.959 37.616 33.959c5.95 5.322 14.948 5.322 20.898 0l38.139-33.959 31.347 28.735c3.795 4.671 10.374 5.987 15.673 3.135 5.191-2.98 8.232-8.656 7.837-14.629v-74.188l6.269-4.702 31.869 28.735c2.947 2.811 6.901 4.318 10.971 4.18 1.806 0.163 3.62-0.2 5.224-1.045 5.493-2.735 8.793-8.511 8.361-14.629zm-83.591 50.155-24.555-24.033c-5.533-5.656-14.56-5.887-20.376-0.522l-38.139 33.959-37.094-33.959c-6.108-4.89-14.79-4.89-20.898 0l-37.616 33.959-38.139-33.959c-6.589-5.4-16.134-5.178-22.465 0.522l-27.167 24.033v-333.84c0-11.494 12.016-19.853 23.51-19.853h224.65c11.494 0 18.286 8.359 18.286 19.853v333.84zm62.693-61.649-26.122-24.033c-4.18-4.18-5.224-5.224-15.673-3.657v-244.51c1.157-21.321-15.19-39.542-36.51-40.699-0.89-0.048-1.782-0.066-2.673-0.052h-185.47v-20.376c0-11.494 12.016-21.42 23.51-21.42h224.65c11.494 0 18.286 9.927 18.286 21.42v333.32z" />
                                 <path d="m232.21 104.49h-57.47c-11.542 0-20.898 9.356-20.898 20.898v104.49c0 11.542 9.356 20.898 20.898 20.898h57.469c11.542 0 20.898-9.356 20.898-20.898v-104.49c1e-3 -11.542-9.356-20.898-20.897-20.898zm0 123.3h-57.47v-13.584h57.469v13.584zm0-34.482h-57.47v-67.918h57.469v67.918z" />
                             </svg>
                         </div>
                         <div class="project-content">
                             <h6>Hari ini</h6>
                             <ul>
                                 <li class="tx-200px">
                                     <?php echo  $hari_ini->jml; ?>
                                 </li>


                             </ul>
                         </div>
                     </div>
                 </div>
             </div>
         </div>
     </div>
     <!-- CLOSE ROWS -->

     <!-- row 2-->
     <div class="row row-sm ">
         <div class="col-md-12 col-xl-12">
             <div class="card overflow-hidden review-project">
                 <div class="card-body">
                     <div class="d-flex justify-content-between">
                         <h4 class="card-title mg-b-10">All Projects</h4>
                         <i class="mdi mdi-dots-horizontal text-gray"></i>
                     </div>
                     <p class="tx-12 text-muted mb-3">A project is an activity to meet the creation of a unique product or service and thus activities that are undertaken to accomplish routine activities cannot be considered projects. <a href="">Learn more</a></p>
                     <div class="table-responsive mb-0">

                         <?php

                            $this->db->group_by("tanggal");
                            $this->db->order_by("tanggal", "ASC");
                            $this->db->select("count(*) as jml, tanggal");
                            $data = $this->db->get("counterdb")->result();
                            $datamad = "";
                            foreach ($data as $data) {
                                $tgl = $this->tanggal->ind($data->tanggal, "-");
                                $datamad .= "{ name: '" . $tgl . "', y: " . $data->jml . " },";
                            }

                            ?>


                         <script>
                             Highcharts.chart('datamad', {
                                 chart: {
                                     type: 'spline'
                                 },
                                 title: {
                                     text: 'PENGUNJUNG'
                                 },

                                 xAxis: {
                                     type: 'category',
                                     labels: {
                                         rotation: -45,
                                         style: {
                                             fontSize: '13px',
                                             fontFamily: 'Verdana, sans-serif'
                                         }
                                     }
                                 },
                                 yAxis: {
                                     min: 0,
                                     title: {
                                         text: 'Jumlah'
                                     },

                                 },
                                 legend: {
                                     enabled: false
                                 },
                                 tooltip: {
                                     pointFormat: '<b>total:{point.y}</b>'
                                 },
                                 series: [{
                                     name: 'Population',
                                     data: [
                                         <?php echo $datamad; ?>
                                     ],
                                     dataLabels: {
                                         enabled: true,
                                         rotation: -90,
                                         color: '#FFFFFF',
                                         align: 'right',
                                         format: '{point.y}', // one decimal
                                         y: 10, // 10 pixels down from the top
                                         style: {
                                             fontSize: '13px',
                                             fontFamily: 'Verdana, sans-serif'
                                         }
                                     }
                                 }]
                             });
                         </script>
                     </div>
                 </div>
             </div>
         </div>
     </div>
     <!-- /row -->

     <!-- ROWS 3-->
     <div class="row row-sm">
         <div class="col-xl-4 col-lg-4 col-md-6 col-sm-12">
             <div class="card overflow-hidden project-card">
                 <div class="card-body">
                     <div class="d-flex">
                         <div class="my-auto">
                             <svg enable-background="new 0 0 469.682 469.682" version="1.1" class="mr-4 ht-60 wd-60 my-auto primary" viewBox="0 0 469.68 469.68" xml:space="preserve" xmlns="http://www.w3.org/2000/svg">
                                 <path d="m120.41 298.32h87.771c5.771 0 10.449-4.678 10.449-10.449s-4.678-10.449-10.449-10.449h-87.771c-5.771 0-10.449 4.678-10.449 10.449s4.678 10.449 10.449 10.449z" />
                                 <path d="m291.77 319.22h-171.36c-5.771 0-10.449 4.678-10.449 10.449s4.678 10.449 10.449 10.449h171.36c5.771 0 10.449-4.678 10.449-10.449s-4.678-10.449-10.449-10.449z" />
                                 <path d="m291.77 361.01h-171.36c-5.771 0-10.449 4.678-10.449 10.449s4.678 10.449 10.449 10.449h171.36c5.771 0 10.449-4.678 10.449-10.449s-4.678-10.449-10.449-10.449z" />
                                 <path d="m420.29 387.14v-344.82c0-22.987-16.196-42.318-39.183-42.318h-224.65c-22.988 0-44.408 19.331-44.408 42.318v20.376h-18.286c-22.988 0-44.408 17.763-44.408 40.751v345.34c0.68 6.37 4.644 11.919 10.449 14.629 6.009 2.654 13.026 1.416 17.763-3.135l31.869-28.735 38.139 33.959c2.845 2.639 6.569 4.128 10.449 4.18 3.861-0.144 7.554-1.621 10.449-4.18l37.616-33.959 37.616 33.959c5.95 5.322 14.948 5.322 20.898 0l38.139-33.959 31.347 28.735c3.795 4.671 10.374 5.987 15.673 3.135 5.191-2.98 8.232-8.656 7.837-14.629v-74.188l6.269-4.702 31.869 28.735c2.947 2.811 6.901 4.318 10.971 4.18 1.806 0.163 3.62-0.2 5.224-1.045 5.493-2.735 8.793-8.511 8.361-14.629zm-83.591 50.155-24.555-24.033c-5.533-5.656-14.56-5.887-20.376-0.522l-38.139 33.959-37.094-33.959c-6.108-4.89-14.79-4.89-20.898 0l-37.616 33.959-38.139-33.959c-6.589-5.4-16.134-5.178-22.465 0.522l-27.167 24.033v-333.84c0-11.494 12.016-19.853 23.51-19.853h224.65c11.494 0 18.286 8.359 18.286 19.853v333.84zm62.693-61.649-26.122-24.033c-4.18-4.18-5.224-5.224-15.673-3.657v-244.51c1.157-21.321-15.19-39.542-36.51-40.699-0.89-0.048-1.782-0.066-2.673-0.052h-185.47v-20.376c0-11.494 12.016-21.42 23.51-21.42h224.65c11.494 0 18.286 9.927 18.286 21.42v333.32z" />
                                 <path d="m232.21 104.49h-57.47c-11.542 0-20.898 9.356-20.898 20.898v104.49c0 11.542 9.356 20.898 20.898 20.898h57.469c11.542 0 20.898-9.356 20.898-20.898v-104.49c1e-3 -11.542-9.356-20.898-20.897-20.898zm0 123.3h-57.47v-13.584h57.469v13.584zm0-34.482h-57.47v-67.918h57.469v67.918z" />
                             </svg>
                         </div>
                         <div class="project-content">


                             <div class="tx-200">SISWA KELAS X</div>
                             <div class="number count-to" data-from="0" data-to="125" data-speed="15" data-fresh-interval="20"><?php echo $x = $this->mdl->jmlSiswa(1); ?></div>

                         </div>
                     </div>
                 </div>
             </div>
         </div>
         <div class="col-xl-4 col-lg-4 col-md-6 col-sm-12">
             <div class="card overflow-hidden project-card">
                 <div class="card-body">
                     <div class="d-flex">
                         <div class="my-auto">
                             <svg enable-background="new 0 0 469.682 469.682" version="1.1" class="mr-4 ht-60 wd-60 my-auto primary" viewBox="0 0 469.68 469.68" xml:space="preserve" xmlns="http://www.w3.org/2000/svg">
                                 <path d="m120.41 298.32h87.771c5.771 0 10.449-4.678 10.449-10.449s-4.678-10.449-10.449-10.449h-87.771c-5.771 0-10.449 4.678-10.449 10.449s4.678 10.449 10.449 10.449z" />
                                 <path d="m291.77 319.22h-171.36c-5.771 0-10.449 4.678-10.449 10.449s4.678 10.449 10.449 10.449h171.36c5.771 0 10.449-4.678 10.449-10.449s-4.678-10.449-10.449-10.449z" />
                                 <path d="m291.77 361.01h-171.36c-5.771 0-10.449 4.678-10.449 10.449s4.678 10.449 10.449 10.449h171.36c5.771 0 10.449-4.678 10.449-10.449s-4.678-10.449-10.449-10.449z" />
                                 <path d="m420.29 387.14v-344.82c0-22.987-16.196-42.318-39.183-42.318h-224.65c-22.988 0-44.408 19.331-44.408 42.318v20.376h-18.286c-22.988 0-44.408 17.763-44.408 40.751v345.34c0.68 6.37 4.644 11.919 10.449 14.629 6.009 2.654 13.026 1.416 17.763-3.135l31.869-28.735 38.139 33.959c2.845 2.639 6.569 4.128 10.449 4.18 3.861-0.144 7.554-1.621 10.449-4.18l37.616-33.959 37.616 33.959c5.95 5.322 14.948 5.322 20.898 0l38.139-33.959 31.347 28.735c3.795 4.671 10.374 5.987 15.673 3.135 5.191-2.98 8.232-8.656 7.837-14.629v-74.188l6.269-4.702 31.869 28.735c2.947 2.811 6.901 4.318 10.971 4.18 1.806 0.163 3.62-0.2 5.224-1.045 5.493-2.735 8.793-8.511 8.361-14.629zm-83.591 50.155-24.555-24.033c-5.533-5.656-14.56-5.887-20.376-0.522l-38.139 33.959-37.094-33.959c-6.108-4.89-14.79-4.89-20.898 0l-37.616 33.959-38.139-33.959c-6.589-5.4-16.134-5.178-22.465 0.522l-27.167 24.033v-333.84c0-11.494 12.016-19.853 23.51-19.853h224.65c11.494 0 18.286 8.359 18.286 19.853v333.84zm62.693-61.649-26.122-24.033c-4.18-4.18-5.224-5.224-15.673-3.657v-244.51c1.157-21.321-15.19-39.542-36.51-40.699-0.89-0.048-1.782-0.066-2.673-0.052h-185.47v-20.376c0-11.494 12.016-21.42 23.51-21.42h224.65c11.494 0 18.286 9.927 18.286 21.42v333.32z" />
                                 <path d="m232.21 104.49h-57.47c-11.542 0-20.898 9.356-20.898 20.898v104.49c0 11.542 9.356 20.898 20.898 20.898h57.469c11.542 0 20.898-9.356 20.898-20.898v-104.49c1e-3 -11.542-9.356-20.898-20.897-20.898zm0 123.3h-57.47v-13.584h57.469v13.584zm0-34.482h-57.47v-67.918h57.469v67.918z" />
                             </svg>
                         </div>
                         <div class="project-content">
                             <div class="text">SISWA KELAS XI</div>
                             <div class="number count-to" data-from="0" data-to="257" data-speed="1000" data-fresh-interval="20"><?php echo $xi = $this->mdl->jmlSiswa(2); ?></div>
                         </div>
                     </div>
                 </div>
             </div>
         </div>
         <div class="col-xl-4 col-lg-4 col-md-6 col-sm-12">
             <div class="card overflow-hidden project-card">
                 <div class="card-body">
                     <div class="d-flex">
                         <div class="my-auto">
                             <svg enable-background="new 0 0 469.682 469.682" version="1.1" class="mr-4 ht-60 wd-60 my-auto primary" viewBox="0 0 469.68 469.68" xml:space="preserve" xmlns="http://www.w3.org/2000/svg">
                                 <path d="m120.41 298.32h87.771c5.771 0 10.449-4.678 10.449-10.449s-4.678-10.449-10.449-10.449h-87.771c-5.771 0-10.449 4.678-10.449 10.449s4.678 10.449 10.449 10.449z" />
                                 <path d="m291.77 319.22h-171.36c-5.771 0-10.449 4.678-10.449 10.449s4.678 10.449 10.449 10.449h171.36c5.771 0 10.449-4.678 10.449-10.449s-4.678-10.449-10.449-10.449z" />
                                 <path d="m291.77 361.01h-171.36c-5.771 0-10.449 4.678-10.449 10.449s4.678 10.449 10.449 10.449h171.36c5.771 0 10.449-4.678 10.449-10.449s-4.678-10.449-10.449-10.449z" />
                                 <path d="m420.29 387.14v-344.82c0-22.987-16.196-42.318-39.183-42.318h-224.65c-22.988 0-44.408 19.331-44.408 42.318v20.376h-18.286c-22.988 0-44.408 17.763-44.408 40.751v345.34c0.68 6.37 4.644 11.919 10.449 14.629 6.009 2.654 13.026 1.416 17.763-3.135l31.869-28.735 38.139 33.959c2.845 2.639 6.569 4.128 10.449 4.18 3.861-0.144 7.554-1.621 10.449-4.18l37.616-33.959 37.616 33.959c5.95 5.322 14.948 5.322 20.898 0l38.139-33.959 31.347 28.735c3.795 4.671 10.374 5.987 15.673 3.135 5.191-2.98 8.232-8.656 7.837-14.629v-74.188l6.269-4.702 31.869 28.735c2.947 2.811 6.901 4.318 10.971 4.18 1.806 0.163 3.62-0.2 5.224-1.045 5.493-2.735 8.793-8.511 8.361-14.629zm-83.591 50.155-24.555-24.033c-5.533-5.656-14.56-5.887-20.376-0.522l-38.139 33.959-37.094-33.959c-6.108-4.89-14.79-4.89-20.898 0l-37.616 33.959-38.139-33.959c-6.589-5.4-16.134-5.178-22.465 0.522l-27.167 24.033v-333.84c0-11.494 12.016-19.853 23.51-19.853h224.65c11.494 0 18.286 8.359 18.286 19.853v333.84zm62.693-61.649-26.122-24.033c-4.18-4.18-5.224-5.224-15.673-3.657v-244.51c1.157-21.321-15.19-39.542-36.51-40.699-0.89-0.048-1.782-0.066-2.673-0.052h-185.47v-20.376c0-11.494 12.016-21.42 23.51-21.42h224.65c11.494 0 18.286 9.927 18.286 21.42v333.32z" />
                                 <path d="m232.21 104.49h-57.47c-11.542 0-20.898 9.356-20.898 20.898v104.49c0 11.542 9.356 20.898 20.898 20.898h57.469c11.542 0 20.898-9.356 20.898-20.898v-104.49c1e-3 -11.542-9.356-20.898-20.897-20.898zm0 123.3h-57.47v-13.584h57.469v13.584zm0-34.482h-57.47v-67.918h57.469v67.918z" />
                             </svg>
                         </div>
                         <div class="project-content">
                             <div class="text">TOTAL</div>
                             <div class="number count-to" data-from="0" data-to="1225" data-speed="1000" data-fresh-interval="20"><?php echo $this->mdl->jmlSiswaTotal(); ?></div>
                             </ul>
                         </div>
                     </div>
                 </div>
             </div>
         </div>
     </div>

     <!-- CLOSE ROWS 3-->





 </div>
 <!-- CLOSE CONTENT BODY -->


























 <div class="col-md-12">
     <div id="container" style="margin: 0 auto"></div>
 </div>
 <div class="col-md-12">
     <div id="jurusan" style="margin: 0 auto"></div>
 </div>


 <script type="text/javascript">
     // Build the chart
     Highcharts.chart('container', {
         chart: {
             plotBackgroundColor: null,
             plotBorderWidth: null,
             plotShadow: false,
             type: 'pie'
         },
         title: {
             text: 'PRESENTASI SISWA BERDASARKAN TINGKATAN'
         },
         tooltip: {
             pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
         },
         plotOptions: {
             pie: {
                 allowPointSelect: true,
                 cursor: 'pointer',
                 dataLabels: {
                     enabled: false
                 },
                 showInLegend: true
             }
         },
         series: [{
             name: 'Presentasi',
             colorByPoint: true,
             data: [{
                 name: 'X ',
                 y: <?php echo $x; ?>,

             }, {
                 name: 'XI',
                 y: <?php echo $xi; ?>
             }, {
                 name: 'XII',
                 y: <?php echo $xii; ?>
             }]
         }]
     });
 </script>




 <?php
    //	$jurusan1=$this->mdl->jmlJurusan(1);
    //	$jurusan2=$this->mdl->jmlJurusan(2);
    //	$jurusan3=$this->mdl->jmlJurusan(3);

    $data = $this->db->get("tr_jurusan")->result();
    $dataposisi = "";
    foreach ($data as $data) {
        $jml = $this->mdl->jmlJurusan($data->id);
        $dataposisi .= "{ name: '" . $data->nama . " : " . $jml . "', y: " . $jml . " },";
    }
    ?>

 <script type="text/javascript">
     // Build the chart
     Highcharts.chart('jurusan', {
         chart: {
             plotBackgroundColor: null,
             plotBorderWidth: null,
             plotShadow: false,
             type: 'pie'
         },
         title: {
             text: 'PRESENTASI SISWA BERDASARKAN JURUSAN'
         },
         tooltip: {
             pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
         },
         plotOptions: {
             pie: {
                 allowPointSelect: true,
                 cursor: 'pointer',
                 dataLabels: {
                     enabled: false
                 },
                 showInLegend: true
             }
         },
         series: [{
             name: 'Presentasi',
             colorByPoint: true,
             data: [<?php echo $dataposisi; ?>]
         }]
     });
 </script>
 </body>