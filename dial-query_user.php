<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312" />
<title>Tel Cost</title>
</head>
<?php
$con = mysqli_connect("localhost","root","123456","db_course_design");
if ($con == FALSE)
{
  printf("Could not connect: %s", mysqli_connect_error());
}
$from=$_POST['from'];
$to=$_POST['to'];
$number=$_COOKIE['phone_number'];
$sql0 = "select * from phone_number where phone_number = $number;";
$res0=mysqli_query($con,$sql0)or die("error0:".$con->error);
$row = mysqli_fetch_object($res0);
if(empty($row)){
   printf("no such number");
}
else{
	$sql1 = "select *
	from call_record
	where (dailing_number = $number or called_number = $number) and start_time >= '$from' and start_time <= '$to';";
	$res1=mysqli_query($con,$sql1)or die("error1:".$con->error);
	if($res1){
		echo "<table border=\"1\"> \n";
		echo "<tr>\n";
		echo "<td>Dailing number</td>\n";
		echo "<td>Called number</td>\n";
		echo "<td>Start time</td>\n";
		echo "<td>End time</td>\n";
		echo "<td>Calling type</td>\n";
		echo "<td>Cost</td>\n";
		echo "</tr>\n";
		while($array = mysqli_fetch_array($res1,MYSQL_ASSOC)){
			echo "<tr> \n";
			$dailing_number = $array['dailing_number'];
			$called_number = $array['called_number'];
			$start_time = $array['start_time'];
			$end_time = $array['end_time'];
			$type = $array['calling_type'];
			$cost = $array['cost'];
			echo "<td>$dailing_number</td>";
			echo "<td>$called_number</td>";
			echo "<td>$start_time</td>";
			echo "<td>$end_time</td>";
			echo "<td>$type</td>";
			echo "<td>$cost</td>";
			echo "</tr> \n";
		}
		echo "</table> \n";
	}
}
mysqli_close($con);
?>
</br>
<a href="user-query.php">����</a>
</body>
</html>

