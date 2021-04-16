<?php $token=date("His");?>
    <div class="col-md-12" align="center">
        <br>
        <button onclick="add()" type="button" class="btn-top btn  bg-teal waves-effect">
            <i class="material-icons">create</i> KIRIM PENGADUAN
        </button>

    </div>

    <div class="row clearfix">
        <!-- Task Info -->
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <div class="card">
                <div class="header row">
                    <div class="col-md-4 " style="padding-bottom:15px">
                        <h2 style='font-size:16px'><b>  PENGADUAN SISWA</b></h2> 
                    </div>

                </div>

                <div class="card">
                    <div class="body">
                        <div class="table-responsive">
                            <table id='table' class="tabel black table-bordered  table-hover dataTable" style="font-size:12px;width:100%">
                                <thead class='sadow bg-teal'>
                                    <th class='thead'>EDIT | HAPUS</th>
                                    <th class='thead' width='15px'>&nbsp;NO</th>
                                    <th class='thead'>KEPADA</th>
                                    <th class='thead'>PRIVACY</th>
                                    <th class='thead'>KETERANGAN</th>

                                </thead>
                            </table>
                        </div>
                    </div>
                </div>

            </div>
        </div>
        <!-- #END# Task Info -->
        <script type="text/javascript">
            function hapus(id,akun){
                   alertify.confirm("<center>Hapus pengaduan ini ?</center>",function(){
                     $.post("<?php echo site_url("catatan_siswa/hapus_catatan"); ?>",{id:id},function(){
                       reload_table();
                      })
                   })
            }

            var save_method; //for save method string
            var dataTable;
            dataTable = $('#table').DataTable({ 
             
                "processing": true, //Feature control the processing indicator.
                "serverSide": true, //Feature control DataTables' server-side processing mode.
                "searching":false,
                
                // Load data for the table's content from an Ajax source
                "ajax": {
                    "url": "<?php echo site_url('catatan_siswa/getCatatan');?>",
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

            function reload_table() {
                dataTable.ajax.reload(null, false);
            };

        </script>

        <script>
            function add() {
                $.post("<?php echo site_url("catatan_siswa/viewAdd "); ?>", {},
                    function(data) {
                        $("#mdl_modal_artikel").modal();
                        $("#viewAdd").html(data);
                });

            }
        </script>

        <div class="modal fade" id="mdl_modal_artikel" tabindex="-1" role="dialog">
            <div class="modal-dialog" id="area_modal_artikel" role="document">

                <form action="javascript:submitForm('modal_artikel')" id="modal_artikel" url="<?php echo base_url()?>catatan_siswa/insert_catatan" method="post" enctype="multipart/form-data">
                    <div class="modal-content"> <span title="tutup" data-dismiss="modal" class="pull-right waves-effect"><i class="material-icons">cancel</i> </span>
                        <div class="modal-header">
                            <h4 class="modal-title col-teal" id="defaultModalLabel">TAMBAHKAN PENGADUAN</h4>

                        </div>
                        <div class="modal-body">
                            <div id="viewAdd"></div>

                            <div class="modal-footer">
                                <span id="msg" class='pull-left'></span>
                                <div class="btn-group" role="group" aria-label="Default button group">

                                    <!--      <button  title="tutup"  data-dismiss="modal" class="btn bg-teal  waves-effect"><i class="material-icons">cancel</i> </button>
                                   -->
                                    <button id="submit" class="btn bg-teal waves-effect" onclick="submitForm('modal_artikel')"><i class="material-icons">save</i> SIMPAN</button>
                                </div>

                            </div>

                        </div>
                    </div>

            </div>
            </form>
        </div>
        <!-- /.modal-dialog -->

        <script>
            function edit(id) {

                $.post("<?php echo site_url("catatan_siswa/viewEdit "); ?>", {
                        id: id
                    },
                    function(data) {
                        $("#editan").html(data);
                        $("#mdl_modal_edit").modal();
                    });
            }
        </script>

        <div class="modal fade" id="mdl_modal_edit" tabindex="-1" role="dialog">
            <div class="modal-dialog" id="area_modal_edit" role="document">

                <form action="javascript:submitForm('modal_edit')" id="modal_edit" url="<?php echo base_url()?>catatan_siswa/update_catatan" method="post" enctype="multipart/form-data">
                    <div class="modal-content"> <span title="tutup" data-dismiss="modal" class="    pull-right waves-effect"><i class="material-icons">cancel</i> </span>
                        <div class="modal-header">
                            <h4 class="modal-title col-teal">Edit Catatan</h4>

                        </div>
                        <div class="modal-body">

                            <div id="editan"></div>

                            <div class="modal-footer">
                                <span id="msg" class='pull-left'></span>
                                <div class="btn-group" role="group" aria-label="Default button group">

                                    <!--         <button  title="tutup"  data-dismiss="modal" class="btn bg-teal  waves-effect"><i class="material-icons">cancel</i> </button>
                                -->
                                    <button id="submit" class="btn bg-teal waves-effect" onclick="submitForm('modal_edit')"><i class="material-icons">save</i> SIMPAN</button>
                                </div>

                            </div>

                        </div>
                    </div>

            </div>
            </form>
        </div>
        <!-- /.modal-dialog -->