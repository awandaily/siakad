 <?php $token = date("His"); ?>
 <!-- breadcrumb -->
 <div class="breadcrumb-header justify-content-between">
   <div>
     <h4 class="content-title mb-2">Hi, Ini Nilai Sikap </h4>
     <nav aria-label="breadcrumb">
       <ol class="breadcrumb">
         <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
         <li class="breadcrumb-item active" aria-current="page"> Nilai Sikap</li>
       </ol>
     </nav>
   </div>
   <div class="d-flex my-auto">
     <div class=" d-flex right-page">
       <div class="d-flex justify-content-center mr-5">
         <div class="">
           <span class="d-block">
             <span class="label ">Indeks Sikap </span>
           </span>
           <span class="value">
             Kosong
           </span>
         </div>

       </div>
       <div class="d-flex justify-content-center">
         <div class="">
           <span class="d-block">
             <span class="label">Jumlah Murid</span>
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


 <div class="row clearfix">
   <!-- Task Info -->
   <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
     <div class="card">
       <div class="header">
         <div class="col-md-5 col-xs-12" style="padding-bottom:15px">
           <h2 style='font-size:16px'>Agenda KBM</h2>
         </div>
         <div class="col-md-4" style="padding-bottom:5px">
           <select class="form-control show-tick id_kelas<?php echo $token; ?>" id="fkelas" onchange="reload_table()">
             <option value="">--- Pilih Kelas ---</option>
             <?php
              $dbkelas = $this->mdl->dataKelasAjar();
              foreach ($dbkelas as $val) {
                echo "<option value='" . $val->id_kelas . "'>" . $this->m_reff->goField("v_kelas", "nama", "where id='" . $val->id_kelas . "'") . "</option>";
              }
              ?>
           </select>
         </div>
         <div class="col-md-3 demo col-xs-12">

           <input id="ftanggal" readonly class="cursor form-control col-md-12 col-xs-12" type="text" onchange="reload_table()">
         </div>

         <br>
       </div>

       <!----->
       <div class="card">
         <div class="body" id="area_lod">
           <div class="table-responsive">
             <table id='table' class="tabel black table-bordered  table-hover dataTable" style="font-size:12px;width:100%">
               <thead class='sadow bg-teal'>
                 <th class='thead' style='min-width:80px'>DETAIL</th>
                 <th class='thead' width='15px'>&nbsp;NO</th>
                 <th class='thead'>TANGGAL</th>
                 <th class='thead'> KELAS</th>
                 <th class='thead'>MAPEL</th>
                 <th class='thead'>KI.KD</th>
                 <th class='thead'>MATERI</th>
                 <th class='thead'>PEMBAHASAN</th>


               </thead>
             </table>
           </div>
         </div>
       </div>
       <!----->

     </div>
   </div>
   <!-- #END# Task Info -->


   <script type="text/javascript">
     function hapus(id, akun) {
       alertify.confirm("<center>Hapus kbm ini ?</center>", function() {
         $.post("<?php echo site_url("kbm/hapus_kbm"); ?>", {
           id: id
         }, function() {
           reload_table();
         })
       })
     };



     var save_method; //for save method string
     var table;
     var dataTable = $('#table').DataTable({
       "paging": true,
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
         "sInfo": "Total :  _TOTAL_ , Halaman (_START_ - _END_)",
         "sInfoEmpty": "Tidak ada data yang di tampilkan",
         "sZeroRecords": "Data tidak tersedia",
         "lengthMenu": "Tampil _MENU_ Baris",
       },


       "serverSide": true, //Feature control DataTables' server-side processing mode.
       "responsive": false,
       "searching": true,
       "lengthMenu": [
         [5, 10, 30, 50, 100],
         [5, 10, 30, 50, 100],
       ],
       dom: 'Blfrtip',
       buttons: [
         // 'copy', 'csv', 'excel', 'pdf', 'print'

         {
           extend: 'excel',
           exportOptions: {
             columns: [0, 2, 3]
           },
           text: ' Excell',

         },

         {
           extend: 'colvis',
           exportOptions: {
             columns: [0, 2, 3]
           },
           text: ' Kolom',

         },


       ],

       // Load data for the table's content from an Ajax source
       "ajax": {
         "url": "<?php echo site_url('kbm/getRekap'); ?>",
         "type": "POST",
         "data": function(data) {
           data.id_kelas = $('#fkelas').val();
           data.tgl = $('#ftanggal').val();

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
         "targets": [0, -1, -2, -3, -4], //last column
         "orderable": false, //set not orderable
       }, ],

     });

     function reload_table() {
       dataTable.ajax.reload(null, false);
     };
   </script>





   <script>
     function absen_siswa(id_kelas, id, tgl, mapel) {
       $.post("<?php echo site_url("kbm/absen_siswa"); ?>", {
         id_kelas: id_kelas,
         id_jadwal: id,
         tgl: tgl,
         mapel: mapel
       }, function(data) {
         $("#mdl_modal_artikel").modal();
         $("#viewAdd").html(data);
       });

     }
   </script>



   <div class="modal fade" id="mdl_modal_artikel" tabindex="-1" role="dialog">
     <div class="modal-dialog" id="area_modal_artikel" role="document">

       <form action="javascript:submitForm('modal_artikel')" id="modal_artikel" url="<?php echo base_url() ?>kbm/insert_kbm" method="post" enctype="multipart/form-data">
         <div class="modal-content"> <span title="tutup" data-dismiss="modal" class="    pull-right waves-effect"><i class="material-icons">cancel</i> </span>
           <div class="modal-header">
             <h4 class="modal-title col-teal" id="defaultModalLabel">DATA ABSEN SISWA</h4>

           </div>
           <div class="modal-body">
             <div id="viewAdd"></div>



           </div>
         </div>


     </div>
     </form>
   </div><!-- /.modal-dialog -->










   <script>
     $('#ftanggal').daterangepicker({
       "showDropdowns": true,
       ranges: {
         'Hari ini': [moment(), moment()],
         'Kemarin': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
         '7 Hari yang lalu': [moment().subtract(6, 'days'), moment()],
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
       "startDate": "<?php echo $this->tanggal->minTgl(7, date("Y/m/d")); ?>",
       "endDate": "<?php echo date("d/m/Y"); ?>",
       "opens": "left"
     }, function(start, end, label) {
       console.log('New date range selected: ' + start.format('DD-MM-YYYY') + ' to ' + end.format('DD-MM-YYYY') + ' (predefined range: ' + label + ')');

     });
   </script>