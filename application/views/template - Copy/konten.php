<!-- main-content-body -->

<?php
if (isset($konten)) { ?>

    <div class="main-content-body content" id="loadKontent">
        <!--
        <div class="container-fluid">
             
        </div>-->
        <?php echo $this->load->view($konten); ?>
    </div>
<?php     } else {
    echo "File Konten Tidak Ada";
}; ?>

>