<?php  

require_once 'dbConfig.php';

function checkIfAccountExists($pdo, $username) {
	$response = array();
	$sql = "SELECT * FROM user_accounts WHERE username = ?";
	$stmt = $pdo->prepare($sql);

	if ($stmt->execute([$username])) {

		$userInfoArray = $stmt->fetch();

		if ($stmt->rowCount() > 0) {
			$response = array(
				"result"=> true,
				"status" => "200",
				"userInfoArray" => $userInfoArray
			);
		}

		else {
			$response = array(
				"result"=> false,
				"status" => "400",
				"message"=> "User doesn't exist from the database"
			);
		}
	}

	return $response;

}

function insertNewAccount($pdo, $username, $first_name, $last_name, $password) {
	$response = array();
	$checkIfAccountExists = checkIfAccountExists($pdo, $username); 

	if (!$checkIfAccountExists['result']) {

		$sql = "INSERT INTO user_accounts (username, first_name, last_name, password) 
		VALUES (?,?,?,?)";

		$stmt = $pdo->prepare($sql);

		if ($stmt->execute([$username, $first_name, $last_name, $password])) {
			$response = array(
				"status" => "200",
				"message" => "User successfully inserted!"
			);
		}

		else {
			$response = array(
				"status" => "400",
				"message" => "An error occured with the query!"
			);
		}
	}

	else {
		$response = array(
			"status" => "400",
			"message" => "User already exists!"
		);
	}

	return $response;
}

function getAllAccounts($pdo) {
	$sql = "SELECT * FROM user_accounts";
	$stmt = $pdo->prepare($sql);
	$executeQuery = $stmt->execute();

	if ($executeQuery) {
		return $stmt->fetchAll();
	}
}

function getAllUsers($pdo) {
	$sql = "SELECT * FROM users";
	$stmt = $pdo->prepare($sql);
	$executeQuery = $stmt->execute();

	if ($executeQuery) {
		return $stmt->fetchAll();
	}
}

function searchForAUser($pdo, $searchInput) {
	$sql = "SELECT * FROM users WHERE 
			CONCAT(first_name,last_name,email,gender,
				address,birthday,degree,experience,position,
				date_added,added_by,
				last_updated,
				last_updated_by) 
			LIKE ?";

	$stmt = $pdo->prepare($sql);
	$executeQuery = $stmt->execute(["%".$searchInput."%"]);
	if ($executeQuery) {
		return $stmt->fetchAll();
	}
}

function getUserByID($pdo, $id) {
	$sql = "SELECT * FROM users WHERE id = ?";
	$stmt = $pdo->prepare($sql);
	if ($stmt->execute([$id])) {
		return $stmt->fetch();
	}
}

function insertAnActivityLog($pdo, $operation, $id, $first_name, $last_name, $email, $gender, 
	$address, $birthday, $degree, $experience, $position, $username) {

	$sql = "INSERT INTO activity_logs (operation,id,first_name,last_name,email,gender,
			address,birthday,degree,experience,position,username) VALUES(?,?,?,?,?,?,?,?,?,?,?,?)";

	$stmt = $pdo->prepare($sql);
	$executeQuery = $stmt->execute([$operation, $id, $first_name, $last_name, $email, $gender, 
	$address, $birthday, $degree, $experience, $position, $username]);

	if ($executeQuery) {
		return true;
	}

}

function getAllActivityLogs($pdo) {
	$sql = "SELECT * FROM activity_logs 
			ORDER BY date_added DESC";
	$stmt = $pdo->prepare($sql);
	if ($stmt->execute()) {
		return $stmt->fetchAll();
	}
}

