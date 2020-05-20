<!DOCTYPE html>
<!-- UP812110 -->
<!-- Connect to database -->
<?php
 $db = mysqli_connect('localhost','root','password','testspace')
 or die('Error connecting to MySQL server.');
?>
<html lang="en">
<head>
  <title>Search</title>
  <link rel="stylesheet" href="webpage-css/home-css.css">
  <link href="./assets/css/style.css" rel="stylesheet" type="text/css" />
  <meta name="viewport" content="width=device-width">

  <script>
function showLocation(str) {
    if (str == "") {
        document.getElementById("txtHint").innerHTML = "";
        return;
    } else {
        if (window.XMLHttpRequest) {
            // code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp = new XMLHttpRequest();
        } else {
            // code for IE6, IE5
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("txtHint").innerHTML = this.responseText;
            }
        };
        xmlhttp.open("GET","getLocation.php?q="+str,true);
        xmlhttp.send();
    }
}

// function myFunction() {
//   // Get the checkbox
//   var checkBox = document.getElementById("myCheck");
//   // Get the output text
//   var text = document.getElementById("text");
//
//   // If the checkbox is checked, display the output text
//   if (checkBox.checked == true){
//     text.style.display = "block";
//   } else {
//     text.style.display = "none";
//   }
// }
// </script>

<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script> -->

</script>
</head>
<body>
  <!--Navigation bar-->
  <header id="headerfixed" class="clearfix">
      <div class="container">
  			<div class="header-left">
  				<img id="logo" alt="Your Space Logo" src="webpage-pictures/logo1.png"/>
  			</div>
  			<div class="header-right">
  				<label for="open">
  					<span class="hidden-desktop"></span>
  				</label>
  				<input type="checkbox" id="open">
  				<nav>
  					<a href="index.php">Search for a Space</a>
            <a href=".html">Add a Space</a>
  					<a href="account.html">Account</a>
  					<a href="contactus.html">Contact Us</a>
  				</nav>
  			</div>
  		</div>
  	</header>
    <div class="wrapper">
      <header id="headernamefixed">Search for a space</header>
      <article class="main" id="main1">
        <section class="search">

          <!-- Filtering form -->
          <form id="myform" name="theform" method="post">
            <ol>
              <li>
                <!-- List Location in dropdown menu-->
                  <label for="locationNameList">Location:</label>
                  <?php
                    $resultLocation = "SELECT idLocation,locationName FROM Location";
                    $result1 = mysqli_query($db, $resultLocation);

                    echo "<select name='locationNameList' onchange='showLocation(this.value)'>";
                    //($row = $result1->fetch_assoc())
                    echo "<option value='allLocation'>Select a location:</option>";
                    while ($row = mysqli_fetch_array( $result1, MYSQLI_ASSOC )) {

                                  unset($idLocation, $locationName);
                                  $idLocation = $row['idLocation'];
                                  $locationName = $row['locationName'];
                                  echo '<option value="'.$idLocation.'">'.$locationName.'</option>';
                    }
                    echo "</select>";
                  ?>
                </li>
                <li>
                  <label>Space Type:</label>
                  <?php
                    $resultSpaceType = "SELECT idSpaceType,spaceTypeName FROM SpaceType";
                    $result2 = mysqli_query($db, $resultSpaceType);

                    while ($row = mysqli_fetch_array( $result2, MYSQLI_ASSOC )) {

                                  unset($idSpaceType, $spaceTypeName);
                                  $idSpaceType = $row['idSpaceType'];
                                  $spaceTypeName = $row['spaceTypeName'];
                                  echo '<label class="containerCheckBox" id="checkBoxStyle">';
                                  echo '<input type="checkbox" value="'.$idSpaceType.'" name="spaceType[]">';
                                  echo $spaceTypeName.'<span class="checkmark"></span></label>';
                    }
                    echo "</select>";
                  ?>
              </li>
              <li>
                <label>Date: </label>
                <input type="date" name="date" id="date" />
              </li>
            </ol>
          </form>
        </section>

        <!-- Displays table result -->
        <section>
          <br>
          <div id="txtHint">
          <?php
          $_GET['q'] = 'allLocation';
          include 'getLocation.php'; ?>

          </div>

          <?php mysqli_close($db); ?>


        </section>
      </article>
    </div>
</body>
