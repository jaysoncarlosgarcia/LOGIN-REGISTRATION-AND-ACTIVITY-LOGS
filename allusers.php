<?php  
require_once 'core/models.php'; 
require_once 'core/handleForms.php'; 

if (!isset($_SESSION['username'])) {
	header("Location: login.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>All Users</title>
	<link rel="stylesheet" href="styles.css">
</head>
<body>
	<?php include 'navbar.php'; ?>
	<div class="container">
		<h2>All Users</h2>
		<ul class="user-list">
			<?php $getAllAccounts = getAllAccounts($pdo); ?>
			<?php foreach ($getAllAccounts as $row) { ?>
				<li class="user-item"><?php echo htmlspecialchars($row['username']); ?></li>
			<?php } ?>
		</ul>
	</div>
</body>
</html>
