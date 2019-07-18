<?php 
require_once("includes/config.php");
// code admin email availablity
if(!empty($_POST["mobileNum"])) {
	$mobileNum = $_POST["mobileNum"];
	if (!preg_match('/[\D]', $_POST['mobilenumber'])) {
		echo "error : Number must contain only digits";
	}
	else {

}
}


?>

