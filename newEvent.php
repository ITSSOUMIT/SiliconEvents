<?php
    include('config.php');
    include('const/check.php');
    include('functions.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin Dashboard</title>

    <?php include('const/stylesheet.php'); ?>
</head>

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">
        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
                </li>
            </ul>
            <ul class="navbar-nav ml-auto">
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalNewEvent"><i class="fas fa-plus" style="margin-right: 10px;"></i>Add Upcoming Event</button>
            </ul>
        </nav>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <?php include('sidebar.php'); ?>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0"><b>Events :</b></h1>
                        </div><!-- /.col -->
                    </div><!-- /.row -->
                </div><!-- /.container-fluid -->
            </div>
            <!-- /.content-header -->

            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12">
                            <div class="card card-primary">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-12">
                                            <!-- THE CALENDAR -->
                                            <div id="calendar"></div>
                                        </div>
                                    </div>
                                </div>
                                <!-- /.card-body -->
                            </div>
                        </div>
                    </div>
                </div><!-- /.container-fluid -->


                <div class="modal fade" id="modalNewEvent">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title">Add Upcoming Event</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <form action="dataHandler" method="POST" enctype="multipart/form-data">
                                <input type="hidden" name="intent" value="newUpcomingEvent">
                                <div class="modal-body">
                                    <div class="card-body">
                                        <input type="hidden" class="form-control" name="departmentid"
                                            value="<?php echo $_SESSION['department']; ?>" readonly
                                            required>
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Event Name</label>
                                            <input type="text" class="form-control" placeholder="Event Name" name="eventName"
                                                required>
                                        </div>
                                        <div class="row">
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1">From Date</label>
                                                    <input type="date" class="form-control" placeholder="From Date"
                                                        name="fromDate" required>
                                                </div>        
                                            </div>
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1">From Time</label>
                                                    <input type="time" class="form-control" placeholder="From Time"
                                                        name="fromTime">
                                                </div>        
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1">To Date</label>
                                                    <input type="date" class="form-control" placeholder="To Date"
                                                        name="toDate" required>
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1">To Time</label>
                                                    <input type="time" class="form-control" placeholder="To Time"
                                                        name="toTime">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Target Audience</label>
                                            <input type="text" class="form-control" placeholder="The target audience for the event" name="audience"
                                                required>
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Venue</label>
                                            <input type="text" class="form-control" placeholder="Venue of the event" name="venue"
                                                required>
                                        </div>
                                        <div class="form-group">
                                            <label>Description</label>
                                            <textarea class="form-control" rows="5" placeholder="Enter Description" name="description" required="" id="summernotebox"></textarea>
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputFile">Poster / Infographic</label>
                                            <div class="input-group">
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input" id="exampleInputFile"
                                                        name="image" accept="image/*" required>
                                                    <label class="custom-file-label" for="exampleInputFile">Choose
                                                        file</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- /.card-body -->

                                </div>
                                <div class="modal-footer justify-content-between">
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary">Add Upcoming Event</button>
                                </div>
                            </form>
                        </div>
                        <!-- /.modal-content -->
                    </div>
                    <!-- /.modal-dialog -->
                </div>
                <!-- /.modal -->

                <div class="modal fade" id="modalViewDetails">
                    <div class="modal-dialog">
                        <div class="modal-content viewDesc">

                        </div>
                        <!-- /.modal-content -->
                    </div>
                    <!-- /.modal-dialog -->
                </div>
                <!-- /.modal -->

            </section>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->
        <?php include('const/footer.php'); ?>

    </div>
    <!-- ./wrapper -->

    <?php include('const/js.php'); ?>

    <script>
    var element = document.getElementById("sideNewEvent");
    element.classList.add("active");
    </script>

    <script>
    document.querySelector('.custom-file-input').addEventListener('change', function(e) {
        var fileName = document.getElementById("exampleInputFile").files[0].name;
        var nextSibling = e.target.nextElementSibling
        nextSibling.innerText = fileName
    })
    </script>

    <!-- <script>
        $.(function (){

            var date = new Date()
            var d    = date.getDate(),
                m    = date.getMonth(),
                y    = date.getFullYear()

            var Calendar = FullCalendar.Calendar;
            var Draggable = FullCalendar.Draggable;

            var containerEl = document.getElementById('external-events');
            var checkbox = document.getElementById('drop-remove');
            var calendarEl = document.getElementById('calendar');


            var calendar = new Calendar(calendarEl, {
                headerToolbar: {
                    left  : 'prev,next today',
                    center: 'title',
                    right : 'dayGridMonth,timeGridWeek,timeGridDay'
                },
                themeSystem: 'bootstrap',
                //Random default events
                events: [
                    {
                    title          : 'All Day Event',
                    start          : new Date(y, m, 1),
                    backgroundColor: '#f56954', //red
                    borderColor    : '#f56954', //red
                    allDay         : true
                    },
                    {
                    title          : 'Long Event',
                    start          : new Date(y, m, d - 5),
                    end            : new Date(y, m, d - 2),
                    backgroundColor: '#f39c12', //yellow
                    borderColor    : '#f39c12' //yellow
                    },
                    {
                    title          : 'Meeting',
                    start          : new Date(y, m, d, 10, 30),
                    allDay         : false,
                    backgroundColor: '#0073b7', //Blue
                    borderColor    : '#0073b7' //Blue
                    },
                    {
                    title          : 'Lunch',
                    start          : new Date(y, m, d, 12, 0),
                    end            : new Date(y, m, d, 14, 0),
                    allDay         : false,
                    backgroundColor: '#00c0ef', //Info (aqua)
                    borderColor    : '#00c0ef' //Info (aqua)
                    },
                    {
                    title          : 'Birthday Party',
                    start          : new Date(y, m, d + 1, 19, 0),
                    end            : new Date(y, m, d + 1, 22, 30),
                    allDay         : false,
                    backgroundColor: '#00a65a', //Success (green)
                    borderColor    : '#00a65a' //Success (green)
                    },
                    {
                    title          : 'Click for Google',
                    start          : new Date(y, m, 28),
                    end            : new Date(y, m, 29),
                    url            : 'https://www.google.com/',
                    backgroundColor: '#3c8dbc', //Primary (light-blue)
                    borderColor    : '#3c8dbc' //Primary (light-blue)
                    }
                ],
                editable  : true,
                droppable : true, // this allows things to be dropped onto the calendar !!!
                drop      : function(info) {
                    // is the "remove after drop" checkbox checked?
                    if (checkbox.checked) {
                    // if so, remove the element from the "Draggable Events" list
                    info.draggedEl.parentNode.removeChild(info.draggedEl);
                    }
                }
            });
        })

        calendar.render();
    </script> -->


<script>
    function incr_date(date_str){
        var parts = date_str.split("-");
        var dt = new Date(
            parseInt(parts[0], 10),      // year
            parseInt(parts[1], 10) - 1,  // month (starts with 0)
            parseInt(parts[2], 10)       // date
        );
        dt.setDate(dt.getDate() + 1);
        parts[0] = "" + dt.getFullYear();
        parts[1] = "" + (dt.getMonth() + 1);
        if (parts[1].length < 2) {
            parts[1] = "0" + parts[1];
        }
        parts[2] = "" + dt.getDate();
        if (parts[2].length < 2) {
            parts[2] = "0" + parts[2];
        }
        return parts.join("-");
    }
</script>
<script>
  $(function () {

    /* initialize the calendar
     -----------------------------------------------------------------*/

    var Calendar = FullCalendar.Calendar;
    var Draggable = FullCalendar.Draggable;

    var containerEl = document.getElementById('external-events');
    var checkbox = document.getElementById('drop-remove');
    var calendarEl = document.getElementById('calendar');

    var calendar = new Calendar(calendarEl, {
      headerToolbar: {
        left  : 'prev today next',
        center: 'title',
        right : 'dayGridMonth,timeGridWeek,timeGridDay'
      },
      themeSystem: 'bootstrap',
      //Random default events
      eventClick: function(info) {
        var eventObj = info.event;

        if (eventObj.url) {
          
          let id = eventObj.url;

          $.ajax({
            url: 'viewUpcomingEventDetailsAjax.php',
            type: 'post',
            data: {
                eventid: id
            },
            success: function(response) {
                // Add response in Modal body
                $('.viewDesc').html(response);

                // Display Modal
                $('#modalViewDetails').modal('show');
            }
          });

          info.jsEvent.preventDefault(); // prevents browser from following link in current tab.
        }else {
          alert('Error : Contact Support');
        }
      },
      events: [

        <?php
            if(isSuperAdmin()==12){
                $query = "SELECT * FROM events WHERE status = '1'";    
            }else{
                $query = "SELECT * FROM events WHERE departmentid = '$department'  AND status = '1'";
            }
            $result = $conn->query($query);

            if($result->num_rows != 0) {
                while($row = $result->fetch_assoc()) {
        ?>
            {
                title          : '<?php echo getDeptCode($row['departmentid'])." - ".$row['name']; ?>',
                url            : '<?php echo $row['eventid']; ?>',
                start          : '<?php echo $row['fromDate']; ?>',
                <?php
                    if(strcmp($row['fromDate'], $row['toDate'])==0){
                        echo "allDay : true,";
                    }else{
                        echo "end            : incr_date('".$row['toDate']."'),";
                    }
                ?>
                <?php
                    // $color = '#'.str_pad(dechex(rand(0x000000, 0xFFFFFF)), 6, 0, STR_PAD_LEFT);
                    $color = getDeptColor($row['departmentid']);
                ?>
                backgroundColor : '<?php echo $color; ?>',
                <?php
                    date_default_timezone_set('Asia/Kolkata');
                    $currDate = date("Y-m-d");
                    $toDate = $row['toDate'];

                    if($currDate > $toDate){
                ?>
                        borderColor     : '#ff0000'
                <?php
                    }

                    elseif($currDate == $toDate){
                        if(date('H') >= 17){
                ?>
                            borderColor     : '#ff0000'
                <?php
                        }else{
                ?>
                            borderColor         : '<?php echo $color; ?>'
                <?php    
                        }
                    }

                    elseif($currDate < $toDate){
                ?>
                        borderColor         : '<?php echo $color; ?>'
                <?php
                    }
                ?>
            },
        <?php
            }}
        ?>
      ],
    });

    calendar.render();
    $('#calendar').fullCalendar()
  })

  $(function () {
    // Summernote
    $('#summernotebox').summernote({
        toolbar: [
            // [groupName, [list of button]]
            ['style', ['bold', 'italic', 'underline', 'clear']],
            ['font', ['strikethrough', 'superscript', 'subscript']],
            ['fontsize', ['fontsize']],
            ['color', ['color']],
            ['para', ['ul', 'ol', 'paragraph']],
            ['height', ['height']]
        ]
    });
  })
</script>
    
</body>

</html>
