<?php

error_reporting(0);
if(isset($_POST['submit3']))
{
if (filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)===false) {
	$_SESSION['msg3'] = "Invalid email. Please try again";
	echo "<script type='text/javascript'> document.location = 'thankyou.php'; </script>";
} else if (!preg_match('/[\D]', $_POST['mobilenumber'])) {
	$_SESSION['msg3'] = "Telephone number must contain only digits. Please try again.";
	echo "<script type='text/javascript'> document.location = 'thankyou.php'; </script>";
}
else {
		$fname=$_POST['fname'];
		$mnumber=$_POST['mobilenumber'];
		$email=$_POST['email'];
		$password=md5($_POST['password']);
		$sql="INSERT INTO  tblusers(FullName,MobileNumber,EmailId,Password) VALUES(:fname,:mnumber,:email,:password)";
		$query = $dbh->prepare($sql);
		$query->bindParam(':fname',$fname,PDO::PARAM_STR);
		$query->bindParam(':mnumber',$mnumber,PDO::PARAM_STR);
		$query->bindParam(':email',$email,PDO::PARAM_STR);
		$query->bindParam(':password',$password,PDO::PARAM_STR);
		$query->execute();
		$lastInsertId = $dbh->lastInsertId();
		if($lastInsertId)
		{
		$_SESSION['msg3']="You are Successfully registered. Now you can login ";
		echo "<script type='text/javascript'> document.location = 'thankyou.php'; </script>";

		}
		else 
		{
		$_SESSION['msg3']="Something went wrong. Please try again.";
		echo "<script type='text/javascript'> document.location = 'thankyou.php'; </script>";

		}

	}
				
}

?>

<!-- Javascript for check email availabilty-->
<script>
function checkAvailability() {

$("#loaderIcon").show();
jQuery.ajax({
url: "check_availability.php",
data:'emailid='+$("#email").val(),
type: "POST",
success:function(data){
$("#user-availability-status").html(data);
$("#loaderIcon").hide();
},
error:function (){}
});
}
</script>

<script>
function checkAvailability2() {

$("#loaderIcon").show();
jQuery.ajax({
url: "check_availability2.php",
data:'mobileNum='+$("#mobile").val(),
type: "POST",
success:function(data){
$("#user-availability-status2").html(data);
$("#loaderIcon").hide();
},
error:function (){}
});
}
</script>

<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
				<div class="modal-dialog" role="document">
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>						
						</div>
							<section>
								<div class="modal-body modal-spa">
									<div class="login-grids">
										<div class="login">
											<div class="login-left">
												<ul>
													<li><a class="fb" href="#"><i></i>Facebook</a></li>
													<li><a class="goog" href="#"><i></i>Google</a></li>
													
												</ul>
											</div>
											<div class="login-right">
												<form name="signup" id="signupForm" method="post">
													<h3>Create your account </h3>
					

				<input type="text" value="" placeholder="Full Name" name="fname" autocomplete="off" required="">
				<input type="text" value="" id="mobile" placeholder="Mobile number" onChange="checkAvailability2()" maxlength="10" name="mobilenumber" autocomplete="off" required="">
				<span id="user-availability-status2" style="font-size:12px; color: red"></span> 

		<input type="text" value="" placeholder="Email id" name="email" id="email" onChange="checkAvailability()" autocomplete="off"  required="">	
		 <span id="user-availability-status" style="font-size:12px; color: red"></span> 
	<input type="password" value="" placeholder="Password" name="password" required="">	
													<input type="submit" name="submit3" id="submit" value="CREATE ACCOUNT">
												</form>
											</div>
												<div class="clearfix"></div>								
										</div>
											<p>By logging in you agree to our <a href="page.php?type=terms">Terms and Conditions</a> and <a href="page.php?type=privacy">Privacy Policy</a></p>
									</div>
								</div>
							</section>
					</div>
				</div>
			</div>