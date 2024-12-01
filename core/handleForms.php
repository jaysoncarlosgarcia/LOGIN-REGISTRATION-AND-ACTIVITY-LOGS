<?php  

require_once 'dbConfig.php';
require_once 'models.php';


if (isset($_POST['insertUserBtn'])) {
    $first_name = trim($_POST['first_name']);
    $last_name = trim($_POST['last_name']);
    $email = trim($_POST['email']);
    $gender = trim($_POST['gender']);
    $address = trim($_POST['address']);
    $birthday = trim($_POST['birthday']);
    $degree = trim($_POST['degree']);
    $experience = trim($_POST['experience']);
    $position = trim($_POST['position']);

    if (!empty($first_name) && !empty($last_name) && !empty($email) && !empty($gender) && !empty($address)
	&& !empty($birthday) && !empty($degree) && !empty($experience) && !empty($position)) {
		$insertAUser = insertAUser($pdo, $first_name, $last_name, $email, $gender, $address, $birthday,
			$degree, $experience, $position, $_SESSION['username']);
		$_SESSION['status'] =  $insertAUser['status']; 
		$_SESSION['message'] =  $insertAUser['message']; 
		header("Location: ../index.php");
	}

	else {
		$_SESSION['message'] = "Please make sure there are no empty input fields";
		$_SESSION['status'] = '400';
		header("Location: ../index.php");
	}

}

if (isset($_POST['editUserBtn'])) {

	$first_name = trim($_POST['first_name']);
    $last_name = trim($_POST['last_name']);
    $email = trim($_POST['email']);
    $gender = trim($_POST['gender']);
    $address = trim($_POST['address']);
    $birthday = trim($_POST['birthday']);
    $degree = trim($_POST['degree']);
    $experience = trim($_POST['experience']);
    $position = trim($_POST['position']);
	$date = date('Y-m-d H:i:s');

	if (!empty($first_name) && !empty($last_name) && !empty($email) && !empty($gender) && !empty($address)
	&& !empty($birthday) && !empty($degree) && !empty($experience) && !empty($position)) {

		$editUser = editUser($pdo, $first_name, $last_name, $email, $gender, $address, $birthday,
		$degree, $experience, $position, 
		$date, $_SESSION['username'], $_GET['id']);

		$_SESSION['message'] = $editUser['message'];
		$_SESSION['status'] = $editUser['status'];
		header("Location: ../index.php");
	}

	else {
		$_SESSION['message'] = "Please make sure there are no empty input fields";
		$_SESSION['status'] = '400';
		header("Location: ../register.php");
	}

}

if (isset($_POST['deleteUserBtn'])) {
	$id = $_GET['id'];

	if (!empty($id)) {
		$deleteAUser = deleteAUser($pdo, $id);
		$_SESSION['message'] = $deleteAUser['message'];
		$_SESSION['status'] = $deleteAUser['status'];
		header("Location: ../index.php");
	}
}

if (isset($_GET['searchBtn'])) {
	$searchForAUser = searchForAUser($pdo, $_GET['searchInput']);
	foreach ($searchForAUser as $row) {
		echo "<tr> 
				<td>{$row['id']}</td>
				<td>{$row['first_name']}</td>
				<td>{$row['last_name']}</td>
				<td>{$row['email']}</td>
				<td>{$row['gender']}</td>
				<td>{$row['address']}</td>
				<td>{$row['birthday']}</td>
				<td>{$row['degree']}</td>
				<td>{$row['experience']}</td>
				<td>{$row['position']}</td>
			  </tr>";
	}
}

if (isset($_POST['registerUserBtn'])) {
	$username = trim($_POST['username']);
	$firstName = trim($_POST['firstName']);
	$lastName = trim($_POST['lastName']);
	$password = trim($_POST['password']);
	$confirmpassword = trim($_POST['confirmpassword']);

	if (!empty($username) && !empty($firstName) && !empty($lastName) && 
		!empty($password) && !empty($confirmpassword)) {

		if ($password == $confirmpassword) {

			$insertQuery = insertNewAccount($pdo, $username, $firstName, $lastName, 
				password_hash($password, PASSWORD_DEFAULT));

			if ($insertQuery['status'] == '200') {
				$_SESSION['message'] = $insertQuery['message'];
				$_SESSION['status'] = $insertQuery['status'];
				header("Location: ../login.php");
			}

			else {
				$_SESSION['message'] = $insertQuery['message'];
				$_SESSION['status'] = $insertQuery['status'];
				header("Location: ../register.php");
			}

		}
		else {
			$_SESSION['message'] = "Please make sure both passwords are equal";
			$_SESSION['status'] = "400";
			header("Location: ../register.php");
		}

	}

	else {
		$_SESSION['message'] = "Please make sure there are no empty input fields";
		$_SESSION['status'] = "400";
		header("Location: ../register.php");
	}
}

if (isset($_POST['loginUserBtn'])) {
	$username = trim($_POST['username']);
	$password = trim($_POST['password']);

	if (!empty($username) && !empty($password)) {

		$loginQuery = checkIfAccountExists($pdo, $username);

		if ($loginQuery['status'] == '200') {
			$usernameFromDB = $loginQuery['userInfoArray']['username'];
			$passwordFromDB = $loginQuery['userInfoArray']['password'];

			if (password_verify($password, $passwordFromDB)) {
				$_SESSION['username'] = $usernameFromDB;
				header("Location: ../index.php");
				exit;
			} else {
				$_SESSION['message'] = "Wrong Password";
				$_SESSION['status'] = "400";
				header("Location: ../login.php");
				exit;
			}
		} else {
			$_SESSION['message'] = $loginQuery['message'];
			$_SESSION['status'] = $loginQuery['status'];
			header("Location: ../login.php");
			exit;
		}
	} else {
		$_SESSION['message'] = "Please make sure no input fields are empty";
		$_SESSION['status'] = "400";
		header("Location: ../login.php");
		exit;
	}
}

if (isset($_GET['logoutAUser'])) {
	unset($_SESSION['username']);
	header('Location: ../login.php');
}
?>