<?php require_once 'core/handleForms.php'; ?>
<?php require_once 'core/models.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Insert Details</title>
	<link rel="stylesheet" href="styles.css">
</head>
<body>
	<?php if (isset($_SESSION['message'])) { ?>
		<h1 style="color: red; text-align: center; background-color: ghostwhite; border-style: solid;">	
			<?php echo $_SESSION['message']; ?>
		</h1>
	<?php } unset($_SESSION['message']); ?>

	<h1>Enter your details to register.</h1>
	<form action="core/handleForms.php" method="POST">
		<p>
			<label for="firstName">First Name</label> 
			<input type="text" name="first_name">
		</p>
		<p>
			<label for="firstName">Last Name</label> 
			<input type="text" name="last_name">
		</p>
		<p>
			<label for="firstName">Email</label> 
			<input type="text" name="email">
		</p>
		<p>
			<label for="firstName">Gender</label> 
			<input type="text" name="gender">
		</p>
		<p>
			<label for="firstName">Address</label> 
			<input type="text" name="address">
		</p>
		<p>
			<label for="firstName">Birthday</label> 
			<input type="date" name="birthday">
		</p>
		<p>
			<label for="firstName">Degree</label> 
			<input type="text" name="degree">
		</p>
        <p>
			<label for="firstName">Experience</label> 
			<input type="text" name="experience">
		</p>
		<p>
			<label for="firstName">Position</label> 
			<input type="text" name="position">
			<input type="submit" name="insertUserBtn">
		</p>
	</form>
</body>
</html>