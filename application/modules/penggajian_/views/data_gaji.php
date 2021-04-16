  <?php $token=date("His")?>

		 
		 
	 
	
	<div class="row clearfix" >	
	
		<div class="btnhapus">
		<center>
		<div class="btn-group  " role="group"> 
                                    <button type="button" class="btn bg-indigo waves-effect" onclick="cetakAll()"><i class="material-icons">print</i> <span>CETAK STRUK</span></button>                                 
                                    <button type="button" class="btn bg-green waves-effect" onclick="cetakRekap()"><i class="material-icons">print</i> <span>CETAK REKAP</span></button>                                 
                                   
								   <button type="button" class="btn bg-teal waves-effect" onclick="ubahAll()"><i class="material-icons">assignment</i>  UBAH STATUS PENERIMAAN</button>
                                    <button type="button" class="btn bg-pink waves-effect" onclick="hapusAll()"><i class="material-icons">delete_sweep</i> HAPUS</button>
                                </div>
								</center>
		</div>
		
 	 <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card" id="blockarea"  >
                        
                        <div class="bodyd" style="min-height:200px;padding:10px">
						<!---------------------->
					 
								<div class="col-sm-6"  >
                                   <select name="periode" id="periode" class="form-control" onchange="table_reload()">
								   <?php
								   $db=$this->db->query("select * from keu_data_gaji  group by nama_periode order by id desc ")->result();
								   foreach($db as $val)
								   {
									   echo "<option value='".$val->nama_periode."'>".$val->nama_periode."</option>";
								   }
								   ?>
                                   </select>
								</div>	<div class="col-sm-6"  >
                                   <select name="id_guru" id="id_guru" class="form-control" data-live-search="true" onchange="table_reload()">
								   <option value=""> ==== Pilih Nama ====</option>
								   <?php
								   $db=$this->db->query("select * from data_pegawai order by nama asc ")->result();$val="";
								   foreach($db as $val)
								   {
									   echo "<option value='".$val->id."'>".$val->nama."</option>";
								   }
								   ?>
                                   </select>
								</div>
								 
								 
								<div class="col-sm-3"></div>
								<div class="col-sm-3">
                                     
                               
                                    
                             
                                    
                                </div>
							  <div class="clearfix"> </div>
							  <br>
						<div class="table-responsive" id="area_lod">
                               <table id='table' class="tabel black table-bordered table-striped table-hover dataTable" style="font-size:12px;width:100%">
								<thead  class='sadow bg-teal'>			
								<th class='thead'  style="max-width:18px">
										<input type="checkbox" id="md_checkbox"  value="ya" class="pilihsemua filled-in chk-col-red"   />
									<label for="md_checkbox" class="col-white">&nbsp;</label>
										
										</th>
									<th class='thead' axis="string" width='15px'>&nbsp;NO</th>
									<th class='thead' >NAMA PERIODE </th>
									<th class='thead' >TANGGAL PERIODE </th>
									<th class='thead' >NAMA PEGAWAI</th>
									<th class='thead' >JUMLAH PEMBAYARAN </th>
									<th class='thead' >  STRUK</th>
									<th class='thead' >DITERIMA</th>
									<th class='thead' >HAPUS </th>
									
								</thead>
							</table>
							</div>			
                     		<!---------------------->
						 
                           </div>
						   <div class="row">&nbsp;</div><br>
						</div>
         </div>
	
 </div>
	 <script>
	 
	
	
	  
	   function hapus(id,periode,guru,akun){
		   alertify.confirm("<center>Hapus data ini sekaligus menghapus data pengeluaran  <br> <span class='font-bold col-pink'>`"+akun+"`</span> <br> ?</center>",function(){
		   $.post("<?php echo site_url("penggajian/hapus_gaji"); ?>",{id:id,periode:periode,id_guru:guru},function(){
			  table_reload();
		      })
		   })
	  };
	  
	  var  dataTable = $('#table').DataTable({ 
		"paging": true,
        "processing": false, //Feature control the processing indicator.
		"language": {
					 "sSearch": "Pencarian",
					 "processing": ' <span class="sr-only dataTables_processing">Loading...</span> <br><b style="color:black;background:white">Proses menampilkan data<br> Mohon Menunggu..</b>',
						  "oPaginate": {
							"sFirst": "Hal Pertama",
							"sLast": "Hal Terakhir",
							 "sNext": "Selanjutnya",
							 "sPrevious": "Sebelumnya"
							 },
						"sInfo": "",
						 "sInfoEmpty": "",
						   "sZeroRecords": "Data tidak tersedia",
						  "lengthMenu": "Tampil _MENU_ Baris",  
				    },
					 
					 
        "serverSide": true, //Feature control DataTables' server-side processing mode.
		 "responsive": false,
		 "searching": false,
		  "lengthMenu":
		 [[100,50,20,10], 
		 [100,50,20,10]], 
	  dom: 'Blfrtip',
		buttons: [
           // 'copy', 'csv', 'excel', 'pdf', 'print'
			 
		/* {
					extend: 'excel',
                        exportOptions: {
                      columns:[ 0,1]
                },text:'Export Excell',
							
                    },*/
					
					  
        ],
        
        // Load data for the table's content from an Ajax source
        "ajax": {
            "url": "<?php echo site_url('penggajian/getDataGaji');?>",
            "type": "POST",
			"data": function ( data ) {
						
						  data.periode= $("[name='periode']").val();
						  data.id_guru= $("[name='id_guru']").val();
						  data.status= $("[name='status']").val();						  
		 },
		   beforeSend: function() {
               loading("area_lod");
            },
			complete: function() {
              unblock('area_lod'); 
			    $("#md_checkbox").removeAttr("checked");
				$("#md_checkbox").prop("checked",false);	
				$(".btnhapus").hide();
            },
			
        },

        //Set column definition initialisation properties.
        "columnDefs": [
        { 
          "targets": [ 0,-1,-2,-3,-4,-5], //last column
          "orderable": false, //set not orderable
        },
        ],
	
      });
     	  
	 
	 
	 
	</script>
	
						
						
						
