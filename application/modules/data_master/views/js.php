

<?php echo $this->load->view("js/form.phtml"); ?>
  <script type="text/javascript">
function simpanListing(){
	  $(".info").html('<img src="<?php echo base_url()?>plug/img/load.gif"> Process Simpan...');
     $('#form').ajaxForm({
     url:'<?php echo base_url();?>data_property/insert',
     type: 'post',
     data: $('#form').serialize(),
     success: function (data)
                {
				window.location.href="<?php echo base_url()?>data_property/add";
                },
	 });			
	
};
</script>  

  <script type="text/javascript">
function updateListing(){
	  $(".info").html('<img src="<?php echo base_url()?>plug/img/load.gif"> Process Simpan...');
     $('#form').ajaxForm({
     url:'<?php echo base_url();?>data_property/update',
     type: 'post',
     data: $('#form').serialize(),
     success: function (data)
                {
				window.location.href="<?php echo base_url()?>data_property/listing";
                },
	 });			
	
};
</script>    	  


<!----------------------------------------------------------------------------------------------------------------------------->
<script>
function back()
{
		var numpage=$("[name='count']").val();
		if(numpage==2)
		{
			go_step1();			
		}
		if(numpage==3)
		{
			go_step2();
		}
		if(numpage==4)
		{
			go_step3();
		}
		if(numpage==5)
		{
			go_step4();
		}
}
function cek()
{
	var numpage=$("[name='count']").val();
	if(numpage==1)
	{
		var c_type_pro=cek_type_pro();
		var c_type_list=cek_type_list();
		var c_kode_list=cek_kode_list();
		var c_desc=cek_desc();
		var c_jenis_list=cek_jenis_list();
		if(c_type_pro==true && c_kode_list==true && c_type_list==true && c_desc==true && c_jenis_list==true)
		{
			go_step2();
		}
	}
	if(numpage==2)
	{
		var c_prov=cek_prov();
		var c_kab=cek_kab();
	//	var c_komplek=cek_komplek();
		var c_area=cek_area();
		var c_alamat=cek_alamat();
		if(c_prov==true && c_kab==true  && c_area==true && c_alamat==true )
		{
			go_step3();
		}
	}
	
	if(numpage==3)
	{
		var c_tanah=cek_tanah();
		var c_hadap=cek_hadap();
		var c_bangunan=cek_bangunan();
		var c_harga=cek_harga();
		
	/*	var c_dibangun=cek_dibangun();
		var c_tidur=cek_tidur();
		var c_mandi=cek_mandi();
		var c_tidur_p=cek_tidur_p();
		var c_mandi_p=cek_mandi_p();
		var c_lantai=cek_lantai();
		var c_carports=cek_carports();
		var c_garasi=cek_garasi();
		
		var c_sewa=cek_sewa();
		var c_agen=cek_agen();
		var c_sertifikat=cek_sertifikat();
		if(c_sertifikat==true && c_sewa==true && c_agen==true && c_garasi==true && c_hadap==true && c_tidur_p==true && c_mandi_p==true && c_tanah==true && c_bangunan==true && c_dibangun==true && c_harga==true && c_tidur==true && c_mandi==true && c_lantai==true && c_carports==true )
		{
			go_step4();
		}*/
	if(c_tanah==true  && c_bangunan==true && c_harga==true)	
	{
		go_step4();
	}
		
	}
	if(numpage==4)
	{
		var a=window.confirm("Simpan Sekarang ?");
		if(a==true)
		{
			simpanListing();
		}else{
			alert("false");
		}
	}
}


function kalkulasi()
{
	var luas_tanah=$("[name='luas_tanah']").val();
	var harga=$("[name='harga_tanah']").val();
	luas_tanah=luas_tanah.replace(".", "");
	luas_tanah=luas_tanah.replace(".", "");
	luas_tanah=luas_tanah.replace(".", "");
	luas_tanah=luas_tanah.replace(".", "");
	luas_tanah=luas_tanah.replace(".", "");
	harga=harga.replace(".", "");
	harga=harga.replace(".", "");
	harga=harga.replace(".", "");
	harga=harga.replace(".", "");
	harga=harga.replace(".", "");
	harga=harga.replace(".", "");
	var total=luas_tanah*harga;
	$("[name='harga']").val(total);
}
 

