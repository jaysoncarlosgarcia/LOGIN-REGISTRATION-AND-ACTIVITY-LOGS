<?php 
require_once 'core/dbConfig.php';
require_once 'core/models.php'; 


if (!isset($_SESSION['username'])) {
	header("Location: login.php");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Home</title>
	<link rel="stylesheet" href="styles.css">
	<script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
</head>
<body>
	<h1>Hello <?php echo $_SESSION['username']; ?>!</h1>
	<?php if (isset($_SESSION['message'])) { ?>
		<h1 style="color: green; text-align: center; background-color: ghostwhite; border-style: solid;">	
			<?php echo $_SESSION['message']; ?>
		</h1>
	<?php } unset($_SESSION['message']); ?>

	<?php include 'navbar.php'; ?>
		<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" method="GET">
		<input type="text" name="searchInput" placeholder="Search here">
		<input type="submit" name="searchBtn" value="Search">
		</form>

	<table style="width:auto; margin-top: 20px;">
		<tr>
			<th>First Name</th>
			<th>Last Name</th>
			<th>Email</th>
			<th>Gender</th>
			<th>Address</th>
			<th>Birthday</th>
			<th>Degree</th>
			<th>Experience</th>
            <th>Position</th>
			<th>Date Added</th>
			<th>Added By</th>
			<th>Last Updated</th>
			<th>Last Updated By</th>
			<th>Action</th>
		</tr>

		<?php if (!isset($_GET['searchBtn'])) { ?>
			<?php $getAllUsers = getAllUsers($pdo); ?>
				<?php foreach ($getAllUsers as $row) { ?>
					<tr>
						<td><?php echo $row['first_name']; ?></td>
						<td><?php echo $row['last_name']; ?></td>
						<td><?php echo $row['email']; ?></td>
						<td><?php echo $row['gender']; ?></td>
						<td><?php echo $row['address']; ?></td>
						<td><?php echo $row['birthday']; ?></td>
						<td><?php echo $row['degree']; ?></td>
						<td><?php echo $row['experience']; ?></td>
						<td><?php echo $row['position']; ?></td>
                        <td><?php echo $row['date_added']; ?></td>
						<td><?php echo $row['added_by']; ?></td>
						<td><?php echo $row['last_updated']; ?></td>
						<td><?php echo $row['last_updated_by']; ?></td>
						<td>
							<a href="edit.php?id=<?php echo $row['id']; ?>">Edit</a>
							<a href="delete.php?id=<?php echo $row['id']; ?>">Delete</a>
						</td>
					</tr>
			<?php } ?>
			
		<?php } else { ?>
			<?php $searchForAUser = searchForAUser($pdo, $_GET['searchInput']); ?>
				<?php foreach ($searchForAUser as $row) { ?>
					<tr>
						<td><?php echo $row['first_name']; ?></td>
						<td><?php echo $row['last_name']; ?></td>
						<td><?php echo $row['email']; ?></td>
						<td><?php echo $row['gender']; ?></td>
						<td><?php echo $row['address']; ?></td>
						<td><?php echo $row['birthday']; ?></td>
						<td><?php echo $row['degree']; ?></td>
						<td><?php echo $row['experience']; ?></td>
                        <td><?php echo $row['position']; ?></td>
						<td><?php echo $row['date_added']; ?></td>
						<td><?php echo $row['added_by']; ?></td>
						<td><?php echo $row['last_updated']; ?></td>
						<td><?php echo $row['last_updated_by']; ?></td>
						<td>
							<a href="edit.php?id=<?php echo $row['id']; ?>">Edit</a>
							<a href="delete.php?id=<?php echo $row['id']; ?>">Delete</a>
						</td>
					</tr>
				<?php } ?>
		<?php } ?>	
		
	</table>
</body>
</html>