<script>
var link="<?php echo base_url()?>";
 
function ubah(id,sts,nama)
{	  
if(sts==1)
{
	var teks="Penyerahan gaji untuk <br> <span class='col-pink font-bold'>"+nama+"</span> <br> Dan akan dicatat sebagai data pengeluaran ditanggal <br> <span class='col-pink font-bold'> <?php echo date('d-m-Y')?> </span>";
}else{
var teks="Pembatalan penyerahan gaji ini akan menghapus data pengeluaran<br>Lanjutkan ?";
}
 alertify.confirm("<center> "+teks+"</center>",function(){
    $.ajax({
	 url:link+"penggajian/ubahStatus",
     data:"id="+id+"&sts="+sts,
	 method:"POST",
     success: function(data)
            {
				table_reload();
            }
    });   
 });
}
 
</script>						
						
			    
<script>
 
 function table_reload()
 {
	  dataTable.ajax.reload(null,false);	
	  $("#md_checkbox").removeAttr("checked");
	  $("#md_checkbox").prop("checked",false);
 }
  
  
</script>		

 

<script>	

$('#ftanggal<?php echo $token;?>').daterangepicker({
    "showDropdowns": true,
    ranges: {
      //  'Hari ini': [moment(), moment()],
      //  'Kemarin': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
        '10 Hari yang lalu': [moment().subtract(9, 'days'), moment()],
        '30 Hari yang lalu': [moment().subtract(29, 'days'), moment()],
        'Bulan ini': [moment().startOf('month'), moment().endOf('month')],
        'Bulan kemarin': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
    },
    "locale": {
        "format": "DD/MM/YYYY",
        "separator": " - ",
        "applyLabel": "Apply",
        "cancelLabel": "Cancel",
        "fromLabel": "From",
        "toLabel": "To",
        "customRangeLabel": "Custom",
        "weekLabel": "W",
        "daysOfWeek": [
			"Min",
            "Sen",
            "Sel",
            "Rab",
            "Kam",
            "Jum",
            "Sab",
             
        ],
        "monthNames": [
            "Januari",
            "Februari",
            "Maret",
            "April",
            "Mei",
            "Juni",
            "Juli",
            "Agustus",
            "September",
            "Oktober",
            "November",
            "Desember"
        ],
        "firstDay": 1
    },
    "startDate": "<?php echo $this->tanggal->minTgl(10,date("Y/m/d"));?>",
    "endDate": "<?php echo date("d/m/Y");?>",
    "opens": "left"
}, function(start, end, label) {
  console.log('New date range selected: ' + start.format('DD-MM-YYYY') + ' to ' + end.format('DD-MM-YYYY') + ' (predefined range: ' + label + ')');
 
});
 $( document ).ready(function() {

$('#ftanggal<?php echo $token;?>').daterangepicker({
    "showDropdowns": true,
    ranges: {
      //  'Hari ini': [moment(), moment()],
      //  'Kemarin': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
        '10 Hari yang lalu': [moment().subtract(9, 'days'), moment()],
        '30 Hari yang lalu': [moment().subtract(29, 'days'), moment()],
        'Bulan ini': [moment().startOf('month'), moment().endOf('month')],
        'Bulan kemarin': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
    },
    "locale": {
        "format": "DD/MM/YYYY",
        "separator": " - ",
        "applyLabel": "Apply",
        "cancelLabel": "Cancel",
        "fromLabel": "From",
        "toLabel": "To",
        "customRangeLabel": "Custom",
        "weekLabel": "W",
        "daysOfWeek": [
			"Min",
            "Sen",
            "Sel",
            "Rab",
            "Kam",
            "Jum",
            "Sab",
             
        ],
        "monthNames": [
            "Januari",
            "Februari",
            "Maret",
            "April",
            "Mei",
            "Juni",
            "Juli",
            "Agustus",
            "September",
            "Oktober",
            "November",
            "Desember"
        ],
        "firstDay": 1
    },
    "startDate": "<?php echo $this->tanggal->minTgl(10,date("Y/m/d"));?>",
    "endDate": "<?php echo date("d/m/Y");?>",
    "opens": "left"
}, function(start, end, label) {
  console.log('New date range selected: ' + start.format('DD-MM-YYYY') + ' to ' + end.format('DD-MM-YYYY') + ' (predefined range: ' + label + ')');
 
});

 });

