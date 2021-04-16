 <!-- main-content opened -->
 <!-- breadcrumb -->
 <div class="breadcrumb-header justify-content-between">
     <div>
         <h4 class="content-title mb-2">Hi, Ini Catatan Pengaduan</h4>
         <nav aria-label="breadcrumb">
             <ol class="breadcrumb">
                 <li class="breadcrumb-item"><a href="#">Aksi</a></li>
                 <li class="breadcrumb-item active" aria-current="page"> Pengaduan</li>
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


 <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
     <div class="card">
         <div class="info-box bg-pink hover-expand-effect">
             <div class="icon">
                 <i class="material-icons">playlist_add_check</i>
             </div>
             <div class="content">
                 <div class="text">TOTAL KELAS MENGAJAR</div>
                 <div class="number count-to" data-from="0" data-to="125" data-speed="15" data-fresh-interval="20"><?php echo $this->m_guru->totalKelasMengajar($this->m_guru->idu()) ?></div>
             </div>
         </div>

         <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
             <div class="info-box bg-cyan hover-expand-effect">
                 <div class="icon">
                     <i class="material-icons">alarm</i>
                 </div>
                 <div class="content">
                     <div class="text">JAM MENGAJAR</div>
                     <div class="number count-to" data-from="0" data-to="257" data-speed="1000" data-fresh-interval="20"><?php echo $this->m_guru->totalJamMengajarPerMinggu($this->m_guru->idu()) ?> Jam / Minggu</div>
                 </div>
             </div>
         </div>
         <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
             <div class="info-box bg-light-green hover-expand-effect">
                 <div class="icon">
                     <i class="material-icons">alarm_on</i>
                 </div>
                 <div class="content">
                     <div class="text">TOTAL JAM MENGAJAR</div>
                     <div class="number count-to" data-from="0" data-to="243" data-speed="1000" data-fresh-interval="20"><?php echo $this->m_guru->totalJamMengajar($this->m_guru->idu()) ?> Jam</div>
                 </div>
             </div>
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