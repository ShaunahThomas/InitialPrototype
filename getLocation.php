<!DOCTYPE html>
<html>
<head>
<style>
table {
    width: 100%;
    border-collapse: collapse;
}

table, td, th {
    border: 1px solid black;
    padding: 5px;
}

th {text-align: left;}
</style>
</head>
<body>




<?php

$q = $_GET['q'];

//Connect to database
$con = mysqli_connect('localhost','root','password','testspace');
if (!$con) {
    die('Could not connect: ' . mysqli_error($con));
}

mysqli_select_db($con,"testspace");
$sql1="SELECT * FROM AvailableSpace WHERE idLocation = '".$q."'";

//Query for location
if ($q == "allLocation"){
  $sql = "SELECT SpaceType.spaceName, SpaceType.spaceTypeName, Location.locationName, Provider.providerName, SpaceImage.spaceImage
  FROM AvailableSpace
  INNER JOIN SpaceType
  ON AvailableSpace.idSpaceType=SpaceType.idSpaceType
  INNER JOIN Location
  ON AvailableSpace.idLocation=Location.idLocation
  INNER JOIN Provider
  ON AvailableSpace.idProvider=Provider.idProvider
  INNER JOIN SpaceImage
  ON AvailableSpace.idSpaceImage=SpaceImage.idSpaceImage";
  }
  else {
  $sql="SELECT SpaceType.spaceName, SpaceType.spaceTypeName, Location.locationName, Provider.providerName, SpaceImage.spaceImage
  FROM AvailableSpace
  INNER JOIN SpaceType
  ON AvailableSpace.idSpaceType=SpaceType.idSpaceType
  INNER JOIN Location
  ON AvailableSpace.idLocation=Location.idLocation
  INNER JOIN Provider
  ON AvailableSpace.idProvider=Provider.idProvider
  INNER JOIN SpaceImage
  ON AvailableSpace.idSpaceImage=SpaceImage.idSpaceImage
  WHERE AvailableSpace.idLocation = '".$q."'";

}















$result = mysqli_query($con,$sql);









echo "<table id='tableStyle' >
<tr>
<th>Space Name</th>
<th>Space Type</th>
<th>Location</th>
<th>Provider</th>
<th>Space Image</th>
</tr>";
while($row = mysqli_fetch_array($result)) {
    echo "<tr>";
    echo "<td>" . $row['spaceName'] . "</td>";
    echo "<td>" . $row['spaceTypeName'] . "</td>";
    echo "<td>" . $row['locationName'] . "</td>";
    echo "<td>" . $row['providerName'] . "</td>";
    echo "<td>".'<img id=resultTableImage src="data:image/jpeg;base64,'. base64_encode( $row['spaceImage'] ) .'"/>'."</td>";
    // echo "<td>" .'<img src="'. $row['spaceImage'] .'"/>' . "</td>";
    echo "</tr>";
}
echo "</table>";





?>
<?php
// var_dump($_POST['checkSpaceType']); ?>
<?php
// $spaceType1 = $_REQUEST['checkSpaceType'];
// foreach ($spaceType1 as $key => $value) {
//   echo $spaceType1[$key], "<br>";

 ?>
<?php
// mysqli_close($con);
?>

<?php
// $db = mysqli_connect("localhost","root","","DbName");
// $sql = "SELECT * FROM products WHERE id = $id";
// $sth = $db->query($sql);
// $result=mysqli_fetch_array($sth);
// echo '<img src="data:image/jpeg;base64,'.base64_encode( $result['image'] ).'"/>';
//
//



// testing checkbox
// $select = 'SELECT *';
// $from = ' FROM AvailableSpace';
// $where = ' WHERE TRUE';
// $sql2 = $select . $from . $where;
// $statement = $con->prepare($sql);
// $statement->execute();
// $results=$statement->fetchAll(con::FETCH_ASSOC);
// $json=json_encode($results);
// echo($json);

 ?>


</body>
</html>