function cek_type_pro()
{
	
	var type_pro=$("#type_pro").val();	
	var type_list=$("#type_list").val();	
	var desc=$("#desc").val();	
	 
	if(type_pro=="5"){
		 
		$(".harga_tanah_lb").show();
		$("#luas_bangunan_lb").hide();
		$(".title_harga").html("Price Total");
		
	}else{
		$(".harga_tanah_lb").hide();
		$("#luas_bangunan_lb").show();
		$(".title_harga").html("Prices");
	}
	if(!type_pro)
	{
		$(".fg_type_pro").addClass("has-error");
		$(".err_type_pro").html("Mohon dipilih");
		return false;
	}else{
		$(".fg_type_pro").addClass("has-success");
		$(".fg_type_pro").removeClass("has-error");
		$(".err_type_pro").html("");
		return true;
	}
}

function cek_jenis_list()
{
	var type_list=$('input[name=jenis_list]:checked').val();
	if(type_list==null)
	{
		$(".fg_jenis_list").addClass("has-error");
		$(".err_jenis_list").html("Mohon dipilih");
		return false;
	}else{
		$(".fg_jenis_list").addClass("has-success");
		$(".fg_jenis_list").removeClass("has-error");
		$(".err_jenis_list").html("");
		return true;
	}
}
function cek_type_list()
{
	var type_list=$('input[name=type_list]:checked').val();
	if(type_list==null)
	{
		$(".fg_type_list").addClass("has-error");
		$(".err_type_list").html("Mohon dipilih");
		return false;
	}else{
		$(".fg_type_list").addClass("has-success");
		$(".fg_type_list").removeClass("has-error");
		$(".err_type_list").html("");
		return true;
	}
}
function cek_desc()
{
	var type_desc=$('#desc').val();
	if(type_desc=="")
	{
		$(".fg_desc").addClass("has-error");
		$(".err_desc").html("Mohon diisi");
		return false;
	}else{
		$(".fg_desc").addClass("has-success");
		$(".fg_desc").removeClass("has-error");
		$(".err_desc").html("");
		return true;
	}
}
function cek_kode_list()
{
	var type_desc=$('#kode').val();
	if(type_desc=="")
	{
		$(".fg_kode_list").addClass("has-error");
		$(".err_kode_list").html("Mohon diisi");
		return false;
	}else{
		$(".fg_kode_list").addClass("has-success");
		$(".fg_kode_list").removeClass("has-error");
		$(".err_kode_list").html("");
		return true;
	}
}
</script>		


<script>
function go_step1()
{
		$(".lanjut").removeClass("hilang");
		$(".save").addClass("hilang");
	$(".step1").removeClass("hilang");
	$(".step2").addClass("hilang");;
	$(".step3").addClass("hilang");;
	$(".step4").addClass("hilang");;
	$(".step5").addClass("hilang");;
	$("#step1").removeClass("hilang");;
	$(".steps li").removeClass("active");
	$(".badge").removeClass("badge-primary");
	
	$("#step1").addClass("active");
	$(".badge1").addClass("badge-primary");
	$("[name='count']").val("1");
}
function go_step2()
{
	$(".step2").removeClass("hilang");;
	$(".step1").addClass("hilang");;
	$(".step3").addClass("hilang");;
	$(".step4").addClass("hilang");;
	$(".step5").addClass("hilang");;
	$("#step2").removeClass("hilang");;
	$(".steps li").removeClass("active");
	$(".badge").removeClass("badge-primary");
	
	$("#step2").addClass("active");
	$(".badge2").addClass("badge-primary");
	$("[name='count']").val("2");
}

