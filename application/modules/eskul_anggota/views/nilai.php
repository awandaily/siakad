<?php
$this->db->where("kode", $this->mdl->kode());
$this->db->where("id_eskul", $this->mdl->ids());
$data = $this->db->get("eskul_group")->num_rows();


$this->db->where("id_eskul", $this->mdl->ids());
$dataAnggota = $this->db->get("eskul_anggota")->row();
if (!$data) {
    echo "Anda belum menambahkan Group Kelas.";
    return false;
}
$jml = isset($dataAnggota->j_siswa) ? ($dataAnggota->j_siswa) : "";
if (strlen($jml) < 10) {
    echo "Anda belum menambahkan anggota.";
    return false;
}
$token = date("His"); ?>
<div class="row clearfix">
    <!-- Task Info -->
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
        <div class="card">
            <div class="header">




                <h2 class="sound">INPUT NILAI SEMESTER</h2>

            </div>
            <div class="body">
                <div class="row clearfix">

                    <div class="col-sm-3 col-black">
                        <select class="form-control show-tick" id="id_kelasf<?php echo $token; ?>" data-live-search="true">
                            <option value="">=== pilih kelas ===</option>


                            <?php
                            $db = $this->db->get("tr_tingkat")->result();
                            foreach ($db as $val) {
                                echo "<optgroup label='TINGKAT " . $val->nama . "'>";
                                $this->db->order_by("nama", "ASC");
                                $dbs = $this->db->get_where("v_kelas", array("id_tk" => $val->id))->result();
                                foreach ($dbs as $vals) {
                                    echo "<option value='" . $vals->id . "'>" . $vals->nama . "</option>";
                                }

                                echo "</optgroup>";
                            }
                            ?>

                        </select>
                    </div>



                    <div class="col-sm-3">
                        <select class="form-control show-tick" id="genderf<?php echo $token; ?>">
                            <option value="">=== gender ===</option>
                            <option value="l">Laki-laki</option>
                            <option value="p">Perempuan</option>

                        </select>
                    </div>
                    <div class="col-sm-3">
                        <select class="form-control show-tick" id="groupf<?php echo $token; ?>">

                            <?php
                            $this->db->where("kode", $this->mdl->kode());
                            $this->db->where("id_eskul", $this->mdl->ids());
                            $datagrop = $this->db->get("eskul_group")->result();
                            foreach ($datagrop as $val) {
                                echo "<option value='" . $val->id . "' label='" . $val->nama . "'>" . $val->nama . "</option>";
                            } ?>
                        </select>
                    </div>
                    <div class="col-sm-3">
                        <input type="text" class='form-control' id="searching" placeholder="pencarian.." onchange='reload_table()'>
                    </div>

                    <div class="col-sm-3">
                        <button class="btn waves-effect bg-teal" onclick="setNilaiG()">
                            <i class="material-icons">format_indent_increase</i>
                            GENERETE NILAI PER GROUP
                        </button>
                    </div>






                </div>

                <div class="cardd" id="area_lod">
                    <div cass="body">
                        <div class="table-responsive">
                            <table id='tabel' class="tabel table-striped black table-bordered  table-hover dataTable" style="font-size:12px;width:100%">
                                <thead class='sadow bg-teal'>
                                    <th class='thead' style='max-width:3px'>NO</th>

                                    <th class='thead'>
                                        <center>SISWA</center>
                                    </th>


                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
                <!----->
            </div>
        </div>
    </div>
    <!-- #END# Task Info -->




    <script type="text/javascript">
        var dataTable = $('#tabel').DataTable({
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
            "searching": false,
            scrollY: 400,
            deferRender: true,
            scroller: true,
            "lengthMenu": [
                [10, 30, 50, 100, 200, 300, 400, 500, 1000, 2000],
                [10, 30, 50, 100, 200, 300, 400, 500, 1000, 2000]
            ],
            dom: 'Blfrtip',
            scrollY: 370,
            buttons: [
                // 'copy', 'csv', 'excel', 'pdf', 'print'




            ],

            // Load data for the table's content from an Ajax source
            "ajax": {
                "url": "<?php echo site_url('eskul_anggota/data_nilai'); ?>",
                "type": "POST",
                "data": function(data) {

                    data.id_kelas = $('#id_kelasf<?php echo $token; ?>').val();
                    data.gender = $('#genderf<?php echo $token; ?>').val();
                    data.group = $('#groupf<?php echo $token; ?>').val();
                    data.searching = $('#searching').val();


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
        $(document).on('change', '#groupf<?php echo $token; ?>,#id_tahun_masukf<?php echo $token; ?>,#id_kelasf<?php echo $token; ?>,#genderf<?php echo $token; ?>,#aktifasif<?php echo $token; ?>,#id_status_ibuf<?php echo $token; ?>,#id_status_ayahf<?php echo $token; ?>,#id_penghasilanf<?php echo $token; ?>,#id_pekerjaan_ibuf<?php echo $token; ?>,#id_pekerjaan_ayahf<?php echo $token; ?>', function(event, messages) {

            dataTable.ajax.reload(null, false);

        });

        function setNilai(idsiswa, idtbl, nama, nilai, ket) {
            $("#judul_tinjau").html("INPUT NILAI");
            $("#defaultModalLabel").html(nama);
            $("#mdl_formSubmit").modal();
            $("[name='id']").val(idsiswa);
            $("[name='nilai']").val(nilai);
            $("[name='nilai']").trigger("change");
            $("#ket").val(ket);

        }

        function setNilaiG() {
            var group = $("#groupf<?php echo $token; ?> option:checked").attr("label");
            var id_group = $("#groupf<?php echo $token; ?>").val();

            $("#md-title-g").html("Me-Generete Semua Nilai Group : " + group);
            $("#mdl_fg").modal();
            $("#id_group").val(id_group);
        }




        function reload_table() {
            dataTable.ajax.reload(null, false);
        }

        function filter() {

            $("#mdl_filter").modal();

        }
    </script>











    <script>
        $('.select').selectpicker();
        $(".tmt").inputmask("99/99/9999");
        $(".thn").inputmask("9999/9999");
    </script>
    <div class="modal fade" id="mdl_fg" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">

                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">
                        <span aria-hidden="true">×</span>
                        <span class="sr-only">Close</span>
                    </button>
                    <h4 class="modal-title" id="md-title-g"></h4>
                </div>
                <form action="javascript:submitForm(`fg`)" method="post" id="fg" url="<?php echo base_url() ?>eskul_anggota/inputNilaiG">

                    <div class="modal-body" id="area_fg">

                        <input type="hidden" id="id_group" name="id_group"><br>
                        <label for="nilai" class="col-black" style="padding-top:10px;">Nilai</label>
                        <div class="form-group">
                            <div class="form-line">
                                <!--
                                        <input type="text" id="nilai" class="form-control" required name="nilai" >-->
                                <select class="form-control" id="gnilai" required="" name="gnilai">
                                    <option value="">== PILIH NILAI ==</option>
                                    <option value="A">SANGAT BAIK</option>
                                    <option value="B">BAIK</option>
                                    <option value="C">CUKUP</option>
                                    <option value="D">KURANG</option>
                                </select>
                            </div>
                        </div>

                        <label for="ket" class="col-black">Keterangan</label>
                        <div class="form-group">
                            <div class="form-line">
                                <textarea name="f[ket]" class="form-control" required placeholder='contoh: Aktif dalam kegiatan'></textarea>
                            </div>
                        </div>



                    </div>
                    <div class="modal-footer">
                        <button onclick="submitForm(`fg`)" class="waves-effect btn col-white   bg-teal "><i class="material-icons">save</i> SIMPAN</button>

                    </div>
                </form>
            </div>
        </div>
    </div>



    <div class="modal fade" id="mdl_formSubmit" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">

                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">
                        <span aria-hidden="true">×</span>
                        <span class="sr-only">Close</span>
                    </button>
                    <h4 class="modal-title" id="defaultModalLabel"></h4>
                </div>
                <form action="javascript:submitForm(`formSubmit`)" method="post" id="formSubmit" url="<?php echo base_url() ?>eskul_anggota/inputNilai">

                    <div class="modal-body">
                        <input type="hidden" name="id">

                        <label for="nilai" class="col-black" style="padding-top:10px;">Nilai</label>
                        <div class="form-group">
                            <div class="form-line">

                                <input type="text" id="nilai" class="form-control" required name="nilai">
                                <!-- <select class="form-control" id="nilai" required="" name="nilai">
                                    <option value="">== PILIH NILAI ==</option>
                                    <option value="A">SANGAT BAIK</option>
                                    <option value="B">BAIK</option>
                                    <option value="C">CUKUP</option>
                                    <option value="D">KURANG</option>
                                </select> -->
                            </div>
                        </div>

                        <label for="ket" class="col-black">Keterangan</label>
                        <div class="form-group">
                            <div class="form-line">
                                <textarea name="f[ket]" class="form-control" id="ket" required placeholder='contoh: Aktif dalam kegiatan'></textarea>
                            </div>
                        </div>



                    </div>
                    <div class="modal-footer">
                        <button onclick="submitForm(`formSubmit`)" class="waves-effect btn col-white   bg-teal "><i class="material-icons">save</i> SIMPAN</button>

                    </div>
                </form>
            </div>
        </div>
    </div>