<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
    <div class="card">
        <div class="header" style="padding: 10px;">
            <div class="row">
                <div class="col-md-2">
                    <h2 style="font-size:16px">GURU IZIN</h2> 
                </div>
                <div class="col-md-10">
                    <button  onclick="tambah_izin()"  type="button" class="btn pull-right bg-teal waves-effect">
                        <i class="material-icons">create</i>
                        Tambah
                    </button>
                </div>
            </div>
        </div>

        <div class="card" id="load">
            <div class="body">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped" style="width: 100%" id="table">
                        <thead>
                            <tr class='bg-teal col-white sadow'>
                                <th>NO</th>
                                <th>TANGGAL INPUT</th>
                                <th>NAMA PEGAWAI</th>
                                <th>MULAI</th>
                                <th>SAMPAI</th>
                                <th>KETERANGAN</th>
                                 <th>HAPUS</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    function tambah_izin()
    {
        $("#mdl_sbmt_izin").modal("show");
    }
</script>

<div id="mdl_sbmt_izin" class="modal fade" role="dialog">
  <div class="modal-dialog" id="area_sbmt">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Tambah Izin</h4>
      </div>
      <form method="POST" id="sbmt_izin" action="javascript:submitForm('sbmt_izin')" url="<?php echo base_url() ?>pd/insert_guru_izin">
      <div class="modal-body">
        
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label>Nama Pegawai</label><br>
                        <select class="form-control show-tick fkelas" name="f[id_guru]" data-live-search="true" required="">
                            <option value="">== PILIH PEGAWAI ==</option>
                            <?php
                                foreach ($pegawai as $vpegawai) {
                                    echo "<option value='".$vpegawai->id."'>".$vpegawai->nama."</option>";
                                }
                            ?>
                        </select>
                    </div>
                    <br>
                    <div class="form-group">
                        <label>Mulai Izin</label><br>
                        <input required type="text" id="tgl" autocomplete="off" name="start" class="form-control date_cokot" required="">
                    </div>
                    <br>
                    <div class="form-group">
                        <label>Sampai</label><br>
                        <input required type="text" id="tgl" autocomplete="off" name="end" class="form-control date_cokot" required="">
                    </div>
                    <br>
                    <div class="form-group">
                        <label>Keterangan</label><br>
                        <textarea class="form-control" name="f[ket]" required=""></textarea>
                    </div>
                </div>
            </div>
        
      </div>
      <div class="modal-footer">
        <button class="btn pull-right bg-teal waves-effect" onclick="submitForm('sbmt_izin')">SIMPAN</button>
      </div>
      </form>
    </div>

  </div>
</div>

<script type="text/javascript">
    var table;
    table = $('#table').DataTable({ 
        "searching":false,
        "processing": true, //Feature control the processing indicator.
        "serverSide": true, //Feature control DataTables' server-side processing mode.

        // Load data for the table's content from an Ajax source
        "ajax": {
            "url": "<?php echo site_url('pd/data_guru_izin');?>",
            "type": "POST",
        },

        //Set column definition initialisation properties.
        "columnDefs": [
        { 
          "targets": [ 0,-1,-2 ], //last column
          "orderable": false, //set not orderable
        },
        ],
    });

    function reload_table(){
        table.ajax.reload(null, false);
    }

    $('.date_cokot').daterangepicker({
        //maxDate: new Date(),
        "singleDatePicker": true,
        "showDropdowns": true,
        "dateLimit": {
            "days": 7
        },
        "autoApply": false,
        "drops": "down",
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
                "MIN",
                "SEN",
                "SEL",
                "RAB",
                "KAM",
                "JUM",
                "SAB"
            ],
            "monthNames": [
                "Januari",
                "Februari",
                "Maret",
                "April",
                "Mei",
                "Juni",
                "Juli",
                "Augustus",
                "September",
                "Oktober",
                "November",
                "Desember"
            ],
            "firstDay": 1
        },
        "showCustomRangeLabel": false,
        "startDate": "<?php echo date("d/m/Y")?>",   
    });
    $("select").selectpicker();
    function hapus_izin(id,nama)
    {
        alertify.confirm("<center>Hapus izin dari `<span class='col-pink'>"+nama+"</span>` ?</center>",function(){
		   $.post("<?php echo base_url()?>pd/hapus_izin",{id:id},function(){
			   reload_table();
		      })
		   }) 
    }
</script>