</script>	
			<script>
			 $("select").selectpicker();
			 </script>	
<script>	
 function pilcek()
  {
	  var values = new Array();
		 
			$("input[name='c[]']:checked").each(function () {
			   values.push( $(this).val());
			});
			if(values!="")
			{
				 $(".btnhapus").show();
			}else{
				 $(".btnhapus").hide();
			}
			return values;
	 
	} 
	 $(".btnhapus").hide();
  	$("#md_checkbox").click(function(){
		  var pilihsemua = document.getElementById("md_checkbox").checked; 
					if(pilihsemua) {
					$(".pilih").prop("checked", "checked");
					$(".pilihsemua").val("no");
					  $(".btnhapus").show(); 
					} else { 
					$(".pilih").removeAttr("checked");
					$(".pilihsemua").val("ya");
					  $(".btnhapus").hide(); 
					} 
	});
	
 function hapusAll()
 {	var val=pilcek();var periode=$("[name='periode']").val();
	 alertify.confirm("<center> Hapus data yang terpilih ? </center>",function(){
    $.ajax({
	 url:link+"penggajian/hapusAll",
     data:"val="+val+"&periode="+periode,
	 method:"POST",
     success: function(data)
            {
				table_reload();
            }
    });   
 });
 } function ubahAll()
 {	var val=pilcek();var periode=$("[name='periode']").val();
	 alertify.confirm("<center> Ubah status menjadi diterima tanggal hari ini : <br><?php echo date('d/m/Y'); ?> </center>",function(){
    $.ajax({
	 url:link+"penggajian/ubahStatusAll",
     data:"val="+val+"&periode="+periode,
	 method:"POST",
     success: function(data)
            {
				table_reload();
            }
    });   
 });
 }
function cetakAll()
{	var periode=$("[name='periode']").val();
	var val=pilcek();
	

window.open(
 "<?php echo base_url() ?>penggajian/cetak_all?periode="+periode+"&id="+val,
  '_blank' 
);
}
function cetakRekap()
{	var periode=$("[name='periode']").val();
	var val=pilcek();
	

window.open(
 "<?php echo base_url() ?>penggajian/cetakRekap?periode="+periode+"&id="+val,
  '_blank' 
);


 
}
</script>			 