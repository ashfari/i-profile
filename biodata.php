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
			<div class="text-info" style="text-decoration: none;">Profiles > Biodata</div>
		</div>
	</div>
	<div class="row" style="margin-top: 20px;">
		<div class="col">
			<!-- Button Modal Create New -->
			<button type="button" class="btn btn-info " data-toggle="modal" data-target="#createBiodata">Create New Biodata</button>
		</div>
	</div>
	<div class="row mt-3">
		<?php 
		$result = mysqli_query($mysqli, "SELECT * FROM biodata");

		$row = mysqli_num_rows($result);
		if ($row == 0) {
			?>
			<p>Create your first biodata to show here</p>
			<?php 
		} else {
			while ($biodata = mysqli_fetch_array($result)) {
				?>
				<div class="col-md-4 mt-2">
					<div class="card border-info mb-3" style="max-width: 18rem;">
						<div class="card-header d-flex justify-content-between">
							<div>
								<?= $biodata['updated_at']; ?>
							</div>
							<div>
								<a href="#updateBiodata<?= $biodata['id']; ?>" class="text-info" data-toggle="modal"><i class="fa fa-edit"></i></a>
								<a href="#deleteBiodata<?= $biodata['id']; ?>" class="text-info ml-2" data-toggle="modal"><i class="fa fa-trash-o"></i></a>
							</div>
						</div>
						<div class="card-body text-info">
							<h5 class="card-title"><?= $biodata['label']; ?></h5>
							<p class="card-text">
								Birth : <?= $biodata['place_of_birth'].', '.date('M j Y',strtotime($biodata['date_of_birth'])); ?><br>
								Gender : <?= $biodata['gender']; ?><br>
								Religion : <?= $biodata['religion']; ?><br>
								Country : <?= $biodata['country']; ?><br>
								...
							</p>
						</div>
					</div>
				</div>

				<!-- Modal Update New -->
				<div id="updateBiodata<?= $biodata['id']; ?>" class="modal fade" role="dialog">
					<div class="modal-dialog">

						<!-- Modal content-->
						<form action="" method="post">
							<div class="modal-content">
								<div class="modal-header">
									<h4 class="modal-title">Update Biodata</h4>
								</div>
								<div class="modal-body">
									<div class="form-group" hidden>
										<input type="text" name="id" class="form-control" required value="<?= $biodata['id']; ?>">
									</div>
									<div class="form-group">
										<input type="text" name="label" class="form-control" placeholder="Biodata Label" required value="<?= $biodata['label']; ?>">
									</div>
									<div class="form-group">
										<input type="text" name="place_of_birth" class="form-control" placeholder="Place of Birth" required value="<?= $biodata['place_of_birth']; ?>">
									</div>
									<div class="form-group">
										<?php 
										$formatted_datetime = date("Y-m-d", strtotime($biodata["date_of_birth"]));
										 ?>
										<label for="date_of_birth">Date of Birth :</label>
										<input type="date" name="date_of_birth" class="form-control" placeholder="Date of Birth" required value="<?php echo $formatted_datetime; ?>">
									</div>
									<div class="form-group d-flex justify-content-between" style="margin-bottom: 0px;">
										<label for="gender">Gender :</label>
										<div class="form-group">
											<input type="radio" name="gender" value="Man" required <?= ($biodata['gender'] == 'Man') ? 'checked' : ''; ?>>
											<label for="Man">Man &nbsp;</label>
											<input type="radio" name="gender" value="Woman" required <?= ($biodata['gender'] == 'Woman') ? 'checked' : ''; ?>>
											<label for="Woman">Woman</label>
										</div>
									</div>
									<div class="form-group">
										<input type="text" name="religion" class="form-control" placeholder="Religion" required value="<?= $biodata['religion']; ?>">
									</div>
									<div class="form-group">
										<input type="text" name="country" class="form-control" placeholder="Country" required value="<?= $biodata['country']; ?>">
									</div>
									<div class="form-group">
										<?php 
										$status_arr = array("Married","Not Married");
										 ?>
										<select class="form-control" name="marital_status" required>
											<option value="" disabled selected>-- Marital Status --</option>
											<?php foreach ($status_arr as $stat): ?>
												<option value="<?= $stat; ?>" <?= ($biodata['marital_status'] == $stat) ? 'selected' : ''; ?>><?= $stat; ?></option>
											<?php endforeach ?>
										</select>
									</div>
									<div class="form-group">
										<textarea class="form-control" name="address" placeholder="Address" required><?= $biodata['address']; ?></textarea>
									</div>
									<div class="form-group">
										<input type="tel" name="phone" class="form-control" placeholder="Phone number" pattern="[0-9].{8,13}" required value="<?= $biodata['phone']; ?>">
									</div>
									<div class="form-group">
										<input type="text" name="languages" class="form-control" placeholder="Languages (ex: Indonesian,English,Chinese)" value="<?= str_replace(';', ',', $biodata['languages']); ?>">
									</div>
								</div>
								<div class="modal-footer">
									<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
									<button type="submit" class="btn btn-info" name="update">Update</button>
								</div>
							</div>
						</form>

					</div>
				</div>
				<!-- End Modal Update -->

				<!-- Modal Delete -->
				<div id="deleteBiodata<?= $biodata['id']; ?>" class="modal fade" role="dialog">
					<div class="modal-dialog">

						<!-- Modal content-->
						<form action="" method="post">
							<div class="modal-content">
								<div class="modal-header">
									<h4 class="modal-title">Delete Confirmation</h4>
								</div>
								<div class="modal-body">
									<div class="form-group" hidden>
										<input type="text" name="id" class="form-control" required value="<?= $biodata['id']; ?>">
									</div>
									<p>Are you sure you want to delete this biodata?</p>
								</div>
								<div class="modal-footer">
									<button type="button" class="btn btn-default" data-dismiss="modal">No</button>
									<button type="submit" class="btn btn-danger" name="delete">Yes</button>
								</div>
							</div>
						</form>

					</div>
				</div>
				<!-- End Modal Delete -->
				<?php
			}
		} 
		?>
	</div>
