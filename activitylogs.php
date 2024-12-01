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
    <title>Activity Logs</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <?php include 'navbar.php'; ?>
    <h1 class="message">Activity Logs</h1>
    <table class="data-table">
            <tr>
                <th>Activity Log ID</th>
                <th>Operation</th>
                <th>User ID</th>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Email</th>
                <th>Gender</th>
                <th>Address</th>
                <th>Birthday</th>
                <th>Degree</th>
                <th>Experience</th>
                <th>Position</th>
                <th>Updated By</th>
                <th>Date Added</th>
            </tr>
            <?php $getAllActivityLogs = getAllActivityLogs($pdo); ?>
            <?php foreach ($getAllActivityLogs as $row) { ?>
            <tr>
                <td><?php echo $row['activity_log_id']; ?></td>
                <td><?php echo $row['operation']; ?></td>
                <td><?php echo $row['id']; ?></td>
                <td><?php echo $row['first_name']; ?></td>
                <td><?php echo $row['last_name']; ?></td>
                <td><?php echo $row['email']; ?></td>
                <td><?php echo $row['gender']; ?></td>
                <td><?php echo $row['address']; ?></td>
                <td><?php echo $row['birthday']; ?></td>
                <td><?php echo $row['degree']; ?></td>
                <td><?php echo $row['experience']; ?></td>
                <td><?php echo $row['position']; ?></td>
                <td><?php echo $row['username']; ?></td>
                <td><?php echo $row['date_added']; ?></td>
            </tr>
            <?php } ?>
        </tbody>
    </table>
</body>
</html>
