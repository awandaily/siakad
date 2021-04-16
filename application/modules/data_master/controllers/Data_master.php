<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Data_master extends CI_Controller {

	

	function __construct()
	{
		parent::__construct();	
		$this->m_konfig->validasi_session(array("admin"));
		$this->load->model("M_dm","dm");
		date_default_timezone_set('Asia/Jakarta');
	}
	 
	function _template($data)
	{
	$this->load->view('template_admin/main',$data);	
	}
	 
	public function index()
	{

	$data['konten']="index";
	$this->_template($data);
	}
	
	public function listing()
	{

	$data['konten']="listing";
	$this->_template($data);
	}
	
	public function driver() //
	{

	$data['konten']="driver";
	$this->_template($data);
	}
	
	 
	function ajaxGetKab()
	{
		$id=$this->input->post("prov");
		$def=$this->input->post("def");
		$data=$this->reff->getKab($id);
		if($data)
		{
			$kab[""]="==== Pilih ====";
		 foreach ($data as $val) {
				 $kab[$val->id] = '['.$val->id.']'.' &nbsp;'.$val->kabupaten;
                 }
                 $dataKab = $kab;
                echo form_dropdown('kabupaten', $dataKab, $def, ' id="kabupaten" class="select2-container" style="width:100%" onchange="return cek_kab()"');     
		echo "<script>	$('#kabupaten').select2();</script>";
		}else{
			
			echo form_dropdown('kabupaten', array(), '', ' id="kabupaten" class="select2-container" style="width:100%"');     
			echo "<script>	$('#kabupaten').select2();</script>";
		}
	}
	
	function ajaxGetKab2()
	{
		$id=$this->input->post("prov");
		$def=$this->input->post("def");
		$data=$this->reff->getKab($id);
		if($data)
		{
			$kab[""]="==== Pilih ====";
		 foreach ($data as $val) {
				 $kab[$val->id] = '['.$val->id.']'.' &nbsp;'.$val->kabupaten;
                 }
                 $dataKab = $kab;
                echo form_dropdown('kabupaten', $dataKab, $def, ' id="kabupaten" class="form-control" style="width:100%" onchange="return cek_kab()"');     
		echo "<script>	$('#kabupaten').select2();</script>";
		}else{
			
			echo form_dropdown('kabupaten', array(), '', ' id="kabupaten" class="select2-container" style="width:100%"');     
			echo "<script>	$('#kabupaten').select2();</script>";
		}
	}
	function getKomplek($id)
	{
		$data=$this->reff->getKomplek($id);
		$result="";
		foreach($data as $data)
		{
			$result[]=$data->komplek;
		}
		echo json_encode($result);
	}
	function getOwn()
	{
		$data=$this->reff->getOwner();
		$result="";
		foreach($data as $data)
		{
			$result[]=$data->nama;
		}
		echo json_encode($result);
	}
	function infoFlash()
	{
		$msg='<script>alert("Success! Tersimpan")</script>';
		$this->session->set_flashdata("info",$msg);
	}
	function insert()
	{
			$this->infoFlash();
	echo	$this->property->insert();
	}
	function cek_alamat_js()
	{
	echo	$this->property->cek_alamat_js();
	}
	function cek_alamat_js_edit()
	{
	echo	$this->property->cek_alamat_js_edit();
	}
	function update()
	{
			$this->infoFlash();
	echo	$this->property->update();
	}
	function hapus($id)
	{
	echo	$this->property->hapus($id);
	}function hapusSelling($id)
	{
	echo	$this->property->hapusSelling($id);
	}
	function HapusAll($id)
	{
	echo	$this->property->HapusAll($id);
	}function HapusAllSelling($id)
	{
	echo	$this->property->HapusAllSelling($id);
	}
	
	function ajax_property()
	{
		$level=$this->session->userdata("level");
		$list = $this->property->get_dataProperty();
        $data = array();
        $no = $_POST['start']+1;
		
        foreach ($list as $val) {
			$cancel='';
			//$status=$val->status;
			$type=$val->type_jual;
			if($type=="sewa")
			{ 
				if($val->status=="1")
				{	$status="Rented ";
					$onclik="onclick='return setBelumLaku(`".$val->kode_prop."`,`Tersewa`)'";
					$setitle="Set Unsold";
				}elseif($val->status=="2"){
					$onclik="onclick='return setBelumLaku(`".$val->kode_prop."`,`Tersewa`)'";
					$setitle="Set Rented";$status="<font color='red'>Cancel ".$this->reff->cancelBy($val->alasan_cancel)."  </font>   ";
				}elseif($val->status=="0"){
					$onclik="onclick='goSewa(`".$val->id_prop."`)'";
					$setitle="Set Sold";$status="Rent  ";
					$cancel='<li style="margin-left:-10px" onclick="return cancel(`'.$val->kode_prop.'`)"  ><a href="#"><i class="fa fa-check-circle"></i> Cancel </a></li>';
				}else{
				 
					$onclik="onclick='return setBelumLaku(`".$val->kode_prop."`,`Tersewa`)'";
					$setitle="Set Rented";$status="<font color='red'>Sold By Other ".$this->reff->cancelBy($val->alasan_cancel)."  </font>   ";
				}
			}elseif($type=="jual"){
				if($val->status=="1")
				{
					$onclik="onclick='return setBelumLaku(`".$val->kode_prop."`,`Terjual`)'";
					$setitle="Set unsold";$status="Sold  ";
				}elseif($val->status=="2"){
					$onclik="onclick='return setBelumLaku(`".$val->kode_prop."`,`Terjual`)'";
					$setitle="Set Sold";$status="<font color='red'>Cancel ".$this->reff->cancelBy($val->alasan_cancel)."  </font>   ";
				}elseif($val->status=="0"){
					$onclik="onclick='goJual(`".$val->id_prop."`)'";
					$setitle="Set Sold";$status="Sell";
					$cancel='<li style="margin-left:-10px" onclick="return cancel(`'.$val->kode_prop.'`)"  ><a href="#"><i class="fa fa-check-circle"></i> Cancel </a></li>';
				}else{	
				$onclik="onclick='return setBelumLaku(`".$val->kode_prop."`,`Terjual`)'";
					$setitle="Set Unsold";$status="<font color='red'>Sold By Other ".$this->reff->cancelBy($val->alasan_cancel)."  </font>   ";
				}
				
			}else{
					$onclik="onclick='return setBelumLaku(`".$val->kode_prop."`,`Cancel`)'";
					$setitle="Set Sold";			
					$status="<font color='red'>Cancel</font>  ";
			}
			
			
			$row = array();
			$row[] =  '<input type="checkbox" class="pilih" onclick="pilcek()" name="hapus[]" value="'.$val->id_prop.'">';
			//$row[] = $no++;
            $row[] = "<a href='javascript:detail(`".$val->kode_prop."`)'>".$val->kode_prop."</a>";
            $row[] = $this->reff->getNamaJenis($val->jenis_prop);
            $row[] = number_format($val->harga+$val->fee_up,0,",",".");
			$row[] = $val->alamat_detail;// + area listing + 										gx usah= alamat proprty(nanti di display) 
			$row[] = $val->area_listing; //|| area-listing
			
			if($level!="dm") {   $row[] = "<a href='javascript:detailVendor(`".$val->id_owner."`)'>".$this->reff->getNamaOwner($val->id_owner)."</a>"; }
			
          
            $row[] = $this->reff->getNamaAgen($val->agen). "<br>".$val->agen;
            $row[] = "Diupload : ".$this->reff->cekJumlahGambar($val->id_prop)."   <br>Factsheet :".$this->reff->cekGambarDesain($val->id_prop);
     
			$row[] = $status;
           if($this->session->userdata("level")!="dm")
		   {
            $row[] = '
			<div class="btn-group">
<button type="button" class="btn-default dropdown-toggle" data-toggle="dropdown">
Action <span class="caret"></span>
</button>
<ul class="dropdown-menu" role="menu" style="color:black;font-size:15px;margin-left:-40px">
<li style="margin-left:-10px"><a href="javascript:detail(`'.$val->kode_prop.'`)"><i class="fa fa-eye"></i> Detail</a></li>
<li style="margin-left:-10px"><a href="'.base_url().'data_property/edit/'.$val->id_prop.'"><i class="fa fa-edit"></i> Edit</a></li>
<li style="margin-left:-10px"><a href="#" onclick="return hapusP(`'.$val->id_prop.'`)"><i class="fa fa-trash-o"></i> Delete</a></li>
<li style="margin-left:-10px"><a href="#" onclick="return setNetwork(`'.$val->id_prop.'`)"><i class="fa  fa-hand-o-right"></i> Set Network</a></li>
<li class="divider"></li>
<li style="margin-left:-10px" '.$onclik.' ><a href="#"><i class="fa fa-check-circle"></i> '.$setitle.'</a></li>
'.$cancel.'

</a></li>
</ul>
</div>
			';
		   }else{
			    $row[] = '<a href="#" onclick="return detail(`'.$val->kode_prop.'`)" class="btn btn-primary"><i class="fa fa-eye"></i> detail</a>';
		   }
            $data[] = $row;
        }
        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->property->counts(),
            "recordsFiltered" => $this->property->counts(),
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);
	}
	
	
	function ajax_driver()//
	{
		$list = $this->dm->ajax_driver();
        $data = array();
        $no = $_POST['start']+1;
        foreach ($list as $val) {
			$row = array();
			$row[] =  '<input type="checkbox" class="pilih" onclick="pilcek()" name="hapus[]" value="'.$val->id_admin.'">';
           
          	$row[] = "<center><img src='".base_url()."file_upload/dp/".$data->poto."' width='80px'></center>";
          	$row[] = $val->owner;
          	$row[] = $val->owner;
          	$row[] = $val->owner;
          	$row[] = $val->owner;
          	$row[] = $val->owner;
          	$row[] = $val->owner;
          	$row[] = $val->owner;
          	$row[] = $val->owner;
            
            $row[] = '
			<a href="#" class="btn btn-xs btn-primary"   ><i class="fa fa-edit"></i> Edit </a>
			<a href="#" class="btn btn-danger" onclick="return hapusSelling(`'.$val->id_admin.'`)" ><i class="fa fa-edit"></i> Delete </a>
			';
            $data[] = $row;
        }
        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->dm->counts_ajax_driver(),
            "recordsFiltered" => $this->dm->counts_ajax_driver(),
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);
	}
	function getListing()
	{
	$provinsi=$this->input->post("provinsi");
	$kabupaten=$this->input->post("kabupaten");
	$area=$this->input->post("area");
	$lat_area=$this->input->post("lat_area");
	$long_area=$this->input->post("long_area");
	$jenis_pro=$this->input->post("jenis_pro");
	$type_pro=$this->input->post("type_pro");
	$kamar_tidur=$this->input->post("kamar_tidur");
	$kamar_mandi=$this->input->post("kamar_mandi");
	$garasi=$this->input->post("garasi");
	$daya_listrik=$this->input->post("daya_listrik");
	$harga_min=$this->input->post("harga_min");
	$harga_max=$this->input->post("harga_max");
	$sertifikat=$this->input->post("sertifikat");
	$agen=$this->input->post("agen");
	$type_sewa=$this->input->post("type_sewa");
	$kelengkapan=$this->input->post("kelengkapan");
	$status_penjualan=$this->input->post("status_penjualan");
	$jenis_list=$this->input->post("jenis_list");
	$furniture=$this->input->post("furniture");
	$air=$this->input->post("air");
	$fee_persen=$this->input->post("fee_persen");
	$fee_nominal=$this->input->post("fee_nominal");
	$fee_up=$this->input->post("fee_up");
	$tgl_masuk_listing=$this->tanggal->eng_($this->input->post("tgl_masuk_listing"),"-");
	$filter['filter']="?tgl_masuk_listing=$tgl_masuk_listing&fee_up=$fee_up&fee_nominal=$fee_nominal&fee_persen=$fee_persen&air=$air&furniture=$furniture&jenis_list=$jenis_list&type_pro=$type_pro&provinsi=$provinsi&kabupaten=$kabupaten&area=$area&lat_area=$lat_area&long_area=$long_area&jenis_pro=$jenis_pro&kamar_mandi=$kamar_mandi&kamar_tidur=$kamar_tidur&garasi=$garasi&daya_listrik=$daya_listrik&harga_min=$harga_min&harga_max=$harga_max&sertifikat=$sertifikat&agen=$agen&type_sewa=$type_sewa&kelengkapan=$kelengkapan&status_penjualan=$status_penjualan";
	echo	$this->load->view("getListing",$filter);
	}
	
	
	function getDriver() //
	{
	$provinsi=$this->input->post("provinsi");
	$kabupaten=$this->input->post("kabupaten");
	$area=$this->input->post("area");
	$lat_area=$this->input->post("lat_area");
	$long_area=$this->input->post("long_area");
	$jenis_pro=$this->input->post("jenis_pro");
	$type_pro=$this->input->post("type_pro");
	$kamar_tidur=$this->input->post("kamar_tidur");
	$kamar_mandi=$this->input->post("kamar_mandi");
	$garasi=$this->input->post("garasi");
	$daya_listrik=$this->input->post("daya_listrik");
	$harga_min=$this->input->post("harga_min");
	$harga_max=$this->input->post("harga_max");
	$sertifikat=$this->input->post("sertifikat");
	$agen=$this->input->post("agen");
	$type_sewa=$this->input->post("type_sewa");
	$kelengkapan=$this->input->post("kelengkapan");
	$status_penjualan=$this->input->post("status_penjualan");
	$jenis_list=$this->input->post("jenis_list");
	$furniture=$this->input->post("furniture");
	$air=$this->input->post("air");
	$fee_persen=$this->input->post("fee_persen");
	$fee_nominal=$this->input->post("fee_nominal");
	$fee_up=$this->input->post("fee_up");
	$tgl_masuk_listing=$this->tanggal->eng_($this->input->post("tgl_masuk_listing"),"-");
	$filter['filter']="?tgl_masuk_listing=$tgl_masuk_listing&fee_up=$fee_up&fee_nominal=$fee_nominal&fee_persen=$fee_persen&air=$air&furniture=$furniture&jenis_list=$jenis_list&type_pro=$type_pro&provinsi=$provinsi&kabupaten=$kabupaten&area=$area&lat_area=$lat_area&long_area=$long_area&jenis_pro=$jenis_pro&kamar_mandi=$kamar_mandi&kamar_tidur=$kamar_tidur&garasi=$garasi&daya_listrik=$daya_listrik&harga_min=$harga_min&harga_max=$harga_max&sertifikat=$sertifikat&agen=$agen&type_sewa=$type_sewa&kelengkapan=$kelengkapan&status_penjualan=$status_penjualan";
	echo	$this->load->view("getDriver",$filter);
	}
	
	
	
	function getDataDetail()
	{
		$data['kode_prop']=$this->input->post("id");
	echo	$this->load->view("dataDetail",$data);
	}
	function getFormSewa($id)
	{	$data["id"]=$id;
		$this->load->view("formSewa",$data);
	}function getFormJual($id)
	{	$data["id"]=$id;
		$this->load->view("formJual",$data);
	}
	function getListingEditSewa($id)
	{	$data["id"]=$id;
		$this->load->view("FormEditSewa",$data);
	}function getListingEditJual($id)
	{	$data["id"]=$id;
		$this->load->view("FormEditJual",$data);
	}
	function insertSellingJual()
	{
		echo $this->property->insertSellingJual();
	}function UpdateSelling()
	{
		echo $this->property->UpdateSelling();
	}function UpdateSellingSewa()
	{
		echo $this->property->UpdateSellingSewa();
	}function insertSellingSewa()
	{
		echo $this->property->insertSellingSewa();
	}
	function setBelumLaku($kode)
	{
	echo	$this->property->updateListingStatus($kode,"0","");
	}
	function setCancel($kode)
	{
	echo	$this->property->updateListingStatus($kode,"2","");
	}
	function soldByOwner($kode)
	{
		echo	$this->property->soldByOwner($kode,"2");
	}
	
	
	
	
	
	function getHistory()
	{
		 ?>						
			<ul style='width:100%;list-style:none;margin-left:-20px'>
			<?php
			$history=$this->reff->getReportProp($this->input->post("id"));
			foreach($history as $list)
			{?>
				 


						<br>
						<li class="clearfix" style="border-bottom:black solid 0.5px">
						<div class="post-time" style='font-size:12px'>
						<i class="fa fa-calendar"></i> <?php echo $this->tanggal->hariLengkapJam($list->tgl,"/")?>
						<a class="pull-right" style="font-size:15px;color:red" title="Delete" href="javascript:hapus(`<?php echo $list->id;?>`)">&times;</a>
						</div>
						<div class="title">
						<a href="#"><?php echo $this->reff->getReportTitle($list->id_title);?></a> 
						
						</div>

						<div class="text black sadow5">
									<?php echo $list->ket;?>
									</div>
						</li>

						 


						<?php }
						?>

						 </ul>
						<?php
		}
	 function goExpired()
	 {
		 $tgl=$this->input->post("tgl");
		$data=explode("/",$tgl);
		 if(count($data))
		 {
			 $thn=$data[2]+1;
			echo $data[0]."/".$data[1]."/".$thn; 
		 }
	 }
				
	function saveReport()
	{
		echo $this->property->saveReport();
	}
	
	function delHistory($id)
	{
		echo $this->property->delHistory($id);
	}
	
	function export()
	{
		$this->property->export();
	}
	function export_selling()
	{
		$this->property->export_selling();
	}
	function saveStatus()
	{
		$s=$this->input->get_post("s");
		$id=$this->input->get_post("id");
		echo $this->property->saveStatus($id,$s);
	}
	function cekNetwork($id)
	{
		$this->db->where("id_prop",$id);
		$data=$this->db->get("data_property")->row();
	return isset($data->id_network)?($data->id_network):"";
	}
	function setNetwork($id)
	{
		 $kab[""]="==== Pilih ====";
		 $this->db->where("jabatan","100");
		 $this->db->order_by("nama","ASC");
		 $data=$this->db->get("data_agen")->result();
		 foreach ($data as $val) {
				 $kab[$val->id_agen] = $val->nama." - ".$val->alamat;
                 }
                 $dataKab = $kab;
                echo form_dropdown('id_network', $dataKab, $this->cekNetwork($id), ' id="id_network" class="form-control select2-container" style="width:100%"');    
				echo "<input type='hidden' name='id_prop' value='".$id."'>";
	}
	function saveNetwork()
	{
		$id_prop=$this->input->get_post("id_prop");
		$id_network=$this->input->get_post("id_network");
		$this->db->set("id_network",$id_network);
		$this->db->where("id_prop",$id_prop);
		echo $this->db->update("data_property");
	}
	
	public function word(){
		 	  error_reporting(0);
		header ("Content-type: text/html; charset=utf-8");
		
		$this->load->library('PHPWord');
        $this->load->helper('download');
		
		$PHPWord = new PHPWord();	
		$val=$grid = $this->property->get_one($this->input->get_post("id"))->row();
		if($k=$val->komplek){ $kom= "- Komplek : $k ";}else{ $kom="";};
		
	    $document 		   = $PHPWord->loadTemplate('format2.docx');		
		$document->setValue('{kode_prop}',$grid->kode_prop);
		$document->setValue('{jenis}',$this->reff->getNamaJenis($grid->jenis_prop));
		$document->setValue('{vendor}', $this->reff->getNamaOwner($val->id_owner));
		$document->setValue('{land}', $val->luas_tanah);
		$document->setValue('{kt}', $val->kamar_tidur );
		$document->setValue('{km}', $val->kamar_mandi);
		$document->setValue('{ktp}', $val->kamar_tidur_p);
		$document->setValue('{kmp}', $val->kamar_mandi_p);
		$document->setValue('{electricity}', $val->daya_listrik);
		$document->setValue('{status}', $this->reff->getNamaJenisSertifikat($val->jenis_sertifikat));
		$document->setValue('{garage}',  $val->jml_garasi);
		$document->setValue('{compas}', $this->reff->getNamaHadap($val->hadap));
		$document->setValue('{entry_date}', $this->tanggal->ind($val->tgl_masuk_listing,"/"));
		$document->setValue('{expire_date}', $this->tanggal->ind($val->tgl_expired,"/"));
		$document->setValue('{desc}', $val->desc );
		$document->setValue('{loc}', $this->reff->getNamaKab($val->id_kab)." - ". $val->nama_area." - ".$val->alamat_detail." ".$kom );
		 
		$document->setValue('{price}', number_format($val->harga+$val->fee_up,0,",","."));
		$document->setValue('{member}', $this->reff->getNamaAgenByKode($val->agen));
		$document->setValue('{building}',$val->luas_bangunan);
		$document->setValue('{floor}', $val->jml_lantai);
		$document->setValue('{furniture}', $this->reff->getNamaFurniture($val->furniture));
		$document->setValue('{carport}', $val->jml_carports);
		$document->setValue('{water}', $this->reff->getNamaAir($val->air));
		
		//$document->setValue('{gambar1}',array('src' => base_url().'file_upload/img/'.$val->gambar1,'swh'=>'250'));
//	$document->setImageValue('{gambar1}',base_url().'file_upload/img/'.$val->gambar1);
				
		   $history=$this->reff->getReportProp($val->kode_prop);
			$date=array();$kategory=array();$note=array();
			foreach($history as $list)
			{								
				$date[]=$this->tanggal->hariLengkapJam($list->tgl,"/");
				$kategory[]= $this->reff->getReportTitle($list->id_title);
				$note[]= $list->ket;
			}
					$data1 = array(
					'date' => $date,
					'kategory' => $kategory,
					'note' => $note,
					 );
				$document->cloneRow('tb', $data1);	
		
	//	$image_path=base_url()."file_upload/img/".$val->gambar1;
	//	$document->save_image('{gambar1}',$image_path,$document);
		
		$namafile = str_replace(" ","",$val->kode_prop).'.docx';
		$tmp_file = "plug/".$namafile.'';
		$document->save($tmp_file);
		 
    
        $pth    =   file_get_contents(FCPATH."plug/".$namafile."");
		$nme    =   "ID:".str_replace(" ","",$val->kode_prop).".docx";
		unlink(FCPATH."plug/".$namafile);
		force_download($nme, $pth); 
		
	}
	
	
}