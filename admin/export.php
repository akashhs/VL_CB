<?php
include('config.php');

//export csv file

$from= $_POST['from'].' 00:00:00';
$to= $_POST['to'].' 23:59:59';

if(isset($_POST["export"]))
{


header("Content-type: text/csv; charset=utf-8");
header("Content-disposition: attachment; filename=data.csv");
$output = fopen("php://output", "w");
fputcsv($output, array('Id', 'Name', 'Email', 'phon_number', 'city', 'ip', 'browser', 'devicenam', 'os', 'devicetype', 'date'));
$query = "SELECT `id`, `name`, `email`, `phon_number`, `city`, `ip`, `browser`, `devicename`, `os`, `devicetype`, `date` FROM users ";

$result = mysqli_query($conn,$query);
while($row = mysqli_fetch_assoc($result))
	{
	fputcsv($output, $row);
	}
fclose($output);
}

?>
