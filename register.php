<?php  
require_once 'core/models.php'; 
require_once 'core/handleForms.php'; 
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Register</title>
	<link rel="stylesheet" href="styles.css">
</head>
<body>
    <?php  
	if (isset($_SESSION['message']) && isset($_SESSION['status'])) {

		if ($_SESSION['status'] == "200") {
			echo "<h1 style='color: green;'>{$_SESSION['message']}</h1>";
		}

		else {
			echo "<h1 style='color: red;'>{$_SESSION['message']}</h1>";	
		}

	}
	unset($_SESSION['message']);
	unset($_SESSION['status']);
	?>
	<h1>Register</h1>
	<form action="core/handleForms.php" method="POST">
		<p>
			<label for="username">Username: </label>
			<input type="text" name="username">
		</p>
        <p>
			<label for="firstName">First Name: </label>
			<input type="text" name="firstName">
		</p>
        <p>
			<label for="lastName">Last Name: </label>
			<input type="text" name="lastName">
		</p>
        <p>
			<label for="password">Password: </label>
			<input type="password" name="password">
		</p>
        <p>
			<label for="confirmpassword">Confirm Password: </label>
			<input type="password" name="confirmpassword">
		</p>
        <input type="submit" name="registerUserBtn">
	</form>
</body>
</html>