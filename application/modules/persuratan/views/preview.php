<?php  
	//error_reporting(0);
	$id 	= $_GET["id"];
	$print 	= $_GET["print"];

	$tahun  = $this->m_reff->tahun();
	$sms 	= $this->m_reff->semester();

	$template = $this->m_reff->goField("tm_persuratan", "template", "WHERE id='".$id."' ");

	$link_kop = $this->m_reff->goField("tm_pengaturan", "val", "WHERE id='12'");
	$kop_surat = "<img src='".base_url()."file_upload/img/".$link_kop."' width='660' height='90' align='center' /><br>";
	$ada = "wadaw";

	$exec = $this->m_reff->goField("tm_persuratan", "exec", "WHERE id='".$id."' ");

	//eval('return'.$exec.';');
	$template = str_replace("{sekolah}", "SMK PGRI SUBANG", $template);

	if (isset($_GET['id_siswa'])) {
		$this->db->where("id", $_GET['id_siswa']);
		$siswa = $this->db->get('v_siswa')->row_array();

		//tahun masuk area
		$tingkat 	= $siswa['id_tk'];
		$idmasuk 	= ($tingkat-1);
		$idthnmsk 	= ($tahun - $idmasuk);

		$tahun_masuk = $this->m_reff->goField("tr_tahun_ajaran", "nama", "WHERE id='".$idthnmsk."'");
	}
	else{
		$tahun_masuk = "";
	}

	if (isset($_GET['id_pegawai'])) {
		$this->db->where("id", $_GET['id_pegawai']);
		$pegawai = $this->db->get('v_pegawai')->row_array();
	}

	if (isset($_GET['tgl'])) {
		$tglSys = $this->tanggal->eng_($_GET['tgl'], "-");
		$tgl_surat = $this->tanggal->indBulan($tglSys, " ");
	}
	else{
		$tgl_surat = "";
	}

	if ($print == "true") {
		$arr = json_decode($exec, true);
		for($i = 0;$i < count($arr);$i++){
			//echo $arr[$i]["exec"];
			eval('return'.$arr[$i]["exec"].';');
		}
	}
	else{
		//echo "false";
	}

	//kepsek area
	$this->db->where("id", $tahun);
	$kepsek = $this->db->get("tr_tahun_ajaran")->row_array();

	

	$template = str_replace("{tahun_masuk}", $tahun_masuk, $template);
	$template = str_replace("{nama_kepsek}", $kepsek["nama_kepsek"], $template);
	$template = str_replace("{tgl}", $tgl_surat, $template);
	

?>
<page format="210x310" backtop="5mm" backbottom="1mm" backleft="10mm" backright="1mm">
	<?php
		//echo $exec;
		echo $kop_surat;
		echo $template;
	?>
</page>
