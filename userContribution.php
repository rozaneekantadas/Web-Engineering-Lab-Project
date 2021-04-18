<?php
session_start();
?>

<?php
	$userName = $_SESSION["userName"];
	$name = $_SESSION["name"];		
	$studentId = $_SESSION["studentId"];
	$email = $_SESSION["email"];
	$phone = $_SESSION["phone"];
	$address = $_SESSION["address"];
	$password = $_SESSION["password"];
?>

<!DOCTYPE html>
<html>
<head>
	<title>Contribution</title>
	<link rel="stylesheet" type="text/css" href="userContributionstyle.css">
	<link rel="icon" href="images/diuIcon.png" type="image/gif" sizes="16x16">
</head>
<body>
	<div class="header">
		<div class="div1">
			<img src="images/diulogo.png" width="250" height="70">
		</div>
		<div class="div2">
			<img src="images/cselog.png" width="250" height="70">
		</div>
	</div>

	<div class="div3">
		<div class="proIcon">
			<img src="images/profileIcon.png" alt="propicicon">
			<p id="hiText"></p>	
		</div>

		<div class="navItem">
			<ul>
			<li><a href="userDashboard.php">Dashboard</a></li>
			<li><a href="userProfile.php">Profile</a></li>
			<li><a class="active" href="userContribution.php">Contribution</a></li>
			<li><form action="<?php $_SERVER["PHP_SELF"]; ?>" method = "post">
		<input id="logout" type="submit" name="logout" value="Log Out">
	</form></li>
			<li><a href="aboutPage.php">About</a></li>
			</ul>
		</div>
	</div>

    <div class="info">
		<div class="page">
			<h2>Contribution</h2>
			<h4>Add Teacher's Information<h4>
				<br><br>
				
			<form method="post" enctype="multipart/form-data">
			<label for="file">Select Image <span style="color: red;">*</span></label><br>
			<input type="file" name="images" id="img">
			<p id="imageError"></p><br>

			<label>Initial <span style="color: red;">*</span></label><br>
			<input type="text" name="tcrInitial" id="tcrIntiial" placeholder="Ex. TSP" value="<?php echo $_POST['tcrInitial']?? ''; ?>">
			<p id="initialError"></p><br>

			<label>Teacher Name  <span style="color: red;">*</span></label><br>
			<input type="text" name="tcrName" id="tcrName" placeholder="Ex. Tahmina Sultana Priya" value="<?php echo $_POST['tcrName']?? ''; ?>">
			<p id="nameError"></p><br>

			<label>Designation  <span style="color: red;">*</span></label><br>
			<input type="text" name="designation" id="designation" placeholder="Ex. Lecturer" value="<?php echo $_POST['designation']?? ''; ?>">
			<p id="desError"></p><br>

			<label>Department <span style="color: red;">*</span></label><br>
			<input type="text" name="department" id="department" placeholder="Ex. CSE" value="<?php echo $_POST['department']?? ''; ?>">
			<p id="deptError"></p><br>

			<label>Email  <span style="color: red;">*</span></label><br>
			<input type="email" name="tcrEmail" id="tcrEmail" placeholder="Ex. tahmina.cse@diu.edu.bd" value="<?php echo $_POST['tcrEmail']?? ''; ?>">
			<p id="emailError"></p><br>

			<label>Phone  <span style="color: red;">*</span></label><br>
			<input type="text" name="phone" id="phone" placeholder="Ex. 01679357283" value="<?php echo $_POST['phone']?? ''; ?>">
			<p id="phoneError"></p><br>

			<input type="submit" id="infoSubmit" name="submit" value="Submit">
		</form>
		</div>
	</div>

	<footer>
		<hr>
		<p>&copy; 2021 Team Anonymouns. All Rights Reserved</p>
	</footer>

	<?php

	$getName = explode(" ", $name);

		echo "<script>
		document.getElementById('hiText').innerHTML = 'Hi,&nbsp;".$getName[0].
		"'</script>";
	?>

	<?php

		include 'databaseconnection.php';

		if (isset($_POST['submit'])) {

		 if (isset($_FILES['images']) && !empty($_FILES['images']['tmp_name'])) {

			if (getimagesize($_FILES['images']['tmp_name']) == FALSE) {
				echo "<script>
						var imageMsg = 'Please select a image';
						document.getElementById('img').style.borderColor = 'red';

						document.getElementById('imageError').innerHTML = imageMsg;		
				</script>";
			}
			else{
				$image = addslashes($_FILES['images']['tmp_name']);
				$name = addslashes($_FILES['images']['name']);
				$image = file_get_contents($image);
				$image = base64_encode($image);

				$initial = $_POST['tcrInitial'];
				$tcrName = $_POST['tcrName'];
				$tcrdes = $_POST['designation'];
				$tcrdept = $_POST['department'];
				$tcremail = $_POST['tcrEmail'];
				$tcrphone = $_POST['phone'];

				if ($initial == '' || $tcrName == '' || $tcrdes == '' || $tcrdept == '' || $tcremail == '' || $tcrphone == '') {

					if ($initial == '') {
						echo "<script>
						var iniMsg = 'Please enter teacher inital';
						document.getElementById('tcrIntiial').style.borderColor = 'red';

						document.getElementById('initialError').innerHTML = iniMsg;		
				</script>";
					}

					if ($tcrName == '') {
						echo "<script>
						var nameMsg = 'Please enter teacher name';
						document.getElementById('tcrName').style.borderColor = 'red';

						document.getElementById('nameError').innerHTML = nameMsg;		
				</script>";
					}
					if ($tcrdes == '') {
						echo "<script>
						var desMsg = 'Please enter teacher designation';
						document.getElementById('designation').style.borderColor = 'red';

						document.getElementById('desError').innerHTML = desMsg;		
				</script>";
					}
					if ($tcrdept == '') {
						echo "<script>
						var deptMsg = 'Please enter teacher department';
						document.getElementById('department').style.borderColor = 'red';

						document.getElementById('deptError').innerHTML = deptMsg;		
				</script>";
					}
					if ($tcremail == '') {
						echo "<script>
						var emailMsg = 'Please enter teacher email';
						document.getElementById('tcrEmail').style.borderColor = 'red';

						document.getElementById('emailError').innerHTML = emailMsg;		
				</script>";
					}
					if ($tcrphone == '') {
						echo "<script>
						var phnMsg = 'Please enter teacher phone number';
						document.getElementById('phone').style.borderColor = 'red';

						document.getElementById('phoneError').innerHTML = phnMsg;		
				</script>";
					}					
				}
				else{
				   $sql = "INSERT INTO contribution (initial, name, designation, department, email, phone, image)
				VALUES ('$initial', '$tcrName', '$tcrdes', '$tcrdept', '$tcremail', '$tcrphone', '$image');";

				if (mysqli_query($conn, $sql)) {
				echo "<script> window.alert('Thanks for your contribution'); </script>";
					}
			}

			}	
			}
			else{
				echo "<script>
						var imageMsg = 'Please select a image';
						document.getElementById('img').style.borderColor = 'red';

						document.getElementById('imageError').innerHTML = imageMsg;		
				</script>";
			}		
		}
	?>

	<?php

	if(isset($_POST["logout"])){
		session_unset();
		session_destroy();

		echo "<script> window.alert('Log Out'); </script>";
		echo "<script> window.location.assign('login.php'); </script>";
	}
	?>

</body>
</html>