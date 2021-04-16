<?php



Class M_analisis extends ci_model {


    function get_total($id_tagihan, $thn, $tk, $bln) {

        $thn1 = substr($thn, 0,4);
        $thn2 = substr($thn, 5,8);

        $this->load->model("M_reff");
        $ajaran = $this->M_reff->goField("tr_tahun_ajaran", "nama", "where id = '".$this->M_reff->tahun()."' ");

        //$qt = "SELECT * FROM v_siswa_tk WHERE id_tk ='".$tk."' ";

        $this->db->where("id_tk", $tk);
        $qt = $this->db->get("v_siswa_tk")->result_array();
        $ids = array();
		foreach ($qt as $id)
		{
		    $ids[] = $id['id_siswa'];
		}

        $sl = "
            id, 
            id_tagihan,
            nama_tagihan,
            tgl_tagihan,
            satuan,
            SUM(tagihan) AS jtagihan,
        ";

        $this->db->select($sl);
        $this->db->where("sts",1); //pembayaran oleh dana siswa bukan beasiswa
        $this->db->from("keu_tagihan_pokok");
        if ($tk!="") {
        	$this->db->where_in("id_siswa",$ids);
        }

        if ($thn == $ajaran) {
        	if ($bln!="") {
	        	$this->db->where("DATE_FORMAT(tgl_tagihan, '%Y-%m')>=", $thn1."-07");
		        $this->db->where("DATE_FORMAT(tgl_tagihan, '%Y-%m')<=", $bln);

	        }
	        else{
		        $this->db->where("DATE_FORMAT(tgl_tagihan, '%Y-%m')>=", $thn1."-07");
		        $this->db->where("DATE_FORMAT(tgl_tagihan, '%Y-%m')<=", $thn2."-06");
	        }
        }
        else{
        	$this->db->where("DATE_FORMAT(tgl_tagihan, '%Y-%m')>=", $thn1."-07");
	        $this->db->where("DATE_FORMAT(tgl_tagihan, '%Y-%m')<=", $thn2."-06");
        }
        $this->db->where("DATE_FORMAT(tgl_tagihan, '%Y-%m')>=", $thn1."-07");
        $this->db->where("DATE_FORMAT(tgl_tagihan, '%Y-%m')<=", $thn2."-06");
        $a = $this->db->get()->row_array();

        $sl2 = "
            id, 
            id_tagihan,
            nama_tagihan,
            tgl_tagihan,
            satuan,
            SUM(bayar) AS jbayar,
        ";

        $this->db->select($sl2);
             $this->db->where("sts",1); //pembayaran oleh dana siswa bukan beasiswa
        $this->db->from("keu_tagihan_pokok");
        if ($tk!="") {
        	$this->db->where_in("id_siswa",$ids);
        }
        
        if ($thn == $ajaran) {
        	if ($bln!="") {
	        	$this->db->where("DATE_FORMAT(tgl_tagihan, '%Y-%m')>=", $thn1."-07");
		        $this->db->where("DATE_FORMAT(tgl_tagihan, '%Y-%m')<=", $bln);

	        }
	        else{
		        $this->db->where("DATE_FORMAT(tgl_tagihan, '%Y-%m')>=", $thn1."-07");
		        $this->db->where("DATE_FORMAT(tgl_tagihan, '%Y-%m')<=", $thn2."-06");
	        }
        }
        else{
        	$this->db->where("DATE_FORMAT(tgl_tagihan, '%Y-%m')>=", $thn1."-07");
	        $this->db->where("DATE_FORMAT(tgl_tagihan, '%Y-%m')<=", $thn2."-06");
        }
        $this->db->where("DATE_FORMAT(tgl_tagihan, '%Y-%m')>=", $thn1."-07");
        $this->db->where("DATE_FORMAT(tgl_tagihan, '%Y-%m')<=", $thn2."-06");
        $b = $this->db->get()->row_array();

        $x = array(
                "jtagihan"  => $a["jtagihan"],
                "jbayar"    => $b["jbayar"]
            );

        return $x;
    }
    function get_data($id_tagihan, $thn, $tk, $bln) {
        /*
        $sl = "
            id, 
            id_tagihan,
            nama_tagihan,
            tgl_tagihan,
            satuan,
            SUM(tagihan) AS jtagihan,
            SUM(bayar) AS jbayar
        ";

        $this->db->select($sl);
        $this->db->from("keu_tagihan_pokok");
        $this->db->where("DATE_FORMAT(tgl_tagihan, '%Y-%m')>=", "2019-07");
        $this->db->where("DATE_FORMAT(tgl_tagihan, '%Y-%m')>=", "2020-06");
        $this->db->order_by("nama_tagihan");
        $this->db->group_by("id_tagihan");
        $a = $this->db->get()->result();
        return $a;*/

        //2019/2019
        //012345678
        $this->load->model("M_reff");
        $ajaran = $this->M_reff->goField("tr_tahun_ajaran", "nama", "where id = '".$this->M_reff->tahun()."' ");
        $thn1 = substr($thn, 0,4);
        $thn2 = substr($thn, 5,8);

        //$qt = "SELECT * FROM v_siswa_tk WHERE id_tk ='".$tk."' ";

        $this->db->where("id_tk", $tk);
        $qt = $this->db->get("v_siswa_tk")->result_array();
        $ids = array();
        foreach ($qt as $id)
        {
            $ids[] = $id['id_siswa'];
        }

        $sl = "
            id, 
            id_tagihan,
            nama_tagihan,
            tgl_tagihan,
            satuan,
            SUM(tagihan) AS jtagihan,
        ";

        $this->db->select($sl);
             $this->db->where("sts",1); //pembayaran oleh dana siswa bukan beasiswa
        $this->db->from("keu_tagihan_pokok");
        if ($tk!="") {
            $this->db->where_in("id_siswa",$ids);
        }

        if ($thn == $ajaran) {
        	if ($bln!="") {
	        	$this->db->where("DATE_FORMAT(tgl_tagihan, '%Y-%m')>=", $thn1."-07");
		        $this->db->where("DATE_FORMAT(tgl_tagihan, '%Y-%m')<=", $bln);

	        }
	        else{
		        $this->db->where("DATE_FORMAT(tgl_tagihan, '%Y-%m')>=", $thn1."-07");
		        $this->db->where("DATE_FORMAT(tgl_tagihan, '%Y-%m')<=", $thn2."-06");
	        }
        }
        else{
        	$this->db->where("DATE_FORMAT(tgl_tagihan, '%Y-%m')>=", $thn1."-07");
	        $this->db->where("DATE_FORMAT(tgl_tagihan, '%Y-%m')<=", $thn2."-06");
        }

        
        $this->db->where("id_tagihan", $id_tagihan);
        $a = $this->db->get()->row_array();

        $sl2 = "
            id, 
            id_tagihan,
            nama_tagihan,
            tgl_tagihan,
            satuan,
            SUM(bayar) AS jbayar,
        ";

        $this->db->select($sl2);
             $this->db->where("sts",1); //pembayaran oleh dana siswa bukan beasiswa
        $this->db->from("keu_tagihan_pokok");
        if ($tk!="") {
            $this->db->where_in("id_siswa",$ids);
        }

        if ($thn == $ajaran) {
        	if ($bln!="") {
	        	$this->db->where("DATE_FORMAT(tgl_tagihan, '%Y-%m')>=", $thn1."-07");
		        $this->db->where("DATE_FORMAT(tgl_tagihan, '%Y-%m')<=", $bln);

	        }
	        else{
		        $this->db->where("DATE_FORMAT(tgl_tagihan, '%Y-%m')>=", $thn1."-07");
		        $this->db->where("DATE_FORMAT(tgl_tagihan, '%Y-%m')<=", $thn2."-06");
	        }
        }
        else{
        	$this->db->where("DATE_FORMAT(tgl_tagihan, '%Y-%m')>=", $thn1."-07");
	        $this->db->where("DATE_FORMAT(tgl_tagihan, '%Y-%m')<=", $thn2."-06");
        }
        $this->db->where("id_tagihan", $id_tagihan);
        $b = $this->db->get()->row_array();

        $x = array(
                "jtagihan"  => $a["jtagihan"],
                "jbayar"    => $b["jbayar"]
            );

        return $x;
    }
    
    function get_biaya(){
      //  $this->db->order_by("nama_biaya", "asc");
        $x = $this->db->query("SELECT DISTINCT(nama_tagihan) AS nama_biaya,id_tagihan AS kode FROM keu_tagihan_pokok GROUP BY kode")->result();
        return $x;
    }

	function idu(){
		return $this->session->userdata("id");
	}

}

