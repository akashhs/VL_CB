<?php
   include_once('config.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u"
    crossorigin="anonymous">
  <link rel="stylesheet" href="assets/datatables/DataTables-1.10.16/css/dataTables.bootstrap.min.css">
  <link rel="stylesheet" href="assets/css/missed-calls.css">
  <title>Chat bot</title>
</head>

<body>

  <div class="container-fluid logout-container">
      <div class="row">
          <div class="col-md-2">
               <div calss="pull-left">
    <img  src="assets/images/logo.png" alt=""></div>
          </div>
     
 <!--   <div class="col-md-8">
    <div class="rslogo pull-left">
        <img class="img-responsive" src="assets/images/rsbannerjpg.jpg" alt="">
    </div> </div> -->
    <div class="col-md-2">
    <div id="logoutBtn" class="btn  btn-danger pull-right"><a style="color:#fff;" href="logout.php">Log Out</a></div>
      </div>
  </div>
   </div>
  <div class="container table-container">

<form method="POST" action="export.php">
<table cellspacing="10">
<tbody>
<tr>
<td><label for="from">From:</label></td>
<td><input type="date" id="from" name="from" value="2018-05-01" /></td>

<td><label  for="to" >To:</label></td>


<td><input type="date" id="to" name="to" /></td>
<td><input type="submit" name="export" value="CSV Export" class="btn btn-success"></td>
</tr>
</tbody>
</table>
</form>
<p></p>
    <table id="missedCallsTable1" class="table table-bordered">
      <thead>
        <th>id</th>
        <th>Name</th>
        <th>Email</th>
        <th>Phone number</th>
        <th>city</th>
        <th>Ip</th>
        <th>Browser</th>
        <th>Device Name</th>
        <th>OS</th>
        <th>Device Type</th>
        <th>Date</th>
      </thead>
      <tbody>
<?php
$sql = "SELECT * FROM users ORDER BY date DESC";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
     $i = 1; 
    while($row = $result->fetch_assoc()) {
       
?>
        <tr>
          <td><?php echo $i ;?></td>
          <td><?php echo $row["name"];?></td>
       <td><?php $str = $row['email'];?></td>
          <td><?= $row['phon_number'];?></td>
          <td><?php $row['city'];?></td>
         <td><?=$row['ip']; ?> </td>
          <td><?php echo $row["browser"]; ?></td>
          <td><?=$row['devicename'] ;?></td>
          <td><?=$row['os'] ;?></td>
          <td><?= $row['devicetype'];?></td>
          <td><?= $row['date'];?></td>
        </tr>
<?php
$i++;
}
} else {
    echo "0 results";
}
        ?>

      </tbody>
    </table>
  </div>


  <!-- End of table container -->




  <!-- Start Of Modal -->
  <!-- Button trigger modal -->


  <!-- Modal -->
  <div class="modal fade" id="editInfo" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
          <h4 class="modal-title" id="myModalLabel">
            <table id="displayItem" class="table table-bordered">
              <thead>
                <th id="showId"></th>
                <th id="showPhone"></th>
                <th id="showVendor"></th>
                <th id="showDate"></th>
              </thead>
            </table>

          </h4>
        </div>
        <div class="modal-body">
          <form action="" id="editInfoForm">
            <div class="row">
              <div class="form-group">
                <input type="text" name="name" id="name" class="form-control" placeholder="name">
              </div>
              <div class="form-group">
                <input type="email" name="email" class="form-control" id="email" placeholder="email">
              </div>
            </div>
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary">Save changes</button>
        </div>
      </div>
    </div>
  </div>

  <!-- End Of Modal -->

  <!-- Start of footer -->
  <footer>
    <p>&copy; Valueleaf</p>
  </footer>
  <!-- End Of Footer -->

  <script src="assets/jquery/jquery-3.2.1.min.js"></script>
  <script src="assets/datatables/datatables.min.js"></script>
  <script src="assets/datatables/DataTables-1.10.16/js/dataTables.bootstrap.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa"
    crossorigin="anonymous"></script>
  <script src="assets/js/datatable-script.js"></script>
</body>
</html>