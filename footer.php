<!-- Modal Login -->
<div id="loginUser" class="modal fade" role="dialog">
	<div class="modal-dialog">

		<!-- Modal content-->
		<form action="" method="post">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title">Login</h4>
				</div>
				<div class="modal-body">
					<div class="form-group">
						<input type="email" name="email" class="form-control" placeholder="E-mail" required>
					</div>
					<div class="form-group">
						<input type="password" name="password" class="form-control" placeholder="Password" required>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
					<button type="submit" class="btn btn-info" name="login">Login</button>
				</div>
			</div>
		</form>

	</div>
</div>
<!-- End Modal Login -->

<!-- Modal Logout -->
<div id="logoutUser" class="modal fade" role="dialog">
	<div class="modal-dialog">

		<!-- Modal content-->
		<form action="" method="post">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title">Logout Confirmation</h4>
				</div>
				<div class="modal-body">
					<p>Are you sure you want to logout from this session?</p>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">No</button>
					<button type="submit" class="btn btn-info" name="logout">Yes</button>
				</div>
			</div>
		</form>

	</div>
</div>
<!-- End Modal Logout -->

<?php 
// Login User
if (isset($_POST["login"])) {
	$email = $_POST['email'];
	$password = $_POST['password'];
	
	$message = 'Your email is not registered yet!';
	$userName = '';
	$userId = '';

	$result = mysqli_query($mysqli, "SELECT * FROM users");

	$row = mysqli_num_rows($result);
	if ($row > 0) {
		while ($users = mysqli_fetch_array($result)) {
			if ($email == $users['email']) {
				$message = 'Wrong password!';
				if (md5($password) == $users['password']) {
					$message = 'loginAllowed';
					$userName = $users['name'];
					$userId = $users['id'];
				}
			}
		}
	}

	if ($message == 'loginAllowed') {
		if (session_status() == PHP_SESSION_NONE) {
			session_start();
		}
		$_SESSION['id_user'] = $userId;
		echo "<script type='text/javascript'> alert('Welcome ".$userName."') </script>";
		echo "<script>document.location = 'index.php';</script>";
	} else {
		echo "<script type='text/javascript'> alert('".$message."') </script>";
		echo '<script>window.history.back()</script>';
	}
}

// Logout User
if (isset($_POST["logout"])) {
	if (session_status() == PHP_SESSION_NONE) {
		session_start();
	}
	unset($_SESSION['id_user']);
	echo "<script>document.location = 'index.php';</script>";
}
 ?>

<footer class="bg-dark mt-5 text-light">

	<!-- Copyright -->
	<div class="footer-copyright text-center py-3">© 2020 Copyright:
		<a href="index.php" class="text-info" style="text-decoration: none;">i-Profile</a>
	</div>
	<!-- Copyright -->

</footer>