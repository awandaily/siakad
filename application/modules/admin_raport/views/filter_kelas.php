<?php $token = date("His"); ?>


<div class="row clearfix">
    <!-- Task Info -->
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
        <div class="card">
            <div class="header row">
                <div class="col-md-5">
                    <h2 style='font-size:16px'><b>Pilih Kelas</b></h2>
                </div>
                <div class="col-md-5  " style="padding-bottom:10px">
                    <select class="form-control  show-tick fkelas<?php echo $token; ?>" onchange='getkelas()' id="fkelas" data-live-search="true">
                        <option value="">=== Filter Kelas ===</option>

                        <?php
                        $db = $this->db->get("tr_tingkat")->result();
                        foreach ($db as $val) {
                            echo "<optgroup label='TINGKAT " . $val->nama . "'>";

                            $dbs = $this->db->get_where("v_kelas", array("id_tk" => $val->id))->result();
                            foreach ($dbs as $vals) {
                                echo "<option value='" . $vals->id . "'>" . $vals->nama . "</option>";
                            }

                            echo "</optgroup>";
                        }
                        ?>

                    </select>


                </div>
                <div class="body">
                    <div class="table-responsive">
                        <div id="datasiswa"></div>
                    </div>

                </div>

            </div>


        </div>

    </div>


    <!-- #END# Task Info -->




    <script>
        function getkelas() {
            console.log("masuk get kelas")
            var idkelas = $("#fkelas").val();
            $.post("<?php echo site_url("admin_raport/dataSiswa"); ?>", {
                idkelas: idkelas
            }, function(data, status) {
                $("#datasiswa").html(data);

            });
        };
    </script>