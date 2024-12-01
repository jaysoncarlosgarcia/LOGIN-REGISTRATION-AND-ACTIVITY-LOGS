
<?php require_once 'core/handleForms.php'; ?>
<?php require_once 'core/models.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Edit User</title>
	<link rel="stylesheet" href="styles.css">
</head>
<body>
	<?php $getUserByID = getUserByID($pdo, $_GET['id']); ?>
	<h1>Edit the user!</h1>
	<form action="core/handleForms.php?id=<?php echo $_GET['id']; ?>" method="POST">
		<p>
			<label for="firstName">First Name</label> 
			<input type="text" name="first_name" value="<?php echo $getUserByID['first_name']; ?>">
		</p>
		<p>
			<label for="firstName">Last Name</label> 
			<input type="text" name="last_name" value="<?php echo $getUserByID['last_name']; ?>">
		</p>
		<p>
			<label for="firstName">Email</label> 
			<input type="text" name="email" value="<?php echo $getUserByID['email']; ?>">
		</p>
		<p>
			<label for="firstName">Gender</label> 
			<input type="text" name="gender" value="<?php echo $getUserByID['gender']; ?>">
		</p>
		<p>
			<label for="firstName">Address</label> 
			<input type="text" name="address" value="<?php echo $getUserByID['address']; ?>">
		</p>
		<p>
			<label for="firstName">Birthday</label> 
			<input type="date" name="birthday" value="<?php echo $getUserByID['birthday']; ?>">
		</p>
		<p>
			<label for="firstName">Degree</label> 
			<input type="text" name="degree" value="<?php echo $getUserByID['degree']; ?>">
		</p>
        <p>
			<label for="firstName">Experience</label> 
			<input type="text" name="experience" value="<?php echo $getUserByID['experience']; ?>">
		</p>
		<p>
			<label for="firstName">Position</label> 
			<input type="text" name="position" value="<?php echo $getUserByID['position']; ?>">
			<input type="submit" value="Save" name="editUserBtn">
		</p>
	</form>
</body>
</html>