</div>

<!-- Modal Create New -->
<div id="createBiodata" class="modal fade" role="dialog">
	<div class="modal-dialog">

		<!-- Modal content-->
		<form action="" method="post">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title">Create New Biodata</h4>
				</div>
				<div class="modal-body">
					<div class="form-group">
						<input type="text" name="label" class="form-control" placeholder="Biodata Label" required>
					</div>
					<div class="form-group">
						<input type="text" name="place_of_birth" class="form-control" placeholder="Place of Birth" required>
					</div>
					<div class="form-group">
						<label for="date_of_birth">Date of Birth :</label>
						<input type="date" name="date_of_birth" class="form-control" placeholder="Date of Birth" required>
					</div>
					<div class="form-group d-flex justify-content-between" style="margin-bottom: 0px;">
						<label for="gender">Gender :</label>
						<div class="form-group">
							<input type="radio" name="gender" value="Man" required>
							<label for="Man">Man &nbsp;</label>
							<input type="radio" name="gender" value="Woman" required>
							<label for="Woman">Woman</label>
						</div>
					</div>
					<div class="form-group">
						<input type="text" name="religion" class="form-control" placeholder="Religion" required>
					</div>
					<div class="form-group">
						<input type="text" name="country" class="form-control" placeholder="Country" required>
					</div>
					<div class="form-group">
						<select class="form-control" name="marital_status" required>
							<option value="" disabled selected>-- Marital Status --</option>
							<option value="Married">Married</option>
							<option value="Not Married">Not Married</option>
						</select>
					</div>
					<div class="form-group">
						<textarea class="form-control" name="address" placeholder="Address" required></textarea>
					</div>
					<div class="form-group">
						<input type="tel" name="phone" class="form-control" placeholder="Phone number" pattern="[0-9].{8,13}" required>
					</div>
					<div class="form-group">
						<input type="text" name="languages" class="form-control" placeholder="Languages (ex: Indonesian,English,Chinese)">
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
					<button type="submit" class="btn btn-info" name="create">Create</button>
				</div>
			</div>
		</form>

	</div>
