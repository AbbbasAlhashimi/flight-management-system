  <html>
 <head>
  <title>Tickets booking System</title>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
  <style>
   body
   {
    margin:0;
    padding:0;
    background-color:#f1f1f1;
   }
   .box
   {
    width:960px;
    padding:20px;
    background-color:#fff;
    border:1px solid #ccc;
    border-radius:5px;
    margin-top:10px;
   }
  </style>
 </head>
 <body>
  <div class="container box">

   <br />
   <div align="right">
    <button type="button" id="modal_button" class="btn btn-info">Make a New Reservation</button>
   </div>
   <br />
   <div id="result" class="table-responsive">

   </div>
  </div>
 </body>
</html>


<div id="customerModal" class="modal fade">
 <div class="modal-dialog">
  <div class="modal-content">
   <div class="modal-header">
    <h4 class="modal-title">New Flight Reservation</h4>
   </div>

   <div class="modal-body">

    <label>New Customer</label>
    <input type="text" name="customer_name" id="customer_name" class="form-control" />
    <br />

    <label>Flight Date</label>
    <input type="text" name="flight_date" id="flight_date" class="form-control" />
    <br />

    <label>Departure City</label>
    <input type="text" name="flight_source" id="flight_source" class="form-control" />
    <br />
    <label>Arrival City</label>
    <input type="text" name="flight_destination" id="flight_destination" class="form-control" />
    <br />

   </div>
   <div class="modal-footer">
    <input type="hidden" name="customer_id" id="customer_id" />
    <input type="submit" name="action" id="action" class="btn btn-success" />
    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
   </div>
  </div>
 </div>
</div>

<script>
$(document).ready(function(){
 fetchUser();
 function fetchUser()
 {
  var action = "Load";
  $.ajax({
   url : "action.php",
   method:"POST",
   data:{action:action},
   success:function(data){
    $('#result').html(data);
   }
  });
 }

  $('#modal_button').click(function(){
  $('#customerModal').modal('show');
  $('#customer_name').val('');
  $('#flight_date').val('');
  $('#flight_source').val('');
  $('#flight_destination').val('');
  $('.modal-title').text("Create New Records");
  $('#action').val('Create');
 });

 $('#action').click(function(){
  var customerName = $('#customer_name').val();
  var flightDate = $('#flight_date').val();
  var flightSource = $('#flight_source').val();
  var flightDestination = $('#flight_destination').val();
  var id = $('#customer_id').val();
  var action = $('#action').val();
  if(
    customerName != '' && flightDate != '' && flightSource != '' && flightDestination != '')
  {
   $.ajax({
    url : "action.php",
    method:"POST",  

    data:{customerName:customerName, flightDate:flightDate, flightSource:flightSource, flightDestination:flightDestination, id:id, action:action},
    success:function(data){
     alert(data);
     $('#customerModal').modal('hide');
     fetchUser();
    }
   });
  }
  else
  {
   alert("All Fields are Required");
  }
 });

 $(document).on('click', '.update', function(){
  var id = $(this).attr("id");
  var action = "Select";
  $.ajax({
   url:"action.php",
   method:"POST",
   data:{id:id, action:action},
   dataType:"json",
   success:function(data){
    $('#customerModal').modal('show');
    $('.modal-title').text("Update Records");
    $('#action').val("Update");
    $('#customer_id').val(id);
    $('#customer_name').val(data.customer_name);
    $('#flight_date').val(data.flight_date);
    $('#flight_source').val(data.flight_source);
    $('#flight_destination').val(data.flight_destination);
   }
  });
 });

 
 $(document).on('click', '.delete', function(){
  var id = $(this).attr("id");
  if(confirm("Are you sure you wish to delete this record?"))
  {
   var action = "Delete";
   $.ajax({
    url:"action.php",
    method:"POST",
    data:{id:id, action:action},
    success:function(data)
    {
     fetchUser();
     alert(data);
    }
   })
  }
  else
  {
   return false;
  }
 });
});
</script>