function go_step3()
{
		$(".lanjut").removeClass("hilang");
		$(".save").addClass("hilang");
	$(".step1").addClass("hilang");;
	$(".step2").addClass("hilang");;
	$(".step3").removeClass("hilang");;
	$(".step4").addClass("hilang");;
	$(".step5").addClass("hilang");;
	$("#step3").removeClass("hilang");;
		$(".steps li").removeClass("active");
	$(".badge").removeClass("badge-primary");
	
	$("#step3").addClass("active");
	$(".badge3").addClass("badge-primary");
	$("[name='count']").val("3");
	$(".lanjut").removeClass("btn-danger");
	$(".lanjut").html("Next");
	$(".lanjut").addClass("btn-success");
}

function go_step4()
{
		$(".lanjut").addClass("hilang");
		$(".save").removeClass("hilang");
	$(".step1").addClass("hilang");;
	$(".step2").addClass("hilang");;
	$(".step3").addClass("hilang");;
	$(".step4").removeClass("hilang");;
	$(".step5").addClass("hilang");;
	$("#step4").removeClass("hilang");;
		$(".steps li").removeClass("active");
	$(".badge").removeClass("badge-primary");
	
	$("#step4").addClass("active");
	$(".badge4").addClass("badge-primary");
	$("[name='count']").val("4");
	$(".lanjut").removeClass("btn-success");
	$(".lanjut").html("Save");
	$(".lanjut").addClass("btn-danger");
}
function go_step5()
{
	$(".step1").addClass("hilang");;
	$(".step2").addClass("hilang");;
	$(".step3").addClass("hilang");;
	$(".step4").addClass("hilang");;
	$(".step5").removeClass("hilang");;
	$("#step5").removeClass("hilang");;
		$(".steps li").removeClass("active");
	$(".badge").removeClass("badge-primary");
	
	$("#step5").addClass("active");
	$(".badge5").addClass("badge-primary");
	$("[name='count']").val("5");
}
</script>



<!----------------------------------------------------------------------------------------->

<script>
function cek_alamat_js(sts,alamat)
{
	if(sts=="add")
	{
		
		$.ajax({
		url:"<?php echo base_url();?>data_property/cek_alamat_js/",
		type:"POST",
		data:"alamat="+alamat,
		success: function(data)
				{
					if(data!="0"){
					alert("alamat sudah ada!");
					$("#alamat_detail").val("");	
					}
				},
			});				
	}else{
		var kode=$("#kode").val();
		$.ajax({
		url:"<?php echo base_url();?>data_property/cek_alamat_js_edit/",
		type:"POST",
		data:"alamat="+alamat+"&id="+kode,
		success: function(data)
				{
					if(data!="0"){
					alert("alamat sudah ada!");
					$("#alamat_detail").val("");	
					}
				},
			});		
	}
}

function cek_alamat(sts)
{
	var alamat=$("#alamat_detail").val();	
	cek_alamat_js(sts,alamat);
	if(!alamat)
	{
		$(".fg_alamat").addClass("has-error");
		$(".err_alamat").html("Mohon diisi");
		return false;
	}else{
		$(".fg_alamat").addClass("has-success");
		$(".fg_alamat").removeClass("has-error");
		$(".err_alamat").html("");
		return true;
	}
}
function cek_area()
{
	var area=$("#area").val();	
	if(!area)
	{
		$(".fg_area").addClass("has-error");
		$(".err_area").html("Mohon diisi");
		return false;
	}else{
		$(".fg_area").addClass("has-success");
		$(".fg_area").removeClass("has-error");
		$(".err_area").html("");
		return true;
	}
}
function cek_komplek()
{
	var kom=$("#nama_komplek").val();	
	if(!kom)
	{
		$(".fg_kom").addClass("has-error");
		$(".err_kom").html("Mohon diisi");
		return false;
	}else{
		$(".fg_kom").addClass("has-success");
		$(".fg_kom").removeClass("has-error");
		$(".err_kom").html("");
		return true;
	}
}
function cek_kab()
{
	var type_kab=$("#kabupaten").val();	
	if(!type_kab)
	{
		$(".fg_kab").addClass("has-error");
		$(".err_kab").html("Mohon dipilih");
		return false;
	}else{
		$(".fg_kab").addClass("has-success");
		$(".fg_kab").removeClass("has-error");
		$(".err_kab").html("");
		return true;
	}
}
function cek_prov()
{
	var type_prov=$("#provinsi").val();	
	if(!type_prov)
	{
		$(".fg_prov").addClass("has-error");
		$(".err_prov").html("Mohon dipilih");
		return false;
	}else{
		$(".fg_prov").addClass("has-success");
		$(".fg_prov").removeClass("has-error");
		$(".err_prov").html("");
		return true;
	}
}
</script>		