function insertAUser($pdo, $first_name, $last_name, $email, $gender, 
$address, $birthday, $degree, $experience, $position, $added_by) {
	$response = array();
	$sql = "INSERT INTO users (first_name,last_name,email,gender,
			address,birthday,degree,experience,position,added_by) VALUES(?,?,?,?,?,?,?,?,?,?)";
	$stmt = $pdo->prepare($sql);
	$insertUser = $stmt->execute([$first_name, $last_name, $email, $gender, 
	$address, $birthday, $degree, $experience, $position, $added_by]);

	if ($insertUser) {
		$findInsertedItemSQL = "SELECT * FROM users ORDER BY date_added DESC LIMIT 1";
		$stmtfindInsertedItemSQL = $pdo->prepare($findInsertedItemSQL);
		$stmtfindInsertedItemSQL->execute();
		$getUserID = $stmtfindInsertedItemSQL->fetch();

		$insertAnActivityLog = insertAnActivityLog($pdo, "INSERT", $getUserID['id'], 
			$getUserID['first_name'], $getUserID['last_name'], $getUserID['email'], $getUserID['gender'], 
			$getUserID['address'], $getUserID['birthday'], $getUserID['degree'], $getUserID['experience'], $getUserID['position'], $_SESSION['username']);

		if ($insertAnActivityLog) {
			$response = array(
				"status" =>"200",
				"message"=>"User addedd successfully!"
			);
		}

		else {
			$response = array(
				"status" =>"400",
				"message"=>"Insertion of activity log failed!"
			);
		}
		
	}

	else {
		$response = array(
			"status" =>"400",
			"message"=>"Insertion of data failed!"
		);

	}

	return $response;
}

function editUser($pdo, $first_name, $last_name, $email, $gender, 
	$address, $birthday, $degree, $experience, $position, 
	$last_updated, $last_updated_by, $id) {

	$response = array();
	$sql = "UPDATE users
			SET first_name = ?,
				last_name = ?,
				email = ?,
				gender = ?,
				address = ?,
				birthday = ?,
				degree = ?,
				experience = ?,
                position = ?,
				last_updated = ?, 
				last_updated_by = ? 
			WHERE id = ?
			";
	$stmt = $pdo->prepare($sql);
	$editUser = $stmt->execute([$first_name, $last_name, $email, $gender, 
	$address, $birthday, $degree, $experience, $position, 
	$last_updated, $last_updated_by, $id]);

	if ($editUser) {

		$findInsertedItemSQL = "SELECT * FROM users WHERE id = ?";
		$stmtfindInsertedItemSQL = $pdo->prepare($findInsertedItemSQL);
		$stmtfindInsertedItemSQL->execute([$id]);
		$getUserID = $stmtfindInsertedItemSQL->fetch(); 

		$insertAnActivityLog = insertAnActivityLog($pdo, "UPDATE", $getUserID['id'], 
		$getUserID['first_name'], $getUserID['last_name'], $getUserID['email'], $getUserID['gender'], 
		$getUserID['address'], $getUserID['birthday'], $getUserID['degree'], $getUserID['experience'], $getUserID['position'], $_SESSION['username']);

		if ($insertAnActivityLog) {

			$response = array(
				"status" =>"200",
				"message"=>"Updated the User successfully!"
			);
		}

		else {
			$response = array(
				"status" =>"400",
				"message"=>"Insertion of activity log failed!"
			);
		}

	}

	else {
		$response = array(
			"status" =>"400",
			"message"=>"An error has occured with the query!"
		);
	}

	return $response;

}


function deleteAUser($pdo, $id) {
	$response = array();
	$sql = "SELECT * FROM users WHERE id = ?";
	$stmt = $pdo->prepare($sql);
	$stmt->execute([$id]);
	$getUserID = $stmt->fetch();

	$insertAnActivityLog = insertAnActivityLog($pdo, "DELETE", $getUserID['id'], 
	$getUserID['first_name'], $getUserID['last_name'], $getUserID['email'], $getUserID['gender'], 
	$getUserID['address'], $getUserID['birthday'], $getUserID['degree'], $getUserID['experience'], $getUserID['position'], $_SESSION['username']);

	if ($insertAnActivityLog) {
		$deleteSql = "DELETE FROM users WHERE id = ?";
		$deleteStmt = $pdo->prepare($deleteSql);
		$deleteQuery = $deleteStmt->execute([$id]);

		if ($deleteQuery) {
			$response = array(
				"status" =>"200",
				"message"=>"Deleted the user successfully!"
			);
		}
		else {
			$response = array(
				"status" =>"400",
				"message"=>"Insertion of activity log failed!"
			);
		}
	}
	else {
		$response = array(
			"status" =>"400",
			"message"=>"An error has occured with the query!"
		);
	}

	return $response;
}

?>