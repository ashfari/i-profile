<?php 
include 'koneksi.php'; 

if (session_status() == PHP_SESSION_NONE) {
	session_start();
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>i-Profile</title>
	<link rel="icon" href="images/i-profile_logo.png">

	<link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.css"/>
	<script src="bootstrap/js/jquery-3.2.1.min.js"></script>
	<script src="bootstrap/js/bootstrap.js"></script>
	<script src="bootstrap/js/popper.js"></script>
	<link rel="stylesheet" href="css/font-awesome.min.css">
</head>
<body>
	<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo01" aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
		</button>
		<div class="collapse navbar-collapse" id="navbarTogglerDemo01">
			<a class="navbar-brand" href="index.php"><img src="images/i-profile_logo.png" alt="i-Pofile" width="50" height="50">i-Profile</a>
			<ul class="navbar-nav mr-auto mt-2 mt-lg-0">
				<li class="nav-item">
					<a class="nav-link" href="index.php">Home</a>
				</li>
				<?php 
				if (isset($_SESSION["id_user"])) {
				 ?>
				<li class="nav-item dropdown">
					<a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
						Profiles
					</a>
					<div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
						<a class="dropdown-item" href="biodata.php">Biodata</a>
						<a class="dropdown-item" href="#">Educations</a>
						<a class="dropdown-item" href="#">Skills</a>
						<a class="dropdown-item" href="#">Experiences</a>
						<a class="dropdown-item" href="#">Portfolios</a>
						<a class="dropdown-item" href="#">Certifications</a>
					</div>
				</li>
				<li class="nav-item dropdown">
					<a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
						Generator
					</a>
					<div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
						<a class="dropdown-item" href="#">Curriculum Vitae</a>
					</div>
				</li>
				<?php 
				} 
				?>
				<li class="nav-item">
					<a class="nav-link" href="#">About</a>
				</li>
				<li class="nav-item">
					
				</li>
			</ul>
			<form class="form-inline my-2 my-lg-0">
				<?php if (isset($_SESSION['id_user'])): ?>
					<a class="nav-link text-light" href="#logoutUser" data-toggle="modal"><i class="fa fa-sign-in" aria-hidden="true"></i> Logout</a>
				<?php else: ?>
					<a class="nav-link text-light" href="#loginUser" data-toggle="modal"><i class="fa fa-sign-in" aria-hidden="true"></i> Login</a>
				<?php endif ?>
				<input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
				<button class="btn btn-outline-info my-2 my-sm-0" type="submit">Search</button>
			</form>
		</div>
	</nav>