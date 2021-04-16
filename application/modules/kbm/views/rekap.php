 <?php $token = date("His"); ?>

 <!-- breadcrumb -->
 <div class="breadcrumb-header justify-content-between">
   <div>
     <h4 class="content-title mb-2">Rekapitulasi </h4>
     <nav aria-label="breadcrumb">
       <ol class="breadcrumb">
         <li class="breadcrumb-item"><a href="#">Rekapitulasi</a></li>
         <li class="breadcrumb-item active" aria-current="page"> Riwayat Mengajar</li>
       </ol>
     </nav>
   </div>

 </div>
 <!-- /breadcrumb -->


 <!-- Task Info -->
 <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
   <div class="card">
     <div class="header">
       <div class="col-md-5 col-xs-12" style="padding-bottom:15px">
         <h2 style='font-size:16px'>Agenda KBM</h2>
       </div>
       <div class="col-md-4" style="padding-bottom:5px">
         <select class="form-control show-tick id_kelas<?php echo $token; ?>" id="fkelas" onchange="reload_table()">
           <option value="">--- filter kelas ---</option>
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
               <th class='thead' width="100px">HAPUS</th>
               <th class='thead' style='min-width:80px'>ABSEN</th>

               <th class='thead'>TANGGAL</th>
               <th class='thead'> KELAS</th>
               <th class='thead'>MAPEL</th>
               <th class='thead'>KD</th>

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

 <div id="mdl_f_edit_rekap" class="modal fade" role="dialog">
   <div class="modal-dialog">
     <form action="javascript:submitForm('f_edit_rekap')" id="f_edit_rekap" url="<?php echo base_url() ?>kbm/update_rekap" method="post" enctype="multipart/form-data">
       <div class="modal-content">
         <div class="modal-header">
           <button type="button" class="close" data-dismiss="modal">&times;</button>
           <h4 class="modal-title">Edit Pembahasan / KIKD</h4>
         </div>
         <div class="modal-body" id="form-edit">

         </div>
         <div class="modal-footer">
           <button class="btn bg-teal waves-effect" onclick="submitForm('f_edit_rekap')">SIMPAN</button>
         </div>
       </div>
     </form>

   </div>
 </div>
 <script type="text/javascript">
   function edit(id) {
     $("#mdl_f_edit_rekap").modal("show");
     $.post("<?php echo site_url("kbm/edit_rekap"); ?>", {
       id: id
     }, function(data) {
       $("#form-edit").html(data);
     });
   }

   function hapus(id, akun) {
     alertify.confirm("<center>Hapus riwayat mengajar ini ?</center>", function() {
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
       [30, 50, 100],
       [30, 50, 100],
     ],
     dom: 'Blfrtip',
     buttons: [
       // 'copy', 'csv', 'excel', 'pdf', 'print'

       {
         extend: 'excel',
         exportOptions: {
           columns: [2, 3, 4, 5, 6]
         },
         text: ' Download Excell',

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
   function absen_siswa_rekap(id_kelas, id, tgl, mapel) {
     $.post("<?php echo site_url("kbm/absen_siswa"); ?>", {
       id_kelas: id_kelas,
       id_jadwal: id,
       tgl: tgl,
       mapel: mapel
     }, function(data) {
       $("#mdl_modal_artikel_rekap").modal();
       $("#viewAdds").html(data);
     });

   }
 </script>



 <div class="modal fade" id="mdl_modal_artikel_rekap" tabindex="-1" role="dialog">
   <div class="modal-dialog" id="area_modal_artikel_rekap" role="document">

     <form action="javascript:submitForm('modal_artikel_rekap')" id="modal_artikel_rekap" url="<?php echo base_url() ?>kbm/insert_kbm" method="post" enctype="multipart/form-data">
       <div class="modal-content"> <span title="tutup" data-dismiss="modal" class="    pull-right waves-effect"><i class="material-icons">cancel</i> </span>
         <div class="modal-header">
           <h4 class="modal-title col-teal" id="defaultModalLabel">DATA ABSEN SISWA</h4>

         </div>
         <div class="modal-body">
           <div id="viewAdds"></div>



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
     "startDate": "<?php echo $this->tanggal->minTgl(30, date("Y/m/d")); ?>",
     "endDate": "<?php echo date("d/m/Y"); ?>",
     "opens": "left"
   }, function(start, end, label) {
     console.log('New date range selected: ' + start.format('DD-MM-YYYY') + ' to ' + end.format('DD-MM-YYYY') + ' (predefined range: ' + label + ')');

   });
 </script>