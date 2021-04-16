  
			
			
			
 


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
      selectable: false,
      selectHelper: true,
      select: function(start, end) {
        var title = prompt('Keterangan libur:');
        var eventData;
        if (title) {
          eventData = {
            title: title,
            start: start,
            end: end
          };
		   addEvent(title,start.format(),end.format());
          $('#calendar').fullCalendar('renderEvent', eventData, true); // stick? = true
		 
        }
        $('#calendar').fullCalendar('unselect');
      },
      editable: false,
      eventLimit: true, // allow "more" link when too many events
     eventDrop: function(event, delta, revertFunc) {

				 
 
				  alertify.confirm("<center> Pindah ? </center>",function(){
				 moveEvent(event.id,event.start.format(),event.end.format())
				}, function(){ 	 revertFunc();}  );
			
	 },
	 
	 
	 
			eventClick: function (event, jsEvent, view) { 
                detailModal(event.id,event.title); 
            },
	 
	 
	 
	 
	 
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
		
	jadwalPiket();
	 function jadwalPiket() {
            $.ajax({
                url: '<?php echo base_url(); ?>riwayat_piket/process',
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
 function detailModal(id,title)
    {	return true;
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



