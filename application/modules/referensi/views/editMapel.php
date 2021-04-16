 <input type="hidden" name="id" value="<?php echo $this->input->post("id"); ?>">
 <?php
    $id_tk = $this->input->post("id_tk");
    $id_jurusan = $this->input->post("id_jurusan");
    $nama = $this->input->post("nama");
    $k = $this->input->post("k");
    $id_mapel_induk = $this->input->post("id_mapel_induk");
    ?>
 <div class="row clearfix">
     <div class="col-lg-3 col-md-3  form-control-label">
         <label for="email_address_2" class="col-black">PILIH TINGKAT</label>
     </div>
     <div class="col-lg-8 col-md-8  ">
         <div class="form-group">
             <div class="form-line">
                 <?php

                    $ray[1] = "Tingkat X";
                    $ray[2] = "Tingkat XI";
                    $ray[3] = "Tingkat XII";

                    $dataray = $ray;
                    echo form_dropdown("f[id_tk]", $dataray, $id_tk, 'id="id_tk" class="form-control show-tick"  required   onchange="getSub()"  ');
                    ?>
             </div>
         </div>
     </div>
 </div>

 <div class="row clearfix">
     <div class="col-lg-3 col-md-3  form-control-label">
         <label for="email_address_2" class="col-black">PILIH JURUSAN</label>
     </div>
     <div class="col-lg-8 col-md-8  ">
         <div class="form-group">
             <div class="form-line">
                 <?php
                    $db = $this->db->get("tr_jurusan")->result();
                    foreach ($db as $val) {
                        $ray[$val->id] = $val->alias;
                    }
                    $dataray = $ray;
                    echo form_dropdown("f[id_jurusan]", $dataray, $id_jurusan, 'id="jurusan" class="form-control show-tick"  required onchange="getSub()" ');
                    ?>
             </div>
         </div>
     </div>
 </div>

 <div class="row clearfix">
     <div class="col-lg-3 col-md-3  form-control-label">
         <label for="email_address_2" class="col-black">NAMA MAPEL</label>
     </div>
     <div class="col-lg-8 col-md-8  ">
         <div class="form-group">
             <div class="form-line" id="data_mapel">
                 <input type="text" required class="form-control" name='f[nama]' value="<?php echo $nama; ?>">
             </div>
         </div>
     </div>
 </div>

 <div class="row clearfix">
     <div class="col-lg-3 col-md-3  form-control-label">
         <label for="email_address_2" class="col-black">KATEGORY </label>
     </div>
     <div class="col-lg-8 col-md-8  ">
         <div class="form-group">
             <div class="form-line">
                 <?php
                    $ray = array();
                    $datak = $this->db->get("tr_kategory_mapel")->result();
                    foreach ($datak as $dk) {
                        $ray[$dk->kode] = $dk->nama;
                    }
                    $ray["ujol"] = "CBT";
                    $dataray = $ray;
                    echo form_dropdown("f[k_mapel]", $dataray, $k, 'class="form-control show-tick"  required ');
                    ?>
             </div>
         </div>
     </div>
 </div>

 <div class="row clearfix">
     <div class="col-lg-3 col-md-3  form-control-label">
         <label for="email_address_2" class="col-black">SUB MAPEL DARI </label>
     </div>
     <div class="col-lg-8 col-md-8  ">
         <div class="form-group">
             <div class="form-line" id="submapel">
                 <?php
                    $ray = array();
                    $ray[""] = "---- Pilih Jika Sub Mapel ----";
                    $this->db->where("id_tk", $id_tk);
                    $this->db->where("id_jurusan", $id_jurusan);
                    $data = $this->db->get("tr_mapel")->result();
                    foreach ($data as $data) {
                        $ray[$data->id] = $data->nama;
                    }

                    $dataray = $ray;
                    echo form_dropdown("f[id_mapel_induk]", $dataray, $k, 'class="form-control show-tick"   ');
                    ?>
             </div>
         </div>
     </div>
 </div>


 <script>
     $('select').selectpicker();
 </script>

 <script>
     function getSub() {
         var id_tk = $("#id_tk").val();
         var id_jurusan = $("#jurusan").val();
         $.post("<?php echo site_url("referensi/getSubMapel"); ?>", {
             id_tk: id_tk,
             id_jurusan: id_jurusan
         }, function(data) {
             $("#submapel").html(data);
         });
     }
 </script>