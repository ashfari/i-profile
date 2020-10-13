<!-- Header -->
<?php 
include 'header.php';
 ?>
 <!-- End Header -->

 <!-- Body -->
	<div class="container mt-5">
		<div class="row" style="margin-top: 20px;">
			<div class="col">
				Selamat Belajar HTML
				<br>
				Semoga Sukses
			</div>
		</div>
		<?php 
		$list = array('Sri Rejeki','Begonia','Bromelia','dan lain-lain');
		 ?>
		 <div class="row" style="margin-top: 20px;">
		 	<div class="col">
		 		<table border="1" style="border-left: 0; border-top: 0; border-right: 0;">
		 			<tr>
		 				<th><h3>Aneka Tanaman Hias</h3></th>
		 			</tr>
		 			<?php foreach ($list as $l) {
		 			?>
		 			<tr>
		 				<td><?php echo $l; ?></td>
		 			</tr>
		 		<?php } ?>
		 		</table>
		 	</div>
		 </div>
		 <div class="row" style="margin-top: 20px;">
		 	<div class="col">
		 		<p style="font-family: 'Arial'">Polinema</p>
		 		<p style="font-family: 'Verdana'">Politeknik Negeri</p>
		 		<p style="font-family: 'Times New Roman'">Malang</p>
		 	</div>
		 </div>
		 <div class="row" style="margin-top: 20px;">
		 	<div class="col">
		 		<p style="color: red;">Polinema</p>
		 		<p style="color: blue;">Politeknik Negeri</p>
		 		<p style="color: green;">Malang</p>
		 	</div>
		 </div>
		<div class="row">
			<div class="col-md-6">
				<form action="">
					<label for="jenis_kelamin">Gender :</label>
					<div class="form-group">
						<input class="form-check-input" type="radio" name="jenis_kelamin" value="man">
						<label class="form-check-label" for="man">
							Man
						</label>
						<br>
						<input class="form-check-input" type="radio" name="jenis_kelamin" value="woman">
						<label class="form-check-label" for="woman">
							Woman
						</label>
					</div>
					<label for="jenis_kelamin">Hobi :</label>
					<div class="form-group">
						<input class="form-check-input" type="checkbox" value="Badminton" name="hobi[]">
						<label class="form-check-label" for="hobi">
							Badminton
						</label>
						<br>
						<input class="form-check-input" type="checkbox" value="Sepakbola" name="hobi[]">
						<label class="form-check-label" for="hobi">
							Sepakbola
						</label>
						<br>
						<input class="form-check-input" type="checkbox" value="E-sport" name="hobi[]">
						<label class="form-check-label" for="hobi">
							E-sport
						</label>
						<br>
					</div>
				</form>
			</div>
			<div class="col-md-6">
				<div class="form-group">
					<label for="status_pekerjaan">Status Pekerjaan :</label>
					<select class="form-control" name="status_pekerjaan">
						<option value="Sudah Bekerja">Sudah Bekerja</option>
						<option value="Belum Bekerja">Belum Bekerja</option>
					</select>
				</div>
			</div>
		</div>
	</div>
</body>
<!-- End Body -->

<!-- Footer -->
<?php include 'footer.php'; ?>
<!-- End Footer -->
</html>