<!-------------------------------------------------------------------------step 3----------->
<script>
function cek_hadap()
{
	var variabel=$("#hadap").val();	
	if(!variabel)
	{
		$(".fg_hadap").addClass("has-error");
		$(".err_hadap").html("Mohon dipilih");
		return false;
	}else{
		$(".fg_hadap").addClass("has-success");
		$(".fg_hadap").removeClass("has-error");
		$(".err_hadap").html("");
		return true;
	}
}
</script>

<script>
function cek_bangunan()
{	
	var title="bangunan"; 
	var variabel=$("[name='luas_bangunan']").val();	
	var type_pro=$("[name='type_pro']").val();	
	if(type_pro=="5"){ return true; }
	if(!variabel)
	{
		$(".fg_bangunan").addClass("has-error");
		$(".err_bangunan").html("Mohon diisi");
		return false;
	}else{
		$(".fg_bangunan").addClass("has-success");
		$(".fg_bangunan").removeClass("has-error");
		$(".err_bangunan").html("");
		return true;
	}
}
</script>	

<script>
function cek_tanah()
{	
	var title="tanah";
	var variabel=$("#luas_tanah").val();	
	var type_pro=$("#type_pro").val();	
	if(type_pro=="6"){ return true; }
	if(!variabel)
	{
		$(".fg_tanah").addClass("has-error");
		$(".err_tanah").html("Mohon diisi");
		return false;
	}else{
		$(".fg_tanah").addClass("has-success");
		$(".fg_tanah").removeClass("has-error");
		$(".err_tanah").html("");
		return true;
	}
}
</script>	

<script>
function cek_harga()
{
	var title="harga"; 
	var variabel=$("#harga").val();	
	if(!variabel)
	{
		$(".fg_harga").addClass("has-error");
		$(".err_harga").html("Mohon diisi");
		return false;
	}else{
		$(".fg_harga").addClass("has-success");
		$(".fg_harga").removeClass("has-error");
		$(".err_harga").html("");
		return true;
	}
}
</script>	
<!-------------------------------------------------------------------------END step 3----------->

<script>
function cek_duplikat_owner()
{
	var hp1=$("[name='hp1_own']").val();
	var hp2=$("[name='hp2_own']").val();
	var email=$("[name='email_own']").val();
	var alamat=$("[name='alamat_own']").val();
	var id_own=$("[name='id_own']").val();
	 
	if(id_own){
		go_cek_duplikat_owner_ada(id_own,hp1,hp2,email,alamat);
	}else{
		go_cek_duplikat_owner(hp1,hp2,email,alamat);
	}
}
function go_cek_duplikat_owner_ada(id_own,hp1,hp2,email,alamat)
{
	$.ajax({
		url:"<?php echo base_url();?>data_owner/go_cek_duplikat_owner_ada/",
		dataType: "JSON",
		type:"POST",
		data:"id_own="+id_own+"&hp1="+hp1+"&hp2="+hp2+"&email="+email+"&alamat="+alamat,
		success: function(data)
				{
				if(data)
					{
					alert("data owner sudah ada!");
					}
				}
	});
}
function go_cek_duplikat_owner(hp1,hp2,email,alamat)
{
	$.ajax({
		url:"<?php echo base_url();?>data_owner/go_cek_duplikat_owner/",
		dataType: "JSON",
		type:"POST",
		data:"hp1="+hp1+"&hp2="+hp2+"&email="+email+"&alamat="+alamat,
		success: function(data)
				{
				if(data)
					{
					alert("data owner sudah ada!");
					}
				}
	});
}
</script>








