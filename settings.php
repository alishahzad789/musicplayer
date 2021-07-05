<?php  
include("includes/includedFiles.php");
?>
<div class="SETTINGS" style = "height:100vh">
<div class="entityInfo">

	<div class="centerSection">
		<div class="userInfo">
			<h1><?php echo $userLoggedIn->getFirstAndLastName(); ?></h1>
		</div>
	</div>

	<div class="buttonItems">
		<button class="buttondetails" onclick="openPage('updateDetails.php')">USER DETAILS</button>
		<button class="buttonlogout" onclick="logout()">LOGOUT</button>
	</div>


</div>
</div>
