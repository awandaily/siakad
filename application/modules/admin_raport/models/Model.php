<?php

class Model extends CI_Model
{
	function __construct()
	{
		parent::__construct();
	}
	function idu()
	{
		return $this->session->userdata("id");
	}

	function getNilaiRataPengetahuanLegger($idsiswa, $mapel, $sms, $idguru)
	{

		$filter = "";
		$tahun = $this->m_reff->tahun();
		if ($mapel) {
			$filter = " AND id_mapel='" . $mapel . "'	";
		}

		$return = $this->db->query("SELECT AVG(nilai) as nilai from data_nilai where id_kategory_nilai='1' and id_tahun='" . $tahun . "' 
		and id_siswa='" . $idsiswa . "'   and id_semester='" . $sms . "' " . $filter . " ")->row();
		$return = isset($return->nilai) ? ($return->nilai) : "0";
		$return = number_format($return, 1);
		//return number_format($return,2);
		if (!$return) {
			return 0;
		} else {
			$ujian = $this->hasilUjianAkhir($idsiswa, $mapel, $sms);
			$hasil = (($return / 100 * 60) + $ujian);
			return number_format($hasil, 2);
		}
	}
	function hasilUjianAkhir($idsiswa, $mapel, $sms)
	{
		$uts = $this->getNilaiUts($idsiswa, $mapel, $sms);
		$uas = $this->getNilaiUas($idsiswa, $mapel, $sms);
		$a = ($uts + $uas) / 2;
		return ($a / 100) * 40;
	}
	function getNilaiUts($idsiswa, $mapel, $sms) //nilai rata2 UTS di bagi 30%
	{
		$filter = "";
		$tahun = $this->m_reff->tahun();
		if ($mapel) {
			$filter = " AND id_mapel='" . $mapel . "' ";
		}
		$return = $this->db->query("SELECT AVG(nilai) as nilai from data_nilai where id_kategory_nilai='2' and id_tahun='" . $tahun . "' 
		and id_siswa='" . $idsiswa . "'  and id_semester='" . $sms . "' " . $filter . " ")->row();
		$return = isset($return->nilai) ? ($return->nilai) : 0;
		return number_format($return, 2);
	}
	function getNilaiUas($idsiswa, $mapel, $sms) //nilai rata2 UTS di bagi 40%
	{
		$filter = "";
		$tahun = $this->m_reff->tahun();
		if ($mapel) {
			$filter = " AND id_mapel='" . $mapel . "'	";
		}
		$return = $this->db->query("SELECT AVG(nilai) as nilai from data_nilai where id_kategory_nilai='3' and id_tahun='" . $tahun . "' 
		and id_siswa='" . $idsiswa . "'  and id_semester='" . $sms . "' " . $filter . " ")->row();
		$return = isset($return->nilai) ? ($return->nilai) : 0;
		return number_format($return, 2);
	}

	function getNilaiRataKeterampilanLegger($idsiswa, $mapel, $sms, $idguru) //mengambil nilai max dari nilai keterampilan
	{

		$filter = "";
		$tahun = $this->m_reff->tahun();
		if ($mapel) {
			$filter = " AND id_mapel='" . $mapel . "' ";
		}
		$return = $this->db->query("SELECT AVG(nilai_ki) as nilai from data_nilai where id_kategory_nilai='1' and id_tahun='" . $tahun . "' 
		and id_siswa='" . $idsiswa . "'    and id_semester='" . $sms . "' " . $filter . " ")->row();
		$return = isset($return->nilai) ? ($return->nilai) : "0";
		return	$return = number_format($return, 2);
		if (!$return) {
			return 0;
		} else {
			$ujian = $this->hasilUjianAkhir($idsiswa, $mapel, $sms);
			$hasil = ((($return / 100) * 60) + $ujian);
			return number_format($hasil, 2);
		}
	}
	function getNilaiKBPengetahuan($id_mapel, $idguru, $idkelas = null)
	{
		$f = "";
		if ($idkelas) {
			$f = " AND id_kelas='$idkelas' ";
		}

		$sms = $this->m_reff->semester();
		$tahun = $this->m_reff->tahun();
		$r = $this->db->query("select AVG(kd3_kb) as nilai from v_kikd where id_mapel='" . $id_mapel . "' AND id_guru='" . $idguru . "' and id_tahun='" . $tahun . "' and id_semester='" . $sms . "' $f ")->row();
		return isset($r->nilai) ? ($r->nilai) : "";
	}
	function getNilaiKBKeterampilan($id_mapel, $idguru, $idkelas = null)
	{
		$f = "";
		if ($idkelas) {
			$f = " AND id_kelas='$idkelas' ";
		}

		$sms = $this->m_reff->semester();
		$tahun = $this->m_reff->tahun();
		$r = $this->db->query("select AVG(kd4_kb) as nilai from v_kikd where id_mapel='" . $id_mapel . "' AND id_guru='" . $idguru . "'   and id_tahun='" . $tahun . "' and id_semester='" . $sms . "' $f ")->row();
		return isset($r->nilai) ? ($r->nilai) : "";
	}

	function getNilaiRataSikap($idsiswa, $mapel, $sms, $idguru = null) ///
	{
		$tahun = $this->m_reff->tahun();
		$filter = "";
		if ($mapel) {
			$filter = " and id_mapel='" . $mapel . "' ";
		}


		//$this->db->where("id_guru",$idguru);
		$this->db->where("id_siswa", $idsiswa);
		$this->db->where("id_semester", $sms);
		if ($mapel) {
			$this->db->where("id_mapel", $mapel);
		}
		$this->db->where("id_tahun", $tahun);
		//	$this->db->select("AVG(((nilai1+nilai2+nilai3+nilai4+nilai5)/5)) as nilai");

		$return = $this->db->get("tm_sikap")->row();
		return  isset($return->nilai) ? ($return->nilai) : 0;
		//	return number_format($return,2);


	}
	function getNilaiEskul($idsiswa, $sms)
	{
		$tahun = $this->m_reff->tahun();
		$data = $this->db->query("select max(nilai) as nilai from tm_ekstrakurikuler where 
		id_siswa='" . $idsiswa . "' and id_tahun='" . $tahun . "' and id_semester='" . $sms . "'
		 ")->row();
		$return = isset($data->nilai) ? ($data->nilai) : 0;
		if (!$return) {
			return 0;
		}
		$return = $return * 0.02;


		return number_format($return, 2);
	}
	function NilaiMinKehadiran($idsiswa, $sms)
	{
		$tahun = $this->m_reff->tahun();
		$return = $this->db->query("SELECT * FROM tm_kh WHERE   id_siswa='" . $idsiswa . "'  
		 AND id_tahun='" . $tahun . "' AND id_semester='" . $sms . "' ")->row();
		$sakit = isset($return->sakit) ? ($return->sakit) : 0;
		$izin = isset($return->izin) ? ($return->izin) : 0;
		$alfa = isset($return->alfa) ? ($return->alfa) : 0;
		$return = (($sakit * 1) + ($izin * 2) + ($alfa * 3)) / 100;
		return number_format($return, 2);
	}

	function getJmlKehadiran($idsiswa, $sms, $sts)
	{
		$tahun = $this->m_reff->tahun();
		$sts = $this->m_reff->goField("tr_sts_kehadiran", "nama", "where id='" . $sts . "' ");
		$return = $this->db->query("SELECT " . $sts . " as jml FROM tm_kh WHERE   id_siswa='" . $idsiswa . "'  
		 AND id_tahun='" . $tahun . "' AND id_semester='" . $sms . "' ")->row();
		return isset($return->jml) ? ($return->jml) : "0";
	}
	function getNsNonMuslim($idsiswa)
	{
		$tahun = $this->m_reff->tahun();
		$sms = $this->m_reff->semester();
		$this->db->where("id_semester", $sms);
		$this->db->where("id_tahun", $tahun);
		$this->db->where("id_siswa", $idsiswa);
		$this->db->select("s");
		$get = $this->db->get("data_nilai_nonmuslim")->row();
		return isset($get->s) ? ($get->s) : 0;
	}
	function getNpNonMuslim($idsiswa)
	{
		$tahun = $this->m_reff->tahun();
		$sms = $this->m_reff->semester();
		$this->db->where("id_semester", $sms);
		$this->db->where("id_tahun", $tahun);
		$this->db->where("id_siswa", $idsiswa);
		$this->db->select("p");
		$get = $this->db->get("data_nilai_nonmuslim")->row();
		$return = isset($get->p) ? ($get->p) : 0;
		return number_format($return, 2);
	}
	function getNkNonMuslim($idsiswa)
	{
		$tahun = $this->m_reff->tahun();
		$sms = $this->m_reff->semester();
		$this->db->where("id_semester", $sms);
		$this->db->where("id_tahun", $tahun);
		$this->db->where("id_siswa", $idsiswa);
		$this->db->select("k");
		$get = $this->db->get("data_nilai_nonmuslim")->row();
		$return = isset($get->k) ? ($get->k) : 0;
		return number_format($return, 2);
	}
}
