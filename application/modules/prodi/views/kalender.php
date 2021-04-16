  <b>Penjelasan warna :</b><br>
  <label class="label bg-green">&nbsp;warna hijau &nbsp;</label> Jadwal keberangkatan<br>
    <label class="label bg-teal">&nbsp;warna hijau tosca tua&nbsp;</label> Jadwal monitoring<br>
 <label class="label bg-red">&nbsp;warna merah&nbsp;</label> Jadwal penjemputan/kepulangan<br>			
	
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
            sts: sts,
            id_pembimbing:id_pembimbing,
            id_mitra:id_mitra,
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
                detailModal(event.id,event.title,event.start.format(),event.sts,event.id_pembimbing,event.id_mitra); 
            },
	 
	 
	 
	 
	 
    });
 
	
	getFreshEvents();
	 function getFreshEvents() {
            $.ajax({
                url: '<?php echo base_url(); ?>prodi/jadwal_otw',
                type: 'POST', // Send post data
                data: 'type=fetch',
                async: false,
                success: function (s) {
                    freshevents = s;
                }
            });
            $('#calendar').fullCalendar('addEventSource', JSON.parse(freshevents));
			
        }
		
 	jadwalPulang();
	 function jadwalPulang() {
            $.ajax({
                url: '<?php echo base_url(); ?>prodi/jadwal_pulang',
                type: 'POST', // Send post data
                data: 'type=fetch',
                async: false,
                success: function (s) {
                    freshevents = s;
                }
            });
            $('#calendar').fullCalendar('addEventSource', JSON.parse(freshevents));
			
        }
        
        	jadwalMonitoring(1);
        		jadwalMonitoring(2);
        			jadwalMonitoring(3);
        				jadwalMonitoring(4);
        					jadwalMonitoring(5);
        						jadwalMonitoring(6);
	 function jadwalMonitoring(id) {
            $.ajax({
                url: '<?php echo base_url(); ?>prodi/jadwalMonitoring/'+id,
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
 function detailModal(id,title,tgl,sts,id_pembimbing,id_mitra)
    {	 
        var title=title.split("(");
        var guru=title[0];
	 
       $.post("<?php echo site_url("prodi/infoKalender"); ?>",{id:id,title:title,tgl:tgl,sts:sts,id_pembimbing:id_pembimbing,id_mitra:id_mitra},function(data){ 
          if(sts=="otw"){
              $(".modal-titlet").html("Jadwal pemberangkatan ");
          }else if(sts=="plg"){
              $(".modal-titlet").html("Jadwal kepulangan ");
          }else{
              $(".modal-titlet").html("Jadwal "+sts); 
          }
                $("#modal_dialog").modal("show");
                $("#isimodal").html(data);
            });
     
        
  }
  
    
</script>




<!----------------------------------MODAL-------------------------------------------->					
<div id="modal_dialog" class="modal fade" tabindex="-1" >
    <div class="modal-dialog modal-md"  >
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="blue bigger modal-titlet"></h4>
            </div>

            <div class="modal-body" id="isimodal">
                							
            </div>

            
        </div>
    </div>								
</div>



