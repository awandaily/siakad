<!-- main-content-body -->

<?php
if (isset($konten)) { ?>




    <!-- row -->
    <div class="row">



        <?php echo $this->load->view($konten); ?>



    </div>

<?php     } else {
    echo "File Konten Tidak Ada";
}; ?>