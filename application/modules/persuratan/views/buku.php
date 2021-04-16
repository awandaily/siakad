 <?php
 	$token=date('His');

    $level = $this->m_reff->level();

    if ($level == "ADMIN PERPUS") {
        $act = "";
    }
    else{
        $act = "hide";
    }

 ?>



<div class="row clearfix">
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
	 	<div class="card" >
            <div class="header" style="padding: 10px;">
            	<div class="row">
                    <div class="col-sm-2">
                        <h2 style="padding-top: 10px;">DATA BUKU</h2>
                    </div>

                    <div class="col-sm-10 <?php echo $act ?>">
                        <button class="btn-block aves-effect btn bg-teal" style="width: 110px;float: right;" onclick="add()">
                            <i class="material-icons">create</i> TAMBAH
                        </button>
                    </div>   
                </div>
            </div>

            <div class="body">
                <div class="row">
                    <div class="col-sm-3">
                        <select class="form-control show-tick" data-live-search="true" id="fkategori" onchange="reload_table()">
                            <option value="">== CARI KATEGORI ==</option>
                            <?php
                                foreach ($kt as $vkt) {
                                    echo "<option value='".$vkt->id_kategori."'>".$vkt->nama_kategori."</option>";
                                }
                            ?>
                        </select>
                    </div>
                    <div class="col-sm-3">
                        <select class="form-control show-tick" data-live-search="true" id="frak" onchange="reload_table()">
                            <option value="">== CARI PENYIMPANAN ==</option>
                            <?php
                                foreach ($rk as $vrk) {
                                    echo "<option value='".$vrk->id_rak."'>".$vrk->nama_rak."</option>";
                                }
                            ?>
                        </select>
                    </div>
                    <div class="col-sm-3">
                        <input type="text" class="form-control" id="fnama" placeholder="Cari Buku..." onchange="reload_table()">
                    </div>
                    <div class="col-sm-3">
                        <input type="text" class="form-control" id="fkode" placeholder="Cari Kode Buku..." onchange="reload_table()">
                    </div>
                </div>
                <div class="row clearfix">
                    <div class="col-md-12">
                        <div class="table-responsive" id="area_lod">
                            <table class="entry col-md-12" style="width: 100%" id="table">
                                <thead>
                                    <tr>
                                        <th width="5%">NO</th>
                                        <th>NAMA BUKU</th>
                                        <th>KODE BUKU</th>
                                        <th>KATEGORI</th>
                                        <th>PENYIMPANAN</th>
                                        <th>PENGARANG</th>
                                        <th>PENERBIT</th>
                                        <th>STATUS PINJAM</th>
                                        <?php
                                        if($this->session->userdata("level")=="admin perpus"){
                                            echo '  <th width="20%">ACTION</th>';
                                         
                                      } ?>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
            	</div>
            </div>
	</div>
</div>

<div id="mdl_det" class="modal fade" role="dialog">
    <div class="modal-dialog" id="area_det">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title" id="md-det-title"></h4>
            </div>
            <div class="modal-body">
                <div class="row" id="dt-det">
                </div>
            </div>
        </div>
    </div>
</div>

<div id="mdl_fadd" class="modal fade" role="dialog">
    <div class="modal-dialog" id="area_fadd">
        <div class="modal-content">
            <form id="fadd" action="javascript:submitFormNoResset('fadd')" method="post" url="<?php echo base_url() ?>master/save_buku">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title" id="md-add-title"></h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div id="content_fadd"></div>
                        </div>
                        <input type="hidden" name="edit_id">
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn-block aves-effect btn bg-teal" onclick="submitFormNoResset('fadd')">
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
        $.post("<?php echo base_url() ?>master/buku_form", {id:id}, function(data){
            $("#md-add-title").html("TAMBAH DATA BUKU");
            $("#mdl_fadd").modal("show");
            $("#content_fadd").html(data);
            $("input[name='f[tag]']").tagsinput();
        });
    }

    function edit(id, nm){
        $("input[name='edit_id']").val(id);
        $.post("<?php echo base_url() ?>master/buku_form", {id:id}, function(data){
            $("#md-add-title").html("EDIT DATA BUKU <strong>"+nm+"</strong> ");
            $("#mdl_fadd").modal("show");
            $("#content_fadd").html(data);
        });
    }

    function hapus(id, nm){
        alertify.confirm("<center>Apakaha anda yakin akan menghapus data <strong>"+nm+"</strong> </center>", function() {
            $.post("<?php echo base_url()?>master/delete_buku", {id: id}, function() {
                reload_table();
            })
        })
    }

    function detail(id, nm){
        $.post("<?php echo base_url()?>master/detail_buku", {id: id}, function(data) {
            $("#md-det-title").html("DETAIL DATA BUKU <strong>"+nm+"</strong> ");
            $("#mdl_det").modal("show");
            $("#dt-det").html(data);
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
                    "sZeroRecords": "<center>Data tidak tersedia</center>",
                    "lengthMenu": "Tampil _MENU_ Baris",  
        },       
        "serverSide": true, //Feature control DataTables' server-side processing mode.
        "responsive": false,
        "searching": false,
        "lengthMenu":
            [[10 , 30,50,100,200,300,400,500], 
            [10 , 30,50,100,200,300,400,500]], 
        dom: 'Blfrtip',
		buttons: [
           // 'copy', 'csv', 'excel', 'pdf', 'print' 
		{
			extend: 'excel',
            exportOptions: {
                columns:[ 0,1,2,3,4,5,6]
            },
            text:'Download Excell',
						
        },
					
	 
					
        ],
        "ajax": {
            "url": "<?php echo site_url('master/data_buku');?>",
            "type": "POST",
            "data": function ( data ) {         
              data.id_kategori = $('#fkategori').val();   
              data.id_rak = $('#frak').val();
              data.nama_buku = $('#fnama').val();
              data.kode_buku = $('#fkode').val();                           
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