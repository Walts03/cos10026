<?php
session_start();
if (isset($_SESSION['authenticated']) && $_SESSION['authenticated']) {
    header("Location: ./manager.php");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>KAAT Shoe Website</title>
    <link rel="icon" href="styles/images/logo/logoteam1.png" type="image/png">
</head>

<body id="loginf">
    <div id="alllogin">
    <?php include_once 'includes/header.inc'; ?>
    <div class="containerlog" id="containerlog">
		<div class="form-container log-in-container">
			<form id = "testform" method='post'  action="authentication.php" novalidate>
				<h1>Login</h1>
                <br>
				<input id="testf" type='text' placeholder='Username' name="username" id="username" pattern="[A-Za-z]{1,25}"  required />
				<input id="testf" type='password' placeholder='Password' name="password" id="password" pattern="[A-Za-z]{1,25}"  required /> 
                <br>
				<input type="submit" value="Login" id="loginsubmitbtn">
                <br>
                <div class="hint">
                            <p> Username: admin </p>
                            <p> Password: password </p>
                </div>
                <br>
                <?php   //print error message if the form is submitted with incorrect username or password
                            if (isset($_GET["error_msg"])) {
                                if ($_GET["error_msg"] == "AccessDenied") {
                                    echo "<div class='subtitle'>Invalid username or password. Please try again</div>";
                                } else if ($_GET["error_msg"] == "Unauthenticated") {
                                    echo "";
                                }
                            }
                            ?>
			</form>
		</div>
		<div class="overlay-container">
			<div class="overlay1">
				<div class="overlay-panel overlay-right">
				</div>
			</div>
		</div>
	</div>
</div>
    <?php include_once 'includes/footer.inc'; ?>
</body>

</html>