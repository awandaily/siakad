 <?php
 	$token=date('His');
 ?>

<div class="row clearfix">
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
	 	<div class="card" >
            <div class="header" style="padding: 10px;">
            	<div class="row">
                    <div class="col-sm-3">
                        <h2 style="padding-top: 10px;">DATA KATEGORI BUKU</h2>
                    </div>
                    <div class="col-sm-9">
                        <button class="btn-block aves-effect btn bg-teal" style="width: 110px;float: right;" onclick="add()">
                            <i class="material-icons">create</i> TAMBAH
                        </button>
                    </div>   
                </div>
            </div>

            <div class="body">
                <div class="row clearfix">
                    <div class="col-md-12">
                        <div class="table-responsive" id="area_lod">
                            <table class="entry" style="width: 100%" id="table">
                                <thead>
                                    <tr>
                                        <th width="5%">NO</th>
                                        <th>NAMA KATEGORI</th>
                                        <th>KETERANGAN</th>
                                        <th width="15%">ACTION</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
            	</div>
            </div>
	</div>
</div>

<div id="mdl_fadd" class="modal fade" role="dialog">
    <div class="modal-dialog" id="area_fadd">
        <div class="modal-content">
            <form id="fadd" action="javascript:submitForm('fadd')" method="post" url="<?php echo base_url() ?>master/save_kategori">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title" id="md-add-title"></h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12" id="content_fadd"></div>
                        <input type="hidden" name="edit_id">
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn-block aves-effect btn bg-teal" onclick="submitForm('fadd')">
                        <i class="material-icons">save</i> SIMPAN
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>



<script type="text/javascript">

    function add(){
        var id = "";
        $("input[name='edit_id']").val("");
        $.post("<?php echo base_url() ?>master/kategori_form", {id:id}, function(data){
            $("#md-add-title").html("TAMBAH DATA KATEGORI");
            $("#mdl_fadd").modal("show");
            $("#content_fadd").html(data);
        });
    }

    function edit(id, nm){
        $("input[name='edit_id']").val(id);
        $.post("<?php echo base_url() ?>master/kategori_form", {id:id}, function(data){
            $("#md-add-title").html("EDIT DATA KATEGORI <strong>"+nm+"</strong> ");
            $("#mdl_fadd").modal("show");
            $("#content_fadd").html(data);
        });
    }

    function hapus(id, nm){
        alertify.confirm("<center>Apakaha anda yakin akan menghapus data <strong>"+nm+"</strong> </center>", function() {
            $.post("<?php echo base_url()?>master/delete_kategori", {id: id}, function() {
                reload_table();
            })
        })
    }

    var  dataTable = $('#table').DataTable({ 
        "fixedHeader": true,
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
        "lengthMenu":
            [[10 , 30,50,100,200,300,400,500], 
            [10 , 30,50,100,200,300,400,500]], 
        "ajax": {
            "url": "<?php echo site_url('master/data_kategori');?>",
            "type": "POST",
            "data": function ( data ) {         
              //data.id_kelas = $('#id_kelas').val();                         
            },
            beforeSend: function() {
               loading("area_lod");
            },
            complete: function() {
              unblock('area_lod');
            },
            
        },

    });

    function reload_table(){
        dataTable.ajax.reload(null, false);
    }
</script>