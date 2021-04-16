
<?php  
        $opkikd = "";
        foreach ($kikd as $v) {

                if ($v->id == $data->id_kikd) {
                        $opkikd .= "<option value='".$v->id."' selected>".$v->kd3_no." - ".$v->kd3_desc." __ ".$v->kd4_no." - ".$v->kd4_desc."</option>";
                }
                else{
                        $opkikd .= "<option value='".$v->id."'>".$v->kd3_no." - ".$v->kd3_desc." __ ".$v->kd4_no." - ".$v->kd4_desc."</option>";
                }

                
        }

?>

<div class="row">
	<div class="col-md-12">
		<div class="form-group">
			<label>KIKD</label> 
			<select class="form-control" name="kikd" required="">
				<option value="">-- PILIH KIKD --</option>
                                <?php echo $opkikd ?>
			</select>
		</div>
		<div class="form-group">
			<label>Pembahasan</label> 
			<textarea class="form-control" name="bahas" style="min-height: 80px;" required=""><?php echo $data->cpembelajaran ?></textarea>
		</div>

                <input type="hidden" value="<?php echo $data->id ?>" name="id">
               
	</div>
</div>