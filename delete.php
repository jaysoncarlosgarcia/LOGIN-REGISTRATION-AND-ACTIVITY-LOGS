<?php require_once 'core/models.php'; ?>
<?php require_once 'core/dbConfig.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Delete User</title>
	<link rel="stylesheet" href="styles.css">
</head>
<body>
	<h1>Are you sure you want to delete this user?</h1>
	<?php $getUserByID = getUserByID($pdo, $_GET['id']); ?>
	<div class="container">
		<h2>Last Name: <?php echo $getUserByID['last_name']; ?></h2>
		<h2>Email: <?php echo $getUserByID['email']; ?></h2>
		<h2>Gender: <?php echo $getUserByID['gender']; ?></h2>
		<h2>Address: <?php echo $getUserByID['address']; ?></h2>
		<h2>Birthday: <?php echo $getUserByID['birthday']; ?></h2>
		<h2>Degree: <?php echo $getUserByID['degree']; ?></h2>
		<h2>Experience: <?php echo $getUserByID['experience']; ?></h2>
        <h2>Position: <?php echo $getUserByID['position']; ?></h2>

		<div class="deleteBtn">
			<form action="core/handleForms.php?id=<?php echo $_GET['id']; ?>" method="POST">
				<input type="submit" name="deleteUserBtn" value="Delete">
			</form>			
		</div>
	</div>
</body>
</html>