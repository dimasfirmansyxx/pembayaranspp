<?php 

include 'config/functions.php';

$myfunc = new functions();
$myfunc->set_title("Petugas");
$myfunc->set_subtitle("Tambah Petugas");
$myfunc->set_breadcrumbs("HOME / MANAJEMEN PETUGAS / TAMBAH");

include 'templates/head.php';
include 'templates/nav.php';

if ( isset($_POST['simpan']) ) {
	$myfunc->add_officer($_POST);
}
?>

<div class="content-section mt-5">
	<div class="card">
		<div class="card-header bg-warning text-white">
			Tambah Petugas
		</div>
		<div class="card-body">
			<a href="<?= $myfunc->baseurl ?>officer.php" class="btn btn-primary">Kembali</a>
			<form action="" method="post" class="mt-5">
				<div class="form-group">
					<label>Nama</label>
					<input type="text" name="nama" required class="form-control" autocomplete="off">
					<label>Username</label>
					<input type="text" name="username" required class="form-control" autocomplete="off">
					<label>Password</label>
					<input type="password" name="password" required class="form-control" autocomplete="off">
					<label>Privilege</label>
					<select name="privilege" class="form-control">
						<option value="admin">Admin</option>
						<option value="petugas">Petugas</option>
					</select>
				</div>
				<button class="btn btn-primary" type="submit" name="simpan">Simpan</button>
			</form>
		</div>
	</div>
</div>

<?php
	include 'templates/footer.php';
?>