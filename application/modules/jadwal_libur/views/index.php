  
	<?php
	if($this->m_reff->mobile()){
	    echo '<button  class="btn btn-block bg-teal" onclick="tambah_libur()"><i class="material-icons">add_circle</i> Tambahkan hari libur</button>';
	}else{
	    echo 'Penjelasan:<br>
			Untuk menambahkan jadwal libur silahkan klik pada kolom tanggal.';
	}?>
			
			
			
 


<script>
 

    $('#calendar').fullCalendar({
      header: {
        left: 'prev,next today',
        center: 'title',
        right: 'month,agendaWeek,agendaDay'
      },
      defaultDate: '<?php echo date('Y-m-d');?>',
	  locale: "id",
      navLinks: true, // can click day/week names to navigate views
      selectable: true,
      selectHelper: true,
      select: function(start, end) {
        var title = prompt('Keterangan libur:');
        var eventData;
        if (title) {
          eventData = {
            title: title,
            start: start,
            end: end,
			backgroundColor: 'red',
          };
		   addEvent(title,start.format(),end.format());
       //   $('#calendar').fullCalendar('renderEvent', eventData, true); // stick? = true
		 
        }
        $('#calendar').fullCalendar('unselect');
      },
      editable: true,
      eventLimit: true, // allow "more" link when too many events
     eventDrop: function(event, delta, revertFunc) {

				 
 
				  alertify.confirm("<center> Pindah ? </center>",function(){
				 moveEvent(event.id,event.start.format(),event.end.format())
				}, function(){ 	 revertFunc();}  );
			
	 },
	 
	 eventResize: function(event, delta, revertFunc) {

     alertify.confirm("<center> Ubah ? </center>",function(){
				 moveEvent(event.id,event.start.format(),event.end.format())
				}, function(){ 	 revertFunc();}  );

  },
	 
			eventClick: function (event, jsEvent, view) { 
                detailModal(event.id,event.title); 
            }
	 
	 
	 
	 
	 
    });

	
	getFreshEvents();
	 function getFreshEvents() {
            $.ajax({
                url: '<?php echo base_url(); ?>jadwal_libur/process',
                type: 'POST', // Send post data
                data: 'type=fetch',
                async: false,
                success: function (s) {
                    freshevents = s;
                }
            });
            $('#calendar').fullCalendar('addEventSource', JSON.parse(freshevents));
        }
	
	
	
	
	
	
	
 

</script>
<style>

  body {
    margin: 40px 10px;
    padding: 0;
    font-family: "Lucida Grande",Helvetica,Arial,Verdana,sans-serif;
    font-size: 14px;
  }

  #calendar {
    max-width: 900px;
    margin: 0 auto;
  }

</style>
 
 
<div  class="card"><br>
  <div id='calendar'></div>
  <br>
</div>


<script>
function hapus(id)
{  alertify.confirm("<center> Hapus ? </center>",function(){
	$('#calendar').fullCalendar('removeEventSources');
	 $.post("<?php echo site_url("jadwal_libur/hapus"); ?>",{id:id},function(data){ 
	 $("#modal_libur").modal("hide");
	 getFreshEvents();
		      }); 
	});
}
function save(id)
{  
	$('#calendar').fullCalendar('removeEventSources');
	var title=$("#title").val();
	 $.post("<?php echo site_url("jadwal_libur/update"); ?>",{id:id,title:title},function(data){ 
	 $("#modal_libur").modal("hide");
	 getFreshEvents();
		      }); 
	 
}

function addEvent(ket,start,end)
{  $('#calendar').fullCalendar('removeEventSources');
	  
	 $.post("<?php echo site_url("jadwal_libur/add"); ?>",{ket:ket,start:start,end:end},function(data){ 
	 	 getFreshEvents();
		      }); 
			 
}function moveEvent(id,start,end)
{
	 $.post("<?php echo site_url("jadwal_libur/moveEvent"); ?>",{id:id,start:start,end:end},function(data){ 
		      }); 
}
 function detailModal(id,title)
    {
		$("#modal_libur").modal("show");
       $.post("<?php echo site_url("jadwal_libur/info"); ?>",{id:id,title:title},function(data){ 
                $("#c-tamu").html(data);
                $(".modal-titlet").html("<i class='fa fa-info-circle'></i> &nbsp;Informasi Libur");
            });
     
        
  }
  
    
</script>




<!----------------------------------MODAL-------------------------------------------->					
<div id="modal_libur" class="modal fade" tabindex="-1" >
    <div class="modal-dialog modal-md"  >
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="blue bigger modal-titlet"></h4>
            </div>

            <div class="modal-body">
                <span id="c-tamu"></span>											
            </div>

            
        </div>
    </div>								
</div>















<script>
    function tambah_libur()
    {
        $("#mdl_sbmt_libur").modal("show");
    }
</script>



<div id="mdl_sbmt_libur" class="modal fade" role="dialog">
  <div class="modal-dialog" id="area_sbmt">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Tambahkan Libur</h4>
      </div>
      <form method="POST" id="sbmt_libur" action="javascript:submitForm('sbmt_libur')" url="<?php echo base_url() ?>jadwal_libur/insert">
      <div class="modal-body">
        
            <div class="row">
                <div class="col-md-12">
                   
                    <div class="form-group">
                        <label>Mulai Libur</label><br>
                        <input required type="text" id="tgl" autocomplete="off" name="start" class="form-control date_cokot" required="">
                    </div>
                    <br>
                    <div class="form-group">
                        <label>Sampai</label><br>
                        <input required type="text" id="tgl" autocomplete="off" name="end" class="form-control date_cokot" required="">
                    </div>
                    <br>
                    <div class="form-group">
                        <label>Keterangan libur</label><br>
                        <textarea class="form-control" name="ket" required=""></textarea>
                    </div>
                </div>
            </div>
        
      </div>
      <div class="modal-footer">
        <button class="btn pull-right bg-teal waves-effect" onclick="submitForm('sbmt_libur')">SIMPAN</button>
      </div>
      </form>
    </div>

  </div>
</div>
<script>
    
    $('.date_cokot').daterangepicker({
        //maxDate: new Date(),
        "singleDatePicker": true,
        "showDropdowns": true,
        "dateLimit": {
            "days": 7
        },
        "autoApply": false,
        "drops": "down",
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
                "MIN",
                "SEN",
                "SEL",
                "RAB",
                "KAM",
                "JUM",
                "SAB"
            ],
            "monthNames": [
                "Januari",
                "Februari",
                "Maret",
                "April",
                "Mei",
                "Juni",
                "Juli",
                "Augustus",
                "September",
                "Oktober",
                "November",
                "Desember"
            ],
            "firstDay": 1
        },
        "showCustomRangeLabel": false,
        "startDate": "<?php echo date("d/m/Y")?>",   
    });
    $("select").selectpicker();
</script>
