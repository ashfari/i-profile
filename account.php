<!-- Header -->
<?php 
include 'header.php';

if (session_status() == PHP_SESSION_NONE) {
	session_start();
}
if (!isset($_SESSION["id_user"])) {
	echo "<script type='text/javascript'> alert('You need to login first to access this page!') </script>";
	echo '<script>window.history.back()</script>';
	exit();
}
?>
<!-- End Header -->

<!-- Body -->
<div class="container mt-3">
	<div class="row">
		<div class="col">
			<div class="text-info" style="text-decoration: none;">Profiles > Account</div>
		</div>
	</div>
	<?php 
	$result = mysqli_query($mysqli, "SELECT * FROM users WHERE id='$_SESSION[id_user]'");
	$user = mysqli_fetch_array($result);
	 ?>
	<div class="row mt-3">
		<div class="col">
			<h4 class="text-info">User Account</h4>
			<div class="text-info">Last updated at <?= $user['updated_at']; ?></div>
		</div>
	</div>
	<div class="row mt-3">
		<div class="col">
			<form action="" method="post">
				<label for="name">Name</label>
				<div class="form-group">
					<input type="text" name="name" class="form-control" placeholder="Name" required value="<?= $user['name']; ?>">
				</div>
				<label for="email">Email</label>
				<div class="form-group">
					<input type="email" name="email" class="form-control" placeholder="Email" required value="<?= $user['email']; ?>">
				</div>
				<label for="password">Password</label>
				<div class="form-group">
					<input type="hidden" name="password_ori" class="form-control" placeholder="Password Original" required value="<?= $user['password']; ?>">
					<input type="password" name="password" class="form-control" placeholder="Password" required value="<?= $user['password']; ?>">
				</div>
				<div class="form-group">
					<button type="reset" class="btn btn-warning mr-2">Reset</button>
					<button type="submit" class="btn btn-info" name="save">Save</button>
				</div>
			</form>
		</div>
	</div>
</div>

<?php 

// Save Data
if (isset($_POST["save"])) {
	$name = $_POST['name'];
	$email = $_POST['email'];
	$password_ori = $_POST['password_ori'];
	$password = $_POST['password'];

	if (session_status() == PHP_SESSION_NONE) {
		session_start();
	}
	$id = $_SESSION["id_user"];

	// Update record
	if ($password == $password_ori) {
		$query = mysqli_query($mysqli, "UPDATE users SET name='$name',email='$email',updated_at=null WHERE id='$id'") or die ("Query fault : ".mysqli_error($mysqli));
	} else {
		$password = md5($password);
		$query = mysqli_query($mysqli, "UPDATE users SET name='$name',email='$email',password='$password',updated_at=null WHERE id='$id'") or die ("Query fault : ".mysqli_error($mysqli));
	}
	if($query){
		echo "<script type='text/javascript'> alert('Account updated successfully') </script>";
		echo "<script>document.location = 'account.php';</script>";
	}else{
		echo "<script type='text/javascript'> alert('Failed to update account!') </script>";
		echo '<script>window.history.back()</script>';
	}
}

?>
</body>
<!-- End Body -->

<!-- Footer -->
<?php include 'footer.php'; ?>
<!-- End Footer -->
</html>