<form action="<?php echo base_url();?>backupdb/backup" method="post">
    <select required="" name="tabel">
        <?php
        $nama="Tables_in_".$this->m_reff->tm_pengaturan(15);
           foreach ($tabel as $baris) {  ?>
            <option value="<?php echo $baris->$nama; ?>"><?php echo $baris->$nama; ?></option>
        <?php } ?>
    </select>
    <button type="submit" >Backup Database</button>
</form>


<?php echo form_open_multipart('home/restore');?>
    <input type="file" name="datafile" id="datafile" />
    <button type="submit" >Upload Database</button>
</form>