<?php  
require_once 'core/models.php'; 
require_once 'core/handleForms.php'; 
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Login</title>
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
	<div class="login-page">
		<div class="login-container">
		<h1>Welcome Back!</h1>
		<p class="login-message">Please login to continue.</p>
		<form action="core/handleForms.php" class="login-form" method="POST">
    		<div class="input-container">
        		<label for="username">Username:</label>
        		<input type="text" name="username" placeholder="Enter your username">
    		</div>
    		<div class="input-container">
        		<label for="password">Password:</label>
        		<input type="password" name="password" placeholder="Enter your password">
    		</div>
    <button type="submit" name="loginUserBtn" class="login-btn">Login</button>
</form>
		<p class="register-link">Don't have an account? <a href="register.php" class="register-btn">Register here</a></p>
		</div>
	</div>
</body>
</html>