</div>
<!-- End Modal Create New -->

<?php 
// Create Data
if (isset($_POST["create"])) {
	$label = $_POST['label'];
	$place_of_birth = $_POST['place_of_birth'];
	$date_of_birth = date('Y-m-d H:i:s', strtotime($_POST['date_of_birth']));
	$gender = $_POST['gender'];
	$religion = $_POST['religion'];
	$country = $_POST['country'];
	$marital_status = $_POST['marital_status'];
	$address = $_POST['address'];
	$phone = $_POST['phone'];
	$languages = null;
	if ($_POST['languages']) {
		$languages = str_replace(',', ';', $_POST['languages']);
	}

	if (session_status() == PHP_SESSION_NONE) {
		session_start();
	}
	// $id_user = $_SESSION["id_user"];
	$id_user = 1;

	// Insert record
	$query = mysqli_query($mysqli, "INSERT INTO biodata VALUES(null,'$id_user','$label','$place_of_birth','$date_of_birth','$gender','$religion','$country','$marital_status','$address','$phone','$languages',null,null)") or die ("Query fault : ".mysqli_error($mysqli));
	if($query){
		echo "<script type='text/javascript'> alert('Biodata created successfully') </script>";
		echo "<script>document.location = 'biodata.php';</script>";
	}else{
		echo "<script type='text/javascript'> alert('Failed to create biodata!') </script>";
		echo '<script>window.history.back()</script>';
	}
}

// Update Data
if (isset($_POST["update"])) {
	$id = $_POST['id'];
	$label = $_POST['label'];
	$place_of_birth = $_POST['place_of_birth'];
	$date_of_birth = date('Y-m-d H:i:s', strtotime($_POST['date_of_birth']));
	$gender = $_POST['gender'];
	$religion = $_POST['religion'];
	$country = $_POST['country'];
	$marital_status = $_POST['marital_status'];
	$address = $_POST['address'];
	$phone = $_POST['phone'];
	$languages = null;
	if ($_POST['languages']) {
		$languages = str_replace(',', ';', $_POST['languages']);
	}

	if (session_status() == PHP_SESSION_NONE) {
		session_start();
	}
	// $id_user = $_SESSION["id_user"];
	$id_user = 1;

	// Update record
	$query = mysqli_query($mysqli, "UPDATE biodata SET id_user='$id_user',label='$label',place_of_birth='$place_of_birth',date_of_birth='$date_of_birth',gender='$gender',religion='$religion',country='$country',marital_status='$marital_status',address='$address',phone='$phone',languages='$languages',updated_at=null WHERE id='$id'") or die ("Query fault : ".mysqli_error($mysqli));
	if($query){
		echo "<script type='text/javascript'> alert('Biodata updated successfully') </script>";
		echo "<script>document.location = 'biodata.php';</script>";
	}else{
		echo "<script type='text/javascript'> alert('Failed to update biodata!') </script>";
		echo '<script>window.history.back()</script>';
	}
}

// Delete Data
if (isset($_POST["delete"])) {
	$id = $_POST['id'];

	// Delete record
	$query = mysqli_query($mysqli, "DELETE FROM biodata WHERE id='$id'") or die ("Query fault : ".mysqli_error($mysqli));
	if($query){
		echo "<script type='text/javascript'> alert('Biodata deleted successfully') </script>";
		echo "<script>document.location = 'biodata.php';</script>";
	}else{
		echo "<script type='text/javascript'> alert('Failed to delete biodata!') </script>";
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