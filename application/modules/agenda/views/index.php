<div class="row clearfix">
	<div class="col-lg-8 col-md-8 col-sm-8 col-xs-8 pull-left icon-and-text-button-demo">
   	<div class="demo-switch">
                                <div class="switch">
                                    <label>TABLE<input checked="" type="checkbox"><span class="lever"></span>KALENDER</label>
                                </div>             
	</div>
	</div>                    
</div>	
	
	
	
	
	
	
	

<head>
<link href='<?php echo base_url();?>plug/fullcalendar/fullcalendar.min.css' rel='stylesheet' />
<link href='<?php echo base_url();?>plug/fullcalendar/fullcalendar.print.min.css' rel='stylesheet' media='print' />
<script src='<?php echo base_url();?>plug/fullcalendar/lib/moment.min.js'></script>
<script src='<?php echo base_url();?>plug/fullcalendar/fullcalendar.min.js'></script>
<script>

  $(document).ready(function() {

    $('#calendar').fullCalendar({
      header: {
        left: 'prev,next today',
        center: 'title',
        // right: 'month,agendaWeek,agendaDay,listMonth'
         right: 'month,listMonth'
      },
      defaultDate: '2018-02-12',
      navLinks: true, // can click day/week names to navigate views
      selectable: true,
      selectHelper: true,
      select: function(start, end) {
		   addEvent(start, end);
		 
      },
	  
	   
	  
	   eventClick: function (event) {
            detailModal(event.title);
            },
	  
	  
	  
      editable: false,
      eventLimit: true, // allow "more" link when too many events
      events: [
         
        {
		  id: 999,
          title: 'Long Event',
          start: '2018-02-07',
          end: '2018-02-07',
		  color: '#2196F3',
 
        },
        
      ]
    });

  });
  
   function addEvent(start,end)
	  {
		  $("[name='dateValue']").val(start);
		 	detailModal(start);
		   // $("#modalCreateEvent").modal("show");
	/*	var title = prompt('mau buat event apa?');
        var eventData;
        if (title) {
          eventData = {
            title: title,
            start: start,
            end: end
          };
          $('#calendar').fullCalendar('renderEvent', eventData, true); // stick? = true
        }
        $('#calendar').fullCalendar('unselect');*/
	  };

function save()
{	
		var	eventData = {
            title: "judul",
            start: "2018/02/11",
            end: "2018/02/11",
          };
return		setData(eventData);
	 
}
  
  
 function detailModal()
    {
		
		var tgl=$("[name='dateValue']").val();
        $.ajax({
            url: "<?php echo base_url(); ?>agenda/konversiTanggal/?tgl="+tgl,
            success: function (data)
            {
			  $("#modalCreateEvent").modal("show");
              $("[name='f[tgl_mulai]']").val(data);
              $("[name='f[tgl_akhir]']").val(data);
	        }
        }); 
		
		
    }
function konversiTanggal()
{
	var tgl=$("[name='dateValue']").val();
        $.ajax({
            url: "<?php echo base_url(); ?>agenda/konversiTanggal/?tgl="+tgl,
            success: function (data)
            {
              $("[name='f[tgl_mulai]']").val(data);
              $("[name='f[tgl_akhir]']").val(data);
	        }
        }); 
}

function tglAkhir()
    {
		var tgl=$("[name='f[tgl_mulai]']").val();
		var durasi=$("[name='f[durasi]']").val();
        $.ajax({
            url: "<?php echo base_url(); ?>agenda/tglAkhir/?tgl="+tgl+"&durasi="+durasi,
            success: function (data)
            {
              $("[name='f[tgl_akhir]']").val(data);
	        }
        }); 
    }
  
</script>
 
<style>
  #calendar {
    max-width: 100%;
	min-height:200px;
    margin: 0 auto;
  }
</style>
</head>
<body>
<div id='calendar' style="background-color:white;padding:10px"></div>
<input type="hidden" name="dateValue">
</body>
 

	  
	 
	 
	 
<!-- Modal -->
<div class="modal fade" id="modalCreateEvent"   >
    <div class="modal-dialog modal-lg" style="z-index:999995555" >
        <div class="modal-content ">
            <!-- Modal Header -->
            <div class="modal-header">
                <button type="button" class="close" 
                   data-dismiss="modal">
                       <span aria-hidden="true">&times;</span>
                       <span class="sr-only">Close</span>
                </button>
                <div class="modal-title" >
				  BUAT AGENDA KEGIATAN   <span id="dateValue"></span>
	            </div>
            </div>
            
            <!-- Modal Body -->
            <div class="modal-body">
				<?php echo $this->load->view("ModalCreateEvent"); ?>
            </div>
            
            <!-- Modal Footer -->
            <div class="modal-footer  hide">
               
                <button type="button" class="btn btn-primary">
                    Save changes
                </button>
            </div>
        </div>
    </div>
</div>






<!-- Modal -->
<div class="modal fade" id="modalEvent"   role="dialog"  aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog ">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <button type="button" class="close" 
                   data-dismiss="modal">
                       <span aria-hidden="true">&times;</span>
                       <span class="sr-only">Close</span>
                </button>
                <h4 class="modal-title" id="myModalLabel">
                  Autentikasi
                </h4>
            </div>
            
            <!-- Modal Body -->
            <div class="modal-body">
                
                <form role="form">
                  <div class="form-group">
                    <label for="exampleInputEmail1">Email address</label>
                      <input type="email" class="form-control"
                      id="exampleInputEmail1" placeholder="Enter email"/>
                  </div>
                  <div class="form-group">
                    <label for="exampleInputPassword1">Password</label>
                      <input type="password" class="form-control"
                          id="exampleInputPassword1" placeholder="Password"/>
                  </div>
				  <button data-type="ajax-loader">CLICk</button>
                </form>
                
                
            </div>
            
            <!-- Modal Footer -->
            <div class="modal-footer">
               
                <button type="button" class="btn btn-primary">
                    Save changes
                </button>
            </div>
        </div>
    </div>
</div>

 
 

 