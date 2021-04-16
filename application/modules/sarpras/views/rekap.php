

<?php  
  
  $optanah = "";
  foreach ($tanah as $vtanah) {
    $optanah.="<option value='".$vtanah->id."'>".$vtanah->nama_tanah."</option>";
  }

?>


<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
    <div class="card">
        <div class="header row">
          <div class="col-md-10 " style="padding-bottom:15px" >     
            <h2 style='font-size:16px'><b>REKAP ASET</b></h2> 
          </div>
		      <div class="col-md-2 col-xs-12"  align="center" style="margin-top:20px">
            <!-- 
					   <button onclick="add()" type="button" class="btn-top pull-right btn btn-block bg-teal waves-effect">
                <i class="material-icons">print</i>
                 Print
              </button>-->
          </div>
        </div>

        <div class="body">
          <div class="table-responsive">
            <table class="table table-bordered">
              <thead>
                <tr>
                  <th>Tanah</th>
                  <th><center><?php echo $total["tnh"] ?></center></th>
                  <th>Bangunan</th>
                  <th><center><?php echo $total["bng"] ?></center></th>
                </tr>
                <tr>
                  <th>Ruangan</th>
                  <th><center><?php echo $total["rng"] ?></center></th>
                  <th>Barang</th>
                  <th><center><?php echo $total["brg"] ?></center></th>
                </tr>

              </thead>
            </table>

          </div>
          
          <hr>

          <div class="row">
            <div class="col-sm-3">
              <div class="form-group">
                <select class="form-control" id="src_kondisi" onchange="reload_table()">
                  <option value="">== Pilih Kondisi ==</option>
                  <option value="rusak">Qty Rusak</option>
                  <option value="baik">Qty Baik</option>
                </select>
              </div>
            </div>
            <div class="col-sm-3">
              <div class="form-group">
                <select class="form-control" id="src_tanah" onchange="sel_bangunan(this.value)">
                  <option value="">== Pilih Tanah ==</option>
                  <?php echo $optanah; ?>
                </select>
              </div>
            </div>
            <div class="col-sm-3">
              <div class="form-group" id="fbangunan">
                <select class="form-control" id="src_bangunan" onchange="sel_ruangan(this.value)">
                  <option value="">== Pilih Bangunan ==</option>
                </select>
              </div>
            </div>
            <div class="col-sm-3">
              <div class="form-group" id="fruangan">
                <select class="form-control" id="src_ruangan" onchange="reload_table()">
                  <option value="">== Pilih Ruangan ==</option>
                </select>
              </div>
            </div>
          </div>
          <div class="table-responsive">
           <table class="table table-bordered" id="dt-barang" style="width: 100%">
             <thead>
               <th>Nama Barang</th>
               <th>Qty Baik</th>
               <th>Qty Rusak</th>
               <th>Keterangan</th>
               <th>Tanah</th>
               <th>Banguan</th>
               <th>Ruangan</th>
               
             </thead>
             <tbody>
               
             </tbody>
           </table>
          </div>


        </div>
    </div>
</div>

<script type="text/javascript">
  

    var table_barang;
    table_barang = $('#dt-barang').DataTable({ 
          "searching": true,
          "processing": true, //Feature control the processing indicator.
          "serverSide": true, //Feature control DataTables' server-side processing mode.
          
          // Load data for the table's content from an Ajax source
          "ajax": {
              "url": "<?php echo site_url('sarpras/getBarangFull');?>",
              "type": "POST",
              "data":function ( d ) {
                  return $.extend( {}, d, {
                    "src_kondisi": $('#src_kondisi').val(),
                    "src_tanah": $('#src_tanah').val(),
                    "src_bangunan": $('#src_bangunan').val(),
                    "src_ruangan": $('#src_ruangan').val(),
                  })
              }
       
          },

          //Set column definition initialisation properties.
          "columnDefs": [
            { 
              "targets": [ 0], //last column
              "orderable": false, //set not orderable
            },
          ],
          "dom": 'Blfrtip',
          "buttons": [
            'excel'
          ],
      
    });

  function reload_table(){
     table_barang.ajax.reload();
  }

  function sel_bangunan(id){
    if (id!="") {
      $.post("<?php echo site_url("sarpras/get_select"); ?>",{id:id, type:"bangunan"},function(data){
         $("#fbangunan").html(data);
         reload_table();  
      })
    }

  }
  function sel_ruangan(id){
    if (id!="") {
      $.post("<?php echo site_url("sarpras/get_select"); ?>",{id:id, type:"ruangan"},function(data){
         $("#fruangan").html(data);
         reload_table();  
      })
    }

  }

</script>