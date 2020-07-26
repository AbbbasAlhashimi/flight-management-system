  <?php
//Database connection by using PHP PDO
$username = 'root';
$password = '';
$connection = new PDO( 'mysql:host=localhost;dbname=ticketsdb', $username, $password ); // Create Object of PDO class by connecting to Mysql database

if(isset($_POST["action"])) //Check value of $_POST["action"] variable value is set to not
{
 //For Load All Data
 if($_POST["action"] == "Load") 
 {
  $statement = $connection->prepare("SELECT * FROM tickets ORDER BY id DESC");
  $statement->execute();
  $result = $statement->fetchAll();
  $output = '';
  $output .= '
   <table class="table table-bordered">
    <tr>
       <th width="10%">müşteri adı</th>
       <th width="10%">Uçuş tarihi</th>
       <th width="10%">Kalkış Şehri</th>
       <th width="10%">Varış Şehri</th>
       <th width="5%">Güncelleme</th>
       <th width="5%">Sil</th>
    </tr>
  ';
  if($statement->rowCount() > 0)
  {
   foreach($result as $row)
   {
    $output .= '
    <tr>
     <td>'.$row["customer_name"].'</td>
     <td>'.$row["flight_date"].'</td>
     <td>'.$row["flight_source"].'</td>
     <td>'.$row["flight_destination"].'</td>
     <td><button type="button" id="'.$row["id"].'" class="btn btn-warning btn-xs update">Güncelleme</button></td>
     <td><button type="button" id="'.$row["id"].'" class="btn btn-danger btn-xs delete">Sil</button></td>
    </tr>
    ';
   }
  }
  else
  {
   $output .= '
    <tr>
     <td align="center">Data not Found</td>
    </tr>
   ';
  }
  $output .= '</table>';
  echo $output;
 }

 //This code for Create new Records
 if($_POST["action"] == "Create")
 {
  $statement = $connection->prepare("
   INSERT INTO tickets (customer_name,flight_date,flight_source,flight_destination) VALUES (:customer_name, :flight_date, :flight_source, :flight_destination)
  ");
  $result = $statement->execute(
   array(
    ':customer_name' => $_POST["customerName"],
    ':flight_date' => $_POST["flightDate"],
    ':flight_source' => $_POST["flightSource"],
    ':flight_destination' => $_POST["flightDestination"]
   )
  );
  if(!empty($result))
  {
   echo 'Record Inserted';
  }
 }

 //This Code is for fetch single customer data for display on Modal
 if($_POST["action"] == "Select")
 {
  $output = array();
  $statement = $connection->prepare(
   "SELECT * FROM tickets 
   WHERE id = '".$_POST["id"]."' 
   LIMIT 1"
  );
  $statement->execute();
  $result = $statement->fetchAll();
  foreach($result as $row)
  {
   $output["customer_name"] = $row["customer_name"];
   $output["flight_date"] = $row["flight_date"];
   $output["flight_source"] = $row["flight_source"];
   $output["flight_destination"] = $row["flight_destination"];

  }
  echo json_encode($output);
 }

 if($_POST["action"] == "Update")
 {
  $statement = $connection->prepare(
   "UPDATE tickets 
   SET customer_name = :customer_name, flight_date = :flight_date, flight_source = :flight_source, flight_destination = :flight_destination
   WHERE id = :id"
  );
  $result = $statement->execute(
   array(
    ':customer_name' => $_POST["customerName"],
    ':flight_date' => $_POST["flightDate"],
    ':flight_source' => $_POST["flightSource"],
    ':flight_destination' => $_POST["flightDestination"],
    ':id'   => $_POST["id"]
   )
  );
  if(!empty($result))
  {
   echo 'Record Updated';
  }
 }

 if($_POST["action"] == "Delete")
 {
  $statement = $connection->prepare(
   "DELETE FROM tickets WHERE id = :id"
  );
  $result = $statement->execute(
   array(
    ':id' => $_POST["id"]
   )
  );
  if(!empty($result))
  {
   echo 'Record Deleted';
  }
 }

}

?>